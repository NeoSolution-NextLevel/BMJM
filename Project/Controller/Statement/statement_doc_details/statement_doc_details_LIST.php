<?php

class statement_doc_details_LIST
{

    private $statement_id;
    private $search_value;

    public function __construct($get_statement_id)
    {
        $this->statement_id = $get_statement_id;
    }

    public function search_value($get_value)
    {
        $this->search_value = $get_value;
    }

    public function seach_from_name()
    {
        $this->sql_search_query_update = " and heading_data LIKE '%" . $this->search_value . "%'";
    }

    public function search_from_finish_list()
    {
        $this->sql_search_query_update = "";
    }

    public function get_result_with_main_image()
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "
        SELECT 
            sdd.*,
            isl.main_image
        FROM statement_doc_details sdd
        LEFT JOIN item_serivice_list_info_data islid 
            ON sdd.item_id = islid.id
        LEFT JOIN item_serivice_list isl 
            ON islid.item_serivice_list_id = isl.id
        WHERE sdd.ast='1' 
            " . $this->sql_search_query_update . "
            AND sdd.statement_doc_id='" . $this->statement_id . "'
    ";

        return $data_base_obj->get_result($get_sql_query);
    }

    private $sql_search_query_update = "";

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "select * from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        return $data_base_obj->get_result($get_sql_query);
    }

    public function get_count()
    {
        $get_value = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select count(id) from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_value = $row['count(id)'];
            }
        }
        return $get_value;
    }

    public function get_Gross_Amount()
    {
        $get_value = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select sum(total) from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result && $get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_value = $row['sum(total)'] ?? "0";
            }
        }
        return $get_value ?? "0";
    }

    public function get_Line_Discount_Amount()
    {
        $get_value = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select sum(line_discount_total) from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_value = $row['sum(line_discount_total)'];
                // echo "----" . $get_value . "---line disoucnt---";
            }
        }
        return $get_value;
    }

    public function get_Default_Discount_Amount()
    {
        $get_value = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select sum(default_default_total) from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_value = $row['sum(default_default_total)'];
                // echo "----" . $get_value . "---agent disoucnt---";
            }
        }
        return $get_value;
    }

    public function get_total_Discount_Amount()
    {
        $get_value = "0";
        $data_base_obj = new DataBase();
        $get_sql_query = "select sum(total_disoucnt) from statement_doc_details where ast='1' " . $this->sql_search_query_update . " and statement_doc_id='" . $this->statement_id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        if ($get_result && $get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $get_value = $row['sum(total_disoucnt)'] ?? "0";
            }
        }
        return $get_value ?? "0";
    }
}
