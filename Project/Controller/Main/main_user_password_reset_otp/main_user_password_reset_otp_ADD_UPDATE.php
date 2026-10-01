<?php

class main_user_password_reset_otp_ADD_UPDATE
{
    private $id;
    private $request_token_hash;
    private $otp_hash;
    private $delivery_method;
    private $attempts = 0;
    private $expires_at;
    private $verified_at;
    private $used_at;
    private $main_user_login_id;
    private $ast = "1";
    private $sdt;
    private $error_msg = '';
    private $sql_update_data = [];

    public function __construct($user_login_id)
    {
        $this->main_user_login_id = (int) $user_login_id;
        $this->sdt = date('Y-m-d H:i:s');
    }

    public function set_data($request_token_hash, $otp_hash, $delivery_method, $expires_at)
    {
        $this->set_request_token_hash($request_token_hash);
        $this->set_otp_hash($otp_hash);
        $this->set_delivery_method($delivery_method);
        $this->set_expires_at($expires_at);
    }

    public function set_id($get_id)
    {
        $this->id = (int) $get_id;
    }

    public function set_request_token_hash($get_request_token_hash)
    {
        $this->request_token_hash = (string) $get_request_token_hash;
        $this->sql_update_data['request_token_hash'] = $this->request_token_hash;
    }

    public function set_otp_hash($get_otp_hash)
    {
        $this->otp_hash = (string) $get_otp_hash;
        $this->sql_update_data['otp_hash'] = $this->otp_hash;
    }

    public function set_delivery_method($get_delivery_method)
    {
        $this->delivery_method = (string) $get_delivery_method;
        $this->sql_update_data['delivery_method'] = $this->delivery_method;
    }

    public function set_attempts($get_attempts)
    {
        $this->attempts = max(0, (int) $get_attempts);
        $this->sql_update_data['attempts'] = $this->attempts;
    }

    public function set_expires_at($get_expires_at)
    {
        $this->expires_at = (string) $get_expires_at;
        $this->sql_update_data['expires_at'] = $this->expires_at;
    }

    public function set_verified_at($get_verified_at)
    {
        $this->verified_at = $get_verified_at === null ? null : (string) $get_verified_at;
        $this->sql_update_data['verified_at'] = $this->verified_at;
    }

    public function set_used_at($get_used_at)
    {
        $this->used_at = $get_used_at === null ? null : (string) $get_used_at;
        $this->sql_update_data['used_at'] = $this->used_at;
    }

    public function set_main_user_login_id($get_main_user_login_id)
    {
        $this->main_user_login_id = (int) $get_main_user_login_id;
        $this->sql_update_data['main_user_login_id'] = $this->main_user_login_id;
    }

    public function remove()
    {
        $this->ast = "0";
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_error()
    {
        return $this->error_msg;
    }

    public function process_new_record()
    {
        if (
            $this->main_user_login_id < 1
            || strlen($this->request_token_hash) !== 64
            || $this->otp_hash === ''
            || !in_array($this->delivery_method, ['email', 'sms'], true)
            || $this->expires_at === ''
        ) {
            $this->error_msg = 'Invalid password reset data.';
            return false;
        }

        $data_base_obj = new DataBase();
        $connection = $data_base_obj->get_data_base_connction();
        $statement = $connection->prepare(
            'INSERT INTO main_user_password_reset_otp
                (request_token_hash, otp_hash, delivery_method, attempts, expires_at,
                 verified_at, used_at, main_user_login_id, ast, sdt)
             VALUES (?, ?, ?, 0, ?, NULL, NULL, ?, ?, ?)'
        );

        if (!$statement) {
            $this->error_msg = $connection->error;
            return false;
        }

        $statement->bind_param(
            'ssssiss',
            $this->request_token_hash,
            $this->otp_hash,
            $this->delivery_method,
            $this->expires_at,
            $this->main_user_login_id,
            $this->ast,
            $this->sdt
        );
        $success = $statement->execute();
        $this->error_msg = $statement->error;
        if ($success) {
            $this->id = (int) $connection->insert_id;
        }
        $statement->close();

        return $success && $this->id > 0;
    }

    public function process_update()
    {
        if ($this->id < 1) {
            $this->error_msg = 'Invalid password reset record ID.';
            return false;
        }

        $data_base_obj = new DataBase();
        $connection = $data_base_obj->get_data_base_connction();
        $updates = ["ast='" . $connection->real_escape_string($this->ast) . "'"];

        foreach ($this->sql_update_data as $column => $value) {
            if ($value === null) {
                $updates[] = $column . '=NULL';
            } elseif (in_array($column, ['attempts', 'main_user_login_id'], true)) {
                $updates[] = $column . '=' . (int) $value;
            } else {
                $updates[] = $column . "='" . $connection->real_escape_string((string) $value) . "'";
            }
        }

        $query = 'UPDATE main_user_password_reset_otp SET '
            . implode(', ', $updates)
            . ' WHERE id=' . $this->id;
        $result = $connection->query($query);
        $this->error_msg = $connection->error;
        return $result !== false;
    }

    public function invalidate_active_records($get_main_user_login_id)
    {
        $user_id = (int) $get_main_user_login_id;
        $data_base_obj = new DataBase();
        $connection = $data_base_obj->get_data_base_connction();
        $statement = $connection->prepare(
            'UPDATE main_user_password_reset_otp
             SET used_at = CURRENT_TIMESTAMP
             WHERE main_user_login_id = ? AND ast = 1 AND used_at IS NULL'
        );
        $statement->bind_param('i', $user_id);
        $success = $statement->execute();
        $this->error_msg = $statement->error;
        $statement->close();
        return $success;
    }

    public function mark_verified($get_id)
    {
        $id = (int) $get_id;
        $data_base_obj = new DataBase();
        $connection = $data_base_obj->get_data_base_connction();
        $statement = $connection->prepare(
            'UPDATE main_user_password_reset_otp
             SET verified_at = CURRENT_TIMESTAMP
             WHERE id = ? AND ast = 1 AND used_at IS NULL
               AND expires_at >= CURRENT_TIMESTAMP
               AND COALESCE(attempts, 0) < 5'
        );
        $statement->bind_param('i', $id);
        $success = $statement->execute();
        $affected_rows = $statement->affected_rows;
        $this->error_msg = $statement->error;
        $statement->close();
        return $success && $affected_rows === 1;
    }

    public function mark_used($get_id)
    {
        $id = (int) $get_id;
        $data_base_obj = new DataBase();
        $connection = $data_base_obj->get_data_base_connction();
        $statement = $connection->prepare(
            'UPDATE main_user_password_reset_otp
             SET used_at = CURRENT_TIMESTAMP
             WHERE id = ? AND ast = 1 AND used_at IS NULL'
        );
        $statement->bind_param('i', $id);
        $success = $statement->execute();
        $affected_rows = $statement->affected_rows;
        $this->error_msg = $statement->error;
        $statement->close();
        return $success && $affected_rows === 1;
    }

    public function cleanup_old_records()
    {
        $data_base_obj = new DataBase();
        $result = $data_base_obj->get_result(
            "UPDATE main_user_password_reset_otp
             SET ast='0'
             WHERE ast='1' AND expires_at < DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 DAY)"
        );
        $this->error_msg = $data_base_obj->get_error();
        return $result !== false;
    }
}
