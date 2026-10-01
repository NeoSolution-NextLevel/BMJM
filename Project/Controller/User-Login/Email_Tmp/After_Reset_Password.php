<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class After_Reset_Password {

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
        $this->set_url_Change_Your_Password_and_Log_Out_of_All_Devices = "https://" . $this->company_data_obj->get_app_URL() . "/View-List/User-Login/Processing-Email/change_your_password_unlock_account.php?ref_id=" . $this->sec_key;

//        --------------------------------------------------------



        $this->set_body();
    }

    private $set_url_Change_Your_Password_and_Log_Out_of_All_Devices;

    private function set_body() {
        $this->html_data = "
     <h1> Your Password Has Been Changed</h1>

        <table class='w3-table'>
            <tr class='w3-margin-top'>
                <td style='width: 5%;'></td>
                <td style='width: 90%;'>
                    <div class='w3-justify'>

                        <p>Hello,</p>
                        <p>
                        We're reaching out to inform you that a recent security update has been made to your account. Your password has been successfully changed.
                        </p>
                        <br>
                        <p>                        
                        If you did not authorize this change, or if you suspect any unauthorized access to your account, please click on the button below labeled <b>It's Not Me - Need to Change the Password & Logout All Devices</b> This will immediately guide you through the process to reset your password and log out from all devices:
                        </p>
                        
  
                    </div>
                </td>
                <td style='width: 5%;'></td>
            </tr>
            <tr class='w3-margin-top'>
               <td></td>
                <td>
                    <a href='" . $this->set_url_Change_Your_Password_and_Log_Out_of_All_Devices . "' class='w3-button w3-black w3-round w3-block w3-strong w3-padding ' >
                       <b>It's Not Me Need To Change The Password & Logout All Device</b>
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
        $email_sending_obj = new Email($this->email, "  Password Update Notification", $this->html_data);
        $state=$email_sending_obj->send_email();

        return $state;
    }
}
