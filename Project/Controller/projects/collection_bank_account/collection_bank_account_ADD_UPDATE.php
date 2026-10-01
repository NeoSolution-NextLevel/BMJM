<?php
class collection_bank_account_ADD_UPDATE
{
    private $id;
    private $ast = 1;
    private $sdt;
    private $wwjm_projects_collection_list_id;
    private $bank_account_details_id;
    private $main_user_login_id;
    
    private $sql_update_query = "";
    private $error_msg;

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_wwjm_projects_collection_list_id, $get_bank_account_details_id)
    {
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->bank_account_details_id = $get_bank_account_details_id;

        $this->sql_update_query =
            ",wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'" . 
            ",bank_account_details_id='" . $this->bank_account_details_id . "'";
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function remove()
    {
        $this->ast = 0;
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO collection_bank_account
    (ast, sdt, wwjm_projects_collection_list_id, bank_account_details_id, main_user_login_id) 
    VALUES (
        '" . $this->ast . "',
        '" . $this->sdt . "',
        '" . $this->wwjm_projects_collection_list_id . "',
        '" . $this->bank_account_details_id . "',
        '" . $this->main_user_login_id . "'
     );";
     
        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $this->error_msg;
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "UPDATE collection_bank_account SET ast='" . $this->ast . "'" . $this->sql_update_query . " WHERE id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $this->error_msg;
    }
}
?>
