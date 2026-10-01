<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Cus_Sup_Update_Advacne {

    private $cus_sup_id;
    private $company_obj;

    public function __construct($get_cus_sup_id) {
        $this->cus_sup_id = $get_cus_sup_id;
        $this->company_obj = new Company_Info_Variable_List();
    }

    private $state_personal = "0";
    private $state_bool_persoal = false;

    public function isPersonal() {
        $this->state_bool_persoal = true;
        $this->state_personal = "0";

        $this->state_business = "1";
        $this->state_bool_business = false;
    }

    private $state_business = "0";
    private $state_bool_business = false;

    public function isBusiness() {
        $this->state_bool_persoal = false;
        $this->state_personal = "0";

        $this->state_business = "1";
        $this->state_bool_business = true;
    }

    private $state_customer = "0";
    private $state_bool_customer = false;

    public function isCustomer() {
        $this->state_customer = "1";
        $this->state_bool_customer = true;

        $this->state_supplier = "0";
        $this->state_bool_supplier = false;

        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_list set cus_state='1'  where id='" . $this->cus_sup_id . "'";
        $data_base_obj->get_result($get_sql_query);
        $this->set_error_msg($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }
    public function isSelf_Cus_Credit(){
         $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_list set cus_self_credit_from='1',cus_credit_request='1'  where id='" . $this->cus_sup_id . "'";
        $data_base_obj->get_result($get_sql_query);
        $this->set_error_msg($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }

    private $state_supplier = "0";
    private $state_bool_supplier = false;

    public function isSupplier() {
        $this->state_customer = "0";
        $this->state_bool_customer = false;

        $this->state_supplier = "1";
        $this->state_bool_supplier = true;

        $data_base_obj = new DataBase();
        $get_sql_query = "update cus_sup_list set sup_state='1'  where id='" . $this->cus_sup_id . "'";
        $data_base_obj->get_result($get_sql_query);
        $this->set_error_msg($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }

    public function set_basic_data_presonal($get_name, $get_short_name, $get_email, $get_phone_no, $get_sms_notifiy_moible_no) {
        $get_sql_query = "";
        if ($this->state_bool_persoal) {
            $data_base_obj = new DataBase();
            $get_sql_query = "update cus_sup_list set name='" . $get_name . "',short_name='" . $get_short_name . "',email='" . $get_email . "',phone_no='" . $get_phone_no . "',moble_no_for_sms='" . $get_sms_notifiy_moible_no . "' where id='" . $this->cus_sup_id . "'";
            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            return $data_base_obj->get_error_state_boolean();
        } else {
            $this->set_error_msg("something went wrong try again 83" . $this->state_bool_persoal);
            return false;
        }
    }

    public function set_basic_data_business($get_name, $get_short_name, $get_email, $get_phone_no, $get_sms_notifiy_moible_no, $get_log_url) {

        if ($this->state_bool_business) {
            $data_base_obj = new DataBase();
            $get_sql_query = "update cus_sup_list set name='" . $get_name . "',short_name='" . $get_short_name . "',email='" . $get_email . "',phone_no='" . $get_phone_no . "',moble_no_for_sms='" . $get_sms_notifiy_moible_no . "',logo='" . $get_log_url . "' where id='" . $this->cus_sup_id . "'";
            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            return $data_base_obj->get_error_state_boolean();
        } else {
            $this->set_error_msg("something went wrong try again line 97");
            return false;
        }
    }

    public function set_secondary_data_for_customer($credit_state, $credit_limit, $opening_bal, $pd_chqe_amount, $credit_period) {
        if ($this->state_bool_customer) {
            $data_base_obj = new DataBase();
            $get_sql_query = "update cus_sup_list set cus_credit_limit='" . $credit_limit . "',cus_credit_state='" . $credit_state . "',"
                    . "cus_opening_bal='" . $opening_bal . "',cus_PD_chque='" . $pd_chqe_amount . "',cus_credit_period='" . $credit_period . "' where id='" . $this->cus_sup_id . "'";
            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            return $data_base_obj->get_error_state_boolean();
        } else {
            $this->set_error_msg("something went wrong try again line 102");
            return false;
        }
    }

//INSERT INTO `cus_sup_list`(`id`, `name`, `short_name`, `email`, `phone_no`, `moble_no_for_sms`, `ast`, `sdt`, `sup_credit_limit`, 
//`cus_credit_limit`, `cus_state`, `sup_state`, `cus_credit_state`, `sup_credit_state`, `sup_opening_bal`, `cus_opening_bal`, 
//`cus_PD_chque`, `sup_PD_chque`, `self_account`, `active`, `email_sent_form`, `personal_account`, `coperate_account`, `company_id`, 
//`cheque_amount_cus`, `cheque_amount_sup`, `logo`, `approve_state`, `cus_credit_period`, `sup_cridet_period`, `cus_credit_request`, 
//`self_ac_submition_state`, `main_user_login_id`, `sms_sent_form`, `verify_sms`, `verify_email`, `default_customer_bock`)
    public function set_secondary_data_for_supplier($credit_state, $credit_limit, $opening_bal, $credit_period) {
        if ($this->state_bool_supplier) {
            $data_base_obj = new DataBase();
            $get_sql_query = "update cus_sup_list set sup_credit_limit='" . $credit_limit . "',sup_credit_state='" . $credit_state . "',"
                    . "sup_opening_bal='" . $opening_bal . "',sup_PD_chque='0',sup_cridet_period='" . $credit_period . "' where id='" . $this->cus_sup_id . "'";
            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            return $data_base_obj->get_error_state_boolean();
        } else {
            $this->set_error_msg("something went wrong try again line 121");
            return false;
        }
    }

    public function variable_answering($get_variable_id, $get_variable_answer) {
        $get_state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select id from cus_sup_variable_answers where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $this->cus_sup_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $data_base_obj = new DataBase();
                $get_sql_query = "update cus_sup_variable_answers set variable_answer='" . $get_variable_answer . "' where id='" . $row['id'] . "'";
                $data_base_obj->get_result($get_sql_query);
                $get_state = $data_base_obj->get_error_state_boolean();
                $this->set_error_msg($data_base_obj->get_error());
            }
        } else {
            $data_base_obj = new DataBase();
            $get_sql_query = "INSERT INTO cus_sup_variable_answers"
                    . "(variable_answer,ast,sdt,cus_sup_variable_list_id,cus_sup_list_id,company_id) VALUES "
                    . "('" . $get_variable_answer . "','1',now(),'" . $get_variable_id . "','" . $this->cus_sup_id . "','" . $this->company_obj->get_compnay_id() . "')";
            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            $get_sate = $data_base_obj->get_error_state_boolean();
        }
        return $get_state;
    }

    public function variable_answering_image($get_variable_id, $get_variable_image_pth_answer) {
        $get_state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select id from cus_sup_variable_answers_big_text where cus_sup_variable_list_id='" . $get_variable_id . "' and cus_sup_list_id='" . $this->cus_sup_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $data_base_obj = new DataBase();
                $get_sql_query = "update cus_sup_variable_answers_big_text set variable_answer='" . $get_variable_image_pth_answer . "' where id='" . $row['id'] . "'";
                $data_base_obj->get_result($get_sql_query);
                $get_state = $data_base_obj->get_error_state_boolean();
                $this->set_error_msg($data_base_obj->get_error());
            }
        } else {
            $data_base_obj = new DataBase();
            $get_sql_query = "INSERT INTO cus_sup_variable_answers_big_text"
                    . "(variable_answer,ast,sdt,cus_sup_variable_list_id,cus_sup_list_id,company_id) VALUES "
                    . "('" . $get_variable_image_pth_answer . "','1',now(),'" . $get_variable_id . "','" . $this->cus_sup_id . "','" . $this->company_obj->get_compnay_id() . "')";

            $data_base_obj->get_result($get_sql_query);
            $this->set_error_msg($data_base_obj->get_error());
            $get_state = $data_base_obj->get_error_state_boolean();
        }
        return $get_state;
    }

    private $error_message;

    private function set_error_msg($get_error_msg) {
        $this->error_message = $get_error_msg;
    }

    public function get_error() {
        return $this->error_message;
    }
}
