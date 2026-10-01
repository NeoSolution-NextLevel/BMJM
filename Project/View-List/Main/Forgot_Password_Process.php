<?php

include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
include_once __DIR__ . '/../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../imports/email/Email_Sending_Final.php';
include_once __DIR__ . '/../../imports/email/Email_Send.php';
include_once __DIR__ . '/../../imports/sms/SMS_Sending.php';
include_once __DIR__ . '/../../Controller/Main/main_user_login/main_user_login_LIST.php';
include_once __DIR__ . '/../../Controller/Main/main_user_login/main_user_login_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/Main/main_user_login_device/main_user_login_device_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/Main/main_user_password_reset_otp/main_user_password_reset_otp_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/Main/main_user_password_reset_otp/main_user_password_reset_otp_LIST.php';
include_once __DIR__ . '/../../Controller/wwjm_member_list/wwjm_member_list_LIST.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

function forgot_password_response($status, $message, array $extra = [])
{
    echo json_encode(array_merge([
        'status' => $status,
        'message' => $message,
    ], $extra));
    exit;
}

function forgot_password_normalize_phone($phone)
{
    $digits = preg_replace('/[^0-9]/', '', (string) $phone);
    if (strpos($digits, '94') === 0 && strlen($digits) === 11) {
        return '0' . substr($digits, 2);
    }
    return $digits;
}

function forgot_password_email_matches($requestedEmail, $storedEmail)
{
    $requested = strtolower(trim((string) $requestedEmail));
    $stored = strtolower(trim((string) $storedEmail));

    return $requested !== '' && $stored !== '' && hash_equals($requested, $stored);
}

function forgot_password_active_accounts()
{
    $loginList = new main_user_login_LIST();
    $loginList->filter_by_account_active_state(1);
    $loginList->filter_by_full_block(0);

    $accounts = [];
    $loginResult = $loginList->get_result();
    while ($loginResult && $account = $loginResult->fetch_assoc()) {
        $accounts[(int) $account['id']] = $account;
    }

    return $accounts;
}

