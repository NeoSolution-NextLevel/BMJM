<?php

class User_Login_Email_Password_Recovery {

    private $email_db_obj;
    private $user_id;
    private $email;
    private $sec_key;
    private $html_data;
//------------------------------------
    private $county;
    private $my_ip;
    private $location;
//    -------------------
    private $company_data_obj;

    public function __construct($get_user_id, $get_email) {
        $this->user_id = $get_user_id;
        $this->email = $get_email;

        $this->email_db_obj = new Email_DB_Conn($this->email, $this->user_id);
        $this->email_db_obj->email_type_temp_lock_login();
        $this->email_db_obj->process_data();
        $this->sec_key = $this->email_db_obj->get_sec_key();

//          ----------------------------------------------------
        $this->company_data_obj = new Company_Info_Variable_List();
        $this->set_url_Reset_Your_Password = $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/change_your_password_unlock_account.php?ref_id=" . $this->sec_key;
        $this->set_url_Login_Without_Resetting_Your_Password_Using_Cookies = $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/process_without_pasword.php?ref_id=" . $this->sec_key;

//        --------------------------------------------------------


        $this->set_body();
    }

    private $set_url_Reset_Your_Password;
    private $set_url_Login_Without_Resetting_Your_Password_Using_Cookies;

    private function set_body() {
        $this->html_data = "
     <h1>Password Recovery</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                        <p>Hello,</p>
                        <p>You have requested to recover your password. Please follow the link below to reset your password</p>
                        <small><p>If you did not request this password reset, please ignore this message.</p></small>
                        
                    </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
               <td></td>
                <td>
                    <a href='" . $this->set_url_Reset_Your_Password . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                       Reset Your Password
                    </a>
                </td>
                <td></td>
            </tr>
            <tr class='w3-margin-top'>
                <td style='width: 35%;'></td>
                <td style='width: 30%;'>
                    <a href='" . $this->set_url_Login_Without_Resetting_Your_Password_Using_Cookies . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                        Login Without Resetting Your Password Using Cookies
                    </a>
                </td>
                <td style='width: 35%;'></td>
            </tr>
        </table>

";
    }

    public function send_message() {
        $state = false;
        $this->set_body();
        $email_sending_obj = new Email($this->email, "Reset Your Password", $this->html_data);
        $state = $email_sending_obj->send_email();

        return $state;
    }
}
