<?php

class statement_doc_cus_sup_list_LIST
{
    private $sql_seach_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast = "1";

    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }

    public function get_count_report()
    {
        $this->sql_process_data = " count(id) ";
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    public function remove_list()
    {
        $this->ast = "0";
    }

    public function filter_by_id($get_id)
    {
        $this->sql_seach_data .= " AND id='" . $get_id . "'";
    }

    public function filter_by_statement_doc_id($get_statement_doc_id)
    {
        $this->sql_seach_data .= " AND statement_doc_id='" . $get_statement_doc_id . "'";
    }

    public function filter_by_cus_sup_list_id($get_cus_sup_list_id)
    {
        $this->sql_seach_data .= " AND cus_sup_list_id='" . $get_cus_sup_list_id . "'";
    }

    public function filter_by_main_user_login_id($get_main_user_login_id)
    {
        $this->sql_seach_data .= " AND main_user_login_id='" . $get_main_user_login_id . "'";
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . "
                          FROM statement_doc_cus_sup_list
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        return $data_base_obj->get_result($get_sql_query);
    }
}
