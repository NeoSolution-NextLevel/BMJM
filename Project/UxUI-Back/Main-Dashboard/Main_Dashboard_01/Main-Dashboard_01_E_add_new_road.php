<?php 
    $pth = "../"; 
    $active_page = "add-new-road"; // Tells the sidebar to highlight this tab
    $page_title = "Add New Road · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens & Full Page Redesign
     Bambalapitiya Jumma Mosque · Dashboard · Add New Road
     =================================================================== */
  :root{
    --e-road-green-950:#0B2E24;
    --e-road-green-800:#123832;
    --e-road-green-700:#1B4B41;
    --e-road-gold-600:#B8923D;
    --e-road-gold-500:#C9A227;
    --e-road-gold-300:#E4C766;
    --e-road-cream-50:#FAF7F0;
    --e-road-cream-100:#F2EDE0;
    --e-road-white:#FFFFFF;
    --e-road-ink-900:#1E2B26;
    --e-road-ink-600:#5A6A62;
    --e-road-ink-400:#8B978F;
    --e-road-border:#E6E0D0;
    --e-road-danger:#B0453A;
    --e-road-radius-sm:14px;
    --e-road-radius-lg:24px;
    --e-road-shadow:0 16px 40px rgba(11,46,36,0.12);
    --e-road-shadow-sm:0 4px 12px rgba(11,46,36,0.04);
    --e-road-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--e-road-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--e-road-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .add-road-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .add-road-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .add-road-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--e-road-green-950);
  }
  .add-road-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--e-road-ink-400);}
  .add-road-topbar-actions{display:flex;align-items:center;gap:18px;}
  .add-road-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--e-road-cream-100);color:var(--e-road-green-800);
    border:none;cursor:pointer;transition:all .2s var(--e-road-cubic);
  }
  .add-road-icon-btn:hover{
    background:var(--e-road-gold-300);
    transform:translateY(-2px);
  }
  .add-road-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main Application Panel ---------- */
  .add-road-main{
    grid-area:main;
    padding:30px 40px 60px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--e-road-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .add-road-breadcrumb{
    font-size:13px;color:var(--e-road-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .add-road-breadcrumb a{
    color:var(--e-road-ink-400);text-decoration:none; transition: color 0.2s;
  }
  .add-road-breadcrumb a:hover{color:var(--e-road-green-700);}
  .add-road-breadcrumb span{
    color:var(--e-road-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }
  
  .add-road-wrapper {
    flex: 1; display: flex; align-items: center; justify-content: center;
  }

  /* Form Container */
  .add-road-panel{
    width: 100%; max-width: 600px;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(20px);
    border-radius:var(--e-road-radius-lg);
    box-shadow:var(--e-road-shadow);
    overflow:hidden;
    border:1px solid var(--e-road-white);
    display: flex; flex-direction: column;
    position: relative;
    transition: transform 0.4s var(--e-road-cubic);
  }
  .add-road-panel:hover {
    transform: translateY(-4px);
  }

  .add-road-panel-header{
    background:linear-gradient(135deg,var(--e-road-green-800),var(--e-road-green-950));
    color:var(--e-road-cream-50);
    padding:32px 40px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative;
    overflow: hidden;
  }
  
  /* Abstract Design Elements */
  .add-road-panel-header::before {
    content: ''; position: absolute; right: 0; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--e-road-gold-500); filter: blur(40px); opacity: 0.2;
    pointer-events: none;
  }
  
  .add-road-panel-title{
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    position: relative; z-index: 2;
  }
  .add-road-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--e-road-gold-300);}
  
  .add-road-panel-close{
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--e-road-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--e-road-cubic);
  }
  .add-road-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* ---------- Form Styling ---------- */
  .add-road-form{padding:40px;}
  
  .add-road-field{
    display:flex;flex-direction:column;gap:10px;margin-bottom:28px;
  }
  .add-road-field label{
    font-size:14.5px;font-weight:700;
    color:var(--e-road-green-950);
  }
  
  .add-road-input-wrap {
      position: relative; display: flex; align-items: center;
  }
  .add-road-input-wrap svg {
      position: absolute; left: 16px; color: var(--e-road-ink-400); transition: color 0.2s;
  }
  
  .add-road-field input {
    width: 100%;
    height:56px;
    border:2px solid var(--e-road-border);
    border-radius:var(--e-road-radius-sm);
    padding:0 20px 0 46px;
    font-size:15px; font-weight: 500;
    font-family:inherit;
    color:var(--e-road-ink-900);
    background:var(--e-road-white);
    outline:none;
    transition:all .2s var(--e-road-cubic);
  }
  .add-road-field input::placeholder {color:var(--e-road-ink-400);}
  .add-road-input-wrap:focus-within svg { color: var(--e-road-gold-600); }
  .add-road-field input:focus {
    border-color:var(--e-road-gold-300);
    box-shadow:0 8px 24px rgba(201,162,39,0.15);
    transform: translateY(-2px);
  }
  
  .add-road-field.add-road-invalid input{border-color:var(--e-road-danger);}
  .add-road-error{
    font-size:12.5px;color:var(--e-road-danger); font-weight: 600;
    margin-top:4px;display:none; 
  }
  .add-road-field.add-road-invalid .add-road-error{display:block; animation: fadeSlideUp 0.3s ease;}

  .add-road-actions{
    display:flex;align-items:center;justify-content: flex-end; gap:16px;
    margin-top:10px; border-top: 1px dashed var(--e-road-border); padding-top: 24px;
  }
  
  .add-road-btn{
    height:50px;padding:0 28px;
    border-radius:var(--e-road-radius-sm);
    border:none;cursor:pointer;
    font-size:14px;font-weight:700;letter-spacing:0.02em;
    display:inline-flex;align-items:center;gap:10px;
    text-decoration:none;
    transition:all .3s var(--e-road-cubic);
  }
  .add-road-btn:active{transform:translateY(1px);}
  
  .add-road-btn-ghost{
    background: rgba(139, 151, 143, 0.1);
    color:var(--e-road-ink-900); border: 2px solid transparent;
  }
  .add-road-btn-ghost:hover{
    background:var(--e-road-white); border-color: var(--e-road-border);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  
  .add-road-btn-primary{
    background:linear-gradient(135deg,var(--e-road-gold-500),var(--e-road-gold-600));
    color:var(--e-road-green-950);
    box-shadow:0 6px 16px rgba(184,146,61,0.25);
  }
  .add-road-btn-primary:hover{
    box-shadow:0 10px 24px rgba(184,146,61,0.4);
    transform: translateY(-2px);
  }
  .add-road-btn-primary:disabled{opacity:0.6;cursor:not-allowed;box-shadow:none; transform: none;}

  .add-road-toast{
    position:fixed;top:20px;right:20px;
    background:var(--e-road-green-950);color:var(--e-road-cream-50);
    border-left:4px solid var(--e-road-gold-500);
    padding:16px 20px;border-radius:var(--e-road-radius-sm);
    font-size:14px;font-weight:600;box-shadow:var(--e-road-shadow);
    display:none;z-index:20;
    align-items: center; gap: 10px;
  }
  .add-road-toast svg { color: var(--e-road-gold-300); }

  @media (max-width:900px){
    .add-road-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .add-road-main { padding: 20px 24px; display: block; }
    .add-road-panel { margin-top: 20px; }
    .add-road-actions { flex-direction: column-reverse; }
    .add-road-btn { width: 100%; justify-content: center; }
  }
</style>

<div data-page="add-new-road" id="Main_dashboard_01_E">

  <div class="add-road-app">

    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="add-road-topbar">
      <div class="add-road-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div class="add-road-topbar-actions">
        <button class="add-road-icon-btn" title="Notifications" aria-label="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="add-road-icon-btn" title="Messages" aria-label="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button>
        <button class="add-road-icon-btn" title="Sign out" aria-label="Sign out">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
        </button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="add-road-main">
      <p class="add-road-breadcrumb">
        <a href="javascript:void(0);" onclick="main_dashboard_01_A_OPEN()">Dashboard</a> /
        <a href="javascript:void(0);" onclick="main_dashboard_01_A_OPEN()">Member Directory</a> /
        <a href="javascript:void(0);" onclick="main_dashboard_01_F_OPEN()">Locality Settings</a> /
        <span>Register New Area</span>
      </p>

      <div class="add-road-wrapper">
          <section class="add-road-panel" aria-label="Add New Road">
    
            <div class="add-road-panel-header">
              <div class="add-road-panel-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M4 20V6.5A2.5 2.5 0 0 1 6.5 4H15l5 5v11a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Z"/>
                  <path d="M14 4v4.5a.5.5 0 0 0 .5.5H19"/>
                  <path d="M12 11v6M9 14h6"/>
                </svg>
                Register New Road
              </div>
              <a class="add-road-panel-close" onclick="main_dashboard_01_F_OPEN()" title="Return" aria-label="Close">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </a>
            </div>
    
            <form class="add-road-form" id="add-road-form" onsubmit="Main_Dashboard_01_E_SUMBIT(event)" novalidate>
              <div class="add-road-field" id="add-road-field-name">
                <label for="Main_Dashboard_01_E_road">Locality / Street Name</label>
                <div class="add-road-input-wrap">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <input type="text" id="Main_Dashboard_01_E_road" name="val_01" placeholder="Enter road or street name (e.g. Mosque Lane)" required>
                </div>
                <span class="add-road-error" id="add-road-error-msg">Please enter a valid, non-empty locality name.</span>
              </div>
    
              <div class="add-road-actions">
                <button type="button" class="add-road-btn add-road-btn-ghost" onclick="main_dashboard_01_F_OPEN()">Cancel Action</button>
                <button type="submit" class="add-road-btn add-road-btn-primary" id="add-road-submit">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  Create Record
                </button>
              </div>
            </form>
    
          </section>
      </div>
    </main>

  </div>

  <div class="add-road-toast" id="add-road-toast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>  
    New locality registered successfully!
  </div>

</div>
