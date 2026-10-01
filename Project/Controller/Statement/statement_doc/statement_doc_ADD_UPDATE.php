<?php

class statement_doc_ADD_UPDATE
{
    private $id;
    private $id_to_fromat;
    private $cus_sup_name;
    private $email;
    private $phone_no;
    private $ast = "1";
    private $sdt;
    private $statement_date;
    private $due_or_exp_date;
    private $payment_state = "0";
    private $draft_state = "0";
    private $finish_staet = "0";
    private $dis;
    private $statement_settings_list_id = "0";
    private $main_user_login_id;
    private $cus_sup_state = "0";
    private $billing_address_state = "0";
    private $shipping_address_state = "0";
    private $send_by_sms = "0";
    private $send_by_email = "0";
    private $main_print_state = "0";
    private $default_discount_value;
    private $default_discount_pesontage_state = "0";
    private $default_dicount_value_state = "0";
    private $default_discount_total;
    private $default_discount_total_USD;
    private $delivery_page_weight;
    private $delivery_state = "0";
    private $delivery_fee;
    private $delivery_fee_USD;
    private $additional_expence_n_income;
    private $additional_expence_n_income_value;
    private $additional_expence_n_income_value_USD;
    private $final_total;
    private $final_total_USD;
    private $line_discount_total;
    private $line_discount_total_USD;
    private $net_amount;
    private $net_amount_USD;
    private $due_amount;
    private $due_amount_USD;
    private $agent_discount_full;
    private $agent_discount_full_USD;
    private $full_Total_amount;
    private $full_Total_amount_USD;
    private $online_payment_need_to_take_fee = "0";
    private $rate_for_online_payment = "0";
    private $total_online_pay_amount_with_bank_fee = "0";
    private $payed_amount;
    private $change_amount;
    private $online_payment_gateway_currencty_type;
    private $online_payment_state = "0";
    private $company_id;
    private $branch_id;
    private $ex_currency_name;
    private $base_currency_name;
    private $ex_currencty_base_currency_exange_rate;
    private $base_currency_state = "0";
    private $exchange_currency_state = "0";
    private $show_always_state = "0";
    private $is_ecommers_data = "0";
    private $total_net_amount_for_gateway;

    private $get_compnay_obj;
    private $sql_update_query = "";



