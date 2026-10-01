<?php
include_once 'user_details.php';

class User_Details_Update {

    private $user_id;
    private $email;
    private $error;

    public function __construct($get_user_id) {
        $this->user_id = $get_user_id;
        $get_user_info_obj = new User_Details($this->user_id);
        $this->email = $get_user_info_obj->get_email();
    }

    public function change_password($get_new_password) {
        $state = false;
        $advance_sec_Obj = new Advance_Security();
        $get_new_password = $advance_sec_Obj->get_data_encrypt($this->email, $get_new_password);
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set password='" . $get_new_password . "' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);

        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }
        $data_base_obj = null;
        return $state;
    }
     public function change_email($get_new_email) {
        $state = false;        
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set password='NOT_FOUND',user_name='".$get_new_email."',cook_key='NO_DATA',ref_key='NO_DATA',email_verify='0',very_first_login='0',account_active_state='0' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }
        $data_base_obj = null;
        return $state;
    }

    private function set_error($get_error) {
        $this->error = $get_error;
    }

    public function get_error() {
        return $this->error;
    }

    public function change_temp_block_to_unblock() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set temp_lock='0' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_temp_block_to_block() {
        $state = true;
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set temp_lock='1' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_active_account() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set account_active_state='1' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_deactive_account() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set account_active_state='0' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_fully_block() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set full_block='1' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_fully_unblock() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set full_block='0' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_email_varify() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set email_verify='1' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }

    public function change_mobile_varify() {
        $data_base_obj = new DataBase();
        $sql_query = "update main_user_login set moible_verfiy='1' where id='" . $this->user_id . "'";
        $data_base_obj->get_result($sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->set_error($data_base_obj->get_error());
        }


        $data_base_obj = null;
        return $state;
    }
}
