
<?php

class bank_account_details_ADD_UPDATE
{

    private $id;
    private $bank_name;

    private $branch;

    private $ac_no;

    private $ac_name;

    private $swif_code;

    private $current_ac;

    private $savings_ac;

    private $dis;

    private $main_user_login_id;
    private $sdt;
    private $ast = "1";

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_bank_name, $get_branch, $get_ac_no, $get_ac_name, $get_swif_code, $get_dis)
    {
        $this->bank_name   = $get_bank_name;
        $this->branch      = $get_branch;
        $this->ac_no       = $get_ac_no;
        $this->ac_name       = $get_ac_name;
        $this->swif_code   = $get_swif_code;
        $this->dis         = $get_dis;

        $this->sql_update_query =
            "bank_name='"   . $this->bank_name   . "'" .
            ",branch='"     . $this->branch      . "'" .
            ",ac_no='"      . $this->ac_no       . "'" .
            ",ac_name='"      . $this->ac_name    . "'" .
            ",swif_code='"  . $this->swif_code   . "'" .
            ",dis='"        . $this->dis         . "'";
    }

    public function is_current_ac()
    {
        $this->current_ac = 1;
        $this->sql_update_query .= ",current_ac='" . $this->current_ac . "'";
    }

    public function is_not_current_ac()
    {
        $this->current_ac = 0;
        $this->sql_update_query .= ",current_ac='" . $this->current_ac . "'"; 
    }

    public function is_savings_ac()
    {
        $this->savings_ac = 1;
        $this->sql_update_query .= ",savings_ac='" . $this->savings_ac . "'";
    }

    public function is_not_savings_ac()
    {
        $this->savings_ac = 0;
        $this->sql_update_query .= ",savings_ac='" . $this->savings_ac . "'";
    }



    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_bank_name($get_bank_name)
    {
        $this->bank_name = $get_bank_name;
        $this->sql_update_query .= ",bank_name='" . $this->bank_name . "'";

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

        $get_sql_query = "INSERT INTO bank_account_details
    (bank_name, branch, ac_no, ac_name, swif_code, current_ac, savings_ac, dis, main_user_login_id, sdt, ast) 
    VALUES (
        '" . $this->bank_name . "',
        '" . $this->branch . "',
        '" . $this->ac_no . "',
        '" . $this->ac_name . "',
        '" . $this->swif_code . "',
        '" . $this->current_ac . "',
        '" . $this->savings_ac . "',
        '" . $this->dis . "',
        '" . $this->main_user_login_id . "',
        '" . $this->sdt . "',
        '" . $this->ast . "'
    );";


        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update bank_account_details set ast='" . $this->ast . "'," . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
