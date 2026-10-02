<?php
session_start();
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';
include_once '../../../imports/feature_flags/feature_flags.php';
include_once '../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$BMJM_FEATURE_COLLECTION) {
    bmjm_feature_guard(false, 'Collection Payment');
}

$id = isset($_POST['id']) ? trim($_POST['id']) : "";

if($id != "" && $id != "0") {
    $col = new wwjm_projects_collection_list_SINGLE_DATA($id);
    if($col->get_state()) {
        $cur = $col->get_is_members_only();
        $new_members = ($cur == 1) ? 0 : 1;
        $new_all = ($cur == 1) ? 1 : 0;
        
        $db = new DataBase();
        $db->get_result("UPDATE wwjm_projects_collection_list SET is_members_only = '$new_members', is_all_person = '$new_all' WHERE id = '$id'");
        echo "1";
    } else {
        echo "Could not discover target collection object in state tree.";
    }
} else {
    echo "Fatal: Unique ID Missing for visibility crossover mapping.";
}
?>
