<?php

class wwjm_member_list_SINGLE_DATA
{

    private $id;
    private $name_M;
    private $residence_address_M;
    private $road_name_M;

    private $nic_M;

    private $date_of_birth;

    private $phone_residence;

    private $phone_office;

    private $phone_mobile;
    private $secondry_mobile;

    private $monlty_payment;
    private $owner;
    private $tenant;
    private $interducer_name_01;
    private $interducer_membership_no_01;
    private $interducer_name_02;
    private $interducer_membership_no_02;
    private $email;
    private $profetion;
    private $minciple_ward;
    private $notification_whatup;
    private $notification_email;
    private $notification_moible_no;
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
    private $main_user_login_id;
    private $ast = "1";
    private $sdt;

    private $wwjm_road_name_id;
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT member_data.*, road_data.road_name AS road_name_M
                          FROM wwjm_member_list AS member_data
                          LEFT JOIN wwjm_road_name AS road_data ON road_data.id = member_data.wwjm_road_name_id
                          WHERE member_data.id = '" . $this->id . "'";

        // echo $get_sql_query;
        $result = $data_base_obj->get_result($get_sql_query);
        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->name_M = isset($row['name_M']) ? $row['name_M'] : '';
                $this->residence_address_M = isset($row['residence_address_M']) ? $row['residence_address_M'] : '';
                $this->road_name_M = isset($row['road_name_M']) ? $row['road_name_M'] : null;
                $this->nic_M = isset($row['nic_M']) ? $row['nic_M'] : '';
                $this->phone_mobile = isset($row['phone_mobile']) ? $row['phone_mobile'] : null;
                $this->secondry_mobile = isset($row['secondry_mobile']) ? $row['secondry_mobile'] : null;
                $this->monlty_payment = isset($row['monlty_payment']) ? $row['monlty_payment'] : '0';
                $this->owner = isset($row['is_own_house']) ? $row['is_own_house'] : null;
                $this->tenant = isset($row['is_rented_house']) ? $row['is_rented_house'] : null;
                $this->interducer_name_01 = isset($row['interducer_name_01']) ? $row['interducer_name_01'] : null;
                $this->interducer_membership_no_01 = isset($row['interducer_membership_no_01']) ? $row['interducer_membership_no_01'] : null;
                $this->interducer_name_02 = isset($row['interducer_name_02']) ? $row['interducer_name_02'] : null;
                $this->interducer_membership_no_02 = isset($row['interducer_membership_no_02']) ? $row['interducer_membership_no_02'] : null;
                $this->email = isset($row['email']) ? $row['email'] : '';
                $this->profetion = isset($row['profession']) ? $row['profession'] : null;
                $this->notification_whatup = isset($row['notification_whatup']) ? $row['notification_whatup'] : null;
                $this->notification_email = isset($row['notification_email']) ? $row['notification_email'] : null;
                $this->notification_moible_no = isset($row['notification_moible_no']) ? $row['notification_moible_no'] : null;
                $this->approve_level_01_state = isset($row['approve_level_01_state']) ? $row['approve_level_01_state'] : '0';
                $this->approve_level_01_person = isset($row['approve_level_01_person']) ? $row['approve_level_01_person'] : null;
                $this->approve_level_01_sdt = isset($row['approve_level_01_sdt']) ? $row['approve_level_01_sdt'] : null;
                $this->approve_level_02_state = isset($row['approve_level_02_state']) ? $row['approve_level_02_state'] : '0';
                $this->approve_level_02_person = isset($row['approve_level_02_person']) ? $row['approve_level_02_person'] : null;
                $this->approve_level_02_sdt = isset($row['approve_level_02_sdt']) ? $row['approve_level_02_sdt'] : null;
                $this->nofication_update_app = isset($row['nofication_update_app']) ? $row['nofication_update_app'] : '0';
                $this->nofication_update_sms = isset($row['nofication_update_sms']) ? $row['nofication_update_sms'] : '0';
                $this->nofication_update_email = isset($row['nofication_update_email']) ? $row['nofication_update_email'] : '0';
                $this->due_to_pay = isset($row['due_to_pay']) ? $row['due_to_pay'] : '0';
                $this->active_state = isset($row['active_state']) ? $row['active_state'] : '1';
                $this->dis = isset($row['dis']) ? $row['dis'] : null;
                $this->membership_no = isset($row['membership_no']) ? $row['membership_no'] : '';
                $this->zakath_pay_state = isset($row['zakath_pay_state']) ? $row['zakath_pay_state'] : '0';
                $this->account_type_zakath_payee = isset($row['account_type_zakath_payee']) ? $row['account_type_zakath_payee'] : null;
                $this->account_type_subcrption = isset($row['account_type_subcrption']) ? $row['account_type_subcrption'] : '0';
                $this->account_type_zakath_reciver = isset($row['account_type_zakath_reciver']) ? $row['account_type_zakath_reciver'] : '0';
                $this->self_account = isset($row['self_account']) ? $row['self_account'] : null;
                $this->is_login_avable = isset($row['is_login_avable']) ? $row['is_login_avable'] : '0';
                $this->main_user_login_id = isset($row['main_user_login_id']) ? $row['main_user_login_id'] : null;
                $this->ast = isset($row['ast']) ? $row['ast'] : '1';
                $this->sdt = isset($row['sdt']) ? $row['sdt'] : null;
                $this->wwjm_road_name_id = isset($row['wwjm_road_name_id']) ? $row['wwjm_road_name_id'] : null;
            }
        }
    }

    public function get_state()
    {
        return $this->state_of_data;
    }

    public function get_wwjm_road_name_id()
    {
        return $this->wwjm_road_name_id;
    }


    public function get_id()
    {
        return $this->id;
    }
    public function get_name_M()
    {
        return $this->name_M;
    }

    public function get_residence_address_M()
    {
        return $this->residence_address_M;
    }

    public function get_road_name_M()
    {
        return $this->road_name_M;
    }

    public function get_nic_M()
    {
        return $this->nic_M;
    }

    public function get_date_of_birth()
    {
        return $this->date_of_birth;
    }

    public function get_phone_residence()
    {
        return $this->phone_residence;
    }

    public function get_phone_office()
    {
        return $this->phone_office;
    }

    public function get_phone_mobile()
    {
        return $this->phone_mobile;
    }

    public function get_contact_number()
    {
        if (!empty($this->phone_mobile)) {
            return $this->phone_mobile;
        }
        if (!empty($this->notification_moible_no)) {
            return $this->notification_moible_no;
        }
        if (!empty($this->secondry_mobile)) {
            return $this->secondry_mobile;
        }
        return !empty($this->notification_whatup) ? $this->notification_whatup : '';
    }

    public function get_contact_email()
    {
        return !empty($this->email) ? $this->email : $this->notification_email;
    }

    public function get_monlty_payment()
    {
        return $this->monlty_payment;
    }

    public function get_next_subscription_date()
    {
        $next_month = new DateTime('first day of next month', new DateTimeZone('Asia/Colombo'));
        return $next_month->format('Y-m-d');
    }

    public function get_tenant()
    {
        return $this->tenant;
    }

    public function get_interducer_name_01()
    {
        return $this->interducer_name_01;
    }

    public function get_interducer_membership_no_01()
    {
        return $this->interducer_membership_no_01;
    }

    public function get_interducer_name_02()
    {
        return $this->interducer_name_02;
    }

    public function get_interducer_membership_no_02()
    {
        return $this->interducer_membership_no_02;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_profetion()
    {
        return $this->profetion;
    }

    public function get_minciple_ward()
    {
        return $this->minciple_ward;
    }

    public function get_notification_whatup()
    {
        return $this->notification_whatup;
    }

    public function get_notification_email()
    {
        return $this->notification_email;
    }

    public function get_notification_moible_no()
    {
        return $this->notification_moible_no;
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

    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_owner()
    {
        return $this->owner;
    }
     public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
}
