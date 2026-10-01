<!-- This is sample code for read response for after each transaction. you need to host this file in your server and provide us url in our portal (callback url) -->

<!-- Sample response -> {'transaction_id': 'E2D51187B9A137DB7E867', 'pl_ref_no': '', 'status': 1, 'status_message': 'SUCCESS'} -->
<!--C:\xampp\htdocs\Statement_Management\Online-Payment-Pocess\Payment-State.php-->


<?php

include_once '../imports/need/session_setup.php';
include_once '../imports/need/DB.php';
include_once '../imports/Company_Info/Company_Info_Variable_List.php';

include_once '../Controllers/Statement/statement_doc_ipg_list/statement_doc_ipg_list_SINGLE_DATA_by_ipg_transaction_id.php';
include_once '../Controllers/Statement/statement_doc_ipg_list/statement_doc_ipg_list_ADD_UPDATE.php';



include_once '../imports/sms/SMS_Sending.php';
include_once '../imports/email/Email_Send.php';
include_once '../imports/email/Email_Sending_Final.php';

include_once '../imports/security/encrypt_decrypt.php';
include_once '../imports/security/key_list.php';

$inputJSON = file_get_contents('php://input');
$firts_letter = substr($inputJSON, 0, 1);
//mail("ansif@neosolution.lk", "Joson", $inputJSON);
$company_obj = new Company_Info_Variable_List();

if ($firts_letter == "{") {
    //    echo "ok";
} else {
    $json = array();
    $split = explode("&", $inputJSON);
    $create_new_array = array();
    for ($i = 0; $i < count($split); $i++) {
        $split_scond = explode("=", $split[$i]);
        $json[$split_scond[0]] = $split_scond[1];
    }
    $inputJSON = json_encode($json);
}


//
$input = json_decode($inputJSON, TRUE);
$get_ipg_transaction_id = "0";

//$get_ipg_transaction_id = "AOTC118E521C3D75653F2";
//$input['status'] = "0";

if (isset($input['transaction_id'])) {
    $get_ipg_transaction_id = $input['transaction_id'];

    $statement_doc_ipg_list_SINGLE_DATA_by_ipg_transaction_id_obj = new statement_doc_ipg_list_SINGLE_DATA_by_ipg_transaction_id($get_ipg_transaction_id);

    if ($statement_doc_ipg_list_SINGLE_DATA_by_ipg_transaction_id_obj->get_state()) {

        $statement_doc_ipg_list_ADD_UPDATE_obj = new statement_doc_ipg_list_ADD_UPDATE();
        $statement_doc_ipg_list_ADD_UPDATE_obj->set_id($statement_doc_ipg_list_SINGLE_DATA_by_ipg_transaction_id_obj->get_id());



        //-------------------statemnte data----------------------------------------

        if ($input['status'] == "1") {
            $statement_doc_ipg_list_ADD_UPDATE_obj->set_transaction_payment_sucess();



            //send email 
        } else if ($input['status'] == "0") {
            $statement_doc_ipg_list_ADD_UPDATE_obj->set_transaction_payment_fail("One Pay Error");


            //send email 
        }

        //===========payment voucher=======================

        $statement_doc_ipg_list_ADD_UPDATE_obj->process_update();
    } else {

        echo "Faild to find transaction id ";
    }
}
