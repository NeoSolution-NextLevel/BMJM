<?php

class income_expence_data_SINGLE_DATA_BY_DIS
{
    private $id;

    private $ast = "1";
    private $sdt;

    private $date_of_doc;
    private $is_type_income;
    private $is_type_expece;
    private $finish_state;
    private $total_amount;
    private $main_user_login_id;
    private $dis;

    private $state_of_data = false;

    public function __construct($dis)
    {
        $this->dis = $dis;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM income_expence_data WHERE dis = '" . $this->dis . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id   = $row['id'];
                $this->ast  = $row['ast'];
                $this->sdt  = $row['sdt'];
                $this->date_of_doc = $row['date_of_doc'];
                $this->is_type_income = $row['is_type_income'];
                $this->is_type_expece = $row['is_type_expece'];
                $this->finish_state = $row['finish_state'];
                $this->total_amount = $row['total_amount'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->dis = $row['dis'];
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

    public function get_date_of_doc()
    {
        return $this->date_of_doc;
    }

    public function get_is_type_income()
    {
        return $this->is_type_income;
    }

    public function get_is_type_expece()
    {
        return $this->is_type_expece;
    }

    public function get_finish_state()
    {
        return $this->finish_state;
    }

    public function get_total_amount()
    {
        return $this->total_amount;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
}
