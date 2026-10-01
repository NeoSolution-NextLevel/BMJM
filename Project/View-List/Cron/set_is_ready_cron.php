<?php

include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
include_once __DIR__ . '/../../Controller/sms_campain_details/sms_campain_details_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/sms_campain_details/CampaignSendCronController.php';


$cronController = new SubscriptionSendCronController();

$slTime = new DateTime('now', new DateTimeZone('Asia/Colombo'));
$now = $slTime->format('Y-m-d H:i:s');

// Check the scheduled date and time. If it has arrived, set is_ready = 1 for pending numbers
$cronController->markReadyForToday($now);

?>
