<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_LIST.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';
include_once '../../Controller/member_register/wwjm_road_name/wwjm_road_name_SINGLE_DATA.php';
include_once '../../Controller/Main/main_user_login/main_user_login_LIST.php';
include_once '../../Controller/Main/main_user_login/main_user_login_ADD_UPDATE.php';

header('Content-Type: application/json');

function profile_update_response($status, $message)
{
    echo json_encode(array('status' => $status, 'message' => $message));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    profile_update_response('error', 'Invalid profile update request.');
}

$member_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$posted_login_id = isset($_POST['main_user_login_id']) ? intval($_POST['main_user_login_id']) : 0;
$name = isset($_POST['name_M']) ? trim($_POST['name_M']) : '';
$email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : '';
$address = isset($_POST['residence_address_M']) ? trim($_POST['residence_address_M']) : '';
$mobile = isset($_POST['phone_mobile']) ? trim($_POST['phone_mobile']) : '';
$whatsapp = isset($_POST['notification_whatup']) ? trim($_POST['notification_whatup']) : '';
$road_id = isset($_POST['bmjm_road_name_id']) ? intval($_POST['bmjm_road_name_id']) : 0;
$residence_type = isset($_POST['residence_type']) ? trim($_POST['residence_type']) : '';
$monthly_payment = isset($_POST['monlty_payment']) ? trim($_POST['monlty_payment']) : '';
$zakath_type = isset($_POST['zakath_type']) ? trim($_POST['zakath_type']) : 'none';
$access_level = isset($_SESSION['access_control_id']) ? intval($_SESSION['access_control_id']) : 0;
$session_login_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;
$is_admin_update = ($access_level === 1);
$is_member_update = ($access_level === 2);

if (!$is_admin_update && !$is_member_update) {
    profile_update_response('error', 'Please sign in again to update profile details.');
}

if ($member_id < 1) {
    profile_update_response('error', 'Invalid member ID.');
}

$member = new wwjm_member_list_SINGLE_DATA($member_id);
if (!$member->get_state() || (string) $member->get_ast() !== '1') {
    profile_update_response('error', 'Member profile not found.');
}

if ($email === '') {
    $email = strtolower(trim($member->get_email()));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    profile_update_response('error', 'Please enter a valid email address.');
}
if ($address === '') {
    profile_update_response('error', 'Please enter your residence address.');
}
if ($mobile === '') {
    profile_update_response('error', 'Please enter your mobile number.');
}

$login_id = intval($member->get_main_user_login_id());
if ($is_member_update && ($session_login_id < 1 || $login_id !== $session_login_id)) {
    profile_update_response('error', 'You cannot update another member profile.');
}
if ($is_member_update && $posted_login_id > 0 && $login_id > 0 && $posted_login_id !== $login_id) {
    profile_update_response('error', 'You cannot update another member profile.');
}

if ($is_admin_update || $is_member_update) {
    if ($road_id < 1) {
        profile_update_response('error', 'Please select a valid road.');
    }
    if ($monthly_payment === '' || !is_numeric($monthly_payment) || (float) $monthly_payment < 0) {
        profile_update_response('error', 'Please enter a valid monthly subscription amount.');
    }
    if (!in_array($zakath_type, array('none', 'payee', 'receiver'), true)) {
        profile_update_response('error', 'Please select a valid zakath status.');
    }

    $current_monthly_payment = (float) $member->get_monlty_payment();
    if ((float) $monthly_payment < $current_monthly_payment) {
        profile_update_response('error', 'Monthly subscription can only be increased. Current amount is ' . number_format($current_monthly_payment, 2) . '.');
    }

    $road = new wwjm_road_name_SINGLE_DATA($road_id);
    if ((string) $road->get_ast() !== '1') {
        profile_update_response('error', 'Selected road is not available.');
    }
}

if ($is_admin_update && !in_array($residence_type, array('owner', 'rented'), true)) {
    profile_update_response('error', 'Please select a valid residing status.');
}

