<?php 
    $pth = "../";  // Adjusted to point to root if executed from UxUI-Back/.../...
    $active_page = "collection-expenses"; 
    $page_title = "Expence Summary · bmjm Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (Expense Summary List - Premium UX)
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

  /* Main Panel Content Container */
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

  /* Collection Panel Header */
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
    width: 250px; height: 250px; border-radius: 50%;
    background: var(--projc-gold-500); filter: blur(50px); opacity: 0.15;
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

  /* Toolbar / Filters Area */
  .list-filters-toolbar {
    padding: 24px 34px;
    background: rgba(250, 247, 240, 0.4);
    border-bottom: 1px solid var(--projc-cream-100);
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 20px;
    justify-content: space-between;
  }

  .filters-left-group {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
  }

  .filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .filter-group label {
    font-size: 13px; font-weight: 700; color: var(--projc-ink-900);
  }
  
  .premium-input {
    height: 44px;
    border: 1px solid var(--projc-border);
    border-radius: 8px;
    padding: 0 16px;
    font-size: 14px; font-weight: 500; font-family: inherit;
    color: var(--projc-ink-900); background: var(--projc-white);
    outline: none; transition: all 0.3s var(--projc-cubic);
    box-shadow: 0 2px 6px rgba(11,46,36,0.02);
  }
  .premium-input:focus {
    border-color: var(--projc-gold-300); background: var(--projc-white);
    box-shadow: 0 4px 16px rgba(201,162,39,0.1);
  }
  
  /* Text Search Input Width Adjustment */
  .search-input { min-width: 280px; }

  .premium-select {
    min-width: 150px; cursor: pointer;
  }

  .filters-right-group {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .btn-add-new {
    height: 44px; padding: 0 34px;
    background: linear-gradient(135deg, var(--projc-gold-500), var(--projc-gold-600));
    color: var(--projc-green-950);
    font-size: 14px; font-weight: 700; font-family: inherit;
    border: none; border-radius: 8px; cursor: pointer;
    box-shadow: 0 4px 12px rgba(184,146,61,0.25);
    transition: all 0.3s var(--projc-cubic);
  }
  .btn-add-new:hover {
    box-shadow: 0 8px 20px rgba(184,146,61,0.4);
    transform: translateY(-2px);
  }
  .btn-add-new:active { transform: translateY(0); }

  /* Main Table Layout */
  .list-content-area {
    padding: 34px;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 250px;
  }

  .premium-table-wrap {
    width: 100%; border-collapse: separate; border-spacing: 0;
    box-shadow: 0 4px 16px rgba(11,46,36,0.03); border-radius: 12px;
    background: var(--projc-white); overflow: hidden;
    border: 1px solid var(--projc-border);
  }
  .premium-table { width: 100%; border-collapse: collapse; }
  .premium-table thead th {
    background: rgba(250, 247, 240, 0.6); color: var(--projc-ink-600);
    font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
    padding: 16px 24px; text-align: left; border-bottom: 1px solid var(--projc-cream-100);
  }
  .premium-table tbody td {
    padding: 18px 24px; font-size: 14px; font-weight: 500; color: var(--projc-ink-900);
    border-bottom: 1px solid var(--projc-cream-100); transition: all 0.2s;
  }
  .premium-table tbody tr:last-child td { border-bottom: none; }
  .premium-table tbody tr:hover td { background: var(--projc-cream-50); }
  
  .td-bold-price { font-weight: 700 !important; color: var(--projc-danger) !important; }
  
  .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; white-space: nowrap;}
  .badge-expense { background: rgba(192, 57, 43, 0.1); color: var(--projc-danger); }
  .badge-vendor { background: rgba(27, 75, 65, 0.1); color: var(--projc-green-800); }
  
  .table-action-btn {
    height: 32px; padding: 0 16px; font-size: 12px; font-weight: 600;
    background: transparent; color: var(--projc-green-800); border: 2px solid var(--projc-green-800);
    border-radius: 6px; cursor: pointer; transition: all 0.2s;
  }
  .table-action-btn:hover { background: var(--projc-green-800); color: var(--projc-white); }
  
  .anim-fade-tbl tr { animation: fadeSlideUp 0.4s var(--projc-cubic) forwards; opacity: 0; transform: translateY(10px); }
  .anim-fade-tbl tr:nth-child(1) { animation-delay: 0.05s; }
  .anim-fade-tbl tr:nth-child(2) { animation-delay: 0.10s; }
  .anim-fade-tbl tr:nth-child(3) { animation-delay: 0.15s; }
  .anim-fade-tbl tr:nth-child(4) { animation-delay: 0.20s; }

  /* Responsive tweaks */
  @media (max-width: 900px) {
    .list-filters-toolbar { flex-direction: column; align-items: stretch; }
    .filters-left-group, .filters-right-group { width: 100%; justify-content: space-between; }
    .filter-group { flex: 1; }
    .premium-input { width: 100%; }
    .premium-table-wrap { display: block; overflow-x: auto; white-space: nowrap; }
  }

</style>

<div data-page="project" id="Collection_Dashboard_03_A">

<div class="project-collection-app">

  <!-- Uses Global Sidebar created by User -->
    <?php include "../UxUI-Back/Includes/Sidebar_collection.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="project-collection-topbar">
    <div class="project-collection-topbar-heading">
      <h1>Payment Dashboard</h1>
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
    
    <!-- Right Content Panel -->
    <section class="collection-dashboard-content">
        
        <div class="collection-panel-header">
            <h2>Expence Summary List</h2>
            <button class="collection-panel-close" title="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="list-filters-toolbar">
           <!-- Left Filters -->
           <div class="filters-left-group">
                <div class="filter-group">
                    <label>Start Date</label>
                    <input type="date" class="premium-input" value="2026-07-19">
                </div>
                <div class="filter-group">
                    <label>End Date</label>
                    <input type="date" class="premium-input" value="2026-08-18">
                </div>
                <div class="filter-group">
                    <label>Search by Description</label>
                    <input type="text" class="premium-input search-input" placeholder="search name">
                </div>
           </div>
           
           <!-- Right Controls -->
           <div class="filters-right-group">
                <button type="button" class="btn-add-new" onclick="Collection_Dashboard_03_B_OPEN()">Add New</button>
                <select class="premium-input premium-select" style="min-width: 120px;">
                    <option>Per Page 10</option>
                    <option>Per Page 25</option>
                    <option selected>Per Page 50</option>
                </select>
           </div>
        </div>

        <div class="list-content-area">
            <div class="premium-table-wrap">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Method</th>
                            <th>Amount (LKR)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="anim-fade-tbl" id="collection-dashboard-expense-tbody">
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </section>

    
  </main>

</div>

<?php 
if (file_exists(__DIR__ . '/JS/Collection_dashboard_03_A_JS.php')) {
    include_once __DIR__ . '/JS/Collection_dashboard_03_A_JS.php';
}
?>

</div>
