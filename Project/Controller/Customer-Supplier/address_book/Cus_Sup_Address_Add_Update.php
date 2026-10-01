<?php

class Cus_Sup_Address_Add_Update
{

    private $user_id;
    private $cus_sup_id;
    private $sql_query_obj;
    private $sdt;


    public function __construct($get_user_id, $get_cus_sup_id)
    {
        $this->user_id = $get_user_id;
        $this->cus_sup_id = $get_cus_sup_id;
        $this->sdt = date("Y-m-d H:i:s");
    }


    private $state_of_billing_address = "0";
    private $state_of_shipping_address = "0";

    public function isBillingAddress()
    {
        $this->state_of_billing_address = "1";

        //        $this->state_of_shipping_address = "0";
    }

    public function isShippingAddress()
    {
        //        $this->state_of_billing_address = "0";
        $this->state_of_shipping_address = "1";
    }

    private $delivary_id = "0";

    public function set_Delivery_Data($get_delvery_id)
    {
        $this->delivary_id = $get_delvery_id;
    }

    public function get_Delivery_Data()
    {
        return $this->delivary_id;
    }
    // `cus_sup_address_list`(`id`, `a_line_01`, `a_line_02`, `a_line_03`, `street`, `city`, `ast`, `sdt`, 
    // `shipping_ast`, `billing_ast`, `cus_sup_list_id`, `main_user_login_id`, `default_shipping_state`, 
    // `default_billing_state`, `delivary_city_and_changers_id`, `contact_01`, `contact_02`)

    private $aLine01;
    private $aLine02;
    private $aLine03;
    private $street;
    private $city;
    private $error_msg;
    private $error_state = false;
    private $contact_01;
    private $contact_02;

    private $state;
    private $country;
    private $zip_code;
    private $default_billing_state = "0";
    private $default_shipping_state = "0";

    public function get_error()
    {
        return $this->error_msg;
    }

    public function  set_address_extra_data($get_state, $get_country, $get_zip_code)
    {
        $this->state = $get_state;
        $this->country = $get_country;
        $this->zip_code = $get_zip_code;

        $this->sql_query_obj = $this->sql_query_obj . ",state='" . $this->state . "',country='" . $this->country . "',zip_code='" . $this->zip_code . "'";
    }

    public function get_error_state()
    {
        return $this->error_state;
    }

    public function is_default_billing_state()
    {
        $this->default_billing_state = "1";
    }

    private function set_error($get_error)
    {
        if ($get_error == "") {
            $this->error_state = false;
        } else {
            $this->error_state = true;
        }
        $this->error_msg = $get_error;
    }
    public function set_contact_data($get_contact_01, $get_contact_02)
    {
        $this->contact_01 = $get_contact_01;
        $this->contact_02 = $get_contact_02;
        $this->sql_query_obj = $this->sql_query_obj . ",contact_01='" . $this->contact_01 . "',contact_02='" . $this->contact_02 . "'";
    }

    public function set_data($get_aLine_01, $get_aLine_02, $get_aLine_03, $get_street, $get_city)
    {
        $this->aLine01 = $get_aLine_01;
        $this->aLine02 = $get_aLine_02;
        $this->aLine03 = $get_aLine_03;
        $this->street = $get_street;
        $this->city = $get_city;
        $this->sql_query_obj = $this->sql_query_obj . ",a_line_01='" . $this->aLine01 . "',a_line_02='" . $this->aLine02 . "',a_line_03='" . $this->aLine03 . "',street='" . $this->street . "',city='" . $this->city . "'";
    }

    private $address_id;

    public function get_address_id()
    {
        return $this->address_id;
    }





    public function create_new_address()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "INSERT INTO cus_sup_address_list(a_line_01,a_line_02,a_line_03,street,city,ast,sdt,shipping_ast,billing_ast,cus_sup_list_id,main_user_login_id,default_shipping_state,default_billing_state,delivary_city_and_changers_id,contact_01,contact_02,state,country,zip_code) "
            . "VALUES ('" . $this->aLine01 . "','" . $this->aLine02 . "','" . $this->aLine03 . "','" . $this->street . "','" . $this->city . "','1','" . $this->sdt . "','" . $this->state_of_shipping_address . "','" . $this->state_of_billing_address . "','" . $this->cus_sup_id . "','" . $this->user_id . "','" . $this->default_shipping_state . "','" . $this->default_billing_state . "','" . $this->delivary_id . "','" . $this->contact_01 . "','" . $this->contact_02 . "','" . $this->state . "','" . $this->country . "','" . $this->zip_code . "')";

        // echo $get_sql_query;
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());
        $this->address_id = $database_obj->get_id();

        return $state;
    }
    public function set_address_id($get_address_id)
    {
        $this->address_id = $get_address_id;
    }
    private $ast = "1";
    public function remove_data()
    {
        $this->ast = "0";
    }

    public function transfer_to_billing()
    {
        $this->sql_query_obj = $this->sql_query_obj . ",billing_ast='1'";
    }

    public function transfer_to_shipping()
    {
        $this->sql_query_obj = $this->sql_query_obj . ",shipping_ast='1'";
    }

    public function set_new_addreess_todefault_and_all_empty($get_cus_sup_id)
    {
        $database_obj = new DataBase();

        $get_sql_query = "
        UPDATE cus_sup_address_list 
        SET default_shipping_state = 0,
            default_billing_state = 0
        WHERE cus_sup_list_id = '" . $get_cus_sup_id . "'
    ";

        // echo  $get_sql_query;

        $database_obj->get_result($get_sql_query);

        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());


        // mark current as default
        $this->default_shipping_state = "1";
        $this->default_billing_state = "1";


        return $state;
    }

    public function process_update_address()
    {
        $database_obj = new DataBase();
        $get_sql_query = "UPDATE cus_sup_address_list SET ast='" . $this->ast . "'" . $this->sql_query_obj . " WHERE id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());
        return $state;
    }

    public function set_default_address_for_Billing($get_address_id)
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_billing_state='0' where cus_sup_list_id='" . $this->cus_sup_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_billing_state='1' where id='" . $get_address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }

    public function set_default_address_for_shipping($get_address_id)
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_shipping_state='0' where cus_sup_list_id='" . $this->cus_sup_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_shipping_state='1' where id='" . $get_address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }
}
