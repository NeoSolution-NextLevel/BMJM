
<?php

class income_expence_data_ADD_UPDATE
{

    private $id;

    private $ast = "1";
    private $sdt;

    private $date_of_doc;
    private $is_type_income = 0;
    private $is_type_expece = 0;
    private $finish_state = 0;
    private $total_amount;
    private $main_user_login_id;
    private $dis;

    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function get_data($get_date_of_doc, $get_total_amount, $get_dis)
    {
        $this->date_of_doc = $get_date_of_doc;
        $this->total_amount = $get_total_amount;
        $this->dis = $get_dis;


        $this->sql_update_query .=
            ",date_of_doc='" . $this->date_of_doc . "'" .
            ",total_amount='" . $this->total_amount . "'" .
            ",dis='" . $this->dis . "'";
    }

    public function is_is_type_income()
    {
        $this->is_type_income = 1;
        $this->sql_update_query .= ",is_type_income='" . $this->is_type_income . "'";
    }

    public function is_not_is_type_income()
    {
        $this->is_type_income = 0;
        $this->sql_update_query .= ",is_type_income='" . $this->is_type_income . "'";
    }

    public function is_is_type_expece()
    {
        $this->is_type_expece = 1;
        $this->sql_update_query .= ",is_type_expece='" . $this->is_type_expece . "'";
    }

    public function is_not_is_type_expece()
    {
        $this->is_type_expece = 0;
        $this->sql_update_query .= ",is_type_expece='" . $this->is_type_expece . "'";
    }

    public function is_finish_state()
    {
        $this->finish_state = 1;
        $this->sql_update_query .= ",finish_state='" . $this->finish_state . "'";
    }

    public function is_not_finish_state()
    {
        $this->finish_state = 0;
        $this->sql_update_query .= ",finish_state='" . $this->finish_state . "'";
    }
    public function set_total_amount_incremant($get_total_amount)
    {
        $this->sql_update_query .= ",total_amount=(total_amount+" . $get_total_amount . ")";
    }



    public function get_id()
    {
        return $this->id;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_date_of_doc($get_date_of_doc)
    {
        $this->date_of_doc = $get_date_of_doc;
        $this->sql_update_query .= ",date_of_doc='" . $this->date_of_doc . "'";
    }

    public function set_total_amount($get_total_amount)
    {
        $this->total_amount = $get_total_amount;
        $this->sql_update_query .= ",total_amount='" . $this->total_amount . "'";
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }


    public function remove()
    {
        $this->ast = "0";
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();

        $get_sql_query = "INSERT INTO income_expence_data(ast,sdt,date_of_doc,is_type_income,is_type_expece,finish_state,total_amount,main_user_login_id,dis) VALUES ("
            . "'" . $this->ast . "', "
            . "'" . $this->sdt . "', "
            . "'" . $this->date_of_doc . "', "
            . "'" . $this->is_type_income . "', "
            . "'" . $this->is_type_expece . "', "
            . "'" . $this->finish_state . "', "
            . "'" . $this->total_amount . "', "
            . "'" . $this->main_user_login_id . "', "
            . "'" . $this->dis . "');";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update income_expence_data set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}
