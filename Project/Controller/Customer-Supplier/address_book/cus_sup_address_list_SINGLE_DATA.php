<?php

class Cus_Sup_Address_List_SINGLE_DATA
{
    private $id;
    private $a_line_01;
    private $a_line_02;
    private $a_line_03;
    private $street;
    private $city;
    private $ast;
    private $sdt;
    private $shipping_ast;
    private $billing_ast;
    private $cus_sup_list_id;
    private $main_user_login_id;
    private $default_shipping_state;
    private $default_billing_state;
    private $delivary_city_and_changers_id;
    private $contact_01;
    private $contact_02;

    private $state;

    public function __construct($get_id)
    {
        $this->id = $get_id;
        $database_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_address_list where id='" . $this->id . "'";
        $get_result = $database_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->a_line_01 = $row['a_line_01'];
                $this->a_line_02 = $row['a_line_02'];
                $this->a_line_03 = $row['a_line_03'];
                $this->street = $row['street'];
                $this->city = $row['city'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->shipping_ast = $row['shipping_ast'];
                $this->billing_ast = $row['billing_ast'];
                $this->cus_sup_list_id = $row['cus_sup_list_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->default_shipping_state = $row['default_shipping_state'];
                $this->default_billing_state = $row['default_billing_state'];
                $this->delivary_city_and_changers_id = $row['delivary_city_and_changers_id'];
                $this->contact_01 = $row['contact_01'];
                $this->contact_02 = $row['contact_02'];
                $this->state = true;
            }
        } else {
            $this->state = false;
        }
    }

    public function get_state()
    {
        return $this->state;
    }

    public function get_a_line_01()
    {
        return $this->a_line_01;
    }

    public function get_a_line_02()
    {
        return $this->a_line_02;
    }

    public function get_a_line_03()
    {
        return $this->a_line_03;
    }

    public function get_street()
    {
        return $this->street;
    }

    public function get_city()
    {
        return $this->city;
    }

    public function get_ast()
    {
        return $this->ast;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_shipping_ast()
    {
        return $this->shipping_ast;
    }

    public function get_billing_ast()
    {
        return $this->billing_ast;
    }

    public function get_cus_sup_list_id()
    {
        return $this->cus_sup_list_id;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_default_shipping_state()
    {
        return $this->default_shipping_state;
    }

    public function get_default_billing_state()
    {
        return $this->default_billing_state;
    }

    public function get_delivary_city_and_changers_id()
    {
        return $this->delivary_city_and_changers_id;
    }

    public function get_contact_01()
    {
        return $this->contact_01;
    }

    public function get_contact_02()
    {
        return $this->contact_02;
    }

    public function get_id()
    {
        return $this->id;
    }



    // `cus_sup_address_list`(`id`, `a_line_01`, `a_line_02`, `a_line_03`, `street`, `city`, `ast`, `sdt`, `shipping_ast`,
    // `billing_ast`, `cus_sup_list_id`, `main_user_login_id`,
    //  `default_shipping_state`, `default_billing_state`, `delivary_city_and_changers_id`, `contact_01`, `contact_02`) 
}
