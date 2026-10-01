
<?php

class main_user_login_has_IPG_Send_By_URL_ADD_UPDATE
{

    private $id;
    private $main_user_login_id;

    private $IPG_Send_By_URL_id;
    private $ast = 1;

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
    }

    public function get_data($get_IPG_Send_By_URL_id)
    {
        $this->IPG_Send_By_URL_id   = $get_IPG_Send_By_URL_id;


        $this->sql_update_query =  "IPG_Send_By_URL_id='"   . $this->IPG_Send_By_URL_id   . "'";
    }


    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_IPG_Send_By_URL_id($get_IPG_Send_By_URL_id)
    {
        $this->IPG_Send_By_URL_id = $get_IPG_Send_By_URL_id;
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO main_user_login_has_ipg_send_by_url
    (main_user_login_id, IPG_Send_By_URL_id,ast) 
    VALUES (
        '" . $this->main_user_login_id . "',
        '" . $this->IPG_Send_By_URL_id . "',
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
        $get_sql_query = "update main_user_login_has_ipg_send_by_url set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
