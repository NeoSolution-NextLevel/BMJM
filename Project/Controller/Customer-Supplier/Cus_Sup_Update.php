<?php

class Cus_Sup_Update {

    private $cus_sup_id;
    private $get_sql_query;

    public function __construct($get_cus_sup_id) {
        $this->cus_sup_id = $get_cus_sup_id;
    }

    public function verify_email() {
        $this->get_sql_query = "update cus_sup_list set verify_email='1' where id='" . $this->cus_sup_id . "'";
    }

    public function verify_mobile_number() {
        $this->get_sql_query = "update cus_sup_list set verify_sms='1' where id='" . $this->cus_sup_id . "'";
    }

    public function approve_cus_sup() {
        $this->get_sql_query = "update cus_sup_list set self_account='1',active='1' where id='" . $this->cus_sup_id . "'";
    }

    public function request_cus_credit() {
        $this->get_sql_query = "update cus_sup_list set cus_credit_request='1' where id='" . $this->cus_sup_id . "'";
    }
    public function verify_credit_form() {
        $this->get_sql_query = "update cus_sup_list set cus_credit_state='1' where id='" . $this->cus_sup_id . "'";
    }
    public function cus_cancel_full_credit(){
        $this->get_sql_query="update cus_sup_list set cus_credit_state='0',cus_self_credit_from='0',cus_PD_chque='0',cus_credit_period='0',cus_credit_limit='0' where id='" . $this->cus_sup_id . "'";
    }

    private $error_msg;

    private function set_error($get_error) {
        $this->error_msg = $get_error;
    }

    public function get_error() {
        return $this->error_msg;
    }

    public function process() {
        $data_base_obj = new DataBase();
        $data_base_obj->get_result($this->get_sql_query);
        $this->set_error($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }
}
