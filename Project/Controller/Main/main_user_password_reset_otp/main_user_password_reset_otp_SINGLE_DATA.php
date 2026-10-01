<?php
class main_user_password_reset_otp_SINGLE_DATA
{
    private $id;
    private $request_token_hash;
    private $otp_hash;
    private $delivery_method;
    private $attempts;
    private $expires_at;
    private $verified_at;
    private $used_at;
    private $main_user_login_id;
    private $ast;
    private $sdt;

    private $state_of_data = false;


    public function __construct($id)
    {
        $this->id = $id;


        $data_base_obj = new DataBase();
        $get_sql_query = "SELECT * FROM main_user_password_reset_otp WHERE id = '" . $this->id . "'";

        // echo $get_sql_query . "<br>";

        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->id                       = $row['id'];
                $this->request_token_hash       = $row['request_token_hash'];
                $this->otp_hash                 = $row['otp_hash'];
                $this->delivery_method          = $row['delivery_method'];
                $this->attempts                 = $row['attempts'];
                $this->expires_at               = $row['expires_at'];
                $this->verified_at              = $row['verified_at'];
                $this->used_at                  = $row['used_at'];
                $this->main_user_login_id       = $row['main_user_login_id'];
                $this->ast                      = $row['ast'];
                $this->sdt                      = $row['sdt'];
            }
        }
    }

    public function get_id()
    {
        return $this->id;
    }
    public function get_request_token_hash()
    {
        return $this->request_token_hash;
    }
    public function get_otp_hash()
    {
        return $this->otp_hash;
    }
    public function get_delivery_method()
    {
        return $this->delivery_method;
    }
    public function get_attempts()
    {
        return $this->attempts;
    }
    public function get_expires_at()
    {
        return $this->expires_at;
    }
    public function get_verified_at()
    {
        return $this->verified_at;
    }
    public function get_used_at()
    {
        return $this->used_at;
    }
    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }
    public function get_ast()
    {
        return $this->ast;
    }
    public function get_sdt()
    {
        return $this->sdt;
    }
    
    

}
