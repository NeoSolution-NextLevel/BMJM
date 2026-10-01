<?php

class Customer_Supplier_Variable_Create {

    private $user_id;
    private $varable_id;
    private $error_msg;
    private $cook_management_obj;
    private $get_company_variable_list;

    public function __construct($get_user_cook_id) {
        $this->cook_management_obj = new Cook_Management($get_user_cook_id);
        $this->get_company_variable_list = new Company_Info_Variable_List();
    }

    private $variable_name;
    private $variable_type;
    private $variable_cridt_doc;
    private $variable_state_cus;
    private $variable_state_sup;
    private $variable_state_requid;
    private $variable_state_personal;
    private $variable_state_business;
    private $variable_placeholder_msg;

    public function set_data($get_variable_name, $get_variable_type, $credit_doc_state, $state_cus, $state_sup, $state_reqird, $state_personal, $state_business, $placeholder_msg) {
        $this->variable_name = $get_variable_name;
        $this->variable_type = $get_variable_type;
        $this->variable_cridt_doc = $credit_doc_state;
        $this->variable_state_cus = $state_cus;
        $this->variable_state_sup = $state_sup;
        $this->variable_state_requid = $state_reqird;
        $this->variable_state_personal = $state_personal;
        $this->variable_state_business = $state_business;
        $this->variable_placeholder_msg = $placeholder_msg;
    }

    private $availbile_record_state = false;

    public function process_data() {
        $state = false;
        if ($this->cook_management_obj->check_login_availability()) {

            $this->user_id = $this->cook_management_obj->get_user_id();

            if ($this->check_variable()) {
                if ($this->availbile_record_state) {
                    if ($this->update_variable_to_active()) {
                        $state = true;
                    } else {
                        $state = false;
                        $this->error_msg = " This variable name is already in used";
                    }
                } else {
                    $state = false;
                    $this->error_msg = " This variable name is already in used";
                }
            } else {
                $data_base_obj = new DataBase();
                $get_sql_query = "INSERT INTO  cus_sup_variable_list (cus_need,sup_need,variable_name,variable_type,credit_doc,requird_state,personal_ac_only,cooperate_only,main_user_login_id,company_id,order_num,ast,remove_all_record,placeholder_message) VALUES "
                        . "('" . $this->variable_state_cus . "','" . $this->variable_state_sup . "','" . $this->variable_name . "','" . $this->variable_type . "','" . $this->variable_cridt_doc . "','" . $this->variable_state_requid . "','" . $this->variable_state_personal . "','" . $this->variable_state_business . "','" . $this->user_id . "','" . $this->get_company_variable_list->get_compnay_id() . "','0','1','0','".$this->variable_placeholder_msg."')";
                $data_base_obj->get_result($get_sql_query);
                $this->varable_id = $data_base_obj->get_id();
                if ($data_base_obj->get_error_state_boolean()) {
                    $this->update_order($this->get_max_id());
                    $state = true;
                } else {
                    $state = false;
                    $this->error_msg = $data_base_obj->get_error();
                }
            }
        }
        return $state;
    }

    private function check_variable() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select id,ast from cus_sup_variable_list where variable_name='" . $this->variable_name . "' and company_id='" . $this->get_company_variable_list->get_compnay_id() . "'";
        $result_set = $data_base_obj->get_result($get_sql_query);
        if ($result_set->num_rows > 0) {
            while ($row = $result_set->fetch_assoc()) {
                $this->varable_id = $row['id'];
                if ($row['ast'] == "0") {
                    $this->availbile_record_state = true;
                } else {
                    $this->availbile_record_state = false;
                }
                $state = true;
            }
        } else {
            $state = false;
        }
        return $state;
    }

    private function update_variable_to_active() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_variable_list set remove_all_record='0',ast='1',cus_need='" . $this->variable_state_cus . "',sup_need='" . $this->variable_state_sup . "',credit_doc='" . $this->variable_cridt_doc . "',requird_state='" . $this->variable_state_requid . "',personal_ac_only='" . $this->variable_state_personal . "',cooperate_only='" . $this->variable_state_business . "' where id='" . $this->varable_id . "'";
        $data_base_obj->get_result($get_sql_query);
        return $data_base_obj->get_error_state_boolean();
    }

    public function get_error() {
        return $this->error_msg;
    }

    public function set_variable_db_id($get_id) {
        $this->varable_id = $get_id;
    }

    private function get_max_id() {
        $get_max_id = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select max(id) from cus_sup_variable_list";
        $result_set = $data_base_obj->get_result($get_sql_query);
        if ($result_set->num_rows > 0) {
            while ($row = $result_set->fetch_assoc()) {
                $get_max_id = $row['max(id)'];
            }
        }
        return $get_max_id;
    }

    public function update_order($get_order_name_obj) {
        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_variable_list set order_num='" . $get_order_name_obj . "' where id='" . $this->varable_id . "'";
        $data_base_obj->get_result($get_sql_query);
        return $data_base_obj->get_error_state_boolean();
    }
}
