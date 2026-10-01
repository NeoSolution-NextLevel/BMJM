<?php

class Cus_Sup_Address_List
{
    private $cus_sup_id;
    private $join_query = "";
    private $get_sql_query = "";

    private $state_billing_listing = "";
    private $state_shipping_listing = "";

    public function __construct($get_cus_sup_id)
    {
        $this->cus_sup_id = $get_cus_sup_id;
    }

    public function is_Billing_Address_Listing()
    {
        $this->state_billing_listing = " and billing_ast='1'";
    }

    public function is_default_Billing_Address_Listing()
    {
        $this->state_billing_listing = " and billing_ast='1' and default_billing_state='1'";
    }

    public function is_non_default_Billing_Address_Listing()
    {
        $this->state_billing_listing = " and billing_ast='1' and default_billing_state='0'";
    }

    public function is_Shipping_Address_Listing()
    {
        $this->state_shipping_listing = " and shipping_ast='1'";
    }

    public function is_default_Shipping_Address_Listing()
    {
        $this->state_shipping_listing = " and shipping_ast='1' and default_shipping_state='1'";
    }

    public function is_non_default_Shipping_Address_Listing()
    {
        $this->state_shipping_listing = " and shipping_ast='1' and default_shipping_state='0'";
    }

    public function get_cus_sup_address_related_cart_main_data_list_id($get_cart_main_data_list_id)
    {
        $this->join_query = " and id IN (
            SELECT cus_sup_address_list_id 
            FROM cus_sup_address_list_has_cart_main_data_list 
            WHERE cart_main_data_list_id='" . $get_cart_main_data_list_id . "'
        )";
    }


    public function get_cus_sup_address_related_statement_doc_id($get_statement_doc_id)
    {
        $this->join_query = " and id IN (
            SELECT cus_sup_address_list_id 
            FROM statement_doc_cus_sup_address 
            WHERE statement_doc_id='" . $get_statement_doc_id . "'
        )";
    }

    public function process()
    {
        $data_base_obj = new DataBase();

        $this->get_sql_query = "select * from cus_sup_address_list 
            where ast='1' 
            and cus_sup_list_id='" . $this->cus_sup_id . "' "
            . $this->state_billing_listing
            . $this->state_shipping_listing
            . $this->join_query . "
            ORDER BY id DESC";

        // echo $this->get_sql_query;

        return $data_base_obj->get_result($this->get_sql_query);
    }

    public function __destruct()
    {
        $this->state_billing_listing = "";
        $this->state_shipping_listing = "";
        $this->join_query = "";
    }

    public function get_sql()
    {
        return $this->get_sql_query;
    }
}
