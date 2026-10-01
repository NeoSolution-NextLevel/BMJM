<?php

require_once __DIR__ . '/../../imports/notification/notification-config.php';
require_once __DIR__ . '/../../Controller/notification/notifications_LIST.php';

wwjm_require_main_user_login();
if (!wwjm_is_admin()) {
    wwjm_json(['status' => 'error', 'message' => 'Only admin can view notifications'], 403);
}

$notification_list_obj = new notifications_LIST();
$page = isset($_POST['page']) ? max(1, (int) $_POST['page']) : 1;
$perPage = isset($_POST['per_page']) ? (int) $_POST['per_page'] : 10;
$search = trim($_POST['search'] ?? '');
$audience = trim($_POST['audience'] ?? 'all_members');
$sort = trim($_POST['sort'] ?? 'newest');
if (!in_array($perPage, [10, 25, 50, 100], true)) {
    $perPage = 10;
}

$notification_list_obj->set_search_text($search);
$notification_list_obj->set_audience_filter($audience);
$notification_list_obj->set_sort_key($sort);
$total = $notification_list_obj->get_count();
$totalPages = max(1, (int) ceil($total / $perPage));
if ($page > $totalPages) {
    $page = $totalPages;
}
$startPoint = ($page - 1) * $perPage;
$notification_list_obj->set_data_limits($startPoint, $perPage);

wwjm_json([
    'status' => 'success',
    'notifications' => $notification_list_obj->get_notifications_array(),
    'pagination' => [
        'page' => $page,
        'per_page' => $perPage,
        'total' => $total,
        'total_pages' => $totalPages,
    ],
]);
