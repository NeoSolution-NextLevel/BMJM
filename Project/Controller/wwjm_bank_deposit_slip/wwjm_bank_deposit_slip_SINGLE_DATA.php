<?php

class wwjm_bank_deposit_slip_SINGLE_DATA
{

    private $id;

    private $ast = "1";
    private $image_pth;
    private $sdt;

    private $wwjm_payment_slip_id;

    private $main_user_login_id;

    private $approve_by;

    private $resion_to_approve;

    private $approve_state;

    private $amount;

    private $bank_account_details_id;
    private $state_of_data = false;


    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_bank_deposit_slip WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->ast = $row['ast'];
                $this->image_pth = $row['image_pth'];
                $this->sdt = $row['sdt'];
                $this->wwjm_payment_slip_id = $row['wwjm_payment_slip_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->approve_by = $row['approve_by'];
                $this->resion_to_approve = $row['resion_to_approve'];
                $this->approve_state = $row['approve_state'];
                $this->amount = $row['amount'];
                $this->bank_account_details_id = $row['bank_account_details_id'];
            }
        }
    }

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

    public function get_image_pth()
    {
        return $this->image_pth;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_wwjm_payment_slip_id()
    {
        return $this->wwjm_payment_slip_id;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_approve_by()
    {
        return $this->approve_by;
    }

    public function get_resion_to_approve()
    {
        return $this->resion_to_approve;
    }

    public function get_approve_state()
    {
        return $this->approve_state;
    }

    public function get_amount()
    {
        return $this->amount;
    }

    public function get_bank_account_details_id()
    {
        return $this->bank_account_details_id;
    }
}
