<?php 
    $pth = "../"; 
    $active_page = "income-tracker"; 
    $page_title = "Inside Income Overview · bmjm Admin";
    $type_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* Base design tokens from dashboard applied */
  :root{
    --projc-green-950:#0B2E24; --projc-green-800:#123832; --projc-green-700:#1B4B41;
    --projc-gold-600:#B8923D; --projc-gold-500:#C9A227; --projc-gold-300:#E4C766;
    --projc-cream-50:#FAF7F0; --projc-cream-100:#F2EDE0; --projc-white:#FFFFFF;
    --projc-ink-900:#1E2B26; --projc-ink-600:#5A6A62; --projc-ink-400:#8B978F;
    --projc-border:#E6E0D0; --projc-danger:#C0392B; --projc-radius-lg:24px;
    --projc-shadow:0 12px 32px rgba(11,46,36,0.06);
    --projc-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;background:var(--projc-cream-50);font-family:'Inter',sans-serif;color:var(--projc-ink-900);}
  
  .income-inside-app { display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr; min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main"; }
  .income-inside-topbar { grid-area:topbar; background:rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-bottom:1px solid rgba(230,224,208,0.6); display:flex;align-items:center;justify-content:space-between; padding:0 30px; z-index: 10; }
  .income-inside-topbar-heading h1{ font-family:'Poppins',sans-serif; font-size:19px;font-weight:600;margin:0; color:var(--projc-green-950); }
  .income-inside-topbar-heading p{ margin:1px 0 0;font-size:11.5px;color:var(--projc-ink-400); }
  .income-inside-icon-btn { width:36px;height:36px;border-radius:50%; display:flex;align-items:center;justify-content:center; background:var(--projc-cream-100);color:var(--projc-green-800); border:none;cursor:pointer;transition:all .3s ease; margin-left:12px; }
  .income-inside-icon-btn:hover { background:var(--projc-gold-300); transform:translateY(-2px); color: var(--projc-green-950); }
  
  .income-inside-main { grid-area:main; padding:30px 40px; display: flex; flex-direction: column; animation: fadeSlideUp 0.6s var(--projc-cubic) forwards; }
  @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  
  .income-inside-breadcrumb { font-size:13px;color:var(--projc-ink-400);margin-bottom:24px; display: flex; gap: 8px; align-items: center; }
  .income-inside-breadcrumb a { color:var(--projc-ink-400);text-decoration:none; transition: color 0.2s; }
  .income-inside-breadcrumb a:hover { color:var(--projc-green-700); }
  .income-inside-breadcrumb span { color:var(--projc-green-700);font-weight:600; background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px; }

  .income-inside-panel { flex: 1; background: var(--projc-white); border-radius: var(--projc-radius-lg); box-shadow: var(--projc-shadow); overflow: hidden; border: 1px solid var(--projc-border); display: flex; flex-direction: column; }
  .income-inside-panel-header { background: linear-gradient(135deg, var(--projc-green-800), var(--projc-green-950)); color: var(--projc-cream-50); padding: 30px 34px; display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden; }
  .income-inside-panel-header::before { content: ''; position: absolute; left: -20px; top: -50px; width: 250px; height: 250px; border-radius: 50%; background: var(--projc-gold-500); filter: blur(50px); opacity: 0.15; pointer-events: none; }
  .income-inside-panel-title { display:flex;align-items:center;gap:14px; font-family:'Poppins',sans-serif; font-size:22px;font-weight:600; position: relative; z-index: 2; }
  .income-inside-panel-close { width:36px;height:36px;border-radius:50%; border:1px solid rgba(250,247,240,0.25); background:transparent;color:var(--projc-cream-50); display:flex;align-items:center;justify-content:center; text-decoration:none; position: relative; z-index: 2; cursor:pointer;transition:all .3s ease; }
  .income-inside-panel-close:hover { background: rgba(250,247,240,0.15); transform: rotate(90deg); }

  .income-inside-toolbar { display:flex;align-items:center;gap:16px;flex-wrap:wrap; padding:20px 34px; background: rgba(250, 247, 240, 0.4); border-bottom: 1px solid var(--projc-cream-100); justify-content:space-between; }
  .income-inside-searchbox { position: relative; flex:1; max-width:400px; display: flex; }
  .income-inside-search { width: 100%; height:46px; border:1px solid var(--projc-border); border-radius:12px; padding:0 20px 0 50px; font-size:14px; font-weight: 500; font-family:inherit; color:var(--projc-ink-900); background:var(--projc-white); outline:none; transition:all .3s ease; }
  .income-inside-search:focus { border-color:var(--projc-gold-300); box-shadow:0 4px 16px rgba(201,162,39,0.1); }
  .income-inside-searchbox svg { position: absolute; left: 16px; top: 13px; width: 20px; height: 20px; color: var(--projc-ink-400); pointer-events: none; }
  
  .income-inside-datebox { display:flex; gap:10px; align-items:center; }
  .income-inside-date-input { height:46px; border:1px solid var(--projc-border); border-radius:12px; padding:0 15px; font-size:13px; font-weight:500; font-family:inherit; color:var(--projc-ink-900); background:var(--projc-white); outline:none; transition:all .3s ease; }
  .income-inside-date-input:focus { border-color:var(--projc-gold-300); }
  .income-inside-filter-btn { height:46px; border:none; border-radius:12px; padding:0 20px; font-size:14px; font-weight:600; font-family:inherit; color:var(--projc-green-950); background:var(--projc-gold-300); cursor:pointer; transition:all .3s ease; }
  .income-inside-filter-btn:hover { background:var(--projc-gold-500); transform:translateY(-2px); box-shadow:0 6px 16px rgba(201,162,39,0.2); }

  .income-inside-totals { font-size:14px; font-weight:700; color:var(--projc-ink-600); display:flex; gap:10px; align-items:center; }
  .income-inside-totals-val { font-size:22px; color:var(--projc-green-950); font-weight:800; font-variant-numeric:tabular-nums; }

  .list-content-area { padding: 34px; flex: 1; display: flex; flex-direction: column; min-height: 350px; }
  .premium-table-wrap { width: 100%; border-collapse: separate; border-spacing: 0; box-shadow: 0 4px 16px rgba(11,46,36,0.03); border-radius: 12px; background: var(--projc-white); overflow: hidden; border: 1px solid var(--projc-border); }
  .premium-table { width: 100%; border-collapse: collapse; text-align: left; }
  .premium-table thead th { background: rgba(250, 247, 240, 0.6); color: var(--projc-ink-600); font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding: 16px 24px; border-bottom: 1px solid var(--projc-cream-100); }
  .premium-table tbody td { padding: 18px 24px; font-size: 14px; font-weight: 500; color: var(--projc-ink-900); border-bottom: 1px solid var(--projc-cream-100); }
  .premium-table tbody tr:last-child td { border-bottom: none; }
  .premium-table tbody tr:hover td { background: var(--projc-cream-50); }
  .td-bold-price { font-weight: 700 !important; color: var(--projc-green-800) !important; font-variant-numeric: tabular-nums; }
  .empty-state { text-align:center; padding: 60px; color: var(--projc-ink-400); font-weight: 600; }
  
  @media (max-width: 900px) { .income-inside-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";} .income-inside-main { padding: 20px; } .income-inside-toolbar { flex-direction:column; align-items:stretch;} .income-inside-searchbox { max-width:none;} .premium-table-wrap { overflow-x: auto; white-space: nowrap; } }
</style>

<div data-page="project" id="Main_Dashboard_04_B">
  <div class="income-inside-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>
    <header class="income-inside-topbar">
      <div class="income-inside-topbar-heading">
        <h1>Dashboard Output</h1>
        <p>Inside Group Income Display</p>
      </div>
      <div style="display:flex;">
        <button class="income-inside-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      </div>
    </header>
    <main class="income-inside-main">
      <p class="income-inside-breadcrumb">
        <a href="javascript:void(0);" onclick="window.history.back()">Income & Expense</a> / 
        <span>Transaction History</span>
      </p>

      <section class="income-inside-panel">
          <div class="income-inside-panel-header">
              <div class="income-inside-panel-title">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                  <span id="category-title-display">Category Transactions</span>
              </div>
              <a class="income-inside-panel-close" onclick="Main_Dashboard_04_A_OPEN()" title="Return">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
              </a>
          </div>

          <div class="income-inside-toolbar">
              <div class="income-inside-searchbox">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                  <input type="text" class="income-inside-search" id="tx-search" placeholder="Search by description or date..." oninput="renderTransactionTable()" onkeyup="renderTransactionTable()">
              </div>

              <div class="income-inside-datebox">
                  <input type="date" class="income-inside-date-input" id="tx-start-date" title="Start Date">
                  <span style="color:var(--projc-ink-400); font-weight:600;">to</span>
                  <input type="date" class="income-inside-date-input" id="tx-end-date" title="End Date">
                  <button class="income-inside-filter-btn" onclick="fetchTransactions()">Filter</button>
              </div>

              <div class="income-inside-totals">
                  Total Captured:
                  <div class="income-inside-totals-val" id="tx-total">LKR 0.00</div>
              </div>
          </div>

          <div class="list-content-area">
              <div class="premium-table-wrap">
                  <table class="premium-table">
                      <thead>
                          <tr>
                              <th>Tx ID</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th style="text-align:right;">Amount (LKR)</th>
                          </tr>
                      </thead>
                      <tbody id="tx-table-body">
                          <tr><td colspan="4" class="empty-state">Loading transactions from backend...</td></tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </section>
    </main>
  </div>
  <?php echo "<script>var current_type_id = " . $type_id . ";</script>\n"; ?>
  <?php include 'JS/Main_Dashboard_04_B_JS.php'; ?>
</div>
