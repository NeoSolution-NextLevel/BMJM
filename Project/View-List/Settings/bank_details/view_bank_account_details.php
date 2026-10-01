<?php
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';
include_once '../../../Controller/bank_account_details/bank_account_details_LIST.php';



$json = array();


$search_txt = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : "";



$bank_account_obj = new bank_account_details_LIST();

// if (($search_txt !== "")) {
//     $bank_account_obj->search_name($search_txt);
// }
$get_result = $bank_account_obj->get_result();

if ($get_result && $get_result->num_rows > 0) {
    while ($row = $get_result->fetch_assoc()) {
        $json[] = $row;
    }
}

echo json_encode($json);
