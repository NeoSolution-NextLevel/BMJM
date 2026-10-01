<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/member_register/wwjm_road_name/wwjm_road_name_LIST.php';



$search_txt = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : (isset($_GET['search_txt']) ? trim($_GET['search_txt']) : "");
$road_name = isset($_POST['val_01']) ? trim($_POST['val_01']) : "";


$json = array();

$road_name_list = new wwjm_road_name_LIST();

if (($search_txt !== "") || ($road_name !== "")) {
    // echo $search_txt;
    $road_name_list->search_from_road_name($search_txt);
}

$get_result = $road_name_list->get_result();

if ($get_result && $get_result->num_rows > 0) {
    while ($row = $get_result->fetch_assoc()) {
        $json[] = $row;
    }
}

echo json_encode($json);
