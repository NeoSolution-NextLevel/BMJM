<?php
class recommended_person_data_SINGLE_DATA{
     private $id;
     private $ast;
     private $sdt;
     private $name;
     private $contact_no;
     private $wwjm_member_list_id ;
     private $membership_no;
     private $main_user_login_id;
     private $sql_update_query;
     private $state_of_data = false;

     public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM recommended_person_data where id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);
        $this->state_of_data = ($get_result->num_rows > 0);
        if ($this->state_of_data) {
            while ($row = $get_result->fetch_assoc()) {
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->name = $row['name'];
                $this->contact_no = $row['contact_no'];
                $this->wwjm_member_list_id = $row['wwjm_member_list_id'];
                $this->membership_no = $row['membership_no'];
                $this->main_user_login_id = $row['main_user_login_id'];
            }
        }
    }

    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_name()
    {
        return $this->name;
    }
    public function get_contact_no()
    {
        return $this->contact_no;
    }
    public function get_wwjm_member_list_id()
    {
        return $this->wwjm_member_list_id;
    }
    public function get_membership_no()
    {
        return $this->membership_no;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
    


} 