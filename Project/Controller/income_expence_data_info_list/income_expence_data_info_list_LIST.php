<?php

class income_expence_data_info_list_LIST
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

    public function filter_by_is_type_of_income()
    {
        $this->sql_seach_data .= " AND is_type_of_income = 1";
    }

    public function filter_by_date_range($start_date, $end_date)
    {

        $this->sql_seach_data .= " AND DATE(sdt) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
    }


    public function filter_by_is_type_of_expence()
    {
        $this->sql_seach_data .= " AND is_type_of_expence = 1";
    }

    public function filter_by_dis($get_dis)
    {
        $this->sql_seach_data .= " AND dis = '" . $get_dis . "'";
    }


    public function filter_by_income_expence_data_id($get_income_expence_data_id)
    {
        $this->sql_seach_data .= " AND income_expence_data_id = '" . $get_income_expence_data_id . "'";
    }

    public function filter_by_income_expence_type_id($get_income_expence_type_id)
    {
        $this->sql_seach_data .= " AND income_expence_type_id = '" . $get_income_expence_type_id . "'";
    }
    // Get result array from database
    public function get_result(): bool|mysqli_result
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM income_expence_data_info_list 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}
