<?php

class statement_doc_details_SINGLE_DATA
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
    private $ast;
    private $sdt;
    private $statement_doc_id;
    private $empty_state;
    private $item_or_service;
    private $default_disocount_value;
    private $default_disocunt_unit_price_amount;
    private $default_disocunt_unit_price_amount_USD;
    private $default_default_total;
    private $default_default_total_USD;
    private $main_user_login_id;
    private $company_id;
    private $branch_id;
    private $line_discount_pesontage_state;
    private $line_discount_value_state;
    private $default_disoucnt_persontage_state;
    private $default_discount_value_state;
    private $secondary_dis;
    private $mesure_variable;
    private $total_disoucnt;
    private $total_disoucnt_USD;
    private $item_id;
    private $per_unit_kg;
    private $total_kg;
    private $active_other_currency_state;
    private $other_currency_name;
    private $base_currency_state;
    private $base_currency_name;
    private $other_currency_only_for_this_record;
    private $exchange_reate;
    private $state = false;

    public function __construct($detail_id)
    {
        $this->id = $detail_id;

        $data_base_obj = new DataBase();
        // Secure your query or use prepared statements where possible
        $get_sql_query = "SELECT * FROM statement_doc_details WHERE id='" . $this->id . "'";
        $get_result = $data_base_obj->get_result($get_sql_query);

        if ($get_result && $get_result->num_rows > 0) {
            while ($row = $get_result->fetch_assoc()) {
                $this->heading_data = $row['heading_data'];
                $this->dis = $row['dis'];
                $this->line_discount_value = $row['line_discount_value'];
                $this->line_discount_unit_price_amount = $row['line_discount_unit_price_amount'];
                $this->line_discount_unit_price_amount_USD = $row['line_discount_unit_price_amount_USD'];
                $this->line_discount_total = $row['line_discount_total'];
                $this->line_discount_total_USD = $row['line_discount_total_USD'];
                $this->unit_price = $row['unit_price'];
                $this->unit_price_USD = $row['unit_price_USD'];
                $this->qty = $row['qty'];
                $this->total = $row['total'];
                $this->total_USD = $row['total_USD'];
                $this->ast = $row['ast'];
                $this->sdt = $row['sdt'];
                $this->statement_doc_id = $row['statement_doc_id'];
                $this->empty_state = $row['empty_state'];
                $this->item_or_service = $row['item_or_service'];
                $this->default_disocount_value = $row['default_disocount_value'];
                $this->default_disocunt_unit_price_amount = $row['default_disocunt_unit_price_amount'];
                $this->default_disocunt_unit_price_amount_USD = $row['default_disocunt_unit_price_amount_USD'];
                $this->default_default_total = $row['default_default_total'];
                $this->default_default_total_USD = $row['default_default_total_USD'];
                $this->main_user_login_id = $row['main_user_login_id'];
                $this->company_id = $row['company_id'];
                $this->branch_id = $row['branch_id'];
                $this->line_discount_pesontage_state = $row['line_discount_pesontage_state'];
                $this->line_discount_value_state = $row['line_discount_value_state'];
                $this->default_disoucnt_persontage_state = $row['default_disoucnt_persontage_state'];
                $this->default_discount_value_state = $row['default_discount_value_state'];
                $this->secondary_dis = $row['secondary_dis'];
                $this->mesure_variable = $row['mesure_variable'];
                $this->total_disoucnt = $row['total_disoucnt'];
                $this->total_disoucnt_USD = $row['total_disoucnt_USD'];
                $this->item_id = $row['item_id'];
                $this->per_unit_kg = $row['per_unit_kg'];
                $this->total_kg = $row['total_kg'];
                $this->active_other_currency_state = $row['active_other_currency_state'];
                $this->other_currency_name = $row['other_currency_name'];
                $this->base_currency_state = $row['base_currency_state'];
                $this->base_currency_name = $row['base_currency_name'];
                $this->other_currency_only_for_this_record = $row['other_currency_only_for_this_record'];
                $this->exchange_reate = $row['exchange_reate'];
                $this->state = true;
            }
        }
    }

    // --- Getters ---

    // --- Getters for all variables ---

    public function get_id()
    {
        return $this->id;
    }

    public function get_heading_data()
    {
        return $this->heading_data;
    }

    public function get_dis()
    {
        return $this->dis;
    }

    public function get_line_discount_value()
    {
        return $this->line_discount_value;
    }

    public function get_line_discount_unit_price_amount()
    {
        return $this->line_discount_unit_price_amount;
    }

    public function get_line_discount_unit_price_amount_USD()
    {
        return $this->line_discount_unit_price_amount_USD;
    }

    public function get_line_discount_total()
    {
        return $this->line_discount_total;
    }

    public function get_line_discount_total_USD()
    {
        return $this->line_discount_total_USD;
    }

    public function get_unit_price()
    {
        return $this->unit_price;
    }

    public function get_unit_price_USD()
    {
        return $this->unit_price_USD;
    }

    public function get_qty()
    {
        return $this->qty;
    }

    public function get_total()
    {
        return $this->total;
    }

    public function get_total_USD()
    {
        return $this->total_USD;
    }

    public function get_ast()
    {
        return $this->ast;
    }

    public function get_sdt()
    {
        return $this->sdt;
    }

    public function get_statement_doc_id()
    {
        return $this->statement_doc_id;
    }

    public function get_empty_state()
    {
        return $this->empty_state;
    }

    public function get_item_or_service()
    {
        return $this->item_or_service;
    }

    public function get_default_disocount_value()
    {
        return $this->default_disocount_value;
    }

    public function get_default_disocunt_unit_price_amount()
    {
        return $this->default_disocunt_unit_price_amount;
    }

    public function get_default_disocunt_unit_price_amount_USD()
    {
        return $this->default_disocunt_unit_price_amount_USD;
    }

    public function get_default_default_total()
    {
        return $this->default_default_total;
    }

    public function get_default_default_total_USD()
    {
        return $this->default_default_total_USD;
    }

    public function get_main_user_login_id()
    {
        return $this->main_user_login_id;
    }

    public function get_company_id()
    {
        return $this->company_id;
    }

    public function get_branch_id()
    {
        return $this->branch_id;
    }

    public function get_line_discount_pesontage_state()
    {
        return $this->line_discount_pesontage_state;
    }

    public function get_line_discount_value_state()
    {
        return $this->line_discount_value_state;
    }

    public function get_default_disoucnt_persontage_state()
    {
        return $this->default_disoucnt_persontage_state;
    }

    public function get_default_discount_value_state()
    {
        return $this->default_discount_value_state;
    }

    public function get_secondary_dis()
    {
        return $this->secondary_dis;
    }

    public function get_mesure_variable()
    {
        return $this->mesure_variable;
    }

    public function get_total_disoucnt()
    {
        return $this->total_disoucnt;
    }

    public function get_total_disoucnt_USD()
    {
        return $this->total_disoucnt_USD;
    }

    public function get_item_id()
    {
        return $this->item_id;
    }

    public function get_per_unit_kg()
    {
        return $this->per_unit_kg;
    }

    public function get_total_kg()
    {
        return $this->total_kg;
    }

    public function get_active_other_currency_state()
    {
        return $this->active_other_currency_state;
    }

    public function get_other_currency_name()
    {
        return $this->other_currency_name;
    }

    public function get_base_currency_state()
    {
        return $this->base_currency_state;
    }

    public function get_base_currency_name()
    {
        return $this->base_currency_name;
    }

    public function get_other_currency_only_for_this_record()
    {
        return $this->other_currency_only_for_this_record;
    }

    public function get_exchange_reate()
    {
        return $this->exchange_reate;
    }

    // Add additional getters as needed for your specific logic
    public function get_state()
    {
        return $this->state;
    }
}
