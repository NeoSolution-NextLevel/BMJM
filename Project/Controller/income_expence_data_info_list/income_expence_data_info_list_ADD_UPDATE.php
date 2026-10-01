
<?php

class income_expence_data_info_list_ADD_UPDATE
{

    private $id;

    private $ast = "1";
    private $sdt;
    private $is_type_of_income = 0;
    private $is_type_of_expence = 0;

    private $dis;
    private $amount;
    private $main_user_login_id;
    private $income_expence_data_id;
    private $income_expence_type_id;

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_dis, $get_amount, $get_income_expence_data_id, $get_income_expence_type_id)
    {

        $this->dis = $get_dis;
        $this->amount = $get_amount;
        $this->income_expence_data_id = $get_income_expence_data_id;
        $this->income_expence_type_id = $get_income_expence_type_id;


        $this->sql_update_query .=
            ",dis='" . $this->dis . "'" .
            ",amount='" . $this->amount . "'" .
            ",income_expence_data_id='" . $this->income_expence_data_id . "'" .
            ",income_expence_type_id='" . $this->income_expence_type_id . "'";
    }

    public function is_is_type_of_income()
    {
        $this->is_type_of_income = 1;
        $this->sql_update_query .= ",is_type_of_income='" . $this->is_type_of_income . "'";
    }

    public function is_not_is_type_of_income()
    {
        $this->is_type_of_income = 0;
        $this->sql_update_query .= ",is_type_of_income='" . $this->is_type_of_income . "'";
    }

    public function is_is_type_of_expence()
    {
        $this->is_type_of_expence = 1;
        $this->sql_update_query .= ",is_type_of_expence='" . $this->is_type_of_expence . "'";
    }

    public function is_not_is_type_of_expence()
    {
        $this->is_type_of_expence = 0;
        $this->sql_update_query .= ",is_type_of_expence='" . $this->is_type_of_expence . "'";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }


    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }

    public function set_amount($get_amount)
    {
        $this->amount = $get_amount;
        $this->sql_update_query .= ",amount='" . $this->amount . "'";
    }
    public function set_income_expence_data_id($get_income_expence_data_id)
    {
        $this->income_expence_data_id = $get_income_expence_data_id;
        $this->sql_update_query .= ",income_expence_data_id='" . $this->income_expence_data_id . "'";
    }
    public function set_income_expence_type_id($get_income_expence_type_id)
    {
        $this->income_expence_type_id = $get_income_expence_type_id;
        $this->sql_update_query .= ",income_expence_type_id='" . $this->income_expence_type_id . "'";
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

        $get_sql_query = "INSERT INTO income_expence_data_info_list(ast,sdt,is_type_of_income,is_type_of_expence,dis,amount,main_user_login_id,income_expence_data_id,income_expence_type_id) VALUES ("
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->is_type_of_income . "', "
            . "'" . $this->is_type_of_expence . "', "
            . "'" . $this->dis . "', "
            . "'" . $this->amount . "', "
            . "'" . $this->main_user_login_id . "', "
            . "'" . $this->income_expence_data_id . "', "
            . "'" . $this->income_expence_type_id . "');";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update income_expence_data_info_list set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
