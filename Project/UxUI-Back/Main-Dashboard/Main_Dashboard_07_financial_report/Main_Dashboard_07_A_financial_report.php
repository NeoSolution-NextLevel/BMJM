<?php 
    $pth = "../"; 
    $active_page = "financial-report";
    $page_title = "Financial Report · BMJM Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  :root{
    --rpt-green-950:#0B2E24;
    --rpt-green-800:#123832;
    --rpt-green-700:#1B4B41;
    --rpt-gold-600:#B8923D;
    --rpt-gold-500:#C9A227;
    --rpt-gold-300:#E4C766;
    --rpt-cream-50:#FAF7F0;
    --rpt-cream-100:#F2EDE0;
    --rpt-white:#FFFFFF;
    --rpt-ink-900:#1E2B26;
    --rpt-ink-600:#5A6A62;
    --rpt-ink-400:#8B978F;
    --rpt-border:#E6E0D0;
    --rpt-danger:#B0453A;
    --rpt-success:#1B7A4A;
    --rpt-radius-sm:8px;
    --rpt-radius-md:16px;
    --rpt-radius-lg:22px;
    --rpt-shadow:0 6px 24px rgba(11,46,36,0.08);
    --rpt-shadow-sm:0 2px 8px rgba(11,46,36,0.05);
    --rpt-cubic:cubic-bezier(0.2,0.8,0.2,1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--rpt-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--rpt-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px;
  }

  /* ---- Layout grid ---- */
  .rpt-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:"sidebar topbar" "sidebar main";
  }

  /* ---- Topbar ---- */
  .rpt-topbar{
    grid-area:topbar;
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;z-index:10;
  }
  .rpt-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--rpt-green-950);
  }
  .rpt-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--rpt-ink-400);}
  .rpt-topbar-actions{display:flex;align-items:center;gap:18px;}
  .rpt-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--rpt-cream-100);color:var(--rpt-green-800);
    border:none;cursor:pointer;transition:all .3s var(--rpt-cubic);
  }
  .rpt-icon-btn:hover{background:var(--rpt-gold-300);transform:translateY(-2px);}
  .rpt-icon-btn svg{width:16px;height:16px;}

  /* ---- Main ---- */
  .rpt-main{
    grid-area:main;
    padding:26px 30px 50px;
    display:flex;flex-direction:column;gap:22px;
    animation:fadeSlideUp 0.55s var(--rpt-cubic) forwards;
  }
  @keyframes fadeSlideUp{
    from{opacity:0;transform:translateY(18px);}
    to{opacity:1;transform:translateY(0);}
  }

  /* ---- Breadcrumb ---- */
  .rpt-breadcrumb{
    font-size:12px;color:var(--rpt-ink-400);
    display:flex;gap:6px;align-items:center;
  }
  .rpt-breadcrumb a{color:var(--rpt-ink-400);text-decoration:none;}
  .rpt-breadcrumb a:hover{color:var(--rpt-green-700);}
  .rpt-breadcrumb span{color:var(--rpt-green-700);font-weight:600;}

  /* ---- Panel shell ---- */
  .rpt-panel{
    background:var(--rpt-white);
    border-radius:var(--rpt-radius-lg);
    box-shadow:var(--rpt-shadow);
    border:1px solid var(--rpt-border);
    overflow:hidden;
    flex:0 0 auto;
  }
  .rpt-document-header,.rpt-document-footer{display:none;}
  .rpt-document-header{
    align-items:center;gap:16px;
    padding:16px 20px 14px;
    border-bottom:2px solid var(--rpt-gold-500);
    background:#F7F8F5;
  }
  .rpt-document-logo{width:72px;height:52px;object-fit:contain;flex:0 0 auto;}
  .rpt-document-brand{min-width:0;flex:1;}
  .rpt-document-brand strong,.rpt-document-meta strong{
    display:block;color:var(--rpt-green-950);font-size:12px;font-weight:800;
  }
  .rpt-document-brand span,.rpt-document-meta span,.rpt-document-meta small{
    display:block;color:var(--rpt-ink-600);font-size:9px;line-height:1.5;
  }
  .rpt-document-meta{text-align:right;flex:0 0 auto;}
  .rpt-document-meta strong{font-size:11px;}
  .rpt-document-meta small{margin-top:3px;color:var(--rpt-ink-400);}
  .rpt-document-footer{
    border-top:1px solid var(--rpt-border);
    padding:12px 20px;color:var(--rpt-ink-600);
    font-size:9px;text-align:center;line-height:1.5;
  }

  /* ---- Panel header (dark green gradient) ---- */
  .rpt-panel-header{
    background:linear-gradient(135deg,var(--rpt-green-800),var(--rpt-green-950));
    color:var(--rpt-cream-50);
    padding:24px 30px;
    display:flex;align-items:center;justify-content:space-between;
    position:relative;overflow:hidden;
  }
  .rpt-panel-header::before{
    content:'';position:absolute;right:40px;top:-80px;
    width:220px;height:220px;border-radius:50%;
    background:var(--rpt-gold-500);filter:blur(50px);opacity:0.15;
    pointer-events:none;
  }
  .rpt-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:22px;font-weight:700;
    position:relative;z-index:2;
  }
  .rpt-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--rpt-gold-300);}
  .rpt-panel-close{
    width:34px;height:34px;border-radius:50%;flex:0 0 34px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--rpt-cream-50);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:all .3s var(--rpt-cubic);
    position:relative;z-index:2;
  }
  .rpt-panel-close:hover{background:rgba(250,247,240,0.15);transform:rotate(90deg);}
  .rpt-panel-close svg{width:18px;height:18px;}

  /* ---- Filter toolbar ---- */
  .rpt-toolbar{
    display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;
    padding:22px 30px;
    background:rgba(250,247,240,0.5);
    border-bottom:1px solid var(--rpt-border);
  }
  .rpt-field{display:flex;flex-direction:column;gap:5px;}
  .rpt-field label{font-size:11.5px;font-weight:700;color:var(--rpt-ink-900);text-transform:uppercase;letter-spacing:0.04em;}
  .rpt-select,.rpt-input{
    height:42px;min-width:150px;
    border:1px solid var(--rpt-border);
    border-radius:var(--rpt-radius-sm);
    padding:0 14px;font-size:13.5px;
    font-family:inherit;color:var(--rpt-ink-900);
    background:var(--rpt-white);outline:none;cursor:pointer;
    transition:border-color .15s ease;
  }
  .rpt-select:focus,.rpt-input:focus{border-color:var(--rpt-gold-500);}
  .rpt-btn-generate{
    height:42px;padding:0 22px;
    border-radius:var(--rpt-radius-sm);
    border:none;cursor:pointer;
    font-size:13px;font-weight:700;letter-spacing:0.01em;
    display:inline-flex;align-items:center;gap:8px;
    white-space:nowrap;
    background:linear-gradient(135deg,var(--rpt-gold-500),var(--rpt-gold-600));
    color:var(--rpt-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
    transition:all .15s ease;
    align-self:flex-end;
  }
  .rpt-btn-generate:hover{box-shadow:0 6px 16px rgba(184,146,61,0.5);}
  .rpt-btn-generate:active{transform:translateY(1px);}
  .rpt-btn-print{
    height:42px;padding:0 18px;
    border-radius:var(--rpt-radius-sm);
    border:1px solid var(--rpt-border);
    cursor:pointer;
    font-size:13px;font-weight:600;
    display:inline-flex;align-items:center;gap:7px;
    white-space:nowrap;
    background:var(--rpt-white);
    color:var(--rpt-ink-900);
    transition:all .15s ease;
    align-self:flex-end;
  }
  .rpt-btn-print:hover{background:var(--rpt-cream-100);border-color:var(--rpt-green-700);}
  .rpt-btn-download{
    height:42px;padding:0 18px;
    border-radius:var(--rpt-radius-sm);
    border:1px solid var(--rpt-green-800);
    cursor:pointer;
    font-size:13px;font-weight:700;
    display:inline-flex;align-items:center;gap:7px;
    white-space:nowrap;
    background:var(--rpt-green-800);
    color:var(--rpt-white);
    transition:background .15s ease,border-color .15s ease;
    align-self:flex-end;
  }
  .rpt-btn-download:hover{background:var(--rpt-green-950);border-color:var(--rpt-green-950);}
  .rpt-btn-download:disabled{opacity:.65;cursor:wait;}

  /* ---- KPI cards row ---- */
  .rpt-kpi-row{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:16px;
    padding:24px 30px 0;
  }
  .rpt-kpi{
    border-radius:var(--rpt-radius-md);
    padding:20px 22px;
    display:flex;flex-direction:column;gap:6px;
    border:1px solid var(--rpt-border);
  }
  .rpt-kpi-income{background:linear-gradient(135deg,rgba(27,122,74,0.08),rgba(27,122,74,0.03));}
  .rpt-kpi-expense{background:linear-gradient(135deg,rgba(176,69,58,0.08),rgba(176,69,58,0.03));}
  .rpt-kpi-net{background:linear-gradient(135deg,rgba(11,46,36,0.06),rgba(11,46,36,0.02));}
  .rpt-kpi-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:var(--rpt-ink-400);}
  .rpt-kpi-amount{font-size:26px;font-weight:800;font-variant-numeric:tabular-nums;}
  .rpt-kpi-income .rpt-kpi-amount{color:var(--rpt-success);}
  .rpt-kpi-expense .rpt-kpi-amount{color:var(--rpt-danger);}
  .rpt-kpi-net .rpt-kpi-amount{color:var(--rpt-green-950);}
  .rpt-kpi-period{font-size:11.5px;color:var(--rpt-ink-400);font-weight:500;}

  /* ---- Section: breakdown table ---- */
  .rpt-section{padding:26px 30px;}
  .rpt-section-title{
    font-size:13px;font-weight:700;text-transform:uppercase;
    letter-spacing:0.06em;color:var(--rpt-ink-600);
    margin-bottom:14px;display:flex;align-items:center;gap:8px;
  }
  .rpt-section-title svg{width:14px;height:14px;color:var(--rpt-gold-600);}

  .rpt-table-wrap{
    border-radius:var(--rpt-radius-sm);
    border:1px solid var(--rpt-border);
    overflow:hidden;
  }
  .rpt-table{width:100%;border-collapse:collapse;text-align:left;}
  .rpt-table thead th{
    background:rgba(250,247,240,0.7);
    color:var(--rpt-ink-600);font-size:12px;font-weight:700;
    text-transform:uppercase;letter-spacing:0.04em;
    padding:13px 18px;
    border-bottom:1px solid var(--rpt-border);
  }
  .rpt-table tbody td{
    padding:15px 18px;font-size:13.5px;font-weight:500;
    color:var(--rpt-ink-900);
    border-bottom:1px solid var(--rpt-cream-100);
  }
  .rpt-table tbody tr:last-child td{border-bottom:none;}
  .rpt-table tbody tr:hover td{background:var(--rpt-cream-50);}
  .rpt-table tfoot td{
    padding:14px 18px;font-size:13px;font-weight:700;
    background:rgba(250,247,240,0.5);
    border-top:2px solid var(--rpt-border);
  }
  .td-right{text-align:right;}
  .td-income-amount{font-weight:700;color:var(--rpt-success);font-variant-numeric:tabular-nums;}
  .td-expense-amount{font-weight:700;color:var(--rpt-danger);font-variant-numeric:tabular-nums;}
  .td-net-positive{font-weight:800;color:var(--rpt-success);}
  .td-net-negative{font-weight:800;color:var(--rpt-danger);}

  .rpt-badge{
    display:inline-block;
    font-size:10.5px;font-weight:700;letter-spacing:0.03em;
    padding:2px 9px;border-radius:999px;
  }
  .rpt-badge-income{background:rgba(27,122,74,0.10);color:var(--rpt-success);}
  .rpt-badge-expense{background:rgba(176,69,58,0.10);color:var(--rpt-danger);}
  .rpt-badge-other{background:rgba(90,106,98,0.10);color:var(--rpt-ink-600);}

  /* ---- Monthly bar chart ---- */
  .rpt-chart-area{padding:0 30px 30px;}
  .rpt-chart-title{
    font-size:13px;font-weight:700;text-transform:uppercase;
    letter-spacing:0.06em;color:var(--rpt-ink-600);
    margin-bottom:18px;display:flex;align-items:center;gap:8px;
  }
  .rpt-chart-title svg{width:14px;height:14px;color:var(--rpt-gold-600);}
  .rpt-bar-chart{display:block;width:100%;overflow:visible;}
  .rpt-bar-group{display:flex;flex-direction:column;align-items:center;gap:4px;min-width:52px;}
  .rpt-bar-pair{display:flex;align-items:flex-end;gap:3px;height:130px;}
  .rpt-bar{
    width:20px;border-radius:4px 4px 0 0;
    transition:height .4s var(--rpt-cubic);min-height:2px;
  }
  .rpt-bar-income-bar{background:var(--rpt-success);}
  .rpt-bar-expense-bar{background:var(--rpt-danger);}
  .rpt-bar-label{font-size:10px;font-weight:600;color:var(--rpt-ink-400);white-space:nowrap;}
  .rpt-chart-legend{
    display:flex;gap:20px;margin-top:12px;
    font-size:11.5px;font-weight:600;color:var(--rpt-ink-600);
  }
  .rpt-legend-dot{width:10px;height:10px;border-radius:50%;display:inline-block;margin-right:5px;}
  .rpt-legend-income{color:var(--rpt-success);}
  .rpt-legend-expense{color:var(--rpt-danger);}

  /* ---- Empty / loading state ---- */
  .rpt-empty{
    padding:50px;text-align:center;
    color:var(--rpt-ink-400);font-size:13.5px;font-weight:500;
  }
  .rpt-loading-text{color:var(--rpt-ink-400);}

  /* ---- Divider ---- */
  .rpt-divider{height:1px;background:var(--rpt-border);margin:0;}

  /* ---- Responsive ---- */
  @media(max-width:900px){
    .rpt-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .rpt-kpi-row{grid-template-columns:1fr;}
    .rpt-toolbar{flex-direction:column;align-items:stretch;}
  }

  /* ---- Print styles (single-page A4) ---- */
  @page{size:A4 portrait;margin:8mm 9mm 10mm;}
  @media print{
    html,body{
      width:210mm!important;height:auto!important;max-height:none!important;
      margin:0!important;padding:0!important;overflow:visible!important;
      background:#fff!important;
      -webkit-print-color-adjust:exact;print-color-adjust:exact;
    }
    body > div[id^="Main"]{
      width:100%!important;height:auto!important;max-height:none!important;
      overflow:visible!important;
    }
    body > div[id^="Main"] > div[class$="-app"],
    body > div[id^="Main"] > div[class*="-app "]{
      display:block!important;width:100%!important;height:auto!important;
      min-height:0!important;max-height:none!important;overflow:visible!important;
    }
    .rpt-topbar,.rpt-breadcrumb,.rpt-toolbar,.bmjm-sidebar,.rpt-panel-close{display:none!important;}
    .rpt-app{display:block!important;}
    body > div[id^="Main"] main.rpt-main{
      display:block!important;width:100%!important;height:auto!important;
      min-height:0!important;max-height:none!important;overflow:visible!important;
      padding:0!important;gap:0!important;animation:none!important;transform:none!important;
    }
    .rpt-panel{
      width:100%!important;overflow:visible!important;flex:none!important;
      border:1px solid #D8DED9;border-radius:5px;box-shadow:none;
      page-break-inside:avoid;
    }
    .rpt-document-header{display:flex!important;padding:7px 12px 6px;}
    .rpt-document-logo{width:40px;height:30px;}
    .rpt-document-brand strong,.rpt-document-meta strong{font-size:8.5px;}
    .rpt-document-brand span,.rpt-document-meta span,.rpt-document-meta small{font-size:7px;}
    .rpt-document-footer{display:block!important;padding:5px 12px;font-size:7px;}
    .rpt-panel-header{padding:7px 12px!important;background:#123832!important;}
    .rpt-panel-title{font-size:12px!important;}
    .rpt-kpi-row{grid-template-columns:repeat(3,minmax(0,1fr));gap:5px;padding:7px 12px 0;}
    .rpt-kpi{padding:5px 7px;border-radius:4px;}
    .rpt-kpi-label{font-size:7px;}
    .rpt-kpi-amount{font-size:12px;}
    .rpt-kpi-period{font-size:7.5px;}
    .rpt-section{padding:6px 12px;}
    .rpt-section-title{font-size:8.5px;margin-bottom:4px;break-after:avoid;}
    .rpt-chart-title{font-size:8.5px;margin-bottom:6px;break-after:avoid;}
    .rpt-table-wrap{overflow:visible;border-radius:4px;}
    .rpt-table{width:100%;}
    .rpt-table thead th{padding:4px 9px;font-size:8px;}
    .rpt-table tbody td{padding:4px 9px;font-size:9px;border-bottom:1px solid #f0ede4;}
    .rpt-table tfoot td{padding:4px 9px;font-size:9px;}
    .rpt-table thead{display:table-header-group;}
    .rpt-table tfoot{display:table-footer-group;}
    .rpt-table tr{break-inside:avoid;}
    .rpt-table tbody tr:hover td{background:transparent;}
    .rpt-chart-area{padding:0 12px 6px;break-inside:avoid;}
    .rpt-bar-chart{height:auto!important;overflow:visible;display:block;}
    .rpt-chart-legend{margin-top:5px;font-size:8.5px;}
    .rpt-legend-dot{width:7px;height:7px;}
    .rpt-divider{margin:1px 0;break-after:avoid;}
    .rpt-badge{font-size:7.5px;padding:1px 5px;}
  }
</style>

<div data-page="project" id="Main_Dashboard_07_A">
<div class="rpt-app">

  <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="rpt-topbar">
    <div class="rpt-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="rpt-topbar-actions">
      <button class="rpt-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="rpt-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="rpt-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="rpt-main">
    <p class="rpt-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> /
      <span>Financial Report</span>
    </p>

    <section class="rpt-panel" aria-label="Financial Report Generator">

      <div class="rpt-document-header">
        <img class="rpt-document-logo" src="../assets/images/common-images/logo.png" alt="Bambalapitiya Jumma Mosque">
        <div class="rpt-document-brand">
          <strong>BAMBALAPITIYA JUMMA MOSQUE</strong>
          <span>Bambalapitiya, Colombo, Sri Lanka</span>
          <span>www.bmjm.lk | 011 771 0877 | info@bmjm.lk</span>
        </div>
        <div class="rpt-document-meta">
          <strong>FINANCIAL REPORT</strong>
          <span id="rpt-document-period">Income &amp; Expense Analysis</span>
          <small>Prepared <?php echo date('F j, Y'); ?></small>
        </div>
      </div>

      <!-- Panel header -->
      <div class="rpt-panel-header">
        <div class="rpt-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          Financial Report
        </div>
        <button type="button" class="rpt-panel-close" onclick="financialReportClose()" title="Close" aria-label="Close">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>

      <!-- Filter toolbar -->
      <div class="rpt-toolbar">
        <div class="rpt-field">
          <label for="rpt-type">Report Type</label>
          <select class="rpt-select" id="rpt-type" onchange="rptToggleFilters()">
            <option value="custom">Custom Date Range</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Full Year</option>
          </select>
        </div>

        <!-- Custom date range fields -->
        <div class="rpt-field" id="rpt-field-start">
          <label for="rpt-start-date">From</label>
          <input type="date" class="rpt-input" id="rpt-start-date">
        </div>
        <div class="rpt-field" id="rpt-field-end">
          <label for="rpt-end-date">To</label>
          <input type="date" class="rpt-input" id="rpt-end-date">
        </div>

        <!-- Monthly fields -->
        <div class="rpt-field" id="rpt-field-month" style="display:none;">
          <label for="rpt-month">Month</label>
          <select class="rpt-select" id="rpt-month">
            <option value="1">January</option><option value="2">February</option>
            <option value="3">March</option><option value="4">April</option>
            <option value="5">May</option><option value="6">June</option>
            <option value="7">July</option><option value="8">August</option>
            <option value="9">September</option><option value="10">October</option>
            <option value="11">November</option><option value="12">December</option>
          </select>
        </div>

        <!-- Year field (monthly + yearly) -->
        <div class="rpt-field" id="rpt-field-year" style="display:none;">
          <label for="rpt-year">Year</label>
          <select class="rpt-select" id="rpt-year">
            <?php
              $currentYear = intval(date('Y'));
              for ($y = $currentYear; $y >= $currentYear - 10; $y--) {
                  $selected = ($y === $currentYear) ? 'selected' : '';
                  echo "<option value=\"{$y}\" {$selected}>{$y}</option>";
              }
            ?>
          </select>
        </div>

        <button type="button" class="rpt-btn-generate" id="rpt-generate-btn" onclick="financialReportGenerate()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
          Generate Report
        </button>

        <button type="button" class="rpt-btn-print" onclick="window.print()" title="Print this report">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
          Print
        </button>
        <button type="button" class="rpt-btn-download" id="rpt-download-pdf-btn" onclick="financialReportDownloadPDF(this)" title="Download this report as a PDF">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5M12 15V3"/></svg>
          Download PDF
        </button>
      </div>

      <!-- KPI cards -->
      <div class="rpt-kpi-row" id="rpt-kpi-row">
        <div class="rpt-kpi rpt-kpi-income">
          <div class="rpt-kpi-label">Total Income</div>
          <div class="rpt-kpi-amount" id="rpt-kpi-income">LKR 0.00</div>
          <div class="rpt-kpi-period" id="rpt-kpi-period-income">—</div>
        </div>
        <div class="rpt-kpi rpt-kpi-expense">
          <div class="rpt-kpi-label">Total Expenses</div>
          <div class="rpt-kpi-amount" id="rpt-kpi-expense">LKR 0.00</div>
          <div class="rpt-kpi-period" id="rpt-kpi-period-expense">—</div>
        </div>
        <div class="rpt-kpi rpt-kpi-net">
          <div class="rpt-kpi-label">Net Balance</div>
          <div class="rpt-kpi-amount" id="rpt-kpi-net">LKR 0.00</div>
          <div class="rpt-kpi-period" id="rpt-kpi-period-net">—</div>
        </div>
      </div>

      <div class="rpt-divider" style="margin-top:22px;"></div>

      <!-- Category breakdown table -->
      <div class="rpt-section">
        <div class="rpt-section-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
          Category Breakdown
        </div>
        <div class="rpt-table-wrap">
          <table class="rpt-table" id="rpt-summary-table">
            <thead>
              <tr>
                <th>Category</th>
                <th>Type</th>
                <th class="td-right">Transactions</th>
                <th class="td-right">Amount (LKR)</th>
              </tr>
            </thead>
            <tbody id="rpt-summary-tbody">
              <tr><td colspan="4" class="rpt-empty">Generate a report to view the breakdown.</td></tr>
            </tbody>
            <tfoot id="rpt-summary-tfoot" style="display:none;">
              <tr>
                <td colspan="2">Net Balance</td>
                <td class="td-right" id="rpt-tfoot-tx-count">—</td>
                <td class="td-right" id="rpt-tfoot-net">—</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="rpt-divider"></div>

      <!-- Monthly bar chart (visible for yearly / custom multi-month) -->
      <div class="rpt-chart-area" id="rpt-chart-area" style="display:none;">
        <div class="rpt-chart-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="18" y="3" width="4" height="18"/><rect x="10" y="8" width="4" height="13"/><rect x="2" y="13" width="4" height="8"/></svg>
          <span id="rpt-chart-title-text">Income vs Expenses Overview</span>
        </div>
        <div class="rpt-bar-chart" id="rpt-bar-chart"></div>
        <div class="rpt-chart-legend">
          <span class="rpt-legend-income"><span class="rpt-legend-dot" style="background:var(--rpt-success);"></span>Income</span>
          <span class="rpt-legend-expense"><span class="rpt-legend-dot" style="background:var(--rpt-danger);"></span>Expenses</span>
        </div>
      </div>

      <div class="rpt-document-footer">
        BAMBALAPITIYA JUMMA MOSQUE | www.bmjm.lk | 011 771 0877 | info@bmjm.lk<br>
        Financial Report | Prepared <?php echo date('F j, Y'); ?>
      </div>

    </section>
  </main>

</div>

</div>
<script src="<?php echo $pth; ?>assets/js/jspdf.umd.min.js"></script>
