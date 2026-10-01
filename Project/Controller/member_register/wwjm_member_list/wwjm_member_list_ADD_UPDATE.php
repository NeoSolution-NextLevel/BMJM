<?php
class wwjm_member_list_ADD_UPDATE {
    private $id;
    private $ast ="1";
    private $sdt;
    private $name_M;
    private $residence_address_M;
    private $is_own_house = "0";
    private $is_rented_house = "0";
    private $nic_M;
    private $email;
    private $notification_mobile_no;
    private $secondary_mobile;
    private $notification_whatsapp;
    private $profession;
    private $monthly_payment;
    private $opening_balance;
    private $approve_level_01_state = "0";
    private $approve_level_01_person;
    private $approve_level_01_sdt;
    private $approve_level_02_state = "0";
    private $approve_level_02_person;
    private $approve_level_02_sdt;
    private $nofication_update_app="0";
    private $nofication_update_sms="0";
    private $nofication_update_email="0";
    private $due_to_pay;
    private $active_state="0";
    private $dis;
    private $membership_no;
    private $zakath_pay_state="0";
    private $account_type_zakath_payee="0";
    private $account_type_subcrption="0";
    private $account_type_zakath_reciver="0";
    private $self_account="0";
    private $is_login_avable="0";
    private $wwjm_road_name_id; 
    private $main_user_login_id;
    private $sql_update_query = "";

    public function __construct($main_user_login_id) {
        $this->main_user_login_id = $main_user_login_id;
        $this->sdt = date("Y-m-d H:i:s");

    }
    public function check_member_exist($get_nic_M, $get_email, $get_notification_mobile_no) {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT id, nic_M, email, notification_moible_no 
        FROM wwjm_member_list
        WHERE ast = '1'
        AND (
            nic_M = '$get_nic_M'
            OR email = '$get_email'
            OR notification_moible_no = '$get_notification_mobile_no'
        )
         LIMIT 1 ";

        // echo $get_sql_query;
        $result = $data_base_obj->get_result($get_sql_query);
        
        if ($result->num_rows > 0) {
            return true; // Member exists
        } else {
            return false; // Member does not exist
        }
    }

    public function get_data($get_name_M, $get_residence_address_M, $get_nic_M, $get_email, $get_notification_mobile_no, $get_secondary_mobile, $get_notification_whatsapp, $get_profession, $get_monthly_payment, $get_opening_balance, $get_approve_level_01_person, $get_approve_level_01_sdt, $get_approve_level_02_person, $get_approve_level_02_sdt, $get_nofication_update_email, $get_due_to_pay, $get_active_state, $get_dis,$membership_no,$get_wwjm_road_name_id) {
        $this->name_M = $get_name_M;
        $this->residence_address_M = $get_residence_address_M;
        $this->nic_M = $get_nic_M;
        $this->email = $get_email;
        $this->notification_mobile_no = $get_notification_mobile_no;
        $this->secondary_mobile = $get_secondary_mobile;
        $this->notification_whatsapp = $get_notification_whatsapp;
        $this->profession = $get_profession;
        $this->monthly_payment = $get_monthly_payment;
        $this->opening_balance = $get_opening_balance;
        $this->approve_level_01_person = $get_approve_level_01_person;
        $this->approve_level_01_sdt = $get_approve_level_01_sdt;
        $this->approve_level_02_person = $get_approve_level_02_person;
        $this->approve_level_02_sdt = $get_approve_level_02_sdt;
        $this->due_to_pay = $get_due_to_pay;
        $this->dis = $get_dis;
        $this->membership_no = $membership_no;
        $this->wwjm_road_name_id = $get_wwjm_road_name_id;
        $this->sql_update_query= 
                            ",name_M='" . $this->name_M . "', 
                              residence_address_M='" . $this->residence_address_M . "',
                              nic_M='" . $this->nic_M . "',
                              email='" . $this->email . "',
                              notification_mobile_no='" . $this->notification_mobile_no . "',
                              secondary_mobile='" . $this->secondary_mobile . "',
                              notification_whatsapp='" . $this->notification_whatsapp . "',
                              profession='" . $this->profession . "',
                              monthly_payment='" . $this->monthly_payment . "',
                              opening_balance='" . $this->opening_balance . "',
                              approve_level_01_person='" . $this->approve_level_01_person . "',
                              approve_level_01_sdt='" . $this->approve_level_01_sdt . "',
                              approve_level_02_person='" . $this->approve_level_02_person . "',
                              approve_level_02_sdt='" . $this->approve_level_02_sdt . "',
                              due_to_pay='" . $this->due_to_pay . "',
                              dis='" . $this->dis . "',
                              membership_no='" . $this->membership_no . "',
                              wwjm_road_name_id='" . $this->wwjm_road_name_id . "'";
        
    }

