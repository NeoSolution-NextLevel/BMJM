<?php
class recommended_person_data_LIST{
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
        $get_sql_query = "select " . $this->sql_process_data . " from recommended_person_data where ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }

}