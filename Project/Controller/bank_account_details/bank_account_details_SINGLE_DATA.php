<?php

class bank_account_details_SINGLE_DATA
{
    private $id;
    private $bank_name;

    private $branch;

    private $ac_no;

    private $ac_name;

    private $swif_code;

    private $current_ac;

    private $savings_ac;

    private $dis;

    private $main_user_login_id;
    private $sdt;
    private $ast;
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = (int) $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM bank_account_details WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);


        if (!$result || $result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id                = $row['id'];
                $this->bank_name         = $row['bank_name'];
                $this->branch            = $row['branch'];
                $this->ac_no             = $row['ac_no'];
                $this->ac_name           = $row['ac_name'];
                $this->swif_code         = $row['swif_code'];
                $this->current_ac        = $row['current_ac'];
                $this->savings_ac        = $row['savings_ac'];
                $this->dis               = $row['dis'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->sdt               = $row['sdt'];
                $this->ast               = $row['ast'];
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
    public function get_bank_name()
    {
        return $this->bank_name;
    }

    public function get_branch()
    {
        return $this->branch;
    }

    public function get_ac_no()
    {
        return $this->ac_no;
    }

    public function get_ac_name()
    {
        return $this->ac_name;
    }

    public function get_swif_code()
    {
        return $this->swif_code;
    }

    public function get_current_ac()
    {
        return $this->current_ac;
    }

    public function get_savings_ac()
    {
        return $this->savings_ac;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_ast()
    {
        return $this->ast;
    }
}
