<?php

class statement_doc_cus_sup_address_SINGLE_DATA
{
    private $id;
    private $ast;
    private $sdt;
    private $statement;
    private $statement_doc_id;
    private $main_user_login_id;
    private $cus_sup_address_list_id;

    public function __construct($get_id)
    {
        $this->id = $get_id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM statement_doc_cus_sup_address WHERE id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->statement = $row['statement'];
                $this->statement_doc_id = $row['statement_doc_id'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->cus_sup_address_list_id = $row['cus_sup_address_list_id'];
            }
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

    public function get_statement()
    {
        return $this->statement;
    }

    public function get_statement_doc_id()
    {
        return $this->statement_doc_id;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_cus_sup_address_list_id()
    {
        return $this->cus_sup_address_list_id;
    }
}
