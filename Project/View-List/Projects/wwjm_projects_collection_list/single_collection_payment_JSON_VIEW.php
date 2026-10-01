<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';

$json = array();
$payment_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($payment_id > 0) {
    $db = new DataBase();
    
    $query = "
        SELECT 
            ps.id as slip_id,
            ps.sdt as payment_date,
            ps.person_name,
            ps.amount,
            ps.is_cash,
            ps.is_bank_deposit,
            ps.is_IPG,
            ps.ast
        FROM wwjm_payment_slip ps
        WHERE ps.id = '" . $payment_id . "'
    ";

    $result = $db->get_result($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $method = "Unknown";
        if ($row['is_cash'] == 1) $method = "Cash";
        else if ($row['is_bank_deposit'] == 1) $method = "Bank Transfer";
        else if ($row['is_IPG'] == 1) $method = "Online / IPG";

        $status = ($row['ast'] == 1) ? "Completed" : "Cancelled";
        
        $json = array(
            'error' => 0,
            'slip_id' => $row['slip_id'],
            'date' => $row['payment_date'],
            'person_name' => $row['person_name'] ? $row['person_name'] : "Anonymous Donor",
            'amount' => floatval($row['amount']),
            'method' => $method,
            'status' => $status
        );
    } else {
        $json = array('error' => 1, 'msg' => 'Record missing or database timeout.');
    }
} else {
    $json = array('error' => 1, 'msg' => 'Invalid parameters payload.');
}

echo json_encode($json);
?>
