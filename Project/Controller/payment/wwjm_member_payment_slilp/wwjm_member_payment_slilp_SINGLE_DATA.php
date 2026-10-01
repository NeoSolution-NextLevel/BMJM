<?php

class wwjm_member_payment_slilp_SINGLE_DATA
{

    private $id;
    private $ast;
    private $sdt;
    private $wwjm_member_list_id;
    private $wwjm_payment_slip_id;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_member_payment_slilp WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        while ($result && $row = $result->fetch_assoc()) {
            $this->ast = $row['ast'];
            $this->sdt = $row['sdt'];
            $this->wwjm_member_list_id = $row['wwjm_member_list_id'];
            $this->wwjm_payment_slip_id = $row['wwjm_payment_slip_id'];
        }
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_ast()
    {
        return $this->ast;
    }


    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_wwjm_member_list_id()
    {
        return $this->wwjm_member_list_id;
    }
    public function get_wwjm_payment_slip_id()
    {
        return $this->wwjm_payment_slip_id;
    }
}
