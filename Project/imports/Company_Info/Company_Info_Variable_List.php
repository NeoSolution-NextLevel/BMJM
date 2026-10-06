<?php



class Company_Info_Variable_List
{ 

    //-----------------------------------------------------------------------------------------------------------
    private $company_logo_icon = "https://www.bmjm.lk/assets/images/common-images/logo.png";
    private $company_logo_url = "https://www.bmjm.lk/assets/images/common-images/logo.png";
    private $footer_txt = "BAMBALAPITIYA JUMMA MASJID | www.bmjm.lk | 0112263355 | info@bmjm.lk";
    private $company_name = "BAMBALAPITIYA JUMMA MASJID";
    private $company_web = "bmjm.lk";
    private $full_company_web = "http://localhost:3000/";
    private $default_sending_email = "info@bmjm.lk";
    private $system_problem_sending_email = "info@bmjm.lk";
    private $company_short_name = "BMJ MASJID";
    //-----------------------------------------------------------------------------------------------------------   
    private $company_whatup_number = "9477346601876";
    private $whatusp_url_to_revice_message = "";

    private $sms_app_id = "NFB3cWxrSGsvZ0RmaVVsaDNZMzZKZz09"; //neo soluiton
    private $company_data_id = "1";
    private $company_phone_no = "011226663355";
    private $company_finance_phone_no = "0789362885";
    private $company_phone_no_02 = "077789662822";
    private $compnay_notification_mobile_no = "0789362885";
    private $key_for_email_and_sms_encription = "";
    private $branch_id = "1";
    private $default_currency = "LKR";
    private $subscription_cron_run_month_date= "1";

    private $currency_type_country_name = "Sri Lanka";
    //    ---------------------------------------
    private $address_line_01 = "No.30 New Arrival Duty Free Complex(2nd floor),";
    private $address_line_02 = "Arrival Terminal";
    private $address_line_03 = "B.I.A Katunayake,";
    private $address_street = "";
    private $address_city = "";
    private $country_name = "Sri Lanka";

    private $payment_gateway_onepay_APP_ID = "QYML118A029A051BB1BAF";
    private $payment_gateway_onepay_App_Token = "0fb01d7cd9852c8be0bed02701f08c4ba2eb7162c36f3d294823c94de130649daba462536b20dfcd.A0WU118C0215D5198CAB3";
    private $payment_gateway_onepay_Hash_Salt = "3UEC118A029A051BB1BDD";

    private $is_onpay_active = 0;
    private $is_payhere_active = 1;

    private $merchant_id     = '223425';
    private $merchant_secret = 'MjkzNzEyNDc3MDM3NzU4NjE0MTQ5ODU1OTY5OTEzOTU4ODgyMjI4';

    private $payment_gateway_finance_email = "info@bmjm.lk";
    private $API_data_neosolution_lk = "";
    private $app_URL = "";
    private $finanace_admin_email_for_notification = "AAfinance@neosolution.lk";
    private $API_SEO_KEY = "AAd38ea6125fd05cc31ed7d05b5c1a05d0";
    private $Propety_NO = "";

    //for metro only 
    private $shop_hotline_no_01 = "+94 11 226 3355";
    private $shop_hotline_no_02 = "+94 77 340 1876";
    private $office_mobile_no_01 = "+94 11 243 5386";
    private $office_mobile_no_02 = "+94 11 247 1909";
    private $after_sales_service_mobile_no = "+94 77 789 2822";

    private $sales_email = " AAsales@metrodutyfree.lk";
    private $support_email = "AAsupport@metrodutyfree.lk";

    private $google_authentication_client_id = "";
    private $google_authentication_clent_secret_id = "d";

    private $microsoft_login_client_id = "";
    private $microsoft_login_client_secret_id = "";

    private $needed_contact_person_count =0;

    private $feature_donation_enabled = 0;
    
    private $feature_collection_payment_enabled = 0;

    #firebase
    private $firebase_project_id = "bmjm-197e1";
    private $fcmAllTopic = 'bmjm_all';
    private $fcmSubscriptionTopicPrefix = 'bmjm_sub_';

    public function get_microsoft_login_client_id()
    {
        return $this->microsoft_login_client_id;
    }
    public function get_firebase_project_id()
    {
        return $this->firebase_project_id;
    }
    public function get_fcm_all_topic()
    {
        return $this->fcmAllTopic;
    }
    public function get_fcm_subscription_topic_prefix()
    {
        return $this->fcmSubscriptionTopicPrefix;
    }




    public function get_microsoft_login_client_secret_id()
    {
        return $this->microsoft_login_client_secret_id;
    }

    public function get_google_authentication_client_id()
    {
        return $this->google_authentication_client_id;
    }


    public function get_google_authentication_clent_secret_id()
    {
        return $this->google_authentication_clent_secret_id;
    }
    //    it@shadowshine.com.lk  
    public function get_compnay_logo_icon_url()
    {
        return $this->company_logo_icon;
    }


    public function get_support_email()
    {
        return $this->support_email;
    }

    public function get_sales_email()
    {
        return $this->sales_email;
    }


    public function get_API_data_neosolution_lk()
    {
        return $this->API_data_neosolution_lk;
    }

    public function get_payment_gateway_one_pay_App_ID()
    {
        return $this->payment_gateway_onepay_APP_ID;
    }

