<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_LIST.php';

$json = array();

$type_filter = isset($_POST['type_filter']) ? trim($_POST['type_filter']) : 'all';
$search_txt = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : '';

$type_list_obj = new income_expence_type_LIST();
$type_list_obj->get_all_data();

if ($type_filter === 'income') {
    $type_list_obj->filter_by_is_income_type();
} else if ($type_filter === 'expense') {
    $type_list_obj->filter_by_is_expece_type();
}

if (!empty($search_txt)) {
    $type_list_obj->filter_by_income_expence_type_name($search_txt);
}

$type_list_obj->set_data_limits(0, 500);
$type_result = $type_list_obj->get_result();

if ($type_result) {
    while ($row = $type_result->fetch_assoc()) {
        $category = 'other';
        if ($row['is_income_type'] == 1 && $row['is_expece_type'] == 1) {
            $category = 'both';
        } else if ($row['is_income_type'] == 1) {
            $category = 'income';
        } else if ($row['is_expece_type'] == 1) {
            $category = 'expense';
        }

        $json[] = array(
            'id' => intval($row['id']),
            'name' => $row['income_expence_type_name'],
            'is_income_type' => intval($row['is_income_type']),
            'is_expece_type' => intval($row['is_expece_type']),
            'type' => $category,
            'sdt' => $row['sdt']
        );
    }
}

echo json_encode($json);
?>
