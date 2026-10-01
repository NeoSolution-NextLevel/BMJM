<?php

class statement_doc_cart_data_ADD_UPDATE
{
    private $id;
    private $ast = "1";
    private $sdt;
    private $statement_doc_id;
    private $cart_main_data_list_id;
    private $id_to_formate;
    private $cook_id;

    private $main_user_login_id;
    private $sql_update_query = "";
    private $sql_query = "";
    private $error_msg;

    public function __construct($get_main_user_login_id = 0)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date("Y-m-d H:i:s");
    }

    /* ================= NORMAL SETTERS ================= */

    public function set_id($get_id)
    {
        $this->id = $get_id;
        $this->sql_update_query .= ",id='" . $this->id . "'";
    }

    public function set_data($get_statement_doc_id, $get_cart_main_data_list_id, $get_id_to_formate, $get_cook_id)
    {
        $this->statement_doc_id = $get_statement_doc_id;
        $this->cart_main_data_list_id = $get_cart_main_data_list_id;
        $this->id_to_formate = $get_id_to_formate;
        $this->cook_id = $get_cook_id;
        $this->sql_update_query .= ",statement_doc_id='" . $this->statement_doc_id . "', statement_doc_id='" . $this->statement_doc_id . "',cart_main_data_list_id='" . $this->cart_main_data_list_id . "',id_to_formate='" . $this->id_to_formate . "',cook_id='" . $this->cook_id . "'";
    }

    public function set_statement_doc_id($get_statement_doc_id)
    {
        $this->statement_doc_id = $get_statement_doc_id;
        $this->sql_update_query .= ",statement_doc_id='" . $this->statement_doc_id . "'";
    }

    public function set_cart_main_data_list_id($get_cart_main_data_list_id)
    {
        $this->cart_main_data_list_id = $get_cart_main_data_list_id;
        $this->sql_update_query .= ",cart_main_data_list_id='" . $this->cart_main_data_list_id . "'";
    }

    public function set_id_to_formate($get_id_to_formate)
    {
        $this->id_to_formate = $get_id_to_formate;
        $this->sql_update_query .= ",id_to_formate='" . $this->id_to_formate . "'";
    }

    public function set_cook_id($get_cook_id)
    {
        $this->cook_id = $get_cook_id;
        $this->sql_update_query .= ",cook_id='" . $this->cook_id . "'";
    }

    public function set_sdt($get_sdt)
    {
        $this->sdt = $get_sdt;
        $this->sql_update_query .= ",sdt='" . $this->sdt . "'";
    }

    /* ================= STATE FUNCTIONS ================= */

    public function is_active()
    {
        $this->ast = 1;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }

    public function is_not_active()
    {
        $this->ast = 0;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }

    /* ================= FINAL QUERY ================= */

    public function get_update_query()
    {
        return ltrim($this->sql_update_query, ',');
    }

    public function process_new_record()
    {
        $state_bool = false;
        $data_base_obj = new DataBase();

        $this->sql_query = "INSERT INTO statement_doc_cart_data(
            ast,
            sdt,
            statement_doc_id,
            cart_main_data_list_id,
            id_to_formate,
            cook_id
        ) VALUES (
            '" . $this->ast . "',
            '" . $this->sdt . "',
            '" . $this->statement_doc_id . "',
            '" . $this->cart_main_data_list_id . "',
            '" . $this->id_to_formate . "',
            '" . $this->cook_id . "'
        )";

        $data_base_obj->get_result($this->sql_query);
        $this->id = $data_base_obj->get_id();

        if ($this->id > 0) {
            $state_bool = true;
        }

        return $state_bool;
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update statement_doc_cart_data set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }

    public function get_error_msg()
    {
        return $this->error_msg;
    }

    public function get_id()
    {
        return $this->id;
    }
}
