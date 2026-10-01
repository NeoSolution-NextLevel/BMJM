<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class User_Login_Email_Notification {

    private $email_db_obj;
    private $user_id;
    private $email;
    private $sec_key;
    private $html_data;
//------------------------------------
    private $county;
    private $my_ip;
    private $location;
//    --------------------
    private $company_data_obj;

    public function __construct($get_user_id, $get_email, $get_country, $get_IP, $get_loction) {
        $this->user_id = $get_user_id;
        $this->email = $get_email;

        $this->county = $get_country;
        $this->my_ip = $get_IP;
        $this->location = $get_loction;

        $this->email_db_obj = new Email_DB_Conn($this->email, $this->user_id);
        $this->email_db_obj->email_type_new_login();
        $this->email_db_obj->process_data();
        $this->sec_key = $this->email_db_obj->get_sec_key();

//          ----------------------------------------------------
        $this->company_data_obj = new Company_Info_Variable_List();
        $this->set_url_Change_Your_Password_and_Log_Out_of_All_Devices = $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/change_your_password_unlock_account.php?ref_id=" . $this->sec_key;

//        --------------------------------------------------------



        $this->set_body();
    }

    private $set_url_Change_Your_Password_and_Log_Out_of_All_Devices;

    private function set_body() {
        $this->html_data = "
     <h1>New Device Login IP Address Detected</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                        <p>Hello,</p>
                        <p>A new IP address <strong>" . $this->my_ip . "</strong> has been detected trying to access your system. If this login is unauthorized, please take immediate action to secure your network and systems.</p>
                        <small><p>Login Persion Details : Location " . $this->location . "  | Country " . $this->county . "</p></small>
  
                    </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
                 <td></td>
                <td>
                    <a href='" . $this->set_url_Change_Your_Password_and_Log_Out_of_All_Devices . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                        Change Your Password and Log Out of All Devices
                    </a>
                </td>
                <td></td>
            </tr>
            
        </table>

";
    }

    public function send_message() {
        $state = false;
        $this->set_body();
        $email_sending_obj = new Email($this->email, "New Device Login Notification", $this->html_data);
        $state = $email_sending_obj->send_email();

        return $state;
    }
}
