<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class notifications_LIST
{
    private $start_point = 0;
    private $data_limit = 100;
    private $search_text = '';
    private $audience_filter = 'all_members';
    private $sort_key = 'newest';

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->start_point = max(0, (int) $start_point);
        $this->data_limit = max(1, (int) $per_page_data_count);
    }

    public function set_data_limit($get_limit)
    {
        $this->set_data_limits(0, $get_limit);
    }

    public function set_search_text($get_search_text)
    {
        $this->search_text = trim($get_search_text);
    }

    public function set_audience_filter($get_audience_filter)
    {
        $allowed_filters = ['all_members', 'subscription', 'zakath_payee', 'zakath_receiver', 'automatic', 'all'];
        $audience_filter = trim((string) $get_audience_filter);
        $this->audience_filter = in_array($audience_filter, $allowed_filters, true) ? $audience_filter : 'all_members';
    }

    public function set_sort_key($get_sort_key)
    {
        $allowed_sorts = ['newest', 'oldest', 'title_az', 'title_za', 'recipients_high', 'recipients_low'];
        $sort_key = trim((string) $get_sort_key);
        $this->sort_key = in_array($sort_key, $allowed_sorts, true) ? $sort_key : 'newest';
    }

    private function get_search_sql()
    {
        if ($this->search_text === '') {
            return '';
        }

        $search_text = addslashes($this->search_text);
        return " and (n.title like '%" . $search_text . "%' or n.body like '%" . $search_text . "%' or n.type like '%" . $search_text . "%')";
    }

    private function get_audience_sql()
    {
        switch ($this->audience_filter) {
            case 'all':
                return '';
            case 'subscription':
                return " and n.type='subscription' and (n.subscription_id='subscription' or n.subscription_id='monthly')";
            case 'zakath_payee':
                return " and n.type='subscription' and (n.subscription_id='zakath_payee' or n.subscription_id='zakath')";
            case 'zakath_receiver':
                return " and n.type='subscription' and n.subscription_id='zakath_receiver'";
            case 'automatic':
                return " and n.type='auto'";
            case 'all_members':
            default:
                return " and n.type='all'";
        }
    }

    private function get_filter_sql()
    {
        return $this->get_search_sql() . $this->get_audience_sql();
    }

    private function get_order_sql()
    {
        switch ($this->sort_key) {
            case 'oldest':
                return ' order by n.sdt asc, n.id asc';
            case 'title_az':
                return ' order by n.title asc, n.sdt desc';
            case 'title_za':
                return ' order by n.title desc, n.sdt desc';
            case 'recipients_high':
                return ' order by target_count desc, n.sdt desc';
            case 'recipients_low':
                return ' order by target_count asc, n.sdt desc';
            case 'newest':
            default:
                return ' order by n.sdt desc, n.id desc';
        }
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();

        $get_sql_query = "select n.id, n.type, n.title, n.body, n.subscription_id, n.image_pth, n.main_user_login_id, n.sdt,
                          (select count(id) from notification_inbox where notifications_id=n.id and ast='1') as target_count
                          from notifications n
                          where n.ast='1'
                          " . $this->get_filter_sql() . "
                          " . $this->get_order_sql() . "
                          limit " . addslashes($this->start_point) . ", " . addslashes($this->data_limit);

        return $data_base_obj->get_result($get_sql_query);
    }

    public function get_notifications_array()
    {
        $result = $this->get_result();
        $items = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = [
                    'id' => (int) $row['id'],
                    'type' => $row['type'],
                    'title' => $row['title'],
                    'message' => $row['body'],
                    'body' => $row['body'],
                    'audience' => $row['type'] === 'all' ? 'all_members' : ($row['subscription_id'] ?: $row['type']),
                    'status' => 'sent',
                    'subscription_id' => $row['subscription_id'],
                    'image_pth' => $row['image_pth'],
                    'main_user_login_id' => $row['main_user_login_id'],
                    'target_count' => (int) $row['target_count'],
                    'sdt' => $row['sdt'],
                ];
            }
        }

        return $items;
    }

    public function get_count()
    {
        $data_base_obj = new DataBase();
        $result = $data_base_obj->get_result("select count(n.id) as total_count from notifications n where n.ast='1' " . $this->get_filter_sql());

        if ($result && $row = $result->fetch_assoc()) {
            return (int) $row['total_count'];
        }

        return 0;
    }
}
