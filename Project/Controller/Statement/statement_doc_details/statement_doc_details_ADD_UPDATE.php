<?php

class statement_doc_details_ADD_UPDATE
{
    private $id;
    private $heading_data;
    private $dis;
    private $line_discount_value;
    private $line_discount_unit_price_amount;
    private $line_discount_unit_price_amount_USD;
    private $line_discount_total;
    private $line_discount_total_USD;
    private $unit_price;
    private $unit_price_USD;
    private $qty;
    private $total;
    private $total_USD;
    private $ast = "1";
    private $sdt;
    private $statement_doc_id;
    private $empty_state = "0";
    private $item_or_service;
    private $default_disocount_value;
    private $default_disocunt_unit_price_amount;
    private $default_disocunt_unit_price_amount_USD;
    private $default_default_total;
    private $default_default_total_USD;
    private $main_user_login_id;
    private $company_id;
    private $branch_id;
    private $line_discount_pesontage_state = "0";
    private $line_discount_value_state = "0";
    private $default_disoucnt_persontage_state = "0";
    private $default_discount_value_state = "0";
    private $secondary_dis;
    private $mesure_variable;
    private $total_disoucnt;
    private $total_disoucnt_USD;
    private $item_id;
    private $per_unit_kg;
    private $total_kg;
    private $active_other_currency_state = "0";
    private $other_currency_name;
    private $base_currency_state = "0";
    private $base_currency_name;
    private $other_currency_only_for_this_record = "0";
    private $exchange_reate;

    private $get_compnay_obj;
    private $sql_update_query = "";
    private $sql_query = "";

    private $error_msg;

    public function __construct($get_main_user_login_id)
    {
        $this->main_user_login_id = $get_main_user_login_id;
        $this->get_compnay_obj = new Company_Info_Variable_List();
        $this->sdt = date("Y-m-d H:i:s");

        $this->company_id = $this->get_compnay_obj->get_compnay_id();
        $this->branch_id = $this->get_compnay_obj->get_branch_id();
    }

    /* ================= NORMAL SETTERS ================= */

    public function set_heading_data($get_heading_data)
    {
        $this->heading_data = $get_heading_data;
        $this->sql_update_query .= ",heading_data='" . $this->heading_data . "'";
    }

    public function set_dis($get_dis)
    {
        $this->dis = $get_dis;
        $this->sql_update_query .= ",dis='" . $this->dis . "'";
    }

    public function set_line_discount_value($get_line_discount_value)
    {
        $this->line_discount_value = $get_line_discount_value;
        $this->sql_update_query .= ",line_discount_value='" . $this->line_discount_value . "'";
    }

    public function set_line_discount_unit_price_amount($get_line_discount_unit_price_amount)
    {
        $this->line_discount_unit_price_amount = $get_line_discount_unit_price_amount;
        $this->sql_update_query .= ",line_discount_unit_price_amount='" . $this->line_discount_unit_price_amount . "'";
    }

    public function set_line_discount_unit_price_amount_USD($get_line_discount_unit_price_amount_USD)
    {
        $this->line_discount_unit_price_amount_USD = $get_line_discount_unit_price_amount_USD;
        $this->sql_update_query .= ",line_discount_unit_price_amount_USD='" . $this->line_discount_unit_price_amount_USD . "'";
    }

    public function set_line_discount_total($get_line_discount_total)
    {
        $this->line_discount_total = $get_line_discount_total;
        $this->sql_update_query .= ",line_discount_total='" . $this->line_discount_total . "'";
    }

    public function set_line_discount_total_USD($get_line_discount_total_USD)
    {
        $this->line_discount_total_USD = $get_line_discount_total_USD;
        $this->sql_update_query .= ",line_discount_total_USD='" . $this->line_discount_total_USD . "'";
    }

    public function set_unit_price($get_unit_price)
    {
        $this->unit_price = $get_unit_price;
        $this->sql_update_query .= ",unit_price='" . $this->unit_price . "'";
    }

    public function set_unit_price_USD($get_unit_price_USD)
    {
        $this->unit_price_USD = $get_unit_price_USD;
        $this->sql_update_query .= ",unit_price_USD='" . $this->unit_price_USD . "'";
    }

    public function set_qty($get_qty)
    {
        $this->qty = $get_qty;
        $this->sql_update_query .= ",qty='" . $this->qty . "'";
    }

    public function set_total($get_total)
    {
        $this->total = $get_total;
        $this->sql_update_query .= ",total='" . $this->total . "'";
    }

    public function set_total_USD($get_total_USD)
    {
        $this->total_USD = $get_total_USD;
        $this->sql_update_query .= ",total_USD='" . $this->total_USD . "'";
    }

