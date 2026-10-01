<?php

class statement_doc_ipg_list_LIST
{
    private $sql_seach_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast = "1";

    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }
    public function get_count_report()
    {
        $this->sql_process_data = "count(id)";
    }

    public function set_data_limits($start, $count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start . ", " . $count;
    }

    public function remove_list()
    {
        $this->ast = "0";
    }

    public function filter_by_statement_doc_id($val)
    {
        $this->sql_seach_data .= " AND statement_doc_id='" . $val . "'";
    }
    public function filter_by_ipg_transaction_id($val)
    {
        $this->sql_seach_data .= " AND ipg_transaction_id='" . $val . "'";
    }
    public function filter_by_success_tranaction($val)
    {
        $this->sql_seach_data .= " AND success_tranaction='" . $val . "'";
    }

    public function get_result()
    {
        $db = new DataBase();
        $sql = "SELECT " . $this->sql_process_data . "
                FROM statement_doc_ipg_list
                WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        return $db->get_result($sql);
    }
}
