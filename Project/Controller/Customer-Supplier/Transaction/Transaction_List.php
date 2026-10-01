<?php

class Transaction_List {

    private $cus_sup_list_id;
    private $company_id;
    private $branch_id;
    private $sql_query;
    private $sql_search_query = "";
    private $pagination_data_result = "";
    private $select_data_setup = "
        sd.id AS doc_id, 
        sd.sdt AS transaction_date, 
        sd.full_Total_amount AS amount, 
        sd.due_amount AS due_amount,
        IFNULL(ss.statement_name, IF(sd.is_invoice=1, 'Invoice', IF(sd.is_grn=1, 'GRN', 'Document'))) AS description, 
        'Document' AS type,
        sd.id AS ref_id
    ";
    private $select_data_setup_payment = "
        pl.id AS doc_id, 
        CONCAT(pl.date, ' ', pl.time) AS transaction_date, 
        pl.amount AS amount, 
        0 AS due_amount,
        'Payment/Receipt' AS description, 
        'Payment' AS type,
        pl.id AS ref_id
    ";
    private $is_count = false;

    public function __construct($get_cus_sup_list_id) {
        $this->cus_sup_list_id = $get_cus_sup_list_id;
        
        $company_data = new Company_Info_Variable_List();
        $this->company_id = $company_data->get_compnay_id();
        $this->branch_id = $company_data->get_branch_id();
    }

    public function get_report_between_date($get_start_date, $get_end_date) {
        $this->sql_search_query .= " AND sdt BETWEEN '" . $get_start_date . " 00:00:00' AND '" . $get_end_date . " 23:59:59' ";
    }
    
    public function get_report_by_search($search_text) {
        if (!empty($search_text)) {
            $this->sql_search_query .= " AND id LIKE '%" . $search_text . "%' ";
        }
    }

    public function set_data_limits($start_point, $per_page_data_count) {
        $this->pagination_data_result = " LIMIT " . $start_point . ", " . $per_page_data_count;
    }

    public function get_count_of_report() {
        $this->select_data_setup = " count(sd.id) AS count ";
        $this->select_data_setup_payment = " count(pl.id) AS count ";
        $this->is_count = true;
    }

    public function process_seach_data() {
        $data_base_obj = new DataBase();
        
        $doc_search_query = str_replace("sdt", "sd.sdt", $this->sql_search_query);
        $pay_search_query = str_replace("sdt", "CONCAT(pl.date, ' ', pl.time)", $this->sql_search_query);

        $query1 = "
            SELECT " . $this->select_data_setup . "
            FROM statement_doc sd
            LEFT JOIN statement_settings_list ss ON sd.statement_settings_list_id = ss.id
            WHERE sd.id IN (SELECT statement_doc_id FROM statement_doc_cus_sup_list WHERE cus_sup_list_id = '" . $this->cus_sup_list_id . "' AND ast='1') 
              AND sd.ast = '1' 
              AND sd.company_id = '" . $this->company_id . "' 
              AND sd.branch_id = '" . $this->branch_id . "'
              " . $doc_search_query . "
        ";
        
        $query2 = "
            SELECT " . $this->select_data_setup_payment . "
            FROM statement_doc_payment_listing pl
            JOIN statement_doc_payment_listing_cus_sup_data pcl ON pl.id = pcl.statement_doc_payment_listing_id
            WHERE pcl.cus_sup_list_id = '" . $this->cus_sup_list_id . "' 
              AND pl.ast = '1' 
              AND (pl.company_id = '" . $this->company_id . "' OR pl.company_id = '' OR pl.company_id IS NULL)
              AND (pl.branch_id = '" . $this->branch_id . "' OR pl.branch_id = '' OR pl.branch_id IS NULL)
              " . $pay_search_query . "
        ";
        
        if ($this->is_count) {
            $this->sql_query = "SELECT SUM(count) as total_count FROM (" . $query1 . " UNION ALL " . $query2 . ") as combined_counts";
        } else {
            $this->sql_query = "(" . $query1 . ") UNION ALL (" . $query2 . ") ORDER BY transaction_date DESC, doc_id DESC " . $this->pagination_data_result;
        }
        
        $result = $data_base_obj->get_result($this->sql_query);
        if (!$result) {
            error_log("SQL Error in Transaction_List: " . $data_base_obj->get_error());
        }
        return $result;
    }
}
?>
