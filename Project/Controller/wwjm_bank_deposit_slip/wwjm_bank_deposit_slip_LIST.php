<?php

class wwjm_bank_deposit_slip_LIST
{

    private $sql_seach_data;
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

    public function filter_by_wwjm_payment_slip_id($get_payment_slip_id)
    {
        $this->sql_seach_data .= " AND wwjm_payment_slip_id='" . $get_payment_slip_id . "'";
    }

    public function filter_by_pending_review()
    {
        $this->sql_seach_data .= " AND approve_state='0' AND approve_cancel='0'";
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

    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM wwjm_bank_deposit_slip 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        return $data_base_obj->get_result($get_sql_query);
    }
}
