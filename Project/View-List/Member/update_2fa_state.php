<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';

$json = array();
$state = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $main_user_login_id = isset($_POST['main_user_login_id']) ? intval($_POST['main_user_login_id']) : 0;
    $is_2fa = isset($_POST['is_two_factor_auth_enable']) ? intval($_POST['is_two_factor_auth_enable']) : 0;

    $db_obj = new DataBase();

    if ($main_user_login_id > 0) {
        $update_res = $db_obj->get_result("UPDATE main_user_login SET is_two_factor_auth_enable='{$is_2fa}' WHERE id='{$main_user_login_id}'");
        
        if ($update_res) {
            $state['error'] = "0";
            $state['updated_status'] = $is_2fa;
        } else {
            $state['error'] = "Failed to update 2FA configuration.";
        }
    } else {
        $state['error'] = "Account not found securely.";
    }
} else {
    $state['error'] = "Invalid verification request.";
}

$json[] = $state;
echo json_encode($json);
?>
