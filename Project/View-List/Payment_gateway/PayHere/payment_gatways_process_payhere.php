<?php
include_once __DIR__ . '/../../../imports/need/DB.php';
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_Sec_id_SINGLE_DATA.php';
include_once __DIR__ . '/../../../imports/Company_Info/Company_Info_Variable_List.php';

// Form Data (identical variables accepted globally by IPG checkout UI)
$ipg_send_by_url_sec_id = isset($_POST['ipg_send_by_url_sec_id']) ? trim($_POST['ipg_send_by_url_sec_id']) : '';
$customer_pay_amount = isset($_POST['customer-pay-amount']) ? floatval($_POST['customer-pay-amount']) : 0;

if (empty($ipg_send_by_url_sec_id) || $customer_pay_amount <= 0) {
    die("Invalid IPG Request. Missing SEC ID or Pay Amount.");
}

$Advance_Security_Key_List_obj = new Advance_Security_Key_List();
$Advance_Security_obj = new Advance_Security();
$decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $ipg_send_by_url_sec_id);

$ipg_data = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($decrypted_sec_id);
if (!$ipg_data->get_state()) {
    $ipg_data = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($ipg_send_by_url_sec_id);
}

if (!$ipg_data->get_state()) {
    die("IPG Token Invalid or Expired.");
}

$Company_Info = new Company_Info_Variable_List();

// PayHere Credentials
$merchant_id     = $Company_Info->get_merchant_id();
$merchant_secret = $Company_Info->get_merchant_secret();
$is_sandbox      = false;

$action_url = $is_sandbox 
    ? 'https://sandbox.payhere.lk/pay/checkout' 
    : 'https://www.payhere.lk/pay/checkout';

$order_id = $ipg_data->get_id(); // WWJM native specific payload!
$currency = 'LKR';
$formatted_amount = number_format($customer_pay_amount, 2, '.', '');

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        $formatted_amount . 
        $currency . 
        strtoupper(md5($merchant_secret))
    )
);

// Extract Customer data from IPG Link
$first_name = $ipg_data->get_cus_name();
$last_name  = '';
$email      = 'no-reply@wwjm.lk'; 
$phone      = $ipg_data->get_cus_phone_no();
$address    = 'Wellawatta';
$city       = 'Colombo';
$country    = 'Sri Lanka';
$items      = "WWJM Collection Gateway - " . $order_id;

$domain_url = rtrim($Company_Info->get_compnay_full_web(), '/') . '/';

// We map return URLs seamlessly through dynamic WWJM paths
$return_url = $domain_url . 'UxUi/Payment_IPG/IPG_Pay_Success.php';
$cancel_url = $domain_url . 'UxUi/Payment_IPG/Project_IPG_Pay_form.php';
$notify_url = $domain_url . 'View-List/Payment_gateway/PayHere/payment_gatways_notify_payhere.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to Secure PayHere Gateway...</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #061712; color: white; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .loader {
            border: 4px solid rgba(245, 158, 11, 0.2); border-left-color: #f59e0b;
            border-radius: 50%; width: 40px; height: 40px;
            animation: spin 1s linear infinite; margin: 0 auto 20px;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .msg { text-align: center; }
        .msg h3 { margin: 0 0 10px; font-weight: 600; color: #f59e0b; }
        .msg p { color: #9ca3af; font-size: 14px; margin: 0;}
    </style>
</head>
<body>
    <div class="msg">
        <div class="loader"></div>
        <h3>Secure Checkout Initated</h3>
        <p>Transferring to PayHere encrypted payment gateway.</p>
    </div>

    <!-- Hidden Form Auto-Submitted -->
    <form id="payhere_form" method="post" action="<?php echo htmlspecialchars($action_url); ?>">
        <input type="hidden" name="merchant_id" value="<?php echo htmlspecialchars($merchant_id); ?>">
        <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($return_url); ?>">
        <input type="hidden" name="cancel_url" value="<?php echo htmlspecialchars($cancel_url); ?>">
        <input type="hidden" name="notify_url" value="<?php echo htmlspecialchars($notify_url); ?>">

        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
        <input type="hidden" name="items" value="<?php echo htmlspecialchars($items); ?>">
        <input type="hidden" name="currency" value="<?php echo htmlspecialchars($currency); ?>">
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($formatted_amount); ?>">

        <!-- Customer Form Fields -->
        <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
        <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <input type="hidden" name="address" value="<?php echo htmlspecialchars($address); ?>">
        <input type="hidden" name="city" value="<?php echo htmlspecialchars($city); ?>">
        <input type="hidden" name="country" value="<?php echo htmlspecialchars($country); ?>">

        <input type="hidden" name="hash" value="<?php echo htmlspecialchars($hash); ?>">
        
        <input type="hidden" name="custom_1" value="<?php echo htmlspecialchars($ipg_send_by_url_sec_id); ?>">
    </form>

    <script>
        document.getElementById('payhere_form').submit();
    </script>
</body>
</html>
