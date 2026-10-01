<?php

class Cus_Sup_Create {

    private $user_id;
    private $state_presonal_account = "0";
    private $state_cooperate_business_account = "0";
    private $logo_url;
    private $state_customer = "0";
    private $state_supplier = "0";
    private $state_cridet_supplier = "0";
    private $state_cridet_customer = "0";
    private $company_obj;

    public function __construct($get_user_id) {
        $this->user_id = $get_user_id;
        $this->company_obj = new Company_Info_Variable_List();
        $this->state_of_self_account_process = true;
    }

    public function customer_profile() {
        $this->state_customer = "1";
        $this->state_supplier = "0";
    }

    public function supplier_profile() {
        $this->state_customer = "0";
        $this->state_supplier = "1";
    }

    public function personal_profile() {
        $this->state_presonal_account = "1";
        $this->state_cooperate_business_account = "0";
    }

    public function cooperate_business_profile($get_logo_url) {
        $this->state_cooperate_business_account = "1";
        $this->state_presonal_account = "0";
        $this->logo_url = $get_logo_url;
    }

    private $name;
    private $short_name;
    private $email;
    private $contact_no;
    private $mobile_no;
    private $supplier_opeing_balance="0";
    private $customer_opeing_balance="0";

    public function set_main_info($get_name, $get_short_name, $get_email, $get_conctact_no, $get_sms_notification_mobile_no, $get_opeing_balance) {
        $this->name = $get_name;
        $this->short_name = $get_short_name;
        $this->email = $get_email;
        $this->contact_no = $get_conctact_no;
        $this->mobile_no = $get_sms_notification_mobile_no;
//        $this->opeing_balance = $get_opeing_balance;
        if ($this->state_supplier == "1") {
            $this->supplier_opeing_balance = $get_opeing_balance;
        }
        if ($this->state_customer == "1") {
            $this->customer_opeing_balance = $get_opeing_balance;
        }
    }

    private $get_sup_credit_limit="0";
    private $get_sup_credit_priod_from_days="0";
    private $get_cus_credit_limit="0";
    private $get_cus_credit_priod_from_days="0";
    private $get_cus_pd_cheque_amount="0";

    public function set_supplier_credit_info_set($get_credit_limit, $get_credit_priod_from_days) {
        $this->state_cridet_supplier = "1";
        $this->get_sup_credit_limit = $get_credit_limit;
        $this->get_sup_credit_priod_from_days = $get_credit_priod_from_days;
    }

    public function set_customer_credit_info_set($get_credit_limit, $approve_PD_cheque_amount, $get_credit_priod_from_days) {
        $this->state_cridet_customer = "1";
        $this->get_cus_credit_limit = $get_credit_limit;
        $this->get_cus_credit_priod_from_days = $get_credit_priod_from_days;
        $this->get_cus_pd_cheque_amount = $approve_PD_cheque_amount;
    }

    private $state_of_self_account = "0";
    private $account_approve_state = "1";
    private $state_sending_form_email = "0";
    private $state_sending_form_sms = "0";
    private $state_active = "1";
    private $state_of_self_account_process = true;

    public function self_account_sending_form_email() {
        $this->state_of_self_account = "1";
        $this->account_approve_state = "0";
        $this->state_sending_form_email = "1";
        $this->state_sending_form_sms = "0";
        $this->state_active = "0";
        $this->state_of_self_account_process = false;
    }

    public function self_account_sending_form_sms() {
        $this->state_of_self_account = "1";
        $this->account_approve_state = "0";
        $this->state_sending_form_email = "0";
        $this->state_sending_form_sms = "1";
        $this->state_active = "0";
        $this->state_of_self_account_process = false;
    }

    private $get_cus_sup_id;
    private $sec_get_cus_sup_id;
    private $get_error;
    private $sec_key = "Cus_Sup_ID";

    public function get_cus_sup_id() {
        return $this->get_cus_sup_id;
    }

    public function get_error() {
        return $this->get_error;
    }

    private function get_check_email() {
        $state = false;
        $data_base_obj = new DataBase();
        $sql_query = "select * from cus_sup_list where ast='1' and email='" . $this->email . "'";
        $result = $data_base_obj->get_result($sql_query);
        if ($result->num_rows > 0) {
            $state = false;
            $this->get_error = "Email address already exists, please try a different one.";
        } else {
            $state = true;
        }
        return $state;
    }

    private function get_check_mobile() {
        $state = false;
        $data_base_obj = new DataBase();
        $sql_query = "select * from cus_sup_list where ast='1' and moble_no_for_sms='" . $this->mobile_no . "'";
        $result = $data_base_obj->get_result($sql_query);
        if ($result->num_rows > 0) {
            $state = false;
            $this->get_error = "Mobile number already exists, please try a different one.";
        } else {
            $state = true;
        }
        return $state;
    }

