<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/wwjm_member_list/wwjm_member_list_SINGLE_DATA.php';
$file_sec_id = __DIR__ . '/../../Controller/management_notification/management_notification_SINGLE_DATA_SEC_ID.php';
if (file_exists($file_sec_id)) {
    include_once $file_sec_id;
}

$search_txt = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : "";
$sec_id     = isset($_POST['sec_id']) ? trim($_POST['sec_id']) : "";

$json = array();

if (!empty($sec_id)) {
    $Member_sec_id_obj = new management_notification_SINGLE_DATA_SEC_ID($sec_id);

    if ($Member_sec_id_obj->get_state()) {
        $member_id     = $Member_sec_id_obj->get_wwjm_member_list_id();
        $Process_state = $Member_sec_id_obj->get_process_state();

        if ($Process_state == 1) {
            // echo "coded is hear";
            $member_obj = new wwjm_member_list_SINGLE_DATA($member_id);
            // echo "coded is hear";

        } else {
            $state_data['error'] = "Already Approved";
            $json[] = $state_data;
            echo json_encode($json);
            exit;
        }
    } else {
        $state_data['error'] = "Invalid sec_id";
        $json[] = $state_data;
        echo json_encode($json);
        exit;
    }
} else {
    $member_id = isset($_POST['id']) ? trim($_POST['id']) : '0';
    $main_login_id = isset($_POST['main_user_login_id']) ? trim($_POST['main_user_login_id']) : '';

    if (!empty($main_login_id)) {
        $db_fallback = new DataBase();
        $res_fallback = $db_fallback->get_result("SELECT id FROM wwjm_member_list WHERE main_user_login_id='$main_login_id' LIMIT 1");
        if ($res_fallback && $row_fallback = $res_fallback->fetch_assoc()) {
            $member_id = $row_fallback['id'];
        }
    } else if (empty($member_id) || $member_id === '0' || $member_id === 'undefined') {
        $db_fallback = new DataBase();
        $res_fallback = $db_fallback->get_result("SELECT id FROM wwjm_member_list WHERE ast='1' ORDER BY id DESC LIMIT 1");
        if ($res_fallback && $row_fallback = $res_fallback->fetch_assoc()) {
            $member_id = $row_fallback['id'];
        }
    }
    $member_obj = new wwjm_member_list_SINGLE_DATA($member_id);
}

if (isset($member_obj) && $member_obj->get_state()) {
    $state_data['id']                          = $member_obj->get_id();
    $state_data['name_M']                      = $member_obj->get_name_M();
    $state_data['email']                      = $member_obj->get_email();
    $state_data['residence_address_M']         = $member_obj->get_residence_address_M();
    $state_data['nic_M']         = $member_obj->get_nic_M();
    $state_data['road_name_M']         = $member_obj->get_road_name_M();
    $state_data['notification_whatup']         = $member_obj->get_notification_whatup();
    $state_data['notification_moible_no']      = $member_obj->get_notification_moible_no();
    $state_data['phone_mobile']                = $member_obj->get_contact_number();
    $state_data['owner']                       = $member_obj->get_owner();
    $state_data['tenant']                      = $member_obj->get_tenant();
    $state_data['profetion']                   = $member_obj->get_profetion();
    $state_data['interducer_name_01']          = $member_obj->get_interducer_name_01();
    $state_data['interducer_membership_no_01'] = $member_obj->get_interducer_membership_no_01();
    $state_data['interducer_name_02']          = $member_obj->get_interducer_name_02();
    $state_data['interducer_membership_no_02'] = $member_obj->get_interducer_membership_no_02();
    $state_data['due_to_pay']                  = $member_obj->get_due_to_pay();
    $state_data['monlty_payment']              = $member_obj->get_monlty_payment();
    $state_data['next_subscription_date']      = $member_obj->get_next_subscription_date();
    $state_data['account_type_subcrption']     = $member_obj->get_account_type_subcrption();
    $state_data['zakath_pay_state']            = $member_obj->get_zakath_pay_state();
    $state_data['account_type_zakath_payee']   = $member_obj->get_account_type_zakath_payee();
    $state_data['account_type_zakath_reciver'] = $member_obj->get_account_type_zakath_reciver();
    $state_data['nofication_update_sms']       = $member_obj->get_nofication_update_sms();
    $state_data['membership_no']       = $member_obj->get_membership_no();
    $state_data['wwjm_road_name_id']       = $member_obj->get_wwjm_road_name_id();
    $state_data['nofication_update_email']     = $member_obj->get_nofication_update_email();

    // Fetch 2FA Status natively
    $main_login_query_id = isset($_POST['main_user_login_id']) ? trim($_POST['main_user_login_id']) : '';
    if (empty($main_login_query_id) && isset($member_id)) {
        // Fallback fetch if queried by member ID
        $db_login_fall = new DataBase();
        $fallback_res = $db_login_fall->get_result("SELECT main_user_login_id FROM wwjm_member_list WHERE id='{$member_id}' LIMIT 1");
        if ($fallback_res && $row_f = $fallback_res->fetch_assoc()) {
            $main_login_query_id = $row_f['main_user_login_id'];
        }
    }

    if (!empty($main_login_query_id)) {
        $db_login = new DataBase();
        $res_login = $db_login->get_result("SELECT is_two_factor_auth_enable FROM main_user_login WHERE id='{$main_login_query_id}' LIMIT 1");
        if ($res_login && $row_login = $res_login->fetch_assoc()) {
            $state_data['is_two_factor_auth_enable'] = $row_login['is_two_factor_auth_enable'];
        }
    }

    $json[] = $state_data;
}

echo json_encode($json);
