<?php
$raw_id = isset($_GET['id']) ? trim($_GET['id']) : '';

include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_Sec_id_SINGLE_DATA.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';

$Company_Info = new Company_Info_Variable_List();
$is_onpay_on = $Company_Info->get_is_onpay_active(); 
$is_payhere_on = $Company_Info->get_is_payhere_active();

$Advance_Security_Key_List_obj = new Advance_Security_Key_List();
$Advance_Security_obj = new Advance_Security();

$decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $raw_id);

$ipg_data = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($decrypted_sec_id);

$is_valid_link = $ipg_data->get_state();

// Variables for display
$amount = 0;
$name = "";
$phone = "";
$payment_types = [];
$payment_type_string = "Secure Payment";

if ($is_valid_link) {
    if ($ipg_data->get_ast() == '0') {
       $is_valid_link = false; // Link deactivated
    } else {
        $amount = $ipg_data->get_transation_amount();
        $name = $ipg_data->get_cus_name();
        $phone = $ipg_data->get_cus_phone_no();
        
        if ($ipg_data->get_is_subction()) $payment_types[] = "Subscription";
        if ($ipg_data->get_is_zakath()) $payment_types[] = "Zakath";
        if ($ipg_data->get_is_donation()) $payment_types[] = "Donation";
        if ($ipg_data->get_is_projcet()) $payment_types[] = "Project";
        
        if (count($payment_types) > 0) {
            $payment_type_string = implode(", ", $payment_types) . " Payment";
        }
    }
}