    private function get_check_cus_sup_name() {
        $state = false;
        $data_base_obj = new DataBase();
        $sql_query = "select * from cus_sup_list where ast='1' and name='" . $this->name . "'";
        $result = $data_base_obj->get_result($sql_query);
        if ($result->num_rows > 0) {
            $state = false;
            $this->get_error = "Customer name already exists, please try a different one.";
        } else {
            $state = true;
        }
        return $state;
    }

    public function process_data() {
        $state = false;
        if ($this->get_check_email()) {
            if ($this->get_check_mobile()) {
                if ($this->get_check_cus_sup_name()) {
                    $state = $this->add_new_cus_sup();
                } else {
                    $state = false;
                }
            } else {
                $state = false;
            }
        } else {
            $state = false;
        }
        return $state;
    }

    private function add_new_cus_sup() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "INSERT INTO cus_sup_list
            (name,short_name,email,phone_no,moble_no_for_sms,ast,sdt,sup_credit_limit,cus_credit_limit,cus_state,sup_state,cus_credit_state,sup_credit_state,sup_opening_bal,cus_opening_bal,cus_PD_chque,sup_PD_chque,self_account,active,email_sent_form,personal_account, coperate_account, company_id, cheque_amount_cus, cheque_amount_sup, logo, approve_state, cus_credit_period, sup_cridet_period, cus_credit_request, self_ac_submition_state,main_user_login_id,sms_sent_form,verify_sms,verify_email,default_customer_bock,cus_self_credit_from) VALUES 
            ('" . $this->name . "','" . $this->short_name . "','" . $this->email . "','" . $this->contact_no . "','" . $this->mobile_no . "','1',now(),'" . $this->get_sup_credit_limit . "','" . $this->get_cus_credit_limit . "','" . $this->state_customer . "','" . $this->state_supplier . "','" . $this->state_cridet_customer . "','" . $this->state_cridet_supplier . "','" . $this->supplier_opeing_balance . "','" . $this->customer_opeing_balance . "','" . $this->get_cus_pd_cheque_amount . "','0','" . $this->state_of_self_account . "','" . $this->state_active . "','" . $this->state_sending_form_email . "','" . $this->state_presonal_account . "', '" . $this->state_cooperate_business_account . "', '" . $this->company_obj->get_compnay_id() . "', '0', '0', '" . $this->logo_url . "', '" . $this->account_approve_state . "','" . $this->get_cus_credit_priod_from_days . "','" . $this->get_sup_credit_priod_from_days . "','0', '0','" . $this->user_id . "','" . $this->state_sending_form_sms . "','0','0','0','0') ";
        $data_base_obj->get_result($get_sql_query);
        $this->get_cus_sup_id = $data_base_obj->get_id();

        $sec_obj = new Advance_Security();
        $this->sec_get_cus_sup_id = $sec_obj->get_data_encrypt($this->sec_key, $this->get_cus_sup_id);

