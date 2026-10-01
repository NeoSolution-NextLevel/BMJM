<?php

class wwjm_payment_slip_SINGLE_DATA
{

    private $id;
    private $payment_date;
    private $ast;
    private $sdt;
    private $amount;
    private $dis;
    private $is_cash;
    private $is_bank_deposit;
    private $is_IPG;
    private $slip_print;
    private $pay_resion_subcption;
    private $pay_resion_donation;
    private $pay_resion_zakath;
    private $pay_resion_projects;
    private $is_member;
    private $main_user_login_id;
    private $person_name;
    private $address;
    private $membership_no;
    private $email;
    private $phone_number;
    private $state_of_data = false;

    public function __construct($id)

    {
        $this->id = $id;

        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM wwjm_payment_slip WHERE id = '" . $this->id . "'";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->payment_date = $row['payment_date'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->amount = $row['amount'];
                $this->dis = $row['dis'];
                $this->is_cash = $row['is_cash'];
                $this->is_bank_deposit = $row['is_bank_deposit'];
                $this->is_IPG = $row['is_IPG'];
                $this->slip_print = $row['slip_print'];
                $this->pay_resion_subcption = $row['pay_resion_subcption'];
                $this->pay_resion_donation = $row['pay_resion_donation'];
                $this->pay_resion_zakath = $row['pay_resion_zakath'];
                $this->pay_resion_projects = $row['pay_resion_projects'];
                $this->is_member = $row['is_member'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->person_name = $row['person_name'];
                $this->address = $row['address'];
                $this->membership_no = $row['membership_no'];
                $this->email = $row['email'];
                $this->phone_number = $row['phone_number'];
            }
        }
    }

    public function get_state()
    {
        return $this->state_of_data;
    }

    public function get_phone_number()
    {
        return $this->phone_number;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_ast()
    {
        return $this->ast;
    }


    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_payment_date()
    {
        return $this->payment_date;
    }

    public function get_amount()
    {
        return $this->amount;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_is_cash()
    {
        return $this->is_cash;
    }

    public function get_is_bank_deposit()
    {
        return $this->is_bank_deposit;
    }

    public function get_is_IPG()
    {
        return $this->is_IPG;
    }

    public function get_slip_print()
    {
        return $this->slip_print;
    }

    public function get_pay_resion_subcption()
    {
        return $this->pay_resion_subcption;
    }

    public function get_pay_resion_donation()
    {
        return $this->pay_resion_donation;
    }

    public function get_pay_resion_zakath()
    {
        return $this->pay_resion_zakath;
    }

    public function get_pay_resion_projects()
    {
        return $this->pay_resion_projects;
    }

    public function get_is_member()
    {
        return $this->is_member;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_person_name()
    {
        return $this->person_name;
    }

    public function get_address()
    {
        return $this->address;
    }

    public function get_membership_no()
    {
        return $this->membership_no;
    }
}
