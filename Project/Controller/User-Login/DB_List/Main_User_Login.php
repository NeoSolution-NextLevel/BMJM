<?php

class Main_User_Login {

    private $id;
    private $user_name;
    private $password;
    private $account_active_state;
    private $ast;
    private $sdt;
    private $last_login;
    private $name_show;
    private $email_verify;
    private $moible_verify;
    private $very_first_login;
    private $cook_key;
    private $ref_key;
    private $temp_lock;
    private $full_block;
    private $ac_type;
    private $company_id;
    private $control_account_state;
    private $main_user_account_access_level_list_id;

    // Constructor that initializes the object with data from the database
    public function __construct($id) {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM main_user_login WHERE id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->user_name = $row['user_name'];
                $this->password = $row['password'];
                $this->account_active_state = $row['account_active_state'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->last_login = $row['last_login'];
                $this->name_show = $row['name_show'];
                $this->email_verify = $row['email_verify'];
                $this->moible_verify = $row['moible_verfiy'];
                $this->very_first_login = $row['very_first_login'];
                $this->cook_key = $row['cook_key'];
                $this->ref_key = $row['ref_key'];
                $this->temp_lock = $row['temp_lock'];
                $this->full_block = $row['full_block'];
                $this->ac_type = $row['ac_type'];
                $this->company_id = $row['company_id'];
                $this->control_account_state = $row['control_account_state'];
                $this->main_user_account_access_level_list_id = $row['main_user_account_access_level_list_id'];
            }
        } else {
            throw new Exception("No user found with ID " . $this->id);
        }
    }

    // Getters for the columns
    public function get_Id() {
        return $this->id;
    }

    public function get_User_Name() {
        return $this->user_name;
    }

    public function get_Password() {
        return $this->password;
    }

    public function get_Account_Active_State() {
        return $this->account_active_state;
    }

    public function get_Ast() {
        return $this->ast;
    }

    public function get_Sdt() {
        return $this->sdt;
    }

    public function get_Last_Login() {
        return $this->last_login;
    }

    public function get_Name_Show() {
        return $this->name_show;
    }

    public function get_Email_Verify() {
        return $this->email_verify;
    }

    public function get_Moible_Verify() {
        return $this->moible_verify;
    }

    public function get_Very_First_Login() {
        return $this->very_first_login;
    }

    public function get_Cook_Key() {
        return $this->cook_key;
    }

    public function get_Ref_Key() {
        return $this->ref_key;
    }

    public function get_Temp_Lock() {
        return $this->temp_lock;
    }

    public function get_Full_Block() {
        return $this->full_block;
    }

    public function get_Ac_Type() {
        return $this->ac_type;
    }

    public function get_Company_Id() {
        return $this->company_id;
    }

    public function get_Control_Account_State() {
        return $this->control_account_state;
    }

    public function get_Main_User_Account_Access_Level_List_Id() {
        return $this->main_user_account_access_level_list_id;
    }
}
