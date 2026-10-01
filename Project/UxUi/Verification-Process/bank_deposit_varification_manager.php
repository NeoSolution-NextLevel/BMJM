<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/need/DB.php';
include_once __DIR__ . '/../../imports/security/key_list.php';
include_once __DIR__ . '/../../imports/security/encrypt_decrypt.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
include_once __DIR__ . '/../../Controller/User-Login/Cook_Managment/Cook_Managing.php';
include_once __DIR__ . '/../../Controller/bmjm_bank_deposit_slip/bmjm_bank_deposit_slip_ADD_UPDATE.php';
include_once __DIR__ . '/../../imports/notification/auto_notify.php';

$is_ajax_request = isset($_POST['ajax']) && $_POST['ajax'] === '1';

function bank_deposit_verification_response($status, $message)
{
    header('Content-Type: application/json');
    echo json_encode(array('status' => $status, 'message' => $message));
    exit();
}

// -------------------------------------------------------------
// ADMIN ACCESS SECURITY CHECK
// -------------------------------------------------------------
$get_cookie_id = "0";
if (isset($_SESSION['user_main_cook_id'])) {
    $get_cookie_id = $_SESSION['user_main_cook_id'];
} else if (isset($_COOKIE['main_user_account_cook'])) {
    $get_cookie_id = $_COOKIE['main_user_account_cook'];
    $_SESSION['user_main_cook_id'] = $get_cookie_id;
}

$cookie_check_obj = new Cook_Management($get_cookie_id);
if (!$cookie_check_obj->check_login_availability()) {
    if ($is_ajax_request) {
        bank_deposit_verification_response('error', 'Please sign in again to review this payment.');
    }
    // Access Denied: User is not logged in as Admin
    $redirect_url = "../../Login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']);
    header("Location: " . $redirect_url);
    echo '<script>window.location.href="' . $redirect_url . '";</script>';
    exit();
}

$company_obj = new Company_Info_Variable_List();

$encrypted_id = isset($_GET['id']) ? $_GET['id'] : '';
$payment_slip_id = 0;

if (!empty($encrypted_id)) {
    $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
    $Advance_Security_obj = new Advance_Security();
    $payment_slip_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_bmjm_payment_slip_id(), $encrypted_id);
}

if (empty($payment_slip_id) && isset($_GET['raw_id'])) {
    $payment_slip_id = (int)$_GET['raw_id'];
}

$db = new DataBase();

$deposit_slip_data = null;
$payment_slip_data = null;
$bank_account_data = null;
$resolved_member_list_id = 0;
$is_approved = false;
$is_cancelled = false;
$action_msg = "";

