<?php
class recommended_person_data_ADD_UPDATE{
     private $id;
     private $ast ="1";
     private $sdt;
     private $name;
     private $contact_no;
     private $wwjm_member_list_id ;
     private $membership_no;
     private $main_user_login_id;
     private $sql_update_query;

     public function __construct($main_user_login_id) {
        $this->main_user_login_id = $main_user_login_id;
        $this->sdt = date("Y-m-d H:i:s");

    }

    public function get_data($get_name, $get_contact_no, $get_wwjm_member_list_id, $get_membership_no){
         $this->name = $get_name;
         $this->contact_no = $get_contact_no;
         $this->wwjm_member_list_id = $get_wwjm_member_list_id;
         $this->membership_no = $get_membership_no;
         $this->sql_update_query=
              ",name ='" . $this->name . "', 
                contact_no ='" . $this->contact_no . "',
                wwjm_member_list_id ='" . $this->wwjm_member_list_id . "',
                membership_no ='" . $this->membership_no . "'";
    }

     public function set_name($get_name) 
    {
        $this->name = $get_name;
        $this->sql_update_query = $this->sql_update_query . ",name='" . $this->name;
    }

    public function set_contact_no($get_contact_no)
    {
        $this->contact_no = $get_contact_no;
        $this->sql_update_query = $this->sql_update_query . ",contact_no='" . $this->contact_no;
    }

    public function set_wwjm_member_list_id($get_wwjm_member_list_id)
    {
        $this->wwjm_member_list_id = $get_wwjm_member_list_id;
        $this->sql_update_query = $this->sql_update_query . ",wwjm_member_list_id='" . $this->wwjm_member_list_id;
    }

    public function set_membership_no($get_membership_no)
    {
        $this->membership_no = $get_membership_no;
        $this->sql_update_query = $this->sql_update_query . ",membership_no='" . $this->membership_no;
    }

    public function remove()
    {
        $this->ast = "0";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

     public function process_new_record()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "insert into recommended_person_data (
                     ast,
                     sdt,
                     name,
                     contact_no,
                     wwjm_member_list_id,
                     membership_no,
                     main_user_login_id)
                      values"
                    . "('" . $this->ast . "',
                     '" . $this->sdt . "',
                     '" . $this->name . "',
                     '" . $this->contact_no . "',
                     '" . $this->wwjm_member_list_id . "',
                     '" . $this->membership_no . "',
                     '" . $this->main_user_login_id . "')";
      $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_data_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query_data = "update recommended_person_data set sdt='" . $this->sdt . "' " . $this->sql_update_query . " where id='" . $this->id . "';";
        $data_base_obj->get_result($get_sql_query_data);
         $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
        // return true; // Placeholder for testing
    }
}
