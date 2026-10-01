<?php

class income_expence_type_LIST
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

    // Remove record (set ast=0)
    public function remove_list()
    {
        $this->ast = "0";
    }

    public function filter_by_id($get_id)
    {
        $this->sql_seach_data .= " AND id = '" . $get_id . "'";
    }

    public function filter_by_is_income_type()
    {
        $this->sql_seach_data .= " AND is_income_type = 1";
    }

    public function filter_by_is_expece_type()
    {
        $this->sql_seach_data .= " AND is_expece_type = 1";
    }


    public function filter_by_income_expence_type_name($get_income_expence_type_name)
    {
        $this->sql_seach_data .= " AND income_expence_type_name LIKE '%" . $get_income_expence_type_name . "%'";
    }


    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM income_expence_type 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;



        return $data_base_obj->get_result($get_sql_query);
    }
}
