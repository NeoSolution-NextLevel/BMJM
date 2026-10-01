<?php

class statement_doc_ipg_list_ADD_UPDATE
{
    private $id;
    private $process_start_sdt;
    private $process_end_sdt;
    private $sdt;
    private $ipg_transaction_id;
    private $type_of_transation;
    private $cus_name;
    private $phone_no;
    private $ref_id;
    private $state_of_tranaction_mag;
    private $success_tranaction;
    private $statement_doc_id;
    private $email;
    private $ast = "1";
    private $branch_id;
    private $company_id;
    private $amount;
    private $base_currency_state = "0";
    private $base_currency;
    private $other_currency_state = "0";
    private $other_currency;
    private $exchange_reate;
    private $amount_USD;

    private $main_user_login_id;
    private $sql_update_query = "";
    private $sql_query = "";
    private $error_msg;

    public function __construct($get_main_user_login_id = 0)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date("Y-m-d H:i:s");
    }


    public function set_data_for_new_one_pay_payment_process($get_cus_name, $get_phone_no, $get_statement_doc_id, $get_email, $get_amount, $get_base_currency_state, $get_base_currency, $get_other_currency_state, $get_other_currency, $get_exchange_reate)
    {
        $company_obj = new Company_Info_Variable_List();

        $this->process_start_sdt = date("Y-m-d H:i:s");
        $this->ipg_transaction_id = "0";
        $this->type_of_transation = "One Pay";
        $this->cus_name = $get_cus_name;
        $this->phone_no = $get_phone_no;
        $this->ref_id = "0";
        $this->process_end_sdt = date("Y-m-d H:i:s");
        $this->success_tranaction = "0";
        $this->statement_doc_id = $get_statement_doc_id;
        // $this->email = $get_email;
        $this->branch_id = $company_obj->get_branch_id();
        $this->company_id = "1";
        $this->amount = $get_amount;
        $this->base_currency_state = $get_base_currency_state;
        $this->base_currency = $get_base_currency;
        $this->other_currency_state = $get_other_currency_state;
        $this->other_currency = $get_other_currency;
        $this->exchange_reate = $get_exchange_reate;
        $this->amount_USD = 0.0;
    }


    public function set_transaction_payment_sucess()
    {
        $this->process_end_sdt = date("Y-m-d H:i:s");
        $this->success_tranaction = "1";

        $this->sql_update_query .= ", process_end_sdt='" . $this->process_end_sdt . "' , success_tranaction='" . $this->success_tranaction . "'";
    }

    public function set_transaction_payment_fail($get_state_of_tranaction_mag)
    {
        $this->process_end_sdt = date("Y-m-d H:i:s");
        $this->success_tranaction = "0";
        $this->state_of_tranaction_mag = $get_state_of_tranaction_mag;

        $this->sql_update_query .= ", process_end_sdt='" . $this->process_end_sdt . "' , success_tranaction='" . $this->success_tranaction . "' , state_of_tranaction_mag='" . $this->state_of_tranaction_mag . "'";
    }


    /* ================= SETTERS ================= */

    public function set_id($val)
    {
        $this->id = $val;
        $this->sql_update_query .= ",id='" . $this->id . "'";
    }

    public function get_id()
    {
        return $this->id;
    }
    public function set_process_start_sdt($val)
    {
        $this->process_start_sdt = $val;
        $this->sql_update_query .= ",process_start_sdt='" . $this->process_start_sdt . "'";
    }
    public function set_process_end_sdt($val)
    {
        $this->process_end_sdt = $val;
        $this->sql_update_query .= ",process_end_sdt='" . $this->process_end_sdt . "'";
    }
    public function set_ipg_transaction_id($val)
    {
        $this->ipg_transaction_id = $val;
        $this->sql_update_query .= ",ipg_transaction_id='" . $this->ipg_transaction_id . "'";
    }
    public function set_type_of_transation($val)
    {
        $this->type_of_transation = $val;
        $this->sql_update_query .= ",type_of_transation='" . $this->type_of_transation . "'";
    }
    public function set_cus_name($val)
    {
        $this->cus_name = $val;
        $this->sql_update_query .= ",cus_name='" . $this->cus_name . "'";
    }
    public function set_phone_no($val)
    {
        $this->phone_no = $val;
        $this->sql_update_query .= ",phone_no='" . $this->phone_no . "'";
    }
    public function set_ref_id($val)
    {
        $this->ref_id = $val;
        $this->sql_update_query .= ",ref_id='" . $this->ref_id . "'";
    }
    public function set_state_of_tranaction_mag($val)
    {
        $this->state_of_tranaction_mag = $val;
        $this->sql_update_query .= ",state_of_tranaction_mag='" . $this->state_of_tranaction_mag . "'";
    }
    public function set_success_tranaction($val)
    {
        $this->success_tranaction = $val;
        $this->sql_update_query .= ",success_tranaction='" . $this->success_tranaction . "'";
    }
    public function set_statement_doc_id($val)
    {
        $this->statement_doc_id = $val;
        $this->sql_update_query .= ",statement_doc_id='" . $this->statement_doc_id . "'";
    }
    public function set_email($val)
    {
        $this->email = $val;
        $this->sql_update_query .= ",email='" . $this->email . "'";
    }
    public function set_branch_id($val)
    {
        $this->branch_id = $val;
        $this->sql_update_query .= ",branch_id='" . $this->branch_id . "'";
    }
    public function set_company_id($val)
    {
        $this->company_id = $val;
        $this->sql_update_query .= ",company_id='" . $this->company_id . "'";
    }
    public function set_amount($val)
    {
        $this->amount = $val;
        $this->sql_update_query .= ",amount='" . $this->amount . "'";
    }
    public function set_base_currency($val)
    {
        $this->base_currency = $val;
        $this->sql_update_query .= ",base_currency='" . $this->base_currency . "'";
    }
    public function set_other_currency($val)
    {
        $this->other_currency = $val;
        $this->sql_update_query .= ",other_currency='" . $this->other_currency . "'";
    }
    public function set_exchange_reate($val)
    {
        $this->exchange_reate = $val;
        $this->sql_update_query .= ",exchange_reate='" . $this->exchange_reate . "'";
    }
    public function set_amount_USD($val)
    {
        $this->amount_USD = $val;
        $this->sql_update_query .= ",amount_USD='" . $this->amount_USD . "'";
    }

    /* ================= STATE ================= */

    public function is_base_currency_state()
    {
        $this->base_currency_state = 1;
        $this->sql_update_query .= ",base_currency_state='" . $this->base_currency_state . "'";
    }
    public function is_not_base_currency_state()
    {
        $this->base_currency_state = 0;
        $this->sql_update_query .= ",base_currency_state='" . $this->base_currency_state . "'";
    }

    public function is_other_currency_state()
    {
        $this->other_currency_state = 1;
        $this->sql_update_query .= ",other_currency_state='" . $this->other_currency_state . "'";
    }
    public function is_not_other_currency_state()
    {
        $this->other_currency_state = 0;
        $this->sql_update_query .= ",other_currency_state='" . $this->other_currency_state . "'";
    }

    public function is_active()
    {
        $this->ast = 1;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }
    public function is_not_active()
    {
        $this->ast = 0;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }

    /* ================= INSERT ================= */

    public function create_new_statement_doc_ipg()
    {
        $state_bool = false;
        $db = new DataBase();

        $this->sql_query = "INSERT INTO statement_doc_ipg_list(
            process_start_sdt, process_end_sdt, sdt, ipg_transaction_id,
            type_of_transation, cus_name, phone_no, ref_id,
            state_of_tranaction_mag, success_tranaction, statement_doc_id,
            email, ast, branch_id, company_id, amount,
            base_currency_state, base_currency,
            other_currency_state, other_currency,
            exchange_reate, amount_USD
        ) VALUES (
            '" . $this->process_start_sdt . "',
            '" . $this->process_end_sdt . "',
            '" . $this->sdt . "',
            '" . $this->ipg_transaction_id . "',
            '" . $this->type_of_transation . "',
            '" . $this->cus_name . "',
            '" . $this->phone_no . "',
            '" . $this->ref_id . "',
            '" . $this->state_of_tranaction_mag . "',
            '" . $this->success_tranaction . "',
            '" . $this->statement_doc_id . "',
            '" . $this->email . "',
            '" . $this->ast . "',
            '" . $this->branch_id . "',
            '" . $this->company_id . "',
            '" . $this->amount . "',
            '" . $this->base_currency_state . "',
            '" . $this->base_currency . "',
            '" . $this->other_currency_state . "',
            '" . $this->other_currency . "',
            '" . $this->exchange_reate . "',
            '" . $this->amount_USD . "'
        )";

        $db->get_result($this->sql_query);
        $this->id = $db->get_id();

        if ($this->id > 0) $state_bool = true;

        return $state_bool;
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update statement_doc_ipg_list set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
