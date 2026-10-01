<?php 
    $pth = "../"; 
    $active_page = "project-collection"; // Tells the sidebar to highlight this tab
    $page_title = "Collection Project List · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (Full Page Data Grid)
     Bambalapitiya Jumma Mosque · Dashboard · Collection Project List
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
    --projc-danger:#C0392B;
    --projc-danger-bg:#E9584C;
    --projc-radius-sm:12px;
    --projc-radius-lg:24px;
    --projc-shadow:0 12px 32px rgba(11,46,36,0.06);
    --projc-shadow-sm:0 4px 12px rgba(11,46,36,0.04);
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

  .project-collection-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .project-collection-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .project-collection-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--projc-green-950);
  }
  .project-collection-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--projc-ink-400);}
  .project-collection-topbar-actions{display:flex;align-items:center;gap:18px;}
  .project-collection-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--projc-cream-100);color:var(--projc-green-800);
    border:none;cursor:pointer;transition:all .2s var(--projc-cubic);
  }
  .project-collection-icon-btn:hover{background:var(--projc-gold-300); transform:translateY(-2px);}
  .project-collection-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main App Window ---------- */
  .project-collection-main{
    grid-area:main;
    padding:30px 40px 60px;
    /* display: flex; flex-direction: column; */
    animation: fadeSlideUp 0.6s var(--projc-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .project-collection-breadcrumb{
    font-size:13px;color:var(--projc-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .project-collection-breadcrumb a{
    color:var(--projc-ink-400);text-decoration:none; transition: color 0.2s;
  }
  .project-collection-breadcrumb a:hover{color:var(--projc-green-700);}
  .project-collection-breadcrumb span{
    color:var(--projc-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  /* Full Width List Panel Container */
  .project-collection-panel{
    width: 100%; flex: 1;
    background:var(--projc-white);
    border-radius:var(--projc-radius-lg);
    box-shadow:var(--projc-shadow);
    overflow:hidden;
    border:1px solid var(--projc-border);
    display: flex; flex-direction: column;
    min-height: calc(100vh - 180px); /* Fill space safely */
  }

  .project-collection-panel-header{
    background:linear-gradient(135deg,var(--projc-green-800),var(--projc-green-950));
    color:var(--projc-cream-50);
    padding:32px 40px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative; overflow: hidden;
  }
  
  /* Abstract Design Elements */
  .project-collection-panel-header::before {
    content: ''; position: absolute; right: 10%; top: -60px;
    width: 250px; height: 250px; border-radius: 50%;
    background: var(--projc-gold-500); filter: blur(50px); opacity: 0.15;
    pointer-events: none;
  }
  
  .project-collection-panel-title{
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    position: relative; z-index: 2;
  }
  .project-collection-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--projc-gold-300);}
  
  .project-collection-panel-close{
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--projc-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--projc-cubic);
  }
  .project-collection-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* ---------- Toolbar Filters ---------- */
  .project-collection-toolbar{
    display:flex;align-items:center;gap:16px;flex-wrap:wrap;
    padding:30px 40px;
    background: rgba(250, 247, 240, 0.4);
    border-bottom: 1px solid var(--projc-cream-100);
  }
  
  .project-collection-searchbox {
    position: relative; flex:1; min-width:300px; display: flex;
  }
  
  /* We keep id="project-collection-search" on the input for JS state binding */
  .project-collection-search{
    width: 100%;
    height:50px;
    border:2px solid transparent;
    border-radius:var(--projc-radius-sm);
    padding:0 20px 0 52px;
    font-size:14px; font-weight: 500;
    font-family:inherit;
    color:var(--projc-ink-900);
    background:rgba(255,255,255,0.8);
    box-shadow:var(--projc-shadow-sm);
    outline:none;
    transition:all .2s var(--projc-cubic);
  }
  .project-collection-search::placeholder{color:var(--projc-ink-400);}
  .project-collection-search:focus{
    border-color:var(--projc-gold-300); background: var(--projc-white);
    box-shadow:0 8px 24px rgba(201,162,39,0.15);
  }
  
  .project-collection-searchbox svg {
    position: absolute; left: 18px; top: 15px; 
    width: 20px; height: 20px; color: var(--projc-ink-400); pointer-events: none;
    transition: color 0.2s ease;
  }
  .project-collection-searchbox:focus-within svg { color: var(--projc-gold-600); }

  .project-collection-select{
    height:50px;min-width:180px;
    border:2px solid transparent;
    border-radius:var(--projc-radius-sm);
    padding:0 20px;
    font-size:14px; font-weight: 600;
    font-family:inherit;
    color:var(--projc-ink-900);
    background:rgba(255,255,255,0.8);
    box-shadow:var(--projc-shadow-sm);
    outline:none;cursor:pointer;
    transition:all .2s var(--projc-cubic);
  }
  .project-collection-select:focus{
    border-color:var(--projc-gold-300); background: var(--projc-white);
  }

  .project-collection-btn{
    height:50px;padding:0 24px;
    border-radius:var(--projc-radius-sm);
    border:none;cursor:pointer;
    font-size:14px;font-weight:700;letter-spacing:0.02em;
    display:inline-flex;align-items:center;gap:10px;
    white-space:nowrap; text-decoration:none;
    transition:all .3s var(--projc-cubic);
  }
  
  .project-collection-btn-primary{
    background:linear-gradient(135deg,var(--projc-gold-500),var(--projc-gold-600));
    color:var(--projc-green-950);
    box-shadow:0 6px 16px rgba(184,146,61,0.25);
  }
  .project-collection-btn-primary:hover{
    box-shadow:0 10px 24px rgba(184,146,61,0.4);
    transform: translateY(-2px);
  }
  .project-collection-btn:active{transform:translateY(1px);}

  /* ---------- Connection error banner ---------- */
  .project-collection-alert{
    margin:20px 40px 0;
    padding:16px 20px;
    background:var(--projc-danger-bg);
    color:var(--projc-white);
    border-radius:var(--projc-radius-sm);
    font-size:15px;font-weight:700;
    display:none; align-items: center; gap: 10px;
  }
  .project-collection-alert.project-collection-alert-visible{display:flex; animation: fadeSlideUp 0.3s ease;}

  /* ---------- Premium Campaign Grid Cards ---------- */
  .project-collection-grid-layout{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 32px;
    padding: 30px 40px 50px;
    flex: 1;
  }
  
  .project-collection-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid rgba(230, 224, 208, 0.5);
    overflow: hidden;
    display: flex; flex-direction: column;
    box-shadow: 0 8px 24px rgba(11,46,36,0.04);
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    opacity: 0;
    transform: translateY(30px);
    animation: fadeSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }
  .project-collection-card::before {
    content: ''; position: absolute; inset: 0; z-index: -1;
    background: linear-gradient(135deg, var(--projc-gold-300), var(--projc-green-700));
    filter: blur(24px); opacity: 0; transition: opacity 0.6s ease;
    border-radius: 22px; pointer-events: none;
    transform: translateY(10px) scale(0.95);
  }
  .project-collection-card:hover {
    transform: translateY(-8px) scale(1.015);
    border-color: rgba(200, 180, 140, 0.8);
    box-shadow: 0 24px 60px rgba(11,46,36,0.12);
    z-index: 10;
  }
  .project-collection-card:hover::before { opacity: 0.2; }
  
  .project-collection-card-img-wrap {
      width: 100%; height: 210px;
      position: relative; flex-shrink: 0;
      background: linear-gradient(135deg, var(--projc-green-800), var(--projc-green-950));
      overflow: hidden;
  }
  .project-collection-card-img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .project-collection-card:hover .project-collection-card-img { transform: scale(1.08); }
  
  .project-collection-card-img-wrap::after {
      content: ''; position: absolute; bottom: 0; left: 0; width: 100%; height: 80px;
      background: linear-gradient(to top, rgba(11,46,36,0.5), transparent);
      pointer-events: none;
  }
  
  .project-collection-card-fallback {
      width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
      background: linear-gradient(135deg, var(--projc-cream-100), var(--projc-border));
      color: var(--projc-ink-400); opacity: 0.8;
  }
  
  /* Image Actions (Hover Overlay) */
  .project-collection-img-actions {
      position: absolute; top: 16px; right: 16px; z-index: 2;
      display: flex; flex-direction: column; gap: 8px;
      opacity: 0; transform: translateX(10px);
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .project-collection-card:hover .project-collection-img-actions {
      opacity: 1; transform: translateX(0);
  }
  .project-collection-img-btn {
      width: 38px; height: 38px; border-radius: 50%;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(8px);
      color: var(--projc-green-800); border: 1px solid rgba(255, 255, 255, 0.5); cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 12px rgba(11,46,36,0.15);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .project-collection-img-btn:hover { background: var(--projc-white); transform: scale(1.1); box-shadow: 0 8px 20px rgba(11,46,36,0.2); }
  .project-collection-img-btn:active { transform: scale(0.95); }
  
  .project-collection-img-btn-delete { color: var(--projc-danger); }
  .project-collection-img-btn-delete:hover { background: rgba(192, 57, 43, 0.1); color: var(--projc-danger); }
  
  .project-collection-img-btn-toggle.hidden-state { background: rgba(30, 43, 38, 0.85); color: var(--projc-white); border-color: rgba(30, 43, 38, 0.5); }
  .project-collection-img-btn-toggle.hidden-state:hover { background: var(--projc-ink-900); }
  
  /* Card Body */
  .project-collection-card-body {
      padding: 26px 30px; display: flex; flex-direction: column; flex: 1; gap: 20px;
  }
  
  .project-collection-info { width: 100%; display: flex; flex-direction: column; gap: 8px;}
  
  .project-collection-type-tag{
    display:inline-block; align-self: flex-start;
    font-size:11.5px;font-weight:700;letter-spacing:0.04em; text-transform: uppercase;
    padding:6px 12px;border-radius:8px;
    background: rgba(27, 75, 65, 0.08); 
    color:var(--projc-green-800);
  }
  
  .project-collection-name{
      font-weight:800; color:var(--projc-green-950); font-size: 20px;
      margin-bottom: 0; line-height: 1.35; letter-spacing: -0.01em;
      transition: color 0.3s ease;
  }
  .project-collection-card:hover .project-collection-name { color: var(--projc-gold-600); }
  
  .project-collection-metrics {
      display: flex; flex-direction: column; align-items: flex-start; justify-content: center;
      width: 100%; padding-bottom: 20px; border-bottom: 1px dashed rgba(230,224,208,0.8);
      margin-top: auto;
  }
  
  .project-collection-amount{
    font-variant-numeric:tabular-nums;
    color:var(--projc-green-950);font-weight:800; font-size: 26px; letter-spacing:-0.03em;
  }
  .project-collection-amount::before { content: 'LKR '; font-size: 14px; color: var(--projc-gold-600); font-weight: 700; margin-right:6px;}
  
  .project-collection-action-cell{display:flex; justify-content:space-between; align-items:center; gap: 12px; width: 100%;}
  
  .project-collection-view{
    height: 44px; padding:0 20px; flex: 1;
    border-radius: 12px; border:2px solid transparent; background:var(--projc-cream-100);
    color:var(--projc-green-800); font-size:13.5px;font-weight:700; cursor:pointer;
    transition:all .3s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .project-collection-view:hover{background:var(--projc-green-800);color:var(--projc-white); box-shadow: 0 6px 16px rgba(18, 56, 50, 0.25); transform: translateY(-2px);}
  .project-collection-view:active { transform: scale(0.97) translateY(0); }
  
  .project-collection-btn-accent { background:var(--projc-gold-500); color:var(--projc-green-950); box-shadow: 0 4px 12px rgba(184, 146, 61, 0.2); }
  .project-collection-btn-accent:hover { background:var(--projc-gold-600); color:var(--projc-white); box-shadow: 0 8px 24px rgba(184, 146, 61, 0.35); }

  .project-collection-empty{
    grid-column: 1 / -1;
    padding:80px 30px;text-align:center;color:var(--projc-ink-400);font-size:15px; width: 100%;
  }

  /* ---------- Footer / pagination ---------- */
  .project-collection-panel-footer{
    display:flex;align-items:center;justify-content:flex-end;
    padding:20px 40px; background: rgba(250, 247, 240, 0.4);
    border-top: 1px solid var(--projc-cream-100);
  }
  .project-collection-panel-footer select{
    height:40px;min-width:130px;
    border:1px solid var(--projc-border);
    border-radius:var(--projc-radius-sm);
    padding:0 16px;
    font-size:13.5px;font-family:inherit; font-weight: 600;
    color:var(--projc-ink-900);
    background:var(--projc-white);
    outline:none;cursor:pointer; box-shadow: var(--projc-shadow-sm);
  }

  @media (max-width:900px){
    .project-collection-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .project-collection-main { padding: 20px 24px; }
    .project-collection-panel-header, .project-collection-toolbar, .project-collection-panel-footer { padding-left: 24px; padding-right: 24px; }
    .project-collection-grid-layout { padding: 24px; grid-template-columns: 1fr; gap: 24px; }
    .project-collection-toolbar{align-items:stretch;}
    .project-collection-searchbox{min-width:0;width:100%;}
  }

  /* Compact, task-focused collection list */
  .project-collection-main{padding:24px 32px 40px;}
  .project-collection-breadcrumb{margin-bottom:18px;}
  .project-collection-panel{border-radius:16px;min-height:calc(100vh - 150px);}
  .project-collection-panel-header{padding:22px 30px;}
  .project-collection-panel-header::before{display:none;}
  .project-collection-panel-title{font-size:21px;}
  .project-collection-toolbar{display:grid;grid-template-columns:minmax(260px,1fr) 170px 180px auto;align-items:end;gap:12px;padding:20px 30px;}
  .project-collection-searchbox{min-width:0;}
  .project-collection-search,.project-collection-select,.project-collection-btn{height:44px;border-radius:8px;}
  .project-collection-search,.project-collection-select{border:1px solid var(--projc-border);background:var(--projc-white);box-shadow:none;}
  .project-collection-searchbox svg{top:12px;}
  .project-collection-field{display:flex;flex-direction:column;gap:6px;}
  .project-collection-field label{font-size:11px;font-weight:700;color:var(--projc-ink-600);text-transform:uppercase;}
  .project-collection-select{width:100%;min-width:0;padding:0 12px;}
  .project-collection-btn{padding:0 20px;letter-spacing:0;background:var(--projc-gold-500);}
  .project-collection-grid-layout{grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;padding:24px 30px 32px;}
  .project-collection-card{border-radius:10px;border-color:var(--projc-border);box-shadow:0 4px 14px rgba(11,46,36,.05);transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease;}
  .project-collection-card::before{display:none;}
  .project-collection-card:hover{transform:translateY(-3px);border-color:rgba(184,146,61,.55);box-shadow:0 12px 28px rgba(11,46,36,.1);}
  .project-collection-card-img-wrap{height:172px;}
  .project-collection-card-img{transition:transform .35s ease;}
  .project-collection-img-actions{opacity:1;transform:none;}
  .project-collection-img-btn{width:36px;height:36px;border-radius:8px;}
  .project-collection-card-body{padding:18px 20px 20px;gap:14px;}
  .project-collection-name{font-size:18px;letter-spacing:0;}
  .project-collection-metrics{padding-bottom:14px;border-bottom:1px solid var(--projc-border);}
  .project-collection-amount{font-size:23px;letter-spacing:0;}
  .project-collection-view{height:40px;padding:0 16px;border-radius:8px;border:1px solid var(--projc-border);background:var(--projc-white);}
  .project-collection-panel-footer{justify-content:flex-start;gap:16px;}
  .project-collection-results{font-size:13px;color:var(--projc-ink-600);}

  @media (max-width:1100px){
    .project-collection-toolbar{grid-template-columns:1fr 1fr;}
    .project-collection-searchbox{grid-column:1 / -1;}
  }
  @media (max-width:600px){
    .project-collection-topbar{padding:0 16px;}
    .project-collection-topbar-actions{gap:8px;}
    .project-collection-main{padding:16px 12px 28px;}
    .project-collection-breadcrumb{display:none;}
    .project-collection-panel{min-height:calc(100vh - 96px);border-radius:12px;}
    .project-collection-panel-header{padding:18px 16px;}
    .project-collection-panel-title{font-size:18px;}
    .project-collection-toolbar{grid-template-columns:1fr;padding:16px;}
    .project-collection-searchbox{grid-column:auto;}
    .project-collection-btn{width:100%;justify-content:center;}
    .project-collection-grid-layout{padding:16px;gap:16px;}
    .project-collection-card-img-wrap{height:160px;}
    .project-collection-panel-footer{padding:16px;}
  }
</style>

<div data-page="project" id="Main_Dashboard_03_B">

<div class="project-collection-app">

   <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="project-collection-topbar">
    <div class="project-collection-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="project-collection-topbar-actions">
      <button class="project-collection-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="project-collection-main">
    <p class="project-collection-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / 
      <a href="javascript:void(0);" onclick="Main_Dashboard_03_A_OPEN()">Project Modules</a> / 
      <span>Collection Tracker</span>
    </p>

    <section class="project-collection-panel" aria-label="Collection project list">

      <div class="project-collection-panel-header">
        <div class="project-collection-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3.5" y="4" width="17" height="16" rx="2"/><path d="M8 2.5v3M16 2.5v3M3.5 9.5h17"/></svg>
          Collection Projects 
        </div>
        <a class="project-collection-panel-close" onclick="main_dashboard_00_OPEN()" title="Close Directory" aria-label="Close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </a>
      </div>

      <div class="project-collection-toolbar">
        <div class="project-collection-searchbox">
           <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
           <input type="text" class="project-collection-search" id="project-collection-search"
                  placeholder="Search collections..." oninput="projectCollectionFiltersChanged()">
        </div>
        <div class="project-collection-field">
          <label for="project-collection-visibility">Visibility</label>
          <select class="project-collection-select" id="project-collection-visibility" onchange="projectCollectionFiltersChanged()">
            <option value="all">All projects</option>
            <option value="public">Public</option>
            <option value="hidden">Hidden</option>
          </select>
        </div>
        <div class="project-collection-field">
          <label for="project-collection-sort">Sort by</label>
          <select class="project-collection-select" id="project-collection-sort" onchange="projectCollectionFiltersChanged()">
            <option value="name-asc">Name A-Z</option>
            <option value="name-desc">Name Z-A</option>
            <option value="amount-desc">Amount: highest</option>
            <option value="amount-asc">Amount: lowest</option>
          </select>
        </div>
        <a class="project-collection-btn project-collection-btn-primary" onclick="Main_Dashboard_03_C_OPEN()">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
          Add New Collection
        </a>
      </div>

      <div class="project-collection-alert" id="project-collection-alert">
         <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
         System Error: Cannot connect to metrics DB right now.
      </div>

      <div class="project-collection-grid-layout" id="project-collection-grid">
         <!-- Cards generated here via JS -->
      </div>
      
      <div class="project-collection-empty" id="project-collection-empty" style="display:none;">
          No collections matched your current search filters.
      </div>

      <div class="project-collection-panel-footer">
        <div class="project-collection-results" id="project-collection-results">0 projects</div>
      </div>

    </section>
  </main>

</div>

<?php include_once __DIR__ . '/JS/Main_Dashboard_03_B_JS.php'; ?>

</div>
