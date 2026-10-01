<?php

class Customer_Supplier_Variable_List {

    private $search_from_variable_name;
    private $seach_para = false;
    private $error_msg;

    public function __construct() {
        $this->seach_para = false;
    }

    public function search_value_from_variable_name($get_variable_name) {
        $this->search_from_variable_name = $get_variable_name;
        $this->seach_para = true;
    }

    public function get_result_obj() {
        $compnay_varialbe_list_obj = new Company_Info_Variable_List();

        $get_sql_query = "SELECT * FROM cus_sup_variable_list where ast='1' and company_id='" . $compnay_varialbe_list_obj->get_compnay_id() . "'";
        if ($this->seach_para) {
            $get_sql_query = $get_sql_query . " and variable_name like '%" . $this->search_from_variable_name . "%'";
        }
         $get_sql_query = $get_sql_query ." ORDER BY order_num ASC";
        $data_base_obj = new DataBase();
        return $data_base_obj->get_result($get_sql_query);
    }
}
