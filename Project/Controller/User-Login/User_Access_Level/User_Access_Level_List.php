<?php

class User_Access_Level_List {

    private $compnay_variable_list_obj;
    private $search_value = "0";

    public function __construct($get_search_value) {
        if ($get_search_value == "") {
            
        } else {
            $this->search_value = $get_search_value;
        }
        $this->compnay_variable_list_obj = new Company_Info_Variable_List();
    }

    public function list_result_set() {
        $data_base_obj = new DataBase();
        $search_from_name = "";
        if ($this->search_value != "0") {
            $search_from_name = " and type_of_access like '%" . $this->search_value . "%' ";
        }
        $get_sql_query = "select * from main_user_account_access_level_list where show_custoer_account='1' and company_id='" . $this->compnay_variable_list_obj->get_compnay_id() . "'" . $search_from_name;
        return $data_base_obj->get_result($get_sql_query);
    }
}