    public function is_own_house()
    {
        $this->is_own_house = "1";
        $this->sql_update_query = $this->sql_update_query . ",is_own_house=" . $this->is_own_house;
    }

    public function is_not_own_house()
    {
        $this->is_own_house = "0";
        $this->sql_update_query = $this->sql_update_query . ",is_own_house=" . $this->is_own_house;
    }

    public function is_rented_house()
    {
        $this->is_rented_house = "1";
        $this->sql_update_query = $this->sql_update_query . ",is_rented_house=" . $this->is_rented_house;
    }

    public function is_not_rented_house()
    {
        $this->is_rented_house = "0";
        $this->sql_update_query = $this->sql_update_query . ",is_rented_house=" . $this->is_rented_house;
    }

    public function is_approve_level_01_state()
    {
        $this->approve_level_01_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",approve_level_01_state=" . $this->approve_level_01_state;
    }

    public function is_not_approve_level_01_state()
    {
        $this->approve_level_01_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",approve_level_01_state=" . $this->approve_level_01_state;
    }   

    public function is_approve_level_02_state()
    {
        $this->approve_level_02_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",approve_level_02_state=" . $this->approve_level_02_state;
    }

    public function is_not_approve_level_02_state()
    {
        $this->approve_level_02_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",approve_level_02_state=" . $this->approve_level_02_state;
    }   
    
    public function is_nofication_update_app()
    {
        $this->nofication_update_app = "1";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_app=" . $this->nofication_update_app;   
    }

    public function is_not_nofication_update_app()
    {
        $this->nofication_update_app = "0";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_app=" . $this->nofication_update_app;
    }   

    public function is_nofication_update_sms()
    {
        $this->nofication_update_sms = "1";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_sms=" . $this->nofication_update_sms;   
    }

    public function is_not_nofication_update_sms()
    {
        $this->nofication_update_sms = "0";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_sms=" . $this->nofication_update_sms;
    }   

    public function is_nofication_update_email()
    {
        $this->nofication_update_email = "1";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_email=" . $this->nofication_update_email;   
    }

    public function is_not_nofication_update_email()
    {
        $this->nofication_update_email = "0";
        $this->sql_update_query = $this->sql_update_query . ",nofication_update_email=" . $this->nofication_update_email;
    }   

    public function is_active_state()
    {
        $this->active_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",active_state=" . $this->active_state;
    }

    public function is_not_active_state()
    {
        $this->active_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",active_state=" . $this->active_state;
    }   

    public function is_zakath_pay_state()
    {
        $this->zakath_pay_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",zakath_pay_state=" . $this->zakath_pay_state;
    }

    public function is_not_zakath_pay_state()
    {
        $this->zakath_pay_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",zakath_pay_state=" . $this->zakath_pay_state;
    }   

    public function is_account_type_zakath_payee()
    {
        $this->account_type_zakath_payee = "1";
        $this->sql_update_query = $this->sql_update_query . ",account_type_zakath_payee=" . $this->account_type_zakath_payee;
    }

    public function is_not_account_type_zakath_payee()
    {
        $this->account_type_zakath_payee = "0";
        $this->sql_update_query = $this->sql_update_query . ",account_type_zakath_payee=" . $this->account_type_zakath_payee;
    }   

    public function is_account_type_subcrption()
    {
        $this->account_type_subcrption = "1";
        $this->sql_update_query = $this->sql_update_query . ",account_type_subcrption=" . $this->account_type_subcrption;
    }

