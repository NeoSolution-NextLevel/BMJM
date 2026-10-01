<?php

class wwjm_road_name_SINGLE_DATA
{

    private $id;
    private $road_name;
    private $ast;
    private $sdt;
    private $main_user_login_id;


    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_road_name WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        while ($result && $row = $result->fetch_assoc()) {
            $this->road_name = $row['road_name'];
            $this->ast = $row['ast'];
            $this->sdt = $row['sdt'];
            $this->main_user_login_id = $row['main_user_login_id'];
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
    public function get_road_name()
    {
        return $this->road_name;
    }
}
