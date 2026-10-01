<?php
class wwjm_projects_collection_income_expence_type_ADD_UPDATE
{
    private $id;
    private $ast="1";
    private $sdt;
    private $wwjm_projects_collection_list_id;
    private $income_expence_type_id;
    private $sql_update_query = "";

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_wwjm_projects_collection_list_id, $get_income_expence_type_id)
    {
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->income_expence_type_id           = $get_income_expence_type_id;
        $this->sql_update_query =
            "wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'" .
            ",income_expence_type_id='" . $this->income_expence_type_id . "'";
    }
    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function remove()
    {
        $this->ast = "0";
    }

    public function set_wwjm_projects_collection_list_id($get_wwjm_projects_collection_list_id)
    {
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->sql_update_query .= ",wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'";
    }

    public function set_income_expence_type_id($get_income_expence_type_id)
    {
        $this->income_expence_type_id = $get_income_expence_type_id;
        $this->sql_update_query .= ",income_expence_type_id='" . $this->income_expence_type_id . "'";
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO wwjm_projects_collection_income_expence_type
    (wwjm_projects_collection_list_id, income_expence_type_id, sdt, ast) 
    VALUES (
        '" . $this->wwjm_projects_collection_list_id . "',
        '" . $this->income_expence_type_id . "',
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
        $get_sql_query = "update wwjm_projects_collection_income_expence_type set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

         $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
