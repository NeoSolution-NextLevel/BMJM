<?php

class wwjm_member_list_LIST
{

    private $sql_seach_data = "";
    private $sql_process_data = "*";
    private $pagination_data_result;
    private $ast = "1";



    // Get all columns
    public function get_all_data()
    {
        $this->sql_process_data = "*";
    }

    public function search_from_membership_no($get_like_membership_no)
    {
        $this->sql_seach_data = "";
        $this->sql_seach_data .= " AND membership_no LIKE '%" . $get_like_membership_no . "%'";
    }

    public function search_from_road_name_M($get_like_road_name_M)
    {
        $this->sql_seach_data = "";

        $this->sql_seach_data .= " AND road_name_M LIKE '%" . $get_like_road_name_M . "%'";
    }
    public function search_already_avb($get_notification_phone_number, $get_notification_email)
    {
        $this->sql_seach_data .= " AND phone_mobile='" . $get_notification_phone_number . "' or email='" . $get_notification_email . "'";
    }

    public function search_from_notification_whatup($get_like_notification_whatup)
    {

        $this->sql_seach_data .= " AND notification_whatup LIKE '%" . $get_like_notification_whatup . "%'";
    }

    public function search_from_name_M($get_like_name_M)
    {
        $this->sql_seach_data = "";
        $this->sql_seach_data .= " AND name_M LIKE '%" . $get_like_name_M . "%'";
    }

    public function search_from_email($get_like_email)
    {
        $this->sql_seach_data = "";
        $this->sql_seach_data .= " AND email LIKE '%" . $get_like_email . "%'";
    }

    public function filter_by_email($get_email)
    {
        $this->sql_seach_data .= " AND LOWER(email)=LOWER('" . $get_email . "')";
    }

    public function filter_by_id_not($get_id)
    {
        $this->sql_seach_data .= " AND id<>'" . $get_id . "'";
    }

    public function search_from_phone_mobile($get_like_phone_mobile)
    {
        $this->sql_seach_data = "";
        $this->sql_seach_data .= " AND phone_mobile LIKE '%" . $get_like_phone_mobile . "%'";
    }

    public function search_from_id($get_id)
    {
        $this->sql_seach_data = "";
        $this->sql_seach_data .= " AND id = '" . $get_id . "'";
    }

    public function search_from_active_state($get_active_state)
    {
        $this->sql_seach_data .= " AND active_state LIKE '%" . $get_active_state . "%'";
    }

    // Get count of rows
    public function get_count_report()
    {
        $this->sql_process_data = " COUNT(id) AS total_count ";
        // $this->pagination_data_result = "";
    }
    public function get_MAX_id()
    {
        $this->sql_process_data = " max(id) ";
    }


    // Set pagination limits
    public function set_data_limits($start_point, $per_page_data_count)
    {
        $this->pagination_data_result = " ORDER BY id DESC LIMIT " . $start_point . ", " . $per_page_data_count . " ";
    }

    // Remove record (set ast=0)
    public function remove_list()
    {
        $this->ast = "0";
    }

    public function get_contact_number_from_row($row)
    {
        if (!empty($row['phone_mobile'])) {
            return $row['phone_mobile'];
        }
        if (!empty($row['notification_moible_no'])) {
            return $row['notification_moible_no'];
        }
        if (!empty($row['secondry_mobile'])) {
            return $row['secondry_mobile'];
        }
        return !empty($row['notification_whatup']) ? $row['notification_whatup'] : '';
    }

    // Get result array from database
    public function get_result()
    {
        $data_base_obj = new DataBase();


        $get_sql_query = "SELECT " . $this->sql_process_data . " 
                          FROM wwjm_member_list 
                          WHERE ast='" . $this->ast . "'" . $this->sql_seach_data . $this->pagination_data_result;
        // echo $get_sql_query;




        return $data_base_obj->get_result($get_sql_query);
    }
}
