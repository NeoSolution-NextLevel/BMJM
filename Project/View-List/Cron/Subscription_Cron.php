<?php

include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
include_once __DIR__ . '/../../imports/email/Email_Sending_Final.php';
include_once __DIR__ . '/../../imports/email/Email_Send.php';
include_once __DIR__ . '/../../imports/sms/SMS_Sending.php';
include_once __DIR__ . '/../../Controller/wwjm_member_list/SubscriptionSendCronController.php';

date_default_timezone_set('Asia/Colombo');

$dryRun = false;
if (PHP_SAPI === 'cli') {
    $dryRun = in_array('--dry-run', $argv, true);
} elseif (isset($_GET['dry_run'])) {
    $dryRun = filter_var($_GET['dry_run'], FILTER_VALIDATE_BOOLEAN);
}

try {
    $cronController = new SubscriptionSendCronController();
    $result = $cronController->generateForCurrentMonth($dryRun);
    $httpStatus = 200;
} catch (Throwable $exception) {
    error_log('[Subscription Cron] Fatal error: ' . $exception->getMessage());
    $httpStatus = 500;
    $result = [
        'status' => 'failed',
        'error' => $exception->getMessage(),
    ];
}

if (PHP_SAPI !== 'cli') {
    http_response_code($httpStatus);
    header('Content-Type: application/json; charset=utf-8');
}

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
