<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class notifications_ADD_UPDATE
{
    private $id;
    private $type;
    private $title;
    private $body;
    private $ast = "1";
    private $subscription_id = '';
    private $image_pth = '';
    private $main_user_login_id = 0;
    private $sdt;
    private $error_msg;

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function set_data($get_type, $get_title, $get_body, $get_subscription_id = '', $get_main_user_login_id = 0, $get_image_pth = '')
    {
        $this->type = $get_type;
        $this->title = $get_title;
        $this->body = $get_body;
        $this->subscription_id = $get_subscription_id;
        $this->main_user_login_id = (int) $get_main_user_login_id;
        $this->image_pth = $get_image_pth;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new DataBase();
        $main_user_login_sql = ($this->main_user_login_id > 0)
            ? "'" . addslashes($this->main_user_login_id) . "'"
            : "NULL";

        $get_sql_query = "insert into notifications (
            type,
            title,
            body,
            ast,
            sdt,
            subscription_id,
            image_pth,
            main_user_login_id
        ) values ("
            . "'" . addslashes($this->type) . "', "
            . "'" . addslashes($this->title) . "', "
            . "'" . addslashes($this->body) . "', "
            . "'" . addslashes($this->ast) . "', "
            . "'" . addslashes($this->sdt) . "', "
            . "'" . addslashes($this->subscription_id) . "', "
            . "'" . addslashes($this->image_pth) . "', "
            . $main_user_login_sql
            . ");";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error();
        $this->id = (int) $data_base_obj->get_id();
        if ($this->id <= 0 && $data_base_obj->get_error_state_boolean()) {
            $lastIdResult = $data_base_obj->get_result("select LAST_INSERT_ID() as id");
            if ($lastIdResult && ($lastIdRow = $lastIdResult->fetch_assoc())) {
                $this->id = (int) $lastIdRow['id'];
            }
        }
        if ($this->id <= 0 && $data_base_obj->get_error_state_boolean()) {
            $lookup = $data_base_obj->get_result(
                "select id from notifications
                 where type='" . addslashes($this->type) . "'
                 and title='" . addslashes($this->title) . "'
                 and body='" . addslashes($this->body) . "'
                 and sdt='" . addslashes($this->sdt) . "'
                 order by id desc
                 limit 1"
            );
            if ($lookup && $row = $lookup->fetch_assoc()) {
                $this->id = (int) $row['id'];
            }
        }
        return $data_base_obj->get_error_state_boolean() && $this->id > 0;
    }
}
