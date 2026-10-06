<?php
$pth = "../";
$active_page = "dashboard2";
$page_title = "Member Profile · bmjm Admin";

include '../UxUI-Back/Includes/header.php';  
?>


<style>
  /* ===================================================================
     bmjm Admin — Design tokens
     Bambalapitiya Jumma Masjid · Dashboard · Member Profile (Dash-Board-02)
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
    --dashboard2-danger:#B0453A;
    --dashboard2-radius-sm:8px;
    --dashboard2-radius-md:16px;
    --dashboard2-radius-lg:20px;
    --dashboard2-shadow:0 10px 40px rgba(11,46,36,0.06);
    --dashboard2-shadow-sm:0 4px 12px rgba(11,46,36,0.04);
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

  /* ---------- Sidebar ----------
     Sidebar markup/styles live in Includes/Sidebar.php (shared component). */

  /* ---------- Topbar ---------- */
  .dashboard2-topbar{
    grid-area:topbar;
    background:var(--dashboard2-white);
    border-bottom:1px solid var(--dashboard2-border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
  }
  .dashboard2-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;
    font-weight:600;
    margin:0;
    color:var(--dashboard2-green-950);
  }
  .dashboard2-topbar-heading p{
    margin:1px 0 0;
    font-size:11.5px;
    color:var(--dashboard2-ink-400);
  }
  .dashboard2-topbar-actions{display:flex;align-items:center;gap:18px;}
  .dashboard2-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--dashboard2-cream-100);
    color:var(--dashboard2-green-800);
    border:none;cursor:pointer;
    transition:all .2s ease;
  }
  .dashboard2-icon-btn:hover{
    background:var(--dashboard2-gold-300);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(11,46,36,0.1);
  }
  .dashboard2-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .dashboard2-main{
    grid-area:main;
    padding:26px 30px 50px;
  }
  .dashboard2-breadcrumb{
    font-size:12px;
    color:var(--dashboard2-ink-400);
    margin-bottom:16px;
  }
  .dashboard2-breadcrumb span{color:var(--dashboard2-green-700);font-weight:600;}

  .dashboard2-grid{
    display:grid;
    grid-template-columns:1.15fr 0.85fr;
    gap:22px;
    align-items:start;
    margin-bottom:22px;
  }

  .dashboard2-panel{
    background:var(--dashboard2-white);
    border-radius:var(--dashboard2-radius-lg);
    box-shadow:var(--dashboard2-shadow);
    overflow:hidden;
    border:1px solid var(--dashboard2-border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .dashboard2-panel:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(11,46,36,0.12);
  }

  .dashboard2-panel-header{
    position:relative;
    background:var(--dashboard2-green-950);
    color:var(--dashboard2-white);
    padding:20px 30px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .dashboard2-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:16px;font-weight:600;letter-spacing:0.02em;
  }
  .dashboard2-panel-title svg{width:18px;height:18px;color:var(--dashboard2-gold-500);}

  /* ---------- Member details ---------- */
  .dashboard2-details{padding:6px 30px 22px;}
  .dashboard2-details-row{
    display:flex;align-items:center;gap:14px;
    padding:16px 0;
    border-bottom:1px solid var(--dashboard2-cream-100);
  }
  .dashboard2-details-row:last-child{border-bottom:none;}
  .dashboard2-details-label{
    width:150px;flex-shrink:0;
    font-size:12px;font-weight:600;letter-spacing:0.02em;
    color:var(--dashboard2-ink-600);
  }
  .dashboard2-details-colon{color:var(--dashboard2-ink-400);width:10px;flex-shrink:0;}
  .dashboard2-details-value{font-size:14px;font-weight:600;color:var(--dashboard2-ink-900);}

  /* ---------- Amount cards ---------- */
  .dashboard2-side-stack{display:flex;flex-direction:column;gap:22px;}
  .dashboard2-amount-body{
    padding:32px 30px 36px;
    text-align:center;
  }
  .dashboard2-amount-value{
    font-family:'Poppins',Inter,sans-serif;
    font-size:32px;font-weight:700;
    font-variant-numeric:tabular-nums;
    color:var(--dashboard2-ink-900);
  }
  .dashboard2-amount-value.dashboard2-amount-negative{color:var(--dashboard2-danger);}
  .dashboard2-amount-sub{
    margin:8px 0 0;font-size:12px;color:var(--dashboard2-ink-400);font-weight:500;
  }

  /* ---------- Payment list ---------- */
  .dashboard2-table-wrap{padding:0 30px 8px;}
  table.dashboard2-table{width:100%;border-collapse:collapse;}
  .dashboard2-table thead th{
    text-align:left;
    font-size:11px;
    letter-spacing:0.06em;
    text-transform:uppercase;
    color:var(--dashboard2-ink-400);
    font-weight:700;
    padding:16px 14px 12px;
    border-bottom:2px solid var(--dashboard2-cream-100);
  }
  .dashboard2-table thead th.dashboard2-col-amount{text-align:right;}
  .dashboard2-table thead th.dashboard2-col-action{text-align:right;}

  .dashboard2-table tbody tr{
    border-bottom:1px solid var(--dashboard2-cream-100);
    transition: background 0.2s ease;
  }
  .dashboard2-table tbody tr:hover{
    background:var(--dashboard2-cream-50);
  }
  .dashboard2-table td{padding:14px;font-size:13.5px;vertical-align:middle;}
  .dashboard2-date{color:var(--dashboard2-ink-600);white-space:nowrap;}
  .dashboard2-type{font-weight:700;color:var(--dashboard2-green-700);background:var(--dashboard2-cream-100);padding:4px 10px;border-radius:6px;display:inline-block;font-size:12px;}
  .dashboard2-ref{color:var(--dashboard2-ink-600);}
  .dashboard2-amount{text-align:right;font-variant-numeric:tabular-nums;color:var(--dashboard2-ink-900);font-weight:600;}
  .dashboard2-action-cell{text-align:right;position:relative;}

  .dashboard2-icon-only{
    width:32px;height:32px;
    border-radius:var(--dashboard2-radius-sm);
    border:none;
    background:var(--dashboard2-ink-600);
    color:var(--dashboard2-cream-50);
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;
    transition:all 0.2s ease;
  }
  .dashboard2-icon-only:hover{
    background:var(--dashboard2-green-800);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(11,46,36,0.15);
  }
  .dashboard2-icon-only svg{width:14px;height:14px;}

  .dashboard2-menu{
    position:absolute;
    top:44px;right:14px;
    min-width:150px;
    background:var(--dashboard2-white);
    border:1px solid var(--dashboard2-border);
    border-radius:var(--dashboard2-radius-sm);
    box-shadow:var(--dashboard2-shadow);
    padding:6px;
    z-index:5;
    display:none;
    text-align:left;
  }
  .dashboard2-menu.dashboard2-menu-open{display:block;}
  .dashboard2-menu button{
    width:100%;
    padding:9px 10px;
    border:none;background:none;
    font-size:13px;font-family:inherit;
    color:var(--dashboard2-ink-900);
    text-align:left;
    border-radius:var(--dashboard2-radius-sm);
    cursor:pointer;
  }
  .dashboard2-menu button:hover{background:var(--dashboard2-cream-100);}

  .dashboard2-empty{
    padding:60px 30px;text-align:center;color:var(--dashboard2-ink-400);font-size:13.5px;
  }

  /* ---------- Load more / footer ---------- */
  .dashboard2-panel-footer{
    display:flex;align-items:center;justify-content:center;
    padding:8px 30px 26px;
  }
  .dashboard2-btn{
    height:42px;padding:0 24px;
    border-radius:100px;
    border:none;cursor:pointer;
    font-size:13px;font-weight:600;letter-spacing:0.02em;
    display:inline-flex;align-items:center;gap:8px;
    background:var(--dashboard2-green-800);
    color:var(--dashboard2-white);
    transition:background .2s ease, transform .2s ease, box-shadow .2s ease;
  }
  .dashboard2-btn:hover{
    background:var(--dashboard2-green-800);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(11,46,36,0.15);
  }
  .dashboard2-btn:active{transform:translateY(1px);}
  .dashboard2-btn[disabled]{opacity:0.45;cursor:not-allowed;}

  /* ---------- Site footer ---------- */
  .dashboard2-sitefoot{
    text-align:center;font-size:11px;color:var(--dashboard2-ink-400);
    padding:22px 0 0;
  }

  @media (max-width:900px){
    .dashboard2-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .dashboard2-sidebar{display:none;}
    .dashboard2-grid{grid-template-columns:1fr;}
    .dashboard2-details-label{width:120px;}
  }
</style>

<?php
include_once __DIR__ . '/../../../imports/security/key_list.php';
include_once __DIR__ . '/../../../imports/security/encrypt_decrypt.php';

$raw_id = isset($_GET['id']) ? trim($_GET['id']) : '';
$member_profile_id = $raw_id;

if (!empty($raw_id)) {
    $Advance_Security_Key_List_obj = new Advance_Security_Key_List();
    $Advance_Security_obj = new Advance_Security();
    $decrypted = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_member_list_key(), $raw_id);
    if (!empty($decrypted)) {
        $member_profile_id = $decrypted;
    }
}
?>
<div data-page="dashboard2" id="Admin_user_dashboard_01">
<input type="hidden" id="Member_Profile_id" value="<?php echo htmlspecialchars($member_profile_id); ?>">
<input type="hidden" id="Member_Profile_membership_no" value="">

