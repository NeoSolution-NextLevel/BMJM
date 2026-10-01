<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class notification_inbox_ADD_UPDATE
{
    private $notifications_id;
    private $wwjm_member_list_id;
    private $is_read = 0;
    private $ast = "1";
    private $sdt;
    private $error_msg;
    private $processed_count = 0;

    public function __construct()
    {
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function set_data($get_notifications_id, $get_wwjm_member_list_id)
    {
        $this->notifications_id = (int) $get_notifications_id;
        $this->wwjm_member_list_id = (int) $get_wwjm_member_list_id;
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function get_processed_count()
    {
        return $this->processed_count;
    }

    public function process_new_record()
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "insert into notification_inbox (
            is_read,
            sdt,
            ast,
            notifications_id,
            wwjm_member_list_id
        ) values ("
            . "'" . addslashes($this->is_read) . "', "
            . "'" . addslashes($this->sdt) . "', "
            . "'" . addslashes($this->ast) . "', "
            . "'" . addslashes($this->notifications_id) . "', "
            . "'" . addslashes($this->wwjm_member_list_id) . "'"
            . ")
            on duplicate key update
            ast='1',
            sdt=values(sdt)";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error();
        if (!$data_base_obj->get_error_state_boolean()) {
            return false;
        }

        $verify_result = $data_base_obj->get_result(
            "select id from notification_inbox
             where notifications_id='" . addslashes($this->notifications_id) . "'
             and wwjm_member_list_id='" . addslashes($this->wwjm_member_list_id) . "'
             and ast='1'
             limit 1"
        );

        if (!$verify_result || $verify_result->num_rows === 0) {
            $this->error_msg = 'The notification inbox row was not saved for the requested member. Check the notification_inbox unique indexes.';
            return false;
        }

        $this->error_msg = '';
        return true;
    }

    public function process_member_list($get_notification_id, array $get_member_ids)
    {
        $state = true;
        $first_error = '';
        $this->processed_count = 0;
        foreach (array_unique(array_map('intval', $get_member_ids)) as $member_id) {
            if ($member_id <= 0) {
                continue;
            }
            $this->set_data($get_notification_id, $member_id);
            if ($this->process_new_record()) {
                $this->processed_count++;
            } else {
                $state = false;
                if ($first_error === '') {
                    $first_error = (string) $this->error_msg;
                }
            }
        }
        if (!$state) {
            $this->error_msg = $first_error;
        }
        return $state;
    }

    public function mark_read($get_notification_id, $get_member_list_id)
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "update notification_inbox 
                          set is_read='1' 
                          where notifications_id='" . addslashes((int) $get_notification_id) . "' 
                          and wwjm_member_list_id='" . addslashes((int) $get_member_list_id) . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error();
        return $data_base_obj->get_error_state_boolean();
    }
}
