<?php 
$pth = "../";
$active_page = "dashboard2";
$page_title = "Payment History · bmjm Member";

// include '../UxUI-Back/Includes/header.php';  
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
    padding-bottom:0; /* shared footer clearance handled per-page */
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
    padding:0 28px;
  }
  .payment-new-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:18px;font-weight:600;margin:0;
    color:var(--payment-new-green-950);
  }
  .payment-new-topbar-heading p{margin:2px 0 0;font-size:12px;color:var(--payment-new-ink-400);}
  .payment-new-topbar-actions{display:flex;align-items:center;gap:10px;}
  .payment-new-icon-btn{
    width:36px;height:36px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    background:var(--payment-new-cream-100);color:var(--payment-new-green-800);
    border:1px solid var(--payment-new-border);cursor:pointer;transition:background .15s ease;
  }
  .payment-new-icon-btn:hover{background:var(--payment-new-gold-300);}
  .payment-new-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .payment-new-main{
    grid-area:main;
    padding:28px 32px 36px;
    display:flex;
    align-items:flex-start;
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
    font-size:24px;font-weight:600;
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
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
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

  /* Projects Section Styles */
  .ud2b-projects-container {
    padding: 28px 32px 36px;
  }
  .ud2b-search-wrap {
    margin-bottom: 20px; display: flex; align-items: center; gap: 12px;
  }
  .ud2b-search-input {
    flex: 1; height: 44px; border-radius: var(--payment-new-radius-sm);
    border: 1px solid var(--payment-new-border); padding: 0 16px;
    font-size: 14px; outline: none; background: var(--payment-new-white);
    color: var(--payment-new-ink-900); font-family: inherit;
    transition: border-color 0.2s ease;
  }
  .ud2b-search-input:focus { border-color: var(--payment-new-gold-500); }

  .ud2b-projects-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;
    max-height: 480px; overflow-y: auto; padding-right: 4px;
  }
  .ud2b-project-card {
    background: var(--payment-new-cream-50); border: 1px solid var(--payment-new-border);
    border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;
    transition: all 0.2s ease;
  }
  .ud2b-project-card:hover {
    border-color: var(--payment-new-gold-500); transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(11,46,36,0.08); background: var(--payment-new-white);
  }
  .ud2b-project-img {
    height: 120px; background-size: cover; background-position: center;
    position: relative; background-color: var(--payment-new-green-800);
  }
  .ud2b-project-badge {
    position: absolute; top: 10px; right: 10px; background: rgba(11,46,36,0.85);
    color: var(--payment-new-gold-300); font-size: 10.5px; font-weight: 700;
    padding: 3px 10px; border-radius: 10px; backdrop-filter: blur(4px); text-transform: uppercase;
  }
  .ud2b-project-body {
    padding: 16px; flex: 1; display: flex; flex-direction: column; justify-content: space-between;
  }
  .ud2b-project-title {
    font-size: 15px; font-weight: 700; color: var(--payment-new-green-950);
    margin-bottom: 4px; font-family: 'Poppins', sans-serif;
  }
  .ud2b-project-meta {
    font-size: 12px; color: var(--payment-new-ink-600); margin-bottom: 14px;
  }
  .ud2b-btn-select-proj {
    width: 100%; height: 38px; border-radius: var(--payment-new-radius-sm);
    border: none; background: var(--payment-new-green-800); color: var(--payment-new-white);
    font-size: 12.5px; font-weight: 700; cursor: pointer; transition: all 0.2s ease;
    display: flex; align-items: center; justify-content: center; gap: 6px;
  }
  .ud2b-btn-select-proj:hover {
    background: var(--payment-new-gold-500); color: var(--payment-new-green-950);
  }

  @media (max-width:900px){
    .payment-new-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-new-main{min-height:calc(100vh - 64px);padding:26px 18px 50px;}
    .payment-new-options{grid-template-columns:repeat(2, 1fr); padding:24px 20px 28px;}
    .ud2b-projects-grid { grid-template-columns: 1fr; }
  }
  @media (max-width:600px){
    .payment-new-options{grid-template-columns:1fr;}
  }
