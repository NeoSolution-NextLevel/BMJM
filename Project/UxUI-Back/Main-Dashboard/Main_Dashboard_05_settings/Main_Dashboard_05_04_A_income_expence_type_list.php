<?php 
    $pth = "../"; 
    $active_page = "settings-income-expense-type"; // Tells the sidebar to highlight this tab
    $page_title = "Income Expence Type · bmjm Admin";
include '../UxUI-Back/Includes/header.php';
?>

<style>
  :root{
    --settings-income-expense-type-green-950:#0B2E24;
    --settings-income-expense-type-green-800:#123832;
    --settings-income-expense-type-green-700:#1B4B41;
    --settings-income-expense-type-gold-600:#B8923D;
    --settings-income-expense-type-gold-500:#C9A227;
    --settings-income-expense-type-gold-300:#E4C766;
    --settings-income-expense-type-cream-50:#FAF7F0;
    --settings-income-expense-type-cream-100:#F2EDE0;
    --settings-income-expense-type-white:#FFFFFF;
    --settings-income-expense-type-ink-900:#1E2B26;
    --settings-income-expense-type-ink-600:#5A6A62;
    --settings-income-expense-type-ink-400:#8B978F;
    --settings-income-expense-type-border:#E6E0D0;
    --settings-income-expense-type-danger:#B0453A;
    --settings-income-expense-type-radius-sm:8px;
    --settings-income-expense-type-radius-lg:22px;
    --settings-income-expense-type-shadow:0 6px 24px rgba(11,46,36,0.08);
    --settings-income-expense-type-shadow-sm:0 2px 8px rgba(11,46,36,0.06);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--settings-income-expense-type-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--settings-income-expense-type-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px;
  }

  .settings-income-expense-type-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .settings-income-expense-type-topbar{
    grid-area:topbar;
    background:var(--settings-income-expense-type-white);
    border-bottom:1px solid var(--settings-income-expense-type-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .settings-income-expense-type-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--settings-income-expense-type-green-950);
  }
  .settings-income-expense-type-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--settings-income-expense-type-ink-400);}
  .settings-income-expense-type-topbar-actions{display:flex;align-items:center;gap:18px;}
  .settings-income-expense-type-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--settings-income-expense-type-cream-100);color:var(--settings-income-expense-type-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .settings-income-expense-type-icon-btn:hover{background:var(--settings-income-expense-type-gold-300);}
  .settings-income-expense-type-icon-btn svg{width:16px;height:16px;}

  .settings-income-expense-type-breadcrumb{font-size:12px;color:var(--settings-income-expense-type-ink-400);margin-bottom:16px;}
  .settings-income-expense-type-breadcrumb a{color:var(--settings-income-expense-type-ink-400);text-decoration:none;}
  .settings-income-expense-type-breadcrumb a:hover{color:var(--settings-income-expense-type-green-700);}
  .settings-income-expense-type-breadcrumb span{color:var(--settings-income-expense-type-green-700);font-weight:600;}

  .settings-income-expense-type-panel-header{
    background:linear-gradient(135deg,var(--settings-income-expense-type-green-800),var(--settings-income-expense-type-green-950));
    color:var(--settings-income-expense-type-cream-50);
    padding:18px 24px;
    display:flex;align-items:center;justify-content:space-between;
    position:relative;overflow:hidden;
  }
  .settings-income-expense-type-panel-header::before{
    content:'';position:absolute;right:40px;top:-80px;
    width:220px;height:220px;border-radius:50%;
    background:var(--settings-income-expense-type-gold-500);filter:blur(50px);opacity:0.15;
    pointer-events:none;
  }
  .settings-income-expense-type-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:20px;font-weight:700;
    position:relative;z-index:2;
  }
  .settings-income-expense-type-panel-title svg{width:22px;height:22px;flex:0 0 22px;color:var(--settings-income-expense-type-gold-300);}
  .settings-income-expense-type-panel-close{
    width:34px;height:34px;border-radius:50%;flex:0 0 34px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--settings-income-expense-type-cream-50);
    display:flex;align-items:center;justify-content:center;
    padding:0;
    font:inherit;
    text-decoration:none;
    cursor:pointer;transition:all .25s ease;
    position:relative;z-index:2;
  }
  .settings-income-expense-type-panel-close svg{width:18px;height:18px;}
  .settings-income-expense-type-panel-close:hover{background:rgba(250,247,240,0.15);transform:rotate(90deg);}

  .settings-income-expense-type-btn{
    height:42px;padding:0 22px;
    border-radius:var(--settings-income-expense-type-radius-sm);
    border:none;cursor:pointer;
    font-size:13px;font-weight:700;letter-spacing:0.01em;
    display:inline-flex;align-items:center;gap:8px;
    white-space:nowrap;
    text-decoration:none;
    align-self:flex-end;
    transition:background .15s ease, box-shadow .15s ease, transform .1s ease, color .15s ease;
  }
  .settings-income-expense-type-btn:active{transform:translateY(1px);}
  .settings-income-expense-type-btn-primary{
    background:linear-gradient(135deg,var(--settings-income-expense-type-gold-500),var(--settings-income-expense-type-gold-600));
    color:var(--settings-income-expense-type-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .settings-income-expense-type-btn-primary:hover{box-shadow:0 6px 16px rgba(184,146,61,0.45);}
  .settings-income-expense-type-btn-ghost{
    background:var(--settings-income-expense-type-cream-100);
    color:var(--settings-income-expense-type-ink-900);
  }
  .settings-income-expense-type-btn-ghost:hover{background:var(--settings-income-expense-type-border);}

  @media (max-width:900px){
    .settings-income-expense-type-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
  }

  .settings-income-expense-type-main{grid-area:main;padding:16px 30px 40px;}

  .settings-income-expense-type-panel{
    background:var(--settings-income-expense-type-white);
    border-radius:var(--settings-income-expense-type-radius-lg);
    box-shadow:var(--settings-income-expense-type-shadow);
    overflow:hidden;
    border:1px solid var(--settings-income-expense-type-border);
  }

  .settings-income-expense-type-toolbar{
    display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;
    padding:16px 24px;
    background:rgba(250,247,240,0.5);
    border-bottom:1px solid var(--settings-income-expense-type-border);
  }
  .settings-income-expense-type-field{display:flex;flex-direction:column;gap:5px;}
  .settings-income-expense-type-field-search{flex:1;min-width:220px;max-width:320px;}
  .settings-income-expense-type-field label{
    font-size:11.5px;font-weight:700;
    color:var(--settings-income-expense-type-ink-900);
    text-transform:uppercase;letter-spacing:0.04em;
  }

  .settings-income-expense-type-search{
    width:100%;
    height:42px;
    min-height:42px;
    border:1px solid var(--settings-income-expense-type-border);
    border-radius:var(--settings-income-expense-type-radius-sm);
    padding:0 14px 0 36px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--settings-income-expense-type-ink-900);
    background-color:var(--settings-income-expense-type-white);
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='%238B978F' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.3-4.3'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:left 12px center;
    outline:none;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
  .settings-income-expense-type-search::placeholder{color:var(--settings-income-expense-type-ink-400);}
  .settings-income-expense-type-search:focus{
    border-color:var(--settings-income-expense-type-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.12);
  }

  .settings-income-expense-type-select{
    height:42px;min-width:170px;
    border:1px solid var(--settings-income-expense-type-border);
    border-radius:var(--settings-income-expense-type-radius-sm);
    padding:0 38px 0 14px;
    font-size:13.5px;
    font-family:inherit;
    color:var(--settings-income-expense-type-ink-900);
    background-color:var(--settings-income-expense-type-white);
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 12px center;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    outline:none;cursor:pointer;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
  .settings-income-expense-type-select:focus{
    border-color:var(--settings-income-expense-type-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.12);
  }

  .settings-income-expense-type-badge{
    height:42px;padding:0 20px;
    border-radius:var(--settings-income-expense-type-radius-sm);
    background:var(--settings-income-expense-type-cream-100);
    color:var(--settings-income-expense-type-ink-900);
    display:flex;align-items:center;gap:6px;
    font-size:13px;font-weight:800;
    white-space:nowrap;
  }
  .settings-income-expense-type-badge span{color:var(--settings-income-expense-type-green-700);}

  .settings-income-expense-type-toolbar-row2{
    display:flex;justify-content:flex-end;
    padding:14px 30px 4px;
  }
  .settings-income-expense-type-perpage{
    height:36px;min-width:110px;
    border:1px solid var(--settings-income-expense-type-border);
    border-radius:var(--settings-income-expense-type-radius-sm);
    padding:0 34px 0 12px;
    font-size:12.5px;font-family:inherit;
    color:var(--settings-income-expense-type-ink-900);
    background-color:var(--settings-income-expense-type-white);
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 10px center;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    outline:none;cursor:pointer;
  }

  .settings-income-expense-type-list{
    display:flex;flex-direction:column;
    padding:20px 24px 26px;
    gap:10px;
  }
  .settings-income-expense-type-row{
    display:flex;align-items:center;justify-content:space-between;
    padding:14px 18px;
    background:var(--settings-income-expense-type-cream-50);
    border:1px solid var(--settings-income-expense-type-border);
    border-radius:var(--settings-income-expense-type-radius-sm);
    transition:border-color .15s ease, background .15s ease, box-shadow .15s ease;
  }
  .settings-income-expense-type-row:hover{
    border-color:var(--settings-income-expense-type-gold-500);
    background:var(--settings-income-expense-type-white);
    box-shadow:var(--settings-income-expense-type-shadow-sm);
  }
  .settings-income-expense-type-row-info{display:flex;flex-direction:column;gap:2px;}
  .settings-income-expense-type-row-name{font-size:14px;font-weight:700;color:var(--settings-income-expense-type-ink-900);}
  .settings-income-expense-type-row-sub{font-size:12px;color:var(--settings-income-expense-type-ink-600);}
  .settings-income-expense-type-row-actions{display:flex;align-items:center;gap:10px;}
  .settings-income-expense-type-tag{
    display:inline-block;
    font-size:11px;font-weight:700;letter-spacing:0.03em;
    padding:4px 11px;border-radius:999px;
    background:var(--settings-income-expense-type-cream-100);
    color:var(--settings-income-expense-type-green-700);
  }
  .settings-income-expense-type-tag.is-income{
    background:rgba(27,122,74,0.12);
    color:#1B7A4A;
  }
  .settings-income-expense-type-tag.is-expense{
    background:rgba(176,69,58,0.12);
    color:var(--settings-income-expense-type-danger);
  }
  .settings-income-expense-type-row-btn{
    height:34px;padding:0 16px;
    border-radius:var(--settings-income-expense-type-radius-sm);
    border:1px solid var(--settings-income-expense-type-green-700);
    background:var(--settings-income-expense-type-white);
    color:var(--settings-income-expense-type-green-700);
    font-size:12px;font-weight:700;letter-spacing:0.01em;
    cursor:pointer;
    transition:background .15s ease,color .15s ease,border-color .15s ease;
  }
  .settings-income-expense-type-row-btn:hover{background:var(--settings-income-expense-type-green-800);color:var(--settings-income-expense-type-cream-50);}
  .settings-income-expense-type-row-btn-danger{
    border-color:rgba(176,69,58,0.45);
    color:var(--settings-income-expense-type-danger);
  }
  .settings-income-expense-type-row-btn-danger:hover{
    background:var(--settings-income-expense-type-danger);
    border-color:var(--settings-income-expense-type-danger);
    color:var(--settings-income-expense-type-white);
  }

  .settings-income-expense-type-empty{padding:40px 18px;text-align:center;color:var(--settings-income-expense-type-ink-400);font-size:13.5px;}

  @media (max-width:900px){
    .settings-income-expense-type-toolbar{flex-direction:column;align-items:stretch;}
    .settings-income-expense-type-field-search{max-width:none;}
    .settings-income-expense-type-btn{align-self:stretch;justify-content:center;}
  }

</style>

<div data-page="settings" id="Main_Dashboard_05_04_A">

<div class="settings-income-expense-type-app">

     <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  

  <!-- ================= TOPBAR ================= -->
  <header class="settings-income-expense-type-topbar">
    <div class="settings-income-expense-type-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="settings-income-expense-type-topbar-actions">
      <button class="settings-income-expense-type-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="settings-income-expense-type-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="settings-income-expense-type-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="settings-income-expense-type-main">
    <p class="settings-income-expense-type-breadcrumb">
      <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> /
      <a href="javascript:void(0);" onclick="main_dashboard_05_01_OPEN()">Settings</a> /
      <span>Income Expence Type</span>
    </p>

    <section class="settings-income-expense-type-panel" aria-label="Income Expence Type">

      <div class="settings-income-expense-type-panel-header">
        <div class="settings-income-expense-type-panel-title">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 18V9l8-5 8 5v9"/><path d="M4 18h16M9 18v-5h6v5"/></svg>
          Income Expence Type
        </div>
        <button type="button" class="settings-income-expense-type-panel-close" onclick="settingsIncomeExpenseTypeClose()" title="Close" aria-label="Close">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>

      <div class="settings-income-expense-type-toolbar">
        <div class="settings-income-expense-type-field settings-income-expense-type-field-search">
          <label for="settings-income-expense-type-search">Search From Name</label>
          <input type="text" class="settings-income-expense-type-search" id="settings-income-expense-type-search"
                 placeholder="Search name..." oninput="settings_income_expense_typeRender()">
        </div>
        <div class="settings-income-expense-type-field">
          <label for="settings-income-expense-type-type">Select Type</label>
          <select class="settings-income-expense-type-select" id="settings-income-expense-type-type" onchange="fetchTypesFromDB()">
            <option value="all">All</option>
            <option value="income">Income</option>
            <option value="expense">Expenses</option>
          </select>
        </div>
        <button type="button"
                class="settings-income-expense-type-btn settings-income-expense-type-btn-primary"
                onclick="main_dashboard_05_04_B_OPEN ? main_dashboard_05_04_B_OPEN() : history.back()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
          Add New
        </button>
      </div>

      <div class="settings-income-expense-type-list" id="settings-income-expense-type-list"></div>
      <div class="settings-income-expense-type-empty" id="settings-income-expense-type-empty" style="display:none;">No types match this search.</div>


    </section>

  </main>

</div>

<script>
  function settingsIncomeExpenseTypeClose() {
    if (typeof main_dashboard_05_01_OPEN === 'function') {
      main_dashboard_05_01_OPEN();
      return;
    }
    window.location.href = "<?php echo $pth; ?>UxUi/Main-Dashboard.php";
  }

  let _sitTypeCache = [];   // holds last successful fetch

  function fetchTypesFromDB() {
    const typeFilter = document.getElementById('settings-income-expense-type-type').value;
    const list  = document.getElementById('settings-income-expense-type-list');
    const empty = document.getElementById('settings-income-expense-type-empty');

    // Show a subtle loading state
    list.innerHTML = '<div class="settings-income-expense-type-empty">Loading…</div>';
    empty.style.display = 'none';

    const formData = new FormData();
    formData.append('type_filter', typeFilter);

    fetch('<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_type_list.php', {
      method : 'POST',
      body   : formData
    })
    .then(res => {
      if (!res.ok) throw new Error('Network response was not ok (' + res.status + ')');
      return res.json();
    })
    .then(data => {
      _sitTypeCache = Array.isArray(data) ? data : [];
      settings_income_expense_typeRender();
    })
    .catch(err => {
      list.innerHTML = '';
      empty.textContent = 'Failed to load types. Please try again.';
      empty.style.display = 'block';
      console.error('[Income/Expense Type] fetch error:', err);
    });
  }

  function settings_income_expense_typeRender() {
    const q    = document.getElementById('settings-income-expense-type-search').value.trim().toLowerCase();
    const list  = document.getElementById('settings-income-expense-type-list');
    const empty = document.getElementById('settings-income-expense-type-empty');

    const rows = _sitTypeCache.filter(r => {
      const name = (r.name || r.income_expence_type_name || '').toLowerCase();
      return !q || name.includes(q);
    });

    if (rows.length === 0) {
      list.innerHTML = '';
      empty.textContent = 'No types match this search.';
      empty.style.display = 'block';
      return;
    }
    empty.style.display = 'none';

    list.innerHTML = rows.map(r => {
      const typeName = r.name || r.income_expence_type_name || '';
      let categoryLabel = '';
      let categoryKey = r.type || '';
      let tagClass = '';
      if (r.is_income_type == 1 && r.is_expece_type == 1) {
        categoryLabel = 'Income &amp; Expense';
        categoryKey = 'both';
      } else if (r.is_income_type == 1) {
        categoryLabel = 'Income';
        categoryKey = 'income';
        tagClass = 'is-income';
      } else if (r.is_expece_type == 1) {
        categoryLabel = 'Expense';
        categoryKey = 'expense';
        tagClass = 'is-expense';
      } else {
        categoryLabel = 'Other';
        categoryKey = 'expense';
      }

      const safeName = String(typeName).replace(/'/g, "\\'");
      const id       = Number(r.id);

      return `<div class="settings-income-expense-type-row">
        <div class="settings-income-expense-type-row-info">
          <span class="settings-income-expense-type-row-name">${typeName}</span>
        </div>
        <div class="settings-income-expense-type-row-actions">
          <span class="settings-income-expense-type-tag ${tagClass}">${categoryLabel}</span>
          <button class="settings-income-expense-type-row-btn"
                  onclick="settings_income_expense_typeEdit(${id}, '${safeName}', '${categoryKey}')">Edit</button>
          <button class="settings-income-expense-type-row-btn settings-income-expense-type-row-btn-danger"
                  onclick="settings_income_expense_typeDelete(${id}, '${safeName}')">Remove</button>
        </div>
      </div>`;
    }).join('');
  }

  function settings_income_expense_typeEdit(id, name, category) {
    if (typeof main_dashboard_05_04_B_OPEN === 'function') {
      main_dashboard_05_04_B_OPEN(id, name, category);
    }
  }

  function settings_income_expense_typeDelete(id, name) {
    if (!confirm('Are you sure you want to remove "' + name + '"?')) {
      return;
    }

    const formData = new FormData();
    formData.append('type_id', id);

    fetch('<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_type_delete.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      const res = Array.isArray(data) ? data[0] : data;
      if (res && res.error === '0') {
        fetchTypesFromDB();
      } else {
        alert('Failed to remove: ' + (res ? res.message : 'Unknown error'));
      }
    })
    .catch(err => {
      alert('Connection error occurred.');
      console.error(err);
    });
  }

  window.fetchTypesFromDB = fetchTypesFromDB;

  document.addEventListener('DOMContentLoaded', function () {
    fetchTypesFromDB();

    document.getElementById('settings-income-expense-type-type')
      .addEventListener('change', fetchTypesFromDB);

    document.getElementById('settings-income-expense-type-search')
      .addEventListener('input', settings_income_expense_typeRender);
  });
</script>

<div id="bmjm-footer-root"></div>
<script src="footer-loader.js"></script>

</div>
