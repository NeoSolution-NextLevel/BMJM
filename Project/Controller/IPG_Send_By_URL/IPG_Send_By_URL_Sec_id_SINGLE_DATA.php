<?php

class IPG_Send_By_URL_Sec_id_SINGLE_DATA
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
    private $ipg_transaction_id;
    private $payment_status;

    private $state_of_data = false;

    public function __construct($sec_id)
    {
        $this->sec_id = $sec_id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM ipg_send_by_url WHERE sec_id = '" . $this->sec_id . "'";
        $result = $data_base_obj->get_result($get_sql_query);


        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id                 = $row['id'];
                $this->sec_id             = $row['sec_id'];
                $this->is_member          = $row['is_member'];
                $this->is_subction        = $row['is_subction'];
                $this->is_zakath          = $row['is_zakath'];
                $this->is_projcet         = $row['is_projcet'];
                $this->is_donation        = $row['is_donation'];
                $this->amount             = $row['amount'];
                $this->cus_name           = $row['cus_name'];
                $this->cus_phone_no       = $row['cus_phone_no'];
                $this->cus_email          = $row['cus_email'];
                $this->is_bank_fee        = $row['is_bank_fee'];
                $this->bank_fee_amount    = $row['bank_fee_amount'];
                $this->transation_amount  = $row['transation_amount'];
                $this->is_user            = $row['is_user'];
                $this->ast                = $row['ast'];
                $this->sdt                = $row['sdt'];
                $this->ipg_transaction_id = $row['ipg_transaction_id'] ?? "";
                $this->payment_status     = $row['payment_status'] ?? 0;
            }
        }
    }

    // --- Getter functions ---
    public function get_state()
    {
        return $this->state_of_data;
    }
    public function get_id()
    {
        return $this->id;
    }

    public function get_sec_id()
    {
        return $this->sec_id;
    }

    public function get_is_member()
    {
        return $this->is_member;
    }

    public function get_is_subction()
    {
        return $this->is_subction;
    }

    public function get_is_zakath()
    {
        return $this->is_zakath;
    }

    public function get_is_projcet()
    {
        return $this->is_projcet;
    }

    public function get_is_donation()
    {
        return $this->is_donation;
    }

    public function get_amount()
    {
        return $this->amount;
    }

    public function get_cus_name()
    {
        return $this->cus_name;
    }

    public function get_cus_phone_no()
    {
        return $this->cus_phone_no;
    }

    public function get_cus_email()
    {
        return $this->cus_email;
    }

    public function get_is_bank_fee()
    {
        return $this->is_bank_fee;
    }

    public function get_bank_fee_amount()
    {
        return $this->bank_fee_amount;
    }

    public function get_transation_amount()
    {
        return $this->transation_amount;
    }

    public function get_is_user()
    {
        return $this->is_user;
    }

    public function get_state_of_data()
    {
        return $this->state_of_data;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_ast()
    {
        return $this->ast;
    }

    public function get_ipg_transaction_id()
    {
        return $this->ipg_transaction_id;
    }

    public function get_payment_status()
    {
        return $this->payment_status;
    }
}
