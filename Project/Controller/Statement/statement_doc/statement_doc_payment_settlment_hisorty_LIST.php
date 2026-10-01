<?php

class statement_doc_payment_settlment_hisorty_LIST
{
    private $statement_doc_id;
    private $main_user_login_id;
    private $ast = "1";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
    }

    public function set_statement_doc_id($doc_id)
    {
        $this->statement_doc_id = $doc_id;
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $sql = "SELECT * FROM statement_doc_payment_settlment_hisorty 
                WHERE statement_doc_id = '{$this->statement_doc_id}' 
                AND main_user_login_id = '{$this->main_user_login_id}'
                AND ast = '{$this->ast}'
                ORDER BY id DESC";

        return $data_base_obj->get_result($sql);
    }
}
