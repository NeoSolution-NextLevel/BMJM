<?php
class wwjm_member_list_SINGLE_DATA {

    private $id;
    private $ast;
    private $sdt;
    private $name_M;
    private $residence_address_M;
    private $is_own_house;
    private $is_rented_house;
    private $nic_M;
    private $email;
    private $notification_mobile_no;
    private $secondary_mobile;
    private $notification_whatsapp;
    private $profession;
    private $monthly_payment;
    private $opening_balance;
    private $approve_level_01_state;
    private $approve_level_01_person;
    private $approve_level_01_sdt;
    private $approve_level_02_state;
    private $approve_level_02_person;
    private $approve_level_02_sdt;
    private $nofication_update_app;
    private $nofication_update_sms;
    private $nofication_update_email;
    private $due_to_pay;
    private $active_state;
    private $dis;
    private $membership_no;
    private $zakath_pay_state;
    private $account_type_zakath_payee;
    private $account_type_subcrption;
    private $account_type_zakath_reciver;
    private $self_account;
    private $is_login_avable;
    private $wwjm_road_name_id; 
    private $main_user_login_id;

    private $state_of_data = false;

     public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_member_list WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);   
        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id = $row['id'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->name_M = $row['name_M'];
                $this->residence_address_M = $row['residence_address_M'];
                $this->is_own_house = $row['is_own_house'];
                $this->is_rented_house = $row['is_rented_house'];
                $this->nic_M = $row['nic_M'];
                $this->email = $row['email'];
                $this->notification_mobile_no = $row['notification_mobile_no'];
                $this->secondary_mobile = $row['secondary_mobile_no'];
                $this->notification_whatsapp = $row['notification_whatsapp'];
                $this->profession = $row['profession'];
                $this->monthly_payment = $row['monthly_payment'];
                $this->opening_balance = $row['opening_balance'];
                $this->approve_level_01_state = $row['approve_level_01_state'];
                $this->approve_level_01_person = $row['approve_level_01_person'];
                $this->approve_level_01_sdt = $row['approve_level_01_sdt'];
                $this->approve_level_02_state = $row['approve_level_02_state'];
                $this->approve_level_02_person = $row['approve_level_02_person'];
                $this->approve_level_02_sdt = $row['approve_level_02_sdt'];
                $this->nofication_update_app = $row['nofication_update_app'];
                $this->nofication_update_sms = $row['nofication_update_sms'];
                $this->nofication_update_email = $row['nofication_update_email'];
                $this->due_to_pay = $row['due_to_pay'];
                $this->active_state = $row['active_state'];
                $this->dis = $row['dis'];
                $this->membership_no = $row['membership_no'];
                $this->zakath_pay_state = $row['zakath_pay_state'];
                $this->account_type_zakath_payee = $row['account_type_zakath_payee'];
                $this->account_type_subcrption = $row['account_type_subcrption'];
                $this->account_type_zakath_reciver = $row['account_type_zakath_reciver'];
                $this->self_account = $row['self_account'];
                $this->is_login_avable = $row['login_avable'];
                $this->wwjm_road_name_id = $row['wwjm_road_name_id'];
                $this->main_user_login_id = $row['main_user_login_id'];

            }
        }
    }
    public function get_state_of_data()
    {
        return $this->state_of_data;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_ast()
    {
        return $this->ast;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_name_M()
    {
        return $this->name_M;
    }

    public function get_residence_address_M()
    {
        return $this->residence_address_M;
    }

    public function get_is_own_house()
    {
        return $this->is_own_house;
    }

    public function get_is_rented_house()
    {
        return $this->is_rented_house;
    }

    public function get_nic_M()
    {
        return $this->nic_M;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_notification_mobile_no()
    {
        return $this->notification_mobile_no;
    }

    public function get_secondary_mobile()
    {
        return $this->secondary_mobile;
    }

    public function get_notification_whatsapp()
    {
        return $this->notification_whatsapp;
    }

    public function get_profession()
    {
        return $this->profession;
    }

    public function get_monthly_payment()
    {
        return $this->monthly_payment;
    }

    public function get_opening_balance()
    {
        return $this->opening_balance;
    }

    public function get_approve_level_01_state()
    {
        return $this->approve_level_01_state;
    }

    public function get_approve_level_01_person()
    {
        return $this->approve_level_01_person;
    }

    public function get_approve_level_01_sdt()
    {
        return $this->approve_level_01_sdt;
    }

    public function get_approve_level_02_state()
    {
        return $this->approve_level_02_state;
    }

    public function get_approve_level_02_person()
    {
        return $this->approve_level_02_person;
    }

    public function get_approve_level_02_sdt()
    {
        return $this->approve_level_02_sdt;
    }

    public function get_nofication_update_app()
    {
        return $this->nofication_update_app;
    }

    public function get_nofication_update_sms()
    {
        return $this->nofication_update_sms;
    }

    public function get_nofication_update_email()
    {
        return $this->nofication_update_email;
    }

    public function get_due_to_pay()
    {
        return $this->due_to_pay;
    }

    public function get_active_state()
    {
        return $this->active_state;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_membership_no()
    {
        return $this->membership_no;
    }

    public function get_zakath_pay_state()
    {
        return $this->zakath_pay_state;
    }

    public function get_account_type_zakath_payee()
    {
        return $this->account_type_zakath_payee;
    }

    public function get_account_type_subcrption()
    {
        return $this->account_type_subcrption;
    }

    public function get_account_type_zakath_reciver()
    {
        return $this->account_type_zakath_reciver;
    }

    public function get_self_account()
    {
        return $this->self_account;
    }

    public function get_is_login_avable()
    {
        return $this->is_login_avable;
    }

    public function get_wwjm_road_name_id()
    {
        return $this->wwjm_road_name_id;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    


}