<?php

class cus_sup_list_LIST
{

    private $compnany_obj;
    private $company_id;
    private $get_sql_query;
    private $error_message;

    private $sql_heads = "*";
    private $pagination_data_result;
    private $ast_state = "1";

    public function __construct()
    {
        $this->compnany_obj = new Company_Info_Variable_List();
        $this->company_id = $this->compnany_obj->get_compnay_id();
    }

    public function check_email_is_exist($get_email)
    {
        $this->get_sql_query = $this->get_sql_query . " and email='" . $get_email . "'";
    }
    public function check_phone_no_is_exist($get_phone_no)
    {
        $this->get_sql_query = $this->get_sql_query . " and phone_no='" . $get_phone_no . "'";
    }



    public function set_search_name($get_search_name)
    {
        $this->get_sql_query = $this->get_sql_query . " and name like '%" . $get_search_name . "%'";
    }
    public function set_search_short_name($get_search_short_name)
    {
        $this->get_sql_query = $this->get_sql_query . " and short_name like '%" . $get_search_short_name . "%'";
    }
    public function set_search_email($get_search_email)
    {
        $this->get_sql_query = $this->get_sql_query . " and email like '%" . $get_search_email . "%'";
    }
    public function set_search_phone_no($get_search_phone_no)
    {
        $this->get_sql_query = $this->get_sql_query . " and phone_no like '%" . $get_search_phone_no . "%'";
    }

    public function is_customer()
    {
        $this->get_sql_query = $this->get_sql_query . " and cus_state='1' and sup_state='0'";
    }
    public function is_supplier()
    {
        $this->get_sql_query = $this->get_sql_query . " and cus_state='0' and sup_state='1'";
    }
    public function is_self_account()
    {
        $this->get_sql_query = $this->get_sql_query . " and self_account='1'";
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = "ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . "  ";
    }
    public function get_count_of_report()
    {
        $this->sql_heads = " count(id) ";
    }
    public function get_report_between_date($get_start_date, $get_end_date)
    {
        $get_start_date = $get_start_date . " 00:00:00";
        $get_end_date = $get_end_date . " 23:59:59";

        $this->get_sql_query = $this->get_sql_query . "and sdt BETWEEN '" . $get_start_date . "' AND '" . $get_end_date . "' ";
    }

    public function filter_related_cart_main_data_list_customer_details($get_cart_main_data_list_id)
    {
        $this->get_sql_query = $this->get_sql_query . " and id IN (SELECT cus_sup_list_id FROM cus_sup_list_has_cart_main_data_list WHERE cart_main_data_list_id='" . $get_cart_main_data_list_id . "')";
    }


    public function get_result()
    {
        $data_base_obj = new DataBase();
        $this->get_sql_query = "select " . $this->sql_heads . " from cus_sup_list where ast='" . $this->ast_state . "' and company_id='" . $this->company_id . "'" . $this->get_sql_query . " " . $this->pagination_data_result;
        // echo $this->get_sql_query;
        return $data_base_obj->get_result($this->get_sql_query);
    }
}
