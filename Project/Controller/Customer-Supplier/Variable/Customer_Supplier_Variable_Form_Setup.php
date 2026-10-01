<?php

class Customer_Supplier_Variable_Form_Setup {

    private $sql_adjustment_query;
    private $process_sql = false;

    public function __construct() {
        ;
    }

    public function process_customer_pesonal() {
        $this->sql_adjustment_query = " and cus_need='1' and personal_ac_only='1' and credit_doc='0'";
        $this->process_sql = true;
    }

    public function process_customer_cooperate() {
        $this->sql_adjustment_query = " and cus_need='1' and cooperate_only='1' and credit_doc='0'";
        $this->process_sql = true;
    }

    public function process_customer_presonal_credit() {
        $this->sql_adjustment_query = " and cus_need='1' and personal_ac_only='1' and credit_doc='1'";
        $this->process_sql = true;
    }

    public function process_customer_cooperate_credit() {
        $this->sql_adjustment_query = " and cus_need='1' and cooperate_only='1' and credit_doc='1'";
        $this->process_sql = true;
    }

    public function process_supplier_personal() {
        $this->sql_adjustment_query = " and sup_need='1' and personal_ac_only='1' and credit_doc='0'";
        $this->process_sql = true;
    }

    public function process_supplier_cooperate() {
        $this->sql_adjustment_query = " and sup_need='1' and cooperate_only='1' and credit_doc='0'";
        $this->process_sql = true;
    }
    public function process_supplier_to_customer_personal(){
        $this->sql_adjustment_query=" and cus_need='1' and sup_need='0' and personal_ac_only='1' and credit_doc='0'";
    }
    
     public function process_supplier_to_customer_cooperate(){
        $this->sql_adjustment_query=" and cus_need='1' and sup_need='0' and cooperate_only='1' and credit_doc='0'";
    }
    
     public function process_customer_to_supplier_personal(){
        $this->sql_adjustment_query=" and cus_need='0' and sup_need='1' and personal_ac_only='1' and credit_doc='0'";
    }
    
     public function process_customer_to_supplier_cooperate(){
        $this->sql_adjustment_query=" and cus_need='0' and sup_need='1' and cooperate_only='1' and credit_doc='0'";
    }

//    public function process_supplier_personal_credit() {
//        $this->sql_adjustment_query = "and sup_need='1' and personal_ac_only='1' and credit_doc='1'";
//        $this->process_sql = true;
//    }
//    public function process_supplier_cooperate_credit() {
//        $this->sql_adjustment_query = "and sup_need='1' and cooperate_only='1' and credit_doc='1'";
//        $this->process_sql = true;
//    }

    public function process_get_result() {
        $get_sql_query = "select * from cus_sup_variable_list where ast='1' ";
        $get_sql_query = $get_sql_query . $this->sql_adjustment_query . " ORDER BY order_num ASC";
        $data_base_obj = new DataBase();
        return $data_base_obj->get_result($get_sql_query);
    }
}
