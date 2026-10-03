<?php 
    $pth = "../"; 
    $active_page = "accounts"; // Sidebar tracker
    $page_title = "Expense Control System · BMJM Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     BMJM Admin — Expense Overview Grid
     =================================================================== */
  :root{
    --expense-ov-green-950:#0B2E24;
    --expense-ov-green-800:#123832;
    --expense-ov-green-700:#1B4B41;
    --expense-ov-gold-600:#B8923D;
    --expense-ov-gold-500:#C9A227;
    --expense-ov-gold-300:#E4C766;
    --expense-ov-cream-50:#FAF7F0;
    --expense-ov-cream-100:#F2EDE0;
    --expense-ov-white:#FFFFFF;
    --expense-ov-ink-900:#1E2B26;
    --expense-ov-ink-600:#5A6A62;
    --expense-ov-ink-400:#8B978F;
    --expense-ov-border:#E6E0D0;
    --expense-ov-danger:#C0392B;
    --expense-ov-radius-lg:24px;
    --expense-ov-shadow:0 12px 32px rgba(11,46,36,0.06);
    --expense-ov-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--expense-ov-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--expense-ov-ink-900);
    -webkit-font-smoothing:antialiased;
  }

  .expense-ov-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .expense-ov-topbar{
    grid-area:topbar;
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index:10;
  }
  .expense-ov-topbar-heading h1{font-family:'Poppins',Inter,sans-serif;font-size:19px;font-weight:600;margin:0;color:var(--expense-ov-green-950);}
  .expense-ov-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--expense-ov-ink-400);}
  .expense-ov-topbar-actions{display:flex;align-items:center;gap:18px;}
  .expense-ov-icon-btn{
    width:36px;height:36px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--expense-ov-cream-100);color:var(--expense-ov-green-800);
    border:none;cursor:pointer;transition:all .3s var(--expense-ov-cubic);
  }
  .expense-ov-icon-btn:hover{background:var(--expense-ov-gold-300);transform:translateY(-2px) scale(1.05);color:var(--expense-ov-green-950);}
  .expense-ov-icon-btn svg{width:16px;height:16px;}

  .expense-ov-main{
    grid-area:main;
    padding:30px 40px;
    display:flex;flex-direction:column;
    animation:fadeSlideUp 0.6s var(--expense-ov-cubic) forwards;
  }

  @keyframes fadeSlideUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}

  .expense-ov-breadcrumb{
    font-size:13px;color:var(--expense-ov-ink-400);margin-bottom:24px;
    display:flex;gap:8px;align-items:center;
  }
  .expense-ov-breadcrumb a{color:var(--expense-ov-ink-400);text-decoration:none;transition:color 0.2s;}
  .expense-ov-breadcrumb a:hover{color:var(--expense-ov-green-700);}
  .expense-ov-breadcrumb span{color:var(--expense-ov-green-700);font-weight:600;background:rgba(27,75,65,0.08);padding:4px 10px;border-radius:12px;}

  .expense-ov-panel{
    flex:1;background:var(--expense-ov-white);
    border-radius:var(--expense-ov-radius-lg);
    box-shadow:var(--expense-ov-shadow);
    overflow:hidden;
    border:1px solid var(--expense-ov-border);
    display:flex;flex-direction:column;
  }

  .expense-ov-panel-header{
    background:linear-gradient(135deg,#4A1515,#7B2020);
    color:var(--expense-ov-cream-50);
    padding:30px 34px;
    display:flex;align-items:center;justify-content:space-between;
    position:relative;overflow:hidden;
  }
  .expense-ov-panel-header::before{
    content:'';position:absolute;right:5%;top:-60px;
    width:250px;height:250px;border-radius:50%;
    background:#E04040;filter:blur(50px);opacity:0.15;pointer-events:none;
  }
  .expense-ov-panel-title{
    display:flex;align-items:center;gap:14px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    position:relative;z-index:2;
  }
  .expense-ov-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--expense-ov-gold-300);}

  .expense-ov-panel-actions{display:flex;align-items:center;gap:12px;position:relative;z-index:2;}
  .expense-ov-add-btn{
    display:flex;align-items:center;gap:8px;
    height:38px;padding:0 18px;
    border-radius:10px;border:none;cursor:pointer;
    background:var(--expense-ov-gold-500);color:var(--expense-ov-green-950);
    font-size:13px;font-weight:700;font-family:inherit;
    transition:all .3s var(--expense-ov-cubic);
  }
  .expense-ov-add-btn:hover{background:var(--expense-ov-gold-300);transform:translateY(-2px);box-shadow:0 6px 16px rgba(201,162,39,0.3);}
  .expense-ov-add-btn svg{width:14px;height:14px;}

  .expense-ov-panel-close{
    width:36px;height:36px;border-radius:50%;flex:0 0 36px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--expense-ov-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;cursor:pointer;transition:all .3s var(--expense-ov-cubic);
  }
  .expense-ov-panel-close:hover{background:rgba(250,247,240,0.15);transform:rotate(90deg);}

  .expense-ov-grand-total{
    background:linear-gradient(135deg,rgba(192,57,43,0.06),rgba(250,247,240,0.8));
    padding:24px 34px;
    display:flex;align-items:center;justify-content:space-between;
    border-bottom:1px solid var(--expense-ov-cream-100);
  }
  .expense-ov-grand-title{font-size:15px;font-weight:700;color:var(--expense-ov-ink-600);text-transform:uppercase;letter-spacing:0.05em;}
  .expense-ov-grand-amount{font-size:32px;font-weight:800;color:#7B2020;font-variant-numeric:tabular-nums;}
  .expense-ov-grand-amount span{font-size:18px;color:var(--expense-ov-gold-600);margin-right:6px;}

  .expense-ov-toolbar{
    display:flex;align-items:center;gap:16px;flex-wrap:wrap;
    padding:20px 34px;
    background:rgba(250,247,240,0.4);
    border-bottom:1px solid var(--expense-ov-cream-100);
  }
  .expense-ov-searchbox{position:relative;flex:1;min-width:300px;display:flex;}
  .expense-ov-search{
    width:100%;height:46px;border:2px solid transparent;border-radius:12px;
    padding:0 20px 0 50px;font-size:14px;font-weight:500;font-family:inherit;
    color:var(--expense-ov-ink-900);background:rgba(255,255,255,0.8);
    outline:none;transition:all .3s var(--expense-ov-cubic);
  }
  .expense-ov-search::placeholder{color:var(--expense-ov-ink-400);}
  .expense-ov-search:focus{border-color:rgba(192,57,43,0.4);background:var(--expense-ov-white);box-shadow:0 8px 24px rgba(192,57,43,0.08);}
  .expense-ov-searchbox svg{position:absolute;left:16px;top:13px;width:20px;height:20px;color:var(--expense-ov-ink-400);pointer-events:none;transition:color 0.3s;}
  .expense-ov-searchbox:focus-within svg{color:#C0392B;}

  .expense-ov-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:24px;padding:34px;
    background:var(--expense-ov-white);
    max-height:max(220px,calc(100vh - 430px));
    overflow-y:auto;overscroll-behavior:contain;
    align-content:start;
  }

  .expense-type-card{
    background:var(--expense-ov-white);
    border:1px solid rgba(230,224,208,0.5);
    border-radius:20px;padding:24px;
    display:flex;flex-direction:column;gap:16px;
    box-shadow:0 4px 16px rgba(11,46,36,0.03);
    transition:all 0.4s var(--expense-ov-cubic);
    position:relative;opacity:0;transform:translateY(20px);
    animation:fadeSlideUp 0.6s var(--expense-ov-cubic) forwards;
    cursor:pointer;
  }
  .expense-type-card:hover{transform:translateY(-5px) scale(1.02);box-shadow:0 16px 40px rgba(192,57,43,0.08);border-color:rgba(192,57,43,0.25);}

  .expense-type-header{display:flex;align-items:center;gap:12px;}
  .expense-type-icon{
    width:44px;height:44px;border-radius:12px;
    background:linear-gradient(135deg,#7B2020,#4A1515);
    color:var(--expense-ov-gold-300);
    display:flex;align-items:center;justify-content:center;
  }
  .expense-type-icon svg{width:22px;height:22px;}
  .expense-type-name{font-size:16px;font-weight:700;color:var(--expense-ov-green-950);line-height:1.3;}
  .expense-type-badge{font-size:11px;font-weight:700;color:var(--expense-ov-ink-400);text-transform:uppercase;}
  .expense-type-amount{font-size:26px;font-weight:800;color:#7B2020;font-variant-numeric:tabular-nums;}
  .expense-type-amount::before{content:'LKR ';font-size:13px;color:rgba(11,46,36,0.4);font-weight:700;margin-right:4px;}

  .expense-ov-loading{padding:60px;text-align:center;color:var(--expense-ov-ink-400);font-weight:600;width:100%;grid-column:1/-1;}

  @media(max-width:900px){
    .expense-ov-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .expense-ov-main{padding:20px 24px;}
    .expense-ov-grand-total{flex-direction:column;align-items:flex-start;gap:10px;}
    .expense-ov-grid{padding:24px;grid-template-columns:1fr;}
  }
</style>

<div data-page="accounts" id="Main_Dashboard_04_C">
  <div class="expense-ov-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="expense-ov-topbar">
      <div class="expense-ov-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div class="expense-ov-topbar-actions">
        <button class="expense-ov-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="expense-ov-icon-btn" title="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="expense-ov-main">
      <p class="expense-ov-breadcrumb">
        <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / 
        <a href="javascript:void(0);" onclick="Main_Dashboard_04_A_OPEN()">Income &amp; Expense</a> / 
        <span>Expense Totals by Type</span>
      </p>

      <section class="expense-ov-panel">
        <div class="expense-ov-panel-header">
          <div class="expense-ov-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 3v4M8 3v4M12 12v3M12 17v.5"/></svg>
            Expense Overview
          </div>
          <div class="expense-ov-panel-actions">
            <button type="button" style="display:flex;align-items:center;gap:8px;height:38px;padding:0 16px;border-radius:10px;border:none;cursor:pointer;background:var(--expense-ov-green-800);color:var(--expense-ov-gold-300);font-size:13px;font-weight:700;font-family:inherit;transition:all .3s ease;" onclick="Main_Dashboard_04_A_OPEN()">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
              Income Overview
            </button>
            <button class="expense-ov-add-btn" onclick="Main_Dashboard_04_E_OPEN('expense')">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
              Add Expense
            </button>
            <a class="expense-ov-panel-close" onclick="Main_Dashboard_04_A_OPEN()" title="Back to Overview">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
          </div>
        </div>

        <div class="expense-ov-grand-total">
          <div class="expense-ov-grand-title">Total Processed Expenses</div>
          <div class="expense-ov-grand-amount" id="expense_grand_total_display"><span>LKR</span> 0.00</div>
        </div>

        <div class="expense-ov-toolbar">
          <div class="expense-ov-searchbox">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="text" class="expense-ov-search" id="expense-search" placeholder="Search expense categories by name..." oninput="renderExpenseGrid()" onkeyup="renderExpenseGrid()">
          </div>
        </div>

        <div class="expense-ov-grid" id="expense_type_grid">
          <div class="expense-ov-loading">Loading expense structures...</div>
        </div>
      </section>
    </main>

  </div>

  <?php include 'JS/Main_Dashboard_04_C_JS.php'; ?>
</div>
