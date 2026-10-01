
<?php

class income_expence_type_ADD_UPDATE
{

    private $id;

    private $ast = "1";
    private $sdt;

    private $income_expence_type_name;
    private $is_income_type = 0;
    private $is_expece_type = 0;
    private $main_user_login_id;

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_income_expence_type_name)
    {
        $this->income_expence_type_name = $get_income_expence_type_name;
        $this->sql_update_query .= ",income_expence_type_name='" . $this->income_expence_type_name . "'";
    }

    public function is_is_income_type()
    {
        $this->is_income_type = 1;
        $this->sql_update_query .= ",is_income_type='" . $this->is_income_type . "'";
    }

    public function is_not_is_income_type()
    {
        $this->is_income_type = 0;
        $this->sql_update_query .= ",is_income_type='" . $this->is_income_type . "'";
    }

    public function is_is_expece_type()
    {
        $this->is_expece_type = 1;
        $this->sql_update_query .= ",is_expece_type='" . $this->is_expece_type . "'";
    }

    public function is_not_is_expece_type()
    {
        $this->is_expece_type = 0;
        $this->sql_update_query .= ",is_expece_type='" . $this->is_expece_type . "'";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_income_expence_type_name($get_income_expence_type_name)
    {
        $this->income_expence_type_name = $get_income_expence_type_name;
        $this->sql_update_query .= ",income_expence_type_name='" . $this->income_expence_type_name . "'";
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

        $get_sql_query = "INSERT INTO income_expence_type(ast,sdt,income_expence_type_name,is_income_type,is_expece_type,main_user_login_id) VALUES ("
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->income_expence_type_name . "', "
            . "'" . $this->is_income_type . "', "
            . "'" . $this->is_expece_type . "', "
            . "'" . $this->main_user_login_id . "');";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update income_expence_type set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
