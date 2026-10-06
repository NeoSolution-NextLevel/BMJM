<?php
include_once __DIR__ . '/../../../imports/need/session_setup.php';
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';

$raw_payment_id = isset($_GET['id']) ? trim($_GET['id']) : '';
$payment_id = ctype_digit($raw_payment_id) ? (int) $raw_payment_id : 0;

if ($payment_id < 1 && $raw_payment_id !== '') {
    $security_keys = new Advance_Security_Key_List();
    $security = new Advance_Security();
    $decrypted_id = $security->get_data_decrypt($security_keys->get_bmjm_payment_slip_id(), $raw_payment_id);
    if (ctype_digit((string) $decrypted_id)) {
        $payment_id = (int) $decrypted_id;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Receipt · bmjm</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --green-950: #09261E; --green-900: #0E362B; --gold-500: #C9A227; --gold-300: #E7C659;
      --slate-900: #0F172A; --slate-700: #334155; --slate-500: #64748B; --slate-200: #E2E8F0;
      --bg-cream: #FBF9F5;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0; padding: 40px 20px; background: var(--bg-cream);
      font-family: 'Plus Jakarta Sans', sans-serif; color: var(--slate-900); -webkit-font-smoothing: antialiased;
    }
    .receipt-container {
      max-width: 760px; margin: 0 auto; background: #FFFFFF; border-radius: 16px;
      border: 1px solid var(--slate-200); box-shadow: 0 12px 36px rgba(15,23,42,0.08); overflow: hidden;
    }

    /* Receipt Header */
    .receipt-header {
      background: linear-gradient(135deg, var(--green-950), var(--green-900)); color: #FFFFFF;
      padding: 32px 40px; display: flex; justify-content: space-between; align-items: center;
      border-bottom: 4px solid var(--gold-500);
    }
    .brand-title { font-size: 22px; font-weight: 800; letter-spacing: -0.4px; color: #FFFFFF; margin: 0; }
    .brand-sub { font-size: 12.5px; color: rgba(255,255,255,0.75); margin-top: 4px; }
    .receipt-badge-top {
      text-align: right; font-size: 13px; font-weight: 700; color: var(--gold-300);
      max-width: 46%; min-width: 0;
    }
    .receipt-ref-value {
      font-size: 16px; color: #FFFFFF; margin-top: 2px;
      word-break: break-word; overflow-wrap: anywhere;
    }

    /* Actions Bar */
    .actions-bar {
      padding: 16px 40px; background: #F8FAFC; border-bottom: 1px solid var(--slate-200);
      display: flex; justify-content: space-between; align-items: center; gap: 16px;
    }
    .btn-action {
      height: 42px; padding: 0 20px; border-radius: 10px; font-weight: 700; font-size: 13.5px;
      cursor: pointer; display: inline-flex; align-items: center; gap: 8px; border: none; transition: all 0.2s ease;
      text-decoration: none;
    }
    .btn-print-active {
      background: linear-gradient(135deg, var(--gold-300), var(--gold-500)); color: var(--green-950);
      box-shadow: 0 4px 12px rgba(201,162,39,0.3);
    }
    .btn-print-active:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(201,162,39,0.4); }
    .btn-disabled {
      background: #E2E8F0; color: #94A3B8; cursor: not-allowed; border: 1px solid #CBD5E1;
    }

    /* Receipt Body */
    .receipt-body { padding: 40px; }

    /* Alert Banners */
    .alert-banner {
      padding: 16px 20px; border-radius: 12px; margin-bottom: 28px; font-size: 13.5px; line-height: 1.45;
    }
    .alert-approved { background: #DCFCE7; border: 1px solid #86EFAC; color: #166534; font-weight: 600; }
    .alert-pending { background: #FEF3C7; border: 1px solid #FDE68A; color: #92400E; font-weight: 600; }
    .alert-rejected { background: #FEE2E2; border: 1px solid #FCA5A5; color: #991B1B; }

    .reason-title { font-weight: 800; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; margin-bottom: 4px; }
    .reason-desc { font-weight: 600; font-size: 14px; color: #7F1D1D; }

    /* Details Grid */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px; }
    .info-group label { display: block; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: var(--slate-500); margin-bottom: 4px; }
    .info-group div { font-size: 14px; font-weight: 600; color: var(--slate-900); }

    /* Items Table */
    .statement-table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
    .statement-table th { text-align: left; padding: 12px 16px; background: #F1F5F9; font-size: 11.5px; font-weight: 700; text-transform: uppercase; color: var(--slate-500); border-bottom: 1px solid var(--slate-200); }
    .statement-table td { padding: 16px; border-bottom: 1px solid var(--slate-200); font-size: 14px; font-weight: 600; }
    .statement-table tr:last-child td { border-bottom: none; }

    .total-box {
      background: #F8FAFC; border: 1px solid var(--slate-200); border-radius: 12px; padding: 20px;
      display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;
    }
    .total-label { font-size: 14px; font-weight: 700; color: var(--slate-700); }
    .total-val { font-size: 24px; font-weight: 800; color: var(--green-950); }

    .receipt-footer {
      border-top: 1px solid var(--slate-200); padding-top: 24px; text-align: center;
      font-size: 12px; color: var(--slate-500);
    }

    .receipt-error { padding: 20px; color: #991B1B; background: #FEE2E2; border-radius: 8px; }
    [hidden] { display: none !important; }

    /* Print Styles */
    @media print {
      body { background: #FFFFFF; padding: 0; }
      .receipt-container { box-shadow: none; border: none; width: 100%; max-width: 100%; }
      .actions-bar { display: none !important; }
      .receipt-slip-image-section { display: none !important; }
    }

    @media (max-width: 720px) {
      body { padding: 10px; }
      .receipt-container { border-radius: 12px; }
      .receipt-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        padding: 18px 16px;
      }
      .brand-title { font-size: 18px; line-height: 1.25; }
      .receipt-badge-top {
        text-align: left;
        width: 100%;
        word-break: break-word;
        overflow-wrap: anywhere;
      }
      .actions-bar {
        flex-direction: column;
        align-items: stretch;
        padding: 12px 16px;
      }
      .btn-action {
        width: 100%;
        height: auto;
        min-height: 44px;
        justify-content: center;
        text-align: center;
        white-space: normal;
        line-height: 1.3;
        padding: 10px 14px;
      }
      .receipt-body { padding: 16px; }
      .grid-2 { grid-template-columns: 1fr; gap: 14px; margin-bottom: 20px; }
      .info-group div { word-break: break-word; }
      .statement-table, .statement-table thead, .statement-table tbody, .statement-table tr, .statement-table th, .statement-table td {
        display: block;
        width: 100%;
      }
      .statement-table thead { display: none; }
      .statement-table td {
        padding: 8px 0;
        text-align: left !important;
      }
      .total-box { flex-direction: column; align-items: flex-start; gap: 6px; padding: 16px; }
      .total-val { font-size: 20px; word-break: break-word; }
    }
  </style>
</head>
<body>

<div class="receipt-container" id="receipt-app" data-payment-id="<?php echo htmlspecialchars((string) $payment_id, ENT_QUOTES, 'UTF-8'); ?>" data-api-url="../../../View-List/Payment/single_payment_slip.php">
  <!-- Header -->
  <div class="receipt-header">
    <div>
      <h1 class="brand-title">Bambalapitiya Jumma Masjid</h1>
      <div class="brand-sub">Official Member Financial Statement &amp; Payment Receipt</div>
    </div>
    <div class="receipt-badge-top">
      <div>RECEIPT NO</div>
      <div class="receipt-ref-value" id="receipt-reference">Loading...</div>
    </div>
  </div>

  <!-- Actions Bar -->
  <div class="actions-bar">
    <!-- <button type="button" id="receipt-back" class="btn-action" style="background:#E2E8F0; color:#334155; border:none;">Back to History</button> -->
    
    <button type="button" id="receipt-print" class="btn-action btn-disabled" disabled>Print / Download PDF Receipt</button>
  </div>

  <!-- Body -->
  <div class="receipt-body">

    <!-- Status Alert Banner -->
    <div class="alert-banner alert-pending" id="receipt-status" role="status">Loading payment details...</div>
    <div class="receipt-error" id="receipt-error" hidden></div>

      <!-- Member & Payment Metadata Grid -->
      <div class="grid-2">
        <div class="info-group">
          <label>Member Name</label>
          <div id="receipt-member-name">Loading...</div>
        </div>
        <div class="info-group">
          <label>Membership Number</label>
          <div id="receipt-membership">Loading...</div>
        </div>
        <div class="info-group">
          <label>Mobile Number</label>
          <div id="receipt-mobile">Loading...</div>
        </div>
        <div class="info-group">
          <label>Date Processed</label>
          <div id="receipt-date">Loading...</div>
        </div>
        <div class="info-group">
          <label>Email Address</label>
          <div id="receipt-email">Loading...</div>
        </div>
        <div class="info-group">
          <label>Residence Address</label>
          <div id="receipt-address">Loading...</div>
        </div>
      </div>

      <!-- Statement Table -->
      <table class="statement-table">
        <thead>
          <tr>
            <th>Description / Category</th>
            <th>Payment Method</th>
            <th style="text-align:right;">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div style="font-weight:700; color:var(--slate-900);" id="receipt-category">Payment Contribution</div>
              <div style="font-size:12px; color:var(--slate-500); margin-top:2px;">Ref: <span id="receipt-table-reference">Loading...</span></div>
            </td>
            <td id="receipt-method">Loading...</td>
            <td style="text-align:right; font-weight:800; font-size:16px;">
              <span id="receipt-line-amount">Loading...</span>
            </td>
          </tr>
        </tbody>
      </table>

      <div class="receipt-slip-image-section" id="receipt-slip-image-section" hidden style="margin-bottom:32px;">
        <div style="font-size:11.5px; font-weight:700; text-transform:uppercase; color:var(--slate-500); margin-bottom:8px;">Uploaded Deposit Receipt Slip</div>
        <div style="padding:10px; border:1px solid var(--slate-200); border-radius:10px; text-align:center; background:#F8FAFC;">
          <img id="receipt-slip-image" src="" alt="Deposit Slip Image" style="max-width:100%; max-height:280px; object-fit:contain; border-radius:6px;">
        </div>
      </div>

      <!-- Total Box -->
      <div class="total-box">
        <div class="total-label">Total Amount Paid</div>
        <div class="total-val" id="receipt-total">LKR --</div>
      </div>

    <div class="receipt-footer">
      <div>This is a computer-generated statement issued by Bambalapitiya Jumma Masjid Member Portal.</div>
      <div style="margin-top:4px;">© 2026 Bmjm | Neo Solution System</div>
    </div>
  </div>
</div>

<?php include_once __DIR__ . '/JS/User_dashboard_02_F_JS.php'; ?>
</body>
</html>
