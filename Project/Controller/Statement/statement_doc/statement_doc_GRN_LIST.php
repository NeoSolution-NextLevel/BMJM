<?php

/**
 * GRN-specific list controller for the statement_doc table.
 * Includes join with statement_doc_cus_sup_list to provide supplier IDs.
 */
class statement_doc_GRN_LIST
{
    private $sql_seach_data = "";
    private $sql_process_data = "statement_doc.*, statement_doc_cus_sup_list.cus_sup_list_id";
    private $pagination_data_result = "";
    private $ast = "1";

    // Filter by main user login id
    public function filter_by_main_user_login_id($get_main_user_login_id)
    {
        $this->sql_seach_data .= " AND statement_doc.main_user_login_id = '" . $get_main_user_login_id . "'";
    }

    // Filter by draft state
    public function filter_by_draft_state($get_draft_state)
    {
        $this->sql_seach_data .= " AND statement_doc.draft_state = '" . $get_draft_state . "'";
    }

    // Filter by finish state
    public function filter_by_finish_state($get_finish_state)
    {
        $this->sql_seach_data .= " AND statement_doc.finish_staet = '" . $get_finish_state . "'";
    }

    // Filter by customer/supplier state
    public function filter_by_cus_sup_state($get_cus_sup_state)
    {
        $this->sql_seach_data .= " AND statement_doc.cus_sup_state = '" . $get_cus_sup_state . "'";
    }

    // Search customer/supplier name like
    public function search_by_cus_sup_name($get_cus_sup_name)
    {
        $this->sql_seach_data .= " AND statement_doc.cus_sup_name LIKE '%" . $get_cus_sup_name . "%'";
    }

    // Set pagination limits
    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY statement_doc.id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    public function get_all_data()
    {
        $this->sql_process_data = "statement_doc.*, statement_doc_cus_sup_list.cus_sup_list_id";
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        
        $get_sql_query = "SELECT " . $this->sql_process_data . "
                          FROM statement_doc
                          LEFT JOIN statement_doc_cus_sup_list ON statement_doc.id = statement_doc_cus_sup_list.statement_doc_id
                          WHERE statement_doc.ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        return $data_base_obj->get_result($get_sql_query);
    }
}
