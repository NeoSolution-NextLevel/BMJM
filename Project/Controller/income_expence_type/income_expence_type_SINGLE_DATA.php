<?php

class income_expence_type_SINGLE_DATA
{
    private $id;
    private $ast = "1";
    private $sdt;

    private $income_expence_type_name;
    private $is_income_type;
    private $is_expece_type;
    private $main_user_login_id;


    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM income_expence_type WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);


        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id   = $row['id'];
                $this->ast         = $row['ast'];
                $this->sdt         = $row['sdt'];
                $this->income_expence_type_name = $row['income_expence_type_name'];
                $this->is_income_type = $row['is_income_type'];
                $this->is_expece_type = $row['is_expece_type'];
                $this->main_user_login_id = $row['main_user_login_id'];
            }
        }
    }

    // --- Getter functions ---
    public function get_state()
    {
        return $this->state_of_data;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }


    public function get_ast()
    {
        return $this->ast;
    }

    public function get_income_expence_type_name()
    {
        return $this->income_expence_type_name;
    }
    public function get_is_income_type()
    {
        return $this->is_income_type;
    }
    public function get_is_expece_type()
    {
        return $this->is_expece_type;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
}