    public function set_statement_doc_id($get_statement_doc_id)
    {
        $this->statement_doc_id = $get_statement_doc_id;
        $this->sql_update_query .= ",statement_doc_id='" . $this->statement_doc_id . "'";
    }

    public function set_id($get_id)
    {
        $this->id = $get_id;
    }

    public function set_item_or_service($get_item_or_service)
    {
        $this->item_or_service = $get_item_or_service;
        $this->sql_update_query .= ",item_or_service='" . $this->item_or_service . "'";
    }

    public function set_default_disocount_value($get_default_disocount_value)
    {
        $this->default_disocount_value = $get_default_disocount_value;
        $this->sql_update_query .= ",default_disocount_value='" . $this->default_disocount_value . "'";
    }

    public function set_default_disocunt_unit_price_amount($get_default_disocunt_unit_price_amount)
    {
        $this->default_disocunt_unit_price_amount = $get_default_disocunt_unit_price_amount;
        $this->sql_update_query .= ",default_disocunt_unit_price_amount='" . $this->default_disocunt_unit_price_amount . "'";
    }

    public function set_default_disocunt_unit_price_amount_USD($get_default_disocunt_unit_price_amount_USD)
    {
        $this->default_disocunt_unit_price_amount_USD = $get_default_disocunt_unit_price_amount_USD;
        $this->sql_update_query .= ",default_disocunt_unit_price_amount_USD='" . $this->default_disocunt_unit_price_amount_USD . "'";
    }

    public function set_default_default_total($get_default_default_total)
    {
        $this->default_default_total = $get_default_default_total;
        $this->sql_update_query .= ",default_default_total='" . $this->default_default_total . "'";
    }

    public function set_default_default_total_USD($get_default_default_total_USD)
    {
        $this->default_default_total_USD = $get_default_default_total_USD;
        $this->sql_update_query .= ",default_default_total_USD='" . $this->default_default_total_USD . "'";
    }

    public function set_secondary_dis($get_secondary_dis)
    {
        $this->secondary_dis = $get_secondary_dis;
        $this->sql_update_query .= ",secondary_dis='" . $this->secondary_dis . "'";
    }

    public function set_mesure_variable($get_mesure_variable)
    {
        $this->mesure_variable = $get_mesure_variable;
        $this->sql_update_query .= ",mesure_variable='" . $this->mesure_variable . "'";
    }

    public function set_total_disoucnt($get_total_disoucnt)
    {
        $this->total_disoucnt = $get_total_disoucnt;
        $this->sql_update_query .= ",total_disoucnt='" . $this->total_disoucnt . "'";
    }

    public function set_total_disoucnt_USD($get_total_disoucnt_USD)
    {
        $this->total_disoucnt_USD = $get_total_disoucnt_USD;
        $this->sql_update_query .= ",total_disoucnt_USD='" . $this->total_disoucnt_USD . "'";
    }

    public function set_item_id($get_item_id)
    {
        $this->item_id = $get_item_id;
        $this->sql_update_query .= ",item_id='" . $this->item_id . "'";
    }

    public function set_per_unit_kg($get_per_unit_kg)
    {
        $this->per_unit_kg = $get_per_unit_kg;
        $this->sql_update_query .= ",per_unit_kg='" . $this->per_unit_kg . "'";
    }

    public function set_total_kg($get_total_kg)
    {
        $this->total_kg = $get_total_kg;
        $this->sql_update_query .= ",total_kg='" . $this->total_kg . "'";
    }

    public function set_other_currency_name($get_other_currency_name)
    {
        $this->other_currency_name = $get_other_currency_name;
        $this->sql_update_query .= ",other_currency_name='" . $this->other_currency_name . "'";
    }

    public function set_base_currency_name($get_base_currency_name)
    {
        $this->base_currency_name = $get_base_currency_name;
        $this->sql_update_query .= ",base_currency_name='" . $this->base_currency_name . "'";
    }

    public function set_exchange_reate($get_exchange_reate)
    {
        $this->exchange_reate = $get_exchange_reate;
        $this->sql_update_query .= ",exchange_reate='" . $this->exchange_reate . "'";
    }

    public function set_company_id($get_company_id)
    {
        $this->company_id = $get_company_id;
        $this->sql_update_query .= ",company_id='" . $this->company_id . "'";
    }

    public function set_branch_id($get_branch_id)
    {
        $this->branch_id = $get_branch_id;
        $this->sql_update_query .= ",branch_id='" . $this->branch_id . "'";
    }

    // AST STATE (ACTIVE / INACTIVE)
    public function is_active()
    {
        $this->ast = 1;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }

    public function is_not_active()
    {
        $this->ast = 0;
        $this->sql_update_query .= ",ast='" . $this->ast . "'";
    }

