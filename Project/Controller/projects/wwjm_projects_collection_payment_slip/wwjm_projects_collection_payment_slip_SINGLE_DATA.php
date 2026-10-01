<?php
class wwjm_projects_collection_payment_slip_SINGLE_DATA
{
    private $id;
    private $ast = "1";
    private $sdt;
    private $wwjm_payment_slip_id;
    private $wwjm_projects_collection_list_id;
    private $state_of_data = false;

     public function __construct($id)
    {
        $this->id = $id;
        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_projects_collection_payment_slip WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);
        if ($result->num_rows == 0) {
            $this->state_of_data = false;
            } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->wwjm_payment_slip_id = $row['wwjm_payment_slip_id'];
                $this->wwjm_projects_collection_list_id = $row['wwjm_projects_collection_list_id'];
                $this->sdt = $row['sdt'];
                $this->ast = $row['ast'];
            }
        }
    }

    public function get_state()
    {
        return $this->state_of_data;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_wwjm_payment_slip_id()
    {
        return $this->wwjm_payment_slip_id;
    }
    public function get_wwjm_projects_collection_list_id()
    {
        return $this->wwjm_projects_collection_list_id;
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