    public function get_payment_gateway_one_pay_App_Token()
    {
        return $this->payment_gateway_onepay_App_Token;
    }

    public function get_payment_gateway_one_pay_Hash_Salt()
    {
        return $this->payment_gateway_onepay_Hash_Salt;
    }

    public function get_is_onpay_active()
    {
        return $this->is_onpay_active;
    }

    public function get_is_payhere_active()
    {
        return $this->is_payhere_active;
    }

    public function get_payment_gateway_finance_email()
    {
        return $this->payment_gateway_finance_email;
    }

    public function get_address_line_01()
    {
        return $this->address_line_01;
    }

    public function get_address_line_02()
    {
        return $this->address_line_02;
    }

    public function get_address_line_03()
    {
        return $this->address_line_03;
    }

    public function get_address_street()
    {
        return $this->address_street;
    }

    public function get_address_city()
    {
        return $this->address_city;
    }

    public function get_default_currency()
    {
        // echo 'crrency';
        return $this->default_currency;
    }

    public function get_currency_type_country_name()
    {
        return $this->currency_type_country_name;
    }

    public function get_default_country_name()
    {
        return $this->country_name;
    }

    public function get_compnay_logo_url()
    {
        return $this->company_logo_url;
    }

    public function get_compnay_footer_txt()
    {
        return $this->footer_txt;
    }

    public function get_compnay_name()
    {
        return $this->company_name;
    }

    public function get_compnay_short_name()
    {
        return $this->company_short_name;
    }

    public function get_compnay_web()
    {
        return $this->company_web;
    }

    public function get_compnay_full_web()
    {
        return $this->full_company_web;
    }

    public function get_compnay_default_sending_email()
    {

        return $this->default_sending_email;
    }

    public function get_system_infom_email()
    {
        return $this->system_problem_sending_email;
    }

    public function get_SMS_APP_id()
    {
        return $this->sms_app_id;
    }

    public function get_whatsup_number()
    {
        return $this->company_whatup_number;
    }

    public function get_whatsup_recive_message_url()
    {
        return $this->whatusp_url_to_revice_message;
    }

    public function get_compnay_id()
    {
        return $this->company_data_id;
    }

    public function get_compnay_phone()
    {
        return $this->company_phone_no;
    }

    public function get_compnay_phone_02()
    {
        return $this->company_phone_no;
    }

    public function get_sms_notifiction_mobile_no()
    {
        return $this->compnay_notification_mobile_no;
    }

    public function get_email_sms_encryption_key()
    {
        return $this->key_for_email_and_sms_encription;
    }

    public function get_branch_id()
    {
        return $this->branch_id;
    }

    public function get_subscription_cron_run_month_date()
    {
        return $this->subscription_cron_run_month_date;
    }

    public function get_system_problem_sending_email()
    {
        return $this->system_problem_sending_email;
    }

    public function get_default_sending_email()
    {
        return $this->default_sending_email;
    }

    public function get_finanace_admin_emial()
    {
        return $this->finanace_admin_email_for_notification;
    }

    public function infom_error_for_developer($get_error_msg)
    {
        date_default_timezone_set('Indian/Chagos');
        $date_and_time = date('m/d/Y h:i:s a', time());
        $email_obj = new Email("support@neosolution.lk", "Error Message " . $date_and_time, getcwd() . "  ----  " . $get_error_msg);
        $email_obj->send_email();
    }

    private $url_fb = "";
    private $url_instagram = "";
    private $url_tiktok = "";
    private $url_x = "";
    private $url_linkin = "";

    public function get_url_fb()
    {
        return $this->url_fb;
    }

    public function get_url_intragram()
    {
        return $this->url_instagram;
    }

    public function get_url_tiktok()
    {
        return $this->url_tiktok;
    }

    public function get_url_x()
    {
        return $this->url_x;
    }

    public function get_url_linkin()
    {
        return $this->url_linkin;
    }

    public function get_app_URL()
    {
        return $this->app_URL;
    }



    //for metro duty free only  
    public function get_shop_hotline_no_01()
    {
        return $this->shop_hotline_no_01;
    }

    public function get_shop_hotline_no_02()
    {
        return $this->shop_hotline_no_02;
    }

    public function get_office_mobile_no_01()
    {
        return $this->office_mobile_no_01;
    }

    public function get_office_mobile_no_02()
    {
        return $this->office_mobile_no_02;
    }

    public function get_after_sales_service_mobile_no()
    {
        return $this->after_sales_service_mobile_no;
    }
    public function get_API_SEO_KEY()
    {
        return $this->API_SEO_KEY;
    }
    public function get_Propety_NO()
    {
        return $this->Propety_NO;
    }

     public function get_needed_contact_person_count()
    {
        return $this->needed_contact_person_count;
    }

    public function get_company_finance_phone_no()
    {
        return $this->company_finance_phone_no;
    }

    public function get_merchant_id()
    {
        return $this->merchant_id;
    }
    public function get_merchant_secret()
    {
        return $this->merchant_secret;
    }

    public function is_feature_donation_enabled()
    {
        return $this->feature_donation_enabled;
    }

    public function is_feature_collection_payment_enabled()
    {
        return $this->feature_collection_payment_enabled;
    }
}