<div class="dashboard2-app">
 
   <?php include "../UxUI-Back/Includes/Sidebar_admin_user_dashboard.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="dashboard2-topbar">
    <div class="dashboard2-topbar-heading">
      <h1>Member Profile</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="dashboard2-topbar-actions">
      <!-- <button class="dashboard2-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="dashboard2-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button> -->
      <button class="dashboard2-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="dashboard2-main">
    <p class="dashboard2-breadcrumb">Dashboard / <span>Member Profile</span></p>

    <div class="dashboard2-grid">

      <!-- Member details -->
      <section class="dashboard2-panel" aria-label="Member details">
        <div class="dashboard2-panel-header">
          <div class="dashboard2-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3.6"/><path d="M4.5 20c1.2-4.6 3.8-6.8 7.5-6.8s6.3 2.2 7.5 6.8"/></svg>
            Member Details
          </div>
        </div>
        <div class="dashboard2-details" id="dashboard2-details">
          <!-- rows injected by dashboard2RenderDetails() -->
        </div>
      </section>

      <!-- Due amount + monthly subscription -->
      <div class="dashboard2-side-stack">
        <section class="dashboard2-panel" aria-label="Due amount">
          <div class="dashboard2-panel-header">
            <div class="dashboard2-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 9.5c0-1.4 1.3-2.5 3-2.5s3 1 3 2.3c0 3-6 1.7-6 4.7 0 1.4 1.3 2.5 3 2.5s3-1.1 3-2.5"/></svg>
              Due Amount
            </div>
          </div>
          <div class="dashboard2-amount-body">
            <div class="dashboard2-amount-value dashboard2-amount-negative" id="dashboard2-due-amount">—</div>
            <p class="dashboard2-amount-sub">Outstanding balance as of today</p>
          </div>
        </section>

        <section class="dashboard2-panel" aria-label="Monthly subscription amount">
          <div class="dashboard2-panel-header">
            <div class="dashboard2-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="5" width="17" height="15" rx="2"/><path d="M3.5 9.5h17M8 3v4M16 3v4"/></svg>
              Monthly Subscription Amount
            </div>
          </div>
          <div class="dashboard2-amount-body">
            <div class="dashboard2-amount-value" id="dashboard2-subscription-amount">—</div>
            <p class="dashboard2-amount-sub">Billed on the 1st of every month</p>
          </div>
        </section>
      </div>

    </div>

    <!-- Payment list -->
    <section class="dashboard2-panel" aria-label="Payment list">
      <div class="dashboard2-panel-header">
        <div class="dashboard2-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5.5" width="18" height="13" rx="2"/><path d="M3 9.5h18"/></svg>
          Payment List
        </div>
      </div>

      <div class="dashboard2-table-wrap">
        <table class="dashboard2-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Type</th>
              <th>Reference</th>
              <th class="dashboard2-col-amount">Amount (Rs.)</th>
              <th class="dashboard2-col-action">Action</th>
            </tr>
          </thead>
          <tbody id="dashboard2-tbody">
            <!-- rows injected by dashboard2Render() -->
          </tbody>
        </table>
        <div id="dashboard2-empty" class="dashboard2-empty" style="display:none;">No payments recorded yet.</div>
      </div>

      <div class="dashboard2-panel-footer">
        <button class="dashboard2-btn" id="dashboard2-loadmore" onclick="dashboard2LoadMore()">Load more</button>
      </div>
    </section>

    
  </main>

</div>

<?php include_once __DIR__ . '/JS/Admin_user_dashboard_01_JS.php'; ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (typeof Member_body_01_01_A_01_Memeber_Details_Display === 'function') {
      Member_body_01_01_A_01_Memeber_Details_Display();
    }
  });
</script>

<!-- Loads sidebar via ../Includes/Sidebar.php above, matching member-list.php. -->

</div>
