<?php
require_once __DIR__ . '/notification-config.php';
require_once __DIR__ . '/notification_dispatch.php';

$senderId = bmjm_require_main_user_login();
if (!bmjm_is_admin()) {
    bmjm_json(['ok' => false, 'error' => 'Only admin can send notifications'], 403);
}

$type = trim($_POST['type'] ?? '');
$title = trim($_POST['title'] ?? '');
$body = trim($_POST['body'] ?? '');
$subscriptionId = trim($_POST['subscription_id'] ?? '');
$image_pth = trim($_POST['image_pth'] ?? ($_POST['image_path'] ?? ''));

$result = bmjm_dispatch_admin_notification($type, $title, $body, $subscriptionId, $senderId, $image_pth);
if (empty($result['ok'])) {
    bmjm_json(['ok' => false, 'error' => $result['error'] ?? 'Send failed'], 400);
}

bmjm_json($result);
