<?php 
    $pth = "../"; 
    $active_page = "payment-project"; 
    $page_title = "Select Project · bmjm Admin";
    if (!defined('BMJM_FEATURE_FLAGS_LOADED')) {
        include_once '../imports/feature_flags/feature_flags.php';
    }
    if (!$BMJM_FEATURE_COLLECTION) { return; } // Panel silently hidden when feature is disabled
include '../UxUI-Back/Includes/header.php';  
?>


<style>
  /* ===================================================================
     bmjm Admin — Design tokens (shared values)
     =================================================================== */
  :root{
    --payment-project-green-950:#0B2E24;
    --payment-project-green-800:#123832;
    --payment-project-green-700:#1B4B41;
    --payment-project-gold-600:#B8923D;
    --payment-project-gold-500:#C9A227;
    --payment-project-gold-300:#E4C766;
    --payment-project-cream-50:#FAF7F0;
    --payment-project-cream-100:#F2EDE0;
    --payment-project-white:#FFFFFF;
    --payment-project-ink-900:#1E2B26;
    --payment-project-ink-600:#5A6A62;
    --payment-project-ink-400:#8B978F;
    --payment-project-border:#E6E0D0;
    --payment-project-radius-sm:8px;
    --payment-project-radius-lg:22px;
    --payment-project-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--payment-project-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--payment-project-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px; 
  }

  .payment-project-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .payment-project-topbar{
    grid-area:topbar;
    background:var(--payment-project-white);
    border-bottom:1px solid var(--payment-project-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .payment-project-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--payment-project-green-950);
  }
  .payment-project-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--payment-project-ink-400);}
  .payment-project-topbar-actions{display:flex;align-items:center;gap:18px;}
  .payment-project-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--payment-project-cream-100);color:var(--payment-project-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .payment-project-icon-btn:hover{background:var(--payment-project-gold-300);}
  .payment-project-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .payment-project-main{grid-area:main;padding:26px 30px 50px;}
  .payment-project-breadcrumb{font-size:12px;color:var(--payment-project-ink-400);margin-bottom:16px;}
  .payment-project-breadcrumb a{color:var(--payment-project-ink-400);text-decoration:none;}
  .payment-project-breadcrumb a:hover{color:var(--payment-project-green-700);}
  .payment-project-breadcrumb span{color:var(--payment-project-green-700);font-weight:600;}

  .payment-project-panel{
    background:var(--payment-project-white);
    border-radius:var(--payment-project-radius-lg);
    box-shadow:var(--payment-project-shadow);
    overflow:hidden;
    border:1px solid var(--payment-project-border);
  }

  .payment-project-panel-header{
    background:linear-gradient(135deg,var(--payment-project-green-800),var(--payment-project-green-950));
    color:var(--payment-project-cream-50);
    padding:24px 30px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .payment-project-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:600;
  }
  .payment-project-panel-title svg{width:20px;height:20px;flex:0 0 20px;color:var(--payment-project-gold-300);}
  .payment-project-panel-close{
    width:32px;height:32px;border-radius:50%;flex:0 0 32px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--payment-project-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;
    cursor:pointer;transition:background .15s ease;
  }
  .payment-project-panel-close:hover{background:rgba(250,247,240,0.12);}

  /* ---------- Toolbar ---------- */
  .payment-project-toolbar{
    display:flex;align-items:center;gap:12px;flex-wrap:wrap;
    padding:22px 30px 0;
  }
  .payment-project-search{
    flex:1;min-width:200px;
    height:42px;
    border:1px solid var(--payment-project-border);
    border-radius:var(--payment-project-radius-sm);
    padding:0 14px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--payment-project-ink-900);
    background:var(--payment-project-white);
    outline:none;
    transition:border-color .15s ease;
  }
  .payment-project-search::placeholder{color:var(--payment-project-ink-400);}
  .payment-project-search:focus{border-color:var(--payment-project-gold-500);}

  .payment-project-toolbar-row2{
    display:flex;justify-content:flex-end;
    padding:14px 30px 4px;
  }
  .payment-project-perpage{
    height:36px;min-width:110px;
    border:1px solid var(--payment-project-border);
    border-radius:var(--payment-project-radius-sm);
    padding:0 34px 0 12px;
    font-size:12.5px;font-family:inherit;
    color:var(--payment-project-ink-900);
    background-color:var(--payment-project-white);
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 10px center;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    outline:none;cursor:pointer;
  }

  /* ---------- Project list ---------- */
  .payment-project-list{
    display:flex;flex-direction:column;
    padding:14px 30px 30px;
    gap:10px;
  }
  .payment-project-row{
    display:flex;align-items:center;justify-content:space-between;
    padding:14px 18px;
    background:var(--payment-project-cream-50);
    border:1px solid var(--payment-project-border);
    border-radius:var(--payment-project-radius-sm);
    transition:border-color .15s ease, background .15s ease;
  }
  .payment-project-row:hover{border-color:var(--payment-project-gold-500);background:var(--payment-project-white);}
  
  .payment-project-row-left{
    display:flex;align-items:center;gap:16px;
  }
  .payment-project-row-img{
    width:48px;height:48px;border-radius:8px;
    background-color:var(--payment-project-ink-400);
    background-size:cover;background-position:center;
  }
  .payment-project-row-info{display:flex;flex-direction:column;gap:2px;}
  .payment-project-row-name{font-size:15px;font-weight:700;color:var(--payment-project-green-950);}
  .payment-project-row-sub{font-size:12.5px;color:var(--payment-project-ink-600); font-weight: 500;}
  
  .payment-project-row-select{
    height:36px;padding:0 20px;
    border-radius:var(--payment-project-radius-sm);
    border:1px solid var(--payment-project-green-700);
    background:var(--payment-project-white);
    color:var(--payment-project-green-700);
    font-size:12.5px;font-weight:700;letter-spacing:0.01em;
    cursor:pointer;
    transition:background .15s ease,color .15s ease;
  }
  .payment-project-row-select:hover{
    background:var(--payment-project-green-800);
    color:var(--payment-project-cream-50);
    border-color:var(--payment-project-green-800);
  }

  .payment-project-empty{padding:40px 18px;text-align:center;color:var(--payment-project-ink-400);font-size:13.5px;}

  @media (max-width:900px){
    .payment-project-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-project-toolbar{flex-direction:column;align-items:stretch;}
  }
