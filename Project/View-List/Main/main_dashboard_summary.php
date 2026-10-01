<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/Main/Cook_Managment/Cook_Managing.php';
include_once '../../UxUI-Back/Needs/Check_User_Login.php';
include_once '../../Controller/dashboard/main_dashboard_summary.php';

header('Content-Type: application/json');
bmjm_require_access(1);

$summary_obj = new main_dashboard_summary();
echo json_encode(array(
    'status' => 'success',
    'summary' => $summary_obj->get_summary()
));
