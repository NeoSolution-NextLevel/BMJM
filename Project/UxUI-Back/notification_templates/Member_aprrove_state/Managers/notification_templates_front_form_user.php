<?php
class notification_templates_front_form_user
{

    private $form_url = "https://www.wbmjm.lk/Registration-form";

    public function sending_form_by_email()
    {
        $company_obj = new Company_Info_Variable_List();
        $form_url = $company_obj->get_app_URL() . "/Registration-form-mangment-approve.php";




        $form_str = "
        <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;'>


        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>


            <div style='text-align: center; margin-bottom: 20px;'>
                <h2 style='color: #4CAF50; margin: 0; font-size: 24px;'>Welcome to Our Membership</h2>
            </div>


            <div style='margin-top: 20px; text-align: left;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                    Dear member, <br><br>
                    We are thrilled to have you on our platform! Please take a moment to explore the amazing features we offer.
                    You can log in and start exploring right away.
                </p>

                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin-top: 15px;'>
                    Once your <b>Approval 1</b> and <b>Approval 2</b> processes are completed, you’ll be able to fully access your profile and enjoy all membership benefits.
                </p>

                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin-top: 15px;'>
                    If you have any questions, feel free to reach out to us at any time.
                </p>
            </div>

        </div>
    </div>
        ";

        return $form_str;
    }

    public function email_subject()
    {
        return "Welcome to new member";
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
