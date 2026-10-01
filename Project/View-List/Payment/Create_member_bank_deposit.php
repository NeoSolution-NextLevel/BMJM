<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/payment/wwjm_payment_slip/wwjm_payment_slip_ADD_UPDATE.php';
include_once '../../UxUI-Back/notification_templates/bank_deposit/notification_template_bank_deposit.php';
include_once '../../UxUI-Back/notification_templates/bank_deposit/notification_template_bank_deposit_cancel_aprrove_user.php';
include_once '../../UxUI-Back/notification_templates/bank_deposit/notification_template_bank_deposit_aprrove_user.php';
include_once '../../Controller/wwjm_bank_deposit_slip/wwjm_bank_deposit_slip_ADD_UPDATE.php';
include_once '../../Controller/bank_deposit_data_history/bank_deposit_data_history_ADD_UPDATE.php';
include_once '../../Controller/payment/wwjm_member_payment_slilp/wwjm_member_payment_slilp_ADD_UPDATE.php';
include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../imports/email/Email_Send.php';
include_once '../../imports/email/Email_Sending_Final.php';
include_once '../../imports/sms/SMS_Sending.php';
include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';

include_once '../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
//C:\Users\CHAMIKA\Documents\GitHub\WWJM\Controller\income_expence_data\income_expence_data_ADD_UPDATE.php
$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $amount = isset($_POST['val_01']) ? $_POST['val_01'] : null;
    $dis = isset($_POST['val_02']) ? $_POST['val_02'] : null;
    $person_name = isset($_POST['val_03']) ? $_POST['val_03'] : null;
    $address = isset($_POST['val_04']) ? $_POST['val_04'] : null;
    $membership_no = isset($_POST['val_05']) ? $_POST['val_05'] : null;
    $image_pth = isset($_POST['val_06']) ? $_POST['val_06'] : null;
    $bank_name = isset($_POST['val_07']) ? $_POST['val_07'] : null;
    $branch = isset($_POST['val_08']) ? $_POST['val_08'] : null;
    $ac_no = isset($_POST['val_09']) ? $_POST['val_09'] : null;
    $bank_account_details_id = isset($_POST['val_10']) ? $_POST['val_10'] : null;
    $member_email = isset($_POST['member_email']) ? $_POST['member_email'] : null;
    $member_mobile_no = isset($_POST['member_mobile_no']) ? $_POST['member_mobile_no'] : null;

    $check_login_obj = new Cook_Management($user_main_cook_id);

    $company_obj = new Company_Info_Variable_List();

    // Base64 Image Conversion & Disk Storage Logic
    if (!empty($image_pth) && strpos($image_pth, 'data:image/') === 0) {
        $short_name = str_replace(' ', '_', $company_obj->get_compnay_short_name());
        $uploadDir = '../../Data/' . $short_name . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext = 'png';
        if (strpos($image_pth, 'data:image/jpeg') === 0 || strpos($image_pth, 'data:image/jpg') === 0) {
            $ext = 'jpg';
        }
        $base64_data = explode('base64,', $image_pth)[1] ?? '';
        if (!empty($base64_data)) {
            $fileName = $short_name . "_BANK_SLIP_" . uniqid('', true) . "." . $ext;
            $filePath = $uploadDir . $fileName;
            file_put_contents($filePath, base64_decode($base64_data));
            $image_pth = 'Data/' . $short_name . '/' . $fileName;
        }
    }

    // Auto-fetch member details from database if generic or missing
    $member_list_id = isset($_POST['val_11']) ? $_POST['val_11'] : (isset($_POST['wwjm_member_list_id']) ? $_POST['wwjm_member_list_id'] : null);
    
    if ((empty($person_name) || $person_name === "Member" || empty($address) || empty($member_email) || empty($member_mobile_no))) {
        $db_mem_check = new DataBase();
        $mem_sql = "";
        if (!empty($member_list_id) && (int)$member_list_id > 0) {
            $mem_sql = "SELECT * FROM wwjm_member_list WHERE id = '" . (int)$member_list_id . "'";
        } else if (!empty($membership_no)) {
            $mem_sql = "SELECT * FROM wwjm_member_list WHERE membership_no = '" . $db_mem_check->real_escape_string($membership_no) . "'";
        }
        if (!empty($mem_sql)) {
            $res_m = $db_mem_check->get_result($mem_sql);
            if ($res_m && $row_m = $res_m->fetch_assoc()) {
                if (empty($person_name) || $person_name === "Member") {
                    $person_name = $row_m['name_M'] ?? 'Member';
                }
                if (empty($membership_no)) {
                    $membership_no = $row_m['membership_no'] ?? '';
                }
                if (empty($address)) {
                    $address = $row_m['residence_address_M'] ?? '';
                }
                if (empty($member_mobile_no)) {
                    $member_mobile_no = !empty($row_m['phone_mobile']) ? $row_m['phone_mobile'] : (!empty($row_m['notification_moible_no']) ? $row_m['notification_moible_no'] : (!empty($row_m['phone_residence']) ? $row_m['phone_residence'] : (!empty($row_m['phone_office']) ? $row_m['phone_office'] : '')));
                }
                if (empty($member_email)) {
                    $member_email = !empty($row_m['email']) ? $row_m['email'] : (!empty($row_m['notification_email']) ? $row_m['notification_email'] : '');
                }
            }
        }
    }

    if ($check_login_obj->check_login_availability()) {
        $payment_slilp = new wwjm_payment_slip_ADD_UPDATE($check_login_obj->get_user_id());
        $bank_deposit_slip = new wwjm_bank_deposit_slip_ADD_UPDATE($check_login_obj->get_user_id());
        $bank_deposit_data_history = new bank_deposit_data_history_ADD_UPDATE($check_login_obj->get_user_id());
        $wwjm_member_payment_slilp = new wwjm_member_payment_slilp_ADD_UPDATE();

        $payment_slilp->set_payment_date();

        $payment_slilp->get_data($amount, $dis, $person_name, $address, $membership_no, $member_email, $member_mobile_no);

        if (isset($_POST['pay_resion_subcption'])) {
            $payment_slilp->is_pay_resion_subcption();
            $bank_deposit_data_history->is_pay_resion_subcption();
        }


        if (isset($_POST['wwjm_payment_sliip_id_bank_deposite'])) {
            $payment_slilp->is_is_bank_deposit();
        }

        if (isset($_POST['pay_resion_donation'])) {
            $payment_slilp->is_pay_resion_donation();
            $bank_deposit_data_history->is_pay_resion_donation();
        }

        if (isset($_POST['pay_resion_zakath'])) {
            $payment_slilp->is_pay_resion_zakath();
            $bank_deposit_data_history->is_pay_resion_zakath();
        }

        if (isset($_POST['pay_resion_projects'])) {
            $payment_slilp->is_pay_resion_projects();
            if (method_exists($bank_deposit_data_history, 'is_pay_resion_projects')) {
                $bank_deposit_data_history->is_pay_resion_projects();
            }
        }

        if (isset($_POST['id'])) {
            $payment_slilp->set_id($_POST['id']);

            if (isset($_POST['remove']) && $_POST['remove'] == '1') {

                $payment_slilp->remove();
                if ($payment_slilp->process_update()) {
                    $state['error'] = "0";
                    $state['id'] = $_POST['id'];
                } else {
                    $state['error'] = $payment_slilp->get_error();
                }
                $json[] = $state;
                echo json_encode($json);
                exit;
            }
        }


        if (isset($_POST['bank_deposit_slip_id'])) {

            $get_id = $_POST['bank_deposit_slip_id'];
            $bank_deposit_slip->set_id($get_id);

            if (isset($_POST['approve_cancel'])) {
                $bank_deposit_slip->is_approve_cancel();
            }


            if (isset($_POST['Receive'])) {
                $bank_deposit_slip->is_not_approve_cancel();
                $bank_deposit_slip->is_approve_state();
            }


            if (isset($_POST['resion_to_approve'])) {
                $resion_to_approve  = isset($_POST['resion_to_approve']) ? $_POST['resion_to_approve'] : null;
                $bank_deposit_slip->set_resion_to_approve($resion_to_approve);
            }


            if ($bank_deposit_slip->process_update()) {
                $state['error'] = "0";
                $state['id'] = $bank_deposit_slip_id;
                $wwjm_payment_slip_id =  $_POST['wwjm_payment_slip_id'];


                if (isset($_POST['approve_cancel'])) {

                    //encrypt member list id 
                    $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
                    $Advance_Security_obj = new Advance_Security();
                    $encrypt_wwjm_payment_slip_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_wwjm_payment_slip_id(), $wwjm_payment_slip_id);


                    $notification_template_bank_deposit_cancel_aprrove_user_obj = new notification_template_bank_deposit_cancel_aprrove_user($encrypt_wwjm_payment_slip_id);
                    $message = $notification_template_bank_deposit_cancel_aprrove_user_obj->form_by_sms();

                    $sms_obj = new SMS_Sending($member_mobile_no, $message);
                    $sms_obj->send_message();

                    $html_data = $notification_template_bank_deposit_cancel_aprrove_user_obj->sending_form_by_email($bank_name, $branch, $ac_no, $amount, $person_name);
                    $email_obj = new Email($member_email, $subject, $html_data);
                    $email_obj->send_email();
                }

                if (isset($_POST['Receive'])) {

                    // 1. APPROVE THE SLIP
                    $bank_deposit_slip->is_not_approve_cancel();
                    $bank_deposit_slip->is_approve_state();

                    // =========================================================
                    // 2. FETCH DATA FROM DB (The Fix)
                    // =========================================================
                    // We cannot rely on $_POST['val_01'] because the update form might not send it.
                    // We must get the Amount and Description from the database using the ID.

                    $db_check = new DataBase();
                    $rec_id = $bank_deposit_slip->get_id(); // The ID being updated

                    // Fetch amount and description from the bank deposit table
                    // Note: Ensure 'wwjm_bank_deposit_slip' is your correct table name
                    $res_fetch = $db_check->get_result("SELECT amount, description FROM wwjm_bank_deposit_slip WHERE id='$rec_id'");

                    $fetched_amount = 0;
                    $fetched_desc = "Member Payment Approved";

                    if ($res_fetch && $row_f = $res_fetch->fetch_assoc()) {
                        $fetched_amount = $row_f['amount'];
                        $fetched_desc   = "Approved: " . $row_f['description'];
                    }


                    $income_data_id = 1; // <--- MAKE SURE THIS ID EXISTS IN YOUR DB
                    $income_type_id = 1; // <--- MAKE SURE THIS ID EXISTS IN YOUR DB

                    if ($income_data_id > 0 && $income_type_id > 0 && $fetched_amount > 0) {
                        $info_list_obj = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                        $info_list_obj->get_data($fetched_desc, $fetched_amount, $income_data_id, $income_type_id);
                        $info_list_obj->is_is_type_of_income();
                        $info_list_obj->is_not_is_type_of_expence();

                        if (!$info_list_obj->process_new_record()) {
                            $state['income_error'] = "Failed to save income: " . $info_list_obj->get_error();
                        }
                    } else {
                        $state['income_error'] = "Skipped: Amount is 0 or IDs invalid. Amount: $fetched_amount";
                    }
                    
                    // Track project level balances unconditionally on approval
                    $wwjm_prj_id = isset($_POST['wwjm_projects_collection_list_id']) ? $_POST['wwjm_projects_collection_list_id'] : null;
                    if ($wwjm_prj_id && $fetched_amount > 0) {
                        include_once '../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE.php';
                        $project_update = new wwjm_projects_collection_list_ADD_UPDATE($check_login_obj->get_user_id());
                        $project_update->set_id($wwjm_prj_id);
                        $project_update->set_collected_amount_increment($fetched_amount);
                        $project_update->process_update();
                    }


                    $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
                    $Advance_Security_obj = new Advance_Security();
                    $encrypt_wwjm_payment_slip_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_wwjm_payment_slip_id(), $wwjm_payment_slip_id);

                    $notification_template_bank_deposit_aprrove_user_obj = new notification_template_bank_deposit_aprrove_user($encrypt_wwjm_payment_slip_id);
                    $message = $notification_template_bank_deposit_aprrove_user_obj->form_by_sms();

                    if ($member_mobile_no) {
                        $sms_obj = new SMS_Sending($member_mobile_no, $message);
                        $sms_obj->send_message();
                    }

                    // For email, we use the fetched amount too
                    $html_data = $notification_template_bank_deposit_aprrove_user_obj->sending_form_by_email($bank_name, $branch, $ac_no, $fetched_amount, $person_name);

                    if ($member_email) {
                        $email_obj = new Email($member_email, $subject, $html_data);
                        $email_obj->send_email();
                    }

                    require_once __DIR__ . '/../../imports/notification/auto_notify.php';
                    wwjm_notify_payment_for_slip($wwjm_payment_slip_id, $fetched_amount);
                }








                $json[] = $state;
                echo json_encode($json);
                exit;
            } else {
                $state['error'] = $bank_deposit_slip->get_error();
            }
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
            if (isset($_POST['is_member'])) {
                $payment_slilp->is_is_member();
            } else {
                $payment_slilp->is_not_is_member();
            }



            if ($payment_slilp->process_new_record()) {
                $state['error'] = "0";
                $state['id'] = $payment_slilp->get_id();
                $wwjm_payment_slip_id = $payment_slilp->get_id();

                // ------ SUBSCRIPTION LOGIC ------
                if (isset($_POST['pay_resion_subcption']) && $_POST['pay_resion_subcption'] == "1") {
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
                
                // Track project linkage securely within bridging table
                $wwjm_prj_id = isset($_POST['wwjm_projects_collection_list_id']) ? $_POST['wwjm_projects_collection_list_id'] : null;
                if ($wwjm_prj_id) {
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
                                    $tick_trans = new ticket_transactions_ADD_UPDATE();
                                    $mem_push_id = isset($_POST['wwjm_member_list_id']) ? $_POST['wwjm_member_list_id'] : (isset($_POST['val_11']) ? $_POST['val_11'] : 0);
                                    
                                    $tick_trans->get_data($t_qty, $t_id, $wwjm_prj_id, $mem_push_id);
                                    $tick_trans->process_new_record();
                                    
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
                    $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Member Zakath Bank Deposit (Slip #".$wwjm_payment_slip_id.")");
                    $ie_data->is_is_type_income();
                    $ie_data->is_not_is_type_expece();
                    $ie_data->is_finish_state();
                    $ie_data->process_new_record();
                    $new_ie_data_id = $ie_data->get_id();
                    
                    include_once '../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                    $ie_info = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_info->get_data("Zakath Bank Deposit", $amount, $new_ie_data_id, $zakath_type_id);
                    $ie_info->is_is_type_of_income();
                    $ie_info->is_not_is_type_of_expence();
                    $ie_info->process_new_record();
                    // --- END INCOME EXPENSE INTEGRATION ---
                }

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
                    $ie_data->get_data(date('Y-m-d H:i:s'), $amount, "Project Bank Deposit Addition (Slip #".$wwjm_payment_slip_id.")");
                    $ie_data->is_is_type_income();
                    $ie_data->is_not_is_type_expece();
                    $ie_data->is_finish_state();
                    $ie_data->process_new_record();
                    $new_ie_data_id = $ie_data->get_id();
                    
                    include_once '../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                    $ie_info = new income_expence_data_info_list_ADD_UPDATE($check_login_obj->get_user_id());
                    $ie_info->get_data($proj_name . " Bank Deposit", $amount, $new_ie_data_id, $project_type_id);
                    $ie_info->is_is_type_of_income();
                    $ie_info->is_not_is_type_of_expence();
                    $ie_info->process_new_record();
                    // --- END INCOME EXPENSE INTEGRATION ---
                }
                // ------ END PROJECT INCOME LOGIC ------

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
                                $tick_trans = new ticket_transactions_ADD_UPDATE();
                                $mem_push_id = isset($_POST['wwjm_member_list_id']) ? $_POST['wwjm_member_list_id'] : (isset($_POST['val_11']) ? $_POST['val_11'] : 0);
                                
                                $tick_trans->get_data($t_qty, $t_id, $wwjm_prj_id, $mem_push_id);
                                $tick_trans->process_new_record();
                                
                                $tier_update = new collection_ticket_tiers_ADD_UPDATE($check_login_obj->get_user_id());
                                $tier_update->set_id($t_id);
                                $tier_update->set_total_sold_increment($t_qty);
                                $tier_update->process_update();
                            }
                        }
                    }
                }
                // ------ END TICKETING LOGIC ------

                $bank_deposit_slip->get_data($image_pth, $wwjm_payment_slip_id, "Not Approve Yet", $dis, $amount, $bank_account_details_id);


                if ($bank_deposit_slip->process_new_record()) {
                    $state['error'] = "0";
                    $state['id'] = $bank_deposit_slip->get_id();
                    $wwjm_bank_deposit_slip_id = $bank_deposit_slip->get_id();

                    $bank_deposit_data_history->get_data($bank_account_details_id, $wwjm_payment_slip_id, $wwjm_bank_deposit_slip_id, $dis, $amount, 00.00, $dis);

                    if ($bank_deposit_data_history->process_new_record()) {
                        $state['error'] = "0";
                        $state['id'] = $bank_deposit_data_history->get_id();

                        if (isset($_POST['is_member']) && $_POST['is_member'] == 1 && isset($_POST['val_11']) && $_POST['val_11'] > 0) {

                            $member_list_id = $_POST['val_11'];

                            $wwjm_member_payment_slilp->get_data($member_list_id, $wwjm_payment_slip_id);

                            if ($wwjm_member_payment_slilp->process_new_record()) {
                                $state['error'] = "0";
                                $state['id'] = $wwjm_member_payment_slilp->get_id();
                            } else {
                                $state['error'] = $wwjm_member_payment_slilp->get_error();
                            }
                        }

                        // --- ADMIN AUTO-APPROVAL BYPASS INTEGRATION ---
                        if (isset($_POST['is_admin_direct_approval']) && $_POST['is_admin_direct_approval'] == "1") {
                            // 1. Force the physical slip state to Approved natively
                            $bank_deposit_slip->is_not_approve_cancel();
                            $bank_deposit_slip->is_approve_state();
                            $bank_deposit_slip->process_update();

                            // 2. Reduce the physical Member due balance strictly since the payment is safely cleared
                            // Zakath is strictly prohibited from decreasing internal Due Pay balances
                            if (isset($_POST['is_member']) && isset($_POST['val_11']) && $_POST['val_11'] > 0 && !isset($_POST['pay_resion_zakath'])) {
                                include_once '../../Controller/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';
                                $member_update = new wwjm_member_list_ADD_UPDATE();
                                $member_update->set_id($_POST['val_11']);
                                $member_update->set_due_pay_decreement($amount);
                                $member_update->process_update();
                            }

                            if (isset($_POST['is_member']) && isset($_POST['val_11']) && $_POST['val_11'] > 0) {
                                require_once __DIR__ . '/../../imports/notification/auto_notify.php';
                                wwjm_notify_payment_received($_POST['val_11'], $amount);
                            }
                        }
                        // --- END ADMIN AUTO-APPROVAL BYPASS ---
                    } else {
                        $state['error'] = $bank_deposit_data_history->get_error();
                    }
                } else {
                    $state['error'] = $bank_deposit_slip->get_error();
                }

                $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
                $Advance_Security_obj = new Advance_Security();
                $wwjm_payment_slip_encrypt_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_wwjm_payment_slip_id(), $wwjm_payment_slip_id);


                //sending email to manager 
                $notification_project_id = !empty($wwjm_prj_id) ? $wwjm_prj_id : 0;
                $notification_template_bank_deposit_obj = new notification_template_bank_deposit($wwjm_payment_slip_encrypt_id, $notification_project_id, $person_name, $amount);


                // Send SMS notification to finance phone number
                $phone_mobile = $company_obj->get_company_finance_phone_no();
                $message = $notification_template_bank_deposit_obj->form_by_sms();
                if (!empty($phone_mobile)) {
                    $sms_obj = new SMS_Sending($phone_mobile, $message);
                    $sms_obj->send_message();
                }

                // Send Email notification to finance admin email
                $subject = $notification_template_bank_deposit_obj->email_subject();
                $html_data = $notification_template_bank_deposit_obj->sending_form_by_email($bank_name, $branch, $ac_no, $amount, $person_name, $membership_no, $member_email, $member_mobile_no, $address, $image_pth);
                
                $finance_admin_email = $company_obj->get_finanace_admin_emial();
                if (!empty($finance_admin_email)) {
                    $email_obj = new Email($finance_admin_email, $subject, $html_data);
                    $email_obj->send_email();
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
