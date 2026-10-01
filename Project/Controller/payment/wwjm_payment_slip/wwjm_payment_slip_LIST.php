<?php

class wwjm_payment_slip_LIST
{

    private $sql_seach_data;
    private $sql_process_data = "*";
    private $pagination_data_result;

    private $sql_query = "";
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


    public function filter_by_membership_no($get_membership_no)
    {
        $this->sql_seach_data .= " AND membership_no = '" . $get_membership_no . "'";
    }

    public function filter_by_wwjm_member_list_id($get_member_id)
    {
        $this->sql_seach_data .= " AND (id IN (SELECT wwjm_payment_slip_id FROM wwjm_member_payment_slilp WHERE wwjm_member_list_id = '" . $get_member_id . "') OR (membership_no IS NOT NULL AND membership_no != '' AND membership_no = (SELECT membership_no FROM wwjm_member_list WHERE id = '" . $get_member_id . "')))";
    }


    public function filter_by_is_bank_deposit()
    {
        $this->sql_seach_data .= " AND is_bank_deposit = 1";
    }

    public function filter_by_bank_review_status($get_status)
    {
        $status = strtolower(trim($get_status));
        if ($status === 'pending') {
            $this->sql_seach_data .= " AND is_bank_deposit=1 AND EXISTS (SELECT id FROM wwjm_bank_deposit_slip WHERE wwjm_payment_slip_id=wwjm_payment_slip.id AND ast='1' AND approve_state='0' AND approve_cancel='0')";
        } else if ($status === 'approved') {
            $this->sql_seach_data .= " AND is_bank_deposit=1 AND EXISTS (SELECT id FROM wwjm_bank_deposit_slip WHERE wwjm_payment_slip_id=wwjm_payment_slip.id AND ast='1' AND approve_state='1' AND approve_cancel='0')";
        } else if ($status === 'rejected') {
            $this->sql_seach_data .= " AND is_bank_deposit=1 AND EXISTS (SELECT id FROM wwjm_bank_deposit_slip WHERE wwjm_payment_slip_id=wwjm_payment_slip.id AND ast='1' AND approve_cancel='1')";
        }
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


    // --- PASTE THIS FUNCTION INSIDE YOUR CLASS ---

    public function filter_by_project_id($get_project_id)
    {
        // This REPLACES the base query with a JOIN query
        // It connects 'wwjm_payment_slip' (A) with 'wwjm_projects_collection_payment_slip' (B)
        // WHERE B.project_id = YOUR_ID

        $this->sql_query = "SELECT wwjm_payment_slip.* FROM wwjm_payment_slip 
                            INNER JOIN wwjm_projects_collection_payment_slip 
                            ON wwjm_payment_slip.id = wwjm_projects_collection_payment_slip.wwjm_payment_slip_id 
                            WHERE wwjm_projects_collection_payment_slip.wwjm_projects_collection_list_id = '" . $get_project_id . "' 
                            AND wwjm_payment_slip.ast='1' ";
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
                          FROM wwjm_payment_slip 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        return $data_base_obj->get_result($get_sql_query);
    }
}