        if ($data_base_obj->get_error_state_boolean()) {
            $state = true;
        } else {
            $state = false;
            $this->get_error = $data_base_obj->get_error();
        }
        return $state;
    }

    public function variable_answering($get_variable_id, $get_variable_answer) {
        $get_state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select id from cus_sup_variable_answers where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $this->get_cus_sup_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $data_base_obj = new DataBase();
                $get_sql_query = "update cus_sup_variable_answers set variable_answer='" . $get_variable_answer . "' where id='" . $row['id'] . "'";
                $data_base_obj->get_result($get_sql_query);
                $get_state = $data_base_obj->get_error_state_boolean();
                $this->get_error = $data_base_obj->get_error();
            }
        } else {
            $data_base_obj = new DataBase();
            $get_sql_query = "INSERT INTO cus_sup_variable_answers"
                    . "(variable_answer,ast,sdt,cus_sup_variable_list_id,cus_sup_list_id,company_id) VALUES "
                    . "('" . $get_variable_answer . "','1',now(),'" . $get_variable_id . "','" . $this->get_cus_sup_id . "','" . $this->company_obj->get_compnay_id() . "')";
            if ($this->state_of_self_account_process) {
                $data_base_obj->get_result($get_sql_query);
            }
            $this->get_error = $data_base_obj->get_error();
            $get_sate = $data_base_obj->get_error_state_boolean();
        }
        return $get_state;
    }

    public function variable_answering_image($get_variable_id, $get_variable_image_pth_answer) {
        $get_state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select id from cus_sup_variable_answers_big_text where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $this->get_cus_sup_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $data_base_obj = new DataBase();
                $get_sql_query = "update cus_sup_variable_answers_big_text set variable_answer='" . $get_variable_answer . "' where id='" . $row['id'] . "'";
                $data_base_obj->get_result($get_sql_query);
                $get_state = $data_base_obj->get_error_state_boolean();
                $this->get_error = $data_base_obj->get_error();
            }
        } else {
            $data_base_obj = new DataBase();
            $get_sql_query = "INSERT INTO cus_sup_variable_answers_big_text"
                    . "(variable_answer,ast,sdt,cus_sup_variable_list_id,cus_sup_list_id,company_id) VALUES "
                    . "('" . $get_variable_image_pth_answer . "','1',now(),'" . $get_variable_id . "','" . $this->get_cus_sup_id . "','" . $this->company_obj->get_compnay_id() . "')";
            if ($this->state_of_self_account_process) {
                $data_base_obj->get_result($get_sql_query);
            }
            $this->get_error = $data_base_obj->get_error();
            $get_state = $data_base_obj->get_error_state_boolean();
        }
        return $get_state;
    }

    private function process_to_accounts_department() {
        
    }

    public function get_verify_account() {
        if ($this->state_of_self_account_process) {
            $this->verifiy_sms();
            $this->verify_email();
        }
    }

    private function verify_email() {
        $get_html_data_body = "Dear " . $this->name . ",<br>

                Thank you for registering with " . $this->company_obj->get_compnay_name() . "

                To complete your registration and access all the features of our platform, please verify your email address by clicking on the button below

                By verifying your email, you will also ensure the security of your account and receive important notifications regarding your purchases and account activities.

                If you did not register for an account with " . $this->company_obj->get_compnay_name() . ", please disregard this email.<br>

                Thank you,<br>
                " . $this->company_obj->get_compnay_name() . " Team<br>
                ";

        $url_after_process = "View-List/Customer-Supplier/Verify/index.php?type=email";
        $sending_varify_email = new Email_SMS_Create($this->user_id);
        $sending_varify_email->one_type_process();
        $sending_varify_email->process_to_email();
        $sending_varify_email->set_data($this->sec_key, $url_after_process, $this->sec_get_cus_sup_id);
        $sending_varify_email->by_email($this->email, "Please Verify Your Email Address - Complete Your Registration", $get_html_data_body, "Verify Your Email");
        $sending_varify_email->process();
    }

    private function verifiy_sms() {
        $get_message_body = " Please verify your Mobile Number by clicking on the link below.";
        $url_after_process = "View-List/Customer-Supplier/Verify/index.php?type=sms";
        $sending_varify_sms = new Email_SMS_Create($this->user_id);
        $sending_varify_sms->one_type_process();
        $sending_varify_sms->process_to_sms();
        $sending_varify_sms->set_data($this->sec_key, $url_after_process, $this->sec_get_cus_sup_id);
        $sending_varify_sms->by_SMS($this->mobile_no, $this->short_name, $get_message_body);
        $sending_varify_sms->process();
    }

    public function process_email_form() {

        $get_html_data_body = "Dear " . $this->name . ",<br>
            I hope this email finds you well.

            I am reaching out to inform you that we have created a new customer profile for . $this->name . To ensure our records are up-to-date and to better serve you, we kindly request you to fill out the form using the following link: [Insert Link Here]

            Your cooperation in this matter is greatly appreciated. If you have any questions or need assistance with the form, please don't hesitate to contact us.

            Thank you for your attention to this matter.

            <br>Warm regards,<br>
                " . $this->company_obj->get_compnay_name() . " Team<br>
                ";

        $url_after_process = "View-List/Customer-Supplier/Verify/SelfAccount.php?type=email";
        $sending_varify_email = new Email_SMS_Create($this->user_id);
        $sending_varify_email->multiple_type_process();
        $sending_varify_email->process_to_email();
        $sending_varify_email->set_data($this->sec_key, $url_after_process, $this->sec_get_cus_sup_id);
        $sending_varify_email->by_email($this->email, "Action Required - Complete Form for Updated Profile Information", $get_html_data_body, "View Form");
        $sending_varify_email->process();
    }

    public function process_sms_form() {
        $get_message_body = "Please complete the form using the provided link. Thank you!";
        $url_after_process = "View-List/Customer-Supplier/Verify/SelfAccount.php?type=sms";
        $sending_varify_sms = new Email_SMS_Create($this->user_id);
        $sending_varify_sms->multiple_type_process();
        $sending_varify_sms->process_to_sms();
        $sending_varify_sms->set_data($this->sec_key, $url_after_process, $this->sec_get_cus_sup_id);
        $sending_varify_sms->by_SMS($this->mobile_no, $this->short_name, $get_message_body);
        $sending_varify_sms->process();
    }
}
