<?php 
    $pth = "../"; 
    $active_page = "member-street-list"; // Tells the sidebar to highlight this tab
    $page_title = "Member Street List · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens & Full Page Redesign
     Bambalapitiya Jumma Masjid · Dashboard · Member Street List
     =================================================================== */
  :root{
    --m-street-green-950:#0B2E24;
    --m-street-green-800:#123832;
    --m-street-green-700:#1B4B41;
    --m-street-gold-600:#B8923D;
    --m-street-gold-500:#C9A227;
    --m-street-gold-300:#E4C766;
    --m-street-cream-50:#FAF7F0;
    --m-street-cream-100:#F2EDE0;
    --m-street-white:#FFFFFF;
    --m-street-ink-900:#1E2B26;
    --m-street-ink-600:#5A6A62;
    --m-street-ink-400:#8B978F;
    --m-street-border:#E6E0D0;
    --m-street-radius-sm:14px;
    --m-street-radius-lg:24px;
    --m-street-shadow:0 12px 32px rgba(11,46,36,0.06);
    --m-street-shadow-sm:0 4px 12px rgba(11,46,36,0.04);
    --m-street-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--m-street-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--m-street-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .member-street-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .member-street-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .member-street-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--m-street-green-950);
  }
  .member-street-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--m-street-ink-400);}
  .member-street-topbar-actions{display:flex;align-items:center;gap:18px;}
  .member-street-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--m-street-cream-100);color:var(--m-street-green-800);
    border:none;cursor:pointer;transition:all .2s var(--m-street-cubic);
  }
  .member-street-icon-btn:hover{
    background:var(--m-street-gold-300);
    transform:translateY(-2px);
  }
  .member-street-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main Application Panel ---------- */
  .member-street-main{
    grid-area:main;
    padding:30px 40px 60px;
    animation: fadeSlideUp 0.6s var(--m-street-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .member-street-breadcrumb{
    font-size:13px;color:var(--m-street-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .member-street-breadcrumb a{
    color:var(--m-street-ink-400);text-decoration:none; transition: color 0.2s;
  }
  .member-street-breadcrumb a:hover{color:var(--m-street-green-700);}
  .member-street-breadcrumb span{
    color:var(--m-street-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  /* Full Page Layout Adjustments */
  .member-street-panel{
    width: 100%; /* Spans exactly to margins */
    background:var(--m-street-white);
    border-radius:var(--m-street-radius-lg);
    box-shadow:var(--m-street-shadow);
    overflow:hidden;
    border:1px solid var(--m-street-border);
    display: flex;
    flex-direction: column;
    min-height: calc(100vh - 180px);
  }

  .member-street-panel-header{
    background:linear-gradient(135deg,var(--m-street-green-800),var(--m-street-green-950));
    color:var(--m-street-cream-50);
    padding:32px 40px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative;
    overflow: hidden;
  }
  
  /* Abstract Design Elements */
  .member-street-panel-header::before {
    content: ''; position: absolute; right: 20%; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--m-street-gold-500); filter: blur(40px); opacity: 0.15;
    pointer-events: none;
  }
  
  .member-street-panel-title{
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:26px;font-weight:700;
    position: relative; z-index: 2;
  }
  .member-street-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--m-street-gold-300);}
  .member-street-panel-close{
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--m-street-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--m-street-cubic);
  }
  .member-street-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* ---------- Search Toolbar ---------- */
  .member-street-toolbar{
    display:flex;align-items:center;gap:18px;flex-wrap:wrap;
    padding:30px 40px;
    background: rgba(250, 247, 240, 0.3);
    border-bottom: 1px solid var(--m-street-cream-100);
  }
  .member-street-search-wrap{
    position:relative;
    flex:1;min-width:300px;
    display:flex;align-items:center;
  }
  .member-street-search-icon{
    position:absolute;left:18px;
    width:20px;height:20px;
    color:var(--m-street-ink-400);
    pointer-events:none;
    transition: color 0.2s ease;
  }
  .member-street-search{
    width:100%;
    height:56px;
    border:2px solid transparent;
    border-radius:var(--m-street-radius-sm);
    padding:0 20px 0 52px;
    font-size:15px; font-weight: 500;
    font-family:inherit;
    color:var(--m-street-ink-900);
    background:rgba(255,255,255,0.8);
    box-shadow:var(--m-street-shadow-sm);
    outline:none;
    transition:all .2s var(--m-street-cubic);
  }
  .member-street-search::placeholder{color:var(--m-street-ink-400);}
  .member-street-search-wrap:focus-within .member-street-search-icon {
    color: var(--m-street-gold-600);
  }
  .member-street-search:focus{
    border-color:var(--m-street-gold-300);
    background: var(--m-street-white);
    box-shadow:0 8px 24px rgba(201,162,39,0.15);
    transform: translateY(-2px);
  }

  .member-street-btn{
    height:56px;padding:0 28px;
    border-radius:var(--m-street-radius-sm);
    border:none;cursor:pointer;
    font-size:14.5px;font-weight:700;letter-spacing:0.01em;
    display:inline-flex;align-items:center;gap:10px;
    white-space:nowrap;
    transition:all .3s var(--m-street-cubic);
  }
  .member-street-btn:active{transform:translateY(1px);}
  .member-street-btn-primary{
    background:linear-gradient(135deg,var(--m-street-gold-500),var(--m-street-gold-600));
    color:var(--m-street-green-950);
    box-shadow:0 6px 16px rgba(184,146,61,0.25);
  }
  .member-street-btn-primary:hover{
    box-shadow:0 10px 24px rgba(184,146,61,0.4);
    transform: translateY(-3px);
  }

  /* ---------- JS Injected Street list styling ---------- */
  /* This is injected by main-dashboard-01-f.js */
  .member-street-list{
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    padding:30px 40px 40px;
    gap:18px;
    background: var(--m-street-white);
  }
  .member-street-row{
    display:flex;align-items:center;justify-content:space-between;
    padding:20px 24px;
    background:var(--m-street-cream-50);
    border:1px solid var(--m-street-border);
    border-radius:var(--m-street-radius-sm);
    transition:all .3s var(--m-street-cubic);
    position: relative;
    overflow: hidden;
  }
  .member-street-row::before {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
    background: transparent; transition: background 0.3s ease;
  }
  
  .member-street-row:hover{
    border-color:var(--m-street-gold-300);
    background:var(--m-street-white);
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(11, 46, 36, 0.08);
  }
  .member-street-row:hover::before {
    background: var(--m-street-gold-500);
  }
  
  .member-street-name{
    font-size:15px;font-weight:700;color:var(--m-street-ink-900);
    display: flex; align-items: center; gap: 10px;
  }
  .member-street-name::before {
    content: '🗺️'; font-size: 16px; opacity: 0.8;
  }
  
  .member-street-select{
    height:38px;padding:0 22px;
    border-radius:20px;
    border:1px solid transparent;
    background: rgba(27, 75, 65, 0.08);
    color:var(--m-street-green-950);
    font-size:13px;font-weight:700;letter-spacing:0.02em;
    cursor:pointer;
    transition:all .2s var(--m-street-cubic);
  }
  .member-street-row:hover .member-street-select {
    background:var(--m-street-green-800);
    color:var(--m-street-cream-50);
    box-shadow: 0 4px 12px rgba(11, 46, 36, 0.2);
  }
  .member-street-select:active { transform: scale(0.95); }

  .member-street-empty{
    padding:80px 20px;text-align:center;
    color:var(--m-street-ink-400);font-size:15px;
    width: 100%;
    grid-column: 1 / -1;
  }
  .member-street-empty::before {
    content: '🔍'; display: block; font-size: 32px; margin-bottom: 12px; opacity: 0.5;
  }

  @media (max-width:900px){
    .member-street-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .member-street-main { padding: 20px 24px; }
    .member-street-panel-header { padding: 24px; }
    .member-street-toolbar{flex-direction:column;align-items:stretch; padding: 24px;}
    .member-street-list { padding: 24px; grid-template-columns: 1fr; }
    .member-street-btn{width:100%;justify-content:center;}
  }
</style>

<div data-page="member-list" id="Main_dashboard_01_F">

  <div class="member-street-app">

      <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="member-street-topbar">
      <div class="member-street-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div class="member-street-topbar-actions">
        <button class="member-street-icon-btn" title="Notifications" aria-label="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="member-street-icon-btn" title="Messages" aria-label="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button>
        <button class="member-street-icon-btn" title="Sign out" aria-label="Sign out">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
        </button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="member-street-main">
      <p class="member-street-breadcrumb">
        <a href="javascript:void(0);" onclick="main_dashboard_01_A_OPEN()">Dashboard</a> / 
        <a href="javascript:void(0);" onclick="main_dashboard_01_A_OPEN()">Member Directory</a> / 
        <a href="javascript:void(0);" onclick="main_dashboard_01_B_OPEN()">Registration</a> / 
        <span>Select Locality</span>
      </p>

      <section class="member-street-panel" aria-label="Member street list">

        <div class="member-street-panel-header">
          <div class="member-street-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            Select a Road
          </div>
          <a class="member-street-panel-close" onclick="main_dashboard_01_A_OPEN()" title="Close Directory" aria-label="Close">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </a>
        </div>

        <div class="member-street-toolbar">
          <div class="member-street-search-wrap">
            <svg class="member-street-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="7"/>
              <path d="m20 20-3.5-3.5"/>
            </svg>
            <input type="text" class="member-street-search" id="member-street-search"
                  placeholder="Type to filter registered streets..." oninput="memberStreetRender()" onkeyup="memberStreetRender()">
          </div>
          <button class="member-street-btn member-street-btn-primary" onclick="main_dashboard_01_E_OPEN()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
            Register New Area
          </button>
        </div>

        <div class="member-street-list" id="member-street-list">
          <!-- JS Rendered Content -->
        </div>
        <div class="member-street-empty" id="member-street-empty" style="display:none;">
          No registered streets match the given filter criterion.
        </div>

      </section>
    </main>

  </div>

</div>
