<?php

class bank_account_details_LIST
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


    public function filter_by_ac_no($get_ac_no)
    {
        $this->sql_seach_data .= " AND ac_no = '" . $get_ac_no . "'";
    }

    public function filter_by_id_not($get_id)
    {
        $this->sql_seach_data .= " AND id != '" . (int) $get_id . "'";
    }


    // public function search_from_road_name($get_like_road_name)
    // {
    //     $this->sql_seach_data .= " AND road_name LIKE '%" . $get_like_road_name . "%'";
    //     // echo $get_like_road_name;
    // }

    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM bank_account_details 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;


        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}
