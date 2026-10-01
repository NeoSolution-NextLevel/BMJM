<?php
class collection_bank_account_LIST {
    private $sql_search_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result = "";
    private $ast = 1;

    public function get_all_data() { $this->sql_process_data = "*"; }
    public function get_count_report() { $this->sql_process_data = " count(id) "; }

    public function set_data_limits($start_point, $per_page_data_count) {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    public function filter_by_wwjm_projects_collection_list_id($val) {
         $this->sql_search_data .= " AND wwjm_projects_collection_list_id = '" . $val . "'";
    }
    
    public function filter_by_bank_account_details_id($val) {
         $this->sql_search_data .= " AND bank_account_details_id = '" . $val . "'";
    }

    public function remove_list() { $this->ast = 0; }

    public function get_result() {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM collection_bank_account 
                          WHERE ast='" . $this->ast . "'" . $this->sql_search_data . $this->pagination_data_result;
        return $data_base_obj->get_result($get_sql_query);
    }
}
?>
