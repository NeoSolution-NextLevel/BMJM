<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_ADD_UPDATE.php';
include_once '../../Controller/payment/wwjm_member_payment_slilp/wwjm_member_payment_slilp_ADD_UPDATE.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA_member_no.php';
include_once '../../imports/feature_flags/feature_flags.php';

$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['pay_resion_donation']) && !$BMJM_FEATURE_DONATION) {
        bmjm_feature_guard(false, 'Donation');
    }
    if (isset($_POST['pay_resion_projects']) && !$BMJM_FEATURE_COLLECTION) {
        bmjm_feature_guard(false, 'Collection Payment');
    }
    
    $amount = isset($_POST['val_01']) ? $_POST['val_01'] : null;
    $dis = isset($_POST['val_02']) ? $_POST['val_02'] : null; 
    $person_name = isset($_POST['val_03']) ? $_POST['val_03'] : null;
    $address = isset($_POST['val_04']) ? $_POST['val_04'] : null;
    $membership_no = isset($_POST['val_05']) ? $_POST['val_05'] : null;
    $member_email = isset($_POST['member_email']) ? $_POST['member_email'] : null;
    $member_mobile_no = isset($_POST['member_mobile_no']) ? $_POST['member_mobile_no'] : null;
    $wwjm_member_list_id = isset($_POST['wwjm_member_list_id']) ? $_POST['wwjm_member_list_id'] : null;

    if ((empty($person_name) || empty($address) || empty($membership_no) || empty($member_email) || empty($member_mobile_no)) && (!empty($wwjm_member_list_id) || !empty($membership_no))) {
        if (!empty($wwjm_member_list_id) && (int)$wwjm_member_list_id > 0) {
            $member_obj = new wwjm_member_list_SINGLE_DATA((int)$wwjm_member_list_id);
        } elseif (!empty($membership_no)) {
            $member_obj = new wwjm_member_list_SINGLE_DATA_member_no($membership_no);
        }

        if (isset($member_obj) && $member_obj->get_state()) {
            if (empty($person_name)) {
                $person_name = $member_obj->get_name_M();
            }
            if (empty($address)) {
                $address = $member_obj->get_residence_address_M();
            }
            if (empty($membership_no)) {
                $membership_no = $member_obj->get_membership_no();
            }
            if (empty($member_email)) {
                $member_email = $member_obj->get_contact_email();
            }
            if (empty($member_mobile_no)) {
                $member_mobile_no = $member_obj->get_contact_number();
            }
            if (empty($wwjm_member_list_id) || (int)$wwjm_member_list_id <= 0) {
                $wwjm_member_list_id = $member_obj->get_id();
            }
        }
    }

    $check_login_obj = new Cook_Management($user_main_cook_id);

    $company_obj = new Company_Info_Variable_List();

    if ($check_login_obj->check_login_availability()) {
        $payment_slilp = new wwjm_payment_slip_ADD_UPDATE($check_login_obj->get_user_id());
        $wwjm_member_payment_slilp = new wwjm_member_payment_slilp_ADD_UPDATE();

        $payment_slilp->set_payment_date();

        $payment_slilp->get_data($amount, $dis, $person_name, $address, $membership_no, $member_email, $member_mobile_no);

        if (isset($_POST['pay_resion_subcption'])) {
            $payment_slilp->is_pay_resion_subcption();
        }

        if (isset($_POST['wwjm_payment_sliip_id_bank_deposite'])) {
            $payment_slilp->is_is_bank_deposit();
        }

        if (isset($_POST['pay_resion_donation'])) {
            $payment_slilp->is_pay_resion_donation();
        }

        if (isset($_POST['pay_resion_zakath'])) {
            $payment_slilp->is_pay_resion_zakath();
        }

        if (isset($_POST['pay_resion_projects'])) {
            $payment_slilp->is_pay_resion_projects();
        }


        if (isset($_POST['is_cash'])) {
            $payment_slilp->is_is_cash();
        }

        if (isset($_POST['wwjm_payment_sliip_id_bank_deposite'])) {
            $payment_slilp->is_is_bank_deposit();
        }



        if (isset($_POST['is_IPG'])) {
            $payment_slilp->is_is_IPG();
        }


        if (isset($_POST['is_member']) && $_POST['is_member'] == 1) {
            $payment_slilp->is_is_member();
        } else {
            $payment_slilp->is_not_is_member();
        }



        if (isset($_POST['id'])) {

            $get_id = $_POST['id'];
            $payment_slilp->set_id($get_id);
            if ($payment_slilp->process_update()) {
                $state['error'] = "0";
                $state['id'] = $get_id;
            } else {
                $state['error'] = $payment_slilp->get_error();
            }
        } else {

            if ($payment_slilp->process_new_record()) {
                $state['error'] = "0";
                $state['id'] = $payment_slilp->get_id();
                $wwjm_payment_slip_id = $payment_slilp->get_id();

                // ------ SUBSCRIPTION LOGIC ------
                if (isset($_POST['pay_resion_subcption'])) {
                    // --- INCOME EXPENSE INTEGRATION FOR SUBSCRIPTION ---
                    $subscription_type_id = 0;
                    include_once '../../Controller/income_expence_type/income_expence_type_LIST.php';
                    include_once '../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
                    
                    $inc_type_list = new income_expence_type_LIST();
                    $inc_type_list->get_all_data();
                    $inc_type_list->filter_by_income_expence_type_name("Subscription");
                    $inc_type_list->filter_by_is_income_type();
                    $res_inc_type = $inc_type_list->get_result();
                    
                    if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
                        $subscription_type_id = $row_inc['id'];
                    } else {
                        $new_inc_type = new income_expence_type_ADD_UPDATE($check_login_obj->get_user_id());
                        $new_inc_type->get_data("Subscription");
                        $new_inc_type->is_is_income_type();
                        $new_inc_type->is_not_is_expece_type();
                        $new_inc_type->process_new_record();
                        $subscription_type_id = $new_inc_type->get_id();
                    }
                    
                    include_once '../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
                    $ie_data = new income_expence_data_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Member Auto Subscription (Slip #".$wwjm_payment_slip_id.")");
                    $ie_data->is_is_type_income();
                    $ie_data->is_not_is_type_expece();
                    $ie_data->is_finish_state();
                    $ie_data->process_new_record();
                    $new_ie_data_id = $ie_data->get_id();
                    
                    include_once '../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                    $ie_info = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_info->get_data("Member Subscription Payment", $amount, $new_ie_data_id, $subscription_type_id);
                    $ie_info->is_is_type_of_income();
                    $ie_info->is_not_is_type_of_expence();
                    $ie_info->process_new_record();
                    // --- END INCOME EXPENSE INTEGRATION ---
                }
                // ------ END SUBSCRIPTION LOGIC ------

                // ------ ZAKATH INCOME LEDGER LOGIC ------
                if (isset($_POST['pay_resion_zakath'])) {
                    // --- INCOME EXPENSE INTEGRATION FOR ZAKATH ---
                    $zakath_type_id = 0;
                    include_once '../../Controller/income_expence_type/income_expence_type_LIST.php';
                    include_once '../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
                    
                    $inc_type_list = new income_expence_type_LIST();
                    $inc_type_list->get_all_data();
                    $inc_type_list->filter_by_income_expence_type_name("Zakath");
                    $inc_type_list->filter_by_is_income_type();
                    $res_inc_type = $inc_type_list->get_result();
                    
                    if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
                        $zakath_type_id = $row_inc['id'];
                    } else {
                        $new_inc_type = new income_expence_type_ADD_UPDATE($check_login_obj->get_user_id());
                        $new_inc_type->get_data("Zakath");
                        $new_inc_type->is_is_income_type();
                        $new_inc_type->is_not_is_expece_type();
                        $new_inc_type->process_new_record();
                        $zakath_type_id = $new_inc_type->get_id();
                    }
                    
                    include_once '../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
                    $ie_data = new income_expence_data_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Member Zakath Cash Donation (Slip #".$wwjm_payment_slip_id.")");
                    $ie_data->is_is_type_income();
                    $ie_data->is_not_is_type_expece();
                    $ie_data->is_finish_state();
                    $ie_data->process_new_record();
                    $new_ie_data_id = $ie_data->get_id();
                    
                    include_once '../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                    $ie_info = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_info->get_data("Zakath Cash Payment", $amount, $new_ie_data_id, $zakath_type_id);
                    $ie_info->is_is_type_of_income();
                    $ie_info->is_not_is_type_of_expence();
                    $ie_info->process_new_record();
                    // --- END INCOME EXPENSE INTEGRATION ---
                }
                // ------ END ZAKATH LOGIC ------

                // ------ PROJECT INCOME LEDGER LOGIC ------
                if (isset($_POST['pay_resion_projects'])) {
                    // Extract dynamic project name safely
                    $proj_name = isset($_POST['wwjm_projects_collection_list_name']) ? $_POST['wwjm_projects_collection_list_name'] : "Unknown Project";
                    
                    // --- INCOME EXPENSE INTEGRATION FOR PROJECTS ---
                    $project_type_id = 0;
                    include_once '../../Controller/income_expence_type/income_expence_type_LIST.php';
                    include_once '../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';
                    
                    $inc_type_list = new income_expence_type_LIST();
                    $inc_type_list->get_all_data();
                    $inc_type_list->filter_by_income_expence_type_name($proj_name);
                    $inc_type_list->filter_by_is_income_type();
                    $res_inc_type = $inc_type_list->get_result();
                    
                    if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
                        $project_type_id = $row_inc['id'];
                    } else {
                        $new_inc_type = new income_expence_type_ADD_UPDATE($check_login_obj->get_user_id());
                        $new_inc_type->get_data($proj_name);
                        $new_inc_type->is_is_income_type();
                        $new_inc_type->is_not_is_expece_type();
                        $new_inc_type->process_new_record();
                        $project_type_id = $new_inc_type->get_id();
                    }
                    
                    include_once '../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
                    $ie_data = new income_expence_data_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Project Cash Donation (Slip #".$wwjm_payment_slip_id.")");
                    $ie_data->is_is_type_income();
                    $ie_data->is_not_is_type_expece();
                    $ie_data->is_finish_state();
                    $ie_data->process_new_record();
                    $new_ie_data_id = $ie_data->get_id();
                    
                    include_once '../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                    $ie_info = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_info->get_data($proj_name . " Cash Payment", $amount, $new_ie_data_id, $project_type_id);
                    $ie_info->is_is_type_of_income();
                    $ie_info->is_not_is_type_of_expence();
                    $ie_info->process_new_record();
                    // --- END INCOME EXPENSE INTEGRATION ---
                }
                // ------ END PROJECT INCOME LOGIC ------
                
                if (isset($_POST['is_member']) && $_POST['is_member'] == 1 && isset($_POST['wwjm_member_list_id']) && $_POST['wwjm_member_list_id'] > 0) {
                    $wwjm_member_payment_slilp->get_data($wwjm_member_list_id, $wwjm_payment_slip_id);

                    if ($wwjm_member_payment_slilp->process_new_record()) {
                        $state['error'] = "0";
                        $state['member_payment_id'] = $wwjm_member_payment_slilp->get_id();

                        // Zakath is strictly prohibited from decreasing internal Due Pay balances
                        if (!isset($_POST['pay_resion_zakath'])) {
                            $member_update = new wwjm_member_list_ADD_UPDATE();
                            $member_update->set_id($wwjm_member_list_id);
                            $member_update->set_due_pay_decreement($amount);
                            $member_update->process_update();
                        }

                        require_once __DIR__ . '/../../imports/notification/auto_notify.php';
                        wwjm_notify_payment_received($wwjm_member_list_id, $amount);
                    } else {
                        $state['error'] = $wwjm_member_payment_slilp->get_error();
                    }
                }
                
                // Track project level balances unconditionally
                $wwjm_prj_id = isset($_POST['wwjm_projects_collection_list_id']) ? $_POST['wwjm_projects_collection_list_id'] : null;
                if ($wwjm_prj_id) {
                    include_once '../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE.php';
                    $project_update = new wwjm_projects_collection_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $project_update->set_id($wwjm_prj_id);
                    $project_update->set_collected_amount_increment($amount);
                    $project_update->process_update();
                    
                    include_once '../../Controller/payment/wwjm_collection_payments/wwjm_collection_payments_ADD_UPDATE.php';
                    $coll_payment = new wwjm_collection_payments_ADD_UPDATE();
                    $coll_payment->get_data($wwjm_payment_slip_id, $wwjm_prj_id);
                    $coll_payment->process_new_record();

                    // ------ NEXT TICKETING LOGIC ------
                    if (isset($_POST['payment_selected_tickets_json'])) {
                        $tickets_purchased = json_decode($_POST['payment_selected_tickets_json'], true);
                        if(is_array($tickets_purchased) && count($tickets_purchased) > 0) {
                            include_once '../../Controller/payment/ticket_transactions/ticket_transactions_ADD_UPDATE.php';
                            include_once '../../Controller/projects/collection_ticket_tiers/collection_ticket_tiers_ADD_UPDATE.php';
                            
                            foreach($tickets_purchased as $tc) {
                                $t_id = isset($tc['id']) ? $tc['id'] : 0;
                                $t_qty = isset($tc['qty']) ? $tc['qty'] : 0;
                                
                                if($t_id > 0 && $t_qty > 0) {
                                    // 1. Record Transaction Map
                                    $tick_trans = new ticket_transactions_ADD_UPDATE();
                                    $mem_push_id = isset($_POST['wwjm_member_list_id']) ? $_POST['wwjm_member_list_id'] : (isset($_POST['val_11']) ? $_POST['val_11'] : 0);
                                    
                                    $tick_trans->get_data($t_qty, $t_id, $wwjm_prj_id, $mem_push_id);
                                    $tick_trans->process_new_record();
                                    
                                    // 2. Increment Sold Capacity Securely
                                    $tier_update = new collection_ticket_tiers_ADD_UPDATE($check_login_obj->get_user_id());
                                    $tier_update->set_id($t_id);
                                    $tier_update->set_total_sold_increment($t_qty);
                                    $tier_update->process_update();
                                }
                            }
                        }
                    }
                    // ------ END TICKETING LOGIC ------
                }
                
            } else {
                $state['error'] = $payment_slilp->get_error();
            }
        }

        $json[] = $state;
    } else {
        $state['error'] = $check_login_obj->get_error_msg();
        $json[] = $state;
    }
} else {
    $state['error'] = "Invalid request method";
    $json[] = $state;
}

echo json_encode($json);
