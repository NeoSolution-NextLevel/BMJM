<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';

// Import necessary Controllers
include_once __DIR__ . '/../../../Controller/income_expence_data_info_list/income_expence_data_info_list_LIST.php';
include_once __DIR__ . '/../../../Controller/income_expence_data_info_list/income_expence_data_info_list_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/income_expence_type/income_expence_type_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/income_expence_type/income_expence_type_LIST.php';
include_once __DIR__ . '/../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';

$json = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($project_id > 0) {
        
        // Fetch precise category ID bound to this active Project ID via native name associations
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
            }
        }
        
        // Use standard expense lists bounded to this category
        $rel_list = new income_expence_data_info_list_LIST();
        $rel_list->get_all_data();
        $rel_list->filter_by_income_expence_type_id($project_type_id);
        $rel_list->filter_by_is_type_of_expence();
        $rel_list->set_data_limits(0, 9999);
        $result = $rel_list->get_result();
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                
                $info_list_id = $row['id'];
                
                // 2. Fetch specific transaction details via standard Object approach
                $info_data = new income_expence_data_info_list_SINGLE_DATA($info_list_id);
                
                // Validate record state and verify it's an expense strictly
                if ($info_data->get_state() && $info_data->get_ast() == 1 && $info_data->get_is_type_of_expence() == 1) {
                    
                    $type_name = "Uncategorized";
                    $type_id = $info_data->get_income_expence_type_id();
                    
                    // 3. Fetch specific Category name through related Object
                    if ($type_id > 0) {
                        $type_data = new income_expence_type_SINGLE_DATA($type_id);
                        if ($type_data->get_state() && $type_data->get_ast() == 1) {
                            $type_name = $type_data->get_income_expence_type_name();
                        }
                    }
                    
                    // Bundle Data
                    $json[] = array(
                        'id' => $info_list_id,
                        'date' => $info_data->get_sdt(),
                        'description' => $info_data->get_dis(),
                        'category' => $type_name,
                        'amount' => floatval($info_data->get_amount())
                    );
                }
            }
        }
    }
}

echo json_encode($json);
?>
