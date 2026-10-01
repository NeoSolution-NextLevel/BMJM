<?php
class notification_templates_member_register
{
    private $form_url = "https://bmjm.lk/Create-Masjid-Membership.php";

    public function sending_form_by_email()
    {
        $company_obj = new Company_Info_Variable_List();
        $form_url = $company_obj->get_app_URL() . "/Registration-form-mangment-approve.php";




        $form_str = "   
            <!-- Welcome Text -->
            <div style='margin-top: 20px;'>
                <p style='font-size: 18px; color: #333333; line-height: 1.6; margin: 0 20px;'>
                    Dear member, <br>
                    Welcome to our platform! We are thrilled to have you here. Please take a moment to explore the features we offer.
                    You can log in and start exploring right away. <br><br>
                    If you have any questions, feel free to reach out to us.
                </p>
            </div>

            <!-- Button -->
            <div style='margin-top: 30px;'>
                <a href='" . $this->form_url . "' style='text-decoration: none;'>
                    <button style='background-color: #4CAF50; color: white; font-size: 16px; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease;'>
                        View More
                    </button>
                </a>
            </div>
        </div>
    </div>";


        return $form_str;
    }
    public function email_subject()
    {
        return "Registation From";
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