    public function is_not_account_type_subcrption()
    {
        $this->account_type_subcrption = "0";
        $this->sql_update_query = $this->sql_update_query . ",account_type_subcrption=" . $this->account_type_subcrption;
    }       

    public function is_account_type_zakath_reciver()
    {
        $this->account_type_zakath_reciver = "1";
        $this->sql_update_query = $this->sql_update_query . ",account_type_zakath_reciver=" . $this->account_type_zakath_reciver;
    }

    public function is_not_account_type_zakath_reciver()
    {
        $this->account_type_zakath_reciver = "0";
        $this->sql_update_query = $this->sql_update_query . ",account_type_zakath_reciver=" . $this->account_type_zakath_reciver;
    }   

    public function is_self_account()
    {
        $this->self_account  = "1";
        $this->sql_update_query = $this->sql_update_query . ",self_account=" . $this->self_account;
    }

    public function is_not_self_account()
    {
        $this->self_account = "0";
        $this->sql_update_query = $this->sql_update_query . ",self_account=" . $this->self_account;
    }   

    public function is_login_avable()
    {
        $this->is_login_avable = "1";
        $this->sql_update_query = $this->sql_update_query . ",login_avable=" . $this->is_login_avable;
    }

    public function is_not_login_avable()
    {
        $this->is_login_avable = "0";
        $this->sql_update_query = $this->sql_update_query . ",login_avable=" . $this->is_login_avable;
    }   





    public function set_name_M($get_name_M) 
    {
        $this->name_M = $get_name_M;
        $this->sql_update_query = $this->sql_update_query . ",name_M='" . $this->name_M;
    }

    public function set_residence_address_M($get_residence_address_M)
    {
        $this->residence_address_M = $get_residence_address_M;
        $this->sql_update_query = $this->sql_update_query . ",residence_address_M='" . $this->residence_address_M;
    } 
    
    public function set_nic_M( $get_nic_M)
    {
        $this->nic_M = $get_nic_M;
        $this->sql_update_query = $this->sql_update_query . ",nic_M='" . $this->nic_M;
    }

    public function set_email($get_email)
    {
        $this->email = $get_email;
        $this->sql_update_query = $this->sql_update_query . ",email='" . $this->email;
    }   

    public function set_notification_mobile_no($get_notification_mobile_no)
    {
        $this->notification_mobile_no = $get_notification_mobile_no;
        $this->sql_update_query = $this->sql_update_query . ",notification_mobile_no='" . $this->notification_mobile_no;
    }

    public function set_secondary_mobile_no($get_secondary_mobile)
    {
        $this->secondary_mobile = $get_secondary_mobile;
        $this->sql_update_query = $this->sql_update_query . ",secondary_mobile_no='" . $this->secondary_mobile;
    }
    
    public function set_notification_whatsapp($get_notification_whatsapp)
    {
        $this->notification_whatsapp = $get_notification_whatsapp;
        $this->sql_update_query = $this->sql_update_query . ",notification_whatsapp='" . $this->notification_whatsapp;
    }

    public function set_profession($get_profession)
    {
        $this->profession = $get_profession;
        $this->sql_update_query = $this->sql_update_query . ",profession='" . $this->profession;
    }

    public function set_monthly_payment($get_monthly_payment)
    {
        $this->monthly_payment = $get_monthly_payment;
        $this->sql_update_query = $this->sql_update_query . ",monthly_payment='" . $this->monthly_payment;
    }

    public function set_opening_balance($get_opening_balance)
    {
        $this->opening_balance = $get_opening_balance;
        $this->sql_update_query = $this->sql_update_query . ",opening_balance='" . $this->opening_balance;
    }

    public function set_approve_level_01_person($get_approve_level_01_person)
    {
        $this->approve_level_01_person = $get_approve_level_01_person;
        $this->sql_update_query = $this->sql_update_query . ",approve_level_01_person='" . $this->approve_level_01_person;
    }

    public function set_approve_level_01_sdt($get_approve_level_01_sdt)
    {
        $this->approve_level_01_sdt = $get_approve_level_01_sdt;
        $this->sql_update_query = $this->sql_update_query . ",approve_level_01_sdt='" . $this->approve_level_01_sdt;
    }

