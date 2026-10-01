<?php

//C:\xampp\htdocs\User_Account_Emp_Management\Controller\User-Login\Email_Tmp\User_Login_Create_New_Account_N_Active_Email.php
class User_Login_Create_New_Account_N_Active_Email {

    private $email_db_obj;
    private $user_id;
    private $email;
    private $sec_key;
    private $html_data;
//------------------------------------
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
        $this->set_url_acive_account = $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/create_and_active_account.php?ref_id=" . $this->sec_key;

//        --------------------------------------------------------

        $this->email_subject = "Account Creation and Activationt";
        $this->set_body();
    }

    public function set_heading($get_headding) {
        $this->email_subject = $get_headding;
    }

    private $email_subject;
    private $set_url_acive_account;

    private function set_body() {
        $this->html_data = "
     <h1>" . $this->email_subject . "</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                        <p>Hello,</p>
                        <p>
                       We reaching out to guide you through the process of creating and activating your user account. We're implementing upgrades to improve efficiency and streamline operations. Our IT team will ensure a smooth transition, and we're here to support you if you have any questions. Thank you for your cooperation.
                        </p>
                        <small><p>
                        If you did not request, please ignore this message.
                        </p></small>
                        
                    </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
                <td></td>
                <td>
                    <a href='" . $this->set_url_acive_account . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding' >
                       Active Your Account
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
        $email_sending_obj = new Email($this->email, $this->email_subject, $this->html_data);
        $state = $email_sending_obj->send_email();
        return $state;
    }
}
