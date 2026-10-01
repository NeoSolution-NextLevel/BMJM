<?php 
    $pth = "../"; 
    $active_page = "income-tracker"; // Sidebar tracker
    $page_title = "Income Control System · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (Income Overview Grid - Premium UX)
     =================================================================== */
  :root{
    --projc-green-950:#0B2E24;
    --projc-green-800:#123832;
    --projc-green-700:#1B4B41;
    --projc-gold-600:#B8923D;
    --projc-gold-500:#C9A227;
    --projc-gold-300:#E4C766;
    --projc-cream-50:#FAF7F0;
    --projc-cream-100:#F2EDE0;
    --projc-white:#FFFFFF;
    --projc-ink-900:#1E2B26;
    --projc-ink-600:#5A6A62;
    --projc-ink-400:#8B978F;
    --projc-border:#E6E0D0;
    --projc-radius-lg:24px;
    --projc-shadow:0 12px 32px rgba(11,46,36,0.06);
    --projc-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--projc-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--projc-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .income-tracker-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .income-tracker-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .income-tracker-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--projc-green-950);
  }
  .income-tracker-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--projc-ink-400);}
  .income-tracker-topbar-actions{display:flex;align-items:center;gap:18px;}
  .income-tracker-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--projc-cream-100);color:var(--projc-green-800);
    border:none;cursor:pointer;transition:all .3s var(--projc-cubic);
  }
  .income-tracker-icon-btn:hover{
    background:var(--projc-gold-300); transform:translateY(-2px) scale(1.05); color: var(--projc-green-950);
  }
  .income-tracker-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main App Window ---------- */
  .income-tracker-main{
    grid-area:main;
    padding:30px 40px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--projc-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .income-tracker-breadcrumb{
    font-size:13px;color:var(--projc-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .income-tracker-breadcrumb a{
    color:var(--projc-ink-400);text-decoration:none; transition: color 0.2s;
  }
  .income-tracker-breadcrumb a:hover{color:var(--projc-green-700);}
  .income-tracker-breadcrumb span{
    color:var(--projc-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  /* Main Panel Content Container */
  .income-tracker-panel {
    flex: 1;
    background: var(--projc-white);
    border-radius: var(--projc-radius-lg);
    box-shadow: var(--projc-shadow);
    overflow: hidden;
    border: 1px solid var(--projc-border);
    display: flex;
    flex-direction: column;
  }

  /* Panel Header */
  .income-tracker-panel-header {
    background: linear-gradient(135deg, var(--projc-green-800), var(--projc-green-950));
    color: var(--projc-cream-50);
    padding: 30px 34px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
  }
  
  .income-tracker-panel-header::before {
    content: ''; position: absolute; right: 5%; top: -60px;
    width: 250px; height: 250px; border-radius: 50%;
    background: var(--projc-gold-500); filter: blur(50px); opacity: 0.15;
    pointer-events: none;
  }

  .income-tracker-panel-title {
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    position: relative; z-index: 2;
  }
  .income-tracker-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--projc-gold-300);}

  .income-tracker-panel-close {
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--projc-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .3s var(--projc-cubic);
  }
  .income-tracker-panel-close:hover {
    background: rgba(250,247,240,0.15); transform: rotate(90deg);
  }
  
  /* OVERALL TOTAL BANNER */
  .income-tracker-grand-total {
      background: linear-gradient(135deg, rgba(230, 224, 208, 0.4), rgba(250, 247, 240, 0.8));
      backdrop-filter: blur(10px); padding: 24px 34px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--projc-cream-100);
  }
  .income-tracker-grand-title {
      font-size: 15px; font-weight: 700; color: var(--projc-ink-600);
      text-transform: uppercase; letter-spacing: 0.05em;
  }
  .income-tracker-grand-amount {
      font-size: 32px; font-weight: 800; color: var(--projc-green-950);
      font-variant-numeric: tabular-nums;
  }
  .income-tracker-grand-amount span {
      font-size: 18px; color: var(--projc-gold-600); margin-right: 6px;
  }

  /* Grid Layout for Cards */
  .income-tracker-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 24px; padding: 34px;
      background: var(--projc-white);
  }

  /* Search Toolbar Component */
  .income-tracker-toolbar{
    display:flex;align-items:center;gap:16px;flex-wrap:wrap;
    padding:20px 34px;
    background: rgba(250, 247, 240, 0.4);
    border-bottom: 1px solid var(--projc-cream-100);
  }
  .income-tracker-searchbox {
    position: relative; flex:1; min-width:300px; display: flex;
  }
  .income-tracker-search{
    width: 100%; height:46px; border:2px solid transparent; border-radius:12px;
    padding:0 20px 0 50px; font-size:14px; font-weight: 500; font-family:inherit;
    color:var(--projc-ink-900); background:rgba(255,255,255,0.8);
    box-shadow:var(--projc-shadow-sm); outline:none; transition:all .3s var(--projc-cubic);
  }
  .income-tracker-search::placeholder{color:var(--projc-ink-400);}
  .income-tracker-search:focus{
    border-color:var(--projc-gold-300); background: var(--projc-white);
    box-shadow:0 8px 24px rgba(201,162,39,0.15);
  }
  .income-tracker-searchbox svg {
    position: absolute; left: 16px; top: 13px; width: 20px; height: 20px; 
    color: var(--projc-ink-400); pointer-events: none; transition: color 0.3s ease;
  }
  .income-tracker-searchbox:focus-within svg { color: var(--projc-gold-600); }

  /* Sleek Glassmorphic Card for each type */
  .income-type-card {
      background: var(--projc-white);
      border: 1px solid rgba(230, 224, 208, 0.5);
      border-radius: 20px; padding: 24px;
      display: flex; flex-direction: column; gap: 16px;
      box-shadow: 0 4px 16px rgba(11,46,36,0.03);
      transition: all 0.4s var(--projc-cubic);
      position: relative; opacity: 0; transform: translateY(20px);
      animation: fadeSlideUp 0.6s var(--projc-cubic) forwards;
  }
  
  .income-type-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 16px 40px rgba(11,46,36,0.08);
      border-color: rgba(200, 180, 140, 0.5);
  }
  
  .income-type-header {
      display: flex; align-items: center; gap: 12px;
  }
  .income-type-icon {
      width: 44px; height: 44px; border-radius: 12px;
      background: linear-gradient(135deg, var(--projc-green-800), var(--projc-green-950));
      color: var(--projc-gold-300);
      display: flex; align-items: center; justify-content: center;
  }
  .income-type-icon svg { width: 22px; height: 22px; }
  
  .income-type-name {
      font-size: 16px; font-weight: 700; color: var(--projc-green-950);
      line-height: 1.3;
  }
  .income-type-badge {
      font-size: 11px; font-weight: 700; color: var(--projc-ink-400); text-transform: uppercase;
  }
  
  .income-type-amount {
      font-size: 26px; font-weight: 800; color: var(--projc-green-800);
      font-variant-numeric: tabular-nums;
  }
  .income-type-amount::before {
      content: 'LKR '; font-size: 13px; color: rgba(11, 46, 36, 0.4); font-weight: 700; margin-right: 4px;
  }

  .income-tracker-loading { padding: 60px; text-align: center; color: var(--projc-ink-400); font-weight: 600; width: 100%; grid-column: 1 / -1;}
  
  /* Responsive */
  @media (max-width: 900px) {
    .income-tracker-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .income-tracker-main { padding: 20px 24px; }
    .income-tracker-grand-total { flex-direction: column; align-items: flex-start; gap: 10px; }
    .income-tracker-grid { padding: 24px; grid-template-columns: 1fr; }
  }
