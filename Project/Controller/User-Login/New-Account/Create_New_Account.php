<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Create_New_Account {

    private $email;
    private $type_of_account;
    private $user_type_id;
    private $user_name_to_show;
    private $company_data_obj;
    private $user_id;
//    ----------------
    private $error_msg;

    public function __construct($get_email, $get_show_name, $get_type_of_accounts, $get_user_account_type_id) {
        $this->email = $get_email;
        $this->type_of_account = $get_type_of_accounts;
        $this->user_type_id = $get_user_account_type_id;
        $this->user_name_to_show = $get_show_name;
        $this->company_data_obj = new Company_Info_Variable_List();
    }

    private function set_error($get_error) {
        $this->error_msg = $get_error;
    }

    public function process_account() {
        $state_update = false;

        $data_base_obj = new DataBase();
        $get_sql_query = "select * from main_user_login where user_name='" . $this->email . "' and ast='1' ";
        $result = $data_base_obj->get_result($get_sql_query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->user_id = $row['id'];
                if ($row['email_verify'] == "0") {
                    if ($row['very_first_login'] == "0") {
                        if ($this->sending_email()) {
                            $state_update = true;
                        } else {
                            $this->set_error("email sending fail");
                        }
                    } else {
                        $this->set_error("email address already in used");
                    }
                } else {
                    $this->set_error("email address already in used");
                }
            }
        } else {

            $data_base_obj = new DataBase();
            $get_sql_query = "INSERT INTO  main_user_login (user_name,password,account_active_state,ast,sdt,last_login,name_show,email_verify,moible_verfiy,very_first_login,cook_key,ref_key,temp_lock,full_block,main_user_account_access_level_list_id,ac_type,company_id,control_account_state) VALUES "
                    . "('" . $this->email . "','NOT_FOUND','0','1',now(),now(),'" . $this->user_name_to_show . "','0','0','0','NO_DATA','NO_DATA','0','0','" . $this->user_type_id . "','" . $this->type_of_account . "','" . $this->company_data_obj->get_compnay_id() . "','0')";
            $this->set_error($get_sql_query);
            $data_base_obj->get_result($get_sql_query);
            if ($data_base_obj->get_error_state_boolean()) {
                $this->user_id = $data_base_obj->get_id();
                if ($this->sending_email()) {
                    $state_update = true;
                } else {
                    $this->set_error("email sending fail");
                }
            } else {
                $this->set_error($data_base_obj->get_error());
            }
        }
        return $state_update;
    }

    private function sending_email() {
        $send_email_obj = new User_Login_Create_New_Account_N_Active_Email($this->user_id, $this->email);
        return $send_email_obj->send_message();
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_error() {
        return $this->error_msg;
    }
}
