<?php

class Bank_Code_Data {

    private $company_obj;
    private $bank_code;

    public function __construct($get_bank_code) {
        $this->bank_code = $get_bank_code;
        $this->company_obj = new Company_Info_Variable_List();
    }

    private $FixData = false;

    public function isFixData() {
        $this->FixData = true;
    }

    public function search_from_bank_branch_name($get_bank_branch_name) {
        if ($get_bank_branch_name == "") {
            $this->search_from_bank_branch_name = "";
        } else {
            if ($this->FixData) {
                $this->search_from_bank_branch_name = "&branch_name=" . $get_bank_branch_name . "&fix=0";
            } else {
                $this->search_from_bank_branch_name = "&branch_name=" . $get_bank_branch_name;
            }
        }
    }

    public function search_from_bank_branch_code($get_branch_no) {
        if ($get_branch_no == "") {
            $this->search_from_bank_branch_code = "";
        } else {
            if ($this->FixData) {
                $this->search_from_bank_branch_name = "&branch_code=" . $get_branch_no . "&fix=0";
            } else {
                $this->search_from_bank_branch_code = "&branch_code=" . $get_branch_no;
            }
        }
    }

    private $search_from_bank_branch_name;
    private $search_from_bank_branch_code;

    public function get_json() {
        $url = "https://data.neosolution.lk/Data-Sources/Bank/Bank_Branch_List.php?api_key=" . $this->company_obj->get_API_data_neosolution_lk() . "&bank_code=" . $this->bank_code . $this->search_from_bank_branch_name . $this->search_from_bank_branch_code;
        $url_encode = urlencode($url);
        $response_clint = curl_init($url);
        curl_setopt($response_clint, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($response_clint);
        return $response;
    }
}
