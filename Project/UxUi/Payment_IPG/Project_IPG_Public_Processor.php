<?php
// UxUi/Payment_IPG/Project_IPG_Public_Processor.php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/wwjm_member_list_has_IPG_Send_By_URL/wwjm_member_list_has_IPG_Send_By_URL_ADD_UPDATE.php';
include_once __DIR__ . '/../../imports/security/key_list.php';
include_once __DIR__ . '/../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../imports/feature_flags/feature_flags.php';

// Backend guard: reject all project IPG payment processing when feature is disabled.
if (!$BMJM_FEATURE_COLLECTION) {
    bmjm_feature_guard(false, 'Collection Payment');
}

$project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
$project_name = isset($_POST['project_name']) ? $_POST['project_name'] : 'Unknown Project';
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$is_member = isset($_POST['is_member']) ? $_POST['is_member'] : '0';
$member_no = isset($_POST['member_no']) ? $_POST['member_no'] : '';

if (empty($project_id) || $amount <= 0 || empty($name)) {
    echo json_encode(['error' => '1', 'message' => 'Invalid parameters. Please provide your data cleanly.']);
    exit;
}

$actual_member_id = null;
if ($is_member === '1') {
    if (empty($member_no)) {
        echo json_encode(['error' => '1', 'message' => 'Please provide your Membership Number.']);
        exit;
    }
    $db = new DataBase();
    $q = "SELECT id FROM wwjm_member_list WHERE membership_no = '".$db->real_escape_string($member_no)."' AND ast=1";
    $r = $db->get_result($q);
    if ($r && $row = $r->fetch_assoc()) {
         $actual_member_id = $row['id'];
    } else {
         echo json_encode(['error' => '1', 'message' => 'Invalid Membership Number. Authentication Failed.']);
         exit;
    }
}

$ipg_url_obj = new IPG_Send_By_URL_ADD_UPDATE();
if ($is_member === '1') {
    $ipg_url_obj->is_is_member();
}
$ipg_url_obj->is_is_projcet();
$ipg_url_obj->is_not_is_user(); // generated publicly

$ipg_url_obj->get_data($amount, $name, $phone, "", 0, $amount);

if ($ipg_url_obj->process_new_record()) {
    $IPG_Send_By_URL_id = $ipg_url_obj->get_id();
    $sec_id = $ipg_url_obj->get_sec_id();
    
    // Add to project cache bridging
    $cache_file = __DIR__ . '/../../View-List/Payment_gateway/OnePay/project_ipg_cache.json';
    $cache = file_exists($cache_file) ? json_decode(file_get_contents($cache_file), true) : [];
    $cache[(string)$IPG_Send_By_URL_id] = [
        'id' => $project_id,
        'name' => $project_name
    ];
    file_put_contents($cache_file, json_encode($cache));
    
    // Member mapping if applicable
    if ($is_member === '1' && $actual_member_id) {
         $member_user_ipg_url_obj = new wwjm_member_list_has_IPG_Send_By_URL_ADD_UPDATE();
         $member_user_ipg_url_obj->get_data($actual_member_id, $IPG_Send_By_URL_id);
         $member_user_ipg_url_obj->process_new_record();
    }

    // Capture explicit ticket payload
    if(!empty($_POST['tickets'])) {
        $tickets_cache = __DIR__ . '/../../View-List/Payment_gateway/OnePay/project_ipg_tickets_cache.json';
        $t_cache = file_exists($tickets_cache) ? json_decode(file_get_contents($tickets_cache), true) : [];
        $t_cache[(string)$IPG_Send_By_URL_id] = json_decode($_POST['tickets'], true);
        file_put_contents($tickets_cache, json_encode($t_cache));
    }

    echo json_encode(['error' => '0', 'sec_id' => $sec_id]);
} else {
    echo json_encode(['error' => '1', 'message' => $ipg_url_obj->get_error()]);
}
?>
