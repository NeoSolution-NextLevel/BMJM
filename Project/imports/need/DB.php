<?php

// Create connection
function database()
{

    $get_database = new DataBase();
    return $get_database->get_data_base_connction();
}

//database();


class DataBase
{

    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $db_connction;
    private $last_insert_id = 0;

    public function __construct()
    {
        //        $this->servername = "localhost";
        //        $this->username = "admin";
        //        $this->password = "";
        //        $this->dbname = "statement_report";


        //        ----------ansif pc--------------
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "bmjm";


        // //server details 
        // $this->servername = "127.0.0.1";
        // $this->username = "bmjm";
        // $this->password = "JjEy_gSuCbGfck";
        // $this->dbname = "bmjm";       




    }

    public function __destruct()
    {
        $this->close_connction();
    }

    public function get_data_base_connction()
    {
        if ($this->db_connction instanceof mysqli) {
            return $this->db_connction;
        }

        $connection = @new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $connection->set_charset("utf8mb4");
        $connection->query("SET time_zone = '+05:30'");
        $this->db_connction = $connection;

        return $this->db_connction;
    }

    public function close_connction()
    {
        if ($this->db_connction instanceof mysqli) {
            @$this->db_connction->close();
        }
        $this->db_connction = null;
    }

    public function get_result($get_sql_query)
    {
        $this->get_data_base_connction();
        $result = $this->db_connction->query($get_sql_query);
        $insertId = (int) $this->db_connction->insert_id;
        if ($insertId > 0) {
            $this->last_insert_id = $insertId;
        }
        return $result;
    }

    public function get_id()
    {
        if ($this->last_insert_id > 0) {
            return $this->last_insert_id;
        }
        return $this->db_connction ? (int) $this->db_connction->insert_id : 0;
    }

    public function get_affected_rows()
    {
        return $this->db_connction ? (int) $this->db_connction->affected_rows : 0;
    }

    public function get_error()
    {
        return $this->db_connction->error;
    }

    public function sql_escape_string($get_string)
    {
        return $get_string;
    }

    public function real_escape_string($get_string)
    {
        return $get_string;
    }

    public function get_error_state_boolean()
    {
        $state = false;
        if ($this->db_connction->error == "") {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }
}
