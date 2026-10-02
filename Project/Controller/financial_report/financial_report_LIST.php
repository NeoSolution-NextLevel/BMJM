<?php

class financial_report_LIST
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
        $this->sql_process_data = " count(id) ";
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    public function order_by_date_asc()
    {
        $this->pagination_data_result = " ORDER BY sdt ASC ";
    }

    public function filter_by_is_type_of_income()
    {
        $this->sql_seach_data .= " AND is_type_of_income = 1";
    }

    public function filter_by_is_type_of_expence()
    {
        $this->sql_seach_data .= " AND is_type_of_expence = 1";
    }

    public function filter_by_income_expence_type_id($get_income_expence_type_id)
    {
        $this->sql_seach_data .= " AND income_expence_type_id = '" . $get_income_expence_type_id . "'";
    }

    public function filter_by_date_range($start_date, $end_date)
    {
        $this->sql_seach_data .= " AND DATE(sdt) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
    }

    public function filter_by_year($year)
    {
        $this->sql_seach_data .= " AND YEAR(sdt) = '" . intval($year) . "'";
    }

    public function filter_by_month($month)
    {
        $this->sql_seach_data .= " AND MONTH(sdt) = '" . intval($month) . "'";
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT " . $this->sql_process_data . "
                          FROM income_expence_data_info_list
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;

        return $data_base_obj->get_result($get_sql_query);
    }
}