</style>

<div data-page="payment" id="Main_dashboard_02_C2">

<div class="payment-project-app">

   <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="payment-project-topbar">
    <div class="payment-project-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="payment-project-topbar-actions">
      <button class="payment-project-icon-btn" title="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="payment-project-icon-btn" title="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="payment-project-icon-btn" title="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="payment-project-main">
    <p class="payment-project-breadcrumb">
      <a href="javascript:void(0)">Dashboard</a> /
      <a href="javascript:void(0)">Payment</a> /
      <a href="javascript:void(0)" onclick="main_dashboard_02_B_OPEN()">Create Payment</a> /
      <span>Select Project</span>
    </p>

    <section class="payment-project-panel">
      <div class="payment-project-panel-header">
        <div class="payment-project-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Project List
        </div>
        <a class="payment-project-panel-close" onclick="main_dashboard_02_B_OPEN()" title="Close">✕</a>
      </div>

      <div class="payment-project-toolbar">
        <input type="text" class="payment-project-search" id="payment-project-search"
               placeholder="Search projects..." oninput="paymentProjectRender()">
      </div>

      <div class="payment-project-toolbar-row2">
        <select class="payment-project-perpage" id="payment-project-perpage" onchange="paymentProjectRender()">
          <option value="10">Per Page 10</option>
          <option value="25">Per Page 25</option>
          <option value="50" selected>Per Page 50</option>
        </select>
      </div>

      <div class="payment-project-list" id="payment-project-list">
          <!-- Populated by JS -->
      </div>
      
      <div class="payment-project-empty" id="payment-project-empty" style="display:none;">No projects match your search.</div>
    </section>
  </main>
</div>

<?php 
// Include specific JS script corresponding to this UI for AJAX processing
if (file_exists('JS/Main-Dashboard_02_C2_JS.php')) {
    include_once 'JS/Main-Dashboard_02_C2_JS.php';
}
?>

<div id="bmjm-footer-root"></div>
</div>