$formatted_amount = number_format((float)$amount, 2, '.', ',');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Online Payment | bmjm</title>
    
    <!-- Google Fonts for typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-bg: #FAF7F0;     /* Cream background */
            --card-bg: #FFFFFF;
            --green-950: #042A1B;
            --green-800: #063B27;
            --gold-600: #B8923D;
            --gold-500: #C9A239;
            --gold-300: #E6C875;
            --ink-900: #1C1F1E;
            --ink-600: #5C6662;
            --ink-400: #889991;
            --border: rgba(92, 102, 98, 0.15);
            --radius-lg: 16px;
            --radius-sm: 8px;
            --shadow-primary: 0 12px 40px rgba(4, 42, 27, 0.08);
            --shadow-btn: 0 4px 14px rgba(184, 146, 61, 0.35);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: var(--ink-900);
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(16px, 4vw, 32px);
            overflow-x: hidden;
        }

        /* Abstract decorative background rings */
        .decor-ring {
            position: fixed;
            border-radius: 50%;
            border: 2px solid rgba(201, 162, 57, 0.1);
            z-index: 0;
            pointer-events: none;
        }
        .ring-1 { width: 600px; height: 600px; top: -150px; right: -100px; }
        .ring-2 { width: 400px; height: 400px; bottom: -100px; left: -150px; }

        .payment-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .payment-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-primary);
            overflow: hidden;
            border: 1px solid var(--border);
            width: 100%;
        }

        .payment-header {
            background: linear-gradient(135deg, var(--green-800), var(--green-950));
            padding: clamp(26px, 7vw, 36px) clamp(18px, 6vw, 28px);
            text-align: center;
            color: white;
            border-bottom: 2px solid var(--gold-500);
        }

        .payment-header svg {
            width: clamp(38px, 11vw, 48px);
            height: clamp(38px, 11vw, 48px);
            color: var(--gold-500);
            margin-bottom: clamp(12px, 4vw, 16px);
        }

        .mosque-name {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(16px, 4.8vw, 18px);
            font-weight: 600;
            letter-spacing: 0;
            color: var(--gold-300);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .portal-title {
            font-size: clamp(21px, 6vw, 24px);
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            line-height: 1.25;
        }

        .payment-body {
            padding: clamp(24px, 7vw, 40px) clamp(20px, 6vw, 32px);
        }

        /* Error state styling */
        .error-state {
            text-align: center;
            padding: 40px 20px;
        }
        
        .error-state svg {
            width: 64px;
            height: 64px;
            color: var(--ink-400);
            margin-bottom: 24px;
        }

        .error-title {
            font-size: 22px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 16px;
        }

        .error-desc {
            font-size: 15px;
            color: var(--ink-600);
            line-height: 1.6;
        }

        /* Success state styling */
        .info-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .info-group:first-child {
            padding-top: 0;
        }

        .info-label {
            flex: 0 0 auto;
            font-size: clamp(12px, 3.4vw, 13.5px);
            font-weight: 500;
            color: var(--ink-600);
            text-transform: uppercase;
            letter-spacing: 0;
        }

        .info-value {
            min-width: 0;
            font-size: clamp(14px, 3.8vw, 15px);
            font-weight: 600;
            color: var(--ink-900);
            text-align: right;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .amount-highlight {
            background: var(--primary-bg);
            border-radius: var(--radius-sm);
            padding: clamp(22px, 6vw, 28px) clamp(18px, 5vw, 24px);
            text-align: center;
            margin: clamp(24px, 7vw, 32px) 0;
            border: 1px solid rgba(201, 162, 57, 0.25);
        }

        .amount-title {
            display: block;
            font-size: clamp(12.5px, 3.5vw, 14px);
            font-weight: 600;
            color: var(--ink-600);
            text-transform: uppercase;
            letter-spacing: 0;
            margin-bottom: 12px;
        }

        .amount-row {
            display: flex;
            align-items: baseline;
            justify-content: center;
            margin-top: 12px;
            max-width: 100%;
        }

        .amount-value {
            font-size: 40px;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            color: var(--green-950);
            line-height: 1;
        }

        .amount-value-input {
            width: min(100%, 7ch);
            border: none;
            background: transparent;
            font-size: clamp(34px, 12vw, 42px);
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            color: var(--green-950);
            text-align: right;
            outline: none;
            transition: color 0.2s;
            line-height: 1;
            min-width: 0;
        }
        .amount-value-input:focus {
            color: var(--gold-600);
        }
        .amount-value-input::-webkit-inner-spin-button, 
        .amount-value-input::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }

        .currency {
            font-size: clamp(16px, 5vw, 20px);
            font-weight: 600;
            vertical-align: super;
            margin-right: 4px;
            color: var(--gold-600);
            line-height: 1;
            flex: 0 0 auto;
        }

        .amount-help {
            max-width: 240px;
            margin: 14px auto 0;
            font-size: clamp(12px, 3.4vw, 12.5px);
            color: var(--ink-600);
            line-height: 1.35;
            font-weight: 500;
        }

        .pay-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            height: 56px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: var(--green-950);
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            box-shadow: var(--shadow-btn);
            transition: all 0.2s ease;
            touch-action: manipulation;
        }

        .pay-btn:hover {
            background: linear-gradient(135deg, var(--gold-300), var(--gold-500));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(184, 146, 61, 0.45);
        }

        .pay-btn:active {
            transform: translateY(1px);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-600);
            line-height: 1.4;
            text-align: center;
        }
        
        .secure-badge svg {
            color: #2e7d32;
        }

        .gateway-selector {
            margin: 20px 0;
        }

        .gateway-title {
            font-size: 13.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0;
            margin-bottom: 12px;
            color: var(--ink-600);
        }

        .gateway-options {
            display: flex;
            gap: 12px;
        }

        .gateway-option {
            flex: 1;
            min-width: 0;
            background: var(--primary-bg);
            border: 1px solid var(--border);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .gateway-option span {
            min-width: 0;
            font-weight: 600;
            font-size: 14px;
            color: var(--ink-900);
            overflow-wrap: anywhere;
        }

        @media (max-width: 520px) {
            body {
                align-items: flex-start;
                padding: 18px;
            }

            .decor-ring {
                opacity: 0.7;
            }

            .ring-1 {
                width: 380px;
                height: 380px;
                top: -120px;
                right: -180px;
            }

            .ring-2 {
                width: 300px;
                height: 300px;
                bottom: -120px;
                left: -140px;
            }

            .payment-wrapper {
                max-width: 430px;
            }

            .payment-card {
                border-radius: 14px;
            }

            .payment-body {
                padding-bottom: 28px;
            }

            .info-group {
                align-items: flex-start;
                padding: 14px 0;
            }

            .amount-highlight {
                margin: 24px 0;
            }

            .pay-btn {
                height: 54px;
                font-size: 17px;
            }
        }

        @media (max-width: 380px) {
            body {
                padding: 12px;
            }

            .payment-header {
                padding-top: 24px;
                padding-bottom: 24px;
            }

            .payment-body {
                padding-left: 16px;
                padding-right: 16px;
            }

            .info-group {
                flex-direction: column;
                gap: 6px;
            }

            .info-value {
                text-align: left;
            }

            .gateway-options {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="decor-ring ring-1"></div>
    <div class="decor-ring ring-2"></div>

    <div class="payment-wrapper">
        <div class="payment-card">
            
            <div class="payment-header">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                <div class="mosque-name">Bambalapitiya Jumma Mosque</div>
                <div class="portal-title">Secure Payment Portal</div>
            </div>

            <div class="payment-body">
                
                <?php if (!$is_valid_link): ?>
                
                <div class="error-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <div class="error-title">Link Expired or Invalid</div>
                    <div class="error-desc">
                        The payment link you clicked on is no longer valid or could not be found. Please contact the administration to request a new payment link.
                    </div>
                </div>

                <?php else: ?>

                <div class="info-group">
                    <div class="info-label">Member Name</div>
                    <div class="info-value"><?php echo (!empty(trim($name))) ? htmlspecialchars(trim($name)) : 'Unknown / General'; ?></div>
                </div>

                <?php if (!empty($phone)): ?>
                <div class="info-group">
                    <div class="info-label">Phone</div>
                    <div class="info-value"><?php echo htmlspecialchars($phone); ?></div>
                </div>
                <?php endif; ?>

                <div class="info-group">
                    <div class="info-label">Purpose</div>
                    <div class="info-value"><?php echo htmlspecialchars($payment_type_string); ?></div>
                </div>

                <div class="amount-highlight">
                    <label class="amount-title" for="customer-pay-amount">Amount to Pay</label>
                    <div class="amount-row">
                        <span class="currency">LKR</span>
                        <input type="number" id="customer-pay-amount" class="amount-value-input" value="<?php echo number_format((float)$amount, 2, '.', ''); ?>" step="0.01" min="1">
                    </div>
                    <div class="amount-help">
                        You can adjust this amount before proceeding.
                    </div>
                </div>

                <!-- Payment Gateway Selector -->
                <?php if ($is_onpay_on == 1 && $is_payhere_on == 1): ?>
                    <div class="gateway-selector">
                        <div class="gateway-title">Select Payment Gateway</div>
                        <div class="gateway-options">
                            <label class="gateway-option">
                                <input type="radio" name="payment_gateway" value="onepay" checked>
                                <span>OnePay</span>
                            </label>
                            <label class="gateway-option">
                                <input type="radio" name="payment_gateway" value="payhere">
                                <span>PayHere</span>
                            </label>
                        </div>
                    </div>
                <?php elseif ($is_onpay_on == 1): ?>
                    <input type="hidden" name="payment_gateway" value="onepay">
                <?php elseif ($is_payhere_on == 1): ?>
                    <input type="hidden" name="payment_gateway" value="payhere">
                <?php endif; ?>

                <form id="pay-form" method="POST" action="../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php">
                    <input type="hidden" name="ipg_send_by_url_sec_id" value="<?php echo htmlspecialchars($raw_id); ?>">
                    <input type="hidden" name="customer-pay-amount" id="form-customer-pay-amount" value="">
                </form>

                <button class="pay-btn" onclick="processPayment()">
                    Pay Now
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>

                <div class="secure-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    256-bit Secure Encryption
                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>

    <script>
        function processPayment() {
            var finalAmount = document.getElementById("customer-pay-amount").value;
            if (finalAmount <= 0) {
                alert("Please enter a valid amount greater than 0");
                return;
            }
            
            document.getElementById("form-customer-pay-amount").value = finalAmount;
            
            var gwElement = document.querySelector('input[name="payment_gateway"]:checked') || document.querySelector('input[name="payment_gateway"][type="hidden"]');
            var gw = gwElement ? gwElement.value : 'onepay';
            var f = document.getElementById("pay-form");
            
            if (gw === 'payhere') {
                f.action = "../../View-List/Payment_gateway/PayHere/payment_gatways_process_payhere.php";
            } else {
                f.action = "../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php";
            }

            var btn = document.querySelector('.pay-btn');
            btn.innerHTML = 'Processing...';
            btn.style.opacity = '0.7';
            btn.disabled = true;
            
            f.submit();
        }
    </script>
</body>
</html>
