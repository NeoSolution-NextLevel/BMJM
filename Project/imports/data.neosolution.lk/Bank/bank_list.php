<?php

class Bank_Data {

    private $company_obj;

    public function __construct() {
        $this->company_obj = new Company_Info_Variable_List();
    }

    private $FixData = false;

    public function isFixData() {
        $this->FixData = true;
    }

    public function search_from_bank_name($get_bank_name) {
        if ($get_bank_name == "") {
            $this->search_value_bank_name = "";
        } else {
            if ($this->FixData) {
                $this->search_value_bank_name = "&name=" . $get_bank_name . "&fix=0";
            } else {
                $this->search_value_bank_name = "&name=" . $get_bank_name;
            }
        }
    }

    public function search_from_bank_branch($get_branch_no) {
        if ($get_branch_no == "") {
            $this->search_value_bank_branch = "";
        } else {
            if ($this->FixData) {
                $this->search_value_bank_branch = "&code=" . $get_branch_no . "&fix=0";
            } else {
                $this->search_value_bank_branch = "&code=" . $get_branch_no;
            }
        }
    }

    private $search_value_bank_name;
    private $search_value_bank_branch;

    public function get_json() {
        $url = "https://data.neosolution.lk/Data-Sources/Bank/Bank_Name.php?api_key=" . $this->company_obj->get_API_data_neosolution_lk() . "" . $this->search_value_bank_name . $this->search_value_bank_branch;
        $url_encode = urlencode($url);
        $response_clint = curl_init($url);
        curl_setopt($response_clint, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($response_clint);
        return $response;
    }
}
