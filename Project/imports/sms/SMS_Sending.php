<?php

if (!class_exists('Company_Info_Variable_List')) {
    if (file_exists(__DIR__ . '/../Company_Info/Company_Info_Variable_List.php')) {
        include_once __DIR__ . '/../Company_Info/Company_Info_Variable_List.php';
    }
}

class SMS_Sending
{
    private $get_phone_no;
    private $message;
    private $sms_app_id;

    public function __construct($get_phone_no, $get_message)
    {
        // Sanitize phone number (strip whitespace, hyphens, brackets)
        $clean_phone = preg_replace('/[^0-9+]/', '', trim((string)$get_phone_no));
        if (str_starts_with($clean_phone, '+94')) {
            $clean_phone = '0' . substr($clean_phone, 3);
        }
        $this->get_phone_no = $clean_phone;
        $this->message = (string)$get_message;

        $company_obj = class_exists('Company_Info_Variable_List') ? new Company_Info_Variable_List() : null;
        $this->sms_app_id = ($company_obj && method_exists($company_obj, 'get_SMS_APP_id')) ? $company_obj->get_SMS_APP_id() : "VXpna0Q0K1owOHlVMi9GWjg1OTRHQT09";
    }

    public function send_message()
    {
        if (empty($this->get_phone_no) || empty($this->message)) {
            return json_encode(["status" => "error", "message" => "Empty phone number or message"]);
        }

        $url = "https://sms.neosolution.lk/api/send_sms.php";

        $post_data = [
            'app_id'    => $this->sms_app_id,
            'recipient' => $this->get_phone_no,
            'message'   => $this->message
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return json_encode(["status" => "error", "message" => $error_msg]);
        }
        curl_close($ch);

        return $response;
    }
}