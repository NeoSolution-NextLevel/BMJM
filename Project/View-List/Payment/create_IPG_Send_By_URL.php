<?php

include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';

include_once '../../UxUI-Back/notification_templates/payment_IPG/notification_for_send_details_IPG.php';
include_once '../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_ADD_UPDATE.php';
include_once '../../Controller/wwjm_member_list_has_IPG_Send_By_URL/wwjm_member_list_has_IPG_Send_By_URL_ADD_UPDATE.php';
include_once '../../Controller/main_user_login_has_IPG_Send_By_URL/main_user_login_has_IPG_Send_By_URL_ADD_UPDATE.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';

include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../imports/sms/SMS_Sending.php';
include_once '../../imports/email/Email_Send.php';
include_once '../../imports/email/Email_Sending_Final.php';

$json = array();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $amout = isset($_POST['val_01']) ? $_POST['val_01'] : "";  //amount
    $cus_name = isset($_POST['val_02']) ? $_POST['val_02'] : "";  // cus_name
    $cus_phone = isset($_POST['val_03']) ? $_POST['val_03'] : "";  //cus_phone 
    $cus_email = isset($_POST['val_04']) ? $_POST['val_04'] : "";  //cus_email 
    $cus_address = isset($_POST['val_05']) ? $_POST['val_05'] : "";  //cus_address 
    $bank_fee_amount = isset($_POST['val_06']) ? $_POST['val_06'] : "";  //bank_fee_amount 
    $cus_whatsapp = isset($_POST['val_07']) ? $_POST['val_07'] : $cus_phone;  // whatsapp number
    $cus_sms = isset($_POST['val_08']) ? $_POST['val_08'] : $cus_phone; // sms number




    $check_login_obj = new Cook_Management($user_main_cook_id);



    

    $ipg_url_obj = new IPG_Send_By_URL_ADD_UPDATE();


    if (isset($_POST['is_member'])) {
        $member_user_ipg_url_obj = new wwjm_member_list_has_IPG_Send_By_URL_ADD_UPDATE();
        $ipg_url_obj->is_is_member();
    }


    if (isset($_POST['subcription'])) {
        $ipg_url_obj->is_is_subction();
    }
    if (isset($_POST['zakath'])) {
        $ipg_url_obj->is_is_zakath();
    }
    if (isset($_POST['donation'])) {
        $ipg_url_obj->is_is_donation();
    }
    if (isset($_POST['project'])) {
        $ipg_url_obj->is_is_projcet();
    }


    if ($check_login_obj->check_login_availability()) {
        $main_user_ipg_url_obj = new main_user_login_has_IPG_Send_By_URL_ADD_UPDATE($check_login_obj->get_user_id());
        $ipg_url_obj->is_is_user();
    } else {
        $ipg_url_obj->is_not_is_user();
    }

    $amout = floatval($amout);
    $bank_fee_amount = floatval($bank_fee_amount);
    $transation_amount = $amout + $amout * ($bank_fee_amount / 100);


    $ipg_url_obj->get_data($amout, $cus_name, $cus_phone, $cus_email, $bank_fee_amount, $transation_amount);



    if (isset($_POST['id'])) {
        $ipg_url_obj->set_id($_POST['id']);

        if (isset($_POST['remove']) && $_POST['remove'] == '1') {
            // Call remove method and then update to mark as deleted
            $ipg_url_obj->remove();
            if ($ipg_url_obj->process_update()) {
                $state['error'] = "0";
                $state['id'] = $_POST['id'];
            } else {
                $state['error'] = $ipg_url_obj->get_error();
            }
            $json[] = $state;
            echo json_encode($json);
            exit;
        }
    }



    if (isset($_POST['id'])) {
        if ($ipg_url_obj->process_update()) {
            $state['error'] = "0";
            $state['id'] = $_POST['id'];
        } else {
            $state['error'] = $ipg_url_obj->get_error();
        }
    } else {
        if ($ipg_url_obj->process_new_record()) {
            $state['error'] = "0";
            $state['id'] = $ipg_url_obj->get_id();
            $IPG_Send_By_URL_id = $ipg_url_obj->get_id();
            $sec_id = $ipg_url_obj->get_sec_id();


            if ($check_login_obj->check_login_availability()) {
                $main_user_ipg_url_obj->get_data($IPG_Send_By_URL_id);

                if ($main_user_ipg_url_obj->process_new_record()) {
                    $state['error'] = "0";
                    $state['id'] = $main_user_ipg_url_obj->get_id();
                } else {
                    $state['error'] = $main_user_ipg_url_obj->get_error();
                }
            }

            if (isset($_POST['is_member'])) {

                $member_list_id = $_POST['member_list_id'];

                $member_user_ipg_url_obj->get_data($member_list_id, $IPG_Send_By_URL_id);

                if ($member_user_ipg_url_obj->process_new_record()) {
                    $state['error'] = "0";
                    $state['id'] = $member_user_ipg_url_obj->get_id();
                } else {
                    $state['error'] = $member_user_ipg_url_obj->get_error();
                }
            }

            // --- PROJECT TO IPG BRIDGE STATE GENERATOR ---
            if (isset($_POST['project']) && isset($_POST['wwjm_projects_collection_list_id'])) {
                $cache_file = __DIR__ . '/../../View-List/Payment_gateway/OnePay/project_ipg_cache.json';
                $cache = file_exists($cache_file) ? json_decode(file_get_contents($cache_file), true) : [];
                
                $cache[(string)$IPG_Send_By_URL_id] = [
                    'id' => $_POST['wwjm_projects_collection_list_id'],
                    'name' => isset($_POST['wwjm_projects_collection_list_name']) ? $_POST['wwjm_projects_collection_list_name'] : "Unknown Project"
                ];
                file_put_contents($cache_file, json_encode($cache));
            }
            // --- END BRIDGE STATE GENERATOR ---



            $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
            $Advance_Security_obj = new Advance_Security();
            $encrypted_sec_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $sec_id);

            $notification_for_send_details_IPG_obj = new notification_for_send_details_IPG($encrypted_sec_id);

            if (isset($_POST['by_email'])) {
                $subject = $notification_for_send_details_IPG_obj->email_subject();
                $content = $notification_for_send_details_IPG_obj->sending_form_by_email($cus_name, $cus_phone, $cus_address, $transation_amount);
                $email_obj = new Email($cus_email, $subject, $content);
                if (!$email_obj->send_email()) {
                    $state['error'] = "Failed to send email. Ensure your mail server is running.";
                    $json[] = $state;
                    echo json_encode($json);
                    exit;
                }
            }


            if (isset($_POST['by_sms'])) {
                $message = $notification_for_send_details_IPG_obj->form_by_sms($cus_name, $cus_sms, $cus_address, $transation_amount);
                $sms_obj = new SMS_Sending($cus_sms, $message);
                $sms_response = $sms_obj->send_message();
                
                // If there is an active API response check, optionally print error
                // Currently SMS api might return empty strings if fails
                if (!$sms_response || strpos($sms_response, 'error') !== false) {
                     $state['error'] = "Failed to dispatch SMS to " . $cus_sms . ". API returned: " . htmlspecialchars($sms_response);
                     $json[] = $state;
                     echo json_encode($json);
                     exit;
                }
            }

            if (isset($_POST['by_whats_app'])) {
                $state['whatsapp_url'] =   $notification_for_send_details_IPG_obj->from_whatsup($cus_name, $cus_whatsapp);
            }

            if (isset($_POST['by_sr_scan'])) {
                $state['qr_scan_url'] =   $notification_for_send_details_IPG_obj->form_by_IPG_QR_scan();
            }
            
        } else {
            $state['error'] = $ipg_url_obj->get_error();
        }
    }

    $json[] = $state;
} else {
    $state['error'] = "Invalid request method";
    $json[] = $state;
}

echo json_encode($json);
