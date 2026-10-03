<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
include_once __DIR__ . '/../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';

$json = array(
    'error' => '1',
    'message' => 'Invalid transaction data.'
);

$user_id = isset($_SESSION['main_user_login_id']) ? intval($_SESSION['main_user_login_id']) : 1;
$transaction_type = isset($_POST['transaction_type']) ? trim($_POST['transaction_type']) : 'expense';
$type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;
$amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
$date_of_doc = isset($_POST['date_of_doc']) && !empty($_POST['date_of_doc']) ? trim($_POST['date_of_doc']) : date('Y-m-d');
$dis = isset($_POST['dis']) ? trim($_POST['dis']) : '';

if ($amount <= 0) {
    $json['message'] = 'Amount must be greater than zero.';
    echo json_encode(array($json));
    exit;
}

if ($type_id <= 0) {
    $json['message'] = 'Please select a valid category.';
    echo json_encode(array($json));
    exit;
}

if (empty($dis)) {
    $json['message'] = 'Description / reference cannot be empty.';
    echo json_encode(array($json));
    exit;
}

// 1. Create parent record in income_expence_data
$parent_obj = new income_expence_data_ADD_UPDATE($user_id);
$parent_obj->get_data($date_of_doc, $amount, $dis);

if ($transaction_type === 'income') {
    $parent_obj->is_is_type_income();
    $parent_obj->is_not_is_type_expece();
} else {
    $parent_obj->is_not_is_type_income();
    $parent_obj->is_is_type_expece();
}
$parent_obj->is_finish_state();

$parent_res = $parent_obj->process_new_record();
$data_id = $parent_obj->get_id();

if (!$parent_res || !$data_id) {
    $json['message'] = 'Failed to create transaction parent record.';
    echo json_encode(array($json));
    exit;
}

// 2. Create child record in income_expence_data_info_list
$child_obj = new income_expence_data_info_list_ADD_UPDATE($user_id);
$child_obj->get_data($dis, $amount, $data_id, $type_id);

if ($transaction_type === 'income') {
    $child_obj->is_is_type_of_income();
    $child_obj->is_not_is_type_of_expence();
} else {
    $child_obj->is_not_is_type_of_income();
    $child_obj->is_is_type_of_expence();
}

$child_res = $child_obj->process_new_record();

if ($child_res) {
    $json['error'] = '0';
    $json['message'] = ucfirst($transaction_type) . ' transaction recorded successfully.';
    $json['id'] = $child_obj->get_id();
    $json['data_id'] = $data_id;
} else {
    $json['message'] = 'Parent record created, but child info failed.';
}

echo json_encode(array($json));
?>
