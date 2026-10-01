<?php
class wwjm_projects_collection_list_ADD_UPDATE
{
    private $id;
    private $project_name;
    private $ast = "1";
    private $sdt;
    private $dis;
    private $image_pth;
    private $is_fix_budget = 0;
    private $is_end_date = 0;
    private $fix_amount;
    private $fix_end_date;
    private $is_cash = 0;
    private $is_share_qr = 0;
    private $is_bank_deposit = 0;
    private $is_members_only = 0;
    private $is_all_person = 0;
    private $main_user_login_id;
    private $assign_bank_account = 0;
    private $have_tickets = 0;
    private $collected_amount = 0;
    private $sql_update_query = "";

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

   public function get_data($get_project_name, $get_dis, $get_image_pth, $get_fix_amount, $get_fix_end_date)
    {
        $this->project_name = $get_project_name;
        $this->dis = $get_dis;
        $this->image_pth = $get_image_pth;
        $this->fix_amount = $get_fix_amount;
        $this->fix_end_date = $get_fix_end_date;

        // Logic for UPDATE query (Handle Empty Date)
        if ($this->fix_end_date == "") {
            $end_date_sql = "NULL";
        } else {
            $end_date_sql = "'" . $this->fix_end_date . "'";
        }

        
        $this->sql_update_query =
            ",project_name='" . $this->project_name . "'" . 
            ",dis='" . $this->dis . "'" .
            ",image_pth='" . $this->image_pth . "'" .
            ",fix_amount='" . $this->fix_amount . "'" .
            ",fix_end_date=" . $end_date_sql;
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function is_is_fix_budget()
    {
        $this->is_fix_budget = 1;
        $this->sql_update_query .= ",is_fix_budget='" . $this->is_fix_budget . "'";
    }

    public function is_not_is_fix_budget()
    {
        $this->is_fix_budget = 0;
        $this->sql_update_query .= ",is_fix_budget='" . $this->is_fix_budget . "'";
    }

    public function is_is_end_date()
    {
        $this->is_end_date = 1;
        $this->sql_update_query .= ",is_end_date='" . $this->is_end_date . "'";
    }

    public function is_not_is_end_date()
    {
        $this->is_end_date = 0;
        $this->sql_update_query .= ",is_end_date='" . $this->is_end_date . "'";
    }

    public function is_is_cash()
    {
        $this->is_cash = 1;
        $this->sql_update_query .= ",is_cash='" . $this->is_cash . "'";
    }

    public function is_not_is_cash()
    {
        $this->is_cash = 0;
        $this->sql_update_query .= ",is_cash='" . $this->is_cash . "'";
    }

    public function is_is_share_qr()
    {
        $this->is_share_qr = 1;
        $this->sql_update_query .= ",is_share_qr='" . $this->is_share_qr . "'";
    }

    public function is_not_is_share_qr()
    {
        $this->is_share_qr = 0;
        $this->sql_update_query .= ",is_share_qr='" . $this->is_share_qr . "'";
    }

    public function is_is_bank_deposit()
    {
        $this->is_bank_deposit = 1;
        $this->sql_update_query .= ",is_bank_deposit='" . $this->is_bank_deposit . "'";
    }

    public function is_not_is_bank_deposit()
    {
        $this->is_bank_deposit = 0;
         $this->sql_update_query .= ",is_bank_deposit='" . $this->is_bank_deposit . "'";
    }

    public function is_is_members_only()
    {
        $this->is_members_only = 1;
        $this->sql_update_query .= ",is_members_only='" . $this->is_members_only . "'";
    }

    public function is_not_is_members_only()
    {
        $this->is_members_only = 0;
        $this->sql_update_query .= ",is_members_only='" . $this->is_members_only . "'";
    }

    public function is_is_all_person()
    {
        $this->is_all_person = 1;
        $this->sql_update_query .= ",is_all_person='" . $this->is_all_person . "'";
    }

    public function is_not_is_all_person()
    {
        $this->is_all_person = 0;
        $this->sql_update_query .= ",is_all_person='" . $this->is_all_person . "'";
    }

    public function set_project_name($get_project_name)
    {
        $this->project_name = $get_project_name;
        $this->sql_update_query .= ",project_name='" . $this->project_name . "'";
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }

    public function set_image_pth($get_image_pth)
    {
        $this->image_pth = $get_image_pth;
        $this->sql_update_query .= ",image_pth='" . $this->image_pth . "'";
    }

    public function set_fix_amount($get_fix_amount)
    {
        $this->fix_amount = $get_fix_amount;
        $this->sql_update_query .= ",fix_amount='" . $this->fix_amount . "'";
    }

    public function set_fix_end_date($get_fix_end_date)
    {
        $this->fix_end_date = $get_fix_end_date;
        $this->sql_update_query .= ",fix_end_date='" . $this->fix_end_date . "'";
    }

    public function is_assign_bank_account()
    {
        $this->assign_bank_account = 1;
        $this->sql_update_query .= ",assign_bank_account='" . $this->assign_bank_account . "'";
    }

    public function is_not_assign_bank_account()
    {
        $this->assign_bank_account = 0;
        $this->sql_update_query .= ",assign_bank_account='" . $this->assign_bank_account . "'";
    }

    public function is_have_tickets()
    {
        $this->have_tickets = 1;
        $this->sql_update_query .= ",have_tickets='" . $this->have_tickets . "'";
    }

    public function is_not_have_tickets()
    {
        $this->have_tickets = 0;
        $this->sql_update_query .= ",have_tickets='" . $this->have_tickets . "'";
    }

    public function remove()
    {
        $this->ast = "0";
    }

    public function set_collected_amount($get_collected_amount)
    {
        $this->collected_amount = $get_collected_amount;
        $this->sql_update_query .= ",collected_amount='" . $this->collected_amount . "'";
    }

    public function set_collected_amount_increment($get_amount)
    {
        // Safely increments collected_amount without fetching
        $this->sql_update_query .= ",collected_amount = COALESCE(collected_amount, 0) + " . floatval($get_amount);
    }

    private $error_msg;

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        $data_base_obj = new database();
        if ($this->fix_end_date == "") {
            $end_date_val = "NULL"; // No quotes here
        } else {
            $end_date_val = "'" . $this->fix_end_date . "'"; // Add quotes for valid date
        }

        $get_sql_query = "INSERT INTO wwjm_projects_collection_list
    (project_name, dis, image_pth, fix_amount, fix_end_date, is_fix_budget, is_end_date, is_cash, is_share_qr, is_bank_deposit, is_members_only, is_all_person, main_user_login_id, sdt, ast, assign_bank_account, have_tickets, collected_amount) 
    VALUES (
        '" . $this->project_name . "',
        '" . $this->dis . "',
        '" . $this->image_pth . "',
        '" . $this->fix_amount . "',
        " . $end_date_val . ",
        '" . $this->is_fix_budget . "',
        '" . $this->is_end_date . "',
        '" . $this->is_cash . "',
        '" . $this->is_share_qr . "',
        '" . $this->is_bank_deposit . "',
        '" . $this->is_members_only . "',
        '" . $this->is_all_person . "',
        '" . $this->main_user_login_id . "',
        '" . $this->sdt . "',
        '" . $this->ast . "',
        '" . $this->assign_bank_account . "',
        '" . $this->have_tickets . "',
        '" . $this->collected_amount . "'
     );";

     
        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        $this->id = $data_base_obj->get_id();
        return $data_base_obj->get_error_state_boolean();
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update wwjm_projects_collection_list set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }
}