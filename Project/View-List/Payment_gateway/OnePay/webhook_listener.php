<?php
// OnePay Fulfillment Webhook Listener
// Triggered dynamically by OnePay servers upon successful IPG card clearance.

include_once '../../../imports/need/DB.php';
include_once '../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_SINGLE_DATA.php';
include_once '../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_ADD_UPDATE.php';
include_once '../../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_ADD_UPDATE.php';
include_once '../../../Controller/payment/wwjm_member_payment_slilp/wwjm_member_payment_slilp_ADD_UPDATE.php';
include_once '../../../Controller/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';

// OnePay sends JSON payload via POST (raw input)
$json_payload = file_get_contents('php://input');
if (!$json_payload) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "No payload found"]);
    exit;
}

$payload = json_decode($json_payload, true);

if (!isset($payload['status']) || !isset($payload['reference'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid schema"]);
    exit;
}

// Ensure the transaction is specifically marked as APPROVED physically
if (strtoupper($payload['status']) !== 'APPROVED') {
    http_response_code(200);
    echo json_encode(["status" => "ignored", "message" => "Payment not approved yet"]);
    exit;
}

$ipg_transaction_id = $payload['transaction_id'] ?? 'N/A';
$raw_reference = $payload['reference']; // e.g. 0000000041
$internal_ipg_id = intval($raw_reference);

if ($internal_ipg_id <= 0) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid reference format"]);
    exit;
}

// 1. Fetch internal Pending record
$ipg_data = new IPG_Send_By_URL_SINGLE_DATA($internal_ipg_id);

if (!$ipg_data->get_state()) {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "Record not found"]);
    exit;
}

// 2. Idempotency Check: Don't double spend if OnePay pings twice!
if ($ipg_data->get_payment_status() == 1) {
    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Already processed previously"]);
    exit;
}

$amount = floatval($ipg_data->get_transation_amount());
$is_subscription = $ipg_data->get_is_subction() == 1;

// 3. Process the Master Ledger (Identical to Cash / Bank flow)
// Assuming user generic ID `1` since this is a server-to-server request (no cookies).
$system_user_id = 1;

$payment_slilp = new wwjm_payment_slip_ADD_UPDATE($system_user_id);
$payment_slilp->set_payment_date();
$payment_slilp->get_data($amount, 0, $ipg_data->get_cus_name(), "-", "-", $ipg_data->get_cus_email(), $ipg_data->get_cus_phone_no());

if ($is_subscription) {
    $payment_slilp->is_pay_resion_subcption();
}
if ($ipg_data->get_is_donation() == 1) {
    $payment_slilp->is_pay_resion_donation();
}
if ($ipg_data->get_is_zakath() == 1) {
    $payment_slilp->is_pay_resion_zakath();
}
if ($ipg_data->get_is_projcet() == 1) {
    $payment_slilp->is_pay_resion_projects();
}

// Flag as IPG payment natively!
$payment_slilp->is_is_IPG();
$payment_slilp->is_not_is_bank_deposit();
$payment_slilp->is_not_is_cash();

$mapped_member_id = 0;

if ($ipg_data->get_is_member() == 1) {
    $payment_slilp->is_is_member();
    
    // Natively look up the member link
    $data_base_obj = new database();
    $get_sql_query = "SELECT wwjm_member_list_id FROM wwjm_member_list_has_ipg_send_by_url WHERE IPG_Send_By_URL_id = '" . $internal_ipg_id . "' LIMIT 1";
    $result = $data_base_obj->get_result($get_sql_query);
    if ($result && $row = $result->fetch_assoc()) {
        $mapped_member_id = $row['wwjm_member_list_id'];
    }
} else {
    $payment_slilp->is_not_is_member();
}

