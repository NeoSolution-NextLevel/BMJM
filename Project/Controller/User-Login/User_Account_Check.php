<?php

class User_Account_Check {

    private $user_name;
    private $password;
    private $error = "";
    private $data_basic_obj;
    private $user_id;
    private $account_login_state = false;
    private $passworg_state = false;
    private $email;

    public function __construct($user_name, $password) {
        $this->user_name = $user_name;

        $advance_security_check = new Advance_Security();
        $this->password = $advance_security_check->get_data_encrypt($this->user_name, $password);
    }

    public function check_user_name() {
        $this->account_login_state = false;
        $this->data_basic_obj = new DataBase();
        $data_base = $this->data_basic_obj->get_data_base_connction();
        $sql_query = "select id from main_user_login where user_name='" . $this->user_name . "'";
        $result = $data_base->query($sql_query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->user_id = $row['id'];
            }
            $this->account_login_state = true;
        } else {
            $this->set_error_data("We're sorry, but the username you entered does not match any records in our system. Please double-check your username and try again.");
            $this->account_login_state = false;
        }
        return $this->account_login_state;
    }

    private function set_error_data($get_error) {
        $this->error = $get_error;
    }

    public function get_error() {
        return $this->error;
    }

    public function process_account_login() {
        return $this->account_login_state;
    }

    public function check_password() {
        $this->account_login_state = false;
        $this->data_basic_obj = new DataBase();
        $data_base = $this->data_basic_obj->get_data_base_connction();
        $sql_query = "select * from main_user_login where user_name='" . $this->user_name . "' and password='" . $this->password . "'";
        $result = $data_base->query($sql_query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->user_id = $row['id'];
                $this->email = $row['user_name'];
                if ($row['email_verify'] == "0") {
                    $this->account_login_state = false;
                    $this->set_error_data("Email verification failed. Please verify your email address.");
                } else if ($row['account_active_state'] == "1") {
                    if ($row['full_block'] == "1") {
                        $this->account_login_state = false;
                        $this->set_error_data("We regret to inform you that your account has been blocked. Please contact the system administrator for further assistance.");
                    } else if ($row['temp_lock'] == "1") {
                        $this->account_login_state = false;
                        $this->set_error_data("We kindly ask you to check your email inbox for further instructions. If you have received a temporary block notification, please follow the instructions provided in the email to resolve the issue.");
                    } else {

                        $this->account_login_state = true;
                    }
                } else {
                    $this->account_login_state = false;
                    $this->set_error_data("We regret to inform you that your account is currently inactive. Please contact our support team for further assistance.");
                }
            }
            $this->passworg_state = false;
        } else {
            $this->passworg_state = true;
            $this->set_error_data("We're sorry, but the password you entered is incorrect. Please double-check your password and try again ");
            $this->account_login_state = false;
        }
        return $this->account_login_state;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_password_wrong_state() {
        return $this->passworg_state;
    }

    public function temporary_block_account($get_country, $get_IP, $get_loction) {

        $this->account_login_state = false;
        $user_obj_temp_block = new User_Details_Update($this->user_id);

        if ($user_obj_temp_block->change_temp_block_to_block()) {
//            new User_Account_Block_Email($this->user_id, $this->email, $get_country, $get_IP, $get_loction)
            $sending_email = new User_Account_Block_Email($this->user_id, $this->user_name, $get_country, $get_IP, $get_loction);

//            $message = $this->user_id . "==" . $this->user_name . "==" . $get_country . "==" . $get_IP . "==" . $get_loction;
//
//            mail("ansif@neosolution.lk", "error", $message, "");
            if ($sending_email->send_message()) {
                $this->passworg_state = true;
                $this->set_error_data("We're sorry, but the password you entered is incorrect. Your account is temporarily blocked. Please check your email for further instructions to login");
                $this->account_login_state = false;
            } else {
                $this->set_error_data("email sending fail");
                $this->account_login_state = false;
            }
        } else {
            $this->set_error_data($_SERVER['REQUEST_URI'] . $user_obj_temp_block->get_error() . " line 113 error");
            $this->account_login_state = false;
        }
        return $this->account_login_state;
    }
}
