<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_LIST.php';

$Advance_Security_Key_List_obj = new Advance_Security_Key_List();
$Advance_Security_obj = new Advance_Security();

$json = array();

$col_list = new wwjm_projects_collection_list_LIST();
$col_list->get_all_data();
// Apply descending logical sort limits to retrieve latest components first
$col_list->set_data_limits(0, 9999);
$result = $col_list->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $type = 'monthly';
        if ($row['is_end_date'] == 1 || $row['is_fix_budget'] == 1) {
            $type = 'special';
        }
        
        $json[] = array(
            'id' => $row['id'],
            'public_id' => $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $row['id']),
            'name' => $row['project_name'],
            'type' => $type,
            'is_hidden' => $row['is_members_only'] == 1 ? true : false,
            'image' => $row['image_pth'],
            'amount' => $row['collected_amount'] ? floatval($row['collected_amount']) : 0 
        );
    }
}

echo json_encode($json);
?>