</style>

<div data-page="project" id="Main_Dashboard_04_A">
  <div class="income-tracker-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="income-tracker-topbar">
      <div class="income-tracker-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div class="income-tracker-topbar-actions">
        <button class="income-tracker-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="income-tracker-icon-btn" title="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button>
        <button class="income-tracker-icon-btn" title="Sign out">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
        </button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="income-tracker-main">
      <p class="income-tracker-breadcrumb">
        <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / 
        <a href="javascript:void(0);" onclick="Main_Dashboard_04_A_OPEN()">Income & Expense</a> / 
        <span>Income Totals by Type</span>
      </p>

      <section class="income-tracker-panel">
          <div class="income-tracker-panel-header">
              <div class="income-tracker-panel-title">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                  Income Overview
              </div>
              <a class="income-tracker-panel-close" onclick="main_dashboard_00_OPEN()" title="Close Dashboard">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </a>
          </div>

          <div class="income-tracker-grand-total">
              <div class="income-tracker-grand-title">Total Processed Income</div>
              <div class="income-tracker-grand-amount" id="grand_total_display"><span>LKR</span> 0.00</div>
          </div>

          <div class="income-tracker-toolbar">
              <div class="income-tracker-searchbox">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                  <input type="text" class="income-tracker-search" id="income-search" placeholder="Search income categories by name..." oninput="renderIncomeGrid()" onkeyup="renderIncomeGrid()">
              </div>
          </div>

          <div class="income-tracker-grid" id="income_type_grid">
              <div class="income-tracker-loading">Loading income structures...</div>
          </div>
      </section>
    </main>

  </div>

  <?php include 'JS/Main_Dashboard_04_A_JS.php'; ?>
</div>
