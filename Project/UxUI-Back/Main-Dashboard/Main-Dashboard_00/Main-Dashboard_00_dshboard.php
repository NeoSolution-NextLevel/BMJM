<style>
  /* ===================================================================
     bmjm Dashboard — Advanced Overview (Main-Dashboard_00)
     Premium modern bento grid aesthetics with smooth animations
     =================================================================== */
  :root {
    --dash00-green-950: #0B2E24;
    --dash00-green-800: #123832;
    --dash00-green-700: #1B4B41;
    --dash00-gold-600: #B8923D;
    --dash00-gold-500: #C9A227;
    --dash00-gold-300: #E4C766;
    --dash00-cream-50: #FAF7F0;
    --dash00-cream-100: #F2EDE0;
    --dash00-white: #FFFFFF;
    --dash00-ink-900: #1E2B26;
    --dash00-ink-600: #5A6A62;
    --dash00-ink-400: #8B978F;
    --dash00-border: #E6E0D0;
    --dash00-radius-sm: 14px;
    --dash00-radius-lg: 24px;
    --dash00-shadow-card: 0 8px 30px rgba(11, 46, 36, 0.05);
    --dash00-shadow-hover: 0 16px 40px rgba(11, 46, 36, 0.12);
    
    /* Animation Timing */
    --dash00-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .dash00-app {
    display: grid;
    grid-template-columns: 248px 1fr;
    grid-template-rows: 64px 1fr;
    min-height: 100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
    background: var(--dash00-cream-50);
  }

  /* ---------- Topbar ---------- */
  .dash00-topbar {
    grid-area: topbar;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(230, 224, 208, 0.5);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
    z-index: 10;
  }
  .dash00-topbar-heading h1 {
    font-family: 'Poppins', Inter, sans-serif;
    font-size: 19px;
    font-weight: 600;
    margin: 0;
    color: var(--dash00-green-950);
  }
  .dash00-topbar-heading p {
    margin: 1px 0 0;
    font-size: 11.5px;
    color: var(--dash00-ink-400);
  }
  .dash00-topbar-actions { display: flex; align-items: center; gap: 18px; }
  .dash00-icon-btn {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: var(--dash00-cream-100);
    color: var(--dash00-green-800);
    border: none; cursor: pointer; transition: all 0.25s var(--dash00-cubic);
  }
  .dash00-icon-btn:hover { 
    background: var(--dash00-gold-300); 
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201, 162, 39, 0.2);
  }
  .dash00-icon-btn svg { width: 17px; height: 17px; }

  /* ---------- Main Layout ---------- */
  .dash00-main {
    grid-area: main;
    padding: 30px 40px 60px;
    height: calc(100vh - 64px);
    overflow-y: auto;
    overflow-x: hidden;
  }

  .dash00-container {
    font-family: 'Inter', -apple-system, sans-serif;
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Keyframe Animations */
  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  @keyframes pulseGlow {
    0% { box-shadow: 0 0 0 0 rgba(201, 162, 39, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(201, 162, 39, 0); }
    100% { box-shadow: 0 0 0 0 rgba(201, 162, 39, 0); }
  }

  .dash00-stagger {
    opacity: 0;
    animation: fadeSlideUp 0.8s var(--dash00-cubic) forwards;
  }
  .ds-del-1 { animation-delay: 0.05s; }
  .ds-del-2 { animation-delay: 0.15s; }
  .ds-del-3 { animation-delay: 0.25s; }
  .ds-del-4 { animation-delay: 0.35s; }
  .ds-del-5 { animation-delay: 0.45s; }

  .dash00-header {
    margin-bottom: 36px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
  }

  .dash00-header h1 {
    font-family: 'Poppins', Inter, sans-serif;
    font-size: 30px;
    font-weight: 700;
    color: var(--dash00-green-950);
    margin: 0 0 6px 0;
    letter-spacing: -0.01em;
  }

  .dash00-header p {
    color: var(--dash00-ink-600);
    margin: 0;
    font-size: 15px;
  }

  .dash00-btn-refresh {
    background: linear-gradient(135deg, var(--dash00-green-800), var(--dash00-green-950));
    color: var(--dash00-white);
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s var(--dash00-cubic);
    box-shadow: 0 4px 15px rgba(11, 46, 36, 0.2);
  }
  .dash00-btn-refresh:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(11, 46, 36, 0.3);
  }
  .dash00-btn-refresh svg { transition: transform 0.5s ease; }
  .dash00-btn-refresh:active svg { transform: rotate(180deg); }

  /* Grid System */
  .dash00-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 24px;
    margin-bottom: 24px;
  }

  /* Core Card Styling */
  .dash00-card {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: var(--dash00-radius-lg);
    padding: 28px;
    box-shadow: var(--dash00-shadow-card);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.4s var(--dash00-cubic);
    position: relative;
    overflow: hidden;
  }

  .dash00-card:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: var(--dash00-shadow-hover);
    border-color: rgba(255, 255, 255, 1);
  }

  .dash00-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 4px;
    background: transparent;
    transition: background 0.4s ease;
  }

  /* Specific Card Variants */
  .dash00-card-members {
    grid-column: span 4;
    background: linear-gradient(135deg, var(--dash00-green-800), var(--dash00-green-950));
    color: var(--dash00-white);
    border: none;
    box-shadow: 0 10px 30px rgba(11, 46, 36, 0.25);
  }
  .dash00-card-members:hover {
    box-shadow: 0 20px 40px rgba(11, 46, 36, 0.4);
  }
  
  .dash00-card-revenue {
    grid-column: span 5;
    background: linear-gradient(135deg, var(--dash00-gold-500), #DAB02A);
    color: var(--dash00-green-950);
    border: none;
  }

  .dash00-card-pending {
    grid-column: span 3;
    pointer-events: auto;
  }
  .dash00-card-pending:hover::before {
    background: var(--dash00-gold-500);
  }

  .dash00-card-collections {
    grid-column: span 7;
  }
  
  .dash00-card-insights {
    grid-column: span 5;
  }

  /* Card Inner Elements */
  .dash00-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 24px;
    position: relative;
    z-index: 2;
  }

  .dash00-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--dash00-cream-100);
    color: var(--dash00-green-800);
    transition: transform 0.3s ease;
  }
  .dash00-card:hover .dash00-icon-wrap {
    transform: scale(1.1) rotate(-5deg);
  }

  .dash00-card-members .dash00-icon-wrap {
    background: rgba(255,255,255,0.15);
    color: var(--dash00-gold-300);
    backdrop-filter: blur(5px);
  }
  
  .dash00-card-revenue .dash00-icon-wrap {
    background: rgba(255,255,255,0.3);
    color: var(--dash00-green-950);
  }

  .dash00-card-label {
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--dash00-ink-600);
  }
  .dash00-card-members .dash00-card-label { color: rgba(250, 247, 240, 0.7); }
  .dash00-card-revenue .dash00-card-label { color: rgba(11, 46, 36, 0.7); }

  .dash00-card-value {
    font-size: 42px;
    font-weight: 800;
    font-family: 'Poppins', Inter, sans-serif;
    color: var(--dash00-green-950);
    line-height: 1;
    position: relative;
    z-index: 2;
  }
  .dash00-card-members .dash00-card-value { color: var(--dash00-gold-300); }
  .dash00-card-revenue .dash00-card-value { color: var(--dash00-white); }

  .dash00-trend {
    margin-top: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13.5px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 20px;
    transition: background 0.3s ease;
    position: relative;
    z-index: 2;
  }
  .dash00-trend-up {
    background: var(--dash00-cream-100);
    color: var(--dash00-green-800);
  }
  .dash00-card-members .dash00-trend-up {
    background: rgba(255,255,255,0.1);
    color: var(--dash00-white);
  }
  .dash00-card-revenue .dash00-trend-up {
    background: rgba(255,255,255,0.25);
    color: var(--dash00-green-950);
  }

  /* Abstract Shapes for Dark/Gold Cards */
  .dash00-shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(30px);
    opacity: 0.4;
    z-index: 1;
    pointer-events: none;
    transition: transform 0.6s var(--dash00-cubic);
  }
  .dash00-card-members .dash00-shape-1 {
    width: 150px; height: 150px;
    background: var(--dash00-gold-500);
    top: -50px; right: -50px;
  }
  .dash00-card-members:hover .dash00-shape-1 { transform: scale(1.3) translate(-10px, 10px); }
  
  .dash00-card-revenue .dash00-shape-1 {
    width: 200px; height: 200px;
    background: var(--dash00-green-800);
    bottom: -80px; left: -20px;
    opacity: 0.15;
  }

  /* Lists & Tables Styling */
  .dash00-list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px dashed var(--dash00-border);
  }
  .dash00-list-title {
    font-size: 18px;
    font-weight: 700;
    font-family: 'Poppins', Inter, sans-serif;
    color: var(--dash00-green-950);
    display: flex; align-items: center; gap: 8px;
  }

  .dash00-list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 8px;
    background: rgba(250, 247, 240, 0.4);
    border: 1px solid transparent;
    transition: all 0.2s ease;
    cursor: default;
  }
  .dash00-list-item:hover {
    background: var(--dash00-white);
    border-color: var(--dash00-border);
    transform: translateX(4px);
    box-shadow: var(--dash00-shadow-card);
  }
  .dash00-item-left {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .dash00-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: var(--dash00-green-800);
    color: var(--dash00-gold-300);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px;
    flex-shrink: 0;
  }
  .dash00-item-info strong {
    display: block; color: var(--dash00-green-950); font-size: 14.5px;
  }
  .dash00-item-info span {
    display: block; color: var(--dash00-ink-400); font-size: 12.5px; margin-top: 2px;
  }
  .dash00-item-right {
    text-align: right;
  }
  .dash00-val-amount {
    display: block; color: var(--dash00-green-950); font-weight: 700; font-size: 15px;
  }
  .dash00-val-type {
    display: inline-block; padding: 2px 8px; border-radius: 10px;
    font-size: 10.5px; font-weight: 600; text-transform: uppercase;
    background: var(--dash00-cream-100); color: var(--dash00-ink-600); margin-top: 4px;
  }

  /* Responsive Design */
  @media (max-width: 1200px) {
    .dash00-card-members { grid-column: span 6; }
    .dash00-card-revenue { grid-column: span 6; }
    .dash00-card-pending { grid-column: span 12; }
    .dash00-card-collections, .dash00-card-insights { grid-column: span 12; }
  }

  @media (max-width: 900px) {
    .dash00-app { grid-template-columns: 1fr; grid-template-areas: "topbar" "main"; }
    .dash00-topbar { padding: 0 20px; }
    .dash00-main { padding: 20px 20px 50px; }
    .dash00-header { flex-direction: column; align-items: flex-start; gap: 16px; }
  }
