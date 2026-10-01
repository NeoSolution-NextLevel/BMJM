<?php

class Cus_Sup_Address_State_Change
{

    private $address_id;
    private $cus_sup_id;

    public function __construct($get_address_id)
    {
        $this->address_id = $get_address_id;
        $this->get_cus_sup_get_info();
    }

    private function get_cus_sup_get_info()
    {
        $database_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_address_list where id='" . $this->address_id . "'";
        $get_result = $database_obj->get_result($get_sql_query);
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->cus_sup_id = $row['cus_sup_list_id'];
            }
        }
    }

    private $error_message;

    private function set_error($get_error_msg)
    {
        $this->error_message = $get_error_msg;
    }

    public function get_error()
    {
        return $this->error_message;
    }

    public function set_default_address_for_Billing()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_billing_state='0' where cus_sup_list_id='" . $this->cus_sup_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_billing_state='1' where id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }

    public function set_default_address_for_shipping()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_shipping_state='0' where cus_sup_list_id='" . $this->cus_sup_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set default_shipping_state='1' where id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }

    public function transfer_billing_to_shipping_state()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set shipping_ast='1' where id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $this->set_default_address_for_shipping();

        return $state;
    }

    public function transfer_shipping_to_billing_state()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set billing_ast='1' where id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        $this->set_default_address_for_Billing();

        return $state;
    }

    public function remove_billing()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set billing_ast='0' where id='" . $this->address_id . "'";
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }

    public function remove_shipping()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set shipping_ast='0' where id='" . $this->address_id . "'";
        echo  $get_sql_query;
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }

    public function remove_full_address()
    {
        $state = false;

        $database_obj = new DataBase();
        $get_sql_query = "update cus_sup_address_list set ast='0' where id='" . $this->address_id . "'";
        // echo  $get_sql_query;
        $database_obj->get_result($get_sql_query);
        $state = $database_obj->get_error_state_boolean();
        $this->set_error($database_obj->get_error());

        return $state;
    }
}
