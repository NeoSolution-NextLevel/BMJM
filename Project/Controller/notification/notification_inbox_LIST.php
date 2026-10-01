<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class notification_inbox_LIST
{
    private $member_list_id;
    private $data_limit = 100;

    public function set_member_list_id($get_member_list_id)
    {
        $this->member_list_id = (int) $get_member_list_id;
    }

    public function set_data_limit($get_limit)
    {
        $this->data_limit = (int) $get_limit;
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "select i.id as inbox_id,
                          n.id,
                          n.type,
                          n.title,
                          n.body,
                          n.subscription_id,
                          n.image_pth,
                          n.sdt as created_at,
                          i.is_read
                          from notification_inbox i
                          inner join notifications n on n.id = i.notifications_id
                          where i.wwjm_member_list_id='" . addslashes($this->member_list_id) . "'
                          and i.ast='1'
                          and n.ast='1'
                          order by n.sdt desc, n.id desc, i.id desc
                          limit " . addslashes($this->data_limit);

        return $data_base_obj->get_result($get_sql_query);
    }

    public function get_notifications_array()
    {
        $result = $this->get_result();
        $items = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = [
                    'inbox_id' => (int) $row['inbox_id'],
                    'id' => (int) $row['id'],
                    'type' => $row['type'],
                    'title' => $row['title'],
                    'body' => $row['body'],
                    'subscription_id' => $row['subscription_id'],
                    'image_pth' => $row['image_pth'],
                    'is_read' => (int) $row['is_read'] === 1,
                    'created_at' => $row['created_at'],
                ];
            }
        }

        return $items;
    }
}
