<?php 
    $pth = "../"; 
    $active_page = "settings-bank-account"; // Tells the sidebar to highlight this tab
    $page_title = "Bank Accounts - bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Bank Account Grid List Redesign
     =================================================================== */
  :root{
    --colln-green-950:#0B2E24;
    --colln-green-800:#123832;
    --colln-green-700:#1B4B41;
    --colln-gold-600:#B8923D;
    --colln-gold-500:#C9A227;
    --colln-gold-300:#E4C766;
    --colln-cream-50:#FAF7F0;
    --colln-cream-100:#F2EDE0;
    --colln-white:#FFFFFF;
    --colln-ink-900:#1E2B26;
    --colln-ink-600:#5A6A62;
    --colln-ink-400:#8B978F;
    --colln-border:#E6E0D0;
    --colln-radius-sm:8px;
    --colln-radius-lg:8px;
    --colln-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--colln-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--colln-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .colln-app{
    display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr;
    min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main";
  }

  /* TOPBAR */
  .colln-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px; z-index: 10;
  }
  .colln-topbar-heading h1{ font-size:19px;font-weight:600;margin:0;color:var(--colln-green-950); }
  .colln-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--colln-ink-400);}
  .colln-topbar-actions{display:flex;gap:18px;}
  .colln-icon-btn{
    width:36px;height:36px;border-radius:50%; display:flex;align-items:center;justify-content:center;
    background:var(--colln-cream-100);color:var(--colln-green-800); border:none;cursor:pointer;
    transition:all .2s var(--colln-cubic);
  }
  .colln-icon-btn:hover{background:var(--colln-gold-300); transform:translateY(-2px);}
  .colln-icon-btn svg{width:16px;height:16px;}

  /* MAIN */
  .colln-main{ grid-area:main; padding:30px 40px 60px; display: flex; flex-direction: column; }

  /* BREADCRUMBS */
  .colln-breadcrumb{ font-size:13px;color:var(--colln-ink-400);margin-bottom:24px; display: flex; gap: 8px; align-items: center; }
  .colln-breadcrumb a{ color:var(--colln-ink-400);text-decoration:none; transition: color 0.2s;}
  .colln-breadcrumb a:hover{color:var(--colln-green-700);}
  .colln-breadcrumb span{ color:var(--colln-green-700);font-weight:600; background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px; }

  /* PANEL */
  .colln-grid-panel{
    width: 100%; min-height: calc(100vh - 180px);
    background: var(--colln-white);
    border-radius:var(--colln-radius-lg); box-shadow: 0 12px 32px rgba(11,46,36,0.08);
    overflow:hidden; border:1px solid var(--colln-border);
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.5s var(--colln-cubic) forwards;
  }
  @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  .colln-panel-header{
    background:var(--colln-green-950);
    color:var(--colln-white); padding:36px 48px;
    display:flex;align-items:center;justify-content:space-between; position: relative; overflow: hidden;
  }
  .colln-panel-title{ font-size:26px;font-weight:700; display:flex;align-items:center;gap:16px; position: relative; z-index: 2;}
  .colln-panel-title svg{width:26px;height:26px;color:var(--colln-gold-300);}

  .colln-panel-close{
    width:42px;height:42px;border-radius:50%; border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--colln-cream-50); display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2; cursor:pointer;transition:all .2s var(--colln-cubic);
  }
  .colln-panel-close:hover{ background:rgba(250,247,240,0.15); transform: rotate(90deg); }

  /* TOOLBAR */
  .colln-toolbar{ padding: 24px 48px; display: flex; align-items: center; justify-content: space-between; gap: 20px; border-bottom: 1px solid var(--colln-border); }
  .colln-search-wrap{ display: flex; align-items: center; gap: 16px; flex: 1; max-width: 600px; }
  
  .colln-field{ display:flex;flex-direction:column;gap:8px; width: 100%;}
  .colln-field label{ font-size:12.5px;font-weight:700; color:var(--colln-green-950); text-transform: uppercase; letter-spacing: 0.05em;}
  
  .colln-input, .colln-select {
    width: 100%; height: 50px; padding: 0 20px; border: 2px solid var(--colln-border);
    border-radius: var(--colln-radius-sm); font-size: 14px; font-weight: 500; font-family: inherit;
    background: var(--colln-white); color: var(--colln-ink-900); outline: none; transition: border 0.2s;
  }
  .colln-input:focus, .colln-select:focus { border-color: var(--colln-gold-500); }
  .colln-select { appearance: none; background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%231E2B26" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>') no-repeat right 16px center / 16px var(--colln-white); cursor: pointer;}
  
  .colln-btn-primary{
    height: 50px; padding: 0 32px; margin-top: 24px;
    border-radius: var(--colln-radius-sm); border: none; cursor: pointer;
    font-size:15px;font-weight:800;letter-spacing:0.02em; white-space: nowrap;
    background: linear-gradient(135deg, var(--colln-gold-500), var(--colln-gold-600)); color: var(--colln-green-950);
    display:flex;align-items:center;justify-content:center; gap: 10px; transition:all .3s var(--colln-cubic);
  }
  .colln-btn-primary:hover{ box-shadow:0 10px 24px rgba(184,146,61,0.4); transform: translateY(-2px); }

  /* DATA GRID */
  .colln-table-wrap { padding: 0 48px 48px; width: 100%; overflow-x: auto; flex: 1; }
  .colln-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; min-width: 800px; }
  
  .colln-table th {
    padding: 30px 24px 10px; text-align: left; font-size: 12px; font-weight: 800;
    color: var(--colln-ink-400); text-transform: uppercase; letter-spacing: 0.08em;
  }
  
  .colln-table tbody tr {
    transition: all 0.2s var(--colln-cubic); background: var(--colln-white); position: relative;
  }
  .colln-table tbody tr:hover { transform: translateY(-3px) scale(1.005); box-shadow: 0 12px 30px rgba(11,46,36,0.06); }
  
  .colln-table td {
    padding: 20px 24px; border-top: 1px solid var(--colln-border); border-bottom: 1px solid var(--colln-border);
    vertical-align: middle; color: var(--colln-ink-900);
  }
  
  .colln-table td:first-child { border-left: 1px solid var(--colln-border); border-radius: 12px 0 0 12px; }
  .colln-table td:last-child { border-right: 1px solid var(--colln-border); border-radius: 0 12px 12px 0; }
  
  /* GRID TYPOGRAPHY */
  .colln-bold-txt { font-weight: 700; font-size: 15px; color: var(--colln-green-950); display: block; margin-bottom: 4px; }
  .colln-sub-txt { font-weight: 500; font-size: 13px; color: var(--colln-ink-600); }
  .colln-branch-badge { 
    display: inline-block; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;
    background: rgba(201, 162, 39, 0.15); color: var(--colln-green-950);
  }
  
  .colln-action-btn {
    height: 38px; padding: 0 20px; border-radius: 20px; font-size: 13px; font-weight: 700;
    background: var(--colln-cream-100); color: var(--colln-green-950); border: 2px solid transparent; 
    cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;
  }
  .colln-action-btn:hover { background: var(--colln-green-950); color: var(--colln-white); }
  
  .colln-empty { text-align: center; padding: 60px; color: var(--colln-ink-400); font-size: 15px; font-weight: 500; }

  @media (max-width:1100px){
    .colln-toolbar{ flex-direction: column; align-items: stretch; gap: 24px; }
    .colln-search-wrap { max-width: 100%; flex-direction: column; align-items: stretch; }
    .colln-btn-primary{ margin-top: 0; }
  }
  @media (max-width:900px){
    .colln-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .colln-main { padding: 20px 24px; }
    .colln-panel-header, .colln-toolbar, .colln-table-wrap { padding: 24px; }
  }
