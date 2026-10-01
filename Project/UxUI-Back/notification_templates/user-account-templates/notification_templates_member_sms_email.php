<?php
class notification_templates_member_sms_email
{

    private $form_url = "https://www.wbmjm.lk/Registration-form";

    public function sending_form_by_email($name, $email, $contact_no)
    {
        $company_obj = new Company_Info_Variable_List();
        $home_url = $company_obj->get_app_URL() . "/index.php";

        $form_str = "
    <div style='font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px;'>
        <!-- Main container -->
        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 10px; padding: 25px; box-shadow: 0px 6px 15px rgba(0,0,0,0.1);'>
            
            <!-- Header -->
            <div style='text-align: center; margin-bottom: 25px;'>
                <h2 style='color: #2c3e50; margin: 0; font-size: 24px;'> Welcome to Our Community </h2>
            </div>
            
            <!-- Greeting -->
            <div style='margin-bottom: 20px;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                    Dear <strong>" . $name . "</strong>,<br><br>
                    Thank you for creating your member profile with us. We are excited to have you onboard and look forward to your participation in our community.
                </p>
            </div>
            
            <!-- Member Details -->
            <div style='margin-bottom: 25px;'>
                <table style='width: 100%; border-collapse: collapse; font-size: 16px; text-align: left;'>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Name</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'>" . $name . "</td>
                    </tr>
                    <tr>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Email</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'>" . $email . "</td>
                    </tr>
                    <tr style='background-color: #f2f2f2;'>
                        <th style='padding: 10px; border: 1px solid #ddd;'>Phone Number</th>
                        <td style='padding: 10px; border: 1px solid #ddd;'>" . $contact_no . "</td>
                    </tr>
                </table>
            </div>
            
            <!-- Info -->
            <div style='margin-bottom: 25px;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0 0 10px 0;'>
                    As a member, you will be able to:
                </p>
                <ul style='font-size: 16px; color: #333333; line-height: 1.6; padding-left: 20px; margin: 0;'>
                    <li>Connect with other members</li>
                    <li>Access group resources</li>
                    <li>Enjoy exclusive membership benefits</li>
                </ul>
            </div>
            
            <!-- Button -->
            <div style='text-align: center;'>
                <a href='" . $home_url . "' style='text-decoration: none;'>
                    <button style='background-color: #3498db; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;'>
                        Go to Dashboard
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
        return "Welcome to Our Community - Your Member Profile is Created!";
    }


    public function form_by_sms($name, $email, $contact_no)
    {
        // echo ($name +  $email +  $contact_no);

        $sms = "Hi " . $name . ", your member profile is created! Email: " . $email . " | Phone: " . $contact_no . " Welcome our community";

        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
