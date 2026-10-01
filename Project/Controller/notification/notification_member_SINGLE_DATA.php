<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class notification_member_SINGLE_DATA
{
    public function get_wwjm_member_list_id_from_main_user_login_id($get_main_user_login_id)
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "select id
                          from wwjm_member_list
                          where ast='1'
                          and main_user_login_id='" . addslashes((int) $get_main_user_login_id) . "'
                          limit 1";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result && $row = $result->fetch_assoc()) {
            return (int) $row['id'];
        }

        return 0;
    }
}
