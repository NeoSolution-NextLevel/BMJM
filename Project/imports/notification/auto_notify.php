<?php
require_once __DIR__ . '/notification-config.php';
require_once __DIR__ . '/fcm.php';
require_once __DIR__ . '/../need/DB.php';
require_once __DIR__ . '/../../Controller/notification/notifications_ADD_UPDATE.php';
require_once __DIR__ . '/../../Controller/notification/notification_inbox_ADD_UPDATE.php';
require_once __DIR__ . '/../../Controller/notification/fcm_tokens_LIST.php';

function bmjm_auto_notify(array $memberIds, $title, $body, $eventKey = '', $image_pth = '') {
    $memberIds = array_values(array_unique(array_filter(array_map('intval', $memberIds))));
    if (!$memberIds || trim($title) === '' || trim($body) === '') {
        return false;
    }

    $type = 'auto';
    $event = trim($eventKey);
    $image_pth = trim($image_pth);
    $senderId = bmjm_current_main_user_login_id();
    $notification_obj = new notifications_ADD_UPDATE();
    $notification_obj->set_data($type, $title, $body, $event, $senderId > 0 ? $senderId : null, $image_pth);
    if (!$notification_obj->process_new_record()) {
        return false;
    }
    $notificationId = (int) $notification_obj->get_id();

    $inbox_obj = new notification_inbox_ADD_UPDATE();
    $inbox_obj->process_member_list($notificationId, $memberIds);

    $token_list_obj = new fcm_tokens_LIST();
    $tokens = $token_list_obj->get_tokens_from_member_ids($memberIds);
    $push_image_pth = bmjm_notification_public_image_pth($image_pth);

    if ($tokens) {
        try {
            bmjm_fcm_notify_tokens($tokens, $title, $body, [
                'type' => 'auto',
                'event' => $event,
                'notification_id' => (string) $notificationId,
            ], $push_image_pth);
        } catch (Exception $e) {
            error_log('bmjm auto notify push failed: ' . $e->getMessage());
        }
    }

    return $notificationId;
}

function bmjm_notify_payment_received($memberId, $amount = '')
{
    $memberId = (int) $memberId;
    if ($memberId <= 0) {
        return false;
    }

    $amount = trim((string) $amount);
    $body = 'Thank you. Your payment has been recorded.';
    if ($amount !== '') {
        $body .= ' Amount: Rs. ' . $amount . '.';
    }

    return bmjm_auto_notify([$memberId], 'Payment received', $body, 'payment_received');
}

function bmjm_notify_payment_for_slip($paymentSlipId, $amount = '')
{
    $paymentSlipId = (int) $paymentSlipId;
    if ($paymentSlipId <= 0) {
        return false;
    }

    $data_base_obj = new DataBase();
    $result = $data_base_obj->get_result(
        "select wwjm_member_list_id from wwjm_member_payment_slilp where wwjm_payment_slip_id='" . addslashes($paymentSlipId) . "' limit 1"
    );
    if (!$result || !($row = $result->fetch_assoc())) {
        return false;
    }

    return bmjm_notify_payment_received($row['wwjm_member_list_id'], $amount);
}
