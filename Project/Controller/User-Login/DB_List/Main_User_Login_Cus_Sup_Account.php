<?php

class Main_User_Login_Cus_Sup_Account {

    private $id;
    private $ast;
    private $sdt;
    private $cus_sup_list_id;
    private $main_user_login_id;

    // Constructor to initialize the object with data from the database
    public function __construct($id) {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM main_user_login_cus_sup_account WHERE id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->cus_sup_list_id = $row['cus_sup_list_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
            }
        } else {
            throw new Exception("No record found with ID " . $this->id);
        }
    }

    // Getter methods for the columns
    public function get_Id() {
        return $this->id;
    }

    public function get_Ast() {
        return $this->ast;
    }

    public function get_Sdt() {
        return $this->sdt;
    }

    public function get_Cus_Sup_List_Id() {
        return $this->cus_sup_list_id;
    }

    public function get_Main_User_Login_Id() {
        return $this->main_user_login_id;
    }
}