</style>

<div data-page="payment" id="user_dashboard_02_B">

<div class="payment-new-app">

  <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="payment-new-topbar">
    <div class="payment-new-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="payment-new-topbar-actions">
      <!-- <button class="payment-new-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="payment-new-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button> -->
      <button
        type="button"
        class="payment-new-icon-btn bmjm-user-logout-btn"
        title="Sign out"
        aria-label="Sign out"
        data-logout-url="<?php echo htmlspecialchars($pth . 'View-List/Main/Main_User_Logout.php', ENT_QUOTES, 'UTF-8'); ?>"
        data-login-url="<?php echo htmlspecialchars($pth . 'Login.php', ENT_QUOTES, 'UTF-8'); ?>"
      >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="payment-new-main">
    <section class="payment-new-panel" aria-label="Create payment">

      <div class="payment-new-panel-header">
        <div class="payment-new-panel-title" id="ud2b-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>
          Create Payment..
        </div>
        <a class="payment-new-panel-close" onclick="user_dashboard_02_A_OPEN()">✕</a>
      </div>

      <!-- VIEW 1: PAYMENT REASONS -->
      <div class="payment-new-options" id="ud2b-reasons-view">
        
        <input type="hidden" id="DashBord_Payment_body_paying_type_default" value="subcription">
        <input type="hidden" id="payment_selected_project_id" value="">
        <input type="hidden" id="payment_selected_project_name" value="">

        <a class="payment-new-option" onclick="selectPaymentReason('subcription')">
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
          <span class="payment-new-option-title">Zakatha</span>
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

        <a class="payment-new-option" onclick="showProjectsList()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M2 7l10 5 10-5-10-5Z"/>
            <path d="M2 12l10 5 10-5"/>
            <path d="M2 17l10 5 10-5"/>
          </svg>
          <span class="payment-new-option-title">Projects</span>
        </a>

        <a class="payment-new-option payment-new-option-back" onclick="user_dashboard_02_A_OPEN()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m15 18-6-6 6-6"/>
          </svg>
          <span class="payment-new-option-title" style="font-size:14px;">Back</span>
        </a>

      </div>

      <!-- VIEW 2: AVAILABLE PROJECTS LIST -->
      <div class="ud2b-projects-container" id="ud2b-projects-view" style="display:none;">
        <div class="ud2b-search-wrap">
          <input type="text" id="ud2b-project-search" class="ud2b-search-input" placeholder="Search available projects by name..." oninput="renderMemberProjects()">
          <button type="button" class="payment-new-option-back" style="width:auto; padding:0 20px;" onclick="hideProjectsList()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
            <span>Back</span>
          </button>
        </div>

        <div class="ud2b-projects-grid" id="ud2b-projects-grid">
          <!-- Populated by JS -->
        </div>
      </div>

    </section>
  </main>

</div>

<script type="text/javascript">
var memberProjectsData = [];

function selectPaymentReason(reason, projId, projName) {
    var el = document.getElementById("DashBord_Payment_body_paying_type_default");
    if (!el) {
        el = document.createElement("input");
        el.type = "hidden";
        el.id = "DashBord_Payment_body_paying_type_default";
        document.body.appendChild(el);
    }
    el.value = reason;

    if (projId) {
        var pEl = document.getElementById("payment_selected_project_id");
        if (!pEl) {
            pEl = document.createElement("input"); pEl.type = "hidden"; pEl.id = "payment_selected_project_id"; document.body.appendChild(pEl);
        }
        pEl.value = projId;
    }

    if (projName) {
        var pnEl = document.getElementById("payment_selected_project_name");
        if (!pnEl) {
            pnEl = document.createElement("input"); pnEl.type = "hidden"; pnEl.id = "payment_selected_project_name"; document.body.appendChild(pnEl);
        }
        pnEl.value = projName;
    }

    if (typeof user_dashboard_02_C_OPEN === "function") {
        user_dashboard_02_C_OPEN();
    } else if (typeof main_dashboard_02_C_OPEN === "function") {
        main_dashboard_02_C_OPEN();
    }
}

