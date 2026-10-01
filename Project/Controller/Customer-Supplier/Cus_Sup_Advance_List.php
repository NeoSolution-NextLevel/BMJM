<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Cus_Sup_Advacne_List
{

    private $pagination_data_result;
    private $company_data;

    public function __construct()
    {
        $this->company_data = new Company_Info_Variable_List();
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = "LIMIT " . $start_point . ", " . $per_page_data_count;
    }

    private $id_search;

    public function set_id($get_id)
    {
        $this->id_search = "and id='" . $get_id . "'";
    }

    private $get_sql_query;
    private $seach_data_value = "";
    private $seach_data = "";
    private $state_of_cus_sup_data_value;

    public function isCustomer()
    {
        $this->state_of_cus_sup_data_value = " and cus_state='1'";
    }

    public function isSupplier()
    {
        $this->state_of_cus_sup_data_value = " and sup_state='1'";
    }

    private $due_cus_sup_listing_query;

    public function due_customer_list()
    {
        $this->due_cus_sup_listing_query = " and id in(select cus_sup_list_id from statement_doc_cus_sup_list where statement_doc_id in(select id from statement_doc where ast='1' and finish_staet='1' and due_amount>0 and statement_settings_list_id in (select id from statement_settings_list where ast='1' and payment_recive='1' and active_state='1'))) ";
    }

    private $state_of_acitve = "0";

    public function isActive()
    {
        $this->state_of_acitve = "1";
    }

    public function set_search_data($get_search_data)
    {
        $this->seach_data_value = $get_search_data;
    }

    public function search_from_name()
    {
        $this->seach_data = " and name like '%" . $this->seach_data_value . "%'";
    }

    public function search_from_email()
    {
        $this->seach_data = " and email like '%" . $this->seach_data_value . "%'";
    }

    public function search_from_contact_no()
    {
        $this->seach_data = " and moble_no_for_sms like '%" . $this->seach_data_value . "%'";
    }

    public function count_of_result()
    {
        $this->get_sql_query = "select count(id) from cus_sup_list where ast='1' and active='" . $this->state_of_acitve . "' " . $this->state_of_cus_sup_data_value . $this->seach_data . $this->due_cus_sup_listing_query . " and company_id='" . $this->company_data->get_compnay_id() . "'";
    }

    public function get_result()
    {
        return $this->get_sql_query = "select * from cus_sup_list where ast='1' and active='" . $this->state_of_acitve . "' " . $this->state_of_cus_sup_data_value . $this->seach_data . $this->due_cus_sup_listing_query . " and company_id='" . $this->company_data->get_compnay_id() . "' " . $this->id_search . " order by name ASC  " . $this->pagination_data_result;
    }

    public function process()
    {
        $data_base_obj = new DataBase();
        return $data_base_obj->get_result($this->get_sql_query);
    }
}
