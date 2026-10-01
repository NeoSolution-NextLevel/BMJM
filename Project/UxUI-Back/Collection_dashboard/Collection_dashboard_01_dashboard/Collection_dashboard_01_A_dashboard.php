<?php 
    $pth = "../"; 
    $active_page = "project-collection"; 
    $page_title = "Collection Dashboard · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (Collection Dashboard - Premium UX)
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
    --projc-shadow-glow:0 20px 40px rgba(18, 56, 50, 0.12);
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
    border:none;cursor:pointer;transition:all .3s var(--projc-cubic);
  }
  .project-collection-icon-btn:hover{
    background:var(--projc-gold-300); transform:translateY(-2px) scale(1.05); color: var(--projc-green-950);
  }
  .project-collection-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main App Window ---------- */
  .project-collection-main{
    grid-area:main;
    padding:30px 40px;
    display: flex; flex-direction: column;
    animation: fadeSlideUp 0.6s var(--projc-cubic) forwards;
  }

  @keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .collection-dashboard-wrapper {
    display: flex;
    flex: 1;
    align-items: flex-start;
  }

  /* Main Panel Content */
  .collection-dashboard-content {
    flex: 1;
    background: var(--projc-white);
    border-radius: var(--projc-radius-lg);
    box-shadow: var(--projc-shadow);
    overflow: hidden;
    border: 1px solid var(--projc-border);
    display: flex;
    flex-direction: column;
  }

  .collection-panel-header {
    background: linear-gradient(135deg, var(--projc-green-800), var(--projc-green-950));
    color: var(--projc-cream-50);
    padding: 24px 34px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
  }
  
  .collection-panel-header::before {
    content: ''; position: absolute; left: -20px; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--projc-gold-500); filter: blur(40px); opacity: 0.15;
    pointer-events: none;
  }

  .collection-panel-header h2 {
    margin: 0;
    font-family: 'Poppins', Inter, sans-serif;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: 0.01em;
    position: relative;
    z-index: 2;
  }

  .collection-panel-close {
    width: 32px; height: 32px; border-radius: 50%;
    border: 1px solid rgba(250,247,240,0.25);
    background: transparent; color: var(--projc-cream-50);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all .3s var(--projc-cubic);
    position: relative; z-index: 2;
  }

  .collection-panel-close:hover {
    background: rgba(250,247,240,0.15); transform: rotate(90deg) scale(1.1);
  }

  /* Inside panel body */
  .collection-panel-body {
    padding: 30px 40px 40px;
    background: var(--projc-white);
    position: relative;
  }

  .collection-breadcrumb {
    font-size: 13px; color: var(--projc-ink-400); margin-bottom: 24px;
    display: flex; gap: 8px; align-items: center;
    background: var(--projc-white);
    padding: 10px 16px;
    border-radius: var(--projc-radius-sm);
    border: 1px solid var(--projc-cream-100);
    box-shadow: 0 2px 8px rgba(11,46,36,0.02);
  }
  .collection-breadcrumb span.active-crumb {
    color: var(--projc-green-700); font-weight: 600;
  }

  /* =========================================================
     Premium Bento UX Grid 
     ========================================================= */
  .collection-summary-card {
    background: var(--projc-cream-50);
    border-radius: var(--projc-radius-lg);
    padding: 34px;
    display: flex;
    gap: 40px;
    border: 1px solid var(--projc-cream-100);
    align-items: stretch;
  }

  /* Left Image block */
  .collection-summary-img-box {
    width: 280px;
    background: var(--projc-ink-600);
    border-radius: 16px;
    flex-shrink: 0;
    box-shadow: 0 12px 24px rgba(11,46,36,0.08); /* improved shadow */
    position: relative;
    overflow: hidden;
    transition: transform 0.4s var(--projc-cubic);
  }
  .collection-summary-img-box:hover {
    transform: translateY(-4px) scale(1.02);
  }
  .collection-summary-img-box::after {
    content: '';
    position: absolute;
    top:0; left:0; right:0; bottom:0;
    background: linear-gradient(180deg, transparent 40%, rgba(11,46,36,0.6) 100%);
  }

  /* Cover title overlay over the image */
  .collection-img-title {
    position: absolute;
    bottom: 20px; left: 20px; right: 20px;
    color: var(--projc-white);
    z-index: 2;
  }
  .collection-img-title span {
    font-size: 11px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
    color: var(--projc-gold-300); display: block; margin-bottom: 4px;
  }
  .collection-img-title h3 {
    margin: 0; font-family: 'Poppins', Inter, sans-serif; font-size: 20px; font-weight: 600;
    line-height: 1.2;
  }

  /* Right Details block */
  .collection-summary-details {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .collection-loading-title {
    font-family: 'Poppins', Inter, sans-serif;
    font-size: 32px;
    font-weight: 800;
    color: var(--projc-green-950);
    margin: 0 0 24px 0;
    letter-spacing: -0.02em;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  /* Bento Grid for Metrics */
  .collection-bento-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  /* Animation setup for staggered entrance */
  .bento-stagger {
    animation: fadeSlideUp 0.6s var(--projc-cubic) forwards;
    opacity: 0; transform: translateY(20px);
  }
  .bento-delay-1 { animation-delay: 0.1s; }
  .bento-delay-2 { animation-delay: 0.2s; }
  .bento-delay-3 { animation-delay: 0.3s; }
  .bento-delay-4 { animation-delay: 0.4s; }
  .bento-delay-5 { animation-delay: 0.5s; }

  /* KPI Card Styling */
  .collection-kpi-card {
    background: var(--projc-white);
    border: 1px solid var(--projc-border);
    border-radius: 16px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    overflow: hidden;
    transition: all 0.4s var(--projc-cubic);
    box-shadow: 0 4px 12px rgba(11,46,36,0.02);
  }
  .collection-kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--projc-shadow-glow);
    border-color: rgba(201, 162, 39, 0.4); /* subtle gold border */
  }

  /* Icon wrapping */
  .kpi-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
  }
  .kpi-icon svg { width: 20px; height: 20px; }

  /* Color variations for Icons */
  .kpi-icon-blue { background: rgba(52, 152, 219, 0.1); color: #2980B9; }
  .kpi-icon-green { background: rgba(27, 75, 65, 0.08); color: var(--projc-green-800); }
  .kpi-icon-gold { background: rgba(201, 162, 39, 0.12); color: var(--projc-gold-600); }
  .kpi-icon-dark { background: rgba(30, 43, 38, 0.06); color: var(--projc-ink-600); }
  .kpi-icon-alert { background: rgba(233, 88, 76, 0.08); color: var(--projc-danger); } 

  .collection-kpi-label {
    font-size: 13px; font-weight: 600; color: var(--projc-ink-400);
    text-transform: uppercase; letter-spacing: 0.05em;
    margin-bottom: 8px;
  }
  .collection-kpi-value {
    font-size: 28px; font-weight: 800; color: var(--projc-green-950);
    letter-spacing: -0.02em; font-family: 'Inter', sans-serif;
  }
  .collection-kpi-value.gold-text { color: var(--projc-gold-600); }
  
  .collection-kpi-currency {
    font-size: 16px; color: var(--projc-ink-400); font-weight: 600; margin-right: 4px; vertical-align: middle;
  }

  /* Make the Total Budget card span 2 columns */
  .collection-kpi-card.full-span {
    grid-column: 1 / -1;
    background: linear-gradient(135deg, var(--projc-green-950) 0%, var(--projc-green-800) 100%);
    border: none;
  }
  .collection-kpi-card.full-span:hover {
    box-shadow: 0 20px 48px rgba(11, 46, 36, 0.25);
    transform: translateY(-5px);
  }
  .collection-kpi-card.full-span .collection-kpi-label { color: rgba(250, 247, 240, 0.7); }
  .collection-kpi-card.full-span .collection-kpi-value { color: var(--projc-white); font-size: 34px; }
  .collection-kpi-card.full-span .kpi-icon { background: rgba(255,255,255,0.1); color: var(--projc-white); }
  .collection-kpi-card.full-span .collection-kpi-currency { color: rgba(250, 247, 240, 0.6); }

  /* Abstract graphic for the full span card */
  .collection-kpi-card.full-span::before {
    content: ''; position: absolute; right: -20px; bottom: -40px;
    width: 150px; height: 150px; border-radius: 50%;
    background: var(--projc-gold-500); filter: blur(40px); opacity: 0.2;
    pointer-events: none;
  }

  /* Responsive tweaks */
  @media (max-width: 1100px) {
    .collection-summary-card { flex-direction: column; align-items: stretch; }
    .collection-summary-img-box { width: 100%; height: 280px; }
  }
  @media (max-width: 600px) {
    .collection-bento-grid { grid-template-columns: 1fr; }
  }

</style>

<div data-page="project" id="Collection_Dashboard_01_A">

<div class="project-collection-app">

  <!-- Uses Global Sidebar created by User -->
  <?php include "../UxUI-Back/Includes/Sidebar_collection.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="project-collection-topbar">
    <div class="project-collection-topbar-heading">
      <h1>Collection Payment Management</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="project-collection-topbar-actions">
      <button class="project-collection-icon-btn" title="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="project-collection-main">
    
    <div class="collection-dashboard-wrapper">

        <!-- Right Content Panel -->
        <section class="collection-dashboard-content">
            
            <div class="collection-panel-header">
                <h2 id="dashboard_summary_header">Summary Dashboard</h2>
                <button class="collection-panel-close" title="Close" onclick="window.history.back()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div class="collection-panel-body">
                <div class="collection-breadcrumb">
                    Dashboard <span style="color:var(--projc-ink-400)">/</span> <span class="active-crumb">Summary</span>
                </div>

                <div class="collection-summary-card">
                    
                    <!-- Left beautiful visual box -->
                    <div class="collection-summary-img-box bento-stagger" id="dashboard_img_box" style="background: url('../../assets/images/sample_project.jpg') center/cover no-repeat; background-color: var(--projc-ink-400);">
                       <div class="collection-img-title">
                           <span id="dashboard_collection_id_label">Collection ID</span>
                           <h3 id="dashboard_project_name">Loading...</h3>
                       </div>
                    </div>

                    <!-- Right Metrics Bento Grid -->
                    <div class="collection-summary-details">
                        
                        <!-- Main 3-block layout via grid -->
                        <div class="collection-bento-grid">
                            
                            <!-- Budget Amount (Full Span for Emphasis) -->
                            <div class="collection-kpi-card full-span bento-stagger bento-delay-1">
                                <div class="kpi-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                </div>
                                <div class="collection-kpi-label">Total Budget Amount</div>
                                <div class="collection-kpi-value"><span class="collection-kpi-currency">LKR</span><span id="dashboard_kpi_budget">0.00</span></div>
                            </div>

                            <!-- Collected Amount -->
                            <div class="collection-kpi-card bento-stagger bento-delay-2">
                                <div class="kpi-icon kpi-icon-green">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                </div>
                                <div class="collection-kpi-label">Collected Amount</div>
                                <div class="collection-kpi-value"><span class="collection-kpi-currency">LKR</span><span id="dashboard_kpi_collected">0.00</span></div>
                            </div>

                            <!-- Remaining Amount -->
                            <div class="collection-kpi-card bento-stagger bento-delay-3">
                                <div class="kpi-icon kpi-icon-gold">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                </div>
                                <div class="collection-kpi-label">Remaining Required</div>
                                <div class="collection-kpi-value gold-text"><span class="collection-kpi-currency">LKR</span><span id="dashboard_kpi_remaining">0.00</span></div>
                            </div>

                            <!-- Target Date -->
                            <div class="collection-kpi-card bento-stagger bento-delay-4">
                                <div class="kpi-icon kpi-icon-dark">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </div>
                                <div class="collection-kpi-label">Target End Date</div>
                                <div class="collection-kpi-value" style="font-size:20px;" id="dashboard_kpi_target_date">N/A</div>
                            </div>

                            <!-- Remaining Days -->
                            <div class="collection-kpi-card bento-stagger bento-delay-5">
                                <div class="kpi-icon kpi-icon-alert">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <div class="collection-kpi-label">Days Remaining</div>
                                <div class="collection-kpi-value" style="font-size:20px;" id="dashboard_kpi_days">---</div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>

<?php 
// Include specific JS script corresponding to this UI for AJAX processing
if (file_exists('JS/Collection_dashboard_01_A_JS.php')) {
    include_once 'JS/Collection_dashboard_01_A_JS.php';
}
?>
            
        </section>
        
    </div>

    
  </main>

</div>

</div>
