<?php

class User_Access_Level {

    private $user_id;
    private $error;
    private $user_access_id;
    private $access_level_name;
    private $dash_boad_url;

    public function __construct($get_user_id) {
        $this->user_id = $get_user_id;
        $this->get_database_info_about_access_level();
    }

    private function get_database_info_about_access_level() {
        $data_base_obj = new DataBase();
        $database = $data_base_obj->get_data_base_connction();
        $sql_query = "select * from main_user_account_access_level_list where id in (select main_user_account_access_level_list_id from main_user_login where id='" . $this->user_id . "')";
        $result = $database->query($sql_query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->access_level_name = $row['type_of_access'];
                $this->dash_boad_url = $row['url_home'];
                $this->user_access_id = $row['id'];
            }
        }
    }

    public function get_access_level_name() {
        return $this->access_level_name;
    }

    public function get_dashboard_Url() {
        return $this->dash_boad_url;
    }

    public function get_user_access_level_id() {
        return $this->user_access_id;
    }
}
