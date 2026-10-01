<?php

class Self_Account_Approve_Process {

    private $cus_sup_id;
    private $cus_sup_lising_obj;
    private $compnay_data_variable_obj;

    public function __construct($get_cus_sup_id) {
        $this->cus_sup_id = $get_cus_sup_id;
        $this->cus_sup_lising_obj = new Cus_Sup_Details($this->cus_sup_id);
        $this->compnay_data_variable_obj = new Company_Info_Variable_List();
    }

    private function get_update_data() {
        $cus_sup_obj = new Cus_Sup_Update($this->cus_sup_id);
        $cus_sup_obj->approve_cus_sup();
        return $cus_sup_obj->process();
    }

    private $error_msg;

    public function get_error_msg() {
        return $this->error_msg;
    }

    private function set_error_msg($get_error_msg) {
        $this->error_msg = $get_error_msg;
    }

    private $stae_of_self_accunt = true;

    public function is_Self_Account_Customer_Create() {
        $this->stae_of_self_accunt = false;
        $cus_sup_update_obj = new Cus_Sup_Update($this->cus_sup_id);
        $cus_sup_update_obj->verify_credit_form();
        if ($cus_sup_update_obj->process()) {
            $this->set_error_msg($cus_sup_update_obj->get_error());
        }
    }

    public function process() {
        $state = false;
        if ($this->get_update_data()) {
            $state = true;
            if ($this->stae_of_self_accunt) {
                $this->update_cus_sup_by_email();
                $this->update_cus_sup_by_sms();
            } else {
                $this->disable_email_sms_credit_form();
                $this->update_cus_credit_by_sms();
                $this->update_cus_credit_by_email();
            }
        } else {
            $this->set_error_msg("something went wrong try again");
        }

        return $state;
    }

    private function update_cus_sup_by_sms() {
        $get_phone_no = $this->cus_sup_lising_obj->get_mobile_no();
        $get_message = "Hi " . $this->cus_sup_lising_obj->get_name() . ", Your profile has approved. Thank you";
        $sms_obj = new SMS_Sending($get_phone_no, $get_message);
        $sms_obj->send_message();
    }

    private function update_cus_credit_by_sms() {
        $get_phone_no = $this->cus_sup_lising_obj->get_mobile_no();
        $get_message = "Hi " . $this->cus_sup_lising_obj->get_name() . ", Credit application has been approved";
        $sms_obj = new SMS_Sending($get_phone_no, $get_message);
        $sms_obj->send_message();
    }

    private function update_cus_sup_by_email() {
        $email_address = $this->cus_sup_lising_obj->get_email();
        $subject = "Congratulations! Your Profile Has Been Successfully Approved";
        $html_data = "Dear " . $this->cus_sup_lising_obj->get_name() . ",<br>

        <p>I hope this email finds you well.</p>

        <p>We are thrilled to inform you that your profile has been successfully approved! We appreciate your interest and effort in joining our community. This approval signifies that you have met all the necessary criteria, and we believe you will be a valuable addition to our platform.</p>

        <p>With your approved profile,. We encourage you to explore these features and make the most out of your experience with us.</p>

        <p>Should you have any questions or need assistance, please do not hesitate to reach out to our support team. We are here to help you every step of the way.</p>

        <p>Once again, congratulations on your approved profile! We look forward to seeing you thrive within our community.</p>

        Best regards,<br>
        <br>
" . $this->compnay_data_variable_obj->get_compnay_name() . " Team        

";

        $email_obj = new Email($email_address, $subject, $html_data);
        $email_obj->send_email();
    }

    private function update_cus_credit_by_email() {
        $email_address = $this->cus_sup_lising_obj->get_email();
        $subject = "Credit Application Approved - Congratulations!";
        $html_data = "Dear " . $this->cus_sup_lising_obj->get_name() . ",<br>

    
        <p>We are pleased to inform you that your credit application has been approved! Congratulations!</p>

        <p>Your application has met our criteria, and we are excited to extend credit to you. This approval signifies our trust in your business and our commitment to supporting your financial needs.</p>

        <p>You are now eligible to enjoy the benefits of credit with us, making your transactions smoother and more convenient.</p>

        <p>If you have any questions about your approved credit application or need assistance with anything else, please feel free to contact us. We're here to help.</p>

        <p>Thank you for choosing " . $this->compnay_data_variable_obj->get_compnay_name() . ". We appreciate your business and look forward to a successful partnership.</p>

        <p>Best regards,
        <br>
" . $this->compnay_data_variable_obj->get_compnay_name() . " Team        

";

        $email_obj = new Email($email_address, $subject, $html_data);
        $email_obj->send_email();
    }

    private $url_after_process_sms;
    private $url_after_process_email;

    private function disable_email_sms() {
        $advance_sec_obj = new Advance_Security();
        $get_sec_id = $advance_sec_obj->get_data_encrypt("Cus_Sup_ID", $this->cus_sup_id);
        $this->url_after_process_sms = "View-List/Customer-Supplier/Verify/SelfAccount.php?type=sms";
        $this->url_after_process_email = "View-List/Customer-Supplier/Verify/SelfAccount.php?type=email";

        $data_base_obj = new DataBase();
        $get_sql_query = "update email_sms_link_manament set state_of_view='1' where id_of_value='" . $get_sec_id . "' and url_after_process in('" . $this->url_after_process_sms . "','" . $this->url_after_process_email . "')";
        $data_base_obj->get_result($get_sql_query);
    }

    private function disable_email_sms_credit_form() {
        $advance_sec_obj = new Advance_Security();
        $get_sec_id = $advance_sec_obj->get_data_encrypt("Cus_Sup_ID", $this->cus_sup_id);
        $this->url_after_process_sms = "View-List/Customer-Supplier/Verify/SetUp-Customer-Credit-Form.php?type=sms";
        $this->url_after_process_email = "View-List/Customer-Supplier/Verify/SetUp-Customer-Credit-Form.php?type=email";

        $data_base_obj = new DataBase();
        $get_sql_query = "update email_sms_link_manament set state_of_view='1' where id_of_value='" . $get_sec_id . "' and url_after_process in('" . $this->url_after_process_sms . "','" . $this->url_after_process_email . "')";
        $data_base_obj->get_result($get_sql_query);
        if ($data_base_obj->get_error_state_boolean()) {
            
        } else {
            $this->set_error_msg($data_base_obj->get_error());
        }
    }
}