    private $error_msg;

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->get_compnay_obj = new Company_Info_Variable_List();
        $this->company_id = $this->get_compnay_obj->get_compnay_id();
        $this->branch_id = $this->get_compnay_obj->get_branch_id();
        $this->sdt = date("Y-m-d H:i:s");
    }

    /* ================= NORMAL SETTERS ================= */

    public function set_statement_date($get_statement_date)
    {
        $this->statement_date = $get_statement_date;
        $this->sql_update_query .= ",statement_date='" . $this->statement_date . "'";
    }

    public function set_due_or_exp_date($get_due_or_exp_date)
    {
        $this->due_or_exp_date = $get_due_or_exp_date;
        $this->sql_update_query .= ",due_or_exp_date='" . $this->due_or_exp_date . "'";
    }

    public function set_cus_sup_name($get_cus_sup_name)
    {
        $this->cus_sup_name = $get_cus_sup_name;
        $this->sql_update_query .= ",cus_sup_name='" . $this->cus_sup_name . "'";
    }

    public function set_email($get_email)
    {
        $this->email = $get_email;
        $this->sql_update_query .= ",email='" . $this->email . "'";
    }

    public function set_phone_no($get_phone_no)
    {
        $this->phone_no = $get_phone_no;
        $this->sql_update_query .= ",phone_no='" . $this->phone_no . "'";
    }

    public function set_delivery_fee($get_delivery_fee)
    {
        $this->delivery_fee = $get_delivery_fee;
        $this->sql_update_query .= ",delivery_fee='" . $this->delivery_fee . "'";
    }

    public function set_final_total($get_final_total)
    {
        $this->final_total = $get_final_total;
        $this->sql_update_query .= ",final_total='" . $this->final_total . "'";
    }

    public function set_net_amount($get_net_amount)
    {
        $this->net_amount = $get_net_amount;
        $this->sql_update_query .= ",net_amount='" . $this->net_amount . "'";
    }

    public function set_due_amount($get_due_amount)
    {
        $this->due_amount = $get_due_amount;
        $this->sql_update_query .= ",due_amount='" . $this->due_amount . "'";
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    /* ================= STATE FUNCTIONS (IMPORTANT) ================= */

    // AST STATE (ACTIVE / INACTIVE)
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

    // PAYMENT STATE
    public function is_payment_state()
    {
        $this->payment_state = 1;
        $this->sql_update_query .= ",payment_state='" . $this->payment_state . "'";
    }

    public function is_not_payment_state()
    {
        $this->payment_state = 0;
        $this->sql_update_query .= ",payment_state='" . $this->payment_state . "'";
    }

    // DRAFT STATE
    public function is_draft_state()
    {
        $this->draft_state = 1;
        $this->sql_update_query .= ",draft_state='" . $this->draft_state . "'";
    }

    public function is_not_draft_state()
    {
        $this->draft_state = 0;
        $this->sql_update_query .= ",draft_state='" . $this->draft_state . "'";
    }

    // FINISH STATE
    public function is_finish_state()
    {
        $this->finish_staet = 1;
        $this->sql_update_query .= ",finish_staet='" . $this->finish_staet . "'";
    }

    public function is_not_finish_state()
    {
        $this->finish_staet = 0;
        $this->sql_update_query .= ",finish_staet='" . $this->finish_staet . "'";
    }

    // EMAIL
    public function is_send_by_email()
    {
        $this->send_by_email = 1;
        $this->sql_update_query .= ",send_by_email='" . $this->send_by_email . "'";
    }

    public function is_not_send_by_email()
    {
        $this->send_by_email = 0;
        $this->sql_update_query .= ",send_by_email='" . $this->send_by_email . "'";
    }

    // SMS
    public function is_send_by_sms()
    {
        $this->send_by_sms = 1;
        $this->sql_update_query .= ",send_by_sms='" . $this->send_by_sms . "'";
    }

    public function is_not_send_by_sms()
    {
        $this->send_by_sms = 0;
        $this->sql_update_query .= ",send_by_sms='" . $this->send_by_sms . "'";
    }

    // CUS SUP STATE
    public function is_cus_sup_state()
    {
        $this->cus_sup_state = 1;
        $this->sql_update_query .= ",cus_sup_state='" . $this->cus_sup_state . "'";
    }

    public function is_not_cus_sup_state()
    {
        $this->cus_sup_state = 0;
        $this->sql_update_query .= ",cus_sup_state='" . $this->cus_sup_state . "'";
    }


    // FINISH STATE
    public function is_delivery_state()
    {
        $this->delivery_state = 1;
        $this->sql_update_query .= ",delivery_state='" . $this->delivery_state . "'";
    }

    public function is_not_delivery_state()
    {
        $this->delivery_state = 0;
        $this->sql_update_query .= ",delivery_state='" . $this->delivery_state . "'";
    }

    public function set_statment_doc_only_cart_main_data_id($get_cus_sup_name, $get_cus_sup_email, $get_cus_sup_phone_no, $get_net_amount, $get_total_weight, $get_delevery_fee)
    {

        $this->id_to_fromat = 0;
        $this->cus_sup_name = $get_cus_sup_name;
        $this->email = $get_cus_sup_email;
        $this->phone_no = $get_cus_sup_phone_no;
        $this->statement_date = date("Y-m-d H:i:s");
        $this->final_total = floatval($get_net_amount) + floatval($get_delevery_fee);
        $this->line_discount_total = "0";
        $this->net_amount = $get_net_amount;
        $this->due_amount = $this->final_total;
        $this->due_or_exp_date = date("Y-m-d", strtotime("+7 day"));
        $this->payment_state = "0";
        $this->draft_state = "0";
        $this->finish_staet = "0";
        $this->statement_settings_list_id = "0";
        $this->cus_sup_state = "1";
        $this->billing_address_state = "1";
        $this->shipping_address_state = "1";
        $this->default_discount_value = "0";
        $this->default_discount_total = "0";
        $this->send_by_sms = "0";
        $this->send_by_email = "0";
        $this->main_print_state = "0";
        $this->default_discount_pesontage_state = "0";
        $this->default_dicount_value_state = "0";
        $this->agent_discount_full = "0";
        $this->delivery_fee = $get_delevery_fee;
        $this->delivery_page_weight = $get_total_weight;
        $this->delivery_state = "1";
        $this->additional_expence_n_income = "0";
        $this->dis = "No disciption set";
        $this->additional_expence_n_income_value = "0";
        $this->full_Total_amount = $this->final_total + $this->additional_expence_n_income_value;
        $this->rate_for_online_payment = "0";
        $this->online_payment_need_to_take_fee = "0";
        $this->total_online_pay_amount_with_bank_fee = "0";
        $this->payed_amount = "0";
        $this->change_amount = "0";
        $this->online_payment_state = "0";
        $this->delivery_fee_USD = "0";
        $this->additional_expence_n_income_value_USD = "0";
        $this->final_total_USD = "0";
        $this->line_discount_total_USD = "0";
        $this->full_Total_amount_USD = "0";
        $this->net_amount_USD = "0";
        $this->due_amount_USD = "0";
        $this->agent_discount_full_USD = "0";
        $this->ex_currency_name = "no exchange currency";
        $this->base_currency_name = $this->get_compnay_obj->get_default_currency();
        $this->ex_currencty_base_currency_exange_rate = "0";
        $this->base_currency_state = "1";
        $this->exchange_currency_state = "0";
        $this->show_always_state = "1";
        $this->is_ecommers_data = "1";
        $this->total_net_amount_for_gateway = $this->full_Total_amount;
    }

    public function get_full_Total_amount()
    {
        return $this->full_Total_amount;
    }

    public function set_online_payment_and_tax_fee()
    {
        $this->online_payment_state = "0";
        $this->rate_for_online_payment = "0";
        $this->online_payment_need_to_take_fee = "0";
        $this->total_online_pay_amount_with_bank_fee = $this->get_full_Total_amount() + $this->online_payment_need_to_take_fee;



        $this->total_net_amount_for_gateway = $this->get_full_Total_amount() + $this->online_payment_need_to_take_fee;
    }


    public function get_total_net_amount_for_gateway()
    {

        return $this->total_net_amount_for_gateway;
    }

    /* ================= FINAL QUERY ================= */


    public function create_new_invoice()
    {
        $state_bool = false;
        $data_base_obj = new DataBase();

        $sql_query = "INSERT INTO statement_doc(
        id_to_fromat,
        cus_sup_name,
        email,
        phone_no,
        ast,
        sdt,
        statement_date,
        final_total,
        line_discount_total,
        net_amount,
        due_amount,
        due_or_exp_date,
        payment_state,
        draft_state,
        finish_staet,
        statement_settings_list_id,
        main_user_login_id,
        cus_sup_state,
        billing_address_state,
        shipping_address_state,
        default_discount_value,
        default_discount_total,
        send_by_sms,
        send_by_email,
        main_print_state,
        default_discount_pesontage_state,
        default_dicount_value_state,
        company_id,
        branch_id,
        agent_discount_full,
        delivery_fee,
        delivery_page_weight,
        delivery_state,
        additional_expence_n_income,
        dis,
        additional_expence_n_income_value,
        full_Total_amount,
        rate_for_online_payment,
        online_payment_need_to_take_fee,
        total_online_pay_amount_with_bank_fee,
        payed_amount,
        change_amount,
        online_payment_state,
        delivery_fee_USD,
        additional_expence_n_income_value_USD,
        final_total_USD,
        line_discount_total_USD,
        full_Total_amount_USD,
        net_amount_USD,
        due_amount_USD,
        agent_discount_full_USD,
        ex_currency_name,
        base_currency_name,
        ex_currencty_base_currency_exange_rate,
        base_currency_state,
        exchange_currency_state,
        show_always_state,
        is_ecommers_data,
        total_net_amount_for_gateway
    ) VALUES (
        '" . $this->id_to_fromat . "',
        '" . $this->cus_sup_name . "',
        '" . $this->email . "',
        '" . $this->phone_no . "',
        '" . $this->ast . "',
        '" . $this->sdt . "',
        '" . $this->statement_date . "',
        '" . $this->final_total . "',
        '" . $this->line_discount_total . "',
        '" . $this->net_amount . "',
        '" . $this->due_amount . "',
        '" . $this->due_or_exp_date . "',
        '" . $this->payment_state . "',
        '" . $this->draft_state . "',
        '" . $this->finish_staet . "',
        '" . $this->statement_settings_list_id . "',
        '" . $this->main_user_login_id . "',
        '" . $this->cus_sup_state . "',
        '" . $this->billing_address_state . "',
        '" . $this->shipping_address_state . "',
        '" . $this->default_discount_value . "',
        '" . $this->default_discount_total . "',
        '" . $this->send_by_sms . "',
        '" . $this->send_by_email . "',
        '" . $this->main_print_state . "',
        '" . $this->default_discount_pesontage_state . "',
        '" . $this->default_dicount_value_state . "',
        '" . $this->company_id . "',
        '" . $this->branch_id . "',
        '" . $this->agent_discount_full . "',
        '" . $this->delivery_fee . "',
        '" . $this->delivery_page_weight . "',
        '" . $this->delivery_state . "',
        '" . $this->additional_expence_n_income . "',
        '" . $this->dis . "',
        '" . $this->additional_expence_n_income_value . "',
        '" . $this->full_Total_amount . "',
        '" . $this->rate_for_online_payment . "',
        '" . $this->online_payment_need_to_take_fee . "',
        '" . $this->total_online_pay_amount_with_bank_fee . "',
        '" . $this->payed_amount . "',
        '" . $this->change_amount . "',
        '" . $this->online_payment_state . "',
        '" . $this->delivery_fee_USD . "',
        '" . $this->additional_expence_n_income_value_USD . "',
        '" . $this->final_total_USD . "',
        '" . $this->line_discount_total_USD . "',
        '" . $this->full_Total_amount_USD . "',
        '" . $this->net_amount_USD . "',
        '" . $this->due_amount_USD . "',
        '" . $this->agent_discount_full_USD . "',
        '" . $this->ex_currency_name . "',
        '" . $this->base_currency_name . "',
        '" . $this->ex_currencty_base_currency_exange_rate . "',
        '" . $this->base_currency_state . "',
        '" . $this->exchange_currency_state . "',
        '" . $this->show_always_state . "',
        '" . $this->is_ecommers_data . "',
        '" . $this->total_net_amount_for_gateway . "'
    )";

        $data_base_obj->get_result($sql_query);
        $this->id = $data_base_obj->get_id();

        if ($this->id_to_fromat == "0") {
            $id_to_fromat = "INV" . str_pad($this->id, 8, '0', STR_PAD_LEFT);
            $this->id_to_fromat = $id_to_fromat;
            $this->sql_update_query .= ",id_to_fromat='" . $this->id_to_fromat . "'";

            $this->process_update();

            $state_bool = true;
        }



        return $state_bool;
    }

    public function get_id()
    {
        return $this->id;
    }
    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update statement_doc set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }

    public function get_error_msg()
    {
        return $this->error_msg;
    }
}
