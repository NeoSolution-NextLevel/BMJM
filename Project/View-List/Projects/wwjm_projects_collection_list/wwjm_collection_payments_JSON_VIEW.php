<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/payment/wwjm_collection_payments/wwjm_collection_payments_LIST.php';

$json = array();
$collection_id = isset($_POST['id']) ? $_POST['id'] : 0;

if ($collection_id > 0) {
    $db = new DataBase();
    
    // Join wwjm_collection_payments with wwjm_payment_slip securely
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
        FROM wwjm_collection_payments cp
        INNER JOIN wwjm_payment_slip ps ON cp.wwjm_payment_slip_id = ps.id
        WHERE cp.wwjm_projects_collection_list_id = '" . $collection_id . "'
        ORDER BY ps.id DESC
    ";

    $result = $db->get_result($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            
            // Determine Renderable Method Types Automatically
            $method = "Unknown";
            if ($row['is_cash'] == 1) $method = "Cash";
            else if ($row['is_bank_deposit'] == 1) $method = "Bank Transfer";
            else if ($row['is_IPG'] == 1) $method = "Online / IPG";

            $status = ($row['ast'] == 1) ? "Completed" : "Cancelled";
            
            $json[] = array(
                'slip_id' => $row['slip_id'],
                'date' => $row['payment_date'],
                'person_name' => $row['person_name'] ? $row['person_name'] : "Anonymous Donor",
                'amount' => floatval($row['amount']),
                'method' => $method,
                'status' => $status
            );
        }
    }
}

echo json_encode($json);
?>
