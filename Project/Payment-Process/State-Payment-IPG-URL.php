<?php
include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';

include_once '../Controller/IPG_Send_By_URL/IPG_Send_By_URL_SINGLE_DATA_by_ipg_transaction_id.php';
include_once '../Controller/IPG_Send_By_URL/IPG_Send_By_URL_ADD_UPDATE.php';

$inputJSON = file_get_contents('php://input');
$firts_letter = substr($inputJSON, 0, 1);

if ($firts_letter == "{") {
    // Standard JSON payload
} else {
    $json = array();
    $split = explode("&", $inputJSON);
    for ($i = 0; $i < count($split); $i++) {
        $split_scond = explode("=", $split[$i]);
        if (isset($split_scond[1])) {
            $json[$split_scond[0]] = $split_scond[1];
        }
    }
    $inputJSON = json_encode($json);
}

$input = json_decode($inputJSON, TRUE);

if (isset($input['transaction_id'])) {
    $get_ipg_transaction_id = $input['transaction_id'];

    $single_data_obj = new IPG_Send_By_URL_SINGLE_DATA_by_ipg_transaction_id($get_ipg_transaction_id);

    if ($single_data_obj->get_state()) {
        $update_obj = new IPG_Send_By_URL_ADD_UPDATE();
        $update_obj->set_id($single_data_obj->get_id());

        if ($input['status'] == "1") {
            $update_obj->set_transaction_payment_success();
            // TODO: If you want to deduct from the member balance directly, query the wwjm_member_list using bmjm_member_list_has_IPG_Send_By_URL mapping here!
        } else if ($input['status'] == "0") {
            $update_obj->set_transaction_payment_fail();
        }

        $update_obj->process_update();
        
        echo json_encode(["status" => "success", "message" => "Updated Status"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to find transaction id"]);
    }
}