if ($payment_slip_id > 0) {
    // 1. Payment Slip
    $res_pay = $db->get_result("SELECT * FROM bmjm_payment_slip WHERE id = '$payment_slip_id'");
    if ($res_pay && $row_pay = $res_pay->fetch_assoc()) {
        $payment_slip_data = $row_pay;
    }

    // 2. Bank Deposit Slip
    $res_dep = $db->get_result("SELECT * FROM bmjm_bank_deposit_slip WHERE bmjm_payment_slip_id = '$payment_slip_id' ORDER BY id DESC LIMIT 1");
    if ($res_dep && $row_dep = $res_dep->fetch_assoc()) {
        $deposit_slip_data = $row_dep;
        if ($row_dep['approve_state'] == '1') {
            $is_approved = true;
        }
        if ($row_dep['approve_cancel'] == '1') {
            $is_cancelled = true;
        }

        // Fetch bank account details
        $b_id = $row_dep['bank_account_details_id'];
        if ($b_id > 0) {
            $res_b = $db->get_result("SELECT * FROM bank_account_details WHERE id = '$b_id'");
            if ($res_b && $row_b = $res_b->fetch_assoc()) {
                $bank_account_data = $row_b;
            }
        }
    }

    // 3. Member Profile Data Lookup (auto-resolve real member details)
    $m_no = isset($payment_slip_data['membership_no']) ? $db->real_escape_string($payment_slip_data['membership_no']) : '';
    $res_mem = $db->get_result("SELECT m.* FROM bmjm_member_list m 
        LEFT JOIN bmjm_member_payment_slilp mp ON mp.bmjm_member_list_id = m.id 
        WHERE mp.bmjm_payment_slip_id = '$payment_slip_id' OR (m.membership_no != '' AND m.membership_no = '$m_no')
        ORDER BY m.id DESC LIMIT 1");

    if ($res_mem && $row_mem = $res_mem->fetch_assoc()) {
        $resolved_member_list_id = (int)($row_mem['id'] ?? 0);
        if (empty($payment_slip_data['person_name']) || $payment_slip_data['person_name'] === 'Member') {
            $payment_slip_data['person_name'] = !empty($row_mem['name_M']) ? $row_mem['name_M'] : 'Member';
        }
        if (empty($payment_slip_data['membership_no'])) {
            $payment_slip_data['membership_no'] = $row_mem['membership_no'] ?? '';
        }
        if (empty($payment_slip_data['address'])) {
            $payment_slip_data['address'] = $row_mem['residence_address_M'] ?? '';
        }
        if (empty($payment_slip_data['member_mobile_no'])) {
            $payment_slip_data['member_mobile_no'] = !empty($row_mem['phone_mobile']) ? $row_mem['phone_mobile'] : (!empty($row_mem['notification_moible_no']) ? $row_mem['notification_moible_no'] : (!empty($row_mem['phone_residence']) ? $row_mem['phone_residence'] : (!empty($row_mem['phone_office']) ? $row_mem['phone_office'] : '')));
        }
        if (empty($payment_slip_data['member_email'])) {
            $payment_slip_data['member_email'] = !empty($row_mem['email']) ? $row_mem['email'] : (!empty($row_mem['notification_email']) ? $row_mem['notification_email'] : '');
        }
    }
}

// Image path resolver helper
$slip_img_url = "";
if (!empty($deposit_slip_data['image_pth'])) {
    $raw_pth = $deposit_slip_data['image_pth'];
    if (strpos($raw_pth, 'data:image/') === 0 || strpos($raw_pth, 'http://') === 0 || strpos($raw_pth, 'https://') === 0) {
        $slip_img_url = $raw_pth;
    } else {
        $slip_img_url = "../../" . ltrim($raw_pth, '/');
    }
}

// Handle Approve / Cancel Actions
// Handle Approve / Cancel Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_type']) && $deposit_slip_data) {
    $action = $_POST['action_type'];
    $deposit_id = $deposit_slip_data['id'];
    $user_id = $cookie_check_obj->get_user_id();

    if ($is_approved || $is_cancelled) {
        if ($is_ajax_request) {
            bank_deposit_verification_response('error', 'This bank deposit has already been reviewed.');
        }
        $action_msg = "ERROR: This bank deposit has already been reviewed.";
    } else if (!in_array($action, array('approve', 'cancel'), true)) {
        if ($is_ajax_request) {
            bank_deposit_verification_response('error', 'Invalid verification action.');
        }
        $action_msg = "ERROR: Invalid verification action.";
    } else if ($action === 'approve') {
        $deposit_updater = new bmjm_bank_deposit_slip_ADD_UPDATE($user_id);
        $deposit_updater->set_id($deposit_id);
        $deposit_updater->is_not_approve_cancel();
        $deposit_updater->is_approve_state();
        $deposit_updater->set_approve_by("Finance Admin");
        $deposit_updater->set_resion_to_approve("Approved via Finance Verification Portal");

        if ($deposit_updater->process_update()) {
            $is_approved = true;
            $is_cancelled = false;
            $deposit_slip_data['approve_state'] = '1';
            $deposit_slip_data['approve_cancel'] = '0';
            $action_msg = "SUCCESS: Bank deposit slip #" . $deposit_id . " has been successfully APPROVED!";
            if ($resolved_member_list_id > 0) {
                bmjm_notify_payment_received($resolved_member_list_id, $deposit_slip_data['amount']);
            } else {
                bmjm_notify_payment_for_slip($payment_slip_id, $deposit_slip_data['amount']);
            }
            
            // Insert Income Ledger Entry
            $amount_val = $deposit_slip_data['amount'];
            if ($amount_val > 0) {
                include_once __DIR__ . '/../../Controller/income_expence_data/income_expence_data_ADD_UPDATE.php';
                include_once __DIR__ . '/../../Controller/income_expence_data_info_list/income_expence_data_info_list_ADD_UPDATE.php';
                
                $ie_data = new income_expence_data_ADD_UPDATE($user_id);
                $ie_data->get_data(date('Y-m-d H:i:s'), $amount_val, "Bank Deposit Approved (Slip #" . $payment_slip_id . ")");
                $ie_data->is_is_type_income();
                $ie_data->is_finish_state();
                $ie_data->process_new_record();
                $ie_id = $ie_data->get_id();

                $ie_info = new income_expence_data_info_list_ADD_UPDATE($user_id);
                $ie_info->get_data("Approved Bank Deposit", $amount_val, $ie_id, 1);
                $ie_info->is_is_type_of_income();
                $ie_info->process_new_record();
            }
        } else {
            $action_msg = "ERROR: Failed to update approval state.";
        }
    } else if ($action === 'cancel') {
        $cancel_reason = isset($_POST['cancel_reason']) ? trim($_POST['cancel_reason']) : 'Deposit verification rejected by Finance Admin';
        if ($cancel_reason === '') {
            if ($is_ajax_request) {
                bank_deposit_verification_response('error', 'Please enter a rejection reason.');
            }
            $action_msg = "ERROR: Please enter a rejection reason.";
        } else {
        $deposit_updater = new bmjm_bank_deposit_slip_ADD_UPDATE($user_id);
        $deposit_updater->set_id($deposit_id);
        $deposit_updater->is_approve_cancel();
        $deposit_updater->is_not_approve_state();
        $deposit_updater->set_approve_by("Finance Admin");
        $deposit_updater->set_resion_to_approve($cancel_reason);

        if ($deposit_updater->process_update()) {
            $is_cancelled = true;
            $is_approved = false;
            $deposit_slip_data['approve_cancel'] = '1';
            $deposit_slip_data['approve_state'] = '0';
            $deposit_slip_data['resion_to_approve'] = $cancel_reason;
            $action_msg = "REJECTED: Bank deposit slip #" . $deposit_id . " has been CANCELLED. Reason: " . htmlspecialchars($cancel_reason);
        } else {
            $action_msg = "ERROR: Failed to update cancellation state.";
        }
        }
    }
}

