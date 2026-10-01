<?php

class main_user_password_reset_otp_LIST
{
    private $sql_search_data = '';
    private $sql_process_data = '*';
    private $pagination_data_result = '';
    private $ast_state = '1';

    public function filter_by_request_token_hash($get_request_token_hash)
    {
        $token_hash = (string) $get_request_token_hash;
        if (preg_match('/^[a-f0-9]{64}$/', $token_hash) === 1) {
            $this->sql_search_data .= " AND request_token_hash='" . $token_hash . "'";
        } else {
            $this->sql_search_data .= ' AND id=0';
        }
    }

    public function filter_by_main_user_login_id($get_main_user_login_id)
    {
        $this->sql_search_data .= ' AND main_user_login_id=' . (int) $get_main_user_login_id;
    }

    public function filter_by_delivery_method($get_delivery_method)
    {
        $method = in_array($get_delivery_method, ['email', 'sms'], true)
            ? $get_delivery_method
            : '';
        $this->sql_search_data .= " AND delivery_method='" . $method . "'";
    }

    public function filter_by_not_used()
    {
        $this->sql_search_data .= ' AND used_at IS NULL';
    }

    public function filter_by_verified()
    {
        $this->sql_search_data .= ' AND verified_at IS NOT NULL';
    }

    public function filter_by_not_expired()
    {
        $this->sql_search_data .= ' AND expires_at>=CURRENT_TIMESTAMP';
    }

    public function get_count_report()
    {
        $this->sql_process_data = 'COUNT(id) AS total_count';
    }

    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = ' ORDER BY id DESC LIMIT '
            . max(0, (int) $start_point) . ', ' . max(1, (int) $per_page_data_count);
    }

    public function remove_list()
    {
        $this->ast_state = '0';
    }

    public function get_result()
    {
        $data_base_obj = new DataBase();
        $query = 'SELECT ' . $this->sql_process_data
            . " FROM main_user_password_reset_otp WHERE ast='" . $this->ast_state . "'"
            . $this->sql_search_data
            . $this->pagination_data_result;
        return $data_base_obj->get_result($query);
    }
}
