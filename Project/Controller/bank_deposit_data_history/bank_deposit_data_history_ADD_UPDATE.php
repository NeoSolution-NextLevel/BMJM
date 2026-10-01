
<?php

class bank_deposit_data_history_ADD_UPDATE
{

    private $id;
    private $ast = "1";
    private $sdt;
    private $bank_account_details_id;
    private $wwjm_payment_slip_id;
    private $wwjm_bank_deposit_slip_id;
    private $dis;
    private $credit_amout;
    private $debet_amount;
    private $main_user_login_id;
    private $pay_resion_subcption = 0;
    private $pay_resion_donation = 0;
    private $pay_resion_zakath = 0;
    private $pay_resion_projects = 0;
    private $pay_resion_others = 0;
    private $pay_resion_other_by_text;
    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data(
        $get_bank_account_details_id,
        $get_wwjm_payment_slip_id,
        $get_wwjm_bank_deposit_slip_id,
        $get_dis,
        $get_credit_amout,
        $get_debet_amount,
        $get_pay_resion_other_by_text
    ) {
        $this->bank_account_details_id = $get_bank_account_details_id;
        $this->wwjm_payment_slip_id = $get_wwjm_payment_slip_id;
        $this->wwjm_bank_deposit_slip_id = $get_wwjm_bank_deposit_slip_id;
        $this->dis = $get_dis;
        $this->credit_amout = $get_credit_amout;
        $this->debet_amount = $get_debet_amount;
        $this->pay_resion_other_by_text = $get_pay_resion_other_by_text;

        $this->sql_update_query .=
            ",bank_account_details_id='" . $this->bank_account_details_id . "'" .
            ",wwjm_payment_slip_id='" . $this->wwjm_payment_slip_id . "'" .
            ",wwjm_bank_deposit_slip_id='" . $this->wwjm_bank_deposit_slip_id . "'" .
            ",dis='" . $this->dis . "'" .
            ",credit_amout='" . $this->credit_amout . "'" .
            ",debet_amount='" . $this->debet_amount . "'" .
            ",pay_resion_other_by_text='" . $this->pay_resion_other_by_text . "'";
    }


    //boolean value 

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

    public function is_pay_resion_others()
    {
        $this->pay_resion_others = 1;
        $this->sql_update_query .= ",pay_resion_others='" . $this->pay_resion_others . "'";
    }

    public function is_not_pay_resion_others()
    {
        $this->pay_resion_others = 0;
        $this->sql_update_query .= ",pay_resion_others='" . $this->pay_resion_others . "'";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_bank_account_details_id($get_bank_account_details_id)
    {
        $this->bank_account_details_id = $get_bank_account_details_id;
        $this->sql_update_query .= ",bank_account_details_id='" . $this->bank_account_details_id . "'";
    }

    public function set_wwjm_payment_slip_id($get_wwjm_payment_slip_id)
    {
        $this->wwjm_payment_slip_id = $get_wwjm_payment_slip_id;
        $this->sql_update_query .= ",wwjm_payment_slip_id='" . $this->wwjm_payment_slip_id . "'";
    }
    public function set_wwjm_bank_deposit_slip_id($get_wwjm_bank_deposit_slip_id)
    {
        $this->wwjm_bank_deposit_slip_id = $get_wwjm_bank_deposit_slip_id;
        $this->sql_update_query .= ",wwjm_bank_deposit_slip_id='" . $this->wwjm_bank_deposit_slip_id . "'";
    }
    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }
    public function set_credit_amout($get_credit_amout)
    {
        $this->credit_amout = $get_credit_amout;
        $this->sql_update_query .= ",credit_amout='" . $this->credit_amout . "'";
    }
    public function set_debet_amount($get_debet_amount)
    {
        $this->debet_amount = $get_debet_amount;
        $this->sql_update_query .= ",debet_amount='" . $this->debet_amount . "'";
    }
    public function set_main_user_login_id($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sql_update_query .= ",main_user_login_id='" . $this->main_user_login_id . "'";
    }

    public function set_pay_resion_other_by_text($get_pay_resion_other_by_text)
    {
        $this->pay_resion_other_by_text = $get_pay_resion_other_by_text;
        $this->sql_update_query .= ",pay_resion_other_by_text='" . $this->pay_resion_other_by_text . "'";
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

        $get_sql_query = "INSERT INTO bank_deposit_data_history(
                            ast,
                            sdt,
                            bank_account_details_id,
                            wwjm_payment_slip_id,
                            wwjm_bank_deposit_slip_id,
                            dis,
                            credit_amout,
                            debet_amount,
                            main_user_login_id,
                            pay_resion_subcption,
                            pay_resion_donation,
                            pay_resion_zakath,
                            pay_resion_projects,
                            pay_resion_others,
                            pay_resion_other_by_text
                        ) VALUES (
                            '" . $this->ast . "',
                            '" . $this->sdt . "',
                            '" . $this->bank_account_details_id . "',
                            '" . $this->wwjm_payment_slip_id . "',
                            '" . $this->wwjm_bank_deposit_slip_id . "',
                            '" . $this->dis . "',
                            '" . $this->credit_amout . "',
                            '" . $this->debet_amount . "',
                            '" . $this->main_user_login_id . "',
                            '" . $this->pay_resion_subcption . "',
                            '" . $this->pay_resion_donation . "',
                            '" . $this->pay_resion_zakath . "',
                            '" . $this->pay_resion_projects . "',
                            '" . $this->pay_resion_others . "',
                            '" . $this->pay_resion_other_by_text . "'
                        );
                        ";

        // echo $get_sql_query;

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update bank_deposit_data_history set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
