<?php
class ticket_transactions_SINGLE_DATA
{
    private $id;
    private $ast = "1";
    private $sdt;
    private $qty_bougth;
    private $collection_ticket_tiers_id;
    private $wwjm_projects_collection_list_id;
    private $wwjm_member_list_id;
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM ticket_transactions WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->id = $row['id'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->qty_bougth = $row['qty_bougth'];
                $this->collection_ticket_tiers_id = $row['collection_ticket_tiers_id'];
                $this->wwjm_projects_collection_list_id = $row['wwjm_projects_collection_list_id'];
                $this->wwjm_member_list_id = $row['wwjm_member_list_id'];
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
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_qty_bougth()
    {
        return $this->qty_bougth;
    }
    public function get_collection_ticket_tiers_id()
    {
        return $this->collection_ticket_tiers_id;
    }
    public function get_wwjm_projects_collection_list_id()
    {
        return $this->wwjm_projects_collection_list_id;
    }
    public function get_wwjm_member_list_id()
    {
        return $this->wwjm_member_list_id;
    }
}
