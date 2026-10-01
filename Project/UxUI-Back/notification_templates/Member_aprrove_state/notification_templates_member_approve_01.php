<?php
class notification_templates_member_approve_01
{

    private $form_url = "https://www.wbmjm.lk/UxUi/Registration-form-mangment-approve.php";
    public function __construct($get_sec_id)
    {
        $company_obj = new Company_Info_Variable_List();
        $this->form_url = $company_obj->get_app_URL() . "/UxUi/Registration-form-mangment-approve.php?id=" . $get_sec_id;
    }



    public function sending_form_by_email($name, $address, $contact_no)
    {

        $form_str = "   
         
       <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;'>

    <!-- Main container -->
    <div style='max-width: 650px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

        <!-- Header -->
        <div style='text-align: center; margin-bottom: 25px;'>
            <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>Approval Stage 2 Request</h2>
        </div>

        <!-- Intro Text -->
        <div style='margin-top: 20px;'>
            <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 15px;'>
                Dear Admin, <br><br>
                A member has completed <strong>Stage 1</strong> and is now waiting for <strong>Approval Stage 2</strong>.
                Please review the member’s details below and complete the Stage 2 approval process.
            </p>
        </div>

        <!-- User Details Table -->
        <div style='margin: 25px 0;'>
            <table style='width: 100%; border-collapse: collapse; font-size: 16px;'>
                <tr style='background-color: #f2f2f2;'>
                    <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Name</th>
                    <td style='padding: 12px; border: 1px solid #ddd;'> " . $name . "</td>
                </tr>
                <tr>
                    <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Contact Number</th>
                    <td style='padding: 12px; border: 1px solid #ddd;'> " . $contact_no . "</td>
                </tr>
                <tr>
                    <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Address</th>
                    <td style='padding: 12px; border: 1px solid #ddd;'>" . $address . "</td>
                </tr>
            </table>
        </div>

        <!-- Notes -->
        <div style='margin-bottom: 25px;'>
            <p style='font-size: 15px; color: #555555; line-height: 1.6; margin: 0 15px;'>
                Please review the details carefully before approving Stage 2.
                Once approved, the member will proceed to the <strong>next stage of registration</strong>.
            </p>
        </div>

        <!-- Approve Button -->
        <div style='text-align: center; margin-top: 30px;'>
            <a href='" . $this->form_url . "' style='text-decoration: none;'>
                <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;'>
                    Approve Stage 2
                </button>
            </a>
        </div>

    </div>
</div>

";



        return $form_str;
    }
    public function email_subject()
    {
        return "Member approve 01 request";
    }


    public function form_by_sms($name)
    {

        $sms =  $name . " new form received  (" . $this->form_url . ")";
        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
