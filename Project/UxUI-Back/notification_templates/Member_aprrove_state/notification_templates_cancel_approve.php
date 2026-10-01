<?php
class notification_templates_cancel_approve
{

    private $form_url = "https://www.wbmjm.lk/Registration-form-mangment-approve.php";

    public function sending_form_by_email($name)
    {
        $company_obj = new Company_Info_Variable_List();
        $form_url = $company_obj->get_app_URL() . "/Registration-form-mangment-approve.php";

        $form_str = "   
         
         <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0;'>

        <div style='max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);'>

            <div style='text-align: center; margin-bottom: 20px;'>
                <h2 style='color: #f44336; margin: 0; font-size: 24px;'>Membership Status</h2>
            </div>

            <div style='margin-top: 20px; text-align: left;'>
                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin: 0;'>
                    Dear '.$name.', <br><br>
                    Unfortunately, you are <b style='color: #f44336;'>not eligible</b> for our membership at this time.
                    Please review your details and try again later.
                </p>

                <p style='font-size: 16px; color: #333333; line-height: 1.6; margin-top: 15px;'>
                    If you believe this is an error, feel free to contact our support team for further assistance.
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

        $sms = '' . $name . ' new form received  (' . $this->form_url . ')';
        return $sms;
    }

    public function form_by_url()
    {

        return $this->form_url;
    }
}
