<?php

include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/User-Login/User_Details_Update.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA.php';

$json = array();
$state = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_id = isset($_POST['id']) ? $_POST['id'] : "";
    $member_obj = new wwjm_member_list_SINGLE_DATA($member_id);
    $user_id = $member_obj->get_main_user_login_id();
    if (empty($user_id)) {
        $state['error'] = "Invalid member ID.";
        $json[] = $state;
        echo json_encode($json);
        exit;
    }
    $user_details_update = new User_Details_Update($user_id);
    $result = $user_details_update->change_fully_block();
    if ($result) {
        $json['status'] = "success";
    } else {
        $state['error'] = $user_details_update->get_error();
    }

} else {
    $state['error'] = "Invalid verification request.";
}

$json[] = $state;
echo json_encode($json);
?>
