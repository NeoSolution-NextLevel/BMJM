<?php
session_start();
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';

$id = isset($_POST['id']) ? trim($_POST['id']) : "";

if($id != "" && $id != "0") {
    $db = new DataBase();
    // System soft delete of master project and its cascade dependencies
    $db->get_result("UPDATE wwjm_projects_collection_list SET ast = 0 WHERE id = '$id'");
    $db->get_result("UPDATE collection_ticket_tiers SET ast = 0 WHERE wwjm_projects_collection_list_id = '$id'");
    $db->get_result("UPDATE collection_bank_account SET ast = 0 WHERE wwjm_projects_collection_list_id = '$id'");
    echo "1";
} else {
    echo "Fatal: Unique ID Missing for removal pipeline.";
}
?>
