<?php

include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';

include_once '../../Controller/wwjm_member_list/wwjm_member_list_LIST.php';


$search_txt = isset($_POST['search_txt']) ? trim($_POST['search_txt']) : "";
$search_by  = isset($_POST['search_by']) ? $_POST['search_by'] : "";

// $sec_id  = isset($_POST['sec_id']) ? $_POST['sec_id'] : "";


$json = array();

$member_list_obj = new wwjm_member_list_LIST();


if (isset($_POST['count'])) {
    $member_list_obj->get_count_report();
} else {
    if (isset($_POST['st_count'])) {
        $get_state_value = isset($_POST['st_count']) ? $_POST['st_count'] : "";
        $get_limit = isset($_POST['per_page']) ? $_POST['per_page'] : "";

        $member_list_obj->set_data_limits($get_state_value, $get_limit);
    }
}


if (!empty($search_txt)) {

    if ($search_by === "name") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_name_M($search_txt);
    } elseif ($search_by === "membership_no") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_membership_no($search_txt);
    } elseif ($search_by === "road_name") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_road_name_M($search_txt);
    } elseif ($search_by === "Email") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_email($search_txt);
    } elseif ($search_by === "Phone_no") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_phone_mobile($search_txt);
    } elseif ($search_by === "id") {
        $member_list_obj->get_all_data();
        $member_list_obj->search_from_id($search_txt);
    }
}

$member_list_obj->search_from_active_state(1);


$get_result = $member_list_obj->get_result();

if ($get_result && $get_result->num_rows > 0) {
    while ($row = $get_result->fetch_assoc()) {

        if (isset($_POST['count'])) {
            // Only for count queries
            $json[] = [
                "total_count" => $row['total_count'],
                "count"       => $row['total_count']
            ];
        } else {
            // Normal row results
            $row['phone_mobile'] = $member_list_obj->get_contact_number_from_row($row);
            $json[] = $row;
        }
    }
}



echo json_encode($json);
