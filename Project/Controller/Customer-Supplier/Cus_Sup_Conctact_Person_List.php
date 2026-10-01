<?php

class Cus_Sup_Contact_Person {

    private $get_cus_sup_id;
    private $get_seach_name;
    private $compnay_data_obj;

    public function __construct($get_cus_sup_id) {
        $this->get_cus_sup_id = $get_cus_sup_id;
        $this->compnay_data_obj = new Company_Info_Variable_List();
    }

    public function search_from_name($get_search_name) {
        if ($get_search_name == "") {
            
        } else {
            $this->get_seach_name = " and name like '%" . $get_search_name . "%'";
        }
    }

    public function get_result_set_data_list() {
        $data_base_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_contact_person where ast='1' and cus_sup_list_id='" . $this->get_cus_sup_id . "' and company_id='" . $this->compnay_data_obj->get_compnay_id() . "'" . $this->get_seach_name;
        return $data_base_obj->get_result($get_sql_query);
    }
}
