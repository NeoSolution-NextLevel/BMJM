<?php 
    $pth = "../"; 
    $active_page = "settings"; // Tells the sidebar to highlight this tab
    $page_title = "Settings · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Settings Types (Bento Navigation Redesign)
     Bambalapitiya Jumma Masjid · Dashboard · Settings
     =================================================================== */
  :root{
    --settings-green-950:#0B2E24;
    --settings-green-800:#123832;
    --settings-green-700:#1B4B41;
    --settings-gold-600:#B8923D;
    --settings-gold-500:#C9A227;
    --settings-gold-300:#E4C766;
    --settings-cream-50:#FAF7F0;
    --settings-cream-100:#F2EDE0;
    --settings-white:#FFFFFF;
    --settings-ink-900:#1E2B26;
    --settings-ink-600:#5A6A62;
    --settings-ink-400:#8B978F;
    --settings-border:#E6E0D0;
    --settings-radius-sm:14px;
    --settings-radius-md:20px;
    --settings-radius-lg:32px;
    --settings-shadow: 0 10px 30px rgba(11,46,36,0.06);
    --settings-shadow-hover: 0 20px 40px rgba(11,46,36,0.12);
    --settings-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--settings-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--settings-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .settings-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .settings-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .settings-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--settings-green-950);
  }
  .settings-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--settings-ink-400);}
  .settings-topbar-actions{display:flex;align-items:center;gap:18px;}
  .settings-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--settings-cream-100);color:var(--settings-green-800);
    border:none;cursor:pointer;transition:all .2s var(--settings-cubic);
  }
  .settings-icon-btn:hover{background:var(--settings-gold-300); transform:translateY(-2px);}
  .settings-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main Application Panel ---------- */
  .settings-main{
    grid-area:main;
    padding:30px 40px 60px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--settings-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .settings-breadcrumb{
    font-size:13px;color:var(--settings-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .settings-breadcrumb a{ color:var(--settings-ink-400);text-decoration:none; transition: color 0.2s;}
  .settings-breadcrumb a:hover{color:var(--settings-green-700);}
  .settings-breadcrumb span{
    color:var(--settings-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  /* Unified Header Banner */
  .settings-header-banner {
      width: 100%; border-radius: var(--settings-radius-lg);
      background: linear-gradient(135deg, var(--settings-green-800), var(--settings-green-950));
      color: var(--settings-white); padding: 40px; margin-bottom: 32px;
      position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: space-between;
      box-shadow: var(--settings-shadow);
  }
  .settings-header-banner::before {
      content: ''; position: absolute; right: 80px; top: -100px;
      width: 300px; height: 300px; border-radius: 50%;
      background: var(--settings-gold-500); filter: blur(60px); opacity: 0.15;
      pointer-events: none;
  }
  .settings-header-title {
      z-index: 2; position: relative;
  }
  .settings-header-title h2 {
      font-family: 'Poppins', Inter, sans-serif;
      font-size: 28px; font-weight: 700; display: flex; align-items: center; gap: 16px; margin: 0 0 8px 0;
  }
  .settings-header-title h2 svg { color: var(--settings-gold-300); width: 28px; height: 28px; }
  .settings-header-title p {
      font-size: 15px; color: rgba(255,255,255,0.7); margin: 0; font-weight: 500;
  }
  
  .settings-header-close{
      width:44px;height:44px;border-radius:50%;flex:0 0 44px;
      border:1px solid rgba(250,247,240,0.25);
      background:transparent;color:var(--settings-cream-50);
      display:flex;align-items:center;justify-content:center;
      text-decoration:none; position: relative; z-index: 2;
      cursor:pointer;transition:all .2s var(--settings-cubic);
  }
  .settings-header-close:hover{ background:rgba(250,247,240,0.15); transform: rotate(90deg); }

  /* Grid Layout for Configuration Nodes */
  .settings-bento-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
  }

  .settings-card {
      background: var(--settings-white);
      border-radius: var(--settings-radius-md);
      box-shadow: var(--settings-shadow);
      border: 1px solid rgba(230, 224, 208, 0.4);
      padding: 32px 28px; text-decoration: none;
      transition: all 0.3s var(--settings-cubic);
      display: flex; flex-direction: column; position: relative; overflow: hidden;
  }
  .settings-card:hover { 
      box-shadow: var(--settings-shadow-hover);
      border-color: var(--settings-gold-300);
      transform: translateY(-4px);
  }
  .settings-card::after {
      content: ''; position: absolute; right: -20px; top: -20px;
      width: 100px; height: 100px; border-radius: 50%;
      background: var(--settings-cream-100); opacity: 0;
      transition: all 0.4s var(--settings-cubic); z-index: 0;
  }
  .settings-card:hover::after { opacity: 1; transform: scale(1.5); }

  .settings-card-icon {
      width: 56px; height: 56px; border-radius: 16px;
      background: var(--settings-cream-50); color: var(--settings-green-800);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 24px; position: relative; z-index: 2;
      transition: all 0.3s var(--settings-cubic);
      border: 2px solid transparent;
  }
  .settings-card-icon svg { width: 24px; height: 24px; }
  .settings-card:hover .settings-card-icon {
      background: var(--settings-white); border-color: var(--settings-gold-300);
      color: var(--settings-gold-600); box-shadow: 0 8px 24px rgba(201,162,39,0.15);
  }

  .settings-card-text { position: relative; z-index: 2; flex: 1; }
  .settings-card-text h3 {
      font-size: 17px; font-weight: 700; color: var(--settings-green-950);
      margin: 0 0 8px 0; display: flex; align-items: center; justify-content: space-between;
  }
  .settings-card-text p {
      font-size: 14px; color: var(--settings-ink-600); font-weight: 500;
      margin: 0; line-height: 1.5;
  }

  .settings-card-chevron {
      color: var(--settings-ink-400); transition: all 0.3s var(--settings-cubic);
  }
  .settings-card:hover .settings-card-chevron {
      color: var(--settings-gold-600); transform: translateX(4px);
  }

  @media (max-width:900px){
    .settings-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .settings-main { padding: 20px 24px; }
    .settings-header-banner { padding: 30px; flex-direction: column; gap: 20px; text-align: center; }
    .settings-header-close { position: absolute; right: 20px; top: 20px; }
  }
</style>

<div data-page="settings" id="Main_Dashboard_05_01">

<div class="settings-app">

     <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <header class="settings-topbar">
    <div class="settings-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="settings-topbar-actions">
      <button class="settings-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      <button class="settings-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg></button>
      <button class="settings-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg></button>
    </div>
  </header>

  <main class="settings-main">
    <p class="settings-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / <span>Platform Configuration</span>
    </p>

    <!-- Header -->
    <div class="settings-header-banner">
        <div class="settings-header-title">
            <h2>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                System Controls
            </h2>
            <p>Administer database environments, configure accounts, and establish operational parameters.</p>
        </div>
        <a class="settings-header-close" onclick="main_dashboard_00_OPEN()" title="Deploy">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </a>
    </div>

    <!-- Configuration Navigator Grid -->
    <div class="settings-bento-grid">
        
        <!-- Node 1 -->
        <!-- <a class="settings-card" href="settings-user-account.php">
            <div class="settings-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div class="settings-card-text">
                <h3>User Accounts <svg class="settings-card-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></h3>
                <p>Register admins, define permission tiers, and enforce authentication limits.</p>
            </div>
        </a> -->

        <!-- Node 2 -->
        <!-- <a class="settings-card" href="settings-management.php">
            <div class="settings-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/></svg>
            </div>
            <div class="settings-card-text">
                <h3>Management Scope <svg class="settings-card-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></h3>
                <p>Adjust overarching operational constraints and logic hierarchies.</p>
            </div>
        </a> -->

        <!-- Node 3 -->
        <a class="settings-card" onclick="main_dashboard_05_03_A_OPEN()">
            <div class="settings-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="2" x2="12" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <div class="settings-card-text">
                <h3>Bank Account Integration <svg class="settings-card-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></h3>
                <p>Bind routing ledgers and external financial accounts directly to collection points.</p>
            </div>
        </a>

        <!-- Node 4 -->
        <a class="settings-card" onclick="main_dashboard_05_04_A_OPEN()">
            <div class="settings-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
            </div>
            <div class="settings-card-text">
                <h3>Income / Expense Taxonomy <svg class="settings-card-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></h3>
                <p>Classify and categorize raw transaction variables globally.</p>
            </div>
        </a>

        <!-- Node 5 -->
        <!-- <a class="settings-card" href="settings-add-old-members.php">
            <div class="settings-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            </div>
            <div class="settings-card-text">
                <h3>Migrate Legacy Data <svg class="settings-card-chevron" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></h3>
                <p>Import archived offline membership data into the live platform.</p>
            </div>
        </a> -->

    </div>
    
  </main>

</div>
<div id="bmjm-footer-root"></div>
</div>
