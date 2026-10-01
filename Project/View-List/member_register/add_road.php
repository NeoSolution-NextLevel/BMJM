<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/member_register/wwjm_road_name/wwjm_road_name_ADD_UPDATE.php';
include_once '../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once '../../Controller/member_register/wwjm_road_name/wwjm_road_name_LIST.php';

$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $check_login_obj = new Cook_Management($user_main_cook_id);

    if ($check_login_obj->check_login_availability()) {
        $road = new wwjm_road_name_ADD_UPDATE($check_login_obj->get_user_id());
        $road_list_obj = new wwjm_road_name_LIST();


        if (isset($_POST['id'])) {
            $road->set_id($_POST['id']);

            if (isset($_POST['remove']) && $_POST['remove'] == '1') {
                // Call remove method and then update to mark as deleted
                $road->remove();
                if ($road->process_update()) {
                    $state['error'] = "0";
                    $state['id'] = $_POST['id'];
                } else {
                    $state['error'] = $road->get_error();
                }
                $json[] = $state;
                echo json_encode($json);
                exit;
            }
        }

        if (isset($_POST['val_01'])) {
            $road_name = $_POST['val_01'];
            $road->get_data($road_name, $check_login_obj->get_user_id());

            $road_list_obj->search_from_road_name($road_name);
            $get_result = $road_list_obj->get_result();

            if ($get_result && $get_result->num_rows == 0) {
                if (isset($_POST['id'])) {
                    if ($road->process_update()) {
                        $state['error'] = "0";
                        $state['id'] = $_POST['id'];
                    } else {
                        $state['error'] = $road->get_error();
                    }
                } else {
                    if ($road->process_new_record()) {
                        $state['error'] = "0";
                        $state['id'] = $road->get_id();
                    } else {
                        $state['error'] = $road->get_error();
                    }
                }
            } else {
                $state['error'] = "1";
                $state['message'] = "Already have this road";
            }

            $json[] = $state;
        } else {
            $state['error'] = "Missing required fields";
            $json[] = $state;
        }
    } else {
        $state['error'] = $check_login_obj->get_error_msg();
        $json[] = $state;
    }
} else {
    $state['error'] = "Invalid request method";
    $json[] = $state;
}

echo json_encode($json);
