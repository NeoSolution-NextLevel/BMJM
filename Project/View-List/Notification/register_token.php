<?php
require_once __DIR__ . '/../../imports/notification/notification-config.php';
require_once __DIR__ . '/../../Controller/notification/fcm_tokens_ADD_UPDATE.php';

$memberId = bmjm_require_member_login();
$token = trim($_POST['token'] ?? '');
$platform = trim($_POST['platform'] ?? 'android');
$subscriptionId = trim($_POST['subscription_id'] ?? '');

if ($token === '') {
    bmjm_json(['ok' => false, 'error' => 'Missing token'], 400);
}

$fcm_token_obj = new fcm_tokens_ADD_UPDATE();
$fcm_token_obj->set_data($memberId, $token, $platform);
if (!$fcm_token_obj->process_new_record()) {
    bmjm_json(['ok' => false, 'error' => 'Token save failed'], 500);
}

bmjm_json([
    'ok' => true,
    'member_list_id' => $memberId,
    'topics' => [
        'all' => $GLOBALS['fcmAllTopic'],
        'subscription' => $subscriptionId !== '' ? $GLOBALS['fcmSubscriptionTopicPrefix'] . $subscriptionId : null,
    ],
]);
