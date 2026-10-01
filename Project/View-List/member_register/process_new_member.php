<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/member_register/wwjm_member_list/wwjm_member_list_ADD_UPDATE.php';
include_once '../../Controller/member_register/recommended_person_data/recommended_person_data_ADD_UPDATE.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';

$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $check_login_obj = new Cook_Management($user_main_cook_id);
    $main_user_login_id = ($check_login_obj->check_login_availability()) ? $check_login_obj->get_user_id() : "1";

    $name_M              = isset($_POST['val_01']) ? $_POST['val_01'] : ""; 
    $residence_address_M = isset($_POST['val_02']) ? $_POST['val_02'] : "";
    $nic_M               = isset($_POST['val_05']) ? $_POST['val_05'] : ""; 
    $phone_mobile        = isset($_POST['val_09']) ? $_POST['val_09'] : ""; 
    $whatsappNum         = isset($_POST['val_10']) ? $_POST['val_10'] : "";
    $secondary_mobile    = isset($_POST['val_11']) ? $_POST['val_11'] : "";
    $email               = isset($_POST['val_12']) ? $_POST['val_12'] : ""; 
    $profession          = isset($_POST['val_13']) ? $_POST['val_13'] : ""; 
    $monthly_payment     = isset($_POST['val_15']) ? $_POST['val_15'] : ""; 
    $opening_balance     = isset($_POST['val_17']) ? $_POST['val_17'] : "";
    $wwjm_road_name_id   = isset($_POST['val_20']) ? $_POST['val_20'] : "";
    $admin_form          = isset($_POST['admin_form']) ? $_POST['admin_form'] : "0";

    $approve_level_01_person = "";
    $approve_level_01_sdt = "";
    $approve_level_02_person = "";
    $approve_level_02_sdt = "";

    if ($admin_form === '1') {
        $login_user_name = $check_login_obj->get_name_show();
        $current_sdt = date("Y-m-d H:i:s");
        
        $approve_level_01_person = $login_user_name;
        $approve_level_01_sdt = $current_sdt;
        $approve_level_02_person = $login_user_name;
        $approve_level_02_sdt = $current_sdt;
    }

    // Flags
    $is_owner            = isset($_POST['owner']) ? $_POST['owner'] : '0';
    $is_tenant           = isset($_POST['tenant']) ? $_POST['tenant'] : '0';
    
    $account_type_subcrption = isset($_POST['account_type_subcrption']) ? '1' : '0';
    $zakath_pay_state = isset($_POST['zakath_pay_state']) ? '1' : '0';
    $account_type_zakath_reciver = isset($_POST['account_type_zakath_reciver']) ? '1' : '0';

    // Validate road ID — FK constraint requires a valid wwjm_road_name.id
    if (empty($wwjm_road_name_id) || !is_numeric($wwjm_road_name_id)) {
        $state['error'] = "Please select a road / street before submitting.";
        $json[] = $state;
        echo json_encode($json);
        exit;
    }

    // Verify road ID exists in DB
    $road_check_db = new DataBase();
    $road_check_result = $road_check_db->get_result("SELECT id FROM wwjm_road_name WHERE id='" . intval($wwjm_road_name_id) . "' AND ast='1'");
    if (!$road_check_result || $road_check_result->num_rows == 0) {
        $state['error'] = "Selected road does not exist. Please re-select the street.";
        $json[] = $state;
        echo json_encode($json);
        exit;
    }

    $member_create = new wwjm_member_list_ADD_UPDATE($main_user_login_id);
    
    if($member_create->check_member_exist($nic_M, $email,$phone_mobile)) {
        $state['error'] = "Member already exists with the provided NIC, email, or phone number. Please verify the details.";
        $json[] = $state;
        echo json_encode($json);
        exit;
    }
    
    $member_create->get_data(
        $name_M, 
        $residence_address_M, 
        $nic_M, 
        $email, 
        $phone_mobile,      // notification_moible_no (primary mobile)
        $secondary_mobile,  // secondry_mobile
        $whatsappNum,       // notification_whatup
        $profession, 
        $monthly_payment, 
        $opening_balance, 
        $approve_level_01_person, 
        $approve_level_01_sdt, 
        $approve_level_02_person, 
        $approve_level_02_sdt, 
        "0", 
        "0", 
        "1", 
        "0", 
        "", 
        $wwjm_road_name_id
    );

    if ($is_owner == '1') {
        $member_create->is_own_house();
    } else {
        $member_create->is_not_own_house();
    }

    if ($is_tenant == '1') {
        $member_create->is_rented_house();
    } else {
        $member_create->is_not_rented_house();
    }

    if ($account_type_subcrption == '1') {
        $member_create->is_account_type_subcrption();
    }

    if ($zakath_pay_state == '1') {
        $member_create->is_zakath_pay_state();
        $member_create->is_account_type_zakath_payee();
    }

    if ($account_type_zakath_reciver == '1') {
        $member_create->is_account_type_zakath_reciver();
    }
    
    if ($admin_form === '1') {
        $member_create->is_approve_level_01_state();
        $member_create->is_approve_level_02_state();
    }
    
    $member_create->is_active_state();

    if ($member_create->process_new_record()) {
        $state['error'] = "0";
        $wwjm_member_list_id = $member_create->get_id();
        $state['id'] = $wwjm_member_list_id;

        // Auto-generate membership_no as 5-digit padded number (e.g. 00034)
        $membership_no = str_pad($wwjm_member_list_id, 5, "0", STR_PAD_LEFT);
        $update_mem_db = new DataBase();
        
        // ------------- NEXT-GEN USER ACCOUNT GENERATION & SMS DELIVERY -------------
        // Set temporary password as their NIC (fallback to random 8-char if NIC is empty)
        $temp_password = !empty($nic_M) ? trim($nic_M) : substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        
        // Priority username shift: Email -> NIC Fallback -> Membership Code
        $user_login_name = !empty($email) ? $email : (!empty($nic_M) ? $nic_M : "M" . $membership_no);
        
        if (!class_exists('Company_Info_Variable_List')) {
            include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
        }
        if (!class_exists('main_user_account_access_level_list_LIST')) {
            include_once '../../Controller/Main/main_user_account_access_level_list/main_user_account_access_level_list_LIST.php';
        }
        if (!class_exists('main_user_login_ADD_UPDATE')) {
            include_once '../../Controller/Main/main_user_login/main_user_login_ADD_UPDATE.php';
        }
        if (!class_exists('SMS_Sending')) {
            include_once '../../imports/sms/SMS_Sending.php';
        }
        if (!class_exists('Email_Sender')) {
            include_once '../../imports/email/Email_Sending_Final.php';
        }
        if (!class_exists('Email')) {
            include_once '../../imports/email/Email_Send.php';
        }
        
        if (!class_exists('Advance_Security')) {
            include_once '../../imports/security/encrypt_decrypt.php';
        }

        // Dynamically assign WWJM specific access rights
        $access_level_id = "2"; 
        $access_obj = new main_user_account_access_level_list_LIST();
        $access_obj->filter_by_type_of_access('user');
        $acc_res = $access_obj->get_result();
        if ($acc_res && $row_acc = $acc_res->fetch_assoc()) {
            $access_level_id = $row_acc['id'];
        }

        // Encrypt the password precisely the same way User_Account_Check decrypts it
        $adv_sec = new Advance_Security();
        $encrypted_temp_password = $adv_sec->get_data_encrypt($user_login_name, $temp_password);

        $new_login = new main_user_login_ADD_UPDATE();
        $new_login->set_registration_from_data($user_login_name, $encrypted_temp_password, $name_M, "", "", "Member", $access_level_id, $name_M, "");

        if ($admin_form !== '1') {
            $new_login->is_not_account_active_state();
        }

        if ($new_login->process_new_record()) {
            $new_login_id = $new_login->get_id();
            // Securely couple identity
            $update_mem_db->get_result("UPDATE wwjm_member_list SET membership_no='" . $membership_no . "', main_user_login_id='" . intval($new_login_id) . "' WHERE id='" . intval($wwjm_member_list_id) . "'");

            if ($admin_form === '1') {
                // Dispatch SMS Notification Sequence
                $sms_msg = "Assalamu Alaikum {$name_M}, welcome to WWJM! Your member login is created. Username: {$user_login_name} Password: {$temp_password} ";
                $target_phone = !empty($phone_mobile) ? $phone_mobile : (!empty($whatsappNum) ? $whatsappNum : "");

                if (!empty($target_phone)) {
                    $sms_obj = new SMS_Sending($target_phone, $sms_msg);
                    $sms_obj->send_message();
                }

                // Dispatch Email Notification Sequence
                if (!empty($email)) {
                    $email_subject = "Welcome to WWJM - Profile Credentials";
                    $email_html = "
                        <h2 style='color:#123832; margin-bottom:15px;'>Assalamu Alaikum {$name_M},</h2>
                        <p style='font-size:16px;'>Welcome to the Wellawatta Jumma Mosque Member Portal! Your secure profile login has been successfully created.</p>
                        <div style='background-color:#F2EDE0; padding:20px; border-radius:8px; margin:20px 0;'>
                            <p style='margin:0; font-size:15px;'><b>Your Username:</b> {$user_login_name}</p>
                            <p style='margin:10px 0 0; font-size:15px;'><b>Temporary Password:</b> {$temp_password}</p>
                        </div>
                        <p style='font-size:14px; color:#5A6A62;'>Please log into the User Dashboard using the credentials above. We highly recommend updating your password immediately after accessing your account.</p>
                    ";
                    $email_obj = new Email($email, $email_subject, $email_html);
                    @$email_obj->send_email(); // Suppressed warning for localhost environment
                }
            }

        } else {
            // Failsafe injection
            $update_mem_db->get_result("UPDATE wwjm_member_list SET membership_no='" . $membership_no . "' WHERE id='" . intval($wwjm_member_list_id) . "'");
        }
        // -------------------------------------------------------------------------
        
        $state['membership_no'] = $membership_no;
        if ($admin_form === '1') {
            $state['generated_username'] = $user_login_name;
            $state['generated_password'] = $temp_password;
        } else {
            $state['pending'] = true;
        }
        
        // Handle dynamic multiple recommended persons according to company info
        $cp_saved = false;
        if (isset($_POST['contact_persons'])) {
            $cp_data = is_array($_POST['contact_persons']) ? $_POST['contact_persons'] : json_decode($_POST['contact_persons'], true);
            if (is_array($cp_data) && count($cp_data) > 0) {
                foreach ($cp_data as $cp) {
                    $cp_name = isset($cp['name']) ? trim($cp['name']) : '';
                    $cp_mem_id = isset($cp['membership_no']) ? trim($cp['membership_no']) : '';
                    $cp_mobile = isset($cp['contact']) ? trim($cp['contact']) : '';
                    if (!empty($cp_name) || !empty($cp_mem_id) || !empty($cp_mobile)) {
                        $rec_person = new recommended_person_data_ADD_UPDATE($main_user_login_id);
                        $rec_person->get_data($cp_name, $cp_mobile, $wwjm_member_list_id, $cp_mem_id);
                        $rec_person->process_new_record();
                        $cp_saved = true;
                    }
                }
            }
        }

        if (!$cp_saved) {
            // Fallback for val_21 to val_26
            $cp1_name = isset($_POST['val_21']) ? trim($_POST['val_21']) : "";
            $cp1_membership = isset($_POST['val_22']) ? trim($_POST['val_22']) : "";
            $cp1_contact = isset($_POST['val_23']) ? trim($_POST['val_23']) : "";
            
            $cp2_name = isset($_POST['val_24']) ? trim($_POST['val_24']) : "";
            $cp2_membership = isset($_POST['val_25']) ? trim($_POST['val_25']) : "";
            $cp2_contact = isset($_POST['val_26']) ? trim($_POST['val_26']) : "";

            if (!empty($cp1_name) || !empty($cp1_membership) || !empty($cp1_contact)) {
                $rec_person1 = new recommended_person_data_ADD_UPDATE($main_user_login_id);
                $rec_person1->get_data($cp1_name, $cp1_contact, $wwjm_member_list_id, $cp1_membership);
                $rec_person1->process_new_record();
            }

            if (!empty($cp2_name) || !empty($cp2_membership) || !empty($cp2_contact)) {
                $rec_person2 = new recommended_person_data_ADD_UPDATE($main_user_login_id);
                $rec_person2->get_data($cp2_name, $cp2_contact, $wwjm_member_list_id, $cp2_membership);
                $rec_person2->process_new_record();
            }
        }

    } else {
        $state['error'] = $member_create->get_error();
    }
} else {
    $state['error'] = "Invalid Request";
}

$json[] = $state;
echo json_encode($json);
?>
