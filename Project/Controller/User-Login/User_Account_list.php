<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class User_Account_List {

    private $compnay_variable_list_obj;
    private $search_value = "";

    public function __construct($get_search_value) {
        if ($get_search_value == "") {
            
        } else {
            $this->search_value = " and user_name='" . $get_search_value . "'";
        }
        $this->compnay_variable_list_obj = new Company_Info_Variable_List();
    }

    public function get_rider_report() {
          $this->search_value=  $this->search_value." and ac_type='rider'";
    }

    public function list_result_set() {
        $data_base_obj = new DataBase();
        $search_from_name = "";
        if ($this->search_value != "0") {
            $search_from_name = " and user_name like '%" . $this->search_value . "%' ";
        }
        $get_sql_query = "select * from main_user_login where control_account_state='0' and company_id='" . $this->compnay_variable_list_obj->get_compnay_id() . "' and ast='1'" . $this->search_value;
        return $data_base_obj->get_result($get_sql_query);
    }
}
