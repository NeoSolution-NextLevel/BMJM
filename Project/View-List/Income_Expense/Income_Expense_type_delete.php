<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';

$json = array(
    'error' => '1',
    'message' => 'Invalid parameters'
);

$user_id = isset($_SESSION['main_user_login_id']) ? intval($_SESSION['main_user_login_id']) : 1;
$type_id = isset($_POST['type_id']) ? intval($_POST['type_id']) : 0;

if ($type_id > 0) {
    $type_obj = new income_expence_type_ADD_UPDATE($user_id);
    $type_obj->set_id($type_id);
    $type_obj->remove();
    $result = $type_obj->process_update();
    if ($result) {
        $json['error'] = '0';
        $json['message'] = 'Type removed successfully.';
    } else {
        $json['message'] = 'Failed to remove type.';
    }
} else {
    $json['message'] = 'Invalid type ID.';
}

echo json_encode(array($json));
?>
