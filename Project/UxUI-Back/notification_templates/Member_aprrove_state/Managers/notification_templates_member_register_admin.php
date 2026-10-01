<?php
class notification_templates_member_register_admin
{

    private $form_url = "https://www.wbmjm.lk/Registration-form-mangment-approve.php";

    public function sending_form_by_email($name, $address, $contact_no, $email)
    {
        $company_obj = new Company_Info_Variable_List();
        $form_url = $company_obj->get_app_URL() . "/Registration-form-mangment-approve.php";




        $form_str = "   
         
        <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;'>

        <!-- Main container -->
        <div style='max-width: 650px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

            <!-- Header -->
            <div style='text-align: center; margin-bottom: 25px;'>
                <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>Approval Stage 1 Request</h2>
            </div>

            <!-- Welcome / Intro Text -->
            <div style='margin-top: 20px;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 15px;'>
                    Dear Admin, <br><br>
                    A new member has registered and is waiting for <strong>Approval Stage 1</strong>.
                    Please review the member’s details below and complete the approval step.
                </p>
            </div>

            <!-- User Details Table -->
            <div style='margin: 25px 0;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 16px;'>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>" . $name . "</th>
                        <td style='padding: 12px; border: 1px solid #ddd;'>name</td>
                    </tr>
                    <tr>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Contact Number</th>
                        <td style='padding: 12px; border: 1px solid #ddd;'>" . $contact_no . "</td>
                    </tr>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Email</th>
                        <td style='padding: 12px; border: 1px solid #ddd;'> " . $email . " </td>
                    </tr>
                    <tr>
                        <th style='padding: 12px; border: 1px solid #ddd; text-align: left;'>Address</th>
                        <td style='padding: 12px; border: 1px solid #ddd;'> " . $address . " </td>
                    </tr>
                </table>
            </div>

            <!-- Notes -->
            <div style='margin-bottom: 25px;'>
                <p style='font-size: 15px; color: #555555; line-height: 1.6; margin: 0 15px;'>
                    Please ensure the details are correct before approving.
                    Once approved, the member will proceed to the <strong>next approval stage</strong>.
                </p>
            </div>

            <!-- Approve Button -->
            <div style='text-align: center; margin-top: 30px;'>
                <a href='' style='text-decoration: none;'>
                    <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;'>
                        Approve Stage 1
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
        return "Registration steps for new user";
    }


    public function form_by_sms($name)
    {

        $sms = '' . $name . ' new form received  (' . $this->form_url . ')';
        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
