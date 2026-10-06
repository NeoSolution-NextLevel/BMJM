<?php 
    $pth = "../"; 
    $active_page = "project"; // Tells the sidebar to highlight this tab
    $page_title = "Select Project Type · bmjm Admin";
    if (!defined('BMJM_FEATURE_FLAGS_LOADED')) {
        include_once '../imports/feature_flags/feature_flags.php';
    }
    if (!$BMJM_FEATURE_COLLECTION) { return; } // Panel silently hidden when feature is disabled
include '../UxUI-Back/Includes/header.php'; 
?>


<style>
  /* ===================================================================
     bmjm Admin — Design tokens
     Bambalapitiya Jumma Masjid · Dashboard · Select Project Type (Redesign)
     =================================================================== */
  :root{
    --proj-green-950:#0B2E24;
    --proj-green-800:#123832;
    --proj-green-700:#1B4B41;
    --proj-gold-600:#B8923D;
    --proj-gold-500:#C9A227;
    --proj-gold-300:#E4C766;
    --proj-cream-50:#FAF7F0;
    --proj-cream-100:#F2EDE0;
    --proj-white:#FFFFFF;
    --proj-ink-900:#1E2B26;
    --proj-ink-600:#5A6A62;
    --proj-ink-400:#8B978F;
    --proj-border:#E6E0D0;
    --proj-radius-sm:14px;
    --proj-radius-lg:24px;
    --proj-shadow:0 16px 40px rgba(11,46,36,0.12);
    --proj-shadow-sm:0 4px 12px rgba(11,46,36,0.04);
    --proj-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--proj-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--proj-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .project-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .project-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .project-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--proj-green-950);
  }
  .project-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--proj-ink-400);}
  .project-topbar-actions{display:flex;align-items:center;gap:18px;}
  .project-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--proj-cream-100);color:var(--proj-green-800);
    border:none;cursor:pointer;transition:all .2s var(--proj-cubic);
  }
  .project-icon-btn:hover{
    background:var(--proj-gold-300);
    transform:translateY(-2px);
  }
  .project-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main Application Panel ---------- */
  .project-main{
    grid-area:main;
    padding:30px 40px 60px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--proj-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .project-breadcrumb{
    font-size:13px;color:var(--proj-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .project-breadcrumb a{
    color:var(--proj-ink-400);text-decoration:none; transition: color 0.2s;
  }
  .project-breadcrumb a:hover{color:var(--proj-green-700);}
  .project-breadcrumb span{
    color:var(--proj-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  .project-wrapper {
    flex: 1; display: flex; align-items: stretch; justify-content: stretch;
  }

  .project-panel{
    width:100%;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    border-radius:var(--proj-radius-lg);
    box-shadow:var(--proj-shadow);
    overflow:hidden;
    border:1px solid var(--proj-border);
    display: flex; flex-direction: column;
    min-height: calc(100vh - 180px);
    position: relative;
    transition: transform 0.4s var(--proj-cubic);
  }
  .project-panel:hover {
    transform: translateY(-4px);
  }

  .project-panel-header{
    background:linear-gradient(135deg,var(--proj-green-800),var(--proj-green-950));
    color:var(--proj-cream-50);
    padding:32px 40px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative;
    overflow: hidden;
  }
  
  /* Abstract Design Elements */
  .project-panel-header::before {
    content: ''; position: absolute; left: 0; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--proj-gold-500); filter: blur(40px); opacity: 0.15;
    pointer-events: none;
  }

  .project-panel-title{
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    position: relative; z-index: 2;
  }
  .project-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--proj-gold-300);}
  
  .project-panel-close{
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--proj-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--proj-cubic);
  }
  .project-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* ---------- Modern Selection Grid ---------- */
  .project-options{
    display:grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap:24px;
    padding:40px; flex: 1; align-content: center;
  }
  
  .project-option{
    display:flex;flex-direction:column;align-items:center; justify-content:center; gap: 20px;
    border-radius:var(--proj-radius-sm);
    border:2px solid transparent;cursor:pointer;
    background: rgba(250, 247, 240, 0.4);
    padding: 60px 40px;
    text-decoration:none; text-align: center;
    transition:all .3s var(--proj-cubic);
    position: relative; overflow: hidden;
  }
  
  .project-option::before {
    content: ''; position: absolute; left: 0; top: 0; right: 0; bottom: 0;
    background: linear-gradient(135deg, rgba(201, 162, 39, 0) 0%, rgba(201, 162, 39, 0.05) 100%);
    opacity: 0; transition: opacity 0.3s ease;
  }

  .project-option-icon {
    width: 80px; height: 80px; border-radius: 50%;
    background: var(--proj-white);
    box-shadow: 0 4px 12px rgba(11, 46, 36, 0.05);
    display: flex; align-items: center; justify-content: center;
    color: var(--proj-green-800);
    transition: transform 0.3s var(--proj-cubic);
  }
  .project-option-icon svg { width: 40px; height: 40px; }

  .project-option-title {
    font-size:20px;font-weight:700;letter-spacing:0.02em;
    color:var(--proj-green-950); z-index: 2; margin-bottom: 6px;
  }
  .project-option-desc {
    font-size: 15px; color: var(--proj-ink-600); z-index: 2; line-height: 1.5;
  }

  /* Option Hover Triggers */
  .project-option:hover{
    background:var(--proj-white);
    border-color: var(--proj-gold-300);
    box-shadow:0 8px 24px rgba(201,162,39,0.12);
    transform: translateY(-4px);
  }
  .project-option:hover::before { opacity: 1; }
  .project-option:hover .project-option-icon { 
    transform: scale(1.1); color: var(--proj-gold-600); 
  }
  .project-option:active{transform:translateY(1px); box-shadow:0 4px 12px rgba(201,162,39,0.1);}

  @media (max-width:900px){
    .project-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .project-main{padding:20px 24px;}
    .project-options { grid-template-columns: 1fr; padding: 24px; }
  }
</style>

<div data-page="project" id="Main_Dashboard_03_A">

<div class="project-app">

    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="project-topbar">
    <div class="project-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="project-topbar-actions">
      <button class="project-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="project-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="project-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="project-main">
    <p class="project-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / 
      <span>Project Modules</span>
    </p>

    <div class="project-wrapper">
      <section class="project-panel" aria-label="Select project type">
  
        <div class="project-panel-header">
          <div class="project-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><polyline points="10 9 9 9 8 9"/></svg>
            Select Project
          </div>
          <a class="project-panel-close" onclick="main_dashboard_00_OPEN()" title="Return" aria-label="Close">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </a>
        </div>   
  
        <div class="project-options">
          
          <!-- Option 1 -->
          <a class="project-option" onclick="Main_Dashboard_03_B_OPEN()">
            <div class="project-option-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
            </div>
            <div>
              <div class="project-option-title">Collection</div>
              <div class="project-option-desc">Manage standard revenue channels and project targets</div>
            </div>
          </a>
          
          <!-- Option 2 -->
          <a class="project-option" href="project-kuruba.php">
            <div class="project-option-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 2v20l2-2 2 2 2-2 2 2 2-2 2 2 2-2 2 2V2l-2 2-2-2-2 2-2-2-2 2-2-2-2 2Z"/><path d="M14 10h2"/><path d="M14 14h2"/><path d="M8 10h2"/><path d="M8 14h2"/></svg>
            </div>
            <div>
              <div class="project-option-title">Kurubana</div>
              <div class="project-option-desc">Overview and manage specialized distribution programs</div>
            </div>
          </a>
  
        </div>
  
      </section>
    </div>
  </main>

</div>

</div>
