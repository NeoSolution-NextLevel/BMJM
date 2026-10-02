<?php

if (!defined('BMJM_FEATURE_FLAGS_LOADED')) {
    define('BMJM_FEATURE_FLAGS_LOADED', true);

    // Ensure Company_Info_Variable_List is available.
    if (!defined('_BMJM_COMPANY_INFO_VAR_LIST_LOADED_')) {
        $ff_base = dirname(__DIR__);
        include_once $ff_base . '/Company_Info/Company_Info_Variable_List.php';
    }

    $_bmjm_ff_config = new Company_Info_Variable_List();

    
    $BMJM_FEATURE_DONATION = $_bmjm_ff_config->is_feature_donation_enabled();

   
    $BMJM_FEATURE_COLLECTION = $_bmjm_ff_config->is_feature_collection_payment_enabled();

    unset($_bmjm_ff_config);
}

function bmjm_feature_flags_js()
{
    global $BMJM_FEATURE_DONATION, $BMJM_FEATURE_COLLECTION;

    $emitted = false;

    if ($emitted) {
        return;
    }
    $emitted = true;

    $donation    = $BMJM_FEATURE_DONATION    ? 'true' : 'false';
    $collection  = $BMJM_FEATURE_COLLECTION  ? 'true' : 'false';

    echo '<script>',
         'window.BMJM_FEATURE_DONATION='    , $donation   , ';',
         'window.BMJM_FEATURE_COLLECTION='  , $collection , ';',
         '</script>';
}

function bmjm_feature_guard($flag, $featureName)
{
    if (!$flag) {
        http_response_code(403);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'error'   => true,
            'message' => $featureName . ' is currently unavailable. Feature is temporarily disabled.',
        ]);
        exit;
    }
}
