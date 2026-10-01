<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_LIST.php';
include_once '../../Controller/wwjm_bank_deposit_slip/wwjm_bank_deposit_slip_SINGLE_DATA_payment_slip.php';

$search_txt    = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : "";
$membership_no = isset($_POST['membership_no']) ? trim($_POST['membership_no']) : "";
$payment_type  = isset($_POST['payment_type']) ? trim($_POST['payment_type']) : "";
$other_type    = isset($_POST['other_type']) ? trim($_POST['other_type']) : "";
$start_date    = isset($_POST['start_date']) ? trim($_POST['start_date']) : "";
$end_date      = isset($_POST['end_date']) ? trim($_POST['end_date']) : "";
$payment_status = isset($_POST['payment_status']) ? trim($_POST['payment_status']) : "";

$json = array();

$payment_slip_list = new wwjm_payment_slip_LIST();

if (isset($_POST['count'])) {
    $payment_slip_list->get_count_report();
} else {
    if (isset($_POST['st_count'])) {
        $get_state_value = (int)$_POST['st_count'];
        $get_limit = isset($_POST['per_page']) ? (int)$_POST['per_page'] : 50;

        $payment_slip_list->set_data_limits($get_state_value, $get_limit);
    }
}

// 1. Payment reason/category filter (from dropdown #payment-type or payment_type parameter)
$reason = strtolower($payment_type);
if (empty($reason) || $reason === "all") {
    $reason = strtolower($other_type);
}

if ($reason === "subscription") {
    $payment_slip_list->filter_by_pay_resion_subcption();
} else if ($reason === "zakath") {
    $payment_slip_list->filter_by_pay_resion_zakath();
} else if ($reason === "collection" || $reason === "kuruba" || $reason === "project" || $reason === "projects") {
    $payment_slip_list->filter_by_pay_resion_projects();
} else if ($reason === "donation" || $reason === "donations") {
    $payment_slip_list->filter_by_pay_resion_donation();
}

// 2. Payment method filter (from dropdown #payment-other-type or other_type parameter)
$method = strtolower($other_type);
if (empty($method) || $method === "all") {
    $method = strtolower($payment_type);
}

if ($method === "bank" || $method === "bank_deposit" || $method === "bank deposit") {
    $payment_slip_list->filter_by_is_bank_deposit();
} else if ($method === "cash") {
    $payment_slip_list->filter_by_is_cash();
} else if ($method === "qr" || $method === "online_payment" || $method === "ipg" || $method === "share by qr") {
    $payment_slip_list->filter_by_is_IPG();
}

if (($start_date !== "") || ($end_date !== "")) {
    $payment_slip_list->filter_by_date_range($start_date, $end_date);
}

if ($payment_status !== '' && strtolower($payment_status) !== 'all') {
    $payment_slip_list->filter_by_bank_review_status($payment_status);
}

$member_id     = isset($_POST['member_id']) ? trim($_POST['member_id']) : "";

if (!empty($member_id)) {
    $payment_slip_list->filter_by_wwjm_member_list_id($member_id);
} else if (!empty($membership_no)) {
    $payment_slip_list->filter_by_membership_no($membership_no);
}

$get_result = $payment_slip_list->get_result();

if ($get_result && $get_result->num_rows > 0) {
    while ($row = $get_result->fetch_assoc()) {
        if (isset($_POST['count'])) {
            $json[] = [
                "total_count" => $row['count(id)'],
                "count"       => $row['count(id)']
            ];
        } else {
            $bank_slip = new wwjm_bank_deposit_slip_SINGLE_DATA_payment_slip($row['id']);
            if ($bank_slip->get_state()) {
                $row['bank_deposit_slip_id'] = $bank_slip->get_id();
                $row['bank_approve_state'] = $bank_slip->get_approve_state();
                $row['bank_approve_cancel'] = $bank_slip->get_approve_cancel();
                $row['bank_cancel_reason'] = $bank_slip->get_resion_to_approve();
            } else {
                $row['bank_deposit_slip_id'] = '';
                $row['bank_approve_state'] = '0';
                $row['bank_approve_cancel'] = '0';
                $row['bank_cancel_reason'] = '';
            }
            $json[] = $row;
        }
    }
}

echo json_encode($json);
