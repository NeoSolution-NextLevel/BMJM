<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_LIST.php';
include_once __DIR__ . '/../../Controller/income_expence_data_info_list/income_expence_data_info_list_LIST.php';

$json = array();

$type_list_obj = new income_expence_type_LIST();
$type_list_obj->get_all_data();
$type_list_obj->filter_by_is_expece_type();
$type_result = $type_list_obj->get_result();

if ($type_result) {
    while ($t_row = $type_result->fetch_assoc()) {
        $type_id = $t_row['id'];
        
        $data_list_obj = new income_expence_data_info_list_LIST();
        $data_list_obj->get_all_data();
        $data_list_obj->filter_by_is_type_of_expence();
        $data_list_obj->filter_by_income_expence_type_id($type_id);
        $data_result = $data_list_obj->get_result();
        
        $total_amount = 0;
        if ($data_result) {
            while ($d_row = $data_result->fetch_assoc()) {
                $total_amount += floatval($d_row['amount']);
            }
        }
        
        $json[] = array(
            'id' => $type_id,
            'type_name' => $t_row['income_expence_type_name'],
            'total_amount' => $total_amount
        );
    }
}

echo json_encode($json);
?>
