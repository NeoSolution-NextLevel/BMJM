<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../Controller/member_register/wwjm_member_list/wwjm_member_list_LIST.php';

$Advance_Security_Key_List_obj = new Advance_Security_Key_List();
$Advance_Security_obj = new Advance_Security();

$member_list = new wwjm_member_list_LIST();
$get_result = $member_list->get_dashboard_data();

$json = array();

if ($get_result && $get_result->num_rows > 0) {
    while ($row = $get_result->fetch_assoc()) {
        $amount = (float)$row['monlty_payment'];
        
        $status = "pending";
        $round = 1;
        
        if ($row['approve_level_01_state'] == '1' && $row['approve_level_02_state'] == '1') {
            $status = "approved";
        } else if ($row['approve_level_01_state'] == '1' && $row['approve_level_02_state'] == '0') {
            $status = "pending";
            $round = 2;
        } else {
            $status = "pending";
            $round = 1;
        }
        
        $encrypted_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_member_list_key(), $row['id']);

        $json[] = [
            "id" => $encrypted_id,
            "raw_id" => $row['id'],
            "name" => $row['name_M'] ? $row['name_M'] : "Unknown",
            "road" => $row['road_name'] ? $row['road_name'] : "Unknown",
            "amount" => $amount,
            "status" => $status,
            "round" => $round
        ];
    }
}

echo json_encode($json);
