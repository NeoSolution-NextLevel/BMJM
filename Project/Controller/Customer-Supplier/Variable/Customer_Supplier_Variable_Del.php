<?php

class Customer_Supplier_Variable_Del {

    private $get_variable_id;
    private $error_msg;

    public function __construct($get_id) {
        $this->get_variable_id = $get_id;
    }

    public function del_only_variable() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_variable_list set ast='0' where id='" . $this->get_variable_id . "'";
        $data_base_obj->get_result($get_sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $this->set_error($data_base_obj->get_error());
            $state = true;
        } else {
            $state = false;
        }
        return $state;
    }

    public function del_all_record_variable() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_variable_list set ast='0',remove_all_record='1' where id='" . $this->get_variable_id . "'";
        $data_base_obj->get_result($get_sql_query);

        if ($data_base_obj->get_error_state_boolean()) {
            $this->set_error($data_base_obj->get_error());
            $state = true;
        } else {
            $state = false;
        }
        return $state;
    }

    private function set_error($get_error) {
        $this->error_msg = $get_error;
    }

    public function get_error() {
        return $this->error_msg;
    }
}
