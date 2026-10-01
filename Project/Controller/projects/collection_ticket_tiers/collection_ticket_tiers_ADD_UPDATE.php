<?php
class collection_ticket_tiers_ADD_UPDATE
{
    private $id;
    private $ast = 1;
    private $sdt;
    private $price;
    private $total_capacity;
    private $total_sold = 0;
    private $show_on_web = 1;
    private $wwjm_projects_collection_list_id;
    private $main_user_login_id;
    
    private $sql_update_query = "";
    private $error_msg;

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_wwjm_projects_collection_list_id, $get_price, $get_total_capacity)
    {
        $this->wwjm_projects_collection_list_id = $get_wwjm_projects_collection_list_id;
        $this->price = $get_price;
        $this->total_capacity = $get_total_capacity; // CAN BE EMPTY FOR NULL

        $cap_sql = ($this->total_capacity == "") ? "NULL" : "'" . $this->total_capacity . "'";

        $this->sql_update_query =
            ",wwjm_projects_collection_list_id='" . $this->wwjm_projects_collection_list_id . "'" . 
            ",price='" . $this->price . "'" .
            ",total_capacity=" . $cap_sql;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_total_sold($qty)
    {
        $this->total_sold = $qty;
        $this->sql_update_query .= ",total_sold='" . $this->total_sold . "'";
    }

    public function set_total_sold_increment($qty)
    {
        $this->sql_update_query .= ",total_sold = COALESCE(total_sold, 0) + " . intval($qty);
    }

    public function set_wwjm_projects_collection_list_id($val){
        $this->wwjm_projects_collection_list_id = $val;
        $this->sql_update_query .= ",wwjm_projects_collection_list_id='" . $val . "'";
    }

    public function set_price($val){
        $this->price = $val;
        $this->sql_update_query .= ",price='" . $val . "'";
    }
    
    public function is_show_on_web()
    {
        $this->show_on_web = 1;
        $this->sql_update_query .= ",show_on_web='" . $this->show_on_web . "'";
    }

    public function is_not_show_on_web()
    {
        $this->show_on_web = 0;
        $this->sql_update_query .= ",show_on_web='" . $this->show_on_web . "'";
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
        
        $cap_val = ($this->total_capacity == "") ? "NULL" : "'" . $this->total_capacity . "'";

        $get_sql_query = "INSERT INTO collection_ticket_tiers
    (ast, sdt, price, total_capacity, total_sold, show_on_web, wwjm_projects_collection_list_id, main_user_login_id) 
    VALUES (
        '" . $this->ast . "',
        '" . $this->sdt . "',
        '" . $this->price . "',
        " . $cap_val . ",
        '" . $this->total_sold . "',
        '" . $this->show_on_web . "',
        '" . $this->wwjm_projects_collection_list_id . "',
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
        $get_sql_query = "UPDATE collection_ticket_tiers SET ast='" . $this->ast . "'" . $this->sql_update_query . " WHERE id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $this->error_msg;
    }
}
?>