
<?php

class wwjm_payment_slip_ADD_UPDATE
{

    private $id;

    private $payment_date;
    private $ast = "1";

    private $sdt;

    private $amount;
    private $dis;
    private $is_cash = 0;
    private $is_bank_deposit = 0;
    private $is_IPG = 0;
    private $slip_print = 0;
    private $pay_resion_subcption = 0;
    private $pay_resion_donation = 0;
    private $pay_resion_zakath = 0;
    private $pay_resion_projects = 0;
    private $is_member = 0;
    private $main_user_login_id;
    private $person_name;
    private $address;
    private $membership_no;

    private $email;
    private $phone_number;





    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    //in view list call payment_date using setter
    public function get_data(
        $get_amount,
        $get_dis,
        $get_person_name,
        $get_address,
        $get_membership_no,
        $get_email,
        $get_phone_number
    ) {
        $this->amount = $get_amount;
        $this->dis = $get_dis;
        $this->person_name = $get_person_name;
        $this->address = $get_address;
        $this->membership_no = $get_membership_no;
        $this->email = $get_email;
        $this->phone_number = $get_phone_number;

        $this->sql_update_query .=
            ",amount='" . $this->amount . "'" .
            ",dis='" . $this->dis . "'" .
            ",person_name='" . $this->person_name . "'" .
            ",address='" . $this->address . "'" .
            ",membership_no='" . $this->membership_no . "'" .
            ",email='" . $this->email . "'" .
            ",phone_number='" . $this->phone_number . "'";
    }


    //boolean value 

    public function is_is_cash()
    {
        $this->is_cash = 1;
        $this->sql_update_query .= ",is_cash='" . $this->is_cash . "'";
    }

    public function is_not_is_cash()
    {
        $this->is_cash = 0;
        $this->sql_update_query .= ",is_cash='" . $this->is_cash . "'";
    }

    public function is_is_bank_deposit()
    {
        $this->is_bank_deposit = 1;
        $this->sql_update_query .= ",is_bank_deposit='" . $this->is_bank_deposit . "'";
    }

    public function is_not_is_bank_deposit()
    {
        $this->is_bank_deposit = 0;
        $this->sql_update_query .= ",is_bank_deposit='" . $this->is_bank_deposit . "'";
    }

    public function is_slip_print()
    {
        $this->slip_print = 1;
        $this->sql_update_query .= ",slip_print='" . $this->slip_print . "'";
    }

    public function is_not_slip_print()
    {
        $this->slip_print = 0;
        $this->sql_update_query .= ",slip_print='" . $this->slip_print . "'";
    }

    public function is_pay_resion_subcption()
    {
        $this->pay_resion_subcption = 1;
        $this->sql_update_query .= ",pay_resion_subcption='" . $this->pay_resion_subcption . "'";
    }

    public function is_not_pay_resion_subcption()
    {
        $this->pay_resion_subcption = 0;
        $this->sql_update_query .= ",pay_resion_subcption='" . $this->pay_resion_subcption . "'";
    }

    public function is_is_IPG()
    {
        $this->is_IPG = 1;
        $this->sql_update_query .= ",is_IPG='" . $this->is_IPG . "'";
    }

    public function is_not_is_IPG()
    {
        $this->is_IPG = 0;
        $this->sql_update_query .= ",is_IPG='" . $this->is_IPG . "'";
    }

    public function is_pay_resion_projects()
    {
        $this->pay_resion_projects = 1;
        $this->sql_update_query .= ",pay_resion_projects='" . $this->pay_resion_projects . "'";
    }

    public function is_not_pay_resion_projects()
    {
        $this->pay_resion_projects = 0;
        $this->sql_update_query .= ",pay_resion_projects='" . $this->pay_resion_projects . "'";
    }

    public function is_is_member()
    {
        $this->is_member = 1;
        $this->sql_update_query .= ",is_member='" . $this->is_member . "'";
    }

    public function is_not_is_member()
    {
        $this->is_member = 0;
        $this->sql_update_query .= ",is_member='" . $this->is_member . "'";
    }


    public function is_pay_resion_donation()
    {
        $this->pay_resion_donation = 1;
        $this->sql_update_query .= ",pay_resion_donation='" . $this->pay_resion_donation . "'";
    }

    public function is_not_pay_resion_donation()
    {
        $this->pay_resion_donation = 0;
        $this->sql_update_query .= ",pay_resion_donation='" . $this->pay_resion_donation . "'";
    }

    public function is_pay_resion_zakath()
    {
        $this->pay_resion_zakath = 1;
        $this->sql_update_query .= ",pay_resion_zakath='" . $this->pay_resion_zakath . "'";
    }

    public function is_not_pay_resion_zakath()
    {
        $this->pay_resion_zakath = 0;
        $this->sql_update_query .= ",pay_resion_zakath='" . $this->pay_resion_zakath . "'";
    }


    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_payment_date()
    {
        $this->payment_date = date('Y-m-d H:i:s');

        $this->sql_update_query .= ",payment_date='" . $this->payment_date . "'";
    }

    public function set_amount($get_amount)
    {
        $this->amount = $get_amount;
        $this->sql_update_query .= ",amount='" . $this->amount . "'";
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }
    public function set_phone_number($get_phone_number)
    {
        $this->phone_number = $get_phone_number;
        $this->sql_update_query .= ",phone_number='" . $this->phone_number . "'";
    }


    public function set_main_user_login_id($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sql_update_query .= ",main_user_login_id='" . $this->main_user_login_id . "'";
    }

    public function set_person_name($get_person_name)
    {
        $this->person_name = $get_person_name;
        $this->sql_update_query .= ",person_name='" . $this->person_name . "'";
    }

    public function set_address($get_address)
    {
        $this->address = $get_address;
        $this->sql_update_query .= ",address='" . $this->address . "'";
    }

    public function set_membership_no($get_membership_no)
    {
        $this->membership_no = $get_membership_no;
        $this->sql_update_query .= ",membership_no='" . $this->membership_no . "'";
    }

    public function set_email($get_email)
    {
        $this->email = $get_email;
        $this->sql_update_query .= ",email='" . $this->email . "'";
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

        $get_sql_query = "INSERT INTO wwjm_payment_slip(
            payment_date,
            ast,
            sdt,
            amount,
            dis,
            is_cash,
            is_bank_deposit,
            is_IPG,
            slip_print,
            pay_resion_subcption,
            pay_resion_donation,
            pay_resion_zakath,
            pay_resion_projects,
            is_member,
            main_user_login_id,
            person_name,
            address,
            membership_no,
            email,
            phone_number
        ) VALUES ("
            . "'" . $this->payment_date . "', "
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->amount . "', "
            . "'" . $this->dis . "', "
            . "'" . $this->is_cash . "', "
            . "'" . $this->is_bank_deposit . "', "
            . "'" . $this->is_IPG . "', "
            . "'" . $this->slip_print . "', "
            . "'" . $this->pay_resion_subcption . "', "
            . "'" . $this->pay_resion_donation . "', "
            . "'" . $this->pay_resion_zakath . "', "
            . "'" . $this->pay_resion_projects . "', "
            . "'" . $this->is_member . "', "
            . "'" . $this->main_user_login_id . "', "
            . "'" . $this->person_name . "', "
            . "'" . $this->address . "', "
            . "'" . $this->membership_no . "', "
            . "'" . $this->email . "', "
            . "'" . $this->phone_number . "');";


        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update wwjm_payment_slip set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