    /* ================= STATE FUNCTIONS ================= */

    public function is_empty_state()
    {
        $this->empty_state = 1;
        $this->sql_update_query .= ",empty_state='" . $this->empty_state . "'";
    }

    public function is_not_empty_state()
    {
        $this->empty_state = 0;
        $this->sql_update_query .= ",empty_state='" . $this->empty_state . "'";
    }

    public function is_line_discount_pesontage_state()
    {
        $this->line_discount_pesontage_state = 1;
        $this->sql_update_query .= ",line_discount_pesontage_state='" . $this->line_discount_pesontage_state . "'";
    }

    public function is_not_line_discount_pesontage_state()
    {
        $this->line_discount_pesontage_state = 0;
        $this->sql_update_query .= ",line_discount_pesontage_state='" . $this->line_discount_pesontage_state . "'";
    }

    public function is_line_discount_value_state()
    {
        $this->line_discount_value_state = 1;
        $this->sql_update_query .= ",line_discount_value_state='" . $this->line_discount_value_state . "'";
    }

    public function is_not_line_discount_value_state()
    {
        $this->line_discount_value_state = 0;
        $this->sql_update_query .= ",line_discount_value_state='" . $this->line_discount_value_state . "'";
    }

    public function is_default_disoucnt_persontage_state()
    {
        $this->default_disoucnt_persontage_state = 1;
        $this->sql_update_query .= ",default_disoucnt_persontage_state='" . $this->default_disoucnt_persontage_state . "'";
    }

    public function is_not_default_disoucnt_persontage_state()
    {
        $this->default_disoucnt_persontage_state = 0;
        $this->sql_update_query .= ",default_disoucnt_persontage_state='" . $this->default_disoucnt_persontage_state . "'";
    }

    public function is_default_discount_value_state()
    {
        $this->default_discount_value_state = 1;
        $this->sql_update_query .= ",default_discount_value_state='" . $this->default_discount_value_state . "'";
    }

    public function is_not_default_discount_value_state()
    {
        $this->default_discount_value_state = 0;
        $this->sql_update_query .= ",default_discount_value_state='" . $this->default_discount_value_state . "'";
    }

    public function is_active_other_currency_state()
    {
        $this->active_other_currency_state = 1;
        $this->sql_update_query .= ",active_other_currency_state='" . $this->active_other_currency_state . "'";
    }

    public function is_not_active_other_currency_state()
    {
        $this->active_other_currency_state = 0;
        $this->sql_update_query .= ",active_other_currency_state='" . $this->active_other_currency_state . "'";
    }

    public function is_base_currency_state()
    {
        $this->base_currency_state = 1;
        $this->sql_update_query .= ",base_currency_state='" . $this->base_currency_state . "'";
    }

    public function is_not_base_currency_state()
    {
        $this->base_currency_state = 0;
        $this->sql_update_query .= ",base_currency_state='" . $this->base_currency_state . "'";
    }

    public function is_other_currency_only_for_this_record()
    {
        $this->other_currency_only_for_this_record = 1;
        $this->sql_update_query .= ",other_currency_only_for_this_record='" . $this->other_currency_only_for_this_record . "'";
    }

    public function is_not_other_currency_only_for_this_record()
    {
        $this->other_currency_only_for_this_record = 0;
        $this->sql_update_query .= ",other_currency_only_for_this_record='" . $this->other_currency_only_for_this_record . "'";
    }

  

    public function set_all_data_to_using_only_cart_main_data_id(
        $get_heading_data,
        $get_dis,
        $get_unit_price,
        $get_qty,
        $get_statement_doc_id,
        $get_item_id,
        $get_per_unit_kg,
        $get_total_kg
    ) {

        $this->heading_data = $get_heading_data;
        $this->dis = $get_dis;
        $this->line_discount_value = "0";
        $this->line_discount_unit_price_amount = "0";
        $this->line_discount_unit_price_amount_USD = "0";
        $this->line_discount_total = "0";
        $this->line_discount_total_USD = "0";
        $this->unit_price = $get_unit_price;
        $this->unit_price_USD = "0";
        $this->qty = $get_qty;
        $this->total = $get_unit_price * $get_qty;
        $this->total_USD = "0";
        $this->statement_doc_id = $get_statement_doc_id;
        $this->empty_state = "0";
        $this->item_or_service = "1";
        $this->default_disocount_value = "0";
        $this->default_disocunt_unit_price_amount = "0";
        $this->default_disocunt_unit_price_amount_USD = "0";
        $this->default_default_total = $get_unit_price;
        $this->default_default_total_USD = "0";
        $this->line_discount_pesontage_state = "0";
        $this->line_discount_value_state = "0";
        $this->default_disoucnt_persontage_state = "0";
        $this->default_discount_value_state = "0";
        $this->secondary_dis = "Cart Order";
        $this->mesure_variable = "0";
        $this->total_disoucnt = "0";
        $this->total_disoucnt_USD = "0";
        $this->item_id = $get_item_id;
        $this->per_unit_kg = $get_per_unit_kg;
        $this->total_kg = $get_total_kg;
        $this->active_other_currency_state = "0";
        $this->other_currency_name = "No other currency";
        $this->base_currency_state = "1";
        $this->base_currency_name = $this->get_compnay_obj->get_default_currency();
        $this->other_currency_only_for_this_record = "0";
        $this->exchange_reate = "0";
    }

