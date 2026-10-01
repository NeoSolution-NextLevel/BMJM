<?php

class Cus_Sup_Contact_Person_Add {

    private $user_id;
    private $cus_sup_id;
    private $compnay_obj;

    public function __construct($get_user_id, $cus_sup_id) {
        $this->user_id = $get_user_id;
        $this->cus_sup_id = $cus_sup_id;
        $this->compnay_obj = new Company_Info_Variable_List();
    }

    private $name;
    private $email;
    private $mobile_no;

    public function set_data($get_name, $get_email, $get_mobile_no) {
        $this->name = $get_name;
        $this->email = $get_email;
        $this->mobile_no = $get_mobile_no;
    }

    private $error_msg;

    public function get_error() {
        return $this->error_msg;
    }

    private function set_error($get_error_msg) {
        $this->error_msg = $get_error_msg;
    }

    private function check_email() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_contact_person where cus_sup_list_id='" . $this->cus_sup_id . "' and company_id='" . $this->compnay_obj->get_compnay_id() . "' and email='" . $this->email . "'";
        $result_set = $data_base_obj->get_result($get_sql_query);
        if ($result_set->num_rows > 0) {
            $state = false;
            $this->set_error("Email is already in use");
        } else {
            $state = true;
        }
        return $state;
    }

    private function check_moblie_no() {
        $state = false;
        $data_base_obj = new DataBase();
        $get_sql_query = "select * from cus_sup_contact_person where cus_sup_list_id='" . $this->cus_sup_id . "' and company_id='" . $this->compnay_obj->get_compnay_id() . "' and phone_no='" . $this->mobile_no . "'";
        $result_set = $data_base_obj->get_result($get_sql_query);
        if ($result_set->num_rows > 0) {
            $state = false;
            $this->set_error("Moible number is already in use");
        } else {
            $state = true;
        }
        return $state;
    }

    public function process() {
        $steat = false;
        if ($this->check_email()) {
            if ($this->check_moblie_no()) {

                $data_base_obj = new DataBase();
                
                // Check if customer/supplier exists to prevent foreign key error
                $check_cus_sql = "SELECT id FROM cus_sup_list WHERE id='" . $this->cus_sup_id . "'";
                $res = $data_base_obj->get_result($check_cus_sql);
                if ($res && $res->num_rows == 0) {
                    $this->set_error("Invalid Customer/Supplier Profile ID.");
                    return false;
                }

                $get_sql_query = "INSERT INTO cus_sup_contact_person(name,email,phone_no,ast,sdt,cus_sup_list_id,company_id) VALUES "
                        . "('" . $this->name . "','" . $this->email . "','" . $this->mobile_no . "','1',now(),'" . $this->cus_sup_id . "','" . $this->compnay_obj->get_compnay_id() . "')";
                
                try {
                    $data_base_obj->get_result($get_sql_query);                
                    $steat=$data_base_obj->get_error_state_boolean();
                    $this->set_error($data_base_obj->get_error());
                } catch (Exception $e) {
                    $steat = false;
                    $this->set_error("Cannot add contact person: " . $e->getMessage());
                }
            } else {
                $steat = false;
            }
        } else {
            $steat = false;
        }
        return $steat;
    }
}