if ($payment_slilp->process_new_record()) {
    $wwjm_payment_slip_id = $payment_slilp->get_id();

    // ------ SUBSCRIPTION INCOME LEDGER LOGIC ------
    if ($is_subscription) {
        $subscription_type_id = 0;
        include_once '../../../Controller/income_expence_type/income_expence_type_LIST.php';
        include_once '../../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
        
        $inc_type_list = new income_expence_type_LIST();
        $inc_type_list->get_all_data();
        $inc_type_list->filter_by_income_expence_type_name("Subscription");
        $inc_type_list->filter_by_is_income_type();
        $res_inc_type = $inc_type_list->get_result();
        
        if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
            $subscription_type_id = $row_inc['id'];
        } else {
            $new_inc_type = new income_expence_type_ADD_UPDATE($system_user_id);
            $new_inc_type->get_data("Subscription");
            $new_inc_type->is_is_income_type();
            $new_inc_type->is_not_is_expece_type();
            $new_inc_type->process_new_record();
            $subscription_type_id = $new_inc_type->get_id();
        }
        
        include_once '../../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
        $ie_data = new income_expence_data_ADD_UPDATE($system_user_id);
        $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Member IPG Subscription (Slip #".$wwjm_payment_slip_id.")");
        $ie_data->is_is_type_income();
        $ie_data->is_not_is_type_expece();
        $ie_data->is_finish_state();
        $ie_data->process_new_record();
        $new_ie_data_id = $ie_data->get_id();
        
        include_once '../../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
        $ie_info = new income_expence_data_info_list_ADD_UPDATE($system_user_id);
        $ie_info->get_data("Member Gateway Card Payment", $amount, $new_ie_data_id, $subscription_type_id);
        $ie_info->is_is_type_of_income();
        $ie_info->is_not_is_type_of_expence();
        $ie_info->process_new_record();
    }

    // ------ ZAKATH INCOME LEDGER LOGIC ------
    if ($ipg_data->get_is_zakath() == 1) {
        $zakath_type_id = 0;
        include_once '../../../Controller/income_expence_type/income_expence_type_LIST.php';
        include_once '../../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
        
        $inc_type_list = new income_expence_type_LIST();
        $inc_type_list->get_all_data();
        $inc_type_list->filter_by_income_expence_type_name("Zakath");
        $inc_type_list->filter_by_is_income_type();
        $res_inc_type = $inc_type_list->get_result();
        
        if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
            $zakath_type_id = $row_inc['id'];
        } else {
            $new_inc_type = new income_expence_type_ADD_UPDATE($system_user_id);
            $new_inc_type->get_data("Zakath");
            $new_inc_type->is_is_income_type();
            $new_inc_type->is_not_is_expece_type();
            $new_inc_type->process_new_record();
            $zakath_type_id = $new_inc_type->get_id();
        }
        
        include_once '../../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
        $ie_data = new income_expence_data_ADD_UPDATE($system_user_id);
        $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Member IPG Zakath Donation (Slip #".$wwjm_payment_slip_id.")");
        $ie_data->is_is_type_income();
        $ie_data->is_not_is_type_expece();
        $ie_data->is_finish_state();
        $ie_data->process_new_record();
        $new_ie_data_id = $ie_data->get_id();
        
        include_once '../../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
        $ie_info = new income_expence_data_info_list_ADD_UPDATE($system_user_id);
        $ie_info->get_data("Zakath Gateway Card Payment", $amount, $new_ie_data_id, $zakath_type_id);
        $ie_info->is_is_type_of_income();
        $ie_info->is_not_is_type_of_expence();
        $ie_info->process_new_record();
    }
    // ------ PROJECT INCOME LEDGER LOGIC (VIA JSON CACHE BRIDGE) ------
    if ($ipg_data->get_is_projcet() == 1) {
        $cache_file = __DIR__ . '/project_ipg_cache.json';
        if (file_exists($cache_file)) {
            $cache = json_decode(file_get_contents($cache_file), true);
            if (isset($cache[(string)$internal_ipg_id])) {
                $proj_id = $cache[(string)$internal_ipg_id]['id'];
                $proj_name = $cache[(string)$internal_ipg_id]['name'];
                
                // 1. Increment the Master Project Table structurally
                if ($proj_id > 0) {
                    include_once '../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE.php';
                    $project_update = new wwjm_projects_collection_list_ADD_UPDATE($system_user_id);
                    $project_update->set_id($proj_id);
                    $project_update->set_collected_amount_increment($amount);
                    $project_update->process_update();
                }

                // 2. Generate the Dynamic Income Ledger
                $project_type_id = 0;
                include_once '../../../Controller/income_expence_type/income_expence_type_LIST.php';
                include_once '../../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
                
                $inc_type_list = new income_expence_type_LIST();
                $inc_type_list->get_all_data();
                $inc_type_list->filter_by_income_expence_type_name($proj_name);
                $inc_type_list->filter_by_is_income_type();
                $res_inc_type = $inc_type_list->get_result();
                
                if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
                    $project_type_id = $row_inc['id'];
                } else {
                    $new_inc_type = new income_expence_type_ADD_UPDATE($system_user_id);
                    $new_inc_type->get_data($proj_name);
                    $new_inc_type->is_is_income_type();
                    $new_inc_type->is_not_is_expece_type();
                    $new_inc_type->process_new_record();
                    $project_type_id = $new_inc_type->get_id();
                }
                
                include_once '../../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
                $ie_data = new income_expence_data_ADD_UPDATE($system_user_id);
                $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Project IPG Card Donation (Slip #".$wwjm_payment_slip_id.")");
                $ie_data->is_is_type_income();
                $ie_data->is_not_is_type_expece();
                $ie_data->is_finish_state();
                $ie_data->process_new_record();
                $new_ie_data_id = $ie_data->get_id();
                
                include_once '../../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                $ie_info = new income_expence_data_info_list_ADD_UPDATE($system_user_id);
                $ie_info->get_data($proj_name . " Gateway Card Payment", $amount, $new_ie_data_id, $project_type_id);
                $ie_info->process_new_record();
                
                // --- C. Register Ticket Transactions ---
                $ticket_cache_file = __DIR__ . '/project_ipg_tickets_cache.json';
                $t_cache = file_exists($ticket_cache_file) ? json_decode(file_get_contents($ticket_cache_file), true) : [];
                if(isset($t_cache[(string)$internal_ipg_id])) {
                    $tickets_purchased = $t_cache[(string)$internal_ipg_id];
                    include_once '../../../Controller/payment/ticket_transactions/ticket_transactions_ADD_UPDATE.php';
                    include_once '../../../Controller/projects/collection_ticket_tiers/collection_ticket_tiers_ADD_UPDATE.php';
                    foreach($tickets_purchased as $tid => $tinfo) {
                         $ticket_mapper = new ticket_transactions_ADD_UPDATE();
                         $ticket_mapper->get_data($tinfo['qty'], $tid, $proj_id, $mapped_member_id ? $mapped_member_id : 0);
                         $ticket_mapper->process_new_record();
                         
                         $tier_update = new collection_ticket_tiers_ADD_UPDATE($system_user_id);
                         $tier_update->set_id($tid);
                         $tier_update->set_total_sold_increment($tinfo['qty']);
                         $tier_update->process_update();
                    }
                    unset($t_cache[(string)$internal_ipg_id]);
                    file_put_contents($ticket_cache_file, json_encode($t_cache));
                }
                
                // --- D. Update Project Collected Amount ---
                include_once '../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE.php';
                $proj_update = new wwjm_projects_collection_list_ADD_UPDATE($system_user_id);
                $proj_update->set_id($proj_id);
                $proj_update->set_collected_amount_increment($amount);
                $proj_update->process_update();
                
                // Cleanup internal project cache state memory
                unset($cache[(string)$internal_ipg_id]);
                file_put_contents($cache_file, json_encode($cache));
            }
        }
    }
    // ------ END PROJECT INCOME LOGIC ------

    // ------ COMMON SLIP LINKING FOR ALL MEMBERS ------
    if ($ipg_data->get_is_member() == 1 && $mapped_member_id > 0) {
        $wwjm_member_payment_slilp = new wwjm_member_payment_slilp_ADD_UPDATE();
        $wwjm_member_payment_slilp->get_data($mapped_member_id, $wwjm_payment_slip_id);
        $slip_recorded = $wwjm_member_payment_slilp->process_new_record();

        // ------ DECREMENT DUE BALANCE ONLY FOR SUBSCRIPTIONS/GENERAL ------
        if ($slip_recorded && $ipg_data->get_is_zakath() != 1 && $ipg_data->get_is_projcet() != 1) {
            $member_update = new wwjm_member_list_ADD_UPDATE();
            $member_update->set_id($mapped_member_id);
            $member_update->set_due_pay_decreement($amount);
            $member_update->process_update();
        }

        require_once __DIR__ . '/../../../imports/notification/auto_notify.php';
        wwjm_notify_payment_received($mapped_member_id, $amount);
    }

    // Natively stamp the transaction as processed so we never double trigger!
    $ipg_update = new IPG_Send_By_URL_ADD_UPDATE();
    $ipg_update->set_id($internal_ipg_id);
    $ipg_update->set_transaction_payment_success();
    if($ipg_transaction_id != 'N/A') {
        $ipg_update->set_ipg_transaction_id($ipg_transaction_id);
    }
    $ipg_update->process_update();

    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Ledgers processed safely", "slip_id" => $wwjm_payment_slip_id]);
    exit;

} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to create root payment slip"]);
    exit;
}
