<?php

class statement_doc_SINGLE_DATA
{

    private $id;
    private $id_to_fromat;
    private $cus_sup_name;
    private $email;
    private $phone_no;
    private $ast;
    private $sdt;
    private $statement_date;
    private $due_or_exp_date;
    private $payment_state;
    private $draft_state;
    private $finish_staet;
    private $dis;
    private $statement_settings_list_id;
    private $main_user_login_id;
    private $cus_sup_state;
    private $billing_address_state;
    private $shipping_address_state;
    private $send_by_sms;
    private $send_by_email;
    private $main_print_state;
    private $default_discount_value;
    private $default_discount_pesontage_state;
    private $default_dicount_value_state;
    private $default_discount_total;
    private $default_discount_total_USD;
    private $delivery_page_weight;
    private $delivery_state;
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
    private $online_payment_need_to_take_fee;
    private $rate_for_online_payment;
    private $total_online_pay_amount_with_bank_fee;
    private $payed_amount;
    private $change_amount;
    private $online_payment_gateway_currencty_type;
    private $online_payment_state;
    private $company_id;
    private $branch_id;
    private $ex_currency_name;
    private $base_currency_name;
    private $ex_currencty_base_currency_exange_rate;
    private $base_currency_state;
    private $exchange_currency_state;

    private $total_net_amount_for_gateway = 0;

    private $state = false;

    public function __construct($get_statement_id)
    {
        $this->id = $get_statement_id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM statement_doc WHERE id='" . $this->id . "'";
        // echo $get_sql_query;
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->state = true;
                $this->id_to_fromat = $row['id_to_fromat'];
                $this->cus_sup_name = $row['cus_sup_name'];
                $this->email = $row['email'];
                $this->phone_no = $row['phone_no'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->statement_date = $row['statement_date'];
                $this->due_or_exp_date = $row['due_or_exp_date'];
                $this->payment_state = $row['payment_state'];
                $this->draft_state = $row['draft_state'];
                $this->finish_staet = $row['finish_staet'];
                $this->dis = $row['dis'];
                $this->statement_settings_list_id = $row['statement_settings_list_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->cus_sup_state = $row['cus_sup_state'];
                $this->billing_address_state = $row['billing_address_state'];
                $this->shipping_address_state = $row['shipping_address_state'];
                $this->send_by_sms = $row['send_by_sms'];
                $this->send_by_email = $row['send_by_email'];
                $this->main_print_state = $row['main_print_state'];
                $this->default_discount_value = $row['default_discount_value'];
                $this->default_discount_pesontage_state = $row['default_discount_pesontage_state'];
                $this->default_dicount_value_state = $row['default_dicount_value_state'];
                $this->default_discount_total = $row['default_discount_total'];
                $this->default_discount_total_USD = $row['default_discount_total_USD'];
                $this->delivery_page_weight = $row['delivery_page_weight'];
                $this->delivery_state = $row['delivery_state'];
                $this->delivery_fee = $row['delivery_fee'];
                $this->delivery_fee_USD = $row['delivery_fee_USD'];
                $this->additional_expence_n_income = $row['additional_expence_n_income'];
                $this->additional_expence_n_income_value = $row['additional_expence_n_income_value'];
                $this->additional_expence_n_income_value_USD = $row['additional_expence_n_income_value_USD'];
                $this->final_total = $row['final_total'];
                $this->final_total_USD = $row['final_total_USD'];
                $this->line_discount_total = $row['line_discount_total'];
                $this->line_discount_total_USD = $row['line_discount_total_USD'];
                $this->net_amount = $row['net_amount'];
                $this->net_amount_USD = $row['net_amount_USD'];
                $this->due_amount = $row['due_amount'];
                $this->due_amount_USD = $row['due_amount_USD'];
                $this->agent_discount_full = $row['agent_discount_full'];
                $this->agent_discount_full_USD = $row['agent_discount_full_USD'];
                $this->full_Total_amount = $row['full_Total_amount'];
                $this->full_Total_amount_USD = $row['full_Total_amount_USD'];
                $this->online_payment_need_to_take_fee = $row['online_payment_need_to_take_fee'];
                $this->rate_for_online_payment = $row['rate_for_online_payment'];
                $this->total_online_pay_amount_with_bank_fee = $row['total_online_pay_amount_with_bank_fee'];
                $this->payed_amount = $row['payed_amount'];
                $this->change_amount = $row['change_amount'];
                $this->online_payment_gateway_currencty_type = $row['online_payment_gateway_currencty_type'];
                $this->online_payment_state = $row['online_payment_state'];
                $this->company_id = $row['company_id'];
                $this->branch_id = $row['branch_id'];
                $this->ex_currency_name = $row['ex_currency_name'];
                $this->base_currency_name = $row['base_currency_name'];
                $this->ex_currencty_base_currency_exange_rate = $row['ex_currencty_base_currency_exange_rate'];
                $this->base_currency_state = $row['base_currency_state'];
                $this->exchange_currency_state = $row['exchange_currency_state'];
                $this->total_net_amount_for_gateway = $row['total_net_amount_for_gateway'];
            }
        }
    }

