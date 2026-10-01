<?php
require_once __DIR__ . '/notification-config.php';
require_once __DIR__ . '/fcm.php';
require_once __DIR__ . '/../../Controller/notification/notifications_ADD_UPDATE.php';
require_once __DIR__ . '/../../Controller/notification/notification_inbox_ADD_UPDATE.php';
require_once __DIR__ . '/../../Controller/notification/fcm_tokens_LIST.php';

function bmjm_subscription_audiences()
{
    return [
        'subscription' => 'Subscription members',
        'monthly' => 'Subscription members',
        'zakath_payee' => 'Zakath payers',
        'zakath' => 'Zakath payers',
        'zakath_receiver' => 'Zakath receivers',
    ];
}

function bmjm_normalize_audience($audience, $subscriptionId = '')
{
    $audience = trim((string) $audience);
    $subscriptionId = trim((string) $subscriptionId);

    if ($audience === 'subscription' || $audience === 'zakath_payee' || $audience === 'zakath' || $audience === 'zakath_receiver') {
        return ['subscription', $audience === 'zakath' ? 'zakath_payee' : $audience];
    }

    if ($subscriptionId !== '' && isset(bmjm_subscription_audiences()[$subscriptionId])) {
        return ['subscription', $subscriptionId === 'zakath' ? 'zakath_payee' : $subscriptionId];
    }

    return ['all', ''];
}

function bmjm_dispatch_admin_notification($type, $title, $body, $subscriptionId = '', $senderId = 0, $image_pth = '')
{
    $type = trim((string) $type);
    $title = trim((string) $title);
    $body = trim((string) $body);
    $subscriptionId = trim((string) $subscriptionId);
    $image_pth = trim((string) $image_pth);
    $senderId = (int) $senderId;

    if (!in_array($type, ['all', 'subscription'], true)) {
        return ['ok' => false, 'error' => 'type must be all or subscription'];
    }
    if ($title === '' || $body === '') {
        return ['ok' => false, 'error' => 'Title and body are required'];
    }
    if ($type === 'subscription') {
        $audiences = bmjm_subscription_audiences();
        if ($subscriptionId === '' || !isset($audiences[$subscriptionId])) {
            return ['ok' => false, 'error' => 'A valid subscription audience is required'];
        }
        if ($subscriptionId === 'monthly') {
            $subscriptionId = 'subscription';
        }
        if ($subscriptionId === 'zakath') {
            $subscriptionId = 'zakath_payee';
        }
    } else {
        $subscriptionId = '';
    }

    $notification_obj = new notifications_ADD_UPDATE();
    $notification_obj->set_data($type, $title, $body, $subscriptionId, $senderId, $image_pth);
    if (!$notification_obj->process_new_record()) {
        return ['ok' => false, 'error' => 'Notification save failed'];
    }

    $notificationId = (int) $notification_obj->get_id();
    if ($notificationId <= 0) {
        return ['ok' => false, 'error' => 'Notification saved without an id. Check the notifications.id column is AUTO_INCREMENT.'];
    }

    $token_list_obj = new fcm_tokens_LIST();
    $memberIds = $type === 'all'
        ? $token_list_obj->get_all_member_ids()
        : $token_list_obj->get_subscription_member_ids($subscriptionId);

    $inbox_obj = new notification_inbox_ADD_UPDATE();
    $inboxSaved = $inbox_obj->process_member_list($notificationId, $memberIds);
    $inboxCount = $inbox_obj->get_processed_count();

    $tokens = $token_list_obj->get_tokens_from_member_ids($memberIds);
    $push_image_pth = bmjm_notification_public_image_pth($image_pth);
    $push = [
        'stored' => true,
        'sent' => false,
        'token_count' => count($tokens),
        'inbox_saved' => (bool) $inboxSaved,
    ];

    try {
        if ($tokens) {
            bmjm_fcm_notify_tokens($tokens, $title, $body, [
                'type' => $type,
                'notification_id' => (string) $notificationId,
                'subscription_id' => $subscriptionId,
            ], $push_image_pth);
            $push['sent'] = true;
        } else {
            $push['note'] = 'Saved to inbox. No app tokens registered yet. Open the member app after login, then send again.';
        }
    } catch (Throwable $e) {
        $push['error'] = $e->getMessage();
    }

    if (!$memberIds) {
        $push['note'] = 'Notification saved, but no active members were found for notification_inbox.';
    } elseif (!$inboxSaved) {
        $inboxError = trim((string) $inbox_obj->get_error());
        if (empty($push['error'])) {
            $push['error'] = $inboxError !== ''
                ? $inboxError
                : 'One or more inbox rows were not created. Check notification_inbox constraints.';
        }
    }

    return [
        'ok' => true,
        'notification_id' => $notificationId,
        'image_pth' => $image_pth,
        'recipients' => count($memberIds),
        'inbox_count' => $inboxCount,
        'token_count' => count($tokens),
        'push' => $push,
    ];
}
