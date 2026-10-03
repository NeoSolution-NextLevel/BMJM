<?php
$pth = "../";
$active_page = "dashboard2";
$page_title = "Payment History · Bmjm Member Portal";

// include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     BMJM Executive Design Tokens (Fintech Grade)
     =================================================================== */
  :root{
    --bmjm-green-950: #09261E;
    --bmjm-green-900: #0E362B;
    --bmjm-green-800: #144739;
    --bmjm-green-700: #1B5948;
    --bmjm-gold-500: #C9A227;
    --bmjm-gold-400: #D8B237;
    --bmjm-gold-300: #E7C659;
    --bmjm-gold-100: #FAF4DE;
    --bmjm-cream-50: #FBF9F5;
    --bmjm-cream-100: #F3EFE6;
    --bmjm-slate-900: #0F172A;
    --bmjm-slate-700: #334155;
    --bmjm-slate-500: #64748B;
    --bmjm-slate-400: #94A3B8;
    --bmjm-slate-200: #E2E8F0;
    --bmjm-slate-100: #F1F5F9;
    --bmjm-white: #FFFFFF;
    --bmjm-radius: 14px;
    --bmjm-shadow-sm: 0 1px 3px rgba(15,23,42,0.05);
    --bmjm-shadow-md: 0 4px 12px rgba(15,23,42,0.06);
    --bmjm-shadow-lg: 0 12px 32px rgba(9,38,30,0.08);
  }

  * { box-sizing: border-box; }
  body {
    background: var(--bmjm-cream-50);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--bmjm-slate-900);
    -webkit-font-smoothing: antialiased;
  }

  .dashboard2-app {
    display: grid;
    grid-template-columns: 248px 1fr;
    grid-template-rows: 64px 1fr;
    min-height: 100vh;
    grid-template-areas: "sidebar topbar" "sidebar main";
  }

  /* Topbar */
  .dashboard2-topbar {
    grid-area: topbar; background: var(--bmjm-white); border-bottom: 1px solid var(--bmjm-slate-200);
    display: flex; align-items: center; justify-content: space-between; padding: 0 28px;
  }
  .dashboard2-topbar-heading h1 {
    font-size: 18px; font-weight: 700; color: var(--bmjm-green-950); margin: 0; letter-spacing: -0.3px;
  }
  .dashboard2-topbar-heading p { margin: 2px 0 0; font-size: 12px; color: var(--bmjm-slate-500); }
  .dashboard2-topbar-actions { display: flex; align-items: center; gap: 10px; }
  .dashboard2-icon-btn {
    width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
    background: var(--bmjm-cream-100); color: var(--bmjm-green-800); border: 1px solid #E6E0D0;
    cursor: pointer; transition: all 0.2s ease;
  }
  .dashboard2-icon-btn:hover { background: var(--bmjm-gold-300); border-color: var(--bmjm-gold-400); color: var(--bmjm-green-950); }

  /* Main Container */
  .dashboard2-main {
    grid-area: main; padding: 28px 32px 36px; min-width: 0;
    animation: fadeIn 0.4s ease-out;
  }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

  /* Stats Metric Bar — scoped to this page only */
  #user_dashboard_02_A .stats-grid {
    display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px;
  }
  #user_dashboard_02_A .stat-card {
    background: var(--bmjm-white); border: 1px solid var(--bmjm-slate-200); border-radius: 16px;
    padding: 20px 22px; box-shadow: var(--bmjm-shadow-sm); display: flex; align-items: center; justify-content: space-between;
    gap: 12px; position: relative; overflow: hidden;
  }
  #user_dashboard_02_A .stat-card::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--bmjm-green-800);
  }
  #user_dashboard_02_A .stat-card.gold-accent::before { background: var(--bmjm-gold-500); }
  #user_dashboard_02_A .stat-card.teal-accent::before { background: #0EA5E9; }

  #user_dashboard_02_A .stat-info { min-width: 0; flex: 1; }
  #user_dashboard_02_A .stat-info .stat-label { font-size: 12px; font-weight: 600; color: var(--bmjm-slate-500); text-transform: uppercase; letter-spacing: 0.5px; }
  #user_dashboard_02_A .stat-info .stat-value { font-size: 22px; font-weight: 800; color: var(--bmjm-green-950); margin: 6px 0 2px; letter-spacing: -0.4px; word-break: break-word; }
  #user_dashboard_02_A .stat-info .stat-sub { font-size: 12px; color: var(--bmjm-slate-400); }
  #user_dashboard_02_A .stat-icon-wrapper {
    width: 44px; height: 44px; border-radius: 12px; background: var(--bmjm-slate-100);
    display: flex; align-items: center; justify-content: center; font-size: 20px; color: var(--bmjm-green-900);
    flex: 0 0 44px;
  }

  /* Main Table Card */
  .ledger-card {
    background: var(--bmjm-white); border: 1px solid #E6E0D0; border-radius: 16px;
    box-shadow: var(--bmjm-shadow-lg); overflow: hidden;
  }

  /* Card Header */
  .ledger-card-header {
    background: linear-gradient(135deg, var(--bmjm-green-950), var(--bmjm-green-900));
    padding: 20px 24px; color: #FFFFFF; display: flex; align-items: center; justify-content: space-between;
    border-bottom: 3px solid var(--bmjm-gold-500);
  }
  .ledger-card-header h2 { font-size: 18px; font-weight: 700; margin: 0; letter-spacing: -0.3px; color: #FFFFFF; }
  .ledger-card-header p { margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,0.75); }
  .header-sync-pill {
    background: rgba(201, 162, 39, 0.18); border: 1px solid var(--bmjm-gold-500); color: var(--bmjm-gold-300);
    padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
    display: inline-flex; align-items: center; gap: 6px;
  }
  .header-sync-pill::before {
    content: ''; width: 7px; height: 7px; border-radius: 50%; background: #22C55E; box-shadow: 0 0 8px #22C55E;
  }

  /* Toolbar */
  .ledger-toolbar {
    padding: 16px 24px; background: #FAF7F0; border-bottom: 1px solid #E6E0D0;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
  }
  .search-wrapper { position: relative; flex: 1; min-width: 280px; max-width: 440px; }
  .search-wrapper svg { position: absolute; left: 14px; top: 13px; width: 18px; height: 18px; color: var(--bmjm-slate-400); }
  .search-input {
    width: 100%; height: 44px; padding: 0 16px 0 44px; border: 1px solid var(--bmjm-slate-200);
    border-radius: 10px; font-size: 13.5px; font-weight: 500; color: var(--bmjm-slate-900);
    background: var(--bmjm-white); outline: none; transition: all 0.2s ease;
  }
  .search-input:focus { border-color: var(--bmjm-gold-500); box-shadow: 0 0 0 3px rgba(201,162,39,0.15); }

  .filter-group { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
  .date-picker {
    height: 44px; padding: 0 14px; border: 1px solid var(--bmjm-slate-200); border-radius: 10px;
    font-size: 13px; font-weight: 500; color: var(--bmjm-slate-700); background: var(--bmjm-white); outline: none;
  }
  .date-picker:focus { border-color: var(--bmjm-gold-500); }
  
  .btn-filter {
    height: 44px; padding: 0 18px; border: 1px solid var(--bmjm-slate-200); border-radius: 10px;
    font-size: 13px; font-weight: 600; color: var(--bmjm-slate-700); background: var(--bmjm-white);
    cursor: pointer; transition: all 0.2s ease;
  }
  .btn-filter:hover { background: var(--bmjm-slate-100); border-color: var(--bmjm-slate-400); }

  .btn-pay-action {
    height: 44px; padding: 0 22px; border: none; border-radius: 10px; font-size: 13.5px; font-weight: 700;
    color: var(--bmjm-green-950); background: linear-gradient(135deg, var(--bmjm-gold-300), var(--bmjm-gold-500));
    cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(201,162,39,0.25);
    transition: all 0.2s ease; text-decoration: none;
  }
  .btn-pay-action:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(201,162,39,0.35); color: var(--bmjm-green-950); }

  /* Table Area */
  .ledger-table-wrap { padding: 4px 24px 20px; overflow-x: auto; }
  .ledger-table { width: 100%; border-collapse: separate; border-spacing: 0 8px; min-width: 860px; }
  .ledger-table th {
    padding: 14px 18px; font-size: 11.5px; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.6px; color: var(--bmjm-slate-500); text-align: left; border-bottom: 1px solid var(--bmjm-slate-200);
  }

  /* Table Row Card Styling - Unified Executive Palette */
  .ledger-row {
    background: #FFFFFF; transition: all 0.2s ease; border-radius: 10px;
    box-shadow: 0 1px 3px rgba(15,23,42,0.03); border: 1px solid var(--bmjm-slate-200);
    border-left: 4px solid var(--bmjm-green-950);
  }
  .ledger-row:hover {
    transform: translateY(-1px); box-shadow: 0 8px 24px rgba(11,46,36,0.08); border-color: var(--bmjm-green-950);
    border-left-color: var(--bmjm-gold-500); background: #FAFBF9;
  }
  .ledger-row td { padding: 16px 18px; vertical-align: middle; font-size: 13.5px; color: var(--bmjm-slate-700); }
  .ledger-row td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
  .ledger-row td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

  /* Clean Aligned Category Text */
  .cat-pill {
    font-size: 13.5px; font-weight: 600; color: var(--bmjm-green-950);
    display: block; line-height: 1.2;
  }

  /* Ref Badge */
  .ref-code {
    font-size: 13px; font-weight: 600; color: var(--bmjm-slate-900); letter-spacing: -0.2px;
  }
  .ref-sub { font-size: 11.5px; color: var(--bmjm-slate-400); margin-top: 2px; }

  /* Method Tag */
  .method-badge {
    display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; font-weight: 600; color: var(--bmjm-slate-700);
  }

  /* Fintech Status Badge */
  .status-badge {
    display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 20px;
    font-size: 12px; font-weight: 700; letter-spacing: 0.2px;
  }
  .status-approved { background: #DCFCE7; color: #15803D; border: 1px solid #86EFAC; }
  .status-pending { background: #FEF3C7; color: #D97706; border: 1px solid #FDE68A; }
  .status-rejected { background: #FEE2E2; color: #B91C1C; border: 1px solid #FCA5A5; }

  /* Inline Cancellation Reason Callout */
  .reason-callout {
    margin-top: 6px; padding: 6px 10px; background: #FEF2F2; border: 1px dashed #FCA5A5;
    border-radius: 6px; font-size: 11.5px; color: #991B1B; text-align: left; max-width: 210px; line-height: 1.35;
  }
  .reason-callout strong { font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.3px; display: block; opacity: 0.8; }

  /* Amount */
  .amount-display {
    font-size: 15px; font-weight: 800; color: var(--bmjm-green-950); text-align: right;
    font-family: Inter, sans-serif; letter-spacing: -0.3px;
  }

  .empty-ledger { padding: 60px 20px; text-align: center; color: var(--bmjm-slate-400); font-weight: 500; font-size: 14px; }
  .site-footer { text-align: center; font-size: 11.5px; color: var(--bmjm-slate-400); padding-top: 24px; }

  @media (max-width: 900px) {
    .dashboard2-app { grid-template-columns: 1fr; grid-template-areas: "topbar" "main"; }
    .dashboard2-main { padding: 18px; }
    #user_dashboard_02_A .stats-grid { grid-template-columns: 1fr; }
    .ledger-card-header { flex-direction: column; align-items: flex-start; gap: 12px; padding: 20px; }
    .ledger-toolbar { flex-direction: column; align-items: stretch; padding: 16px; }
    .search-wrapper { min-width: 100%; }
    .filter-group {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      width: 100%;
      gap: 8px;
    }
    .filter-group .btn-filter,
    .filter-group .btn-pay-action {
      grid-column: 1 / -1;
      width: 100%;
    }
    .date-picker { width: 100%; min-width: 0; }
  }
</style>

<div data-page="dashboard2" id="user_dashboard_02_A">
<input type="hidden" id="dashboard2_main_user_login_id" value="<?php echo isset($user_id) ? htmlspecialchars($user_id) : ''; ?>">

<div class="dashboard2-app">
  <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

  <!-- Topbar -->
  <header class="dashboard2-topbar">
    <div class="dashboard2-topbar-heading">
      <h1>Payment Ledger</h1>
      <p>Member Financial History & Subscriptions</p>
    </div>
    <div class="dashboard2-topbar-actions">
      <!-- <button class="dashboard2-icon-btn" title="Notifications">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="dashboard2-icon-btn" title="Messages">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button> -->
      <button
        type="button"
        class="dashboard2-icon-btn bmjm-user-logout-btn"
        title="Sign out"
        aria-label="Sign out"
        data-logout-url="<?php echo htmlspecialchars($pth . 'View-List/Main/Main_User_Logout.php', ENT_QUOTES, 'UTF-8'); ?>"
        data-login-url="<?php echo htmlspecialchars($pth . 'Login.php', ENT_QUOTES, 'UTF-8'); ?>"
      >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- Main Content -->
  <main class="dashboard2-main">

    <!-- Executive Stats Grid -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-info">
          <div class="stat-label">Total Verified Paid</div>
          <div class="stat-value" id="stat-total-amount">LKR 0.00</div>
          <div class="stat-sub">Lifetime contribution balance</div>
        </div>
        <div class="stat-icon-wrapper">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
        </div>
      </div>

      <div class="stat-card gold-accent">
        <div class="stat-info">
          <div class="stat-label">Total Transactions</div>
          <div class="stat-value" id="stat-total-count">0</div>
          <div class="stat-sub">Recorded payment logs</div>
        </div>
        <div class="stat-icon-wrapper">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
        </div>
      </div>

      <div class="stat-card teal-accent">
        <div class="stat-info">
          <div class="stat-label">Bank Verification</div>
          <div class="stat-value" id="stat-pending-count">0 Pending</div>
          <div class="stat-sub">Admin review status</div>
        </div>
        <div class="stat-icon-wrapper">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg>
        </div>
      </div>
    </div>

    <!-- Master Transaction Ledger Card -->
    <div class="ledger-card">
      <div class="ledger-card-header">
        <div>
          <h2>Comprehensive Transaction Ledger</h2>
          <p>Real-time records of subscriptions, donations, and bank deposit slips</p>
        </div>
        <div class="header-sync-pill">
          Real-time Sync
        </div>
      </div>

      <!-- Toolbar -->
      <div class="ledger-toolbar">
        <div class="search-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <input type="text" class="search-input" id="tx-search" placeholder="Search reference code, category, or note...">
        </div>

        <div class="filter-group">
          <input type="date" class="date-picker" id="tx-start-date" title="Start Date">
          <span style="color:var(--bmjm-slate-400); font-weight:600; font-size:12px;">TO</span>
          <input type="date" class="date-picker" id="tx-end-date" title="End Date">
          <button class="btn-filter" id="btn-apply-filter">Filter Range</button>
          <button class="btn-pay-action" onclick="user_dashboard_02_B_OPEN()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Pay Now
          </button>
        </div>
      </div>

      <!-- Ledger Table -->
      <div class="ledger-table-wrap">
        <table class="ledger-table">
          <thead>
            <tr>
              <th style="width:130px;">Date</th>
              <th style="width:130px;">Category</th>
              <th>Transaction Ref & Notes</th>
              <th style="text-align:right; width:140px;">Payment Method</th>
              <th style="text-align:center; width:150px;">Status</th>
              <th style="text-align:right; width:150px;">Amount Paid</th>
              <th style="text-align:center; width:110px;">Action</th>
            </tr>
          </thead>
          <tbody id="dashboard2-master-tbody">
             <!-- AJAX output loaded here -->
          </tbody>
        </table>

        <div id="dashboard2-master-empty" class="empty-ledger" style="display:none;">
          <div style="font-size:36px; margin-bottom:8px;">🧾</div>
          No transaction history records match your search criteria.
        </div>
      </div>

      <div style="display:flex; justify-content:center; padding:0 24px 20px;">
        <button class="btn-filter" style="font-size:12.5px; height:38px; padding:0 24px;">Load More Records</button>
      </div>
    </div>

    <p class="site-footer">© 2026 Wellawatte Jumma Mosque (BMJM) | Powered by Neo Solution</p>
  </main>
</div>

<!-- Receipt View Modal Backdrop -->
<div id="user-payment-receipt-modal-backdrop" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(9,38,30,0.6); z-index:9999; align-items:center; justify-content:center; padding:20px; backdrop-filter:blur(4px);">
  <div style="width:100%; max-width:820px; height:88vh; background:#FFFFFF; border-radius:16px; overflow:hidden; display:flex; flex-direction:column; box-shadow:0 24px 48px rgba(0,0,0,0.25);">
    <div style="padding:14px 24px; background:var(--bmjm-green-950); color:#FFFFFF; display:flex; align-items:center; justify-content:space-between; border-bottom:2px solid var(--bmjm-gold-500);">
      <div style="font-weight:700; font-size:15px; color:#FFFFFF;">BMJM Member Payment Receipt Statement</div>
      <button onclick="closeReceiptModal()" style="background:transparent; border:none; color:rgba(255,255,255,0.8); font-size:20px; cursor:pointer; padding:0 8px;">✕</button>
    </div>
    <iframe id="user-payment-receipt-modal-frame" src="" style="width:100%; flex:1; border:none;"></iframe>
  </div>
</div>

<script>
function openReceiptModal(paymentId) {
  var frame = document.getElementById('user-payment-receipt-modal-frame');
  var modal = document.getElementById('user-payment-receipt-modal-backdrop');
  if (frame && modal) {
    if (modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }
    var targetUrl = '../UxUI-Back/User_dashboard/User_dashboard_02_payments/User_dashboard_02_F_view_receipt.php?id=' + encodeURIComponent(paymentId);
    frame.src = targetUrl;
    modal.style.display = 'flex';
  }
}
function closeReceiptModal() {
  var modal = document.getElementById('user-payment-receipt-modal-backdrop') || document.getElementById('user-summary-receipt-modal-backdrop');
  var frame = document.getElementById('user-payment-receipt-modal-frame') || document.getElementById('user-summary-receipt-modal-frame');
  if (modal) modal.style.display = 'none';
  if (frame) frame.src = '';
}
</script>

<?php include_once __DIR__ . '/JS/User_dashboard_02_A_JS.php'; ?>
</div>