if ($is_ajax_request) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['action_type'])) {
        bank_deposit_verification_response('error', 'Invalid verification request.');
    }
    if (!$deposit_slip_data) {
        bank_deposit_verification_response('error', 'Bank deposit slip not found.');
    }

    $is_success = strpos($action_msg, 'SUCCESS:') === 0 || strpos($action_msg, 'REJECTED:') === 0;
    bank_deposit_verification_response(
        $is_success ? 'success' : 'error',
        $action_msg !== '' ? strip_tags($action_msg) : 'Unable to review this payment.'
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bank Deposit Verification · bmjm Finance Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-color: #FAF7F0;
      --card-bg: #FFFFFF;
      --green-950: #0B2E24;
      --green-800: #123832;
      --gold-500: #C9A227;
      --gold-600: #B8923D;
      --text-dark: #1E2B26;
      --text-muted: #5A6A62;
      --border: #E6E0D0;
      --success: #28a745;
      --danger: #dc3545;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg-color);
      font-family: 'Inter', sans-serif;
      color: var(--text-dark);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      min-height: 100dvh;
      padding: 20px;
    }
    .verify-card {
      width: 100%;
      max-width: 720px;
      background: var(--card-bg);
      border-radius: 20px;
      border: 1px solid var(--border);
      box-shadow: 0 12px 36px rgba(11, 46, 36, 0.08);
      overflow: hidden;
    }
    .verify-header {
      background: linear-gradient(135deg, var(--green-800), var(--green-950));
      color: #fff;
      padding: 28px 36px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
    }
    .verify-header h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 22px;
      font-weight: 700;
    }
    .badge {
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .badge-approved { background: var(--success); color: #fff; }
    .badge-pending { background: var(--gold-500); color: var(--green-950); }
    
    .verify-body { padding: 32px 36px; }
    .alert-box {
      padding: 14px 18px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 24px;
      text-align: center;
    }
    .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    .section-title {
      font-size: 14px; font-weight: 700; color: var(--green-950);
      margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;
      border-bottom: 2px solid var(--border); padding-bottom: 6px;
    }
    .grid-row {
      display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;
    }
    .info-item { font-size: 13.5px; margin-bottom: 6px; }
    .info-item span { font-weight: 600; color: var(--text-dark); overflow-wrap: anywhere; }
    
    .receipt-preview {
      width: 100%; min-height: 200px; max-height: 400px; border-radius: 12px;
      border: 1px solid var(--border); background: #f8f9fa;
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 28px; overflow: hidden; padding: 10px;
    }
    .receipt-preview img { max-width: 100%; max-height: 380px; object-fit: contain; border-radius: 8px; }

    .action-row {
      display: flex; gap: 16px; margin-top: 20px;
    }
    .action-row.is-block { display: block; }
    .decision-row { display: flex; gap: 16px; width: 100%; }
    .decision-row form { flex: 1; }
    .btn-approve {
      width: 100%; height: 50px; background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
      color: var(--green-950); border: none; border-radius: 10px; font-size: 15px; font-weight: 700;
      cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 14px rgba(184,146,61,0.3);
    }
    .btn-approve:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(184,146,61,0.4); }
    .btn-approved-disabled {
      flex: 1; height: 50px; background: #e2e8f0; color: #64748b; border: none;
      border-radius: 10px; font-size: 15px; font-weight: 700; cursor: not-allowed; text-align: center; line-height: 50px;
    }
    .btn-reject {
      flex: 0 0 auto;
      min-height: 50px;
      padding: 12px 16px;
      background: var(--danger);
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      font-weight: 700;
      line-height: 1.25;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: all 0.2s ease;
    }
    .btn-reject:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(220,53,69,0.28); }
    .reject-state {
      padding: 16px;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      color: #721c24;
      border-radius: 10px;
      font-weight: 700;
      text-align: center;
    }
    .reject-state span {
      display: block;
      font-weight: 500;
      font-size: 13px;
      opacity: 0.9;
      margin-top: 4px;
      overflow-wrap: anywhere;
    }
    .cancel-form-box {
      display: none;
      margin-top: 16px;
      padding: 20px;
      background: #fff5f5;
      border: 1px solid #f5c6cb;
      border-radius: 12px;
    }
    .cancel-form-box label {
      display: block;
      font-size: 13.5px;
      font-weight: 700;
      color: #721c24;
      margin-bottom: 8px;
    }
    .cancel-form-box textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #f5c6cb;
      border-radius: 8px;
      font-family: inherit;
      font-size: 13.5px;
      outline: none;
      margin-bottom: 14px;
      resize: vertical;
    }
    .cancel-form-actions {
      display: flex;
      gap: 10px;
      justify-content: flex-end;
    }
    .btn-close-cancel,
    .btn-confirm-cancel {
      min-height: 42px;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
    }
    .btn-close-cancel { background: #e2e8f0; color: #475569; }
    .btn-confirm-cancel { background: var(--danger); color: #fff; }

    @media (max-width: 640px) {
      body {
        align-items: flex-start;
        padding: 12px;
      }
      .verify-card {
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(11, 46, 36, 0.08);
      }
      .verify-header {
        padding: 20px 18px;
        align-items: flex-start;
        flex-direction: column;
      }
      .verify-header h1 {
        font-size: 19px;
        line-height: 1.25;
      }
      .badge {
        font-size: 11px;
        padding: 6px 12px;
      }
      .verify-body {
        padding: 22px 18px;
      }
      .alert-box {
        font-size: 13px;
        padding: 12px 14px;
        margin-bottom: 18px;
      }
      .section-title {
        font-size: 12.5px;
        line-height: 1.35;
      }
      .grid-row {
        grid-template-columns: 1fr;
        gap: 6px;
        margin-bottom: 22px;
      }
      .info-item {
        font-size: 13px;
        line-height: 1.45;
      }
      .receipt-preview {
        min-height: 180px;
        max-height: 58vh;
        padding: 8px;
        margin-bottom: 22px;
      }
      .receipt-preview img {
        max-height: 54vh;
      }
      .decision-row,
      .cancel-form-actions {
        flex-direction: column;
      }
      .decision-row form {
        flex: 0 0 auto;
      }
      .btn-reject,
      .btn-close-cancel,
      .btn-confirm-cancel {
        width: 100%;
      }
      .btn-approved-disabled {
        height: auto;
        min-height: 50px;
        line-height: 1.35;
        padding: 14px;
      }
      .cancel-form-box {
        padding: 16px;
      }
    }

    @media (max-width: 380px) {
      body { padding: 8px; }
      .verify-header { padding: 18px 14px; }
      .verify-body { padding: 18px 14px; }
      .verify-header h1 { font-size: 17px; }
    }
  </style>
</head>
<body>

<div class="verify-card">
  <div class="verify-header">
    <div>
      <h1>Bank Deposit Verification</h1>
      <p style="font-size:12px; opacity:0.8; margin-top:2px;">bmjm Finance Management System</p>
    </div>
    <div>
      <?php if ($is_approved): ?>
        <span class="badge badge-approved">✓ Approved</span>
      <?php elseif ($is_cancelled): ?>
        <span class="badge" style="background:#dc3545; color:#fff;">✕ Rejected / Cancelled</span>
      <?php else: ?>
        <span class="badge badge-pending">⏳ Pending Review</span>
      <?php endif; ?>
    </div>
  </div>

  <div class="verify-body">

    <?php if (!empty($action_msg)): ?>
      <div class="alert-box <?php echo strpos($action_msg, 'SUCCESS') !== false ? 'alert-success' : 'alert-error'; ?>">
        <?php echo htmlspecialchars($action_msg); ?>
      </div>
    <?php endif; ?>

    <?php if (!$payment_slip_data && !$deposit_slip_data): ?>
      <div class="alert-box alert-error">
        No bank deposit record found for Payment Slip ID: #<?php echo htmlspecialchars($payment_slip_id); ?>
      </div>
    <?php else: ?>

      <!-- Customer / Member Information -->
      <div class="section-title">Customer / Member Details</div>
      <div class="grid-row">
        <div>
          <div class="info-item">Name: <span><?php echo htmlspecialchars($payment_slip_data['person_name'] ?? 'Member'); ?></span></div>
          <div class="info-item">Membership No: <span><?php echo htmlspecialchars($payment_slip_data['membership_no'] ?? 'N/A'); ?></span></div>
          <div class="info-item">Address: <span><?php echo htmlspecialchars($payment_slip_data['address'] ?? 'N/A'); ?></span></div>
        </div>
        <div>
          <div class="info-item">Mobile: <span><?php echo htmlspecialchars($payment_slip_data['member_mobile_no'] ?? 'N/A'); ?></span></div>
          <div class="info-item">Email: <span><?php echo htmlspecialchars($payment_slip_data['member_email'] ?? 'N/A'); ?></span></div>
        </div>
      </div>

      <!-- Deposit & Bank Information -->
      <div class="section-title">Deposit & Bank Account Details</div>
      <div class="grid-row">
        <div>
          <div class="info-item">Amount Paid: <span style="color:var(--green-800); font-size:16px;">LKR <?php echo number_format((float)($deposit_slip_data['amount'] ?? $payment_slip_data['val_01'] ?? 0), 2); ?></span></div>
          <div class="info-item">Date: <span><?php echo htmlspecialchars($deposit_slip_data['sdt'] ?? $payment_slip_data['payment_date'] ?? date('Y-m-d')); ?></span></div>
          <div class="info-item">Description: <span><?php echo htmlspecialchars($deposit_slip_data['resion_to_approve'] ?? $payment_slip_data['dis'] ?? 'Bank Deposit'); ?></span></div>
        </div>
        <div>
          <div class="info-item">Bank Name: <span><?php echo htmlspecialchars($bank_account_data['bank_name'] ?? 'Mosque Account'); ?></span></div>
          <div class="info-item">Branch: <span><?php echo htmlspecialchars($bank_account_data['branch'] ?? 'Main'); ?></span></div>
          <div class="info-item">Account No: <span><?php echo htmlspecialchars($bank_account_data['ac_no'] ?? 'N/A'); ?></span></div>
        </div>
      </div>

      <!-- Receipt Slip Preview -->
      <div class="section-title">Uploaded Bank Receipt Slip</div>
      <div class="receipt-preview">
        <?php if (!empty($slip_img_url)): ?>
          <img src="<?php echo htmlspecialchars($slip_img_url); ?>" alt="Uploaded Bank Receipt Slip">
        <?php else: ?>
          <span style="color:#666;">No receipt slip image attached.</span>
        <?php endif; ?>
      </div>

      <!-- Action Row -->
      <div class="action-row is-block">
        <?php if ($is_approved): ?>
          <div class="btn-approved-disabled">✓ Deposit Verified & Approved in Database</div>
        <?php elseif ($is_cancelled): ?>
          <div style="padding:16px; background:#f8d7da; border:1px solid #f5c6cb; color:#721c24; border-radius:10px; font-weight:700; text-align:center;">
            ✕ Deposit Verification Rejected / Cancelled<br>
            <span style="font-weight:500; font-size:13px; opacity:0.9;">Reason: <?php echo htmlspecialchars($deposit_slip_data['resion_to_approve'] ?? 'No reason specified'); ?></span>
          </div>
        <?php else: ?>
          <div class="decision-row">
            <form method="POST">
              <input type="hidden" name="action_type" value="approve">
              <button type="submit" class="btn-approve" onclick="return confirm('Confirm approving this bank deposit slip?');">
                ✔ Approve Bank Deposit
              </button>
            </form>
            <button type="button" class="btn-reject" onclick="toggleCancelForm()">
              ✕ Reject / Cancel Deposit
            </button>
          </div>

          <!-- Cancellation Reason Form Box -->
          <div id="cancel-form-box" class="cancel-form-box">
            <form method="POST">
              <input type="hidden" name="action_type" value="cancel">
              <label>
                Reason for Rejection / Cancellation:
              </label>
              <textarea name="cancel_reason" rows="3" required placeholder="Enter description/reason for rejection (e.g. Receipt image unclear, incorrect amount, slip mismatch)..."></textarea>
              <div class="cancel-form-actions">
                <button type="button" class="btn-close-cancel" onclick="toggleCancelForm()">Close</button>
                <button type="submit" class="btn-confirm-cancel">Confirm Cancellation</button>
              </div>
            </form>
          </div>
          <script>
            function toggleCancelForm() {
              var box = document.getElementById('cancel-form-box');
              if (box) box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
            }
          </script>
        <?php endif; ?>
      </div>

    <?php endif; ?>

  </div>
</div>

</body>
</html>
