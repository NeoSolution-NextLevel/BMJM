<?php

class statement_doc_cart_data_LIST
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

    // Remove record list view (ast=0)
    public function remove_list()
    {
        $this->ast = "0";
    }

    // Filter by id
    public function filter_by_id($get_id)
    {
        $this->sql_seach_data .= " AND id = '" . $get_id . "'";
    }

    // Filter by statement_doc_id
    public function filter_by_statement_doc_id($get_statement_doc_id)
    {
        $this->sql_seach_data .= " AND statement_doc_id = '" . $get_statement_doc_id . "'";
    }

    // Filter by cart_main_data_list_id
    public function filter_by_cart_main_data_list_id($get_cart_main_data_list_id)
    {
        $this->sql_seach_data .= " AND cart_main_data_list_id = '" . $get_cart_main_data_list_id . "'";
    }

    // Filter by id_to_formate
    public function filter_by_id_to_formate($get_id_to_formate)
    {
        $this->sql_seach_data .= " AND id_to_formate = '" . $get_id_to_formate . "'";
    }

    // Filter by cook_id
    public function filter_by_cook_id($get_cook_id)
    {
        $this->sql_seach_data .= " AND cook_id = '" . $get_cook_id . "'";
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
                          FROM statement_doc_cart_data
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}
