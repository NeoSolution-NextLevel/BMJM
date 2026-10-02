<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_SINGLE_DATA.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA_member_no.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../imports/email/Email_Sending_Final.php';
include_once '../../imports/email/Email_Send.php';
include_once '../../imports/sms/SMS_Sending.php';
include_once '../../UxUI-Back/notification_templates/bank_deposit/notification_template_payment_slip.php';

header('Content-Type: application/json; charset=utf-8');

function payment_slip_send_response($status, $message)
{
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    payment_slip_send_response('error', 'Invalid request method.');
}

$login = new Cook_Management($user_main_cook_id);
if (!$login->check_login_availability() || (int) ($_SESSION['access_control_id'] ?? 0) !== 1) {
    payment_slip_send_response('error', 'Please sign in again before sending a receipt.');
}

$payment_id = isset($_POST['payment_id']) ? (int) $_POST['payment_id'] : 0;
$channel = isset($_POST['channel']) ? strtolower(trim($_POST['channel'])) : '';

if ($payment_id < 1 || !in_array($channel, ['sms', 'email'], true)) {
    payment_slip_send_response('error', 'Invalid payment receipt request.');
}

$payment = new wwjm_payment_slip_SINGLE_DATA($payment_id);
if (!$payment->get_state() || (string) $payment->get_ast() !== '1') {
    payment_slip_send_response('error', 'Payment receipt was not found.');
}

$security_keys = new Advance_Security_Key_List();
$security = new Advance_Security();
$encrypted_id = $security->get_data_encrypt($security_keys->get_bmjm_payment_slip_id(), $payment_id);
$template = new notification_template_payment_slip($encrypted_id);
$member_name = trim((string) $payment->get_person_name());
$member_name = $member_name !== '' ? $member_name : 'Member';
$amount = number_format((float) $payment->get_amount(), 2, '.', ',');
$receipt_number = '#' . str_pad((string) $payment_id, 5, '0', STR_PAD_LEFT);
$member = null;
$membership_no = trim((string) $payment->get_membership_no());
if ($membership_no !== '') {
    $member_lookup = new wwjm_member_list_SINGLE_DATA_member_no($membership_no);
    if ($member_lookup->get_state()) {
        $member = $member_lookup;
    }
}

if ($channel === 'email') {
    $email = trim((string) $payment->get_email());
    if (($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) && $member) {
        $email = trim((string) $member->get_contact_email());
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        payment_slip_send_response('error', 'This payment does not have a valid email address.');
    }

    $content = $template->sending_form_by_email(
        $amount,
        $member_name,
        $payment->get_payment_date(),
        $receipt_number
    );
    $mailer = new Email($email, $template->email_subject(), $content);
    if (!@$mailer->send_email()) {
        payment_slip_send_response('error', 'Email could not be sent. Check the server mail configuration.');
    }

    payment_slip_send_response('success', 'Payment receipt sent to ' . $email . '.');
}

$phone = trim((string) $payment->get_phone_number());
if ($phone === '' && $member) {
    $phone = trim((string) $member->get_contact_number());
}
if ($phone === '') {
    payment_slip_send_response('error', 'This payment does not have a mobile number.');
}

$sms = new SMS_Sending($phone, $template->form_by_sms($member_name, $amount, $receipt_number));
$sms_response = $sms->send_message();
$sms_data = json_decode((string) $sms_response, true);
$sms_failed = !$sms_response
    || stripos((string) $sms_response, 'error') !== false
    || (is_array($sms_data) && isset($sms_data['status']) && in_array(strtolower((string) $sms_data['status']), ['error', 'failed', 'false'], true));

if ($sms_failed) {
    $provider_message = is_array($sms_data) && !empty($sms_data['message']) ? ': ' . $sms_data['message'] : '';
    payment_slip_send_response('error', 'SMS could not be sent' . $provider_message . '.');
}

payment_slip_send_response('success', 'Payment receipt sent by SMS to ' . $phone . '.');
