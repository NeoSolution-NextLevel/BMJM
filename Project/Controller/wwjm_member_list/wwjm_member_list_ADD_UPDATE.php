
<?php

class wwjm_member_list_ADD_UPDATE
{

    private $id;
    private $name_M;
    private $residence_address_M;
    private $road_name_M;
    private $nic_M;
    private $phone_mobile;
    private $monlty_payment;
    private $owner;
    private $tenant;
    private $interducer_name_01;
    private $interducer_membership_no_01;
    private $interducer_name_02;
    private $interducer_membership_no_02;
    private $email;
    private $profetion;
    private $notification_whatup;
    private $notification_email = 'null';
    private $notification_moible_no;
    private $approve_level_01_state = 0;
    private $approve_level_01_person = 'approve level 1 not found';
    private $approve_level_01_sdt;
    private $approve_level_02_state = 0;
    private $approve_level_02_person = 'approve level 2 not found';
    private $approve_level_02_sdt;
    private $nofication_update_app = 0;
    private $nofication_update_sms = 0;
    private $nofication_update_email = 0;
    private $due_to_pay;
    private $active_state;
    private $dis = 'Not found';
    private $membership_no = 0;
    private $zakath_pay_state=0;
    private $account_type_zakath_payee = 0;
    private $account_type_subcrption = 0;
    private $account_type_zakath_reciver = 0;
    // private $account_type_zakath_payee = 0;
    // private $account_type_subcrption = 0;
    // private $account_type_zakath_reciver = 0;
    private $self_account;
    private $is_login_avable = 0;
    private $ast = "1";
    private $sdt;
    private $wwjm_road_name_id;
    private $interducer_contact_01;

    private $interducer_contact_02;
    private $sql_update_query = "";

    public function __construct()
    {
        $this->sdt = date(format: 'Y-m-d H:i:s');
    }

