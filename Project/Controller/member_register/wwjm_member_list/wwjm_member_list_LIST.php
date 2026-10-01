<?php 
class wwjm_member_list_LIST {

  private $sql_seach_data;
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast_state = "1";

    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }
     public function get_count_report()
    {
        $this->sql_process_data = " count(id)";
    }

    public function get_dashboard_data()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT m.id, m.name_M, r.road_name, m.monlty_payment, m.approve_level_01_state, m.approve_level_02_state 
                          FROM wwjm_member_list m 
                          LEFT JOIN wwjm_road_name r ON m.wwjm_road_name_id = r.id 
                          WHERE m.ast='" . $this->ast . "'" . $this->sql_seach_data . " 
                          ORDER BY m.id DESC";
        return $data_base_obj->get_result($get_sql_query);
    }
    public function set_ast_state($state)
    {
        $this->ast_state = $state;
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER  BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . "  ";
    }

    private $ast = "1";

    public function remove_list()
    {
        $this->ast = "0";
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "select " . $this->sql_process_data . " from wwjm_member_list where ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}