<?php
require_once __DIR__ . '/../../imports/notification/notification-config.php';
require_once __DIR__ . '/../../Controller/notification/notification_inbox_ADD_UPDATE.php';

$memberId = wwjm_require_member_login();
$notificationId = (int) ($_POST['notification_id'] ?? 0);
if ($notificationId <= 0) {
    wwjm_json(['ok' => false, 'error' => 'notification_id is required'], 400);
}

$inbox_obj = new notification_inbox_ADD_UPDATE();
if (!$inbox_obj->mark_read($notificationId, $memberId)) {
    wwjm_json(['ok' => false, 'error' => 'Notification update failed'], 500);
}

wwjm_json(['ok' => true]);
