<?php
class collection_ticket_tiers_SINGLE_DATA
{
    private $id;
    private $ast;
    private $sdt;
    private $price;
    private $total_capacity;
    private $total_sold;
    private $show_on_web;
    private $wwjm_projects_collection_list_id;
    private $main_user_login_id;
    
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM collection_ticket_tiers WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->price = $row['price'];
                $this->total_capacity = $row['total_capacity'];
                $this->total_sold = $row['total_sold'];
                $this->show_on_web = $row['show_on_web'];
                $this->wwjm_projects_collection_list_id = $row['wwjm_projects_collection_list_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
            }
        }
    }

    public function get_state()
    {
        return $this->state_of_data;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_price()
    {
        return $this->price;
    }
    public function get_total_capacity()
    {
        return $this->total_capacity;
    }
    public function get_total_sold()
    {
        return $this->total_sold;
    }
    public function get_show_on_web()
    {
        return $this->show_on_web;
    }
    public function get_wwjm_projects_collection_list_id()
    {
        return $this->wwjm_projects_collection_list_id;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
}
?>
