<?php
class cus_sup_list_ADD_UPDATE
{
    private $id;
    private $name;
    private $short_name;
    private $email;
    private $phone_no;
    private $moble_no_for_sms;
    private $ast = "1";
    private $sdt;
    private $sup_credit_limit = "0";
    private $cus_credit_limit = "0";
    private $cus_state = "0";
    private $sup_state = "0";
    private $cus_credit_state = "0";
    private $sup_credit_state = "0";
    private $sup_opening_bal = "0";
    private $cus_opening_bal = "0";
    private $cus_PD_chque = "0";
    private $sup_PD_chque = "0";
    private $self_account = "0";
    private $active = "0";
    private $email_sent_form = "0";
    private $personal_account = "0";
    private $coperate_account = "0";
    private $company_id = "0";
    private $cheque_amount_cus = "0";
    private $cheque_amount_sup = "0";
    private $logo;
    private $approve_state = "0";
    private $cus_credit_period = "0";
    private $sup_cridet_period = "0";
    private $cus_credit_request = "0";
    private $self_ac_submition_state = "0";
    private $main_user_login_id;
    private $sms_sent_form = "0";
    private $verify_sms = "0";
    private $verify_email = "0";
    private $default_customer_bock = "0";
    private $cus_self_credit_from = "0";
    private $sql_update_query;
    private $compnany_obj;



    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
        $this->compnany_obj = new Company_Info_Variable_List();
        $this->company_id = $this->compnany_obj->get_compnay_id();
    }
    public function set_data($get_name, $get_short_name, $get_email, $get_phone_no, $get_moble_no_for_sms)
    {
        $this->name = $get_name;
        $this->short_name = $get_short_name;
        $this->email = $get_email;
        $this->phone_no = $get_phone_no;
        $this->moble_no_for_sms = $get_moble_no_for_sms;
        $this->sql_update_query = $this->sql_update_query . ",name='" . $this->name . "',short_name='" . $this->short_name . "',email='" . $this->email . "',phone_no='" . $this->phone_no . "',moble_no_for_sms='" . $this->moble_no_for_sms . "'";
    }
    function is_personal_account()
    {
        $this->personal_account = "1";
        $this->sql_update_query = $this->sql_update_query . ",personal_account='" . $this->personal_account . "'";
    }
    function is_NOT_personal_account()
    {
        $this->personal_account = "0";
        $this->sql_update_query = $this->sql_update_query . ",personal_account='" . $this->personal_account . "'";
    }
    function is_coperate_account()
    {
        $this->coperate_account = "1";
        $this->sql_update_query = $this->sql_update_query . ",coperate_account='" . $this->coperate_account . "'";
    }
    function is_NOT_coperate_account()
    {
        $this->coperate_account = "0";
        $this->sql_update_query = $this->sql_update_query . ",coperate_account='" . $this->coperate_account . "'";
    }
    function is_email_sent_form()
    {
        $this->email_sent_form = "1";
        $this->sql_update_query = $this->sql_update_query . ",email_sent_form='" . $this->email_sent_form . "'";
    }
    function is_NOT_email_sent_form()
    {
        $this->email_sent_form = "0";
        $this->sql_update_query = $this->sql_update_query . ",email_sent_form='" . $this->email_sent_form . "'";
    }
    function is_self_ac_submition_state()
    {
        $this->self_ac_submition_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",self_ac_submition_state='" . $this->self_ac_submition_state . "'";
    }
    public function set_logo_url($get_logo_url)
    {
        $this->logo = $get_logo_url;
        $this->sql_update_query = $this->sql_update_query . ",logo='" . $this->logo . "'";
    }
    public function set_name($get_name)
    {
        $this->name = $get_name;
        $this->sql_update_query = $this->sql_update_query . ",name='" . $this->name . "'";
    }
    public function set_short_name($get_short_name)
    {
        $this->short_name = $get_short_name;
        $this->sql_update_query = $this->sql_update_query . ",short_name='" . $this->short_name . "'";
    }
    public function set_email($get_email)
    {
        $this->email = $get_email;
        $this->sql_update_query = $this->sql_update_query . ",email='" . $this->email . "'";
    }
    public function set_phone_no($get_phone_no)
    {
        $this->phone_no = $get_phone_no;
        $this->sql_update_query = $this->sql_update_query . ",phone_no='" . $this->phone_no . "'";
    }
    public function set_moble_no_for_sms($get_moble_no_for_sms)
    {
        $this->moble_no_for_sms = $get_moble_no_for_sms;
        $this->sql_update_query = $this->sql_update_query . ",moble_no_for_sms='" . $this->moble_no_for_sms . "'";
    }
    // ----------------------------customer -----------------------------------
    public function is_customer_credit()
    {
        $this->cus_credit_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_state='" . $this->cus_credit_state . "'";
    }
    public function is_customer_NOT_credit()
    {
        $this->cus_credit_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_state='" . $this->cus_credit_state . "'";
    }
    public function set_cus_credit_limit($get_cus_credit_limit)
    {
        $this->cus_credit_limit = $get_cus_credit_limit;
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_limit='" . $this->cus_credit_limit . "'";
    }
    // ----------------------------supplier -----------------------------------
    public function set_sup_credit_limit($get_sup_credit_limit)
    {
        $this->sup_credit_limit = $get_sup_credit_limit;
        $this->sql_update_query = $this->sql_update_query . ",sup_credit_limit='" . $this->sup_credit_limit . "'";
    }
    public function is_supplier_credit()
    {
        $this->sup_credit_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",sup_credit_state='" . $this->sup_credit_state . "'";
    }
    public function set_sup_PD_chque($get_sup_PD_chque)
    {
        $this->sup_PD_chque = $get_sup_PD_chque;
        $this->sql_update_query = $this->sql_update_query . ",sup_PD_chque='" . $this->sup_PD_chque . "'";
    }
    public function set_cus_PD_chque($get_cus_PD_chque)
    {
        $this->cus_PD_chque = $get_cus_PD_chque;
        $this->sql_update_query = $this->sql_update_query . ",cus_PD_chque='" . $this->cus_PD_chque . "'";
    }
    public function is_supplier_NOT_credit()
    {
        $this->sup_credit_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",sup_credit_state='" . $this->sup_credit_state . "'";
    }
    // ----------------------------customer -----------------------------------
    public function is_customer()
    {
        $this->cus_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",cus_state='" . $this->cus_state . "'";
    }
    public function is_NOT_customer()
    {
        $this->cus_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",cus_state='" . $this->cus_state . "'";
    }
    public function is_supplier()
    {
        $this->sup_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",sup_state='" . $this->sup_state . "'";
    }
    public function is_NOT_supplier()
    {
        $this->sup_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",sup_state='" . $this->sup_state . "'";
    }
    // ----------------------------supplier -----------------------------------
    public function set_sup_opening_bal($get_sup_opening_bal)
    {
        $this->sup_opening_bal = $get_sup_opening_bal;
        $this->sql_update_query = $this->sql_update_query . ",sup_opening_bal='" . $this->sup_opening_bal . "'";
    }
    public function set_cus_opening_bal($get_cus_opening_bal)
    {
        $this->cus_opening_bal = $get_cus_opening_bal;
        $this->sql_update_query = $this->sql_update_query . ",cus_opening_bal='" . $this->cus_opening_bal . "'";
    }
    public function set_cheque_amount_cus($get_cheque_amount_cus)
    {
        $this->cheque_amount_cus = $get_cheque_amount_cus;
        $this->sql_update_query = $this->sql_update_query . ",cheque_amount_cus='" . $this->cheque_amount_cus . "'";
    }
    public function set_cheque_amount_sup($get_cheque_amount_sup)
    {
        $this->cheque_amount_sup = $get_cheque_amount_sup;
        $this->sql_update_query = $this->sql_update_query . ",cheque_amount_sup='" . $this->cheque_amount_sup . "'";
    }
    public function is_self_account()
    {
        $this->self_account = "1";
        $this->sql_update_query = $this->sql_update_query . ",self_account='" . $this->self_account . "'";
    }
    public function is_NOT_self_account()
    {
        $this->self_account = "0";
        $this->sql_update_query = $this->sql_update_query . ",self_account='" . $this->self_account . "'";
    }
    public function is_active()
    {
        $this->active = "1";
        $this->sql_update_query = $this->sql_update_query . ",active='" . $this->active . "'";
    }
    public function is_NOT_active()
    {
        $this->active = "0";
        $this->sql_update_query = $this->sql_update_query . ",active='" . $this->active . "'";
    }
    public function is_approve_state()
    {
        $this->approve_state = "1";
        $this->sql_update_query = $this->sql_update_query . ",approve_state='" . $this->approve_state . "'";
    }
    public function is_NOT_approve_state()
    {
        $this->approve_state = "0";
        $this->sql_update_query = $this->sql_update_query . ",approve_state='" . $this->approve_state . "'";
    }
    public function set_cus_credit_period($get_cus_credit_period)
    {
        $this->cus_credit_period = $get_cus_credit_period;
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_period='" . $this->cus_credit_period . "'";
    }
    public function set_sup_cridet_period($get_sup_cridet_period)
    {
        $this->sup_cridet_period = $get_sup_cridet_period;
        $this->sql_update_query = $this->sql_update_query . ",sup_cridet_period='" . $this->sup_cridet_period . "'";
    }
    public function is_cus_credit_request()
    {
        $this->cus_credit_request = "1";
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_request='" . $this->cus_credit_request . "'";
    }
    public function is_NOT_cus_credit_request()
    {
        $this->cus_credit_request = "0";
        $this->sql_update_query = $this->sql_update_query . ",cus_credit_request='" . $this->cus_credit_request . "'";
    }
    public function is_sms_sent_form()
    {
        $this->sms_sent_form = "1";
        $this->sql_update_query = $this->sql_update_query . ",sms_sent_form='" . $this->sms_sent_form . "'";
    }
    public function is_NOT_sms_sent_form()
    {
        $this->sms_sent_form = "0";
        $this->sql_update_query = $this->sql_update_query . ",sms_sent_form='" . $this->sms_sent_form . "'";
    }
    public function is_verify_sms()
    {
        $this->verify_sms = "1";
        $this->sql_update_query = $this->sql_update_query . ",verify_sms='" . $this->verify_sms . "'";
    }
    public function is_NOT_verify_sms()
    {
        $this->verify_sms = "0";
        $this->sql_update_query = $this->sql_update_query . ",verify_sms='" . $this->verify_sms . "'";
    }
    public function is_verify_email()
    {
        $this->verify_email = "1";
        $this->sql_update_query = $this->sql_update_query . ",verify_email='" . $this->verify_email . "'";
    }
    public function is_NOT_verify_email()
    {
        $this->verify_email = "0";
        $this->sql_update_query = $this->sql_update_query . ",verify_email='" . $this->verify_email . "'";
    }
    public function is_default_customer_bock()
    {
        $this->default_customer_bock = "1";
        $this->sql_update_query = $this->sql_update_query . ",default_customer_bock='" . $this->default_customer_bock . "'";
    }
    public function is_NOT_default_customer_bock()
    {
        $this->default_customer_bock = "0";
        $this->sql_update_query = $this->sql_update_query . ",default_customer_bock='" . $this->default_customer_bock . "'";
    }
    public function is_cus_self_credit_from()
    {
        $this->cus_self_credit_from = "1";
        $this->sql_update_query = $this->sql_update_query . ",cus_self_credit_from='" . $this->cus_self_credit_from . "'";
    }
    public function is_NOT_cus_self_credit_from()
    {
        $this->cus_self_credit_from = "0";
        $this->sql_update_query = $this->sql_update_query . ",cus_self_credit_from='" . $this->cus_self_credit_from . "'";
    }

    private $error_message;

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }
    public function get_error_message()
    {
        return $this->error_message;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function remove_data()
    {
        $this->ast = "0";
    }

    public function process_create_new_record()
    {
        $bool_state = false;

        $cus_sup_list_LIST_obj = new cus_sup_list_LIST();
        $cus_sup_list_LIST_obj->check_email_is_exist($this->email);
        $get_result_email_check = $cus_sup_list_LIST_obj->get_result();
        if ($get_result_email_check->num_rows == 0) {

            $cus_sup_list_LIST_obj = new cus_sup_list_LIST();
            $cus_sup_list_LIST_obj->check_phone_no_is_exist($this->phone_no);
            $get_result_phone_no_check = $cus_sup_list_LIST_obj->get_result();
            if ($get_result_phone_no_check->num_rows == 0) {

                $database_obj = new DataBase();
                $get_sql_query = "insert into cus_sup_list (name, short_name, email, phone_no, moble_no_for_sms, ast, sdt, sup_credit_limit, cus_credit_limit, cus_state, sup_state, cus_credit_state, sup_credit_state, sup_opening_bal, cus_opening_bal, cus_PD_chque, sup_PD_chque, self_account, active, email_sent_form, personal_account, coperate_account, company_id, cheque_amount_cus, cheque_amount_sup, logo, approve_state, cus_credit_period, sup_cridet_period, cus_credit_request, self_ac_submition_state, main_user_login_id, sms_sent_form, verify_sms, verify_email, default_customer_bock, cus_self_credit_from) values
                ('" . $this->name . "', '" . $this->short_name . "', '" . $this->email . "', '" . $this->phone_no . "', '" . $this->moble_no_for_sms . "', '" . $this->ast . "', '" . $this->sdt . "'
                , '" . $this->sup_credit_limit . "', '" . $this->cus_credit_limit . "', '" . $this->cus_state . "', '" . $this->sup_state . "', '" . $this->cus_credit_state . "', '" . $this->sup_credit_state . "', '" . $this->sup_opening_bal . "', '" . $this->cus_opening_bal . "', '" . $this->cus_PD_chque . "', '" . $this->sup_PD_chque . "', '" . $this->self_account . "', '" . $this->active . "', '" . $this->email_sent_form . "', '" . $this->personal_account . "', '" . $this->coperate_account . "', '" . $this->company_id . "', '" . $this->cheque_amount_cus . "', '" . $this->cheque_amount_sup . "', '" . $this->logo . "', '" . $this->approve_state . "', '" . $this->cus_credit_period . "', '" . $this->sup_cridet_period . "', '" . $this->cus_credit_request . "', '" . $this->self_ac_submition_state . "', '" . $this->main_user_login_id . "', '" . $this->sms_sent_form . "', '" . $this->verify_sms . "', '" . $this->verify_email . "', '" . $this->default_customer_bock . "', '" . $this->cus_self_credit_from . "')";
                $database_obj->get_result($get_sql_query);
                $this->id = $database_obj->get_id();
                $this->error_message = $database_obj->get_error();
                $bool_state = $database_obj->get_error_state_boolean();
            } else {
                $this->error_message = "Phone number already exists";
                $bool_state = false;
            }
        } else {
            $this->error_message = "Email already exists";
            $bool_state = false;
        }


        return $bool_state;
    }

    public function process_create_new_record_for_customer()
    {
        $bool_state = false;
        $database_obj = new DataBase();
        $get_sql_query = "insert into cus_sup_list (name, short_name, email, phone_no, moble_no_for_sms, ast, sdt, sup_credit_limit, cus_credit_limit, cus_state, sup_state, cus_credit_state, sup_credit_state, sup_opening_bal, cus_opening_bal, cus_PD_chque, sup_PD_chque, self_account, active, email_sent_form, personal_account, coperate_account, company_id, cheque_amount_cus, cheque_amount_sup, logo, approve_state, cus_credit_period, sup_cridet_period, cus_credit_request, self_ac_submition_state, main_user_login_id, sms_sent_form, verify_sms, verify_email, default_customer_bock, cus_self_credit_from) values
                ('" . $this->name . "', '" . $this->short_name . "', '" . $this->email . "', '" . $this->phone_no . "', '" . $this->moble_no_for_sms . "', '" . $this->ast . "', '" . $this->sdt . "'
                , '" . $this->sup_credit_limit . "', '" . $this->cus_credit_limit . "', '" . $this->cus_state . "', '" . $this->sup_state . "', '" . $this->cus_credit_state . "', '" . $this->sup_credit_state . "', '" . $this->sup_opening_bal . "', '" . $this->cus_opening_bal . "', '" . $this->cus_PD_chque . "', '" . $this->sup_PD_chque . "', '" . $this->self_account . "', '" . $this->active . "', '" . $this->email_sent_form . "', '" . $this->personal_account . "', '" . $this->coperate_account . "', '" . $this->company_id . "', '" . $this->cheque_amount_cus . "', '" . $this->cheque_amount_sup . "', '" . $this->logo . "', '" . $this->approve_state . "', '" . $this->cus_credit_period . "', '" . $this->sup_cridet_period . "', '" . $this->cus_credit_request . "', '" . $this->self_ac_submition_state . "', '" . $this->main_user_login_id . "', '" . $this->sms_sent_form . "', '" . $this->verify_sms . "', '" . $this->verify_email . "', '" . $this->default_customer_bock . "', '" . $this->cus_self_credit_from . "')";
        $database_obj->get_result($get_sql_query);
        $this->id = $database_obj->get_id();
        $this->error_message = $database_obj->get_error();
        $bool_state = $database_obj->get_error_state_boolean();
        return $bool_state;
    }
    public function process_update_record()
    {
        $bool_state = false;
        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_list set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";
        $database_obj->get_result($get_sql_query);
        $this->error_message = $database_obj->get_error();
        $bool_state = $database_obj->get_error_state_boolean();
        return $bool_state;
    }
}

// (`id`, ``, ``, ``, ``, ``, `ast`, `sdt`, ``, ``, 
// `, ``, ``, ``, ``, ``, 
//  ``, ``, ``, ``, ``, ``, ``, 
// ``, `main_user_login_id`, ``, `verify_sms`, `verify_email`, `default_customer_bock`, `cus_self_credit_from`) 
