<?php

//C:\xampp\htdocs\User_Account_Emp_Management\Controller\User-Login\Email_Tmp\Email_DB_Conn.php
class Email_DB_Conn {

    private $state_reset_password = false;
    private $state_new_login = false;
    private $state_temp_lock = false;
    private $state_name;
    private $email;
    private $user_id;
    private $error;
    private $sec_key;
    private $compnay_variable_obj;

    public function __construct($get_email, $get_user_id) {
        $this->email = $get_email;
        $this->user_id = $get_user_id;
        $this->compnay_variable_obj = new Company_Info_Variable_List();
    }

    public function email_type_reset_password() {
        $this->state_reset_password = true;
        $this->state_new_login = false;
        $this->state_temp_lock = false;
        $this->state_name = 'Reset_Password';
    }

    public function email_type_new_login() {
        $this->state_reset_password = false;
        $this->state_new_login = true;
        $this->state_temp_lock = false;
        $this->state_name = 'New_Login';
    }

    public function email_type_temp_lock_login() {
        $this->state_reset_password = false;
        $this->state_new_login = false;
        $this->state_temp_lock = true;
        $this->state_name = 'Temp_Lock';
    }

    public function process_data() {

        $ref_id = "0";
        $val_of_long = floor(microtime(true) * 1000);
        $ref_id = substr($val_of_long, -7);

        $advance_encript = new Advance_Security();
        $this->sec_key = $advance_encript->get_data_encrypt($this->email, $ref_id);

        $data_base_Obj = new DataBase();
        $get_sql_query = "update main_user_login_email_list set email_steate='1' where main_user_login_id='".$this->user_id."'";
        $data_base_Obj->get_result($get_sql_query);

        $data_base_Obj = new DataBase();
        $data_base = $data_base_Obj->get_data_base_connction();
        $sql_query = "INSERT INTO main_user_login_email_list(email_steate,key_of_email,ast,sdt,type_email,main_user_login_id,company_id) VALUES ('0','" . $this->sec_key . "','1',now(),'" . $this->state_name . "','" . $this->user_id . "','" . $this->compnay_variable_obj->get_compnay_id() . "')";
//        echo $sql_query." --- line 52";
        $data_base->query($sql_query);
        if ($data_base->error == "") {
            
        } else {
            $this->set_error("some tihng wrong line 53");
        }
    }

    public function get_sec_key() {
        return $this->sec_key;
    }

    public function get_error() {
        return $this->error;
    }

    private function set_error($get_error) {
        $this->error = $get_error;
    }
}
