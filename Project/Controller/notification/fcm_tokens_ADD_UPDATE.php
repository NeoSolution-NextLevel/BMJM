<?php

include_once __DIR__ . '/../../imports/need/DB.php';

class fcm_tokens_ADD_UPDATE
{
    private $wwjm_member_list_id;
    private $token;
    private $platform = 'android';
    private $ast = "1";
    private $sdt;
    private $error_msg;

    public function set_data($get_wwjm_member_list_id, $get_token, $get_platform = 'android')
    {
        $this->wwjm_member_list_id = (int) $get_wwjm_member_list_id;
        $this->token = trim((string) $get_token);
        $this->platform = $get_platform;
        $this->sdt = date("Y-m-d H:i:s");
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        if ($this->wwjm_member_list_id <= 0 || $this->token === '') {
            $this->error_msg = 'Missing member or token';
            return false;
        }

        $data_base_obj = new DataBase();
        $token = addslashes($this->token);
        $platform = addslashes($this->platform);
        $sdt = addslashes($this->sdt);
        $memberId = (int) $this->wwjm_member_list_id;

        $existingId = $this->find_id($data_base_obj, "select id from fcm_tokens where token='" . $token . "' limit 1");
        if ($existingId <= 0) {
            $existingId = $this->find_id(
                $data_base_obj,
                "select id from fcm_tokens where wwjm_member_list_id='" . $memberId . "' order by id desc limit 1"
            );
        }

        if ($existingId > 0) {
            $data_base_obj->get_result(
                "update fcm_tokens set token='" . $token . "', platform='" . $platform . "', sdt='" . $sdt . "', ast='1', wwjm_member_list_id='" . $memberId . "' where id='" . $existingId . "'"
            );
        } else {
            $data_base_obj->get_result(
                "insert into fcm_tokens (token, platform, sdt, ast, wwjm_member_list_id) values ('" . $token . "', '" . $platform . "', '" . $sdt . "', '1', '" . $memberId . "')"
            );
            $existingId = (int) $data_base_obj->get_id();
        }

        if ($existingId > 0) {
            $data_base_obj->get_result(
                "update fcm_tokens set ast='0' where id<>'" . $existingId . "' and (token='" . $token . "' or wwjm_member_list_id='" . $memberId . "')"
            );
        }

        $this->error_msg = $data_base_obj->get_error();
        return $data_base_obj->get_error_state_boolean();
    }

    private function find_id(DataBase $data_base_obj, $sql)
    {
        $result = $data_base_obj->get_result($sql);
        if ($result && $row = $result->fetch_assoc()) {
            return (int) $row['id'];
        }
        return 0;
    }
}
