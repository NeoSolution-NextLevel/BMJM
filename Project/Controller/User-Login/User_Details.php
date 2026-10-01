<?php

class User_Details {

    private $user_id;
    private $email;
    private $active_state = false;
    private $temp_block_state = false;
    private $full_block_state = false;
    private $cook_id;
    private $name_show;

    public function __construct($get_user_id) {
        $this->user_id = $get_user_id;
        $this->get_load_data();
    }

    private function get_load_data() {
        $data_base_obj = new DataBase();
        $sql_query = "select * from main_user_login where id='" . $this->user_id . "'";
        $result = $data_base_obj->get_result($sql_query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->user_id = $row['id'];
                $this->email = $row['user_name'];
                $this->name_show=$row['name_show'];

                //                -------------------------

                if ($row['account_active_state'] == "0") {
                    $this->active_state = false;
                } else {
                    $this->active_state = true;
                }

                //                -------------------------

                if ($row['temp_lock'] == "0") {
                    $this->temp_block_state = false;
                } else {
                    $this->temp_block_state = true;
                }

                //                -------------------------

                if ($row['full_block'] == "0") {
                    $this->full_block_state = false;
                } else {
                    $this->full_block_state = true;
                }

                //                -------------------------
                $this->cook_id = $row['cook_key'];

                //                -------------------------
            }
        }
    }
    public function get_name_show(){
        return $this->name_show;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_user_name() {
        return $this->email;
    }

    public function get_user_account_active_state() {
        return $this->active_state;
    }

    public function get_user_temp_lock() {
        return $this->temp_block_state;
    }

    public function get_user_lock() {
        return $this->full_block_state;
    }

    public function get_cook_id() {
        return $this->cook_id;
    }
}