$safe_name = addslashes($name);
$safe_email = addslashes($email);
$safe_address = addslashes($address);
$safe_mobile = addslashes($mobile);
$safe_whatsapp = addslashes($whatsapp !== '' ? $whatsapp : $mobile);

$member_email_check = new wwjm_member_list_LIST();
$member_email_check->filter_by_email($safe_email);
$member_email_check->filter_by_id_not($member_id);
$member_email_result = $member_email_check->get_result();
if ($member_email_result && $member_email_result->num_rows > 0) {
    profile_update_response('error', 'This email is already used by another member.');
}

$login_email_check = new main_user_login_LIST();
$login_email_check->filter_by_user_name($safe_email);
if ($login_id > 0) {
    $login_email_check->filter_by_id_not($login_id);
}
$login_email_result = $login_email_check->get_result();
if ($login_email_result && $login_email_result->num_rows > 0) {
    profile_update_response('error', 'This email is already used by another user.');
}

$old_login = null;
$new_encrypted_password = '';
if ($login_id > 0) {
    $login_lookup = new main_user_login_LIST();
    $login_lookup->filter_by_id($login_id);
    $login_result = $login_lookup->get_result();
    if ($login_result && $login_result->num_rows > 0) {
        $old_login = $login_result->fetch_assoc();

        $old_email = isset($old_login['user_name']) ? $old_login['user_name'] : '';
        $old_password = isset($old_login['password']) ? $old_login['password'] : '';
        if (strtolower($old_email) !== $email && $old_password !== '') {
            $security = new Advance_Security();
            $plain_password = $security->get_data_decrypt($old_email, $old_password);
            if ($plain_password === false || $plain_password === '') {
                profile_update_response('error', 'Unable to securely update login email. Please change your password first.');
            }
            $new_encrypted_password = addslashes($security->get_data_encrypt($email, $plain_password));
        }
    }
}

$member_update = new wwjm_member_list_ADD_UPDATE();
$member_update->set_id($member_id);
if ($name !== '') {
    $member_update->set_name_M($safe_name);
}
$member_update->set_email($safe_email);
$member_update->set_residence_address_M($safe_address);
$member_update->set_notification_moible_no($safe_mobile);
$member_update->set_notification_whatup($safe_whatsapp);

if ($is_admin_update || $is_member_update) {
    $member_update->set_wwjm_road_name_id($road_id);
    $member_update->set_monlty_payment(number_format((float) $monthly_payment, 2, '.', ''));
    $member_update->set_account_type_zakath_payee($zakath_type === 'payee' ? '1' : '0');
    $member_update->set_account_type_zakath_reciver($zakath_type === 'receiver' ? '1' : '0');
    if ($zakath_type === 'payee') {
        $member_update->is_zakath_pay_state();
    } else {
        $member_update->is_Not_zakath_pay_state();
    }
}

if ($is_admin_update) {
    $member_update->set_is_own_house($residence_type === 'owner' ? '1' : '0');
    $member_update->set_is_rented_house($residence_type === 'rented' ? '1' : '0');
}

if (!$member_update->process_update()) {
    profile_update_response('error', 'Could not update member profile.');
}

if ($old_login) {
    $login_update = new main_user_login_ADD_UPDATE();
    $login_update->set_id($login_id);
    $login_update->set_user_name($safe_email);
    if ($name !== '') {
        $login_update->set_name_show($safe_name);
        $login_update->set_first_name($safe_name);
    }
    $login_update->set_phone_number($safe_mobile);

    if ($new_encrypted_password !== '') {
        $login_update->set_password($new_encrypted_password);
    }

    if (!$login_update->process_update()) {
        profile_update_response('error', 'Member details updated, but login details could not be updated.');
    }

    if (isset($_SESSION['user_id']) && intval($_SESSION['user_id']) === $login_id) {
        $_SESSION['user_name'] = $email;
    }
}

profile_update_response('success', 'Profile updated successfully.');
