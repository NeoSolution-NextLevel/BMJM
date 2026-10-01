
<?php

class wwjm_road_name_ADD_UPDATE
{

    private $id;
    private $road_name;
    private $ast = "1";
    private $sdt;
    private $main_user_login_id;
    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_road_name)
    {
        $this->road_name = $get_road_name;
        $this->sql_update_query .= ",road_name='" . $this->road_name . "'";
    }


    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_road_name($get_road_name)
    {
        $this->road_name = $get_road_name;
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

        $get_sql_query = "INSERT INTO wwjm_road_name(road_name,ast,sdt,main_user_login_id) VALUES ("
            . "'" . $this->road_name . "', "
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->main_user_login_id . "');";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update wwjm_road_name set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
