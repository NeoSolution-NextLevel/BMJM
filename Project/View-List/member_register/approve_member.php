<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA.php';

$json = array();
$state = array('error' => '1');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $state['error'] = "Invalid Request";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$check_login_obj = new Cook_Management($user_main_cook_id);
if (!$check_login_obj->check_login_availability()) {
    $state['error'] = "Please sign in as an administrator to approve members.";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$member_id = isset($_POST['member_id']) ? intval($_POST['member_id']) : 0;
$round = isset($_POST['round']) ? intval($_POST['round']) : 1;
if ($round !== 2) {
    $round = 1;
}

if ($member_id < 1) {
    $state['error'] = "Invalid member.";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$member_obj = new wwjm_member_list_SINGLE_DATA($member_id);
if (!$member_obj->get_state() || (string) $member_obj->get_ast() !== '1') {
    $state['error'] = "Member not found.";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$approver_name = addslashes($check_login_obj->get_name_show());
$now = date("Y-m-d H:i:s");

$level1 = (string) $member_obj->get_approve_level_01_state();
$level2 = (string) $member_obj->get_approve_level_02_state();

if ($level1 === '1' && $level2 === '1') {
    $state['error'] = "0";
    $state['status'] = "approved";
    $state['round'] = 2;
    $json[] = $state;
    echo json_encode($json);
    exit;
}

if ($round === 1) {
    if ($level1 === '1') {
        $state['error'] = "0";
        $state['status'] = "pending";
        $state['round'] = 2;
        $json[] = $state;
        echo json_encode($json);
        exit;
    }

    $member_update = new wwjm_member_list_ADD_UPDATE();
    $member_update->set_id($member_id);
    $member_update->is_approve_level_01_state();
    $member_update->set_approve_level_01_person($approver_name);
    $member_update->set_approve_level_01_sdt($now);

    if (!$member_update->process_update()) {
        $state['error'] = "Could not save approval stage 1.";
        $json[] = $state;
        echo json_encode($json);
        exit;
    }

    $state['error'] = "0";
    $state['status'] = "pending";
    $state['round'] = 2;
    $json[] = $state;
    echo json_encode($json);
    exit;
}

if ($level1 !== '1') {
    $state['error'] = "Approve stage 1 before stage 2.";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$member_update = new wwjm_member_list_ADD_UPDATE();
$member_update->set_id($member_id);
$member_update->is_approve_level_02_state();
$member_update->set_approve_level_02_person($approver_name);
$member_update->set_approve_level_02_sdt($now);

if (!$member_update->process_update()) {
    $state['error'] = "Could not save approval stage 2.";
    $json[] = $state;
    echo json_encode($json);
    exit;
}

$login_id = intval($member_obj->get_main_user_login_id());
$name_M = $member_obj->get_name_M();
$email = $member_obj->get_email();
$phone_mobile = $member_obj->get_notification_moible_no();
$whatsappNum = $member_obj->get_notification_whatup();
$nic_M = trim((string) $member_obj->get_nic_M());
$membership_no = $member_obj->get_membership_no();
if (empty($membership_no)) {
    $membership_no = str_pad((string) $member_id, 5, "0", STR_PAD_LEFT);
}
$temp_password = !empty($nic_M) ? $nic_M : substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
$user_login_name = !empty($email) ? $email : (!empty($nic_M) ? $nic_M : "M" . $membership_no);

if (!class_exists('Company_Info_Variable_List')) {
    include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
}
if (!class_exists('main_user_account_access_level_list_LIST')) {
    include_once '../../Controller/Main/main_user_account_access_level_list/main_user_account_access_level_list_LIST.php';
}
if (!class_exists('main_user_login_ADD_UPDATE')) {
    include_once '../../Controller/Main/main_user_login/main_user_login_ADD_UPDATE.php';
}
if (!class_exists('Advance_Security')) {
    include_once '../../imports/security/encrypt_decrypt.php';
}
if (!class_exists('SMS_Sending')) {
    include_once '../../imports/sms/SMS_Sending.php';
}
if (!class_exists('Email')) {
    include_once '../../imports/email/Email_Send.php';
}

if ($login_id > 0) {
    $login_update = new main_user_login_ADD_UPDATE();
    $login_update->set_id($login_id);
    $login_update->is_account_active_state();
    $login_update->is_email_verify();
    $login_update->process_update();
} else {
    $access_level_id = "2";
    $access_obj = new main_user_account_access_level_list_LIST();
    $access_obj->filter_by_type_of_access('user');
    $acc_res = $access_obj->get_result();
    if ($acc_res && $row_acc = $acc_res->fetch_assoc()) {
        $access_level_id = $row_acc['id'];
    }

    $adv_sec = new Advance_Security();
    $encrypted_temp_password = $adv_sec->get_data_encrypt($user_login_name, $temp_password);
    $new_login = new main_user_login_ADD_UPDATE();
    $new_login->set_registration_from_data($user_login_name, $encrypted_temp_password, $name_M, "", "", "Member", $access_level_id, $name_M, "");
    $new_login->is_account_active_state();
    $new_login->is_email_verify();
    $new_login->process_new_record();
}

$sms_msg = "Assalamu Alaikum {$name_M}, your WWJM membership is approved. Username: {$user_login_name} Password: {$temp_password} ";
$target_phone = !empty($phone_mobile) ? $phone_mobile : (!empty($whatsappNum) ? $whatsappNum : "");
if (!empty($target_phone)) {
    $sms_obj = new SMS_Sending($target_phone, $sms_msg);
    $sms_obj->send_message();
}

if (!empty($email)) {
    $email_subject = "WWJM Membership Approved";
    $email_html = "
        <h2 style='color:#123832; margin-bottom:15px;'>Assalamu Alaikum {$name_M},</h2>
        <p style='font-size:16px;'>Your Wellawatta Jumma Mosque membership has been approved. You can now sign in to the member portal.</p>
        <div style='background-color:#F2EDE0; padding:20px; border-radius:8px; margin:20px 0;'>
            <p style='margin:0; font-size:15px;'><b>Your Username:</b> {$user_login_name}</p>
            <p style='margin:10px 0 0; font-size:15px;'><b>Temporary Password:</b> {$temp_password}</p>
        </div>
        <p style='font-size:14px; color:#5A6A62;'>Please update your password after your first login.</p>
    ";
    $email_obj = new Email($email, $email_subject, $email_html);
    @$email_obj->send_email();
}

$state['error'] = "0";
$state['status'] = "approved";
$state['round'] = 2;
$json[] = $state;
echo json_encode($json);
