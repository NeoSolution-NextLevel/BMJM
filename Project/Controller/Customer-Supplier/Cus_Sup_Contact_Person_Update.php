<?php

class Cus_Sup_Contact_Person_Update {

    private $contact_person_id;
    private $get_sql_query;

    public function __construct($get_contact_person_id) {
        $this->contact_person_id = $get_contact_person_id;
    }

    private $error_msg;

    public function get_error() {
        return $this->error_msg;
    }

    private function set_error($get_error) {
        $this->error_msg = $get_error;
    }

    public function remove_data() {
        $this->get_sql_query = "update cus_sup_contact_person set ast='0' where id='" . $this->contact_person_id . "'";
    }

    public function process() {
        $data_base_obj = new DataBase();
        $data_base_obj->get_result($this->get_sql_query);
        $this->set_error($data_base_obj->get_error());
        return $data_base_obj->get_error_state_boolean();
    }
}