    public function set_approve_level_02_person($get_approve_level_02_person)
    {
        $this->approve_level_02_person = $get_approve_level_02_person;
        $this->sql_update_query = $this->sql_update_query . ",approve_level_02_person='" . $this->approve_level_02_person;
    }

    public function set_approve_level_02_sdt($get_approve_level_02_sdt)
    {
        $this->approve_level_02_sdt = $get_approve_level_02_sdt;
        $this->sql_update_query = $this->sql_update_query . ",approve_level_02_sdt='" . $this->approve_level_02_sdt;
    }

    public function set_due_to_pay($get_due_to_pay)
    {
        $this->due_to_pay = $get_due_to_pay;
        $this->sql_update_query = $this->sql_update_query . ",due_to_pay='" . $this->due_to_pay;
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query = $this->sql_update_query . ",dis='" . $this->dis;
    }

    public function set_membership_no($get_membership_no)
    {
        $this->membership_no = $get_membership_no;
        $this->sql_update_query = $this->sql_update_query . ",membership_no='" . $this->membership_no;
    } 

    public function set_wwjm_road_name_id($get_wwjm_road_name_id)
    {
        $this->wwjm_road_name_id = $get_wwjm_road_name_id;
        $this->sql_update_query = $this->sql_update_query . ",wwjm_road_name_id='" . $this->wwjm_road_name_id;
    }   

    public function remove()
    {
        $this->ast = "0";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "INSERT INTO wwjm_member_list(
            ast,
            sdt,
            name_M,
            residence_address_M,
            is_own_house,
            is_rented_house,
            nic_M,
            email,
            notification_moible_no,
            secondry_mobile,
            notification_whatup,
            profession,
            monlty_payment,
            opening_balance,
            approve_level_01_state,
            approve_level_01_person,
            approve_level_01_sdt,
            approve_level_02_state,
            approve_level_02_person,
            approve_level_02_sdt,
            nofication_update_app,
            nofication_update_sms,
            nofication_update_email,
            due_to_pay,
            active_state,
            dis,
            membership_no,
            zakath_pay_state,
            account_type_zakath_payee,
            account_type_subcrption,
            account_type_zakath_reciver,
            self_account,
            is_login_avable,
            wwjm_road_name_id,
            main_user_login_id
        ) VALUES ("
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->name_M . "', "
            . "'" . $this->residence_address_M . "', "
            . "'" . $this->is_own_house . "', "
            . "'" . $this->is_rented_house . "', "
            . "'" . $this->nic_M . "', "
            . "'" . $this->email . "', "
            . "'" . $this->notification_mobile_no . "', "
            . "'" . $this->secondary_mobile . "', "
            . "'" . $this->notification_whatsapp . "', "
            . "'" . $this->profession . "', "
            . "'" . $this->monthly_payment . "', "
            . "'" . $this->opening_balance . "', "
            . "'" . $this->approve_level_01_state . "', "
            . "'" . $this->approve_level_01_person . "', "
            . "'" . $this->approve_level_01_sdt . "', "
            . "'" . $this->approve_level_02_state . "', "
            . "'" . $this->approve_level_02_person . "', "
            . "'" . $this->approve_level_02_sdt . "', "
            . "'" . $this->nofication_update_app . "', "
            . "'" . $this->nofication_update_sms . "', "
            . "'" . $this->nofication_update_email . "', "
            . "'" . $this->due_to_pay . "', "
            . "'" . $this->active_state . "', "
            . "'" . $this->dis . "', "
            . "'" . $this->membership_no . "', "
            . "'" . $this->zakath_pay_state . "', "
            . "'" . $this->account_type_zakath_payee . "', "
            . "'" . $this->account_type_subcrption . "', "
            . "'" . $this->account_type_zakath_reciver . "', "
            . "'" . $this->self_account . "', "
            . "'" . $this->is_login_avable . "', "
            . "'" . $this->wwjm_road_name_id . "', "
            . "'" . $this->main_user_login_id . "');";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_data_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query_data = "update wwjm_member_list set sdt='" . $this->sdt . "' " . $this->sql_update_query . " where id='" . $this->id . "';";
        $data_base_obj->get_result($get_sql_query_data);
         $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
        // return true; // Placeholder for testing
    }
}




         
        
           