function goToProjectPayForm(publicId) {
    if (publicId) {
        window.location.href = "../../../UxUi/Payment_IPG/Project_IPG_Pay_form.php?public_project_id=" + encodeURIComponent(publicId);
    } else {
        alert("Invalid project reference.");
    }
}

function showProjectsList() {
    document.getElementById("ud2b-reasons-view").style.display = "none";
    document.getElementById("ud2b-projects-view").style.display = "block";
    document.getElementById("ud2b-panel-title").innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 7l10 5 10-5-10-5Z"/><path d="M2 12l10 5 10-5"/><path d="M2 17l10 5 10-5"/></svg> Select Active Project';

    if (memberProjectsData.length === 0) {
        fetchMemberProjects();
    } else {
        renderMemberProjects();
    }
}

function hideProjectsList() {
    document.getElementById("ud2b-projects-view").style.display = "none";
    document.getElementById("ud2b-reasons-view").style.display = "grid";
    document.getElementById("ud2b-panel-title").innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg> Create Payment..';
}

function fetchMemberProjects() {
    var grid = document.getElementById("ud2b-projects-grid");
    grid.innerHTML = '<div style="grid-column:1/-1; text-align:center; padding:40px; color:var(--payment-new-ink-600);">Loading available projects...</div>';

    fetch("../../../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_JSON_VIEW.php")
    .then(function(r){ return r.json(); })
    .then(function(data){
        if (Array.isArray(data)) {
            memberProjectsData = data;
            renderMemberProjects();
        } else {
            grid.innerHTML = '<div style="grid-column:1/-1; text-align:center; padding:40px; color:#D94948;">Failed to load project list.</div>';
        }
    })
    .catch(function(err){
        grid.innerHTML = '<div style="grid-column:1/-1; text-align:center; padding:40px; color:#D94948;">Network error loading projects.</div>';
    });
}

function renderMemberProjects() {
    var grid = document.getElementById("ud2b-projects-grid");
    var q = (document.getElementById("ud2b-project-search").value || "").toLowerCase().trim();
    
    var filtered = memberProjectsData.filter(function(p){
        return (p.name || "").toLowerCase().indexOf(q) !== -1;
    });

    if (filtered.length === 0) {
        grid.innerHTML = '<div style="grid-column:1/-1; text-align:center; padding:40px; color:var(--payment-new-ink-400);">No active projects found matching your search.</div>';
        return;
    }

    var html = "";
    filtered.forEach(function(p){
        var img = p.image ? "../../../" + p.image : "../../../assets/images/placeholder_project.jpg";
        var amtFormatted = p.amount ? "LKR " + parseFloat(p.amount).toLocaleString('en-US', {minimumFractionDigits: 2}) : "LKR 0.00";
        var typeLabel = p.type === 'special' ? 'Special Appeal' : 'Active Collection';

        html += `
        <div class="ud2b-project-card">
            <div class="ud2b-project-img" style="background-image:url('${img}')">
                <span class="ud2b-project-badge">${typeLabel}</span>
            </div>
            <div class="ud2b-project-body">
                <div>
                    <div class="ud2b-project-title">${p.name}</div>
                    <div class="ud2b-project-meta">Collected: <strong>${amtFormatted}</strong></div>
                </div>
                <button type="button" class="ud2b-btn-select-proj" onclick="goToProjectPayForm('${p.public_id || ''}')">
                    <span>Select & Pay</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
        `;
    });

    grid.innerHTML = html;
}
</script>

<div id="bmjm-footer-root"></div>

</div>
