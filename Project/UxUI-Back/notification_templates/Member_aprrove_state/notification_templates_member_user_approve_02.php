<?php
class notification_templates_member_user_approve_02
{

    private $form_url = "";
    public function __construct($get_member_encript_id)
    {
        $company_obj = new Company_Info_Variable_List();
        $this->form_url = $company_obj->get_app_URL() . "/UxUi/User-Account-Create.php/?id=" . $get_member_encript_id;
    }

    public function sending_form_by_email($name)
    {
        $this->form_url = $this->form_url . "##type=email";


        $form_str = "   
       <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;'>

        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

            <!-- Header -->
            <div style='text-align: center; margin-bottom: 20px;'>
                <h2 style='color: #4CAF50; margin: 0; font-size: 24px;'> Welcome to Our Community!</h2>
            </div>

            <!-- Message -->
            <div style='margin-top: 20px; text-align: left;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                    Dear <b>" . $name . " </b>, <br><br>
                    Congratulations! Your <b>Approval Stage 1</b> and <b>Approval Stage 2</b> are now <span style='color: green; font-weight: bold;'>completed</span>.
                    You are officially a part of our community! 
                </p>

                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin-top: 15px;'>
                    You can now create your account and access your member profile to enjoy all membership benefits.
                </p>

                <!-- Action Button -->
                <div style='text-align: center; margin: 30px 0;'>
                    <a href='" . $this->form_url . "' style='text-decoration: none;'>
                        <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s ease;'>
                            Create Your Account
                        </button>
                    </a>
                </div>

                <!-- Closing Note -->
                <p style='font-size: 15px; color: #555555; line-height: 1.6; margin-top: 10px;'>
                    If you face any issues, feel free to contact our support team.
                    We are here to help you anytime!
                </p>
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
        $this->form_url = $this->form_url . "&type=sms";
        // echo $this->form_url;
        $sms = "Congratulations " . $name . "! Your membership has been fully approved. Please create your member profile using this link: " . $this->form_url;

        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
