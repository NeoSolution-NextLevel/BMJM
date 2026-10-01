<?php

class income_expence_data_info_list_SINGLE_DATA_type_id
{
    private $id;

    private $ast = "1";
    private $sdt;
    private $is_type_of_income;
    private $is_type_of_expence;

    private $dis;
    private $amount;
    private $main_user_login_id;
    private $income_expence_data_id;
    private $income_expence_type_id;

    private $state_of_data = false;

    public function __construct($income_expence_type_id)
    {
        $this->income_expence_type_id = $income_expence_type_id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM income_expence_data_info_list WHERE income_expence_type_id = '" . $this->income_expence_type_id . "'";
        $result = $data_base_obj->get_result($get_sql_query);


        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id   = $row['id'];
                $this->ast  = $row['ast'];
                $this->sdt  = $row['sdt'];
                $this->is_type_of_income  = $row['is_type_of_income'];
                $this->is_type_of_expence = $row['is_type_of_expence'];
                $this->dis = $row['dis'];
                $this->amount = $row['amount'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->income_expence_data_id = $row['income_expence_data_id'];
                $this->income_expence_type_id = $row['income_expence_type_id'];
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

    public function get_is_type_of_income()
    {
        return $this->is_type_of_income;
    }

    public function get_is_type_of_expence()
    {
        return $this->is_type_of_expence;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_amount()
    {
        return $this->amount;;
    }



    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_income_expence_data_id()
    {
        return $this->income_expence_data_id;
    }

    public function get_income_expence_type_id()
    {
        return $this->income_expence_type_id;
    }
}