</style>

<div id="Main_dashboard_00" style="display: none; background:var(--dash00-cream-50);">

<div class="dash00-app">

  <?php include_once "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="dash00-topbar">
    <div class="dash00-topbar-heading">
      <h1>Dashboard Overview</h1>
      <p>Financial & Member Intelligence System</p>
    </div>
    <div class="dash00-topbar-actions">
      <button class="dash00-icon-btn" title="Sync Status" aria-label="Sync Status" onclick="main_refresh_dashboard_data()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.59-9.21l5.73 4.21"/></svg>
      </button>
      <button class="dash00-icon-btn" title="Settings" aria-label="Settings" onclick="if(typeof main_dashboard_05_01_OPEN === 'function') main_dashboard_05_01_OPEN();">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
      </button>
      <button class="dash00-icon-btn bmjm-user-logout-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="dash00-main">

  <div class="dash00-container">
    
    <div class="dash00-header dash00-stagger ds-del-1">
      <div>
        <h1>Welcome Back.</h1>
        <p>Your real-time operations overview for the active community.</p>
      </div>
      <div>
        <button onclick="main_refresh_dashboard_data()" class="dash00-btn-refresh">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          Sync Records
        </button>
      </div>
    </div>

    <div class="dash00-grid">
      
      <!-- Card 1: Active Members -->
      <div class="dash00-card dash00-card-members dash00-stagger ds-del-2">
        <div class="dash00-shape dash00-shape-1"></div>
        <div class="dash00-card-top">
          <div class="dash00-card-label">Active Members</div>
          <div class="dash00-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
        </div>
        <div>
          <div class="dash00-card-value" id="dash00-total-members-val">--</div>
          <div class="dash00-trend dash00-trend-up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.5C2 7 4 5 6.5 5h4.6a2 2 0 0 1 1.7.8L15 9h5a2 2 0 0 1 2 2v6z"/></svg>
            Live from Database
          </div>
        </div>
      </div>

      <!-- Card 2: Revenue -->
      <div class="dash00-card dash00-card-revenue dash00-stagger ds-del-3">
        <div class="dash00-shape dash00-shape-1"></div>
        <div class="dash00-card-top">
          <div class="dash00-card-label">Collected Amounts</div>
          <div class="dash00-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
          </div>
        </div>
        <div>
          <div class="dash00-card-value" id="dash00-total-collected-val" style="font-size:36px;">Rs <span class="calc-val">--</span></div>
          <div class="dash00-trend dash00-trend-up">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
            This Financial Year
          </div>
        </div>
      </div>

      <!-- Card 3: Pending Actions -->
      <div class="dash00-card dash00-card-pending dash00-stagger ds-del-4">
        <div class="dash00-card-top" style="margin-bottom:12px;">
          <div class="dash00-card-label">Pending Approval</div>
        </div>
        <div>
          <div class="dash00-card-value" id="dash00-pending-approvals-val" style="font-size:32px;">--</div>
          <div class="dash00-trend" style="color:var(--dash00-gold-600); margin-top:8px; padding-left:0; background:transparent;">
            Attention Required
          </div>
        </div>
      </div>

      <!-- List Container: Collections -->
      <div class="dash00-card dash00-card-collections dash00-stagger ds-del-5">
        <div class="dash00-list-header">
          <div class="dash00-list-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Last Collections
          </div>
        </div>
        
        <div id="dash00-recent-payments-list">
          <div style="padding:20px; text-align:center; color:var(--dash00-ink-400); font-weight:600;">Loading live records...</div>
        </div>
      </div>

      <!-- List Container: Insights -->
      <div class="dash00-card dash00-card-insights dash00-stagger ds-del-5">
        <div class="dash00-list-header">
          <div class="dash00-list-title">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
            System Metrics
          </div>
        </div>
        
        <div class="dash00-list-item" style="background:transparent; border-bottom:1px solid var(--dash00-cream-100); border-radius:0; padding:12px 0;">
          <div class="dash00-item-info"><strong>Database Status</strong></div>
          <div class="dash00-item-right"><span id="dash00-database-status" class="dash00-val-amount" style="color:var(--dash00-green-800);">Checking</span></div>
        </div>
        <div class="dash00-list-item" style="background:transparent; border-bottom:1px solid var(--dash00-cream-100); border-radius:0; padding:12px 0;">
          <div class="dash00-item-info"><strong>Dashboard API</strong></div>
          <div class="dash00-item-right"><span id="dash00-api-status" class="dash00-val-amount" style="color:var(--dash00-gold-600);">Checking</span></div>
        </div>
        <div class="dash00-list-item" style="background:transparent; border-bottom:1px solid var(--dash00-cream-100); border-radius:0; padding:12px 0;">
          <div class="dash00-item-info"><strong>Last Synced</strong></div>
          <div class="dash00-item-right"><span id="dash00-last-sync" class="dash00-val-amount" style="color:var(--dash00-green-800);">--</span></div>
        </div>
      </div>

    </div>
  </div>

  <?php include_once __DIR__ . '/JS/Main-Dashboard_00_JS.php'; ?>
</div>
</div>
