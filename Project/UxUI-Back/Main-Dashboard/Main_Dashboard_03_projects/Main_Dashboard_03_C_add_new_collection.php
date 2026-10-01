<?php 
    $pth = "../"; 
    $active_page = "Collection-new"; // Tells the sidebar to highlight this tab
    $page_title = "Create New Collection · bmjm Admin";
include '../UxUI-Back/Includes/header.php';
?>

<style>
  /* ===================================================================
     bmjm Admin — Form UI Redesign
     Bambalapitiya Jumma Mosque · Dashboard · Create New Collection
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
    --colln-danger:#B0453A;
    --colln-radius-sm:14px;
    --colln-radius-md:20px;
    --colln-radius-lg:32px;
    --colln-shadow-card: 0 16px 40px rgba(11,46,36,0.12);
    --colln-shadow-hover: 0 12px 40px rgba(11,46,36,0.08);
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

  .collection-new-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .collection-new-topbar{
    grid-area:topbar;
    background:rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index: 10;
  }
  .collection-new-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--colln-green-950);
  }
  .collection-new-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--colln-ink-400);}
  .collection-new-topbar-actions{display:flex;align-items:center;gap:18px;}
  .collection-new-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--colln-cream-100);color:var(--colln-green-800);
    border:none;cursor:pointer;transition:all .2s var(--colln-cubic);
  }
  .collection-new-icon-btn:hover{background:var(--colln-gold-300); transform:translateY(-2px);}
  .collection-new-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main Application Panel ---------- */
  .collection-new-main{
    grid-area:main;
    padding:30px 40px 60px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--colln-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .collection-new-breadcrumb{
    font-size:13px;color:var(--colln-ink-400);margin-bottom:24px;
    display: flex; gap: 8px; align-items: center;
  }
  .collection-new-breadcrumb a{ color:var(--colln-ink-400);text-decoration:none; transition: color 0.2s;}
  .collection-new-breadcrumb a:hover{color:var(--colln-green-700);}
  .collection-new-breadcrumb span{
    color:var(--colln-green-700);font-weight:600;
    background: rgba(27, 75, 65, 0.08); padding: 4px 10px; border-radius: 12px;
  }

  /* Form Container (Full Page Width) */
  .collection-new-wrapper {
    display: flex; align-items: stretch; justify-content: stretch; width: 100%;
  }

  .collection-new-panel{
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius:var(--colln-radius-lg);
    box-shadow:var(--colln-shadow-card);
    overflow:hidden; border:1px solid var(--colln-white);
    display: flex; flex-direction: column;
    min-height: calc(100vh - 180px);
    transition: transform 0.4s var(--colln-cubic);
  }

  .collection-new-panel-header{
    background:linear-gradient(135deg,var(--colln-green-800),var(--colln-green-950));
    color:var(--colln-white);
    padding:36px 48px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative; overflow: hidden;
  }
  
  .collection-new-panel-header::before {
    content: ''; position: absolute; right: 0; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--colln-gold-500); filter: blur(40px); opacity: 0.2;
    pointer-events: none;
  }
  
  .collection-new-panel-title{
    display:flex;align-items:center;gap:16px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:26px;font-weight:700;
    position: relative; z-index: 2;
  }
  .collection-new-panel-title svg{width:24px;height:24px;flex:0 0 24px;color:var(--colln-gold-300);}
  
  .collection-new-panel-close{
    width:42px;height:42px;border-radius:50%;flex:0 0 42px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--colln-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--colln-cubic);
  }
  .collection-new-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* Form Elements Wrapper */
  .collection-new-form{padding:48px 48px 54px;}

  /* Section Headings */
  .collection-new-section-heading{
    display: flex; align-items: center; gap: 14px;
    font-size:14px;font-weight:800;letter-spacing:0.08em;
    color:var(--colln-green-800); text-transform: uppercase;
    margin:40px 0 24px;
  }
  .collection-new-section-heading::after {
    content: ''; flex: 1; height: 1px; background: var(--colln-border);
  }
  .collection-new-section-heading:first-child { margin-top: 0; }

  /* Input Fields */
  .collection-new-field{ display:flex;flex-direction:column;gap:10px;margin-bottom:28px; }
  .collection-new-field:last-child { margin-bottom: 0; }
  .collection-new-field label{ font-size:14.5px;font-weight:700; color:var(--colln-ink-900); }
  .collection-new-required{color:var(--colln-danger);margin-left:4px;font-weight:800; font-size: 16px;}
  
  .collection-new-field input[type="text"],
  .collection-new-field input[type="number"],
  .collection-new-field input[type="date"],
  .collection-new-field input[type="time"],
  .collection-new-select,
  .collection-new-field textarea{
    width: 100%;
    border:2px solid var(--colln-border);
    border-radius:var(--colln-radius-sm);
    padding:16px 20px; font-size:15px; font-weight: 500; font-family:inherit;
    color:var(--colln-ink-900); background:var(--colln-white);
    outline:none; transition:all .2s var(--colln-cubic);
  }
  .collection-new-field input[type="text"],
  .collection-new-field input[type="date"],
  .collection-new-field input[type="time"],
  .collection-new-select,
  .collection-new-field input[type="number"] { height:56px; }
  .collection-new-field textarea{ min-height:140px; resize:vertical; padding-top: 18px; }
  
  .collection-new-select { appearance: none; background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%238B978F" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>') no-repeat right 16px center / 16px; cursor: pointer;}
  .collection-new-field input::placeholder, .collection-new-field textarea::placeholder {color:var(--colln-ink-400);}
  
  .collection-new-field input:focus, .collection-new-field textarea:focus, .collection-new-select:focus {
    border-color:var(--colln-green-700); box-shadow:0 8px 24px rgba(27, 75, 65, 0.08); transform: translateY(-2px);
  }
  .collection-new-field.collection-new-invalid input, .collection-new-field.collection-new-invalid textarea{border-color:var(--colln-danger);}
  
  .collection-new-error{ font-size:12.5px;color:var(--colln-danger); font-weight: 600; margin-top:4px;display:none; }
  .collection-new-field.collection-new-invalid .collection-new-error{display:block; animation: fadeSlideUp 0.3s ease;}

  .colln-row { display: flex; gap: 20px; }
  .colln-row .collection-new-field { flex: 1; margin-bottom: 0; }

  /* Modern Toggles */
  .colln-toggle-card {
      display: flex; align-items: center; justify-content: space-between;
      background: var(--colln-cream-50); padding: 20px 24px;
      border-radius: var(--colln-radius-sm); border: 2px solid transparent;
      margin-bottom: 16px; transition: all 0.2s ease; cursor: pointer;
  }
  .colln-toggle-card:hover { border-color: var(--colln-border); background: var(--colln-white); }
  .colln-toggle-info { display: flex; flex-direction: column; gap: 6px; }
  .colln-toggle-title { font-weight: 700; color: var(--colln-green-950); font-size: 15px; }
  .colln-toggle-desc { font-weight: 500; color: var(--colln-ink-600); font-size: 13.5px; }
  
  .colln-toggle-card input[type="checkbox"] {
      width: 24px; height: 24px; cursor: pointer; accent-color: var(--colln-green-700);
  }

  .colln-toggle-reveal {
      height: 0; overflow: hidden; opacity: 0; padding: 0 20px;
      transition: all 0.4s var(--colln-cubic);
      background: rgba(27, 75, 65, 0.03); border-left: 3px solid var(--colln-gold-500); margin: -8px 0 20px 0; border-radius: 0 0 12px 12px;
  }
  .colln-toggle-reveal-active { height: auto; opacity: 1; padding: 24px 24px; margin: 0 0 24px 0; }

  /* Pills for check/radio */
  .colln-pill-group { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; }
  .colln-pill {
      background: var(--colln-white); border: 2px solid var(--colln-border);
      padding: 14px 22px; border-radius: 12px; display: inline-flex; align-items: center; gap: 10px;
      font-weight: 700; font-size: 14px; color: var(--colln-ink-600); cursor: pointer; transition: all 0.2s;
  }
  .colln-pill input { width: 18px; height: 18px; accent-color: var(--colln-green-700); cursor: pointer;}
  .colln-pill:hover, .colln-pill:has(input:checked) {
      border-color: var(--colln-gold-500); color: var(--colln-green-950);
      background: rgba(201, 162, 39, 0.05); box-shadow: 0 4px 12px rgba(201,162,39,0.1);
  }

  /* File Uploader */
  .collection-new-cover{
    width:100%; min-height: 260px;
    background:var(--colln-cream-50);
    border-radius:var(--colln-radius-sm); border: 2px dashed var(--colln-ink-400);
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    gap:16px; overflow:hidden; position:relative;
    margin-bottom:20px; transition: all 0.3s var(--colln-cubic);
  }
  .collection-new-cover:hover { border-color: var(--colln-gold-500); background: var(--colln-white); }
  .collection-new-cover.collection-new-cover-loaded { border-style: solid; background: transparent; padding: 0; }
  
  .collection-new-cover img{width:100%;max-height:600px;object-fit:contain;display:none; z-index: 2;}
  
  .collection-new-cover-text{color:var(--colln-ink-600);font-size:15px;font-weight:600;}
  .collection-new-cover-mark{ width:48px;height:48px;opacity:0.6; color: var(--colln-green-800); }

  .collection-new-view-btn {
      position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
      background: rgba(11, 46, 36, 0.85); color: #fff; padding: 14px 28px; border-radius: 30px;
      font-weight: 700; cursor: pointer; display: none; z-index: 10;
      border: none; backdrop-filter: blur(8px); transition: all 0.2s; opacity: 0;
  }
  .collection-new-cover.collection-new-cover-loaded:hover .collection-new-view-btn {
      display: flex; opacity: 1; align-items: center; gap: 10px;
  }
  .collection-new-view-btn:hover { background: rgba(201, 162, 39, 0.95); color: #000; box-shadow: 0 4px 16px rgba(0,0,0,0.3); transform: translate(-50%, -55%);}

  .collection-new-cover-actions{ display:flex;gap:16px; }
  .collection-new-cover-btn{
    flex:1;height:56px; border-radius:var(--colln-radius-sm); border:2px solid transparent;
    background:var(--colln-cream-100); color:var(--colln-green-800);
    font-size:14.5px;font-weight:700;letter-spacing:0.02em;
    cursor:pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
    transition:all .3s var(--colln-cubic);
  }
  .collection-new-cover-btn:hover{
      background:var(--colln-green-800);color:var(--colln-white);
      box-shadow: 0 4px 12px rgba(18, 56, 50, 0.2); transform: translateY(-2px);
  }

  .collection-new-divider{height:1.5px;background:var(--colln-border);margin:48px 0;}

  /* Submit Action Card */
  .collection-new-actions{display:flex;align-items:center;justify-content:flex-end;gap:16px;}
  .collection-new-btn-ghost{
    height: 56px; padding: 0 32px;
    border-radius:var(--colln-radius-sm);
    text-decoration:none; display:inline-flex;align-items:center;gap:10px;
    font-size:15px;font-weight:700;letter-spacing:0.02em; cursor:pointer;
    transition:all .3s var(--colln-cubic);
    background: rgba(139, 151, 143, 0.1); color:var(--colln-ink-900); border: 2px solid transparent;
  }
  .collection-new-btn-ghost:hover{
    background:var(--colln-white); border-color: var(--colln-border); box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  .collection-new-btn-primary{
    height: 56px; padding: 0 40px;
    border-radius: var(--colln-radius-sm); border: none; cursor: pointer;
    font-size:16px;font-weight:800;letter-spacing:0.02em;
    background: linear-gradient(135deg, var(--colln-gold-500), var(--colln-gold-600)); color: var(--colln-green-950);
    display:flex;align-items:center;justify-content:center; gap: 10px; transition:all .3s var(--colln-cubic);
    box-shadow:0 6px 16px rgba(184,146,61,0.25);
  }
  .collection-new-btn-primary:hover{ box-shadow:0 10px 24px rgba(184,146,61,0.4); transform: translateY(-2px); }

  /* Toasts & Modals */
  .collection-new-toast{
    position:fixed;top:20px;right:20px;
    background:var(--colln-green-950);color:var(--colln-cream-50);
    border-left:4px solid var(--colln-gold-500); padding:16px 20px;border-radius:var(--colln-radius-sm);
    font-size:14px;font-weight:600;box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    display:none;z-index:20; align-items: center; gap: 10px;
  }
  .collection-new-toast svg { color: var(--colln-gold-300); }

  .collection-new-modal {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
      background: rgba(0,0,0,0.85); z-index: 9999;
      display: none; align-items: center; justify-content: center; backdrop-filter: blur(8px);
  }
  .collection-new-modal-content { max-width: 90vw; max-height: 90vh; border-radius: 8px; box-shadow: 0 20px 50px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); }
  .collection-new-modal-close {
      position: absolute; top: 30px; right: 40px; color: #fff; font-size: 40px; 
      cursor: pointer; background: transparent; border: none; font-weight: 200; transition: color 0.2s;
  }
  .collection-new-modal-close:hover { color: var(--colln-gold-500); }

  @media (max-width:900px){
    .collection-new-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .collection-new-main { padding: 20px 24px; display: block; }
    .collection-new-panel-header { padding: 30px; }
    .collection-new-form { padding: 30px; }
    .colln-row { flex-direction: column; gap: 24px;}
    .collection-new-cover-actions{flex-direction:column;}
    .collection-new-actions { flex-direction: column-reverse; }
    .collection-new-btn-ghost, .collection-new-btn-primary { width: 100%; justify-content: center; }
  }
</style>

<div data-page="project" id="Main_Dashboard_03_C">

<div class="collection-new-app">
   <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <header class="collection-new-topbar">
    <div class="collection-new-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="collection-new-topbar-actions">
      <button class="collection-new-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      <button class="collection-new-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg></button>
      <button class="collection-new-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg></button>
    </div>
  </header>

  <main class="collection-new-main">
    <p class="collection-new-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> /
      <a href="javascript:void(0);" onclick="Main_Dashboard_03_B_OPEN()">Collection Hub</a> / <span>Event Designer</span>
    </p>

    <div class="collection-new-wrapper">
        <section class="collection-new-panel" aria-label="Create new collection">
    
          <!-- Header -->
          <div class="collection-new-panel-header">
            <div class="collection-new-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              Add New Collection.
            </div>
            <a class="collection-new-panel-close" onclick="Main_Dashboard_03_B_OPEN()" title="Cancel">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </a>
          </div>
    
          <!-- Form Component -->
          <form class="collection-new-form" id="collection-new-form" novalidate>
              
            <div class="collection-new-section-heading">Campaign Context</div>
            
            <div class="collection-new-field" id="collection-new-field-name">
              <label for="collection-new-name">Collection Title<span class="collection-new-required">*</span></label>
              <input type="text" id="collection-new-name" name="name" placeholder="E.g. Community Welfare Pool 2026" required>
              <span class="collection-new-error">Error: A title is legally required.</span>
            </div>
    
            <div class="collection-new-field" id="collection-new-field-description">
              <label for="collection-new-description">Collection Guidelines / Brief<span class="collection-new-required">*</span></label>
              <textarea id="collection-new-description" name="description" placeholder="Document the objectives, usage of funds, and logistical guidelines..." required></textarea>
              <span class="collection-new-error">Error: Please provide a description for donors.</span>
            </div>
            
            <div class="collection-new-section-heading">Visual Banner Media</div>
            
            <div class="collection-new-cover" id="collection-new-cover">
              <img id="collection-new-cover-img" alt="Preview">
              <svg class="collection-new-cover-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              <div class="collection-new-cover-text">Drag & Drop Image Here</div>
              
              <button type="button" class="collection-new-view-btn" onclick="collectionNewOpenModal()">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 3 21 3 21 9"/><polyline points="9 21 3 21 3 15"/><line x1="21" y1="3" x2="14" y2="10"/><line x1="3" y1="21" x2="10" y2="14"/></svg>
                  View Full Image
              </button>
            </div>
            
            <input type="file" id="collection-new-file" accept="image/*" style="display:none;" onchange="collectionNewPreview(this)">
            <input type="file" id="collection-new-scan" accept="image/*" capture="environment" style="display:none;" onchange="collectionNewPreview(this)">
            
            <div class="collection-new-cover-actions">
              <button type="button" class="collection-new-cover-btn" onclick="document.getElementById('collection-new-file').click()">Browse Device File</button>
              <button type="button" class="collection-new-cover-btn" onclick="document.getElementById('collection-new-scan').click()">Scan Document</button>
            </div>


            <div class="collection-new-section-heading">Operational Guardrails</div>

            <!-- Toggle 1 -->
            <label class="colln-toggle-card">
                <div class="colln-toggle-info">
                    <span class="colln-toggle-title">Enforce Budget Target</span>
                    <span class="colln-toggle-desc">Lock collection capacity to a strict maximum total.</span>
                </div>
                <input type="checkbox" id="collection-new-fixbudget" onchange="collectionNewToggleBudget()">
            </label>
            <div class="colln-toggle-reveal" id="collection-new-budget-wrap">
                <div class="collection-new-field" style="margin:0;">
                  <label>Maximum Target Amount (LKR)</label>
                  <input type="number" name="budget" min="0" step="1000" placeholder="Rs. 50,000.00">
                </div>
            </div>

            <!-- Toggle 2 -->
            <label class="colln-toggle-card">
                <div class="colln-toggle-info">
                    <span class="colln-toggle-title">Define Closing Schedule</span>
                    <span class="colln-toggle-desc">Automatically sever endpoints upon reaching date threshold.</span>
                </div>
                <input type="checkbox" id="collection-new-has-enddate" onchange="collectionNewToggleDate()">
            </label>
            <div class="colln-toggle-reveal" id="collection-new-date-wrap">
                <div class="colln-row">
                  <div class="collection-new-field">
                    <label>Terminal Date</label>
                    <input type="date" name="end_date">
                  </div>
                  <div class="collection-new-field">
                    <label>Terminal Time</label>
                    <input type="time" name="end_time">
                  </div>
                </div>
            </div>

            <!-- Toggle 3: Tickets -->
            <label class="colln-toggle-card">
                <div class="colln-toggle-info">
                    <span class="colln-toggle-title">Enable Ticket / Voucher Sales</span>
                    <span class="colln-toggle-desc">Generate distinct ticket tiers (e.g. 100 tickets of Rs. 500)</span>
                </div>
                <input type="checkbox" id="collection-new-has-tickets" onchange="collectionNewToggleTickets()">
            </label>
            <div class="colln-toggle-reveal" id="collection-new-tickets-wrap">
                <div class="colln-row" style="align-items: flex-end;">
                  <div class="collection-new-field">
                    <label>Denomination (LKR)</label>
                    <input type="number" id="colln-ticket-price" min="0" step="100" placeholder="Rs. 500.00">
                  </div>
                  <div class="collection-new-field">
                    <label>Quantity <span style="text-transform:none;color:var(--colln-ink-400);">(blank = unlimited)</span></label>
                    <input type="number" id="colln-ticket-qty" min="1" step="1" placeholder="Unlimited">
                  </div>
                  <div class="collection-new-field" style="flex: 0 0 auto;">
                    <button type="button" class="collection-new-btn-ghost" onclick="collectionNewAddTicket()" style="margin-bottom:0;">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Add Tier
                    </button>
                  </div>
                </div>
                
                <div id="colln-ticket-list" style="margin-top: 16px; display: flex; flex-direction: column; gap: 8px;">
                  <!-- Javascript injects tickets here -->
                </div>
                
                <input type="hidden" name="tickets_data" id="collection-tickets-data" value="[]">
            </div>

            <div class="collection-new-section-heading">Authorized Payment Channels</div>
            
            <div class="colln-pill-group">
                <label class="colln-pill"><input type="checkbox" name="payment" value="cash" checked> Vault / Cash</label>
                <label class="colln-pill"><input type="checkbox" name="payment" value="qr"> QR Mobile Pay</label>
                <label class="colln-pill"><input type="checkbox" id="collection-new-pay-bank" name="payment" value="bank" onchange="collectionNewToggleBank()"> Direct Bank Deposit</label>
            </div>
            
            <div class="colln-toggle-reveal" id="collection-new-bank-wrap" style="border-left-color: var(--colln-green-700); background:transparent; padding:0;">
                <div class="collection-new-field" style="margin:0;">
                  <label>Route to Dedicated Bank Account</label>
                  <select class="collection-new-select" name="bank_account">
                    <option value="">-- Unassigned System Default --</option>
                    <?php
                       // Securely load pre-computed option markup through the View-List MVC bridge layer
                       include __DIR__ . '/../../../View-List/Settings/bank_details/bank_account_details_OPTION_VIEW.php';
                    ?>
                  </select>
                </div>
            </div>


            <div class="collection-new-section-heading">Access / Visibility</div>
            
            <label class="colln-toggle-card" style="margin-bottom:0;">
                <div class="colln-toggle-info">
                    <span class="colln-toggle-title">Confidential / Members Only</span>
                    <span class="colln-toggle-desc">Hide this collection from public donor broadcast feeds.</span>
                </div>
                <input type="checkbox" name="visibility" value="members" checked>
            </label>


            <div class="collection-new-divider"></div>

            <div class="collection-new-actions">
              <a class="collection-new-btn-ghost" href="javascript:void(0);" onclick="Main_Dashboard_03_B_OPEN()">Cancel Event</a>
              <button type="submit" class="collection-new-btn-primary">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                  Initiate Collection Broadcast
              </button>
            </div>

          </form>
        </section>
    </div>
  </main>

</div>

<div class="collection-new-toast" id="collection-new-toast">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>  
    Collection payload transmitted successfully!
</div>

<div class="collection-new-modal" id="collection-new-image-modal" onclick="collectionNewCloseModal()">
    <button class="collection-new-modal-close">&times;</button>
    <img class="collection-new-modal-content" id="collection-new-modal-img" src="">
</div>

<?php include 'JS/Main_Dashboard_03_C_add_new_collection_JS.php'; ?>

</div>
