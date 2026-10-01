<?php

class Cus_Sup_Details {

    private $cus_sup_id;
//    =================================
    private $email;
    private $mobile_no;
    private $name;

    public function __construct($get_cus_sup_id) {
        $this->cus_sup_id = $get_cus_sup_id;
        $cus_sup_obj = new Cus_Sup_List();
        $cus_sup_obj->get_search_from_cus_sup_id($get_cus_sup_id);
        $get_result = $cus_sup_obj->process();
        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->email = $row['email'];
                $this->mobile_no = $row['moble_no_for_sms'];
                $this->name = $row['name'];
            }
        }
    }

    public function get_email() {
        return $this->email;
    }

    public function get_mobile_no() {
        return $this->mobile_no;
    }

    public function get_name() {
        return $this->name;
    }
}
