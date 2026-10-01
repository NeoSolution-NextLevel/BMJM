<?php

class statement_doc_LIST
{
    private $sql_seach_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast = "1";

    // Get all columns
    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }

    // Get count of rows
    public function get_count_report()
    {
        $this->sql_process_data = " count(id) ";
    }

    // Set pagination limits
    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    // Remove record (set ast=0)
    public function remove_list()
    {
        $this->ast = "0";
    }

    // Filter by id
    public function filter_by_id($get_id)
    {
        $this->sql_seach_data .= " AND id = '" . $get_id . "'";
    }

    // Filter by id_to_fromat
    public function filter_by_id_to_fromat($get_id_to_fromat)
    {
        $this->sql_seach_data .= " AND id_to_fromat = '" . $get_id_to_fromat . "'";
    }

    // Filter by customer/supplier name
    public function filter_by_cus_sup_name($get_cus_sup_name)
    {
        $this->sql_seach_data .= " AND cus_sup_name = '" . $get_cus_sup_name . "'";
    }

    // Search customer/supplier name like
    public function search_by_cus_sup_name($get_cus_sup_name)
    {
        $this->sql_seach_data .= " AND cus_sup_name LIKE '%" . $get_cus_sup_name . "%'";
    }

    // Filter by email
    public function filter_by_email($get_email)
    {
        $this->sql_seach_data .= " AND email = '" . $get_email . "'";
    }

    // Filter by phone number
    public function filter_by_phone_no($get_phone_no)
    {
        $this->sql_seach_data .= " AND phone_no = '" . $get_phone_no . "'";
    }

    // Filter by statement date
    public function filter_by_statement_date($get_statement_date)
    {
        $this->sql_seach_data .= " AND statement_date = '" . $get_statement_date . "'";
    }

    // Filter by statement date range
    public function filter_by_statement_date_range($start, $end)
    {
        $this->sql_seach_data .= " AND statement_date BETWEEN '" . $start . "' AND '" . $end . "'";
    }

    // Filter by due or expiry date
    public function filter_by_due_or_exp_date($get_due_or_exp_date)
    {
        $this->sql_seach_data .= " AND due_or_exp_date = '" . $get_due_or_exp_date . "'";
    }

    // Filter by payment state
    public function filter_by_payment_state($get_payment_state)
    {
        $this->sql_seach_data .= " AND payment_state = '" . $get_payment_state . "'";
    }

    // Filter by draft state
    public function filter_by_draft_state($get_draft_state)
    {
        $this->sql_seach_data .= " AND draft_state = '" . $get_draft_state . "'";
    }

    // Filter by finish state
    public function filter_by_finish_staet($get_finish_staet)
    {
        $this->sql_seach_data .= " AND finish_staet = '" . $get_finish_staet . "'";
    }

    // Filter by main user login id
    public function filter_by_main_user_login_id($get_main_user_login_id)
    {
        $this->sql_seach_data .= " AND main_user_login_id = '" . $get_main_user_login_id . "'";
    }

    // Filter by company id
    public function filter_by_company_id($get_company_id)
    {
        $this->sql_seach_data .= " AND company_id = '" . $get_company_id . "'";
    }

    // Filter by branch id
    public function filter_by_branch_id($get_branch_id)
    {
        $this->sql_seach_data .= " AND branch_id = '" . $get_branch_id . "'";
    }

    // Filter by exchange currency name
    public function filter_by_ex_currency_name($get_ex_currency_name)
    {
        $this->sql_seach_data .= " AND ex_currency_name = '" . $get_ex_currency_name . "'";
    }

    // Filter by base currency name
    public function filter_by_base_currency_name($get_base_currency_name)
    {
        $this->sql_seach_data .= " AND base_currency_name = '" . $get_base_currency_name . "'";
    }

    // Filter by online payment state
    public function filter_by_online_payment_state($get_online_payment_state)
    {
        $this->sql_seach_data .= " AND online_payment_state = '" . $get_online_payment_state . "'";
    }

    // Filter by ecommerce state
    public function filter_by_is_ecommers_data($get_is_ecommers_data)
    {
        $this->sql_seach_data .= " AND is_ecommers_data = '" . $get_is_ecommers_data . "'";
    }

    // Filter by customer/supplier state
    public function filter_by_cus_sup_state($get_cus_sup_state)
    {
        $this->sql_seach_data .= " AND cus_sup_state = '" . $get_cus_sup_state . "'";
    }

    // Filter by billing address state
    public function filter_by_billing_address_state($get_billing_address_state)
    {
        $this->sql_seach_data .= " AND billing_address_state = '" . $get_billing_address_state . "'";
    }

    // Filter by shipping address state
    public function filter_by_shipping_address_state($get_shipping_address_state)
    {
        $this->sql_seach_data .= " AND shipping_address_state = '" . $get_shipping_address_state . "'";
    }

    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . "
                          FROM statement_doc
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}
