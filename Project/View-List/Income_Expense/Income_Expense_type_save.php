<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';

$json = array(
    'error' => '1',
    'message' => 'Invalid parameters'
);

$user_id = isset($_SESSION['main_user_login_id']) ? intval($_SESSION['main_user_login_id']) : 1;
$type_name = isset($_POST['type_name']) ? trim($_POST['type_name']) : '';
$type_category = isset($_POST['type_category']) ? trim($_POST['type_category']) : 'expense';
$type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;

if (empty($type_name)) {
    $json['message'] = 'Type name cannot be empty.';
    echo json_encode(array($json));
    exit;
}

$type_add_obj = new income_expence_type_ADD_UPDATE($user_id);
$type_add_obj->get_data($type_name);

if ($type_category === 'income') {
    $type_add_obj->is_is_income_type();
    $type_add_obj->is_not_is_expece_type();
} else if ($type_category === 'expense') {
    $type_add_obj->is_not_is_income_type();
    $type_add_obj->is_is_expece_type();
} else { // both
    $type_add_obj->is_is_income_type();
    $type_add_obj->is_is_expece_type();
}

if ($type_id > 0) {
    $type_add_obj->set_id($type_id);
    $result = $type_add_obj->process_update();
    if ($result) {
        $json['error'] = '0';
        $json['message'] = 'Type updated successfully.';
        $json['id'] = $type_id;
    } else {
        $json['message'] = 'Failed to update type.';
    }
} else {
    $result = $type_add_obj->process_new_record();
    if ($result) {
        $json['error'] = '0';
        $json['message'] = 'Type added successfully.';
        $json['id'] = $type_add_obj->get_id();
    } else {
        $json['message'] = 'Failed to add type.';
    }
}

echo json_encode(array($json));
?>
