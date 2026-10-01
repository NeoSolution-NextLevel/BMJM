<?php
class wwjm_projects_collection_list_SINGLE_DATA
{
    private $id;
    private $project_name;
    private $ast = "1";
    private $sdt;
    private $dis;
    private $image_pth;
    private $is_fix_budget;
    private $is_end_date;
    private $fix_amount;
    private $fix_end_date;
    private $is_cash;
    private $is_share_qr;
    private $is_bank_deposit;
    private $is_members_only;
    private $is_all_person;
    private $main_user_login_id;
    private $assign_bank_account;
    private $have_tickets;
    private $collected_amount;
    private $state_of_data = false;

    public function __construct($id)
    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_projects_collection_list WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);


        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {

                $this->id = $row['id'];
                $this->project_name = $row['project_name'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->dis = $row['dis'];
                $this->image_pth = $row['image_pth'];
                $this->is_fix_budget = $row['is_fix_budget'];
                $this->is_end_date = $row['is_end_date'];
                $this->fix_amount = $row['fix_amount'];
                $this->fix_end_date = $row['fix_end_date'];
                $this->is_cash = $row['is_cash'];
                $this->is_share_qr = $row['is_share_qr'];
                $this->is_bank_deposit = $row['is_bank_deposit'];
                $this->is_members_only = $row['is_members_only'];
                $this->is_all_person = $row['is_all_person'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->assign_bank_account = $row['assign_bank_account'];
                $this->have_tickets = $row['have_tickets'];
                $this->collected_amount = $row['collected_amount'];
            }
        }
    }
    // --- Getter functions ---
    public function get_state()
    {
        return $this->state_of_data;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function get_project_name()
    {
        return $this->project_name;
    }
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    public function get_dis()
    {
        return $this->dis;
    }
    public function get_image_pth()
    {
        return $this->image_pth;
    }
    public function get_is_fix_budget()
    {
        return $this->is_fix_budget;
    }
    public function get_is_end_date()
    {
        return $this->is_end_date;
    }
    public function get_fix_amount()
    {
        return $this->fix_amount;
    }
    public function get_fix_end_date()
    {
        return $this->fix_end_date;
    }
    public function get_is_cash()
    {
        return $this->is_cash;
    }
    public function get_is_share_qr()
    {
        return $this->is_share_qr;
    }
    public function get_is_bank_deposit()
    {
        return $this->is_bank_deposit;
    }
    public function get_is_members_only()
    {
        return $this->is_members_only;
    }
    public function get_is_all_person()
    {
        return $this->is_all_person;
    }   
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_assign_bank_account()
    {
        return $this->assign_bank_account;
    }

    public function get_have_tickets()
    {
        return $this->have_tickets;
    }

    public function get_collected_amount()
    {
        return $this->collected_amount;
    }
}