    public function set_sdt_default()
    {
        $this->approve_level_01_sdt = date(format: 'Y-m-d H:i:s');
        $this->approve_level_02_sdt = date(format: 'Y-m-d H:i:s');
    }
    public function set_data(
        $get_name_M,
        $get_residence_address_M,
        $get_nic_M,
        $get_phone_mobile,
        $get_monlty_payment,
        $get_interducer_name_01 = '',
        $get_interducer_membership_no_01 = '',
        $get_interducer_name_02 = '',
        $get_interducer_membership_no_02 = '',
        $get_email = '',
        $get_profetion = '',
        $get_notification_whatup = '',
        $get_notification_email = '',
        $get_notification_moible_no = '',
        $get_due_to_pay = '',
        $get_wwjm_road_name_id = '',
        $get_interducer_contact_01 = '',
        $get_interducer_contact_02 = ''
    ) {
        $this->name_M = $get_name_M;
        $this->residence_address_M = $get_residence_address_M;
        $this->nic_M = $get_nic_M;
        $this->phone_mobile = $get_phone_mobile;
        $this->monlty_payment = $get_monlty_payment;
        $this->email = $get_email;
        $this->profetion = $get_profetion;
        $this->notification_whatup = $get_notification_whatup;
        $this->notification_email = $get_notification_email;
        $this->notification_moible_no = $get_notification_moible_no;
        $this->due_to_pay = $get_due_to_pay;
        $this->wwjm_road_name_id = $get_wwjm_road_name_id;

        $this->sql_update_query .=
            ",name_M='" . $this->name_M . "'" .
            ",residence_address_M='" . $this->residence_address_M . "'" .
            ",nic_M='" . $this->nic_M . "'" .
            ",phone_mobile='" . $this->phone_mobile . "'" .
            ",monlty_payment='" . $this->monlty_payment . "'" .
            ",email='" . $this->email . "'" .
            ",profetion='" . $this->profetion . "'" .
            ",notification_whatup='" . $this->notification_whatup . "'" .
            ",notification_email='" . $this->notification_email . "'" .
            ",notification_moible_no='" . $this->notification_moible_no . "'" .
            ",owner='" . $this->owner . "'" .
            ",due_to_pay='" . $this->due_to_pay . "'" .
            ",wwjm_road_name_id='" . $this->wwjm_road_name_id . "'";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_name_M($get_name_M)
    {
        $this->name_M = $get_name_M;
        $this->sql_update_query .= ",name_M='" . $this->name_M . "'";
    }

    public function set_residence_address_M($get_residence_address_M)
    {
        $this->residence_address_M = $get_residence_address_M;
        $this->sql_update_query .= ",residence_address_M='" . $this->residence_address_M . "'";
    }

    public function set_road_name_M($get_road_name_M)
    {
        $this->road_name_M = $get_road_name_M;
        $this->sql_update_query .= ",road_name_M='" . $this->road_name_M . "'";
    }

    public function set_nic_M($get_nic_M)
    {
        $this->nic_M = $get_nic_M;
        $this->sql_update_query .= ",nic_M='" . $this->nic_M . "'";
    }

    public function set_phone_mobile($get_phone_mobile)
    {
        $this->phone_mobile = $get_phone_mobile;
        $this->sql_update_query .= ",phone_mobile='" . $this->phone_mobile . "'";
    }

    public function set_monlty_payment($get_monlty_payment)
    {
        $this->monlty_payment = $get_monlty_payment;
        $this->sql_update_query .= ",monlty_payment=GREATEST(IFNULL(monlty_payment,0),'" . $this->monlty_payment . "')";
    }

    public function set_tenant($get_tenant)
    {
        $this->tenant = $get_tenant;
        $this->sql_update_query .= ",tenant='" . $this->tenant . "'";
    }

    public function set_is_own_house($get_is_own_house)
    {
        $this->owner = $get_is_own_house;
        $this->sql_update_query .= ",is_own_house='" . $this->owner . "'";
    }

    public function set_is_rented_house($get_is_rented_house)
    {
        $this->tenant = $get_is_rented_house;
        $this->sql_update_query .= ",is_rented_house='" . $this->tenant . "'";
    }

    public function set_interducer_name_01($get_interducer_name_01)
    {
        $this->interducer_name_01 = $get_interducer_name_01;
        $this->sql_update_query .= ",interducer_name_01='" . $this->interducer_name_01 . "'";
    }

    public function set_interducer_membership_no_01($get_interducer_membership_no_01)
    {
        $this->interducer_membership_no_01 = $get_interducer_membership_no_01;
        $this->sql_update_query .= ",interducer_membership_no_01='" . $this->interducer_membership_no_01 . "'";
    }

    public function set_interducer_name_02($get_interducer_name_02)
    {
        $this->interducer_name_02 = $get_interducer_name_02;
        $this->sql_update_query .= ",interducer_name_02='" . $this->interducer_name_02 . "'";
    }

    public function set_interducer_membership_no_02($get_interducer_membership_no_02)
    {
        $this->interducer_membership_no_02 = $get_interducer_membership_no_02;
        $this->sql_update_query .= ",interducer_membership_no_02='" . $this->interducer_membership_no_02 . "'";
    }

    public function set_email($get_email)
    {
        $this->email = $get_email;
        $this->sql_update_query .= ",email='" . $this->email . "'";
    }

    public function set_profetion($get_profetion)
    {
        $this->profetion = $get_profetion;
        $this->sql_update_query .= ",profetion='" . $this->profetion . "'";
    }

    public function set_owner($get_owner)
    {
        $this->owner = $get_owner;
        $this->sql_update_query .= ",owner='" . $this->owner . "'";
    }

    public function set_notification_whatup($get_notification_whatup)
    {
        $this->notification_whatup = $get_notification_whatup;
        $this->sql_update_query .= ",notification_whatup='" . $this->notification_whatup . "'";
    }

    public function set_notification_email($get_notification_email)
    {
        $this->notification_email = $get_notification_email;
        $this->sql_update_query .= ",notification_email='" . $this->notification_email . "'";
    }

    public function set_notification_moible_no($get_notification_moible_no)
    {
        $this->notification_moible_no = $get_notification_moible_no;
        $this->sql_update_query .= ",notification_moible_no='" . $this->notification_moible_no . "'";
    }

    public function set_approve_level_01_state($get_approve_level_01_state)
    {
        $this->approve_level_01_state = $get_approve_level_01_state;
        $this->sql_update_query .= ",approve_level_01_state='" . $this->approve_level_01_state . "'";
    }

    public function set_approve_level_01_person($get_approve_level_01_person)
    {
        $this->approve_level_01_person = $get_approve_level_01_person;
        $this->sql_update_query .= ",approve_level_01_person='" . $this->approve_level_01_person . "'";
    }

    public function set_approve_level_01_sdt($get_approve_level_01_sdt)
    {
        $this->approve_level_01_sdt = $get_approve_level_01_sdt;
        $this->sql_update_query .= ",approve_level_01_sdt='" . $this->approve_level_01_sdt . "'";
    }

    public function set_approve_level_02_state($get_approve_level_02_state)
    {
        $this->approve_level_02_state = $get_approve_level_02_state;
        $this->sql_update_query .= ",approve_level_02_state='" . $this->approve_level_02_state . "'";
    }

    public function set_approve_level_02_person($get_approve_level_02_person)
    {
        $this->approve_level_02_person = $get_approve_level_02_person;
        $this->sql_update_query .= ",approve_level_02_person='" . $this->approve_level_02_person . "'";
    }

    public function set_approve_level_02_sdt($get_approve_level_02_sdt)
    {
        $this->approve_level_02_sdt = $get_approve_level_02_sdt;
        $this->sql_update_query .= ",approve_level_02_sdt='" . $this->approve_level_02_sdt . "'";
    }

    public function set_nofication_update_app($get_nofication_update_app)
    {
        $this->nofication_update_app = $get_nofication_update_app;
        $this->sql_update_query .= ",nofication_update_app='" . $this->nofication_update_app . "'";
    }

    public function set_nofication_update_sms($get_nofication_update_sms)
    {
        $this->nofication_update_sms = $get_nofication_update_sms;
        $this->sql_update_query .= ",nofication_update_sms='" . $this->nofication_update_sms . "'";
    }

    public function set_nofication_update_email($get_nofication_update_email)
    {
        $this->nofication_update_email = $get_nofication_update_email;
        $this->sql_update_query .= ",nofication_update_email='" . $this->nofication_update_email . "'";
    }

    public function set_due_to_pay($get_due_to_pay)
    {
        $this->due_to_pay = $get_due_to_pay;
        $this->sql_update_query .= ",due_to_pay='" . $this->due_to_pay . "'";
    }

    public function set_active_state($get_active_state)
    {
        $this->active_state = $get_active_state;
        $this->sql_update_query .= ",active_state='" . $this->active_state . "'";
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }

    public function set_membership_no($get_membership_no)
    {
        $this->membership_no = $get_membership_no;
        $this->sql_update_query .= ",membership_no='" . $this->membership_no . "'";
    }


    public function set_account_type_zakath_payee($get_account_type_zakath_payee)
    {
        $this->account_type_zakath_payee = $get_account_type_zakath_payee;
        $this->sql_update_query .= ",account_type_zakath_payee='" . $this->account_type_zakath_payee . "'";
    }

    public function set_account_type_subcrption($get_account_type_subcrption)
    {
        $this->account_type_subcrption = $get_account_type_subcrption;
        $this->sql_update_query .= ",account_type_subcrption='" . $this->account_type_subcrption . "'";
    }

    public function set_account_type_zakath_reciver($get_account_type_zakath_reciver)
    {
        $this->account_type_zakath_reciver = $get_account_type_zakath_reciver;
        $this->sql_update_query .= ",account_type_zakath_reciver='" . $this->account_type_zakath_reciver . "'";
    }



    public function set_is_login_avable($get_is_login_avable)
    {
        $this->is_login_avable = $get_is_login_avable;
        $this->sql_update_query .= ",is_login_avable='" . $this->is_login_avable . "'";
    }

    public function set_wwjm_road_name_id($get_wwjm_road_name_id)
    {
        $this->wwjm_road_name_id = $get_wwjm_road_name_id;
        $this->sql_update_query .= ",wwjm_road_name_id='" . $this->wwjm_road_name_id . "'";
    }

    public function is_Owner()
    {
        $this->owner = 1;
        $this->sql_update_query .= ",owner='" . $this->owner . "'";
    }
    public function is_Not_Owner()
    {
        $this->owner = 0;
        $this->sql_update_query .= ",owner='" . $this->owner . "'";
    }

    public function is_tenant()
    {
        $this->tenant = 1;
        $this->sql_update_query .= ",tenant='" . $this->tenant . "'";
    }

    public function is_Not_tenant()
    {
        $this->tenant = 0;
        $this->sql_update_query .= ",tenant='" . $this->tenant . "'";
    }

    public function is_zakath_pay_state()
    {
        $this->zakath_pay_state = 1;
        $this->sql_update_query .= ",zakath_pay_state='" . $this->zakath_pay_state . "'";
    }

    public function is_Not_zakath_pay_state()
    {
        $this->zakath_pay_state = 0;
        $this->sql_update_query .= ",zakath_pay_state='" . $this->zakath_pay_state . "'";
    }

    public function is_approve_level_01_state()
    {
        $this->approve_level_01_state = 1;
        $this->sql_update_query .= ",approve_level_01_state='" . $this->approve_level_01_state . "'";
    }

    public function is_not_approve_level_01_state()
    {
        $this->approve_level_01_state = 0;
        $this->sql_update_query .= ",approve_level_01_state='" . $this->approve_level_01_state . "'";
    }

    public function is_approve_level_02_state()
    {
        $this->approve_level_02_state = 1;
        $this->sql_update_query .= ",approve_level_02_state='" . $this->approve_level_02_state . "'";
    }

    public function is_not_approve_level_02_state()
    {
        $this->approve_level_02_state = 0;
        $this->sql_update_query .= ",approve_level_02_state='" . $this->approve_level_02_state . "'";
    }

    public function is_nofication_update_app()
    {
        $this->nofication_update_app = 1;
        $this->sql_update_query .= ",nofication_update_app='" . $this->nofication_update_app . "'";
    }

    public function is_not_nofication_update_app()
    {
        $this->nofication_update_app = 0;
        $this->sql_update_query .= ",nofication_update_app='" . $this->nofication_update_app . "'";
    }

    public function is_nofication_update_sms()
    {
        $this->nofication_update_sms = 1;
        $this->sql_update_query .= ",nofication_update_sms='" . $this->nofication_update_sms . "'";
    }
    public function is_not_nofication_update_sms()
    {
        $this->nofication_update_sms = 0;
        $this->sql_update_query .= ",nofication_update_sms='" . $this->nofication_update_sms . "'";
    }

    public function is_nofication_update_email()
    {
        $this->nofication_update_email = 1;
        $this->sql_update_query .= ",nofication_update_email='" . $this->nofication_update_email . "'";
    }

    public function is_not_nofication_update_email()
    {
        $this->nofication_update_email = 0;
        $this->sql_update_query .= ",nofication_update_email='" . $this->nofication_update_email . "'";
    }

    public function is_active_state()
    {
        $this->active_state = 1;
        $this->sql_update_query .= ",active_state='" . $this->active_state . "'";
    }


    public function is_not_active_state()
    {
        $this->active_state = 0;
        $this->sql_update_query .= ",active_state='" . $this->active_state . "'";
    }

    public function is_account_type_zakath_payee()
    {
        $this->account_type_zakath_payee = 1;
        $this->sql_update_query .= ",account_type_zakath_payee='" . $this->account_type_zakath_payee . "'";
    }

    public function is_not_account_type_zakath_payee()
    {
        $this->account_type_zakath_payee = 0;
        $this->sql_update_query .= ",account_type_zakath_payee='" . $this->account_type_zakath_payee . "'";
    }

    public function is_account_type_subcrption()
    {
        $this->account_type_subcrption = 1;
        $this->sql_update_query .= ",account_type_subcrption='" . $this->account_type_subcrption . "'";
    }

    public function is_not_account_type_subcrption()
    {
        $this->account_type_subcrption = 0;
        $this->sql_update_query .= ",account_type_subcrption='" . $this->account_type_subcrption . "'";
    }

    public function is_account_type_zakath_reciver()
    {
        $this->account_type_zakath_reciver = 1;
        $this->sql_update_query .= ",account_type_zakath_reciver='" . $this->account_type_zakath_reciver . "'";
    }

    public function is_not_account_type_zakath_reciver()
    {
        $this->account_type_zakath_reciver = 0;
        $this->sql_update_query .= ",account_type_zakath_reciver='" . $this->account_type_zakath_reciver . "'";
    }

    public function is_is_login_avable()
    {
        $this->is_login_avable = 1;
        $this->sql_update_query .= ",is_login_avable='" . $this->is_login_avable . "'";
    }

    public function is_not_is_login_avable()
    {
        $this->is_login_avable = 0;
        $this->sql_update_query .= ",is_login_avable='" . $this->is_login_avable . "'";
    }

    public function set_interducer_contact_01($get_interducer_contact_01)
    {
        $this->interducer_contact_01 = $get_interducer_contact_01;
        $this->sql_update_query .= ",interducer_contact_01='" . $this->interducer_contact_01 . "'";
    }

    public function set_interducer_contact_02($get_interducer_contact_02)
    {
        $this->interducer_contact_02 = $get_interducer_contact_02;
        $this->sql_update_query .= ",interducer_contact_02='" . $this->interducer_contact_02 . "'";
    }

    public function is_self_account()
    {
        $this->self_account = 1;
        $this->sql_update_query .= ",self_account='" . $this->self_account . "'";
    }

    public function is_not_self_account()
    {
        $this->self_account = 0;
        $this->sql_update_query .= ",self_account='" . $this->self_account . "'";
    }

    public function set_due_pay_decreement($get_due_to_pay)
    {
        $this->sql_update_query .= ",due_to_pay=(due_to_pay-" . $get_due_to_pay . ")";
    }



    public function remove()
    {
        $this->ast = "0";
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO wwjm_member_list(
            name_M,
            residence_address_M,
            road_name_M,
            nic_M,
            phone_mobile,
            monlty_payment,
            owner,
            tenant,
            email,
            profetion,
            notification_whatup,
            notification_email,
            notification_moible_no,
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
            ast,
            sdt
        ) VALUES ("
            . "'" . $this->name_M . "', "
            . "'" . $this->residence_address_M . "', "
            . "'" . $this->road_name_M . "', "
            . "'" . $this->nic_M . "', "
            . "'" . $this->phone_mobile . "', "
            . "'" . $this->monlty_payment . "', "
            . "'" . $this->owner . "', "
            . "'" . $this->tenant . "', "
            . "'" . $this->email . "', "
            . "'" . $this->profetion . "', "
            . "'" . $this->notification_whatup . "', "
            . "'" . $this->notification_email . "', "
            . "'" . $this->notification_moible_no . "', "
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
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "');";

        // echo $get_sql_query;

        $data_base_obj->get_result($get_sql_query);


        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update wwjm_member_list set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";
        // echo $get_sql_query;

        // echo $get_sql_query;
        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }



    public function process_membership_no($data_base_obj, $member_id)
    {
        if ($data_base_obj) {

            $member_list_obj = new wwjm_member_list_LIST();

            $member_add_update_obj = new wwjm_member_list_ADD_UPDATE();
            $member_list_obj->get_MAX_id();
            $result = $member_list_obj->get_result();
            $row = $result->fetch_array();
            $max_id = $row[0];
            $membership_no_not_init = 10000 + $max_id;
            $membership_no = sprintf("%09d", $membership_no_not_init);

            $member_add_update_obj->set_membership_no($membership_no);

            $member_add_update_obj->set_id($member_id);

            $member_add_update_obj->process_update();
        }
    }
}
