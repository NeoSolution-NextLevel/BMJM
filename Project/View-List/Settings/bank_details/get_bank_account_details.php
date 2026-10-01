<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/bank_account_details/bank_account_details_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/User-Login/Cook_Managment/Cook_Managing.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'error' => '1',
    'message' => 'Bank account details could not be loaded.',
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

$check_login_obj = new Cook_Management($user_main_cook_id);
if (!$check_login_obj->check_login_availability()) {
    $response['message'] = $check_login_obj->get_error_msg();
    echo json_encode($response);
    exit;
}

$bank_account_id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
if ($bank_account_id <= 0) {
    $response['message'] = 'Invalid bank account id.';
    echo json_encode($response);
    exit;
}

$bank_account = new bank_account_details_SINGLE_DATA($bank_account_id);
if (!$bank_account->get_state() || (int) $bank_account->get_ast() !== 1) {
    $response['message'] = 'Bank account was not found.';
    echo json_encode($response);
    exit;
}

$response = [
    'error' => '0',
    'id' => (int) $bank_account->get_id(),
    'bank_name' => $bank_account->get_bank_name(),
    'branch' => $bank_account->get_branch(),
    'ac_no' => $bank_account->get_ac_no(),
    'ac_name' => $bank_account->get_ac_name(),
    'swif_code' => $bank_account->get_swif_code(),
    'current_ac' => (string) $bank_account->get_current_ac(),
    'savings_ac' => (string) $bank_account->get_savings_ac(),
    'dis' => $bank_account->get_dis(),
];

echo json_encode($response);
