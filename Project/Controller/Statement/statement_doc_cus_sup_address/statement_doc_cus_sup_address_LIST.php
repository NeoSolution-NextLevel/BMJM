<?php

class statement_doc_cus_sup_address_LIST
{
    private $sql_seach_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast = "1";

    // Get all columns
    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }

    // Get count of rows
    public function get_count_report()
    {
        $this->sql_process_data = " count(id) ";
    }

    // Set pagination limits
    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    // Remove record list (ast=0)
    public function remove_list()
    {
        $this->ast = "0";
    }

    // Filter by id
    public function filter_by_id($get_id)
    {
        $this->sql_seach_data .= " AND id = '" . $get_id . "'";
    }

    // Filter by statement
    public function filter_by_statement($get_statement)
    {
        $this->sql_seach_data .= " AND statement = '" . $get_statement . "'";
    }

    // Search by statement like
    public function search_by_statement($get_statement)
    {
        $this->sql_seach_data .= " AND statement LIKE '%" . $get_statement . "%'";
    }

    // Filter by statement_doc_id
    public function filter_by_statement_doc_id($get_statement_doc_id)
    {
        $this->sql_seach_data .= " AND statement_doc_id = '" . $get_statement_doc_id . "'";
    }

    // Filter by main_user_login_id
    public function filter_by_main_user_login_id($get_main_user_login_id)
    {
        $this->sql_seach_data .= " AND main_user_login_id = '" . $get_main_user_login_id . "'";
    }

    // Filter by cus_sup_address_list_id
    public function filter_by_cus_sup_address_list_id($get_cus_sup_address_list_id)
    {
        $this->sql_seach_data .= " AND cus_sup_address_list_id = '" . $get_cus_sup_address_list_id . "'";
    }

    // Filter by sdt
    public function filter_by_sdt($get_sdt)
    {
        $this->sql_seach_data .= " AND sdt = '" . $get_sdt . "'";
    }

    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . "
                          FROM statement_doc_cus_sup_address
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}
