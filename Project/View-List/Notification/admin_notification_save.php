<?php

require_once __DIR__ . '/../../imports/notification/notification-config.php';
require_once __DIR__ . '/../../imports/notification/notification_dispatch.php';

$senderId = bmjm_require_main_user_login();
if (!bmjm_is_admin()) {
    bmjm_json(['status' => 'error', 'message' => 'Only admin can send notifications'], 403);
}

$title = trim($_POST['title'] ?? '');
$body = trim($_POST['message'] ?? ($_POST['body'] ?? ''));
$audience = trim($_POST['audience'] ?? 'all_members');
$actionType = trim($_POST['action_type'] ?? 'send_now');
$subscriptionId = trim($_POST['subscription_id'] ?? '');
$image_pth = trim($_POST['image_pth'] ?? ($_POST['image_path'] ?? ''));

if ($title === '' || $body === '') {
    bmjm_json(['status' => 'error', 'message' => 'Please enter a title and message.'], 400);
}

if ($actionType === 'schedule') {
    bmjm_json(['status' => 'error', 'message' => 'Schedule is not available with the current notification table.'], 400);
}

list($type, $normalizedSubscriptionId) = bmjm_normalize_audience($audience, $subscriptionId);

if ($image_pth === '' && isset($_FILES['notification_image']) && $_FILES['notification_image']['error'] !== UPLOAD_ERR_NO_FILE) {
    $file = $_FILES['notification_image'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $maxFileSize = 5242880;

    if (!in_array($fileExt, $allowed, true)) {
        bmjm_json(['status' => 'error', 'message' => 'Invalid image file type.'], 400);
    }
    if ($file['error'] !== UPLOAD_ERR_OK) {
        bmjm_json(['status' => 'error', 'message' => 'Image upload failed.'], 400);
    }
    if ((int) $file['size'] > $maxFileSize) {
        bmjm_json(['status' => 'error', 'message' => 'Image size must be 5MB or less.'], 400);
    }

    $uploadDir = __DIR__ . '/../../Data/Notifications/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = 'notification_' . date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $fileExt;
    $destination = $uploadDir . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        bmjm_json(['status' => 'error', 'message' => 'Could not save uploaded image.'], 500);
    }

    $image_pth = 'Data/Notifications/' . $fileName;
}

try {
    $result = bmjm_dispatch_admin_notification($type, $title, $body, $normalizedSubscriptionId, $senderId, $image_pth);
} catch (Throwable $e) {
    bmjm_json([
        'status' => 'error',
        'message' => 'Notification save failed: ' . $e->getMessage(),
    ], 200);
}

if (empty($result['ok'])) {
    bmjm_json(['status' => 'error', 'message' => $result['error'] ?? 'Notification save failed'], 200);
}

$inboxCount = (int) ($result['inbox_count'] ?? $result['recipients'] ?? 0);
$tokenCount = (int) ($result['token_count'] ?? ($result['push']['token_count'] ?? 0));
$message = 'Notification saved for ' . $inboxCount . ' member inbox row' . ($inboxCount === 1 ? '' : 's') . '.';
if (!empty($result['push']['error'])) {
    $message .= ' Push failed: ' . $result['push']['error'];
} elseif ($tokenCount > 0 && !empty($result['push']['sent'])) {
    $message .= ' App push sent to ' . $tokenCount . ' device' . ($tokenCount === 1 ? '' : 's') . '.';
} elseif (!empty($result['push']['note'])) {
    $message .= ' ' . $result['push']['note'];
}

bmjm_json([
    'status' => empty($result['push']['error']) ? 'success' : 'warning',
    'message' => $message,
    'notification_id' => $result['notification_id'],
    'image_pth' => $result['image_pth'],
    'target_count' => $result['recipients'],
    'inbox_count' => $inboxCount,
    'token_count' => $tokenCount,
]);