    // Getters for each property

    public function get_state()
    {
        return $this->state;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_id_to_fromat()
    {
        return $this->id_to_fromat;
    }

    public function get_total_net_amount_for_gateway()
    {
        return $this->total_net_amount_for_gateway;
    }


    public function get_cus_sup_name()
    {
        return $this->cus_sup_name;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_phone_no()
    {
        return $this->phone_no;
    }

    public function get_ast()
    {
        return $this->ast;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_statement_date()
    {
        return $this->statement_date;
    }

    public function get_due_or_exp_date()
    {
        return $this->due_or_exp_date;
    }

    public function get_payment_state()
    {
        return $this->payment_state;
    }

    public function get_draft_state()
    {
        return $this->draft_state;
    }

    public function get_finish_staet()
    {
        return $this->finish_staet;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_statement_settings_list_id()
    {
        return $this->statement_settings_list_id;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_cus_sup_state()
    {
        return $this->cus_sup_state;
    }

    public function get_billing_address_state()
    {
        return $this->billing_address_state;
    }

    public function get_shipping_address_state()
    {
        return $this->shipping_address_state;
    }

    public function get_send_by_sms()
    {
        return $this->send_by_sms;
    }

    public function get_send_by_email()
    {
        return $this->send_by_email;
    }

    public function get_main_print_state()
    {
        return $this->main_print_state;
    }

    public function get_default_discount_value()
    {
        return $this->default_discount_value;
    }

    public function get_default_discount_pesontage_state()
    {
        return $this->default_discount_pesontage_state;
    }

    public function get_default_dicount_value_state()
    {
        return $this->default_dicount_value_state;
    }

    public function get_default_discount_total()
    {
        return $this->default_discount_total;
    }

    public function get_default_discount_total_USD()
    {
        return $this->default_discount_total_USD;
    }

    public function get_delivery_page_weight()
    {
        return $this->delivery_page_weight;
    }

    public function get_delivery_state()
    {
        return $this->delivery_state;
    }

    public function get_delivery_fee()
    {
        return $this->delivery_fee;
    }

    public function get_delivery_fee_USD()
    {
        return $this->delivery_fee_USD;
    }

    public function get_additional_expence_n_income()
    {
        return $this->additional_expence_n_income;
    }

    public function get_additional_expence_n_income_value()
    {
        return $this->additional_expence_n_income_value;
    }

    public function get_additional_expence_n_income_value_USD()
    {
        return $this->additional_expence_n_income_value_USD;
    }

    public function get_final_total()
    {
        return $this->final_total;
    }

    public function get_final_total_USD()
    {
        return $this->final_total_USD;
    }

    public function get_line_discount_total()
    {
        return $this->line_discount_total;
    }

    public function get_line_discount_total_USD()
    {
        return $this->line_discount_total_USD;
    }

    public function get_net_amount()
    {
        return $this->net_amount;
    }

    public function get_net_amount_USD()
    {
        return $this->net_amount_USD;
    }

    public function get_due_amount()
    {
        return $this->due_amount;
    }

    public function get_due_amount_USD()
    {
        return $this->due_amount_USD;
    }

    public function get_agent_discount_full()
    {
        return $this->agent_discount_full;
    }

    public function get_agent_discount_full_USD()
    {
        return $this->agent_discount_full_USD;
    }

    public function get_full_Total_amount()
    {
        return $this->full_Total_amount;
    }

    public function get_full_Total_amount_USD()
    {
        return $this->full_Total_amount_USD;
    }

    public function get_online_payment_need_to_take_fee()
    {
        return $this->online_payment_need_to_take_fee;
    }

    public function get_rate_for_online_payment()
    {
        return $this->rate_for_online_payment;
    }

    public function get_total_online_pay_amount_with_bank_fee()
    {
        return $this->total_online_pay_amount_with_bank_fee;
    }

    public function get_payed_amount()
    {
        return $this->payed_amount;
    }

    public function get_change_amount()
    {
        return $this->change_amount;
    }

    public function get_online_payment_gateway_currencty_type()
    {
        return $this->online_payment_gateway_currencty_type;
    }

    public function get_online_payment_state()
    {
        return $this->online_payment_state;
    }

    public function get_company_id()
    {
        return $this->company_id;
    }

    public function get_branch_id()
    {
        return $this->branch_id;
    }

    public function get_ex_currency_name()
    {
        return $this->ex_currency_name;
    }

    public function get_base_currency_name()
    {
        return $this->base_currency_name;
    }

    public function get_ex_currencty_base_currency_exange_rate()
    {
        return $this->ex_currencty_base_currency_exange_rate;
    }

    public function get_base_currency_state()
    {
        return $this->base_currency_state;
    }

    public function get_exchange_currency_state()
    {
        return $this->exchange_currency_state;
    }

    public function get_cus_sup_id()
    {
        $get_id = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select cus_sup_list_id from  statement_doc_cus_sup_list where statement_doc_id='" . $this->id . "' and ast='1'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_id = $row['cus_sup_list_id'];
            }
        }
        return $get_id;
    }
}
