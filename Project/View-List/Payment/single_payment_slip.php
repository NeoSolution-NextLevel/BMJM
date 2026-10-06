<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_SINGLE_DATA.php';
include_once '../../Controller/wwjm_bank_deposit_slip/wwjm_bank_deposit_slip_SINGLE_DATA_payment_slip.php';

$json = array();

if (isset($_POST['id']) || isset($_POST['payment_id'])) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : (int)$_POST['payment_id'];
    
    $single_data = new wwjm_payment_slip_SINGLE_DATA($id);
    
    if ($single_data->get_state()) {
        $payment_data = [
            "id" => $single_data->get_id(),
            "payment_date" => $single_data->get_payment_date(),
            "amount" => $single_data->get_amount(),
            "dis" => $single_data->get_dis(),
            "person_name" => $single_data->get_person_name(),
            "address" => $single_data->get_address(),
            "membership_no" => $single_data->get_membership_no(),
            "email" => $single_data->get_email(),
            "phone_number" => $single_data->get_phone_number(),
            "is_cash" => $single_data->get_is_cash(),
            "is_bank_deposit" => $single_data->get_is_bank_deposit(),
            "is_IPG" => $single_data->get_is_IPG(),
            "pay_resion_subcption" => $single_data->get_pay_resion_subcption(),
            "pay_resion_donation" => $single_data->get_pay_resion_donation(),
            "pay_resion_zakath" => $single_data->get_pay_resion_zakath(),
            "pay_resion_projects" => $single_data->get_pay_resion_projects(),
            "is_member" => $single_data->get_is_member(),
            "ast" => $single_data->get_ast(),
            "sdt" => $single_data->get_sdt(),
            "bank_deposit_slip_id" => "",
            "bank_image_pth" => "",
            "bank_approve_state" => "0",
            "bank_approve_cancel" => "0",
            "bank_review_reason" => "",
            "bank_submitted_date" => "",
            "bank_amount" => "",
            "bank_slip_no" => ""
        ];

        if ((string) $single_data->get_is_bank_deposit() === '1') {
            $bank_data = new wwjm_bank_deposit_slip_SINGLE_DATA_payment_slip($id);
            if ($bank_data->get_state()) {
                $payment_data['bank_deposit_slip_id'] = $bank_data->get_id();
                $payment_data['bank_image_pth'] = $bank_data->get_image_pth();
                $payment_data['bank_approve_state'] = $bank_data->get_approve_state();
                $payment_data['bank_approve_cancel'] = $bank_data->get_approve_cancel();
                $payment_data['bank_review_reason'] = $bank_data->get_resion_to_approve();
                $payment_data['bank_submitted_date'] = $bank_data->get_sdt();
                $payment_data['bank_amount'] = $bank_data->get_amount();
                $payment_data['bank_slip_no'] = $bank_data->get_slip_no();
            }
        }

        $json[] = $payment_data;
    }
}

echo json_encode($json);
