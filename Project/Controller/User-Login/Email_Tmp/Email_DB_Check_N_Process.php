<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class Email_DB_Check {

    private $ref_id;
    private $state_availability = false;
    private $error_msg;
//----------------------------------
    private $user_id;

    public function __construct($get_ref_id) {
        $this->ref_id = $get_ref_id;
    }

    public function get_check_availability() {
        $data_base_obj = new DataBase();
        $data_base = $data_base_obj->get_data_base_connction();

        $sql_query = "select * from main_user_login_email_list where email_steate='0' and key_of_email='" . $this->ref_id . "'";
        $reulst = $data_base->query($sql_query);
        if ($reulst->num_rows > 0) {
            $this->state_availability = true;
            while ($row = $reulst->fetch_assoc()) {
                $this->user_id = $row['main_user_login_id'];
            }
        } else {
            $this->state_availability = false;
        }
        return $this->state_availability;
    }

    public function state_change() {
        $state = false;
        $data_base_obj = new DataBase();
                $sql_query = "update main_user_login_email_list set email_steate='1' where key_of_email='" . $this->ref_id . "'";
        $data_base_obj->get_result($sql_query);
        $state = $data_base_obj->get_error_state_boolean();
        $this->error_msg = $data_base_obj->get_error();
        return $state;
    }

    public function get_error() {
        return $this->error_msg;
    }
    public function get_user_id(){
        return $this->user_id;
    }
}
