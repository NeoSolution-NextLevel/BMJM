<?php

class statement_doc_PAYMENT_INSERT
{
    private $main_user_login_id;
    private $statement_doc_id;
    private $amount;
    private $cus_sup_list_id;
    private $date;
    private $time;

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->date = date("Y-m-d");
        $this->time = date("H:i:s");
    }

    public function set_statement_doc_id($id) { $this->statement_doc_id = $id; }
    public function set_amount($amount) { $this->amount = $amount; }
    public function set_cus_sup_list_id($id) { $this->cus_sup_list_id = $id; }

    public function process_cash_payment()
    {
        $db = new DataBase();

        // 1. Fetch cus_sup_list_id if not set (prioritize passed ID)
        if (!$this->cus_sup_list_id && $this->statement_doc_id) {
            $sql_sup = "SELECT cus_sup_list_id FROM statement_doc_cus_sup_list WHERE statement_doc_id = '{$this->statement_doc_id}' LIMIT 1";
            $res_sup = $db->get_result($sql_sup);
            if ($res_sup && $row = $res_sup->fetch_assoc()) {
                $this->cus_sup_list_id = $row['cus_sup_list_id'];
            }
        }

        // 1b. Robust Fallback: If still missing, find supplier by Name/Email/Phone from header
        if (!$this->cus_sup_list_id && $this->statement_doc_id) {
            $sql_hdr = "SELECT cus_sup_name, email, phone_no FROM statement_doc WHERE id = '{$this->statement_doc_id}' LIMIT 1";
            $res_hdr = $db->get_result($sql_hdr);
            if ($res_hdr && $row_hdr = $res_hdr->fetch_assoc()) {
                $h_name  = $db->get_data_base_connction()->real_escape_string($row_hdr['cus_sup_name'] ?? '');
                $h_email = $db->get_data_base_connction()->real_escape_string($row_hdr['email'] ?? '');
                $h_phone = $db->get_data_base_connction()->real_escape_string($row_hdr['phone_no'] ?? '');

                if ($h_name != "" || $h_email != "" || $h_phone != "") {
                    // Search in cus_sup_list for a matching record
                    $sql_find = "SELECT id FROM cus_sup_list WHERE (name = '$h_name' AND name != '') OR (email = '$h_email' AND email != '') OR (phone_no = '$h_phone' AND phone_no != '') LIMIT 1";
                    $res_find = $db->get_result($sql_find);
                    if ($res_find && $row_find = $res_find->fetch_assoc()) {
                        $this->cus_sup_list_id = $row_find['id'];
                        
                        // Automatically REPAIR the link for future use
                        $sql_repair = "INSERT INTO statement_doc_cus_sup_list (statement_doc_id, cus_sup_list_id, main_user_login_id, ast) 
                                       VALUES ('{$this->statement_doc_id}', '{$this->cus_sup_list_id}', '{$this->main_user_login_id}', '1')";
                        $db->get_result($sql_repair);
                    }
                }
            }
        }

        // Prevent proceeding without critical IDs
        if (!$this->statement_doc_id) {
            return "Error: Statement Doc ID is missing.";
        }
        if (!$this->cus_sup_list_id) {
            return "Error: Supplier ID (cus_sup_list_id) could not be identified for Doc ID: " . $this->statement_doc_id . ". Please re-select the supplier in the details page then try again.";
        }

        // 2. Insert into statement_doc_payment_listing
        $sql1 = "INSERT INTO statement_doc_payment_listing (statement_doc_id, amount, date, time, main_user_login_id, ast) 
                 VALUES ('{$this->statement_doc_id}', '{$this->amount}', '{$this->date}', '{$this->time}', '{$this->main_user_login_id}', '1')";
        $db->get_result($sql1);
        if (!$db->get_error_state_boolean()) return "Error in table statement_doc_payment_listing: " . $db->get_error();
        $payment_listing_id = $db->get_id();

        // 3. Insert into statement_doc_payment_listing_cus_sup_data
        $sql2 = "INSERT INTO statement_doc_payment_listing_cus_sup_data (statement_doc_payment_listing_id, cus_sup_list_id, ast) 
                 VALUES ('{$payment_listing_id}', '{$this->cus_sup_list_id}', '1')";
        $db->get_result($sql2);
        if (!$db->get_error_state_boolean()) return "Error in table statement_doc_payment_listing_cus_sup_data: " . $db->get_error();

        // 4. Insert into statement_doc_payment_listing_user_account
        $sql3 = "INSERT INTO statement_doc_payment_listing_user_account (statement_doc_payment_listing_id, main_user_login_id, ast) 
                 VALUES ('{$payment_listing_id}', '{$this->main_user_login_id}', '1')";
        $db->get_result($sql3);
        if (!$db->get_error_state_boolean()) return "Error in table statement_doc_payment_listing_user_account: " . $db->get_error();

        // 5. Insert into statement_doc_payment_settlment_hisorty
        $sql4 = "INSERT INTO statement_doc_payment_settlment_hisorty (statement_doc_id, amount, date, time, main_user_login_id, ast) 
                 VALUES ('{$this->statement_doc_id}', '{$this->amount}', '{$this->date}', '{$this->time}', '{$this->main_user_login_id}', '1')";
        $db->get_result($sql4);
        if (!$db->get_error_state_boolean()) return "Error in table statement_doc_payment_settlment_hisorty: " . $db->get_error();
        $settlment_id = $db->get_id();

        // 6. Insert into statement_doc_payment_settlment_hisorty_user_account
        $sql5 = "INSERT INTO statement_doc_payment_settlment_hisorty_user_account (statement_doc_payment_settlment_hisorty_id, main_user_login_id, ast) 
                 VALUES ('{$settlment_id}', '{$this->main_user_login_id}', '1')";
        $db->get_result($sql5);
        if (!$db->get_error_state_boolean()) return "Error in table statement_doc_payment_settlment_hisorty_user_account: " . $db->get_error();

        // 7. Update statement_doc status and amounts
        // Handle legacy records where due_amount may not have been initialized (use final_total fallback)
        $sql6 = "UPDATE statement_doc 
                 SET finish_staet='1', 
                     payed_amount = COALESCE(payed_amount, 0) + '{$this->amount}',
                     due_amount = CASE 
                        WHEN (due_amount IS NULL OR due_amount = 0) AND final_total > 0 THEN final_total - '{$this->amount}'
                        ELSE COALESCE(due_amount, 0) - '{$this->amount}'
                     END
                 WHERE id='{$this->statement_doc_id}'";
        $db->get_result($sql6);
        if (!$db->get_error_state_boolean()) return "Error updating GRN status and amounts: " . $db->get_error();

        return "success";
    }
}
