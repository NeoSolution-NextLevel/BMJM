<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Admin_Active_Deactive_Account {

    private $email_db_obj;
    private $user_id;
    private $email;
    private $sec_key;
    private $html_data;
//------------------------------------

    private $company_data_obj;

    public function __construct($get_user_id) {
        $this->user_id = $get_user_id;

        $user_detail_obj = new User_Details($this->user_id);
        $this->email = $user_detail_obj->get_email();

        $this->email_db_obj = new Email_DB_Conn($this->email, $this->user_id);
        $this->email_db_obj->email_type_new_login();
        $this->email_db_obj->process_data();
        $this->sec_key = $this->email_db_obj->get_sec_key();

//          ----------------------------------------------------
        $this->company_data_obj = new Company_Info_Variable_List();
        $this->set_utl_go_to_user_login = "https://" . rtrim($this->company_data_obj->get_app_URL(), "/") . "/Login.php";

//        --------------------------------------------------------


        $this->set_body();
    }

    private $set_utl_go_to_user_login;
    private $message;
    private $heading;

    public function set_active() {
        $this->heading = "Your Account Activation Success";
        $this->message = "
            <p>
                We're reaching out to inform you that your account activation was successful. Your account is now active and ready for use.
            </p>
            <br>
            <p>                        
                If you did not authorize this activation, or if you have any concerns regarding your account security, please don't hesitate to contact us immediately.
            </p>";
    }

    public function set_deactive() {
        $this->heading = "Your Account Deactivation";
        $this->message = "
          <p>
            We're reaching out to inform you that your account deactivation was successful. Your account has been deactivated and is no longer active.
          </p>
            <br>
          <p>                        
            If you did not authorize this deactivation, or if you have any concerns regarding your account security, please don't hesitate to contact us immediately.
          </p>"
        ;
    }

    private function set_body() {
        $this->html_data = "
     <h1> " . $this->heading . "</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                       <p>Hello,</p>
                        " . $this->message . "                       
                      </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
                <td></td>
                <td>
                    <a href='" . $this->set_utl_go_to_user_login . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding ' >
                       <b>Login To Your Account</b>
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
        $email_sending_obj = new Email($this->email, $this->heading." Notification", $this->html_data);
        $state = $email_sending_obj->send_email();

        return $state;
    }
}
