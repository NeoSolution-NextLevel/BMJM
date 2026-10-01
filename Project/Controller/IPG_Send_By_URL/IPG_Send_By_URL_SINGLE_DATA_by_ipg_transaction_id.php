<?php

class IPG_Send_By_URL_SINGLE_DATA_by_ipg_transaction_id
{
    private $id;
    private $sec_id;
    private $ipg_transaction_id;
    private $payment_status;
    private $state_of_data = false;

    public function __construct($ipg_transaction_id)
    {
        $this->ipg_transaction_id = $ipg_transaction_id;

        $data_base_obj = new DataBase();
        
        // Prevent SQL injection by escaping the transaction ID
        $escaped_transaction_id = $data_base_obj->get_connection()->real_escape_string($this->ipg_transaction_id);
        
        $get_sql_query = "SELECT * FROM ipg_send_by_url WHERE ipg_transaction_id = '" . $escaped_transaction_id . "' ORDER BY id DESC LIMIT 1";
        $result = $data_base_obj->get_result($get_sql_query);

        if ($result->num_rows == 0) {
            $this->state_of_data = false;
        } else {
            $this->state_of_data = true;
            while ($result && $row = $result->fetch_assoc()) {
                $this->id                 = $row['id'];
                $this->sec_id             = $row['sec_id'];
                $this->ipg_transaction_id = $row['ipg_transaction_id'];
                $this->payment_status     = $row['payment_status'];
            }
        }
    }

    public function get_state()
    {
        return $this->state_of_data;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_sec_id()
    {
        return $this->sec_id;
    }

    public function get_ipg_transaction_id()
    {
        return $this->ipg_transaction_id;
    }

    public function get_payment_status()
    {
        return $this->payment_status;
    }
}
