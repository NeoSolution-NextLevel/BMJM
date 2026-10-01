<?php
class wwjm_projects_collection_list_LIST{
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


    public function filter_by_project_name($get_project_name)
    {
         $this->sql_seach_data .= " AND project_name = '" . $get_project_name . "'";
    }

    public function filter_is_all_person($get_is_all_person)
    {
         $this->sql_seach_data .= " AND is_all_person = '" . $get_is_all_person . "'";
    }

    public function filter_is_members_only($get_is_members_only)
    {
         $this->sql_seach_data .= " AND is_members_only = '" . $get_is_members_only . "'";
    }

    public function filter_is_share_qr($get_is_share_qr)
    {
         $this->sql_seach_data .= " AND is_share_qr = '" . $get_is_share_qr . "'";
    }


    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM wwjm_projects_collection_list 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;


        // echo $get_sql_query;
        return $data_base_obj->get_result($get_sql_query);
    }
}

