<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';
include_once __DIR__ . '/../../../Controller/projects/collection_ticket_tiers/collection_ticket_tiers_LIST.php';
include_once __DIR__ . '/../../../Controller/projects/collection_bank_account/collection_bank_account_LIST.php';

$json = array();
$id = isset($_POST['id']) ? $_POST['id'] : 0;

$col = new wwjm_projects_collection_list_SINGLE_DATA($id);

if ($col->get_state()) {
    $json = array(
        'error' => 0,
        'id' => $col->get_id(),
        'project_name' => $col->get_project_name(),
        'dis' => $col->get_dis(),
        'project_img_pth' => $col->get_image_pth(),
        'fix_amount' => $col->get_fix_amount(),
        'is_fix_budget' => $col->get_is_fix_budget(),
        'is_end_date' => $col->get_is_end_date(),
        'fix_end_date' => $col->get_fix_end_date(),
        'is_members_only' => $col->get_is_members_only(),
        'is_share_qr' => $col->get_is_share_qr(),
        'is_cash' => $col->get_is_cash(),
        'assign_bank_account' => $col->get_assign_bank_account(),
        'have_tickets' => $col->get_have_tickets(),
        'collected_amount' => $col->get_collected_amount() ? floatval($col->get_collected_amount()) : 0
    );

    // Hydrate Secondary Ticket Array if applicable
    $t_list = new collection_ticket_tiers_LIST();
    $t_list->get_all_data();
    $t_list->filter_by_wwjm_projects_collection_list_id($id);
    $res_t = $t_list->get_result();
    $t_arr = array();
    if($res_t) {
        while($r_t = $res_t->fetch_assoc()) {
            $t_arr[] = array(
                'id' => $r_t['id'],
                'name' => isset($r_t['ticket_name']) ? $r_t['ticket_name'] : ("Ticket LKR " . number_format($r_t['price'], 2)),
                'price' => floatval($r_t['price']),
                'quantity' => ((int)$r_t['total_capacity'] > 0) ? (int)$r_t['total_capacity'] : null,
                'sold_qty' => ((int)$r_t['total_sold'] > 0) ? (int)$r_t['total_sold'] : 0
            );
        }
    }
    $json['tickets'] = $t_arr;

    // Hydrate Bank Identifier Linkage
    $b_list = new collection_bank_account_LIST();
    $b_list->get_all_data();
    $b_list->filter_by_wwjm_projects_collection_list_id($id);
    $res_b = $b_list->get_result();
    $json['bank_account_id'] = "";
    if($res_b && $r_b = $res_b->fetch_assoc()) {
        $json['bank_account_id'] = $r_b['bank_account_details_id'];
    }

} else {
    $json = array('error' => 1);
}

echo json_encode($json);
?>
