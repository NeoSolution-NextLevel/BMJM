<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once __DIR__ . '/../../../imports/feature_flags/feature_flags.php';

// Controllers for storing Income/Expense dependencies
include_once __DIR__ . '/../../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
include_once __DIR__ . '/../../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
include_once __DIR__ . '/../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/income_expence_type/income_expence_type_LIST.php';
include_once __DIR__ . '/../../../Controller/income_expence_type/income_expence_type_ADD_UPDATE.php';

$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Backend guard: block new collection expenses when feature is disabled.
    if (!$BMJM_FEATURE_COLLECTION) {
        bmjm_feature_guard(false, 'Collection Payment');
    }


    $check_login_obj = new Cook_Management($user_main_cook_id);

    if ($check_login_obj->check_login_availability()) {
        $user_id = $check_login_obj->get_user_id();

        $project_id = isset($_POST['project_id']) ? intval($_POST['project_id']) : 0;
        $date       = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
        $amount     = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
        $desc       = isset($_POST['description']) ? $_POST['description'] : '';
        // Optional payload items like vendor, payment_method skipped or utilized as needed in extended logic

        if ($project_id > 0 && $amount > 0 && $desc !== '') {
            
            // 1. Create Core Income/Expense Record
            $ie_data = new income_expence_data_ADD_UPDATE($user_id);
            // In user patterns they feed date/time format, let's attach current time to date string if needed
            $full_datetime = $date . " " . date('H:i:s');
            $ie_data->get_data($full_datetime, $amount, $desc);
            $ie_data->is_not_is_type_income(); // It's strictly an Expense
            $ie_data->is_is_type_expece();
            $ie_data->is_finish_state();
            
            if ($ie_data->process_new_record()) {
                $new_ie_data_id = $ie_data->get_id();
                
                // Automatically fetch the assigned category ID based strictly on core 3 Tables
                $project_type_id = 0;
                $prj = new wwjm_projects_collection_list_SINGLE_DATA($project_id);
                if ($prj->get_state()) {
                    $proj_name = $prj->get_project_name();
                    $inc_type_list = new income_expence_type_LIST();
                    $inc_type_list->get_all_data();
                    $inc_type_list->filter_by_income_expence_type_name($proj_name);
                    $res_inc_type = $inc_type_list->get_result();
                    if ($res_inc_type && $row_inc = $res_inc_type->fetch_assoc()) {
                        $project_type_id = $row_inc['id'];
                    } else {
                        // Dynamically create the category layer natively to match the project schema
                        $new_inc_type = new income_expence_type_ADD_UPDATE($user_id);
                        $new_inc_type->get_data($proj_name);
                        $new_inc_type->is_is_income_type();
                        $new_inc_type->is_is_expece_type(); 
                        $new_inc_type->process_new_record();
                        $project_type_id = $new_inc_type->get_id();
                    }
                }
                
                // 2. Map Info List for the Expense
                $ie_info = new income_expence_data_info_list_ADD_UPDATE($user_id);
                $ie_info->get_data($desc, $amount, $new_ie_data_id, $project_type_id);
                $ie_info->is_not_is_type_of_income();
                $ie_info->is_is_type_of_expence();
                
                if ($ie_info->process_new_record()) {
                    $state['error'] = "0";
                    $state['msg'] = "Expense submitted successfully in ledger.";
                } else {
                    $state['error'] = $ie_info->get_error();
                }
            } else {
                $state['error'] = $ie_data->get_error();
            }

        } else {
            $state['error'] = "Missing mandatory fields (Valid Project ID, Amount, Description).";
        }

        $json[] = $state;
    } else {
        $state['error'] = $check_login_obj->get_error_msg();
        $json[] = $state;
    }
}

echo json_encode($json);
?>
