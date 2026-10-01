<?php

class wwjm_payment_slip_LIST
{
    private $sql_seach_data = "";
    // CHANGED: Use qualified wildcard to avoid join collisions
    private $sql_process_data = "wwjm_payment_slip.*"; 
    private $pagination_data_result = "";
    private $ast = "1";
    
    // NEW: Variable to hold JOIN clauses
    private $join_query = ""; 

    // Get all columns
    public function get_all_data()
    {
        $this->sql_process_data = "wwjm_payment_slip.*";
    }

    // Get count of rows
    public function get_count_report()
    {
        // CHANGED: Count specific table ID
        $this->sql_process_data = " count(wwjm_payment_slip.id) "; 
    }

    public function filter_by_membership_no($get_membership_no)
    {
        $this->sql_seach_data .= " AND membership_no = '" . $get_membership_no . "'";
    }

    public function filter_by_is_bank_deposit()
    {
        $this->sql_seach_data .= " AND is_bank_deposit = 1";
    }

    public function filter_by_is_IPG()
    {
        $this->sql_seach_data .= " AND is_IPG = 1";
    }
    
    public function filter_by_is_cash()
    {
        $this->sql_seach_data .= " AND is_cash = 1";
    }

    public function filter_by_pay_resion_subcption()
    {
        $this->sql_seach_data .= " AND pay_resion_subcption = 1";
    }

    public function filter_by_pay_resion_donation()
    {
        $this->sql_seach_data .= " AND pay_resion_donation = 1";
    }

    public function filter_by_pay_resion_zakath()
    {
        $this->sql_seach_data .= " AND pay_resion_zakath = 1";
    }
    
    public function filter_by_date_range($start_date, $end_date)
    {
        if (!empty($start_date) && !empty($end_date)) {
            $this->sql_seach_data .= " AND payment_date BETWEEN '$start_date' AND '$end_date'";
        }
    }

    public function filter_by_pay_resion_projects()
    {
        $this->sql_seach_data .= " AND pay_resion_projects = 1";
    }

    // --- UPDATED PROJECT FILTER FUNCTION ---
    public function filter_by_project_id($get_project_id)
    {
        // 1. Add the JOIN clause
        $this->join_query = " INNER JOIN wwjm_projects_collection_payment_slip 
                              ON wwjm_payment_slip.id = wwjm_projects_collection_payment_slip.wwjm_payment_slip_id ";
        
        // Add the WHERE clause for the Project ID
        // Note: We use the linking table's column
        $this->sql_seach_data .= " AND wwjm_projects_collection_payment_slip.wwjm_projects_collection_list_id = '" . $get_project_id . "'";
    }

    // Set pagination limits
    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY wwjm_payment_slip.id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    public function remove_list()
    {
        $this->ast = "0";
    }

    // --- UPDATED GET RESULT FUNCTION ---
    public function get_result()
    {
        $data_base_obj = new DataBase();
        
        // Construct Query: SELECT [cols] FROM [table] [JOINs] WHERE [conds]
        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM wwjm_payment_slip " . 
                          $this->join_query . 
                          " WHERE wwjm_payment_slip.ast='" . $this->ast . "'" . 
                          $this->sql_seach_data . 
                          $this->pagination_data_result;
                          
        return $data_base_obj->get_result($get_sql_query);
    }
}
?>