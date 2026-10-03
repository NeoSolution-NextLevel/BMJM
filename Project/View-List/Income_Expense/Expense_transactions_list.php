<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_LIST.php';
include_once __DIR__ . '/../../Controller/income_expence_data_info_list/income_expence_data_info_list_LIST.php';

$json = array(
    'category_name' => 'Unknown',
    'transactions' => array()
);

$type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

if ($type_id > 0) {
    // Get category name safely using MVC controller
    $type_obj = new income_expence_type_LIST();
    $type_obj->get_all_data();
    $type_obj->filter_by_id($type_id);
    $type_res = $type_obj->get_result();
    
    if ($type_res && $row = $type_res->fetch_assoc()) {
        $json['category_name'] = $row['income_expence_type_name'];
    }

    // Capture expense transactions via MVC controller
    $data_obj = new income_expence_data_info_list_LIST();
    $data_obj->get_all_data();
    $data_obj->filter_by_is_type_of_expence();
    $data_obj->filter_by_income_expence_type_id($type_id);
    
    if (!empty($start_date) && !empty($end_date)) {
        $data_obj->filter_by_date_range($start_date, $end_date);
    }
    
    $data_obj->set_data_limits(0, 9999);
    $data_res = $data_obj->get_result();
    
    if ($data_res) {
        while ($row = $data_res->fetch_assoc()) {
            $json['transactions'][] = array(
                'id' => $row['id'],
                'date' => date('M d, Y', strtotime($row['sdt'])),
                'description' => $row['dis'],
                'amount' => floatval($row['amount'])
            );
        }
    }
}

echo json_encode($json);
?>
