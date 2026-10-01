<?php

class bank_deposit_data_history_SINGLE_DATA
{
    private $id;
    private $ast = "1";
    private $sdt;
    private $bank_account_details_id;
    private $wwjm_payment_slip_id;
    private $wwjm_bank_deposit_slip_id;
    private $dis;
    private $credit_amout;
    private $debet_amount;
    private $main_user_login_id;
    private $pay_resion_subcption = 0;
    private $pay_resion_donation = 0;
    private $pay_resion_zakath = 0;
    private $pay_resion_projects = 0;
    private $pay_resion_others = 0;
    private $pay_resion_other_by_text;
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "
            SELECT *
            FROM bank_deposit_data_history
            WHERE id = '" . $this->id . "'
            LIMIT 1
        ";
        $result = $data_base_obj->get_result($get_sql_query);


        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                // Map DB values to class variables
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->bank_account_details_id = $row['bank_account_details_id'];
                $this->wwjm_payment_slip_id = $row['wwjm_payment_slip_id'];
                $this->wwjm_bank_deposit_slip_id = $row['wwjm_bank_deposit_slip_id'];
                $this->dis = $row['dis'];
                $this->credit_amout = $row['credit_amout'];
                $this->debet_amount = $row['debet_amount'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->pay_resion_subcption = $row['pay_resion_subcption'];
                $this->pay_resion_donation = $row['pay_resion_donation'];
                $this->pay_resion_zakath = $row['pay_resion_zakath'];
                $this->pay_resion_projects = $row['pay_resion_projects'];
                $this->pay_resion_others = $row['pay_resion_others'];
                $this->pay_resion_other_by_text = $row['pay_resion_other_by_text'];
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
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_bank_account_details_id()
    {
        return $this->bank_account_details_id;
    }
    public function get_wwjm_payment_slip_id()
    {
        return $this->wwjm_payment_slip_id;
    }
    public function get_wwjm_bank_deposit_slip_id()
    {
        return $this->wwjm_bank_deposit_slip_id;
    }
    public function get_dis()
    {
        return $this->dis;
    }
    public function get_credit_amout()
    {
        return $this->credit_amout;
    }
    public function get_debet_amount()
    {
        return $this->debet_amount;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
    public function get_pay_resion_subcption()
    {
        return $this->pay_resion_subcption;
    }
    public function get_pay_resion_donation()
    {
        return $this->pay_resion_donation;
    }
    public function get_pay_resion_zakath()
    {
        return $this->pay_resion_zakath;
    }
    public function get_pay_resion_projects()
    {
        return $this->pay_resion_projects;
    }
    public function get_pay_resion_others()
    {
        return $this->pay_resion_others;
    }
    public function get_pay_resion_other_by_text()
    {
        return $this->pay_resion_other_by_text;
    }
}
