<?php
class Cus_Sup_List_SIGNLE_DATA
{
    // `cus_sup_list`(`id`, `name`, `short_name`, `email`, `phone_no`, `moble_no_for_sms`, `ast`, `sdt`, `sup_credit_limit`, 
    // `cus_credit_limit`, `cus_state`, `sup_state`, `cus_credit_state`, `sup_credit_state`, `sup_opening_bal`, `cus_opening_bal`, `cus_PD_chque`, 
    // `sup_PD_chque`, `self_account`, `active`, `email_sent_form`, `personal_account`, `coperate_account`, `company_id`, `cheque_amount_cus`, `cheque_amount_sup`,
    //  `logo`, `approve_state`, `cus_credit_period`, `sup_cridet_period`,
    //  `cus_credit_request`, `self_ac_submition_state`, `main_user_login_id`, `sms_sent_form`, `verify_sms`, `verify_email`, `default_customer_bock`, `cus_self_credit_from`)
    private $id;
    private $compnany_obj;
    private $name;
    private $short_name;
    private $email;
    private $phone_no;
    private $moble_no_for_sms;
    private $ast;
    private $sdt;
    private $sup_credit_limit;
    private $cus_credit_limit;
    private $cus_state;
    private $sup_state;
    private $cus_credit_state;
    private $sup_credit_state;
    private $sup_opening_bal;
    private $cus_opening_bal;
    private $cheque_amount_cus;
    private $cheque_amount_sup;
    private $self_account;
    private $active;
    private $email_sent_form;
    private $personal_account;
    private $coperate_account;
    private $company_id;
    private $logo;
    private $approve_state;
    private $cus_credit_period;
    private $sup_cridet_period;
    private $cus_credit_request;
    private $self_ac_submition_state;
    private $main_user_login_id;
    private $sms_sent_form;
    private $cus_PD_chque;
    private $sup_PD_chque;
    private $verify_sms;
    private $verify_email;

    private $cus_self_credit_from;
    private $error_message;

    private $bool_state = false;

    public function __construct($get_id)
    {
        $this->id = $get_id;
        $this->compnany_obj = new Company_Info_Variable_List();
        $this->company_id = $this->compnany_obj->get_compnay_id();


        $data_base_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_list where id='" . $this->id . "' and company_id='" . $this->company_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            $this->bool_state = true;
            while ($row = $get_result->fetch_assoc()) {
                $this->name = $row['name'];
                $this->short_name = $row['short_name'];
                $this->email = $row['email'];
                $this->phone_no = $row['phone_no'];
                $this->moble_no_for_sms = $row['moble_no_for_sms'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->sup_credit_limit = $row['sup_credit_limit'];
                $this->cus_credit_limit = $row['cus_credit_limit'];
                $this->cus_state = $row['cus_state'];
                $this->sup_state = $row['sup_state'];
                $this->cus_credit_state = $row['cus_credit_state'];
                $this->sup_credit_state = $row['sup_credit_state'];
                $this->sup_opening_bal = $row['sup_opening_bal'];
                $this->cus_opening_bal = $row['cus_opening_bal'];
                $this->cheque_amount_cus = $row['cheque_amount_cus'];
                $this->cheque_amount_sup = $row['cheque_amount_sup'];
                $this->self_account = $row['self_account'];
                $this->active = $row['active'];
                $this->email_sent_form = $row['email_sent_form'];
                $this->personal_account = $row['personal_account'];
                $this->coperate_account = $row['coperate_account'];
                $this->logo = $row['logo'];
                $this->approve_state = $row['approve_state'];
                $this->cus_credit_period = $row['cus_credit_period'];
                $this->sup_cridet_period = $row['sup_cridet_period'];
                $this->cus_credit_request = $row['cus_credit_request'];
                $this->self_ac_submition_state = $row['self_ac_submition_state'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->sms_sent_form = $row['sms_sent_form'];
                $this->verify_sms = $row['verify_sms'];
                $this->verify_email = $row['verify_email'];
                $this->cus_self_credit_from = $row['cus_self_credit_from'];
                $this->cus_PD_chque = $row['cus_PD_chque'];
                $this->sup_PD_chque = $row['sup_PD_chque'];
            }
        } else {
            $this->bool_state = false;
        }
    }

    public function get_bool_state()
    {
        return $this->bool_state;
    }
    public function get_error_message()
    {
        return $this->error_message;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_short_name()
    {
        return $this->short_name;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_phone_no()
    {
        return $this->phone_no;
    }
    public function get_moble_no_for_sms()
    {
        return $this->moble_no_for_sms;
    }
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_sup_credit_limit()
    {
        return $this->sup_credit_limit;
    }
    public function get_cus_credit_limit()
    {
        return $this->cus_credit_limit;
    }
    public function get_cus_state()
    {
        return $this->cus_state;
    }
    public function get_sup_state()
    {
        return $this->sup_state;
    }
    public function get_cus_credit_state()
    {
        return $this->cus_credit_state;
    }
    public function get_sup_credit_state()
    {
        return $this->sup_credit_state;
    }
    public function get_sup_opening_bal()
    {
        return $this->sup_opening_bal;
    }
    public function get_cus_opening_bal()
    {
        return $this->cus_opening_bal;
    }
    public function get_cheque_amount_cus()
    {
        return $this->cheque_amount_cus;
    }
    public function get_cheque_amount_sup()
    {
        return $this->cheque_amount_sup;
    }
    public function get_self_account()
    {
        return $this->self_account;
    }
    public function get_active()
    {
        return $this->active;
    }
    public function get_email_sent_form()
    {
        return $this->email_sent_form;
    }
    public function get_personal_account()
    {
        return $this->personal_account;
    }
    public function get_coperate_account()
    {
        return $this->coperate_account;
    }
    public function get_logo()
    {
        return $this->logo;
    }
    public function get_approve_state()
    {
        return $this->approve_state;
    }
    public function get_cus_credit_period()
    {
        return $this->cus_credit_period;
    }
    public function get_sup_cridet_period()
    {
        return $this->sup_cridet_period;
    }
    public function get_cus_PD_chque()
    {
        return $this->cus_PD_chque;
    }
    public function get_sup_PD_chque()
    {
        return $this->sup_PD_chque;
    }
    public function get_cus_self_credit_from()
    {
        return $this->cus_self_credit_from;
    }
    public function get_verify_sms()
    {
        return $this->verify_sms;
    }
    public function get_verify_email()
    {
        return $this->verify_email;
    }
    public function get_cus_credit_request()
    {
        return $this->cus_credit_request;
    }
    public function get_self_ac_submition_state()
    {
        return $this->self_ac_submition_state;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
    public function get_sms_sent_form()
    {
        return $this->sms_sent_form;
    }
}
