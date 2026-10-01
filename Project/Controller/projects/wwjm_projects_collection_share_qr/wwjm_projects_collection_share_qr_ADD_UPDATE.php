<?php
class wwjm_projects_collection_share_qr_ADD_UPDATE
{
    private $id;
    private $ast = "1";
    private $sdt;
    private $sec_id;
    private $is_active = 0 ;
    private $wwjm_projects_collection_list_id;
    private $sql_update_query = "";

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_sec_id, $get_wwjm_projects_collection_list_id)
    {
        $this->sec_id = $get_sec_id;
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->sql_update_query =
            "sec_id='" . $this->sec_id . "'" .
            ",wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'";

    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function get_id()
    {
        return $this->id;
    }
   

    public function set_sec_id($get_sec_id)
    {
        $this->sec_id = $get_sec_id;
        $this->sql_update_query.= ",sec_id='" . $this->sec_id . "'";
    }

    public function set_wwjm_projects_collection_list_id($get_wwjm_projects_collection_list_id)
    {
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->sql_update_query.= ",wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'";
    }

    public function is_is_active()
    {
        $this->is_active = 1;
        $this->sql_update_query .= ",is_active='" . $this->is_active . "'";
    }
    public function is_not_is_active()
    {
        $this->is_active = 0;
         $this->sql_update_query .= ",is_active='" . $this->is_active . "'";
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

        $get_sql_query = "INSERT INTO wwjm_projects_collection_share_qr
    (sec_id, wwjm_projects_collection_list_id, sdt, ast) 
    VALUES (
        '" . $this->sec_id . "',
        '" . $this->wwjm_projects_collection_list_id . "',
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
        $get_sql_query = "update wwjm_projects_collection_share_qr set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}