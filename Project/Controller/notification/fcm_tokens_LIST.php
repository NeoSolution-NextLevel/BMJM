<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class fcm_tokens_LIST
{
    public function get_member_ids()
    {
        return $this->get_ids_from_query("select distinct wwjm_member_list_id as member_list_id from fcm_tokens where ast='1'");
    }

    public function get_all_member_ids()
    {
        return $this->get_ids_from_query("select id as member_list_id from wwjm_member_list where ast='1'");
    }

    public function get_tokens_from_member_ids(array $get_member_ids)
    {
        $member_ids = array_values(array_unique(array_filter(array_map('intval', $get_member_ids))));
        if (!$member_ids) {
            return [];
        }

        $data_base_obj = new DataBase();
        $get_sql_query = "select token from fcm_tokens 
                          where ast='1' 
                          and wwjm_member_list_id in (" . implode(',', $member_ids) . ")";
        $result = $data_base_obj->get_result($get_sql_query);
        $tokens = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tokens[] = $row['token'];
            }
        }

        return $tokens;
    }

    public function get_subscription_member_ids($get_subscription_id)
    {
        $columns = [
            'subscription' => 'account_type_subcrption',
            'monthly' => 'account_type_subcrption',
            'zakath_payee' => 'account_type_zakath_payee',
            'zakath' => 'account_type_zakath_payee',
            'zakath_receiver' => 'account_type_zakath_reciver',
        ];

        $key = trim((string) $get_subscription_id);
        if ($key === '' || !isset($columns[$key])) {
            return [];
        }

        $column = $columns[$key];
        return $this->get_ids_from_query(
            "select id as member_list_id from wwjm_member_list where ast='1' and " . $column . "='1'"
        );
    }

    private function get_ids_from_query($get_sql_query)
    {
        $data_base_obj = new DataBase();
        $result = $data_base_obj->get_result($get_sql_query);
        $member_ids = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $member_ids[] = (int) $row['member_list_id'];
            }
        }

        return $member_ids;
    }

    public function get_count()
    {
        $data_base_obj = new DataBase();
        $result = $data_base_obj->get_result("select count(id) as total_count from fcm_tokens where ast='1'");

        if ($result && $row = $result->fetch_assoc()) {
            return (int) $row['total_count'];
        }

        return 0;
    }
}