</style>

<div data-page="settings" id="Main_Dashboard_05_03_A">

<div class="colln-app">

     <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <header class="colln-topbar">
    <div class="colln-topbar-heading">
      <h1>Bank Accounts</h1>
      <p>Settings</p>
    </div>
    <div class="colln-topbar-actions">
      <button class="colln-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      <button class="colln-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg></button>
      <button class="colln-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg></button>
    </div>
  </header>

  <main class="colln-main">
    <p class="colln-breadcrumb">
      <a href="dashboard.php">Dashboard</a> /
      <a onclick="main_dashboard_05_01_OPEN()" style="cursor:pointer;">Platform Configuration</a> /
      <span>Bank Accounts</span>
    </p>

    <div class="colln-grid-panel">
      
      <div class="colln-panel-header">
        <div class="colln-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="2" x2="12" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Bank Account Ledger
        </div>
        <a class="colln-panel-close" onclick="main_dashboard_05_01_OPEN()" title="Close" aria-label="Close">X</a>
      </div>

      <div class="colln-toolbar">
         <div class="colln-search-wrap">
            <div class="colln-field">
              <label>Search Bank Accounts</label>
              <input type="text" class="colln-input" id="settings-bank-account-search" placeholder="Type to filter..." oninput="Settings_body_01_D_07_bank_account_list()">
            </div>
            <div class="colln-field">
              <label>Filter By</label>
              <select class="colln-select" id="settings-bank-account-type" onchange="Settings_body_01_D_07_bank_account_list()">
                <option value="account">Account Number</option>
                <option value="bank">Bank Name</option>
                <option value="branch">Branch</option>
              </select>
            </div>
         </div>
         <button type="button" class="colln-btn-primary" onclick="main_dashboard_05_03_B_OPEN()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
            Add Bank Account
         </button>
      </div>

      <div class="colln-table-wrap">
          <table class="colln-table">
            <thead>
              <tr>
                <th>Bank</th>
                <th>Branch</th>
                <th>Account Number</th>
                <th style="width:120px;">Action</th>
              </tr>
            </thead>
            <tbody id="settings-bank-account-list"></tbody>
          </table>
          <div class="colln-empty" id="settings-bank-account-empty" style="display:none;">
            No bank accounts match this search.
          </div>
      </div>

    </div>

  </main>

</div>

<?php include 'JS/Main_Dashboard_05_03_A_JS.php'; ?>

<div id="bmjm-footer-root"></div>
<script src="footer-loader.js"></script>

</div>
