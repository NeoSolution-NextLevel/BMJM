<?php 
    $pth = "../"; 
    $active_page = "Member-list"; // Tells the sidebar to highlight this tab
    $page_title = "Member List · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 

?>




<style>
  /* ===================================================================
     bmjm Admin — Design tokens
     Bambalapitiya Jumma Masjid · Dashboard · Member List (Dash-Board-01)
     =================================================================== */
  :root{
    --member-list-green-950:#0B2E24;
    --member-list-green-800:#123832;
    --member-list-green-700:#1B4B41;
    --member-list-green-600:#245F52;
    --member-list-gold-600:#B8923D;
    --member-list-gold-500:#C9A227;
    --member-list-gold-300:#E4C766;
    --member-list-cream-50:#FAF7F0;
    --member-list-cream-100:#F2EDE0;
    --member-list-white:#FFFFFF;
    --member-list-ink-900:#1E2B26;
    --member-list-ink-600:#5A6A62;
    --member-list-ink-400:#8B978F;
    --member-list-border:#E6E0D0;
    --member-list-danger:#B0453A;
    --member-list-radius-sm:6px;
    --member-list-radius-md:12px;
    --member-list-radius-lg:22px;
    --member-list-shadow:0 6px 24px rgba(11,46,36,0.08);
    --member-list-shadow-sm:0 2px 8px rgba(11,46,36,0.06);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--member-list-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--member-list-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .member-list-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Sidebar ----------
     Sidebar markup/styles now live in sidebar.php (shared component),
     included via PHP `include` or injected by sidebar-loader.js.
     See the <div id=""> placeholder in the body below. */

  /* ---------- Topbar ---------- */
  .member-list-topbar{
    grid-area:topbar;
    background:var(--member-list-white);
    border-bottom:1px solid var(--member-list-border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
  }
  .member-list-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;
    font-weight:600;
    margin:0;
    color:var(--member-list-green-950);
  }
  .member-list-topbar-heading p{
    margin:1px 0 0;
    font-size:11.5px;
    color:var(--member-list-ink-400);
  }
  .member-list-topbar-actions{display:flex;align-items:center;gap:18px;}
  .member-list-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--member-list-cream-100);
    color:var(--member-list-green-800);
    border:none;cursor:pointer;
    transition:background .15s ease;
  }
  .member-list-icon-btn:hover{background:var(--member-list-gold-300);}
  .member-list-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .member-list-main{
    grid-area:main;
    padding:26px 30px 50px;
  }
  .member-list-breadcrumb{
    font-size:12px;
    color:var(--member-list-ink-400);
    margin-bottom:16px;
  }
  .member-list-breadcrumb span{color:var(--member-list-green-700);font-weight:600;}

  .member-list-panel{
    background:var(--member-list-white);
    border-radius:var(--member-list-radius-lg);
    box-shadow:var(--member-list-shadow);
    overflow:hidden;
    border:1px solid var(--member-list-border);
  }

  /* Flat panel header — no decorative strip. */
  .member-list-panel-header{
    position:relative;
    background:linear-gradient(135deg,var(--member-list-green-800),var(--member-list-green-950));
    color:var(--member-list-cream-50);
    padding:22px 30px 26px;
  }
  .member-list-panel-header-row{
    display:flex;align-items:center;justify-content:space-between;
    position:relative;z-index:1;
  }
  .member-list-panel-title{
    display:flex;align-items:center;gap:10px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:21px;font-weight:600;letter-spacing:0.01em;
  }
  .member-list-panel-title svg{width:18px;height:18px;color:var(--member-list-gold-300);}
  .member-list-panel-close{
    width:32px;height:32px;border-radius:50%;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--member-list-cream-50);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:background .15s ease;
  }
  .member-list-panel-close:hover{background:rgba(250,247,240,0.12);}

  /* ---------- Toolbar ---------- */
  .member-list-toolbar{
    display:flex;align-items:flex-end;gap:18px;flex-wrap:wrap;
    padding:24px 30px;
    position:relative;z-index:1;
  }
  .member-list-field{display:flex;flex-direction:column;gap:6px;}
  .member-list-field label{
    font-size:11px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;
    color:var(--member-list-ink-600);
  }
  .member-list-field input,.member-list-field select{
    height:40px;
    border:1px solid var(--member-list-border);
    border-radius:var(--member-list-radius-sm);
    padding:0 14px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--member-list-ink-900);
    background:var(--member-list-white);
    box-shadow:var(--member-list-shadow-sm);
    min-width:220px;
    outline:none;
    transition:border-color .15s ease;
  }
  .member-list-field select{min-width:180px;cursor:pointer;}
  .member-list-field input:focus,.member-list-field select:focus{
    border-color:var(--member-list-gold-500);
  }
  .member-list-toolbar-spacer{flex:1;}

  .member-list-btn{
    height:40px;padding:0 20px;
    border-radius:var(--member-list-radius-sm);
    border:none;cursor:pointer;
    font-size:13px;font-weight:600;letter-spacing:0.01em;
    display:inline-flex;align-items:center;gap:8px;
    transition:transform .1s ease, box-shadow .15s ease, background .15s ease;
  }
  .member-list-btn:active{transform:translateY(1px);}
  .member-list-btn-primary{
    background:linear-gradient(135deg,var(--member-list-gold-500),var(--member-list-gold-600));
    color:var(--member-list-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .member-list-btn-primary:hover{box-shadow:0 6px 16px rgba(184,146,61,0.45);}

  .member-list-btn-approve{
    height:32px;padding:0 16px;
    border-radius:var(--member-list-radius-sm);
    border:1px solid var(--member-list-green-700);
    background:var(--member-list-white);
    color:var(--member-list-green-700);
    font-size:12px;font-weight:700;letter-spacing:0.02em;
    cursor:pointer;
    transition:background .15s ease,color .15s ease;
  }
  .member-list-btn-approve:hover{
    background:var(--member-list-green-800);
    color:var(--member-list-cream-50);
  }
  .member-list-btn-approve[data-round="2"]{
    border-color:var(--member-list-gold-600);
    color:var(--member-list-gold-600);
  }
  .member-list-btn-approve[data-round="2"]:hover{
    background:var(--member-list-gold-500);
    color:var(--member-list-green-950);
    border-color:var(--member-list-gold-500);
  }

  .member-list-icon-only{
    width:32px;height:32px;
    border-radius:var(--member-list-radius-sm);
    border:1px solid var(--member-list-border);
    background:var(--member-list-cream-100);
    color:var(--member-list-ink-400);
    display:inline-flex;align-items:center;justify-content:center;
    cursor:default;
  }
  .member-list-icon-only svg{width:14px;height:14px;}

  /* ---------- Table ---------- */
  .member-list-table-wrap{padding:0 30px 8px;}
  table.member-list-table{width:100%;border-collapse:collapse;}
  .member-list-table thead th{
    text-align:left;
    font-size:11px;
    letter-spacing:0.06em;
    text-transform:uppercase;
    color:var(--member-list-ink-600);
    padding:0 14px 10px;
    border-bottom:1px solid var(--member-list-border);
  }
  .member-list-table thead th.member-list-col-amount{text-align:right;}
  .member-list-table thead th.member-list-col-action{text-align:right;}

  .member-list-table tbody tr{
    border-bottom:1px solid var(--member-list-cream-100);
  }
  .member-list-table tbody tr:hover{background:var(--member-list-cream-50);}
  .member-list-table td{padding:14px;font-size:13.5px;vertical-align:middle;}
  .member-list-name{font-weight:600;color:var(--member-list-ink-900);}
  .member-list-address{color:var(--member-list-ink-600);}
  .member-list-amount{text-align:right;font-variant-numeric:tabular-nums;color:var(--member-list-ink-900);font-weight:600;}
  .member-list-action-cell{text-align:right;}
  .member-list-action-wrap{
    display:flex;
    align-items:center;
    justify-content:flex-end;
    gap:8px;
  }
  .member-list-icon-btn-view{
    width:32px;height:32px;
    border-radius:var(--member-list-radius-sm);
    border:1px solid var(--member-list-border);
    background:var(--member-list-cream-100);
    color:var(--member-list-green-800);
    display:inline-flex;align-items:center;justify-content:center;
    cursor:pointer;
    transition:background .15s ease, border-color .15s ease;
  }
  .member-list-icon-btn-view:hover{
    background:var(--member-list-gold-300);
    border-color:var(--member-list-gold-500);
  }
  .member-list-icon-btn-view svg{width:16px;height:16px;}

  .member-list-empty{
    padding:60px 30px;text-align:center;color:var(--member-list-ink-400);font-size:13.5px;
  }

  /* ---------- Footer / pagination ---------- */
  .member-list-panel-footer{
    display:flex;align-items:center;justify-content:space-between;
    padding:18px 30px 26px;
    flex-wrap:wrap;gap:12px;
  }
  .member-list-result-count{font-size:12px;color:var(--member-list-ink-400);}
  .member-list-pagination{display:flex;align-items:center;gap:6px;}
  .member-list-page-btn{
    min-width:32px;height:32px;padding:0 8px;
    border-radius:var(--member-list-radius-sm);
    border:1px solid var(--member-list-border);
    background:var(--member-list-white);
    color:var(--member-list-ink-600);
    font-size:12.5px;font-weight:600;
    cursor:pointer;
  }
  .member-list-page-btn:hover{border-color:var(--member-list-gold-500);color:var(--member-list-green-800);}
  .member-list-page-btn.member-list-page-active{
    background:var(--member-list-green-800);
    border-color:var(--member-list-green-800);
    color:var(--member-list-gold-300);
  }
  .member-list-page-btn:disabled{opacity:0.4;cursor:not-allowed;}

  /* ---------- Site footer ---------- */
  .member-list-sitefoot{
    text-align:center;font-size:11px;color:var(--member-list-ink-400);
    padding:22px 0 0;
  }

  @media (max-width:900px){
    .member-list-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .member-list-sidebar{display:none;}
    .member-list-toolbar{align-items:stretch;}
    .member-list-field input,.member-list-field select{min-width:0;width:100%;}
  }
</style>

<div data-page="member-list" id="Main_dashboard_01_A">

<div class="member-list-app">
 <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  
  

  <!-- ================= TOPBAR ================= -->
  <header class="member-list-topbar">
    <div class="member-list-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="member-list-topbar-actions">
      <button class="member-list-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="member-list-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="member-list-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="member-list-main">
    <p class="member-list-breadcrumb">Dashboard / <span>Member List</span></p>

    <section class="member-list-panel" aria-label="Member list">

      <div class="member-list-panel-header">
        <div class="member-list-panel-header-row">
          <div class="member-list-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.4"/><path d="M2.5 20c1-4 3.4-6 6.5-6s5.5 2 6.5 6"/><circle cx="18" cy="9" r="2.4"/><path d="M15.8 14c2.4.2 4 1.9 4.7 5.2"/></svg>
            Member List..
          </div>
          <button class="member-list-panel-close" title="Close panel" aria-label="Close panel" onclick="main_dashboard_00_OPEN()">✕</button>
        </div>
      </div>

      <div class="member-list-toolbar">
        <div class="member-list-field">
          <label for="member-list-search">Search from name</label>
          <input id="member-list-search" type="text" placeholder="Search by name" oninput="memberListRender()">
        </div>
        <div class="member-list-field">
          <label for="member-list-type">Select type to search</label>
          <select id="member-list-type" onchange="memberListRender()">
            <option value="all">All</option>
            <option value="pending">Pending approval</option>
            <option value="approved">Approved</option>
          </select>
        </div>
        <div class="member-list-toolbar-spacer"></div>
        <a class="member-list-btn member-list-btn-primary" onclick="main_dashboard_01_F_OPEN()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
          Add new
        </a>
      </div>

      <div class="member-list-table-wrap">
        <table class="member-list-table">
          <thead>
            <tr>
              <th>Member name</th>
              <th>Road</th>
              <th class="member-list-col-amount">Amount (Rs.)</th>
              <th class="member-list-col-action">Action</th>
            </tr>
          </thead>
          <tbody id="member-list-tbody">
            <!-- rows injected by memberListRender() -->
          </tbody>
        </table>
        <div id="member-list-empty" class="member-list-empty" style="display:none;">No members match this search.</div>
      </div>

      <div class="member-list-panel-footer">
        <div class="member-list-result-count" id="member-list-count"></div>
        <div class="member-list-field">
          <label for="member-list-perpage">Per page</label>
          <select id="member-list-perpage" style="min-width:120px;" onchange="memberListRender()">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50" selected>50</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>

      <div class="member-list-panel-footer" style="padding-top:0;justify-content:center;">
        <nav class="member-list-pagination" id="member-list-pagination" aria-label="Pagination"></nav>
      </div>

    </section>
  </main>

</div>



<!-- Loads sidebar.php into # above. Remove this line
     if you switch to a PHP include instead (see comment near the div). -->


</div>