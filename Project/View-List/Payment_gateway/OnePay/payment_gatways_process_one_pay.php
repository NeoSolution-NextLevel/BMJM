<?php
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';
include_once '../../../imports/Company_Info/Company_Info_Variable_List.php';
include_once '../../../Controller/Main/Cook_Managment/Cook_Managing.php';

// Controllers for Statement Doc
include_once '../../../Controller/Statement/statement_doc/statement_doc_SINGLE_DATA.php';
include_once '../../../Controller/Statement/statement_doc_ipg_list/statement_doc_ipg_list_ADD_UPDATE.php';

// Controllers for IPG Send By URL
include_once '../../../imports/security/key_list.php';
include_once '../../../imports/security/encrypt_decrypt.php';
include_once '../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_Sec_id_SINGLE_DATA.php';

$company_obj = new Company_Info_Variable_List();
$cookie_check_obj = new Cook_Management($user_main_cook_id);

if (isset($_POST['ipg_send_by_url_sec_id'])) {
    $trn_amount = isset($_POST['customer-pay-amount']) ? floatval($_POST['customer-pay-amount']) : 0;

    if ($trn_amount > 0) {
        $raw_id = trim($_POST['ipg_send_by_url_sec_id']);

        $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
        $Advance_Security_obj = new Advance_Security();
        $decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $raw_id);

        $statement_doc_SINGLE_DATA_obj = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($decrypted_sec_id);
        if (!$statement_doc_SINGLE_DATA_obj->get_state()) {
            $statement_doc_SINGLE_DATA_obj = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($raw_id);
        }

        if ($statement_doc_SINGLE_DATA_obj->get_state()) {

            $get_currency_value = "LKR";
            
            $cus_name_raw = $statement_doc_SINGLE_DATA_obj->get_cus_name();
            $cus_name = !empty(trim($cus_name_raw)) ? trim($cus_name_raw) : "Customer";
            $lastname = ($cus_name !== "Customer") ? $cus_name : "Member"; 
            $raw_phone = preg_replace('/[^0-9]/', '', $statement_doc_SINGLE_DATA_obj->get_cus_phone_no() ?? '');
            $cus_phone_no = (strlen($raw_phone) >= 9) ? $raw_phone : "0770000000";
            $raw_email = trim($statement_doc_SINGLE_DATA_obj->get_cus_email() ?? '');
            $email = filter_var($raw_email, FILTER_VALIDATE_EMAIL) ? $raw_email : "info@wwjm.lk";

            $get_Statement_doc_IPG_id = $statement_doc_SINGLE_DATA_obj->get_id(); // Map ID for reference
            
            $app_id = $company_obj->get_payment_gateway_one_pay_App_ID();
            $hash_salt = $company_obj->get_payment_gateway_one_pay_Hash_Salt();
            $app_token = $company_obj->get_payment_gateway_one_pay_App_Token();

            $amount_as_number = number_format((float)$trn_amount, 2, '.', '');

            $hash_string = $app_id . $get_currency_value . $amount_as_number . $hash_salt;
            $hash_result = hash('sha256', $hash_string);

            $request_payload = [
                "currency" => $get_currency_value,
                "amount" => $amount_as_number,
                "app_id" => $app_id,
                "reference" => sprintf('%010d', $get_Statement_doc_IPG_id),
                "customer_first_name" => $cus_name,
                "customer_last_name" => $lastname,
                "customer_phone_number" => $cus_phone_no,
                "customer_email" => $email,
                "transaction_redirect_url" => rtrim($company_obj->get_compnay_full_web(), '/') .  "/UxUi/Payment_IPG/IPG_Pay_Success.php",
                "hash" => $hash_result,
                "additional_data" => "IPG_Send_By_URL"
            ];

            $data = json_encode($request_payload, JSON_UNESCAPED_SLASHES);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.onepay.lk/v3/checkout/link/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => [
                    'Authorization: ' . $app_token,
                    'Content-Type: application/json'
                ],
            ]);
            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                $_SESSION['one_pay_error'] = "OnePay cURL Error: " . curl_error($curl);
                echo $_SESSION['one_pay_error']; exit();
            }

            $result = json_decode($response, true);
            
            // Save Transaction ID to Database
            include_once '../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_ADD_UPDATE.php';
            $IPG_Send_By_URL_ADD_UPDATE_obj = new IPG_Send_By_URL_ADD_UPDATE();
            $IPG_Send_By_URL_ADD_UPDATE_obj->set_id($get_Statement_doc_IPG_id);
            
            if (isset($result['data']['ipg_transaction_id'])) {
                $IPG_Send_By_URL_ADD_UPDATE_obj->set_ipg_transaction_id($result['data']['ipg_transaction_id']);
                $IPG_Send_By_URL_ADD_UPDATE_obj->process_update();
            }

            if (isset($result['data']['gateway']['redirect_url']) && !empty($result['data']['gateway']['redirect_url'])) {
                header('Location: ' . $result['data']['gateway']['redirect_url'], true, 302);
                exit();
            } else {
                $_SESSION['one_pay_error'] = "OnePay API Error Details:<br>App ID Length: " . strlen($app_id) . "<br>Token Length: " . strlen($app_token) . "<br>Hash generated: " . $hash_result . "<br>Raw Response: " . htmlspecialchars($response) . "<br>Status: " . ($result['message'] ?? "Unknown");
                echo $_SESSION['one_pay_error']; exit();
            }
        } else {
            $_SESSION['one_pay_error'] = "URL Validation Failed";
        }
    } else {
        $_SESSION['one_pay_error'] = "Invalid Amount";
    }
} else if (isset($_POST['checkout_page_statment_doc_id'])) {
    $trn_amount = isset($_POST['checkout_page_statment_doc_full_total_amount']) ? floatval($_POST['checkout_page_statment_doc_full_total_amount']) : 0;

    // echo $trn_amount . " test";

    if ($trn_amount > 0) {

        $statement_doc_id = isset($_POST['checkout_page_statment_doc_id']) ? floatval($_POST['checkout_page_statment_doc_id']) : 0;


        //statment doc single data 
        $statement_doc_SINGLE_DATA_obj = new statement_doc_SINGLE_DATA($statement_doc_id);

        if ($statement_doc_SINGLE_DATA_obj->get_state()) {


            if ($statement_doc_SINGLE_DATA_obj->get_base_currency_state() == "1") {
                $get_currency_value = $statement_doc_SINGLE_DATA_obj->get_base_currency_name();
            } else {
                $get_currency_value = $statement_doc_SINGLE_DATA_obj->get_ex_currency_name();
            }

            $cus_name_raw = $statement_doc_SINGLE_DATA_obj->get_cus_sup_name();
            $cus_name = !empty(trim($cus_name_raw)) ? trim($cus_name_raw) : "Customer";
            $lastname = ($cus_name !== "Customer") ? $cus_name : "Member";
            $raw_phone = preg_replace('/[^0-9]/', '', $statement_doc_SINGLE_DATA_obj->get_phone_no() ?? '');
            $cus_phone_no = (strlen($raw_phone) >= 9) ? $raw_phone : "0770000000";
            $raw_email = trim($statement_doc_SINGLE_DATA_obj->get_email() ?? '');
            $email = filter_var($raw_email, FILTER_VALIDATE_EMAIL) ? $raw_email : "info@wwjm.lk";



            $get_base_currency_state = $statement_doc_SINGLE_DATA_obj->get_base_currency_state();
            $get_base_currency = $statement_doc_SINGLE_DATA_obj->get_base_currency_name();
            $get_other_currency_state = $statement_doc_SINGLE_DATA_obj->get_exchange_currency_state();
            $get_exchange_reate = $statement_doc_SINGLE_DATA_obj->get_ex_currencty_base_currency_exange_rate();
            $get_other_currency = $statement_doc_SINGLE_DATA_obj->get_ex_currency_name();


            $statement_doc_ipg_list_ADD_UPDATE_obj = new statement_doc_ipg_list_ADD_UPDATE($cookie_check_obj->get_user_id());

            //set All data to IPG 
            $statement_doc_ipg_list_ADD_UPDATE_obj->set_data_for_new_one_pay_payment_process($cus_name, $cus_phone_no, $statement_doc_id, $email, $trn_amount, $get_base_currency_state, $get_base_currency, $get_other_currency_state, $get_other_currency, $get_exchange_reate);

            //create statment doc IPG 
            if ($statement_doc_ipg_list_ADD_UPDATE_obj->create_new_statement_doc_ipg()) {


                // --------------------------------------------------------------------------------------------------------------------------------------------------


                //One Pay API key details 
                $app_id = $company_obj->get_payment_gateway_one_pay_App_ID();
                $hash_salt = $company_obj->get_payment_gateway_one_pay_Hash_Salt();
                $app_token = $company_obj->get_payment_gateway_one_pay_App_Token();

                $get_Statement_doc_IPG_id =  $statement_doc_ipg_list_ADD_UPDATE_obj->get_id();


                $amount_as_number = number_format((float)$trn_amount, 2, '.', '');


                // ----------------------------------------------------------------------------------
                $hash_string = $app_id . $get_currency_value . $amount_as_number . $hash_salt;
                $hash_result = hash('sha256', $hash_string);

                // echo " <br> " . $get_currency_value . "---" . $amount_as_number . "---" . $cus_name . "---" . $lastname . "----" . $cus_phone_no . "----" . $email . "<br>" . $hash_result .  "<br> ";



                $request_payload = [
                    "currency" => $get_currency_value,
                    "amount" => $amount_as_number,

                    "app_id" => $app_id,
                    "reference" => sprintf('%010d', $get_Statement_doc_IPG_id),
                    "customer_first_name" => $cus_name,
                    "customer_last_name" => $lastname,
                    "customer_phone_number" => $cus_phone_no,
                    "customer_email" => $email,
                    "transaction_redirect_url" => $company_obj->get_compnay_full_web() .  "Payment-Process/State-Payment.php",
                    "hash" => $hash_result,
                    "additional_data" => "sample"
                ];

                // "c1c49737882c896956e528c069a90a58a6da8c0462d9510fbabf714814637b6a"



                // Encode the payload to JSON
                $data = json_encode($request_payload, JSON_UNESCAPED_SLASHES);

                error_log("OnePay payload: " . $data);
                error_log("OnePay hash_string: " . $hash_string);
                error_log("OnePay hash_result: " . $hash_result);

                // Configure cURL for API request
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.onepay.lk/v3/checkout/link/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_HTTPHEADER => [
                        'Authorization: ' . $app_token,
                        'Content-Type: application/json'
                    ],
                ]);
                $response = curl_exec($curl);

                if (curl_errno($curl)) {
                    $_SESSION['one_pay_error'] = "OnePay cURL Error: " . curl_error($curl);
                    curl_close($curl);
                    echo $_SESSION['one_pay_error'];
                    exit();
                }

                $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                error_log("OnePay HTTP Code: " . $http_code);
                error_log("OnePay Raw Response: " . $response);

                $result = json_decode($response, true);

                if (json_last_error() !== JSON_ERROR_NONE || !is_array($result)) {
                    $_SESSION['one_pay_error'] = "Invalid response from OnePay gateway.";
                    echo $_SESSION['one_pay_error'];
                    exit();
                }

                $ipg_transaction_id = "NOT_FOUND";

                if (isset($result['data']['ipg_transaction_id'])) {
                    $ipg_transaction_id = $result['data']['ipg_transaction_id'];

                    // TODO: update DB success / pending status here
                }

                if (isset($result['data']['gateway']['redirect_url']) && !empty($result['data']['gateway']['redirect_url'])) {
                    header('Location: ' . $result['data']['gateway']['redirect_url'], true, 302);
                    exit();
                } else {
                    $error_message = $result['message'] ?? "An unexpected error occurred.";

                    $_SESSION['one_pay_error'] = $error_message;

                    // TODO: update DB failed status here

                    echo "line 130 --- " . $_SESSION['one_pay_error'];
                    exit();
                }




                // --------------------------------------------------------------------------------------------------------------------------------------------------




            } else {
                $_SESSION['one_pay_error'] = "Statment doc IPG Creating Error";
            }
        } else {
            $_SESSION['one_pay_error'] = "Customer Detals Not Found";
        }
    } else {
        //cant be -
        $_SESSION['one_pay_error'] = "invalid value try again";
    }
} else {
    $_SESSION['one_pay_error'] = "somthing went wrong try again";
}

echo $_SESSION['one_pay_error'];