    /* ================= FINAL QUERY ================= */

    public function get_update_query()
    {
        return ltrim($this->sql_update_query, ',');
    }

    public function create_new_statement_doc_details()
    {
        $state_bool = false;
        $data_base_obj = new DataBase();

        $this->sql_query = "INSERT INTO statement_doc_details(
            heading_data,
            dis,
            line_discount_value,
            line_discount_unit_price_amount,
            line_discount_unit_price_amount_USD,
            line_discount_total,
            line_discount_total_USD,
            unit_price,
            unit_price_USD,
            qty,
            total,
            total_USD,
            ast,
            sdt,
            statement_doc_id,
            empty_state,
            item_or_service,
            default_disocount_value,
            default_disocunt_unit_price_amount,
            default_disocunt_unit_price_amount_USD,
            default_default_total,
            default_default_total_USD,
            main_user_login_id,
            company_id,
            branch_id,
            line_discount_pesontage_state,
            line_discount_value_state,
            default_disoucnt_persontage_state,
            default_discount_value_state,
            secondary_dis,
            mesure_variable,
            total_disoucnt,
            total_disoucnt_USD,
            item_id,
            per_unit_kg,
            total_kg,
            active_other_currency_state,
            other_currency_name,
            base_currency_state,
            base_currency_name,
            other_currency_only_for_this_record,
            exchange_reate
        ) VALUES (
            '" . $this->heading_data . "',
            '" . $this->dis . "',
            '" . $this->line_discount_value . "',
            '" . $this->line_discount_unit_price_amount . "',
            '" . $this->line_discount_unit_price_amount_USD . "',
            '" . $this->line_discount_total . "',
            '" . $this->line_discount_total_USD . "',
            '" . $this->unit_price . "',
            '" . $this->unit_price_USD . "',
            '" . $this->qty . "',
            '" . $this->total . "',
            '" . $this->total_USD . "',
            '" . $this->ast . "',
            '" . $this->sdt . "',
            '" . $this->statement_doc_id . "',
            '" . $this->empty_state . "',
            '" . $this->item_or_service . "',
            '" . $this->default_disocount_value . "',
            '" . $this->default_disocunt_unit_price_amount . "',
            '" . $this->default_disocunt_unit_price_amount_USD . "',
            '" . $this->default_default_total . "',
            '" . $this->default_default_total_USD . "',
            '" . $this->main_user_login_id . "',
            '" . $this->company_id . "',
            '" . $this->branch_id . "',
            '" . $this->line_discount_pesontage_state . "',
            '" . $this->line_discount_value_state . "',
            '" . $this->default_disoucnt_persontage_state . "',
            '" . $this->default_discount_value_state . "',
            '" . $this->secondary_dis . "',
            '" . $this->mesure_variable . "',
            '" . $this->total_disoucnt . "',
            '" . $this->total_disoucnt_USD . "',
            '" . $this->item_id . "',
            '" . $this->per_unit_kg . "',
            '" . $this->total_kg . "',
            '" . $this->active_other_currency_state . "',
            '" . $this->other_currency_name . "',
            '" . $this->base_currency_state . "',
            '" . $this->base_currency_name . "',
            '" . $this->other_currency_only_for_this_record . "',
            '" . $this->exchange_reate . "'
        )";

        $data_base_obj->get_result($this->sql_query);
        $this->id = $data_base_obj->get_id();

        if ($this->id > 0) {
            $state_bool = true;
        }

        return $state_bool;
    }

    public function process_update()
    {
        $data_base_obj = new DataBase();
        $get_sql_query = "update statement_doc_details set ast='" . $this->ast . "'" . $this->sql_update_query . " where id='" . $this->id . "'";

        $data_base_obj->get_result($get_sql_query);
        $this->error_msg = $data_base_obj->get_error_state_boolean();
        return $data_base_obj->get_error_state_boolean();
    }

    public function get_error_msg()
    {
        return $this->error_msg;
    }

    public function get_id()
    {
        return $this->id;
    }
}
