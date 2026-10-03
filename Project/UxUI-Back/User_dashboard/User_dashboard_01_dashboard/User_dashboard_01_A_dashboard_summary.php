<?php
$pth = "../";
$active_page = "dashboard2";
$page_title = "Member Profile · BMJM Admin";

?>


<style>
  /* ===================================================================
     BMJM Admin — Design tokens (Merged with Premium User Profile)
     =================================================================== */
  :root{
    --dashboard2-green-950:#0B2E24;
    --dashboard2-green-800:#123832;
    --dashboard2-green-700:#1B4B41;
    --dashboard2-green-600:#245F52;
    --dashboard2-gold-600:#B8923D;
    --dashboard2-gold-500:#C9A227;
    --dashboard2-gold-300:#E4C766;
    --dashboard2-cream-50:#FAF7F0;
    --dashboard2-cream-100:#F2EDE0;
    --dashboard2-white:#FFFFFF;
    --dashboard2-ink-900:#1E2B26;
    --dashboard2-ink-600:#5A6A62;
    --dashboard2-ink-400:#8B978F;
    --dashboard2-border:#E6E0D0;
    --dashboard2-danger:#D94948;
    --dashboard2-danger-bg: rgba(217, 73, 72, 0.08);
    --dashboard2-radius-sm:8px;
    --dashboard2-radius-md:16px;
    --dashboard2-radius-lg:24px;
    --dashboard2-shadow:0 12px 32px rgba(11,46,36,0.06);
    --dashboard2-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--dashboard2-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--dashboard2-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .dashboard2-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .dashboard2-topbar{
    grid-area:topbar;
    background:var(--dashboard2-white);
    border-bottom:1px solid var(--dashboard2-border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 28px;
  }
  .dashboard2-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:18px;
    font-weight:600;
    margin:0;
    color:var(--dashboard2-green-950);
  }
  .dashboard2-topbar-heading p{
    margin:2px 0 0;
    font-size:12px;
    color:var(--dashboard2-ink-400);
  }
  .dashboard2-topbar-actions{display:flex;align-items:center;gap:10px;}
  .dashboard2-icon-btn{
    width:36px;height:36px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    background:var(--dashboard2-cream-100);
    color:var(--dashboard2-green-800);
    border:1px solid var(--dashboard2-border);cursor:pointer;
    transition:all .2s ease;
  }
  .dashboard2-icon-btn:hover{
    background:var(--dashboard2-gold-300);
    border-color:var(--dashboard2-gold-500);
    color: var(--dashboard2-green-950);
  }
  .dashboard2-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .dashboard2-main{
    grid-area:main; padding:28px 32px 36px; min-width: 0;
    animation: fadeSlideUp 0.6s var(--dashboard2-cubic) forwards;
  }
  @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  /* --- PROFILE HERO BANNER --- */
  .profile-hero {
    background: linear-gradient(135deg, var(--dashboard2-green-800), var(--dashboard2-green-950));
    border-radius: 16px; padding: 28px 32px; position: relative; overflow: hidden;
    display: flex; align-items: center; gap: 0; box-shadow: var(--dashboard2-shadow); margin-bottom: 24px;
  }
  .profile-hero::before {
    content: ''; position: absolute; right: -5%; top: -60px; width: 350px; height: 350px; border-radius: 50%;
    background: var(--dashboard2-gold-500); filter: blur(60px); opacity: 0.18; pointer-events: none;
  }
  
  .hero-details { z-index: 2; flex: 1; }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.15); backdrop-filter: blur(4px);
    padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
    color: var(--dashboard2-cream-100); margin-bottom: 12px;
  }
  .hero-badge svg { width: 14px; height: 14px; color: var(--dashboard2-gold-300); }
  .hero-name { font-size: 26px; font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--dashboard2-white); margin: 0 0 4px 0; }
  .hero-sub { font-size: 14px; color: rgba(250, 247, 240, 0.7); display:flex; gap: 20px; }
  .hero-sub span { display:flex; align-items:center; gap:6px; }

  /* --- FINANCIAL STATS GRID (scoped so payment-list CSS cannot flatten these cards) --- */
  #user_dashboard_01_A .stats-grid {
    display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px;
  }
  
  #user_dashboard_01_A .stat-card {
    display: block;
    background: var(--dashboard2-white); border-radius: 16px; padding: 22px; min-height: 148px;
    border: 1px solid var(--dashboard2-border); box-shadow: 0 4px 16px rgba(11,46,36,0.03);
    position: relative; overflow: hidden;
  }
  
  #user_dashboard_01_A .stat-icon {
    width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center;
    background: var(--dashboard2-cream-100); color: var(--dashboard2-green-800); margin-bottom: 16px;
  }
  #user_dashboard_01_A .stat-card.danger .stat-icon { background: var(--dashboard2-danger-bg); color: var(--dashboard2-danger); }
  
  #user_dashboard_01_A .stat-label {
    display: block; font-size: 12px; font-weight: 700; color: var(--dashboard2-ink-400);
    text-transform: uppercase; margin-bottom: 8px; line-height: 1.35; letter-spacing: 0.03em;
  }
  #user_dashboard_01_A .stat-value {
    display: block; font-size: 26px; font-weight: 800; color: var(--dashboard2-green-950);
    font-variant-numeric: tabular-nums; line-height: 1.2; word-break: break-word;
  }
  #user_dashboard_01_A .stat-card.danger .stat-value { color: var(--dashboard2-danger); }
  #user_dashboard_01_A .stat-value span { font-size: 15px; font-weight: 600; color: var(--dashboard2-ink-400); margin-right: 6px; }

  /* --- SECTIONS LAYOUT --- */
  .dashboard-content-grid {
    display: grid; grid-template-columns: 1fr; gap: 20px;
  }
  
  .dash-panel {
    background: var(--dashboard2-white); border-radius: 16px;
    border: 1px solid var(--dashboard2-border); box-shadow: 0 4px 16px rgba(11,46,36,0.03); overflow: hidden;
  }
  .dash-panel-header {
    padding: 18px 24px; border-bottom: 1px solid var(--dashboard2-cream-100);
    display: flex; justify-content: space-between; align-items: center;
    background: rgba(250, 247, 240, 0.4);
  }
  .dash-panel-header h2 { font-size: 16px; font-weight: 700; color: var(--dashboard2-green-950); margin: 0; font-family:'Poppins', sans-serif;}
  .dash-panel-body { padding: 8px 24px 20px; overflow-x: auto; }
  
  /* --- Clean Text-based Category Display --- */
  .cat-text {
    font-size: 13.5px; font-weight: 600; color: var(--dashboard2-green-950);
    display: block; line-height: 1.2;
  }

  /* --- Action Button & Badges --- */
  .ud-btn-view-receipt {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600;
    background: var(--dashboard2-white); color: var(--dashboard2-green-950);
    border: 1px solid var(--dashboard2-border); cursor: pointer;
    transition: all 0.2s ease; text-decoration: none; outline: none;
  }
  .ud-btn-view-receipt:hover {
    background: var(--dashboard2-green-950); color: #FFFFFF;
    border-color: var(--dashboard2-green-950);
  }
  .ud-btn-view-receipt svg { width: 14px; height: 14px; }

  .status-badge {
    display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 12px;
    font-size: 11.5px; font-weight: 600;
  }
  .status-approved { background: var(--dashboard2-cream-100); color: var(--dashboard2-green-950); }
  .status-pending { background: #FEF3C7; color: #D97706; }
  .status-rejected { background: #FEE2E2; color: #DC2626; }

  /* --- Table Row Styling --- */
  .dashboard2-date{color:var(--dashboard2-ink-600);font-weight:500;}
  .dashboard2-ref{color:var(--dashboard2-ink-900);font-weight:600;}
  .dashboard2-amount{text-align:right;font-variant-numeric:tabular-nums;color:var(--dashboard2-green-950);font-weight:700;}
  .dashboard2-action-cell{text-align:right;}
  
  #dashboard2-tbody tr { border-bottom:1px solid var(--dashboard2-cream-100); transition: background 0.2s ease; }
  #dashboard2-tbody tr:hover { background:var(--dashboard2-cream-50); }
  #dashboard2-tbody td { padding:14px; vertical-align:middle; font-size:13.5px; }

  .empty-state-panel { padding: 50px 30px; text-align: center; color: var(--dashboard2-ink-400); font-weight: 600; font-size: 14px; }

  /* ---------- Site footer ---------- */
  .dashboard2-sitefoot{
    text-align:center;font-size:11px;color:var(--dashboard2-ink-400);
    padding:22px 0 0;
  }

  @media (max-width: 1000px) {
    .dashboard-content-grid { grid-template-columns: 1fr; }
    .profile-hero { flex-direction: column; text-align: center; gap: 16px; padding: 28px 24px; }
    .hero-sub { justify-content: center; flex-wrap: wrap; }
  }
  @media (max-width:900px){
    .dashboard2-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .dashboard2-sidebar{display:none;}
    .dashboard2-main{padding:16px 14px 28px;}
    .profile-hero{padding:22px 18px;}
    .hero-name{font-size:22px;}
    #user_dashboard_01_A .stat-value{font-size:22px;}
    #user_dashboard_01_A .stat-value span{font-size:13px;}
    #user_dashboard_01_A .stat-card{padding:18px; min-height:0;}
    #user_dashboard_01_A .stats-grid{grid-template-columns:1fr; gap:12px; margin-bottom:16px;}
    #ud-next-date{font-size:20px !important;padding-top:0 !important;}
    .dash-panel-header{padding:16px;}
    .dashboard2-main{padding-bottom:88px;}
  }
</style>

<div data-page="dashboard2" id="user_dashboard_01_A">
<input type="hidden" id="main_user_login_id" value="<?php echo isset($user_id) ? htmlspecialchars($user_id) : ''; ?>">
<input type="hidden" id="Member_Profile_id" value="">
<input type="hidden" id="Member_Profile_membership_no" value="">

<div class="dashboard2-app">
 
  <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>
  <?php
    $bmjm_header_title = 'Dashboard';
    $bmjm_header_subtitle = 'Member portal';
    include '../UxUI-Back/Includes/header.php';
  ?>

  <!-- ================= TOPBAR ================= -->

  <!-- <header class="dashboard2-topbar">
    <div class="dashboard2-topbar-heading">
      <h1>Dashboard</h1>
      <p>Member Profile System</p>
    </div>
    <div class="dashboard2-topbar-actions">
      <button class="dashboard2-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="dashboard2-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="dashboard2-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header> -->

  <!-- ================= MAIN ================= -->
  <main class="dashboard2-main">

        <!-- Profile Hero -->
        <div class="profile-hero">
            <div class="hero-details">
                <div class="hero-badge">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Verified Member
                </div>
                <h1 class="hero-name" id="ud-user-name">Loading Profile...</h1>
                <div class="hero-sub" id="ud-user-details-hybrid">
                    <span><svg width="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> <span id="ud-user-id">ID: ----</span></span>
                    <span><svg width="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> <span id="ud-user-mobile">----</span></span>
                </div>
                <!-- Preserved for JS compatibility without disrupting flex -->
                <div id="dashboard2-details" style="display:none;"></div>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="stats-grid">
            <div class="stat-card danger">
                <div class="stat-icon">LKR</div>
                <div class="stat-label">Outstanding Balance</div>
                <div class="stat-value" id="dashboard2-due-amount"><span>LKR</span>0.00</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon"><svg width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
                <div class="stat-label">Monthly Subscription Amount</div>
                <div class="stat-value" id="dashboard2-subscription-amount"><span>LKR</span>0.00</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><svg width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                <div class="stat-label">Upcoming Action / Date</div>
                <div class="stat-value" id="ud-next-date">--</div>
            </div>
        </div>

        <!-- Detailed Feeds -->
        <div class="dashboard-content-grid">
            
            <div class="dash-panel">
                <div class="dash-panel-header">
                    <h2>Payment List</h2>
                </div>
                
                <div class="dash-panel-body">
                    <table style="width:100%;border-collapse:collapse;">
                      <thead>
                        <tr>
                          <th style="text-align:left;font-size:11px;letter-spacing:0.06em;text-transform:uppercase;color:var(--dashboard2-ink-400);font-weight:700;padding:16px 14px 12px;border-bottom:2px solid var(--dashboard2-cream-100);">Date</th>
                          <th style="text-align:left;font-size:11px;letter-spacing:0.06em;text-transform:uppercase;color:var(--dashboard2-ink-400);font-weight:700;padding:16px 14px 12px;border-bottom:2px solid var(--dashboard2-cream-100);">Type</th>
                          <th style="text-align:left;font-size:11px;letter-spacing:0.06em;text-transform:uppercase;color:var(--dashboard2-ink-400);font-weight:700;padding:16px 14px 12px;border-bottom:2px solid var(--dashboard2-cream-100);">Reference</th>
                          <th style="text-align:right;font-size:11px;letter-spacing:0.06em;text-transform:uppercase;color:var(--dashboard2-ink-400);font-weight:700;padding:16px 14px 12px;border-bottom:2px solid var(--dashboard2-cream-100);">Amount (Rs.)</th>
                          <th style="text-align:right;font-size:11px;letter-spacing:0.06em;text-transform:uppercase;color:var(--dashboard2-ink-400);font-weight:700;padding:16px 14px 12px;border-bottom:2px solid var(--dashboard2-cream-100);">Action</th>
                        </tr>
                      </thead>
                      <tbody id="dashboard2-tbody">
                      </tbody>
                    </table>
                    <div id="dashboard2-empty" class="empty-state-panel" style="display:none;">No payments recorded yet.</div>
                </div>
            </div>

        </div>
  </main>

</div>

<!-- Receipt View Modal Backdrop -->
<div id="user-summary-receipt-modal-backdrop" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(9,38,30,0.6); z-index:9999; align-items:center; justify-content:center; padding:20px; backdrop-filter:blur(4px);">
  <div style="width:100%; max-width:820px; height:88vh; background:#FFFFFF; border-radius:16px; overflow:hidden; display:flex; flex-direction:column; box-shadow:0 24px 48px rgba(0,0,0,0.25);">
    <div style="padding:14px 24px; background:var(--dashboard2-green-950); color:#FFFFFF; display:flex; align-items:center; justify-content:space-between; border-bottom:2px solid var(--dashboard2-gold-500);">
      <div style="font-weight:700; font-size:15px; color:#FFFFFF;">BMJM Member Payment Receipt Statement</div>
      <button onclick="closeReceiptModal()" style="background:transparent; border:none; color:rgba(255,255,255,0.8); font-size:20px; cursor:pointer; padding:0 8px;">✕</button>
    </div>
    <iframe id="user-summary-receipt-modal-frame" src="" style="width:100%; flex:1; border:none;"></iframe>
  </div>
</div>

<script>
function openReceiptModal(paymentId) {
  var frame = document.getElementById('user-summary-receipt-modal-frame');
  var modal = document.getElementById('user-summary-receipt-modal-backdrop');
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
  var modal = document.getElementById('user-summary-receipt-modal-backdrop') || document.getElementById('user-payment-receipt-modal-backdrop');
  var frame = document.getElementById('user-summary-receipt-modal-frame') || document.getElementById('user-payment-receipt-modal-frame');
  if (modal) modal.style.display = 'none';
  if (frame) frame.src = '';
}
</script>

<?php include_once __DIR__ . '/JS/User_dashboard_01_A_JS.php'; ?>

</div>
