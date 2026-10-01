<?php

class Email {

    private $email_address;
    private $subject;
    private $html_header_n_footer;
    private $html_data;
    private $heder_name = "";
    private $company_variable_list;
//    ===============================================================
    private $compnay_name;
    private $default_system_mail;

    public function __construct($email_address, $subject, $html_data) {
        $this->email_address = $email_address;
        $this->subject = $subject;
        $this->html_data = $html_data;
        $this->company_variable_list = new Company_Info_Variable_List();
        $this->compnay_name = $this->company_variable_list->get_compnay_name();
//        echo $this->company_variable_list->get_compnay_default_sending_email();
        $this->default_system_mail = $this->company_variable_list->get_compnay_default_sending_email();

        $this->set_html_header_n_footer();
    }

    private function set_html_header_n_footer() {
//        $this->html_header_n_footer = "<!DOCTYPE html>
//            <html lang='en'>
//            <head>
//            <meta charset='UTF-8'>
//            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
//            <title>" . $this->subject . "</title>
//            </head>
//    <style type='text/css'>
//        th{
//            border: 1px solid black;
//        }
//        .heading_name{
//            font-weight: bold;
//            padding: 1px;
//        }
//
//        .order_info_left_val{
//            font-weight: bold;
//            /*padding: 1px;*/
//            width: 40%;
//            border-bottom: 1px solid black;
//
//        }
//        .order_info_right_val{
//            width: 50%;
//            text-align: right;
//            border-bottom: 1px solid black;
//
//        }
//        .order_info_center_val{
//            width:10%;
//            padding: 5px;
//            border-bottom: 1px solid black;
//
//        }
//
//        table{
//            width: 100%;
//        }
//        .invoice_item_data{
//            padding-left: 15px;
//            padding-right: 15px;
//            border-bottom: 1px solid black;
//        }
//        .total_val_heder{
//            width: 80%;text-align: right;font-weight: bold;
//            font-size: 15px;
//            padding: 5px;
//            background-color: #878787;
//        }
//        .total_val_answer{
//            width: 20%;text-align: right;
//            font-size: 15px;
//            background-color: #878787;
//            font-weight: bold;
//        }
//        .footer {
//
//            
//            
//            width: 100%;                      
//            text-align: center;
//        }
//        table{
//            width: 100%;
//        }
//        .w3-justify{
//         text-align: justify;
//         }
//
//
//        .w3-button {
//            display: inline-block;
//            padding: 10px 20px;
//            background-color: #000;
//            color: #fff;
//            text-decoration: none;
//            border: none;
//            border-radius: 5px;
//            font-size: 16px;
//            cursor: pointer;
//            transition: background-color 0.3s ease;
//            font-weight: bold;
//            text-align: center;
//            width:100%;
//        }
//
//        .w3-button:hover {
//            background-color: #333;
//        }
//        </style>
//
//    <body>
//        <table style='width: 100%;'>
//            <tr>
//                <td>
//                    <center><img src='" . $this->company_variable_list->get_compnay_logo_url() . "' style='width: 100px;'></center>
//                </td>                
//            </tr>
//          <tr><td>" . $this->html_data . "</td></tr>
//           <tr style='height:50px;'><td></td></tr>
//        </table>
//        <div class='footer'>
//           <center><strong><small>" . $this->company_variable_list->get_compnay_footer_txt() . " </small></strong></center>
//           <br>
//           <center><strong><small>Design And Maintain by <a href='www.neosolution.lk'>Neo Solution </a></small></strong></center>
//        </div>
//    </body>
//</html>
//
//
//";
        $logo_url = htmlspecialchars($this->company_variable_list->get_compnay_logo_url(), ENT_QUOTES, 'UTF-8');
        $company_name = htmlspecialchars($this->company_variable_list->get_compnay_name(), ENT_QUOTES, 'UTF-8');

        $this->html_header_n_footer = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>" . $this->subject . "</title>
    <style type='text/css'>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }
        td {
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .heading_name {
            font-weight: bold;
        }
        .order_info_left_val, .order_info_right_val, .order_info_center_val {
            padding: 10px;
        }
        .order_info_left_val {
            font-weight: bold;
            width: 40%;
        }
        .order_info_right_val {
            width: 50%;
            text-align: right;
        }
        .order_info_center_val {
            width: 10%;
        }
        .invoice_item_data {
            padding: 15px;
        }
        .total_val_heder, .total_val_answer {
            font-size: 16px;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
        }
        .total_val_heder {
            width: 80%;
            text-align: right;
        }
        .total_val_answer {
            width: 20%;
            text-align: right;
            font-weight: bold;
        }
        .w3-button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            width: 100%;
            margin: 20px 0;
        }
        .w3-button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0;
            margin-top: 30px;
        }
        .footer small {
            color: #777;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style='text-align: center;'>
                <img src='" . $logo_url . "' width='100' alt='" . $company_name . " logo' style='display:block; width:100px; max-width:100px; height:auto; margin:0 auto; border:0; outline:none; text-decoration:none;'>
            </td>
        </tr>
        <tr>
            <td style='padding: 30px; text-align: center;'>
               
                " . $this->html_data . "
            </td>
        </tr>
        <tr style='height: 50px;'>
            <td></td>
        </tr>
    </table>
    <div class='footer'>
        <strong><small>" . $this->company_variable_list->get_compnay_footer_txt() . "</small></strong><br>
        <small>Design And Maintain by <a href='https://www.neosolution.lk'>Neo Solution</a></small>
    </div>
</body>
</html>";
    }

    private $cc_emails = [];
    private $bcc_emails = [];

    public function set_cc_email($get_name, $get_email) {
        $this->cc_emails[] = ['name' => $get_name, 'email' => $get_email];
    }

    public function set_bcc_email($get_name, $get_email) {
        $this->bcc_emails[] = ['name' => $get_name, 'email' => $get_email];
    }

    public function add_cc_email_data_bunch(array $recipients) {
        foreach ($recipients as $recipient) {
            if (isset($recipient['name']) && isset($recipient['email'])) {
                $this->cc_emails[] = $recipient;
            }
        }
    }

    public function add_bcc_email_data_bunch(array $recipients) {
        foreach ($recipients as $recipient) {
            if (isset($recipient['name']) && isset($recipient['email'])) {
                $this->bcc_emails[] = $recipient;
            }
        }
    }

    private $get_email_sending_obj;

    public function send_email() {
        $get_email_sending_obj = new Email_Sender($this->email_address, $this->subject, $this->html_header_n_footer);
        $get_email_sending_obj->add_bcc_email_data_bunch($this->bcc_emails);
        $get_email_sending_obj->add_cc_email_data_bunch($this->cc_emails);

        return $get_email_sending_obj->send();
    }
}
