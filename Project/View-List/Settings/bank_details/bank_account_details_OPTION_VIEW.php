<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/bank_account_details/bank_account_details_LIST.php';

$bank_list = new bank_account_details_LIST();
$bank_list->get_all_data();
$result = $bank_list->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bank_name = htmlspecialchars($row['bank_name']);
        $branch = htmlspecialchars($row['branch']);
        $ac_no = htmlspecialchars($row['ac_no']);
        echo '<option value="' . $row['id'] . '">' . $bank_name . ' - ' . $branch . ' (' . $ac_no . ')</option>';
    }
}
?>
