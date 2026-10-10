<?php 
    $pth = "../"; 
    $active_page = "accounts";
    $page_title = "Add Expense / Income · BMJM Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  :root{
    --add-tx-green-950:#0B2E24;
    --add-tx-green-800:#123832;
    --add-tx-green-700:#1B4B41;
    --add-tx-gold-600:#B8923D;
    --add-tx-gold-500:#C9A227;
    --add-tx-gold-300:#E4C766;
    --add-tx-cream-50:#FAF7F0;
    --add-tx-cream-100:#F2EDE0;
    --add-tx-white:#FFFFFF;
    --add-tx-ink-900:#1E2B26;
    --add-tx-ink-600:#5A6A62;
    --add-tx-ink-400:#8B978F;
    --add-tx-border:#E6E0D0;
    --add-tx-danger:#C0392B;
    --add-tx-radius-sm:8px;
    --add-tx-radius-lg:22px;
    --add-tx-shadow:0 12px 32px rgba(11,46,36,0.06);
    --add-tx-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;background:var(--add-tx-cream-50);font-family:'Inter',sans-serif;color:var(--add-tx-ink-900);}

  .add-tx-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .add-tx-topbar{
    grid-area:topbar;
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(230,224,208,0.6);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
    z-index:10;
  }
  .add-tx-topbar-heading h1{font-family:'Poppins',sans-serif;font-size:19px;font-weight:600;margin:0;color:var(--add-tx-green-950);}
  .add-tx-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--add-tx-ink-400);}
  .add-tx-icon-btn{
    width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;
    background:var(--add-tx-cream-100);color:var(--add-tx-green-800);border:none;cursor:pointer;
    transition:all .3s ease;margin-left:12px;
  }
  .add-tx-icon-btn:hover{background:var(--add-tx-gold-300);transform:translateY(-2px);color:var(--add-tx-green-950);}

  .add-tx-main{
    grid-area:main;
    padding:26px 30px 50px;
    display:flex;flex-direction:column;
    animation:fadeSlideUp 0.6s var(--add-tx-cubic) forwards;
  }

  .add-tx-breadcrumb{font-size:12px;color:var(--add-tx-ink-400);margin-bottom:16px;}
  .add-tx-breadcrumb a{color:var(--add-tx-ink-400);text-decoration:none;transition:color .2s;}
  .add-tx-breadcrumb a:hover{color:var(--add-tx-green-700);}
  .add-tx-breadcrumb span{color:var(--add-tx-green-700);font-weight:600;}

  .add-tx-panel-wrapper{
    flex:1;display:flex;align-items:flex-start;justify-content:center;
    padding:8px 0 24px;
  }

  .add-tx-panel{
    width:100%;max-width:620px;
    background:var(--add-tx-white);
    border-radius:18px;
    box-shadow:var(--add-tx-shadow);
    overflow:hidden;
    border:1px solid var(--add-tx-border);
  }

  .add-tx-panel-header{
    background:linear-gradient(135deg,#4A1515,#7B2020);
    color:var(--add-tx-cream-50);
    padding:22px 28px;
    display:flex;align-items:center;justify-content:space-between;
  }

  .add-tx-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',sans-serif;
    font-size:20px;font-weight:600;
  }
  .add-tx-panel-title svg{width:22px;height:22px;color:var(--add-tx-gold-300);}

  .add-tx-panel-close{
    width:32px;height:32px;border-radius:50%;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--add-tx-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;cursor:pointer;transition:all .3s ease;
  }
  .add-tx-panel-close:hover{background:rgba(250,247,240,0.15);transform:rotate(90deg);}

  .add-tx-body{padding:28px 32px 34px;}

  .add-tx-form-group{margin-bottom:20px;}
  .add-tx-label{
    display:block;font-size:13px;font-weight:700;
    color:var(--add-tx-ink-900);margin-bottom:8px;
  }
  .add-tx-label span{color:var(--add-tx-danger);}

  .add-tx-input, .add-tx-select, .add-tx-textarea{
    width:100%;height:46px;
    border:1px solid var(--add-tx-border);
    border-radius:var(--add-tx-radius-sm);
    padding:0 16px;
    font-size:14px;font-family:inherit;
    color:var(--add-tx-ink-900);background-color:var(--add-tx-white);
    outline:none;transition:border-color .15s ease,box-shadow .15s ease;
  }
  .add-tx-select{
    padding-right:40px;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    cursor:pointer;
  }
  .add-tx-input:focus, .add-tx-select:focus, .add-tx-textarea:focus{
    border-color:var(--add-tx-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.15);
  }
  .add-tx-textarea{
    height:80px;padding:12px 16px;resize:vertical;
  }

  .add-tx-currency-wrap{position:relative;}
  .add-tx-currency-tag{
    position:absolute;left:14px;top:13px;
    font-weight:700;font-size:13px;color:var(--add-tx-ink-600);
    pointer-events:none;
  }
  .add-tx-currency-input{padding-left:55px;font-weight:700;font-size:16px;}

  .add-tx-actions{display:flex;gap:14px;margin-top:28px;}
  .add-tx-btn{
    flex:1;height:48px;border-radius:var(--add-tx-radius-sm);
    border:none;cursor:pointer;font-size:14px;font-weight:700;
    display:flex;align-items:center;justify-content:center;gap:8px;
    font-family:inherit;transition:all .2s ease;
  }
  .add-tx-btn-cancel{
    background:var(--add-tx-white);color:var(--add-tx-ink-600);
    border:1px solid var(--add-tx-border);
  }
  .add-tx-btn-cancel:hover{background:var(--add-tx-cream-100);color:var(--add-tx-ink-900);}
  .add-tx-btn-save{
    background:linear-gradient(135deg,var(--add-tx-gold-500),var(--add-tx-gold-600));
    color:var(--add-tx-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .add-tx-btn-save:hover{
    box-shadow:0 6px 16px rgba(184,146,61,0.45);
    transform:translateY(-1px);
  }
  .add-tx-btn-save:disabled{opacity:0.65;cursor:not-allowed;}

  @media(max-width:900px){
    .add-tx-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .add-tx-main{padding:20px 16px;}
  }
</style>

<div data-page="accounts" id="Main_Dashboard_04_E">
  <div class="add-tx-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="add-tx-topbar">
      <div class="add-tx-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div style="display:flex;">
        <button class="add-tx-icon-btn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg></button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="add-tx-main">
      <p class="add-tx-breadcrumb">
        <a href="javascript:void(0);" onclick="Main_Dashboard_04_C_OPEN()">Expense Overview</a> / 
        <span>Add Expense</span>
      </p>

      <div class="add-tx-panel-wrapper">
        <section class="add-tx-panel">
          <div class="add-tx-panel-header" id="add-tx-header">
            <div class="add-tx-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 3v4M8 3v4M12 12v3M12 17v.5"/></svg>
              <span>Record Expense</span>
            </div>
            <a class="add-tx-panel-close" onclick="cancelAddTransaction()" title="Close">✕</a>
          </div>

          <div class="add-tx-body">
            <!-- Category Selector -->
            <div class="add-tx-form-group">
              <label class="add-tx-label" for="add-tx-category">Expense Category <span>*</span></label>
              <select class="add-tx-select" id="add-tx-category">
                <option value="">-- Select Expense Category --</option>
              </select>
            </div>

            <!-- Amount Input -->
            <div class="add-tx-form-group">
              <label class="add-tx-label" for="add-tx-amount">Amount <span>*</span></label>
              <div class="add-tx-currency-wrap">
                <span class="add-tx-currency-tag">LKR</span>
                <input type="number" class="add-tx-input add-tx-currency-input" id="add-tx-amount" min="0.01" step="0.01" placeholder="0.00">
              </div>
            </div>

            <!-- Date -->
            <div class="add-tx-form-group">
              <label class="add-tx-label" for="add-tx-date">Date of Document / Payment <span>*</span></label>
              <input type="date" class="add-tx-input" id="add-tx-date">
            </div>

            <!-- Description / Reference -->
            <div class="add-tx-form-group">
              <label class="add-tx-label" for="add-tx-dis">Description / Voucher / Notes <span>*</span></label>
              <textarea class="add-tx-textarea" id="add-tx-dis" placeholder="e.g. Staff Salary for Staff Name, CEB Electricity Bill for Mosque Main Hall, etc."></textarea>
            </div>

            <div class="add-tx-actions">
              <button type="button" class="add-tx-btn add-tx-btn-cancel" onclick="cancelAddTransaction()">Cancel</button>
              <button type="button" class="add-tx-btn add-tx-btn-save" id="btn-save-tx" onclick="submitTransaction()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Save Expense
              </button>
            </div>

          </div>
        </section>
      </div>

    </main>
  </div>

  <?php include 'JS/Main_Dashboard_04_E_JS.php'; ?>
</div>
