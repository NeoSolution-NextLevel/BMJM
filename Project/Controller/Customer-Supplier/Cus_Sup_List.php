<?php

class Cus_Sup_List {

    private $get_sql_query;
    private $state_cus = "0";
    private $state_sup = "0";
    private $seach_data_value = "";
    private $seach_data = "";
    private $company_data;

    public function __construct() {
        $this->company_data = new Company_Info_Variable_List();
    }

    public function set_search_data($get_search_data) {
        $this->seach_data_value = $get_search_data;
    }

    public function search_from_name() {
        $this->seach_data = " and name like '%" . $this->seach_data_value . "%'";
    }

    public function search_from_email() {
        $this->seach_data = " and email like '%" . $this->seach_data_value . "%'";
    }

    public function search_from_contact_no() {
        $this->seach_data = " and moble_no_for_sms like '%" . $this->seach_data_value . "%'";
    }

    private $bool_search_from_self_customer_credit_list = false;

    public function search_from_self_customer_credit_list() {
        $this->bool_search_from_self_customer_credit_list = true;
        $this->seach_data = "";
    }

    public function isCustomer() {
        $this->state_cus = "1";
        $this->state_sup = "0";
    }

    public function isSupplier() {
        $this->state_cus = "0";
        $this->state_sup = "1";
    }

    public function count_self_account() {
//        $this->get_sql_query = "select count(id) from cus_sup_list where ast='1' and self_account='1' and active='0' and cus_state='' and sup_state=''";
        if ($this->bool_search_from_self_customer_credit_list) {
            $this->get_sql_query = " select count(id) from cus_sup_list where ast='1' and self_account='1' and active='1' and cus_self_credit_from='1' and cus_state='" . $this->state_cus . "' and cus_credit_state='1' and company_id='" . $this->company_data->get_compnay_id() . "'";
        } else {
            $this->get_sql_query = "select count(id) from cus_sup_list where ast='1' and (cus_state='" . $this->state_cus . "' and sup_state='" . $this->state_sup . "' and self_account='1' and active='0') OR "
                    . "(cus_credit_request='1' and active='1' and cus_self_credit_from='1' and cus_state='" . $this->state_cus . "' and cus_credit_state='0' )";
        }
    }

    public function get_search_from_cus_sup_id($get_cus_sup_id) {
        $this->get_sql_query = "select * from cus_sup_list where ast='1' and id='" . $get_cus_sup_id . "'" . " and company_id='" . $this->company_data->get_compnay_id() . "'";
    }

    public function process() {
        $data_base_obj = new DataBase();
        return $data_base_obj->get_result($this->get_sql_query);
    }

    public function get_self_account_list() {
        if ($this->bool_search_from_self_customer_credit_list) {
            $this->get_sql_query = " select * from cus_sup_list where ast='1' and self_account='1' and active='1' and cus_self_credit_from='1' and cus_state='" . $this->state_cus . "' and cus_credit_state='1' and company_id='" . $this->company_data->get_compnay_id() . "'";
        } else {
//        $this->get_sql_query = "select * from cus_sup_list where ast='1' and self_account='1' and active='0' and cus_state='" . $this->state_cus . "' and sup_state='" . $this->state_sup . "' " . $this->seach_data;
            $this->get_sql_query = "select * from cus_sup_list where ast='1' and (cus_state='" . $this->state_cus . "' and sup_state='" . $this->state_sup . "' and self_account='1' and active='0' ) OR "
                    . "(cus_credit_request='1' and active='1' and cus_self_credit_from='1' and cus_state='" . $this->state_cus . "' and cus_credit_state='0')" . $this->seach_data . " and company_id='" . $this->company_data->get_compnay_id() . "'";
        }
    }

    public function get_supplier_to_customer_list() {
        $this->get_sql_query = "select * from cus_sup_list where ast='1' and cus_state='0' and sup_state='1' " . $this->seach_data ." and company_id='" . $this->company_data->get_compnay_id() . "'";
    }

    public function get_customer_to_supplier_list() {
        $this->get_sql_query = "select * from cus_sup_list where ast='1' and cus_state='1' and sup_state='0' " . $this->seach_data . " and company_id='" . $this->company_data->get_compnay_id() . "'";
    }

    public function get_variable_answer_single_data($get_cus_sup_id, $get_variable_id) {
        $get_data = "";
        $this->get_sql_query = "select variable_answer from cus_sup_variable_answers where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $get_cus_sup_id . "'";
        $data_base_obj = new DataBase();
        $get_result = $data_base_obj->get_result($this->get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_data = $row['variable_answer'];
            }
        }
        return $get_data;
    }

    public function get_variable_answer_big_text_single_data($get_cus_sup_id, $get_variable_id) {
        $get_data = "";
        $this->get_sql_query = "select variable_answer from cus_sup_variable_answers_big_text where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $get_cus_sup_id . "'";
        $data_base_obj = new DataBase();
        $get_result = $data_base_obj->get_result($this->get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_data = $row['variable_answer'];
            }
        }
        return $get_data;
    }

    public function get_sql_query() {
        return $this->get_sql_query;
    }
}
