<?php

class Add_Update_Cus_Sup_Bank_Details {

    private $cus_sup_id;
    private $bank_name;
    private $bank_code;
    private $branch_name;
    private $branch_code;
    private $account_no;
    private $account_name;
    private $user_id;

    public function __construct($get_cus_sup_id, $get_user_id) {
        $this->cus_sup_id = $get_cus_sup_id;
        $this->user_id = $get_user_id;
        $this->time_stamp_data_obj = date('Y-m-d H:i:s');
    }

    private $time_stamp_data_obj;
//,,,ast,sdt,active_state,main_user_login_id,cus_sup_list_id,
    private $id;
    private $sql_update_data = "";

    public function set_id($get_id) {
        $this->id = $get_id;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_bank_data($get_bank_name, $get_bank_code) {
        $this->bank_name = $get_bank_name;
        $this->bank_code = $get_bank_code;
        $this->sql_update_data = $this->sql_update_data . ",bank_name='" . $this->bank_name . "',branch_name='" . $this->bank_code . "'";
    }

    public function set_branch_data($get_branch_name, $get_branch_code) {
        $this->branch_name = $get_branch_name;
        $this->branch_code = $get_branch_code;
        $this->sql_update_data = $this->sql_update_data . ",bank_code='" . $this->branch_name . "',branch_code='" . $this->branch_code . "'";
    }

    public function set_account_data($get_account_name, $get_account_no) {
        $this->account_name = $get_account_name;
        $this->account_no = $get_account_no;
        $this->sql_update_data = $this->sql_update_data . ",account_no='" . $this->account_no . "',ac_name='" . $this->account_no . "'";
    }

    private $ac_type;

    public function is_CrrentAC() {
        $this->ac_type = "Current Account";
        $this->sql_update_data = $this->sql_update_data . ",account_type='" . $this->ac_type . "'";
    }

    public function is_SavingsAC() {
        $this->ac_type = "Savings Account";
        $this->sql_update_data = $this->sql_update_data . ",account_type='" . $this->ac_type . "'";
    }

    private $get_error;
    private $ast_state = "1";

    public function remove_data() {
        $this->ast_state = "0";
    }

    private function set_error($get_error_msg) {
        $this->get_error = $get_error_msg;
    }

    public function get_error() {
        return $this->get_error;
    }

    public function process_new_data() {
        $data_base_obj = new DataBase();
        $get_sql_query = "INSERT INTO cus_sup_bank_account(bank_name,branch_name,bank_code,branch_code,account_no,account_type,ast,sdt,active_state,main_user_login_id,cus_sup_list_id,ac_name) VALUES "
                . "('" . $this->bank_name . "','" . $this->branch_name . "','" . $this->bank_code . "','" . $this->branch_code . "','" . $this->account_no . "','" . $this->ac_type . "','1','" . $this->time_stamp_data_obj . "','1','" . $this->user_id . "','" . $this->cus_sup_id . "','" . $this->account_name . "')";
        $data_base_obj->get_result($get_sql_query);
        $this->set_error($data_base_obj->get_error());
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update_data() {
        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_bank_account set ast='" . $this->ast_state . "'" . $this->sql_update_data . " where id='" . $this->id . "'";
        $data_base_obj->get_result($get_sql_query);
        $this->set_error($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }
}
