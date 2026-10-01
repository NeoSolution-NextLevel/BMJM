<?php

class Cus_Sup_Bank_Account_List {

    private $select_data_setup = "*";
    private $sql_query;
    private $sql_seach_query = "";
    private $pagination_data_result;
    private $company_data;
    private $cus_sup_id;

    public function __construct($get_cus_sup_id) {
        $this->company_data = new Company_Info_Variable_List(); // Assuming you are using the same company info setup
        $this->cus_sup_id = $get_cus_sup_id;
        $this->sql_seach_query .= " and cus_sup_list_id='" . $this->cus_sup_id . "'";
    }

    public function set_data_limits($start_point, $per_page_data_count) {
        $this->pagination_data_result = "LIMIT " . $start_point . ", " . $per_page_data_count;
    }

    public function search_bank_name($get_bank_name) {
        $this->sql_seach_query .= " and bank_name like '%" . $get_bank_name . "%'";
    }

    public function search_branch_name($get_branch_name) {
        $this->sql_seach_query .= " and branch_name like '%" . $get_branch_name . "%'";
    }

    public function search_account_no($get_account_no) {
        $this->sql_seach_query .= " and account_no='" . $get_account_no . "'";
    }

    public function search_account_type($get_account_type) {
        $this->sql_seach_query .= " and account_type='" . $get_account_type . "'";
    }

    public function is_Current_Account() {
        $this->sql_seach_query .= " and account_type='Current Account'";
    }

    public function is_Saveings_Account() {
        $this->sql_seach_query .= " and account_type='Savings Account'";
    }

    public function search_bank_code($get_bank_code) {
        $this->sql_seach_query .= " and bank_code='" . $get_bank_code . "'";
    }

    public function search_branch_code($get_branch_code) {
        $this->sql_seach_query .= " and branch_code='" . $get_branch_code . "'";
    }

    public function is_active() {
        $this->sql_seach_query .= " and active_state='1'";
    }

    public function is_inactive() {
        $this->sql_seach_query .= " and active_state='0'";
    }

    private $avaible_state = "1";

    public function remove_data_list() {
        $this->avaible_state = "0";
    }

    public function get_sum_of_account_balances() {
        $this->select_data_setup = " sum(balance) ";
    }

    public function get_count_of_accounts() {
        $this->select_data_setup = " count(id) ";
    }

    private $get_sql_query;

    public function get_sql_query() {
        return $this->get_sql_query;
    }

    public function get_process_and_get_result() {
        $data_base_obj = new DataBase();
        $this->get_sql_query = "SELECT " . $this->select_data_setup . " 
                                FROM cus_sup_bank_account 
                                WHERE ast='" . $this->avaible_state . "' " .
                $this->sql_seach_query . $this->pagination_data_result;
        return $data_base_obj->get_result($this->get_sql_query);
    }
}
