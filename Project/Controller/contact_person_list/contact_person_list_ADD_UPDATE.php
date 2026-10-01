<?php

class contact_person_list_ADD_UPDATE
{
    private $id;
    private $contact_person_name;
    private $contact_person_member_id;
    private $contact_person_mobile;
    private $wwjm_member_list_id;
    private $ast = "1";
    private $sdt;
    private $error_msg;
    private $sql_update_query = "";

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function set_data($contact_person_name, $contact_person_member_id, $contact_person_mobile, $wwjm_member_list_id)
    {
        $this->contact_person_name = $contact_person_name;
        $this->contact_person_member_id = $contact_person_member_id;
        $this->contact_person_mobile = $contact_person_mobile;
        $this->wwjm_member_list_id = $wwjm_member_list_id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO contact_person_list (
            contact_person_name,
            contact_person_member_id,
            contact_person_mobile,
            wwjm_member_list_id,
            ast,
            sdt
        ) VALUES ("
            . "'" . addslashes($this->contact_person_name) . "', "
            . "'" . addslashes($this->contact_person_member_id) . "', "
            . "'" . addslashes($this->contact_person_mobile) . "', "
            . "'" . addslashes($this->wwjm_member_list_id) . "', "
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "'"
            . ");";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }
}
