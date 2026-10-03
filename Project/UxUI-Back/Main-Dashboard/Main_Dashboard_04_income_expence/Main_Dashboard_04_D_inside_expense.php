<?php 
    $pth = "../"; 
    $active_page = "accounts"; 
    $page_title = "Inside Expense Overview · BMJM Admin";
    $type_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  :root{
    --expense-in-green-950:#0B2E24; --expense-in-green-800:#123832; --expense-in-green-700:#1B4B41;
    --expense-in-gold-600:#B8923D; --expense-in-gold-500:#C9A227; --expense-in-gold-300:#E4C766;
    --expense-in-cream-50:#FAF7F0; --expense-in-cream-100:#F2EDE0; --expense-in-white:#FFFFFF;
    --expense-in-ink-900:#1E2B26; --expense-in-ink-600:#5A6A62; --expense-in-ink-400:#8B978F;
    --expense-in-border:#E6E0D0; --expense-in-danger:#C0392B; --expense-in-radius-lg:24px;
    --expense-in-shadow:0 12px 32px rgba(11,46,36,0.06);
    --expense-in-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;background:var(--expense-in-cream-50);font-family:'Inter',sans-serif;color:var(--expense-in-ink-900);}
  
  .expense-inside-app { display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr; min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main"; }
  .expense-inside-topbar { grid-area:topbar; background:rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-bottom:1px solid rgba(230,224,208,0.6); display:flex;align-items:center;justify-content:space-between; padding:0 30px; z-index: 10; }
  .expense-inside-topbar-heading h1{ font-family:'Poppins',sans-serif; font-size:19px;font-weight:600;margin:0; color:var(--expense-in-green-950); }
  .expense-inside-topbar-heading p{ margin:1px 0 0;font-size:11.5px;color:var(--expense-in-ink-400); }
  .expense-inside-icon-btn { width:36px;height:36px;border-radius:50%; display:flex;align-items:center;justify-content:center; background:var(--expense-in-cream-100);color:var(--expense-in-green-800); border:none;cursor:pointer;transition:all .3s ease; margin-left:12px; }
  .expense-inside-icon-btn:hover { background:var(--expense-in-gold-300); transform:translateY(-2px); color: var(--expense-in-green-950); }
  
  .expense-inside-main { grid-area:main; min-width:0; padding:30px 40px; display: flex; flex-direction: column; animation: fadeSlideUp 0.6s var(--expense-in-cubic) forwards; }
  
  .expense-inside-breadcrumb { font-size:13px;color:var(--expense-in-ink-400);margin-bottom:24px; display: flex; gap: 8px; align-items: center; }
  .expense-inside-breadcrumb a { color:var(--expense-in-ink-400);text-decoration:none; transition: color 0.2s; }
  .expense-inside-breadcrumb a:hover { color:var(--expense-in-green-700); }
  .expense-inside-breadcrumb span { color:#7B2020;font-weight:600; background: rgba(192, 57, 43, 0.08); padding: 4px 10px; border-radius: 12px; }

  .expense-inside-panel { flex:1 0 auto; min-width:0; background: var(--expense-in-white); border-radius: var(--expense-in-radius-lg); box-shadow: var(--expense-in-shadow); overflow: hidden; border: 1px solid var(--expense-in-border); display: flex; flex-direction: column; }
  .expense-inside-panel-header { background: linear-gradient(135deg, #4A1515, #7B2020); color: var(--expense-in-cream-50); padding: 20px 30px; display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden; }
  .expense-inside-panel-header::before { content: ''; position: absolute; left: -20px; top: -50px; width: 250px; height: 250px; border-radius: 50%; background: #E04040; filter: blur(50px); opacity: 0.15; pointer-events: none; }
  .expense-inside-panel-title { display:flex;align-items:center;gap:14px; font-family:'Poppins',sans-serif; font-size:22px;font-weight:600; position: relative; z-index: 2; }
  .expense-inside-panel-title svg { width:28px;height:28px;flex:none; }
  .expense-inside-header-actions { display:flex; align-items:center; gap:12px; position:relative; z-index:2; }
  .expense-inside-add-btn { height:36px; padding:0 16px; border-radius:8px; border:none; background:var(--expense-in-gold-500); color:var(--expense-in-green-950); font-weight:700; font-size:12.5px; cursor:pointer; display:flex; align-items:center; gap:6px; transition:all .2s ease; }
  .expense-inside-add-btn:hover { background:var(--expense-in-gold-300); transform:translateY(-1px); }
  .expense-inside-panel-close { width:36px;height:36px;border-radius:50%; border:1px solid rgba(250,247,240,0.25); background:transparent;color:var(--expense-in-cream-50); display:flex;align-items:center;justify-content:center; text-decoration:none; cursor:pointer;transition:all .3s ease; }
  .expense-inside-panel-close:hover { background: rgba(250,247,240,0.15); transform: rotate(90deg); }

  .expense-inside-toolbar { display:flex;align-items:center;gap:16px;flex-wrap:wrap; padding:20px 34px; background: rgba(250, 247, 240, 0.4); border-bottom: 1px solid var(--expense-in-cream-100); justify-content:space-between; }
  .expense-inside-searchbox { position: relative; flex:1; max-width:400px; display: flex; }
  .expense-inside-search { width: 100%; height:46px; border:1px solid var(--expense-in-border); border-radius:12px; padding:0 20px 0 50px; font-size:14px; font-weight: 500; font-family:inherit; color:var(--expense-in-ink-900); background:var(--expense-in-white); outline:none; transition:all .3s ease; }
  .expense-inside-search:focus { border-color:rgba(192,57,43,0.5); box-shadow:0 4px 16px rgba(192,57,43,0.1); }
  .expense-inside-searchbox svg { position: absolute; left: 16px; top: 13px; width: 20px; height: 20px; color: var(--expense-in-ink-400); pointer-events: none; }
  
  .expense-inside-datebox { display:flex; gap:10px; align-items:center; }
  .expense-inside-date-input { height:46px; border:1px solid var(--expense-in-border); border-radius:12px; padding:0 15px; font-size:13px; font-weight:500; font-family:inherit; color:var(--expense-in-ink-900); background:var(--expense-in-white); outline:none; transition:all .3s ease; }
  .expense-inside-date-input:focus { border-color:var(--expense-in-gold-300); }
  .expense-inside-filter-btn { height:46px; border:none; border-radius:12px; padding:0 20px; font-size:14px; font-weight:600; font-family:inherit; color:var(--expense-in-green-950); background:var(--expense-in-gold-300); cursor:pointer; transition:all .3s ease; }
  .expense-inside-filter-btn:hover { background:var(--expense-in-gold-500); transform:translateY(-2px); box-shadow:0 6px 16px rgba(201,162,39,0.2); }

  .expense-inside-totals { font-size:14px; font-weight:700; color:var(--expense-in-ink-600); display:flex; gap:10px; align-items:center; }
  .expense-inside-totals-val { font-size:22px; color:#7B2020; font-weight:800; font-variant-numeric:tabular-nums; }

  .expense-content-area { padding: 34px; flex:1 0 auto; min-width:0; display: flex; flex-direction: column; min-height: 350px; }
  .expense-table-wrap { flex:0 0 auto; width: 100%; max-width:100%; min-width:0; border-collapse: separate; border-spacing: 0; box-shadow: 0 4px 16px rgba(11,46,36,0.03); border-radius: 12px; background: var(--expense-in-white); overflow-x: auto; overflow-y: hidden; border: 1px solid var(--expense-in-border); }
  .expense-table { width: 100%; border-collapse: collapse; text-align: left; }
  .expense-table thead th { background: rgba(250, 247, 240, 0.6); color: var(--expense-in-ink-600); font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 16px 24px; border-bottom: 1px solid var(--expense-in-cream-100); }
  .expense-table tbody td { padding: 18px 24px; font-size: 14px; font-weight: 500; color: var(--expense-in-ink-900); border-bottom: 1px solid var(--expense-in-cream-100); }
  .expense-table tbody tr:last-child td { border-bottom: none; }
  .expense-table tbody tr:hover td { background: var(--expense-in-cream-50); }
  .td-bold-expense-price { font-weight: 700 !important; color: #7B2020 !important; font-variant-numeric: tabular-nums; }
  .expense-empty-state { text-align:center; padding: 60px; color: var(--expense-in-ink-400); font-weight: 600; }
  
  @media (max-width: 900px) {
    .expense-inside-app{grid-template-columns:minmax(0,1fr);grid-template-areas:"topbar" "main";}
    .expense-inside-main { padding:20px; }
    .expense-inside-toolbar { flex-direction:column; align-items:stretch; }
    .expense-inside-searchbox { max-width:none; width:100%; }
    .expense-inside-datebox { width:100%; flex-wrap:wrap; }
    .expense-inside-date-input { min-width:0; flex:1 1 120px; }
    .expense-inside-totals { flex-wrap:wrap; }
    .expense-table-wrap { white-space:nowrap; }
  }
</style>

<div data-page="accounts" id="Main_Dashboard_04_D">
  <div class="expense-inside-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>
    <header class="expense-inside-topbar">
      <div class="expense-inside-topbar-heading">
        <h1>Dashboard Output</h1>
        <p>Inside Expense Group Display</p>
      </div>
      <div style="display:flex;">
        <button class="expense-inside-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      </div>
    </header>
    <main class="expense-inside-main">
      <p class="expense-inside-breadcrumb">
        <a href="javascript:void(0);" onclick="Main_Dashboard_04_C_OPEN()">Expense Overview</a> / 
        <span>Expense History</span>
      </p>

      <section class="expense-inside-panel">
          <div class="expense-inside-panel-header">
              <div class="expense-inside-panel-title">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 3v4M8 3v4M12 12v3M12 17v.5"/></svg>
                  <span id="expense-category-title-display">Category Expenses</span>
              </div>
              <div class="expense-inside-header-actions">
                  <button class="expense-inside-add-btn" onclick="openAddExpenseForCurrentCategory()">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                      Add Expense
                  </button>
                  <a class="expense-inside-panel-close" onclick="Main_Dashboard_04_C_OPEN()" title="Return">
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                  </a>
              </div>
          </div>

          <div class="expense-inside-toolbar">
              <div class="expense-inside-searchbox">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                  <input type="text" class="expense-inside-search" id="expense-tx-search" placeholder="Search by description or date..." oninput="renderExpenseTransactionTable()" onkeyup="renderExpenseTransactionTable()">
              </div>

              <div class="expense-inside-datebox">
                  <input type="date" class="expense-inside-date-input" id="expense-tx-start-date" title="Start Date">
                  <span style="color:var(--expense-in-ink-400); font-weight:600;">to</span>
                  <input type="date" class="expense-inside-date-input" id="expense-tx-end-date" title="End Date">
                  <button class="expense-inside-filter-btn" onclick="fetchExpenseTransactions()">Filter</button>
              </div>

              <div class="expense-inside-totals">
                  Total Captured:
                  <div class="expense-inside-totals-val" id="expense-tx-total">LKR 0.00</div>
              </div>
          </div>

          <div class="expense-content-area">
              <div class="expense-table-wrap">
                  <table class="expense-table">
                      <thead>
                          <tr>
                              <th>Tx ID</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th style="text-align:right;">Amount (LKR)</th>
                          </tr>
                      </thead>
                      <tbody id="expense-tx-table-body">
                          <tr><td colspan="4" class="expense-empty-state">Loading expenses from backend...</td></tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </section>
    </main>
  </div>
  <?php include 'JS/Main_Dashboard_04_D_JS.php'; ?>
</div>
