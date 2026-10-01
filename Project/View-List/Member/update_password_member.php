<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../imports/security/encrypt_decrypt.php';

$json = array();
$state = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $main_user_login_id = isset($_POST['main_user_login_id']) ? intval($_POST['main_user_login_id']) : 0;
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : "";
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : "";

    $db_obj = new DataBase();

    if ($main_user_login_id > 0 && !empty($old_password) && !empty($new_password)) {
        // Fetch current username & password hash securely
        $res = $db_obj->get_result("SELECT user_name, password FROM main_user_login WHERE id='{$main_user_login_id}' AND ast=1");
        
        if ($res && $row = $res->fetch_assoc()) {
            $user_name = $row['user_name'];
            $db_password = $row['password'];

            $adv_sec = new Advance_Security();
            $encrypted_old = $adv_sec->get_data_encrypt($user_name, $old_password);

            if ($encrypted_old === $db_password) {
                // Passwords match natively, prepare new hash
                $encrypted_new = $adv_sec->get_data_encrypt($user_name, $new_password);

                // Update
                $update_res = $db_obj->get_result("UPDATE main_user_login SET password='{$encrypted_new}' WHERE id='{$main_user_login_id}'");
                
                if ($update_res) {
                    $state['error'] = "0";
                } else {
                    $state['error'] = "Failed to update password correctly.";
                }
            } else {
                $state['error'] = "Your old password does not match!";
            }
        } else {
            $state['error'] = "Account not found securely.";
        }
    } else {
        $state['error'] = "Please provide all required fields.";
    }
} else {
    $state['error'] = "Invalid verification request.";
}

$json[] = $state;
echo json_encode($json);
?>
