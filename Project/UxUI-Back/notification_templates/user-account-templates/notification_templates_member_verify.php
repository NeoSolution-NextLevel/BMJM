<?php
class notification_templates_member_verify
{

    private $form_url = "";
    public function __construct($get_sec_main_user_id)
    {
        $company_obj = new Company_Info_Variable_List();
        $this->form_url = $company_obj->get_app_URL() . "/UxUi/Verification-Process/User-Details.php?id=" . $get_sec_main_user_id;
    }


    public function sending_form_by_email($name)
    {
        $form_str = "
    <div style='font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 0;'>
        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0px 6px 15px rgba(0,0,0,0.1);'>
            
            <!-- Header -->
            <div style='text-align: center; margin-bottom: 25px;'>
                <h2 style='color: #2c3e50; margin: 0; font-size: 22px;'>Verify Your Email Address</h2>
            </div>

            <!-- Greeting -->
            <p style='font-size: 16px; color: #333333; line-height: 1.6;'>
                Hi <strong>" . $name . "</strong>, <br><br>
                Thank you for creating your member profile. To complete your registration, please verify your email address by clicking the button below.
            </p>

            <!-- Button -->
            <div style='text-align: center; margin: 30px 0;'>
                <a href='" . $this->form_url . "&type=email" . "' style='text-decoration: none;'>
                    <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;'>
                        Verify Email
                    </button>
                </a>
            </div>

            <!-- Extra info -->
            <p style='font-size: 14px; color: #555555; line-height: 1.6;'>
                If the button above doesn’t work, copy and paste this link into your browser:<br>
                <a href='" . $this->form_url . "&type=email" . "' style='color: #3498db; word-break: break-all;'>" . $this->form_url . "</a>
            </p>

            <p style='font-size: 14px; color: #999999; line-height: 1.6; margin-top: 20px; text-align: center;'>
                This email was sent automatically. If you didn’t sign up, please ignore this message.
            </p>
        </div>
    </div>
    ";

        return $form_str;
    }

    public function email_subject()
    {
        return "Registration Details of New User";
    }


    public function form_by_sms($name)
    {

        $sms = "Hi " . $name . ", verify your sms to complete registration: " . $this->form_url . "&type=sms";

        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
