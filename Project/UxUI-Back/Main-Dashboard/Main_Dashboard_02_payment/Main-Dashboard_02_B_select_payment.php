<?php 
    $pth = "../"; 
    $active_page = "payment-new"; // Tells the sidebar to highlight this tab
    $page_title = "Create Payment · bmjm Admin";
include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (shared values, same as member-list.php)
     Bambalapitiya Jumma Mosque · Dashboard · Create Payment
     =================================================================== */
  :root{
    --payment-new-green-950:#0B2E24;
    --payment-new-green-800:#123832;
    --payment-new-green-700:#1B4B41;
    --payment-new-gold-600:#B8923D;
    --payment-new-gold-500:#C9A227;
    --payment-new-gold-300:#E4C766;
    --payment-new-cream-50:#FAF7F0;
    --payment-new-cream-100:#F2EDE0;
    --payment-new-white:#FFFFFF;
    --payment-new-ink-900:#1E2B26;
    --payment-new-ink-600:#5A6A62;
    --payment-new-ink-400:#8B978F;
    --payment-new-border:#E6E0D0;
    --payment-new-radius-sm:8px;
    --payment-new-radius-lg:22px;
    --payment-new-shadow:0 6px 24px rgba(11,46,36,0.08);
    --bmjm-footer-green-950:#0B2E24;
    --bmjm-footer-cream-50:#FAF7F0;
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--payment-new-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--payment-new-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px; /* keeps content clear of the fixed shared footer */
  }

  .payment-new-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* Sidebar markup/styles live in sidebar.php (shared component). */

  /* ---------- Topbar ---------- */
  .payment-new-topbar{
    grid-area:topbar;
    background:var(--payment-new-white);
    border-bottom:1px solid var(--payment-new-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .payment-new-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--payment-new-green-950);
  }
  .payment-new-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--payment-new-ink-400);}
  .payment-new-topbar-actions{display:flex;align-items:center;gap:18px;}
  .payment-new-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--payment-new-cream-100);color:var(--payment-new-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .payment-new-icon-btn:hover{background:var(--payment-new-gold-300);}
  .payment-new-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .payment-new-main{
    grid-area:main;
    padding:26px 30px 50px;
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:calc(100vh - 64px);
  }

  .payment-new-panel{
    width:100%;
    max-width:1100px;
    background:var(--payment-new-white);
    border-radius:var(--payment-new-radius-lg);
    box-shadow:var(--payment-new-shadow);
    overflow:hidden;
    border:1px solid var(--payment-new-border);
  }

  .payment-new-panel-header{
    background:linear-gradient(135deg,var(--payment-new-green-800),var(--payment-new-green-950));
    color:var(--payment-new-cream-50);
    padding:24px 32px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .payment-new-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:26px;font-weight:600;
  }
  .payment-new-panel-title svg{width:20px;height:20px;flex:0 0 20px;color:var(--payment-new-gold-300);}
  .payment-new-panel-close{
    width:32px;height:32px;border-radius:50%;flex:0 0 32px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--payment-new-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;
    cursor:pointer;transition:background .15s ease;
  }
  .payment-new-panel-close:hover{background:rgba(250,247,240,0.12);}

  .payment-new-options{
    display:grid;
    grid-template-columns:repeat(4, 1fr);
    gap:20px;
    padding:32px 40px 40px;
  }
  .payment-new-option{
    position:relative;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:18px;
    min-height:180px;
    padding:40px 24px;
    border-radius:18px;
    border:1px solid var(--payment-new-border);
    background:var(--payment-new-white);
    color:var(--payment-new-ink-900);
    text-decoration:none;
    cursor:pointer;
    transition:all .2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow:0 2px 8px rgba(0,0,0,0.015);
    overflow:hidden;
  }
  .payment-new-option::before{
    content:"";
    position:absolute;top:0;left:0;right:0;bottom:0;
    border-radius:18px;
    background:linear-gradient(135deg, rgba(184,146,61,0.04) 0%, transparent 100%);
    opacity:0;
    transition:opacity .2s ease;
  }
  .payment-new-option svg{
    position:relative;
    width:48px;height:48px;
    color:var(--payment-new-green-800);
    transition:transform .2s ease, color .2s ease;
  }
  .payment-new-option-title{
    position:relative;
    font-size:17px;
    font-weight:600;
    font-family:'Poppins',Inter,sans-serif;
  }
  .payment-new-option:hover{
    border-color:var(--payment-new-gold-500);
    box-shadow:0 8px 24px rgba(184,146,61,0.12);
    transform:translateY(-2px);
  }
  .payment-new-option:hover::before{opacity:1;}
  .payment-new-option:hover svg{
    transform:scale(1.1);
    color:var(--payment-new-gold-600);
  }
  .payment-new-option:active{transform:translateY(0);}
  
  .payment-new-option-back{
    grid-column: 1 / -1;
    flex-direction:row;
    gap:8px;
    height:52px;
    min-height:52px;
    padding:0;
    border-radius:var(--payment-new-radius-sm);
    background:var(--payment-new-cream-100);
    border:none;
    box-shadow:none;
  }
  .payment-new-option-back::before{display:none;}
  .payment-new-option-back svg{width:18px;height:18px;color:currentColor;}
  .payment-new-option-back:hover{
    background:var(--payment-new-border);
    transform:none;
    box-shadow:none;
    border-color:transparent;
  }
  .payment-new-option-back:hover svg{transform:translateX(-2px);color:currentColor;}
  .payment-new-option-back:active{transform:translateY(1px);}

  @media (max-width:900px){
    .payment-new-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-new-main{min-height:calc(100vh - 64px);padding:26px 18px 50px;}
    .payment-new-options{grid-template-columns:repeat(2, 1fr); padding:24px 20px 28px;}
  }
  @media (max-width:600px){
    .payment-new-options{grid-template-columns:1fr;}
  }
</style>

<div data-page="payment" id="Main_dashboard_02_B">

<div class="payment-new-app">

   <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>


  <!-- ================= TOPBAR ================= -->
  <header class="payment-new-topbar">
    <div class="payment-new-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="payment-new-topbar-actions">
      <button class="payment-new-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="payment-new-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="payment-new-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="payment-new-main">
    <section class="payment-new-panel" aria-label="Create payment">

      <div class="payment-new-panel-header">
        <div class="payment-new-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>
          Create Payment..
        </div>
        <a class="payment-new-panel-close" onclick="main_dashboard_02_A_OPEN()">✕</a>
      </div>

      <div class="payment-new-options">
        
        <input type="hidden" id="DashBord_Payment_body_paying_type_default" value="">

        <a class="payment-new-option" onclick="selectPaymentReason('Subscription')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
            <path d="M3 3v5h5"/>
            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/>
            <path d="M16 21v-5h5"/>
          </svg>
          <span class="payment-new-option-title">Subscription</span>
        </a>

        <a class="payment-new-option" onclick="selectPaymentReason('Zakath')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
          </svg>
          <span class="payment-new-option-title">Zakath</span>
        </a>

        <a class="payment-new-option" onclick="selectPaymentReason('Donation')">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="8" width="18" height="4" rx="1"/>
            <path d="M12 8v13"/>
            <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/>
            <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/>
          </svg>
          <span class="payment-new-option-title">Donation</span>
        </a>

        <a class="payment-new-option" onclick="main_dashboard_02_C2_OPEN()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M2 7l10 5 10-5-10-5Z"/>
            <path d="M2 12l10 5 10-5"/>
            <path d="M2 17l10 5 10-5"/>
          </svg>
          <span class="payment-new-option-title">Projects</span>
        </a>

        <a class="payment-new-option payment-new-option-back" onclick="main_dashboard_02_A_OPEN()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m15 18-6-6 6-6"/>
          </svg>
          <span class="payment-new-option-title" style="font-size:14px;">Back</span>
        </a>

      </div>

    </section>
  </main>

</div>

<script type="text/javascript">
function normalizeMainDashboardPaymentReason(reason) {
    var normalized = String(reason || '').trim().toLowerCase();
    if (normalized === 'subscription' || normalized === 'subcription') return 'Subscription';
    if (normalized === 'zakath') return 'Zakath';
    if (normalized === 'donation') return 'Donation';
    if (normalized === 'project' || normalized === 'projects') return 'Projects';
    return '';
}

function getMainDashboardPaymentReasonFlag(reason) {
    var paymentReason = normalizeMainDashboardPaymentReason(reason);
    if (paymentReason === 'Subscription') return 'pay_resion_subcption';
    if (paymentReason === 'Zakath') return 'pay_resion_zakath';
    if (paymentReason === 'Donation') return 'pay_resion_donation';
    if (paymentReason === 'Projects') return 'pay_resion_projects';
    return '';
}

function selectPaymentReason(reason) {
    var paymentReason = normalizeMainDashboardPaymentReason(reason);
    if (!paymentReason) {
        alert('Please select a valid payment category.');
        return;
    }

    var el = document.getElementById("DashBord_Payment_body_paying_type_default");
    if (!el) {
        el = document.createElement("input");
        el.type = "hidden";
        el.id = "DashBord_Payment_body_paying_type_default";
        document.body.appendChild(el);
    }
    el.value = paymentReason;

    if (paymentReason !== 'Projects') {
        var projectId = document.getElementById('payment_selected_project_id');
        var projectName = document.getElementById('payment_selected_project_name');
        var projectTickets = document.getElementById('payment_selected_tickets_json');
        if (projectId) projectId.value = '';
        if (projectName) projectName.value = '';
        if (projectTickets) projectTickets.value = '';
    }

    if (typeof main_dashboard_02_C_OPEN === "function") {
        main_dashboard_02_C_OPEN();
    }
}
</script>

<!-- Loads sidebar.php into # above. Remove this line
     if you switch to a PHP include instead. -->


<!-- ================= FOOTER (shared component) =================
     PHP projects: delete this div and put include 'footer.php';
     in its place instead. -->
<div id="bmjm-footer-root"></div>
<!-- <script src="footer-loader.js"></script> -->

</div>
