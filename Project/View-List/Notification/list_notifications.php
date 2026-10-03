<?php
require_once __DIR__ . '/../../imports/notification/notification-config.php';
require_once __DIR__ . '/../../Controller/notification/notification_inbox_LIST.php';

$memberId = bmjm_require_member_login();
$notification_list_obj = new notification_inbox_LIST();
$notification_list_obj->set_member_list_id($memberId);

$notifications = $notification_list_obj->get_notifications_array();
foreach ($notifications as &$item) {
    $item['image_url'] = bmjm_notification_public_image_pth($item['image_pth'] ?? '');
}
unset($item);

bmjm_json([
    'ok' => true,
    'count' => count($notifications),
    'notifications' => $notifications,
]);
