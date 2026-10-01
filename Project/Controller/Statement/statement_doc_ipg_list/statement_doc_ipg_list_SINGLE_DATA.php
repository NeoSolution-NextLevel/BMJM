<?php

class statement_doc_ipg_list_SINGLE_DATA
{
    private $id;
    private $ipg_transaction_id;
    private $cus_name;
    private $amount;
    private $success_tranaction;
    private $statement_doc_id;

    public function __construct($id)
    {
        $this->id = $id;

        $db = new DataBase();
        $res = $db->get_result("SELECT * FROM statement_doc_ipg_list WHERE id='" . $this->id . "'");

        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();


            $this->ipg_transaction_id = $row['ipg_transaction_id'];
            $this->cus_name = $row['cus_name'];
            $this->amount = $row['amount'];
            $this->success_tranaction = $row['success_tranaction'];
            $this->statement_doc_id = $row['statement_doc_id'];
        }
    }

    public function get_id()
    {
        return $this->id;
    }
    public function get_ipg_transaction_id()
    {
        return $this->ipg_transaction_id;
    }
    public function get_cus_name()
    {
        return $this->cus_name;
    }
    public function get_amount()
    {
        return $this->amount;
    }
    public function get_success_tranaction()
    {
        return $this->success_tranaction;
    }
    public function get_statement_doc_id()
    {
        return $this->statement_doc_id;
    }
}
