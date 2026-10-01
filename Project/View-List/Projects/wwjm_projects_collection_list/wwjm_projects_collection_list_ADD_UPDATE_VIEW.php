<?php
session_start();
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';
include_once '../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE.php';
include_once '../../../Controller/projects/collection_ticket_tiers/collection_ticket_tiers_ADD_UPDATE.php';
include_once '../../../Controller/projects/collection_bank_account/collection_bank_account_ADD_UPDATE.php';

// Validate User Session First
$main_user_login_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Fallback to 1 if session is bypassed

// Process basic POST parameters
$name = isset($_POST['name']) ? trim($_POST['name']) : "";
$description = isset($_POST['description']) ? trim($_POST['description']) : "";

$budget = isset($_POST['budget']) && $_POST['budget'] != "" ? $_POST['budget'] : 0;
$end_date = isset($_POST['end_date']) && $_POST['end_date'] != "" ? $_POST['end_date'] : "";
$end_time = isset($_POST['end_time']) && $_POST['end_time'] != "" ? $_POST['end_time'] : "00:00:00";
$fix_end_date = ($end_date != "") ? $end_date . " " . $end_time : "";

$bank_account = isset($_POST['bank_account']) ? $_POST['bank_account'] : "";
$visibility = isset($_POST['visibility']) ? $_POST['visibility'] : "";

$tickets_data = isset($_POST['tickets_data']) ? $_POST['tickets_data'] : "[]";

// -----------------------------------------------------
// 1. Process Cover Image Upload
// -----------------------------------------------------
$image_pth = "";
if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../../../Uploads/Projects/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
    $file_extension = pathinfo($_FILES["cover_image"]["name"], PATHINFO_EXTENSION);
    $new_filename = "COL_IMG_" . time() . "_" . uniqid() . "." . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
        $image_pth = "Uploads/Projects/" . $new_filename;
    }
}

// -----------------------------------------------------
// 2. Transact Main Collection Data
// -----------------------------------------------------
$id = isset($_POST['id']) ? trim($_POST['id']) : "";

$colln = new wwjm_projects_collection_list_ADD_UPDATE($main_user_login_id);

if ($id != "" && $id != "0") {
    $colln->set_id($id);
    if ($image_pth == "") {
         include_once '../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';
         $old = new wwjm_projects_collection_list_SINGLE_DATA($id);
         $image_pth = $old->get_image_pth();
    }
}

$colln->get_data($name, $description, $image_pth, $budget, $fix_end_date);

// Conditional Booleans
if ($budget > 0) $colln->is_is_fix_budget(); else $colln->is_not_is_fix_budget();
if ($fix_end_date != "") $colln->is_is_end_date(); else $colln->is_not_is_end_date();

// Assume check values exist
$colln->is_is_cash();
$colln->is_is_share_qr();

if ($bank_account != "") { $colln->is_assign_bank_account(); } 
else { $colln->is_not_assign_bank_account(); }

$tickets_array = json_decode($tickets_data, true);
if (is_array($tickets_array) && count($tickets_array) > 0) { $colln->is_have_tickets(); } 
else { $colln->is_not_have_tickets(); }

if ($visibility == "members") {
    $colln->is_is_members_only();
    $colln->is_not_is_all_person();
} else {
    $colln->is_not_is_members_only();
    $colln->is_is_all_person();
}

// Save Project Header Branch
if ($id != "" && $id != "0") {
    $status = $colln->process_update();
    $new_collection_id = $id;

    // Soft delete older relational mappings to clear space for the new sync array
    $db = new DataBase();
    $db->get_result("UPDATE collection_ticket_tiers SET ast=0 WHERE wwjm_projects_collection_list_id = '$new_collection_id'");
    $db->get_result("UPDATE collection_bank_account SET ast=0 WHERE wwjm_projects_collection_list_id = '$new_collection_id'");
} else {
    $status = $colln->process_new_record();
    $new_collection_id = $colln->get_id();
}

if ($status) {
    // -----------------------------------------------------
    // 3. Transact Ticket Tiers (if applicable)
    // -----------------------------------------------------
    if (is_array($tickets_array) && count($tickets_array) > 0) {
        foreach ($tickets_array as $t) {
            $price = $t['price'];
            $capacity = isset($t['quantity']) ? $t['quantity'] : "";
            
            $tier = new collection_ticket_tiers_ADD_UPDATE($main_user_login_id);
            $tier->get_data($new_collection_id, $price, $capacity);
            $tier->is_show_on_web();
            $tier->process_new_record();
        }
    }
    
    // -----------------------------------------------------
    // 4. Transact Normalized Bank Route
    // -----------------------------------------------------
    if ($bank_account != "") {
        $bank_route = new collection_bank_account_ADD_UPDATE($main_user_login_id);
        $bank_route->get_data($new_collection_id, $bank_account);
        $bank_route->process_new_record();
    }
    
    echo "1"; // Success Echo
} else {
    echo $colln->get_error(); // Fail Echo
}
?>
