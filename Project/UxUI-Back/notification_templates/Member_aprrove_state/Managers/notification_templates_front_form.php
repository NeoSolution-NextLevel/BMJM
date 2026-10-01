<?php
class notification_templates_front_form
{

    private $form_url = "https://www.wbmjm.lk/Registration-form";

    public function sending_form_by_email($name, $address, $contact_no, $email)
    {
        $company_obj = new Company_Info_Variable_List();
       



        $form_str = "   
         
        <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 20px;'>

            <!-- Main container -->
            <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 25px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

                <!-- Header -->
                <div style='text-align: center; margin-bottom: 25px;'>
                    <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>New Member Registration</h2>
                </div>

                <!-- Intro text -->
                <div style='margin-bottom: 20px;'>
                    <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                        Dear Admin, <br><br>
                        A new member has registered and their details are provided below.
                        Please review and complete the approval process.
                    </p>
                </div>

                <!-- User Details Table -->
                <div style='margin-bottom: 25px;'>
                    <table style='width: 100%; border-collapse: collapse; font-size: 16px; text-align: left;'>
                        <tr style='background-color: #f2f2f2;'>
                            <th style='padding: 10px; border: 1px solid #ddd;'>Name</th>
                            <td style='padding: 10px; border: 1px solid #ddd;'>" . $name . "</td>
                        </tr>
                        <tr>
                            <th style='padding: 10px; border: 1px solid #ddd;'>Address</th>
                            <td style='padding: 10px; border: 1px solid #ddd;'> " . $address . "</td>
                        </tr>
                        <tr style='background-color: #f2f2f2;'>
                            <th style='padding: 10px; border: 1px solid #ddd;'>Contact Number</th>
                            <td style='padding: 10px; border: 1px solid #ddd;'>" . $contact_no . "</td>
                        </tr>
                        <tr>
                            <th style='padding: 10px; border: 1px solid #ddd;'>Email</th>
                            <td style='padding: 10px; border: 1px solid #ddd;'>" . $email . "</td>
                        </tr>
                    </table>
                </div>

                <!-- Group info / notes -->
                <div style='margin-bottom: 25px;'>
                    <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 0 10px 0;'>
                        The new member can now join the group after approvals.
                    </p>
                    <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 0 10px 0;'>
                        Connect with other members <br />
                        Access group resources <br />
                        Enjoy membership benefits <br />
                    </p>
                </div>

                <!-- Approve Button -->
                <div style='text-align: center;'>
                    <a href=' ' style='text-decoration: none;'>
                        <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;'>
                            Approve Member
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
";



        return $form_str;
    }
    public function email_subject()
    {
        return "Registration Details of New User";
    }


    public function form_by_sms()
    {

        $sms = 'Your form url is hear (' . $this->form_url . ')';
        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
