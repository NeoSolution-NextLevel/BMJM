
<?php

class IPG_Send_By_URL_ADD_UPDATE
{

    private $id;
    private $sec_id;
    private $is_member = 0;
    private $is_subction = 0;
    private $is_zakath = 0;
    private $is_projcet = 0;
    private $is_donation = 0;
    private $amount;
    private $cus_name;
    private $cus_phone_no;
    private $cus_email;
    private $is_bank_fee = 0;
    private $bank_fee_amount;
    private $transation_amount;
    private $is_user = 0;
    private $ast = "1";
    private $sdt;
    private $ipg_transaction_id = "";
    private $payment_status = 0;

    private $sql_update_query = "";

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_amount, $get_cus_name, $get_cus_phone_no, $get_cus_email, $get_bank_fee_amount, $get_transation_amount)
    {
        $this->amount                 = $get_amount;
        $this->cus_name              = $get_cus_name;
        $this->cus_phone_no             = $get_cus_phone_no;
        $this->cus_email             = $get_cus_email;
        $this->bank_fee_amount       = $get_bank_fee_amount;
        $this->transation_amount    = $get_transation_amount;

        $this->sql_update_query =
            "amount='"               . $this->amount               . "'" .
            ",cus_name='"           . $this->cus_name            . "'" .
            ",cus_phone_no='"          . $this->cus_phone_no           . "'" .
            ",cus_email='"          . $this->cus_email           . "'" .
            ",bank_fee_amount='"    . $this->bank_fee_amount     . "'" .
            ",transation_amount='" . $this->transation_amount  . "'";
    }

    public function is_is_member()
    {
        $this->is_member = 1;
        $this->sql_update_query .= ",is_member='" . $this->is_member . "'";
    }

    public function is_not_is_member()
    {
        $this->is_member = 0;
        $this->sql_update_query .= ",is_member='" . $this->is_member . "'";
    }

    public function is_is_subction()
    {
        $this->is_subction = 1;
        $this->sql_update_query .= ",is_subction='" . $this->is_subction . "'";
    }

    public function is_not_is_subction()
    {
        $this->is_subction = 0;
        $this->sql_update_query .= ",is_subction='" . $this->is_subction . "'";
    }


    public function is_is_zakath()
    {
        $this->is_zakath = 1;
        $this->sql_update_query .= ",is_zakath='" . $this->is_zakath . "'";
    }

    public function is_not_is_zakath()
    {
        $this->is_zakath = 0;
        $this->sql_update_query .= ",is_zakath='" . $this->is_zakath . "'";
    }

    public function is_is_projcet()
    {
        $this->is_projcet = 1;
        $this->sql_update_query .= ",is_projcet='" . $this->is_projcet . "'";
    }

    public function is_not_is_projcet()
    {
        $this->is_projcet = 0;
        $this->sql_update_query .= ",is_projcet='" . $this->is_projcet . "'";
    }

    public function is_is_donation()
    {
        $this->is_donation = 1;
        $this->sql_update_query .= ",is_donation='" . $this->is_donation . "'";
    }

    public function is_not_is_donation()
    {
        $this->is_donation = 0;
        $this->sql_update_query .= ",is_donation='" . $this->is_donation . "'";
    }

    public function is_is_bank_fee()
    {
        $this->is_bank_fee = 1;
        $this->sql_update_query .= ",is_bank_fee='" . $this->is_bank_fee . "'";
    }

    public function is_not_is_bank_fee()
    {
        $this->is_bank_fee = 0;
        $this->sql_update_query .= ",is_bank_fee='" . $this->is_bank_fee . "'";
    }

    public function is_is_user()
    {
        $this->is_user = 1;
        $this->sql_update_query .= ",is_user='" . $this->is_user . "'";
    }

    public function is_not_is_user()
    {
        $this->is_user = 0;
        $this->sql_update_query .= ",is_user='" . $this->is_user . "'";
    }



    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
        $this->sql_update_query .= ",id='" . $this->id . "'";
    }

    public function set_amount($get_amount)
    {
        $this->amount = $get_amount;
        $this->sql_update_query .= ",amount='" . $this->amount . "'";
    }

    public function set_cus_name($get_cus_name)
    {
        $this->cus_name = $get_cus_name;
        $this->sql_update_query .= ",cus_name='" . $this->cus_name . "'";
    }

    public function set_cus_phone_no($get_cus_phone_no)
    {
        $this->cus_phone_no = $get_cus_phone_no;
        $this->sql_update_query .= ",cus_phone_no='" . $this->cus_phone_no . "'";
    }

    public function set_cus_email($get_cus_email)
    {
        $this->cus_email = $get_cus_email;
        $this->sql_update_query .= ",cus_email='" . $this->cus_email . "'";
    }

    public function set_bank_fee_amount($get_bank_fee_amount)
    {
        $this->bank_fee_amount = $get_bank_fee_amount;
        $this->sql_update_query .= ",bank_fee_amount='" . $this->bank_fee_amount . "'";
    }

    public function set_transation_amount($get_transation_amount)
    {
        $this->transation_amount = $get_transation_amount;
        $this->sql_update_query .= ",transation_amount='" . $this->transation_amount . "'";
    }

    public function set_sec_id($get_sec_id)
    {
        $this->sec_id = $get_sec_id;
        $this->sql_update_query .= ",sec_id='" . $this->sec_id . "'";
    }

    public function set_ipg_transaction_id($val)
    {
        $this->ipg_transaction_id = $val;
        $this->sql_update_query .= ",ipg_transaction_id='" . $this->ipg_transaction_id . "'";
    }

    public function set_payment_status($val)
    {
        $this->payment_status = $val;
        $this->sql_update_query .= ",payment_status='" . $this->payment_status . "'";
    }

    public function set_transaction_payment_success()
    {
        $this->set_payment_status(1);
    }

    public function set_transaction_payment_fail()
    {
        $this->set_payment_status(0);
    }

    public function remove()
    {
        $this->ast = "0";
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $bol = false;

        $data_base_obj = new database();
        $get_sql_query = "INSERT INTO ipg_send_by_url
(sec_id, is_member, is_subction, is_zakath, is_projcet, is_donation, amount, cus_name, cus_phone_no, cus_email, is_bank_fee, bank_fee_amount, transation_amount, is_user, ast, sdt, ipg_transaction_id, payment_status)
VALUES (
    '" . $this->sec_id . "',
    '" . $this->is_member . "',
    '" . $this->is_subction . "',
    '" . $this->is_zakath . "',
    '" . $this->is_projcet . "',
    '" . $this->is_donation . "',
    '" . $this->amount . "',
    '" . $this->cus_name . "',
    '" . $this->cus_phone_no . "',
    '" . $this->cus_email . "',
    '" . $this->is_bank_fee . "',
    '" . $this->bank_fee_amount . "',
    '" . $this->transation_amount . "',
    '" . $this->is_user . "',
    '" . $this->ast . "',
    '" . $this->sdt . "',
    '" . $this->ipg_transaction_id . "',
    '" . $this->payment_status . "'
);";


        // echo $get_sql_query;
        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();

        if ($data_base_obj->get_error_state_boolean()) {
            $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
            $Advance_Security_obj = new Advance_Security();
            $this->sec_id = $Advance_Security_obj->get_data_encrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $this->id);

            $IPG_Send_By_URL_ADD_UPDATE_obj = new IPG_Send_By_URL_ADD_UPDATE();
            $IPG_Send_By_URL_ADD_UPDATE_obj->set_sec_id($this->sec_id);
            $IPG_Send_By_URL_ADD_UPDATE_obj->set_id($this->id);
            if ($IPG_Send_By_URL_ADD_UPDATE_obj->process_update()) {
                $bol = true;
            }
        }


        return $bol;
    }

    public function get_sec_id()
    {
        return $this->sec_id;
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update ipg_send_by_url set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
