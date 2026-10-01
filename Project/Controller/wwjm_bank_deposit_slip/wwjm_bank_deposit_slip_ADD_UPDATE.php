
<?php

class wwjm_bank_deposit_slip_ADD_UPDATE
{

    private $id;
    private $ast = "1";
    private $image_pth;
    private $sdt;

    private $wwjm_payment_slip_id;

    private $main_user_login_id;

    private $approve_by;

    private $resion_to_approve;

    private $approve_state = 0;

    private $amount;

    private $bank_account_details_id;

    private $approve_cancel =0;

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_image_pth, $get_wwjm_payment_slip_id, $get_approve_by, $get_resion_to_approve, $get_amount, $get_bank_account_details_id)
    {
        $this->image_pth = $get_image_pth;
        $this->wwjm_payment_slip_id = $get_wwjm_payment_slip_id;
        $this->approve_by = $get_approve_by;
        $this->resion_to_approve = $get_resion_to_approve;
        $this->amount = $get_amount;
        $this->bank_account_details_id = $get_bank_account_details_id;
        $this->sql_update_query .= ",image_pth='" . $this->image_pth . "'" .
            ",wwjm_payment_slip_id='" . $this->wwjm_payment_slip_id . "'" .
            ",approve_by='" . $this->approve_by . "'" .
            ",resion_to_approve='" . $this->resion_to_approve . "'" .
            ",amount='" . $this->amount . "'" .
            ",bank_account_details_id='" . $this->bank_account_details_id . "'";
    }


    public function is_approve_state()
    {
        $this->approve_state = 1;
        $this->sql_update_query .= ",approve_state='" . $this->approve_state . "'";
    }

    public function is_not_approve_state()
    {
        $this->approve_state = 0;
        $this->sql_update_query .= ",approve_state='" . $this->approve_state . "'";
    }

    public function is_approve_cancel()
    {
        $this->approve_cancel = 1;
        $this->sql_update_query .= ",approve_cancel='" . $this->approve_cancel . "'";
    }

    public function is_not_approve_cancel()
    {
        $this->approve_cancel = 0;
        $this->sql_update_query .= ",approve_cancel='" . $this->approve_cancel . "'";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_image_pth($get_image_pth)
    {
        $this->image_pth = $get_image_pth;
        $this->sql_update_query .= ",image_pth='" . $this->image_pth . "'";
    }

    public function set_wwjm_payment_slip_id($get_wwjm_payment_slip_id)
    {
        $this->wwjm_payment_slip_id = $get_wwjm_payment_slip_id;
        $this->sql_update_query .= ",wwjm_payment_slip_id='" . $this->wwjm_payment_slip_id . "'";
    }

    public function set_approve_by($get_approve_by)
    {
        $this->approve_by = $get_approve_by;
        $this->sql_update_query .= ",approve_by='" . $this->approve_by . "'";
    }

    public function set_resion_to_approve($get_resion_to_approve)
    {
        $this->resion_to_approve = $get_resion_to_approve;
        $this->sql_update_query .= ",resion_to_approve='" . $this->resion_to_approve . "'";
    }
    public function set_amount($get_amount)
    {
        $this->amount = $get_amount;
        $this->sql_update_query .= ",amount='" . $this->amount . "'";
    }

    public function set_bank_account_details_id($get_bank_account_details_id)
    {
        $this->bank_account_details_id = $get_bank_account_details_id;
        $this->sql_update_query .= ",bank_account_details_id='" . $this->bank_account_details_id . "'";
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
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO wwjm_bank_deposit_slip(ast,image_pth,sdt,wwjm_payment_slip_id,main_user_login_id,approve_by,resion_to_approve,approve_state,amount,bank_account_details_id,approve_cancel) VALUES ("
            . "'" . $this->ast . "', "
            . "'" . $this->image_pth . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->wwjm_payment_slip_id . "', "
            . "'" . $this->main_user_login_id . "', "
            . "'" . $this->approve_by . "', "
            . "'" . $this->resion_to_approve . "', "
            . "'" . $this->approve_state . "', "
            . "'" . $this->amount . "', "
            . "'" . $this->bank_account_details_id . "', "
            . "'" . $this->approve_cancel . "');";


        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update wwjm_bank_deposit_slip set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