function forgot_password_find_account_by_id($userId)
{
    $loginList = new main_user_login_LIST();
    $loginList->filter_by_id((int) $userId);
    $loginList->filter_by_account_active_state(1);
    $loginList->filter_by_full_block(0);
    $loginList->set_data_limits(0, 1);
    $result = $loginList->get_result();

    return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function forgot_password_valid_request_token($requestToken)
{
    return preg_match('/^[a-f0-9]{64}$/', (string) $requestToken) === 1;
}

function forgot_password_find_reset_record($requestToken, $onlyActive = false, $onlyVerified = false)
{
    if (!forgot_password_valid_request_token($requestToken)) {
        return null;
    }

    $resetList = new main_user_password_reset_otp_LIST();
    $resetList->filter_by_request_token_hash(hash('sha256', $requestToken));
    if ($onlyActive) {
        $resetList->filter_by_not_used();
        $resetList->filter_by_not_expired();
    }
    if ($onlyVerified) {
        $resetList->filter_by_verified();
    }
    $resetList->set_data_limits(0, 1);
    $result = $resetList->get_result();

    return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function forgot_password_find_account($method, $identifier)
{
    if ($method === 'email') {
        $loginList = new main_user_login_LIST();
        $loginList->filter_by_account_active_state(1);
        $loginList->filter_by_full_block(0);
        $loginList->filter_by_user_name($identifier);
        $loginList->set_data_limits(0, 1);
        $result = $loginList->get_result();
        if ($result && $result->num_rows > 0) {
            $account = $result->fetch_assoc();
            $account['reset_email'] = $account['user_name'];
            return $account;
        }
    }

    $requestedPhone = forgot_password_normalize_phone($identifier);
    $accounts = forgot_password_active_accounts();

    if ($method === 'sms') {
        foreach ($accounts as $account) {
            if (
                $requestedPhone !== ''
                && hash_equals($requestedPhone, forgot_password_normalize_phone($account['phone_number'] ?? ''))
            ) {
                $account['matched_phone'] = $account['phone_number'];
                return $account;
            }
        }
    }

    if (!$accounts) {
        return null;
    }

    $memberList = new wwjm_member_list_LIST();
    $memberResult = $memberList->get_result();
    while ($memberResult && $member = $memberResult->fetch_assoc()) {
        $loginId = (int) ($member['main_user_login_id'] ?? 0);
        if (!isset($accounts[$loginId])) {
            continue;
        }

        $account = $accounts[$loginId];
        if ($method === 'email') {
            foreach (['email', 'notification_email'] as $column) {
                if (forgot_password_email_matches($identifier, $member[$column] ?? '')) {
                    $account['reset_email'] = $member[$column];
                    return $account;
                }
            }
            continue;
        }

        foreach (['phone_mobile', 'notification_moible_no', 'secondry_mobile', 'notification_whatup'] as $column) {
            if (
                $requestedPhone !== ''
                && hash_equals($requestedPhone, forgot_password_normalize_phone($member[$column] ?? ''))
            ) {
                $account['matched_phone'] = $member[$column];
                return $account;
            }
        }
    }

    return null;
}

function forgot_password_sms_succeeded($response)
{
    if ($response === false || trim((string) $response) === '') {
        return false;
    }

    $data = json_decode((string) $response, true);
    if (is_array($data)) {
        if (array_key_exists('error', $data)) {
            $error = $data['error'];
            if ($error === false || $error === 0 || $error === '0' || $error === null || $error === '') {
                return true;
            }
            if ($error === true || $error === 1 || $error === '1') {
                return false;
            }
        }

        if (array_key_exists('success', $data)) {
            return filter_var($data['success'], FILTER_VALIDATE_BOOLEAN);
        }

        if (array_key_exists('status', $data)) {
            if (is_bool($data['status'])) {
                return $data['status'];
            }

            $status = strtolower(trim((string) $data['status']));
            if (in_array($status, ['success', 'sent', 'ok', 'queued', 'accepted', 'true', '1', '200'], true)) {
                return true;
            }
            if (in_array($status, ['error', 'failed', 'failure', 'false', '0'], true)) {
                return false;
            }
        }

        $message = strtolower((string) ($data['message'] ?? ''));
        if (preg_match('/\b(sent|success|queued|accepted)\b/', $message)) {
            return true;
        }
        if (preg_match('/\b(failed|failure|invalid|rejected)\b/', $message)) {
            return false;
        }

        return true;
    }

    return !preg_match('/\b(error|failed|failure|invalid|rejected)\b/i', (string) $response);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    forgot_password_response('error', 'Invalid password reset request.');
}

$csrfToken = isset($_POST['csrf_token']) ? (string) $_POST['csrf_token'] : '';
if (
    empty($_SESSION['forgot_password_csrf'])
    || empty($csrfToken)
    || !hash_equals($_SESSION['forgot_password_csrf'], $csrfToken)
) {
    forgot_password_response('error', 'Your reset session has expired. Refresh the page and try again.');
}

$action = isset($_POST['action']) ? trim((string) $_POST['action']) : '';

if ($action === 'request_code') {
    $method = isset($_POST['method']) ? trim((string) $_POST['method']) : '';
    $identifier = isset($_POST['identifier']) ? trim((string) $_POST['identifier']) : '';

    if (!in_array($method, ['email', 'sms'], true)) {
        forgot_password_response('error', 'Select a valid reset method.');
    }
    if ($identifier === '') {
        forgot_password_response('error', 'Enter your registered contact detail.');
    }
    if ($method === 'email' && !filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        forgot_password_response('error', 'Enter a valid email address.');
    }
    if ($method === 'sms' && strlen(forgot_password_normalize_phone($identifier)) < 9) {
        forgot_password_response('error', 'Enter a valid mobile number.');
    }

    $lastRequest = isset($_SESSION['forgot_password_last_request'])
        ? (int) $_SESSION['forgot_password_last_request']
        : 0;
    if ($lastRequest > 0 && time() - $lastRequest < 60) {
        forgot_password_response('error', 'Please wait before requesting another code.');
    }

    $_SESSION['forgot_password_last_request'] = time();
    $account = forgot_password_find_account($method, $identifier);
    $otp = (string) random_int(100000, 999999);
    $requestToken = bin2hex(random_bytes(32));
    $requestTokenHash = hash('sha256', $requestToken);
    $otpHash = password_hash($otp, PASSWORD_DEFAULT);
    $displayName = $account && trim((string) ($account['name_show'] ?? '')) !== ''
        ? trim((string) $account['name_show'])
        : 'Member';
    $delivered = false;
    $resetRecord = null;

    if ($account) {
        try {
            $resetRecord = new main_user_password_reset_otp_ADD_UPDATE((int) $account['id']);
            $resetRecord->invalidate_active_records((int) $account['id']);
            $expiresAt = new DateTimeImmutable('now', new DateTimeZone('Asia/Colombo'));
            $resetRecord->set_data(
                $requestTokenHash,
                $otpHash,
                $method,
                $expiresAt->modify('+10 minutes')->format('Y-m-d H:i:s')
            );

            if (!$resetRecord->process_new_record()) {
                throw new RuntimeException($resetRecord->get_error() ?: 'Reset record could not be created.');
            }

            if ($method === 'email') {
                $safeName = htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8');
                $safeOtp = htmlspecialchars($otp, ENT_QUOTES, 'UTF-8');
                $body = '<p>Dear ' . $safeName . ',</p>'
                    . '<p>Your WWJM password reset code is:</p>'
                    . '<p style="font-size:26px;font-weight:700;letter-spacing:6px;color:#0B2E24;">' . $safeOtp . '</p>'
                    . '<p>This code expires in 10 minutes. If you did not request it, you can ignore this email.</p>';
                $emailAddress = (string) ($account['reset_email'] ?? $account['user_name']);
                $mailer = new Email($emailAddress, 'WWJM password reset code', $body);
                $delivered = (bool) $mailer->send_email();
            } else {
                $mobileNumber = (string) ($account['matched_phone'] ?? $identifier);
                $sms = new SMS_Sending(
                    $mobileNumber,
                    'Your WWJM password reset code is ' . $otp . '. It expires in 10 minutes. Do not share this code.'
                );
                $delivered = forgot_password_sms_succeeded($sms->send_message());
            }
        } catch (Throwable $exception) {
            error_log('[Forgot Password] Request code failed: ' . $exception->getMessage());
            if ($resetRecord && $resetRecord->get_id() > 0) {
                $resetRecord->mark_used($resetRecord->get_id());
            }
            forgot_password_response('error', 'The reset code could not be created or delivered. Please try again.');
        }
    }

    if ($account && !$delivered) {
        if ($resetRecord) {
            $resetRecord->mark_used($resetRecord->get_id());
        }
        forgot_password_response('error', 'The reset code could not be delivered. Please try another method or contact the mosque office.');
    }

    forgot_password_response(
        'success',
        'If the account exists, a six-digit reset code has been sent.',
        [
            'next_step' => 'verify',
            'reset_token' => $requestToken,
        ]
    );
}

if ($action === 'verify_code') {
    $code = isset($_POST['code']) ? preg_replace('/[^0-9]/', '', (string) $_POST['code']) : '';
    $requestToken = isset($_POST['reset_token']) ? strtolower(trim((string) $_POST['reset_token'])) : '';

    if (strlen($code) !== 6) {
        forgot_password_response('error', 'Enter the complete six-digit code.');
    }
    if (!forgot_password_valid_request_token($requestToken)) {
        forgot_password_response('error', 'The verification code is incorrect or has expired.');
    }

    $reset = forgot_password_find_reset_record($requestToken, true);
    if (!$reset) {
        forgot_password_response('error', 'The verification code is incorrect or has expired.');
    }

    $resetUpdate = new main_user_password_reset_otp_ADD_UPDATE((int) $reset['main_user_login_id']);
    $currentAttempts = (int) ($reset['attempts'] ?? 0);
    if ($reset['attempts'] === null) {
        $resetUpdate->set_id((int) $reset['id']);
        $resetUpdate->set_attempts(0);
        if (!$resetUpdate->process_update()) {
            error_log('[Forgot Password] NULL attempt normalization failed: ' . $resetUpdate->get_error());
            forgot_password_response('error', 'The verification attempt could not be processed. Please try again.');
        }
    }

    if ($currentAttempts >= 5) {
        $resetUpdate->mark_used((int) $reset['id']);
        forgot_password_response('error', 'Too many incorrect attempts. Request a new code.');
    }

    if (!password_verify($code, (string) $reset['otp_hash'])) {
        $newAttempts = $currentAttempts + 1;
        $resetUpdate->set_id((int) $reset['id']);
        $resetUpdate->set_attempts($newAttempts);

        if (!$resetUpdate->process_update()) {
            error_log('[Forgot Password] Attempt count update failed: ' . $resetUpdate->get_error());
            forgot_password_response('error', 'The verification attempt could not be recorded. Please try again.');
        }

        if ($newAttempts >= 5) {
            $resetUpdate->mark_used((int) $reset['id']);
            forgot_password_response('error', 'Too many incorrect attempts. Request a new code.');
        }
        forgot_password_response('error', 'The verification code is incorrect.');
    }

    if (!$resetUpdate->mark_verified((int) $reset['id'])) {
        forgot_password_response('error', 'The reset code has expired. Request a new code.');
    }

    forgot_password_response('success', 'Code verified. Choose your new password.', ['next_step' => 'reset']);
}

if ($action === 'reset_password') {
    $newPassword = isset($_POST['new_password']) ? (string) $_POST['new_password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? (string) $_POST['confirm_password'] : '';
    $requestToken = isset($_POST['reset_token']) ? strtolower(trim((string) $_POST['reset_token'])) : '';

    if (strlen($newPassword) < 8) {
        forgot_password_response('error', 'Your new password must contain at least 8 characters.');
    }
    if (!hash_equals($newPassword, $confirmPassword)) {
        forgot_password_response('error', 'The password confirmation does not match.');
    }

    $reset = forgot_password_find_reset_record($requestToken, true, true);
    if (!$reset) {
        forgot_password_response('error', 'Your verified reset request has expired. Request a new code.');
    }

    $account = forgot_password_find_account_by_id((int) $reset['main_user_login_id']);
    if (!$account) {
        forgot_password_response('error', 'The account is not available for password reset.');
    }

    $security = new Advance_Security();
    $encryptedPassword = $security->get_data_encrypt((string) $account['user_name'], $newPassword);
    $userId = (int) $account['id'];
    $resetUpdate = new main_user_password_reset_otp_ADD_UPDATE($userId);

    try {
        if (!$resetUpdate->mark_used((int) $reset['id'])) {
            throw new RuntimeException('Reset request was already used.');
        }

        $loginUpdate = new main_user_login_ADD_UPDATE();
        $loginUpdate->set_id($userId);
        $loginUpdate->set_password($encryptedPassword);
        $loginUpdate->set_cook_key('NO_DATA');
        $loginUpdate->set_ref_key('NO_DATA');
        $loginUpdate->set_wrong_login_count(0);
        $loginUpdate->is_not_temp_lock();

        if (!$loginUpdate->process_update()) {
            throw new RuntimeException('Account password could not be updated.');
        }

        $deviceUpdate = new main_user_login_device_ADD_UPDATE();
        if (!$deviceUpdate->deactivate_all_devices($userId)) {
            error_log('[Forgot Password] Password changed but device sessions could not be invalidated for user ' . $userId);
        }
    } catch (Throwable $exception) {
        error_log('[Forgot Password] ' . $exception->getMessage());
        forgot_password_response('error', 'Password could not be updated. Please request a new code and try again.');
    }

    unset($_SESSION['forgot_password_last_request']);
    session_regenerate_id(true);
    $_SESSION['forgot_password_csrf'] = bin2hex(random_bytes(32));

    forgot_password_response(
        'success',
        'Your password has been changed. You can now sign in.',
        ['next_step' => 'complete']
    );
}

forgot_password_response('error', 'Invalid password reset action.');
