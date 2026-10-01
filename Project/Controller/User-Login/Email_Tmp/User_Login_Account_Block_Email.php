<?php

class User_Account_Block_Email {

    private $email_db_obj;
    private $user_id;
    private $email;
    private $sec_key;
    private $html_data;
//------------------------------------
    private $county;
    private $my_ip;
    private $location;
//------------------------------------
    private $company_data_obj;

    public function __construct($get_user_id, $get_email, $get_country, $get_IP, $get_loction) {
        $this->user_id = $get_user_id;
        $this->email = $get_email;

        $this->county = $get_country;
        $this->my_ip = $get_IP;
        $this->location = $get_loction;

//        ----------------------------------------------------
        $this->company_data_obj = new Company_Info_Variable_List();

//        --------------------------------------------------------
        $this->email_db_obj = new Email_DB_Conn($this->email, $this->user_id);
        $this->email_db_obj->email_type_temp_lock_login();
        $this->email_db_obj->process_data();
        $this->sec_key = $this->email_db_obj->get_sec_key();

        $this->set_url_Change_Your_Password_Unlock_Your_Account = $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/change_your_password_unlock_account.php?ref_id=" . $this->sec_key;
        $this->set_url_Unlock_Your_Account_without_Changeing_the_password =$this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/process_without_pasword.php?ref_id=" . $this->sec_key;
        $this->set_body();
    }

    private $set_url_Change_Your_Password_Unlock_Your_Account;
    private $set_url_Unlock_Your_Account_without_Changeing_the_password;

    private function set_body() {
        $this->html_data = "
     <h1>Unauthorized Login IP Address Detected</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                        <p>Hello,</p>
                        <p>An unauthorized IP address <strong>" . $this->my_ip . "</strong> has attempted to access your system.Please take necessary actions to secure your system.</p>
                        <small><p>Login Persion Details : Location " . $this->location . "  | Country " . $this->county . "</p></small>
                        
                    </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
               <td></td>
                <td>
                    <a href='" . $this->set_url_Change_Your_Password_Unlock_Your_Account . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                        Change Your Password & Unlock Your Account
                    </a>
                </td>
                 <td></td>
            </tr>
            <tr class='w3-margin-top'>
                <td style='width: 35%;'></td>
                <td style='width: 30%;'>
                    <a href='" . $this->set_url_Unlock_Your_Account_without_Changeing_the_password . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                        Unlock Your Account Without Changing Password 
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
        $email_sending_obj = new Email($this->email, "Unauthorized Login Notification", $this->html_data);
        $state = $email_sending_obj->send_email();
        return $state;
    }
}
