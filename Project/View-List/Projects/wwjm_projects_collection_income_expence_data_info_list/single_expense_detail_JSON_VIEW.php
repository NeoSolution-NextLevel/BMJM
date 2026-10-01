<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';

include_once __DIR__ . '/../../../Controller/income_expence_data_info_list/income_expence_data_info_list_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/income_expence_type/income_expence_type_SINGLE_DATA.php';

$json = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($expense_id > 0) {
        
        $info_data = new income_expence_data_info_list_SINGLE_DATA($expense_id);
        
        if ($info_data->get_state()) {
            
            $type_name = "Uncategorized";
            $type_id = $info_data->get_income_expence_type_id();
            if ($type_id > 0) {
                $type_data = new income_expence_type_SINGLE_DATA($type_id);
                if ($type_data->get_state()) {
                    $type_name = $type_data->get_income_expence_type_name();
                }
            }
            
            $json = array(
                'error' => 0,
                'date' => $info_data->get_sdt(),
                'description' => $info_data->get_dis(),
                'category' => $type_name,
                'amount' => floatval($info_data->get_amount()),
                'status' => $info_data->get_ast() == 1 ? "Cleared" : "Voided"
            );
        } else {
            $json = array('error' => 1, 'msg' => 'Expense record not found in ledger.');
        }
    } else {
        $json = array('error' => 1, 'msg' => 'Invalid parameters payload.');
    }
}

echo json_encode($json);
?>
