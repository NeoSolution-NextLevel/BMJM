<?php

class statement_doc_cart_data_SINGLE_DATA
{
    private $id;
    private $ast;
    private $sdt;
    private $statement_doc_id;
    private $cart_main_data_list_id;
    private $id_to_formate;
    private $cook_id;

    public function __construct($get_id)
    {
        $this->id = $get_id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM statement_doc_cart_data WHERE id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->statement_doc_id = $row['statement_doc_id'];
                $this->cart_main_data_list_id = $row['cart_main_data_list_id'];
                $this->id_to_formate = $row['id_to_formate'];
                $this->cook_id = $row['cook_id'];
            }
        }
    }

    /* ================= GETTERS ================= */

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

    public function get_statement_doc_id()
    {
        return $this->statement_doc_id;
    }

    public function get_cart_main_data_list_id()
    {
        return $this->cart_main_data_list_id;
    }

    public function get_id_to_formate()
    {
        return $this->id_to_formate;
    }

    public function get_cook_id()
    {
        return $this->cook_id;
    }
}
