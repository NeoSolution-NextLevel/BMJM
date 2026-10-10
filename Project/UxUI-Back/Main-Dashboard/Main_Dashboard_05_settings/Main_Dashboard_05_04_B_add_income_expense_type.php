<?php 
    $pth = "../"; 
    $active_page = "settings"; 
    $page_title = "Add Income / Expense Type · BMJM Admin";
include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  :root{
    --ietype-new-green-950:#0B2E24;
    --ietype-new-green-800:#123832;
    --ietype-new-green-700:#1B4B41;
    --ietype-new-gold-600:#B8923D;
    --ietype-new-gold-500:#C9A227;
    --ietype-new-gold-300:#E4C766;
    --ietype-new-cream-50:#FAF7F0;
    --ietype-new-cream-100:#F2EDE0;
    --ietype-new-white:#FFFFFF;
    --ietype-new-ink-900:#1E2B26;
    --ietype-new-ink-600:#5A6A62;
    --ietype-new-ink-400:#8B978F;
    --ietype-new-border:#E6E0D0;
    --ietype-new-danger:#B0453A;
    --ietype-new-radius-sm:8px;
    --ietype-new-radius-lg:22px;
    --ietype-new-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  .ietype-new-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .ietype-new-topbar{
    grid-area:topbar;
    background:var(--ietype-new-white);
    border-bottom:1px solid var(--ietype-new-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .ietype-new-topbar-heading h1{font-family:'Poppins',sans-serif;font-size:19px;font-weight:600;margin:0;color:var(--ietype-new-green-950);}
  .ietype-new-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--ietype-new-ink-400);}
  .ietype-new-icon-btn{
    width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;
    background:var(--ietype-new-cream-100);color:var(--ietype-new-green-800);border:none;cursor:pointer;
    transition:background .15s ease;
  }
  .ietype-new-icon-btn:hover{background:var(--ietype-new-gold-300);}

  .ietype-new-main{
    grid-area:main;padding:26px 30px 50px;
    display:flex;flex-direction:column;
  }

  .ietype-new-breadcrumb{font-size:12px;color:var(--ietype-new-ink-400);margin-bottom:16px;}
  .ietype-new-breadcrumb a{color:var(--ietype-new-ink-400);text-decoration:none;}
  .ietype-new-breadcrumb a:hover{color:var(--ietype-new-green-700);}
  .ietype-new-breadcrumb span{color:var(--ietype-new-green-700);font-weight:600;}

  .ietype-new-panel-wrapper{
    flex:1;display:flex;align-items:flex-start;justify-content:center;
    padding:8px 0 24px;
  }

  .ietype-new-panel{
    width:100%;max-width:560px;
    background:var(--ietype-new-white);
    border-radius:var(--ietype-new-radius-lg);
    box-shadow:var(--ietype-new-shadow);
    overflow:hidden;
    border:1px solid var(--ietype-new-border);
  }

  .ietype-new-panel-header{
    background:linear-gradient(135deg,var(--ietype-new-green-800),var(--ietype-new-green-950));
    color:var(--ietype-new-cream-50);
    padding:24px 30px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .ietype-new-panel-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',sans-serif;
    font-size:22px;font-weight:600;
  }
  .ietype-new-panel-title svg{width:20px;height:20px;color:var(--ietype-new-gold-300);}

  .ietype-new-panel-close{
    width:32px;height:32px;border-radius:50%;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--ietype-new-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;cursor:pointer;transition:background .15s ease;
  }
  .ietype-new-panel-close:hover{background:rgba(250,247,240,0.12);}

  .ietype-new-body{padding:28px 32px 34px;}

  .ietype-new-field{margin-bottom:22px;}
  .ietype-new-field label{
    display:block;font-size:13px;font-weight:700;
    color:var(--ietype-new-ink-900);margin-bottom:8px;
  }
  .ietype-new-field label span{color:var(--ietype-new-danger);}

  .ietype-new-input, .ietype-new-select{
    width:100%;height:44px;
    border:1px solid var(--ietype-new-border);
    border-radius:var(--ietype-new-radius-sm);
    padding:0 16px;
    font-size:14px;font-family:inherit;
    color:var(--ietype-new-ink-900);background-color:var(--ietype-new-white);
    outline:none;transition:border-color .15s ease,box-shadow .15s ease;
  }
  .ietype-new-select{
    padding-right:40px;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235A6A62' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    cursor:pointer;
  }
  .ietype-new-input:focus, .ietype-new-select:focus{
    border-color:var(--ietype-new-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.15);
  }

  .ietype-new-actions{display:flex;gap:14px;margin-top:28px;}
  .ietype-new-btn{
    flex:1;height:46px;border-radius:var(--ietype-new-radius-sm);
    border:none;cursor:pointer;font-size:13.5px;font-weight:700;
    display:flex;align-items:center;justify-content:center;gap:8px;
    font-family:inherit;transition:all .15s ease;
  }
  .ietype-new-btn-cancel{
    background:var(--ietype-new-white);color:var(--ietype-new-ink-600);
    border:1px solid var(--ietype-new-border);
  }
  .ietype-new-btn-cancel:hover{background:var(--ietype-new-cream-100);color:var(--ietype-new-ink-900);}
  .ietype-new-btn-save{
    background:linear-gradient(135deg,var(--ietype-new-gold-500),var(--ietype-new-gold-600));
    color:var(--ietype-new-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .ietype-new-btn-save:hover{box-shadow:0 6px 16px rgba(184,146,61,0.45);}
  .ietype-new-btn-save:disabled{opacity:0.65;cursor:not-allowed;}

  @media(max-width:900px){
    .ietype-new-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .ietype-new-main{padding:20px 16px;}
  }
</style>

<div data-page="settings" id="Main_Dashboard_05_04_B">
  <div class="ietype-new-app">
    <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

    <header class="ietype-new-topbar">
      <div class="ietype-new-topbar-heading">
        <h1>Dashboard</h1>
        <p>Dashboard Control System</p>
      </div>
      <div class="ietype-new-topbar-actions">
        <button class="ietype-new-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
      </div>
    </header>

    <main class="ietype-new-main">
      <p class="ietype-new-breadcrumb">
        <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> / 
        <a href="javascript:void(0);" onclick="main_dashboard_05_01_OPEN()">Settings</a> / 
        <a href="javascript:void(0);" onclick="main_dashboard_05_04_A_OPEN()">Income / Expense Types</a> / 
        <span id="ietype-breadcrumb-title">Add Type</span>
      </p>

      <div class="ietype-new-panel-wrapper">
        <section class="ietype-new-panel">
          <div class="ietype-new-panel-header">
            <div class="ietype-new-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 18V9l8-5 8 5v9"/><path d="M4 18h16M9 18v-5h6v5"/></svg>
              <span id="ietype-panel-header-title">Add Income / Expense Type</span>
            </div>
            <a class="ietype-new-panel-close" onclick="main_dashboard_05_04_A_OPEN()" title="Close">✕</a>
          </div>

          <div class="ietype-new-body">
            <input type="hidden" id="ietype-id" value="0">

            <div class="ietype-new-field">
              <label for="ietype-name">Category / Type Name <span>*</span></label>
              <input type="text" class="ietype-new-input" id="ietype-name" placeholder="e.g. Staff Salaries, Electricity Bills, Maintenance...">
            </div>

            <div class="ietype-new-field">
              <label for="ietype-category">Classification <span>*</span></label>
              <select class="ietype-new-select" id="ietype-category">
                <option value="expense">Expense (Outflow - Salaries, Bills, Maintenance)</option>
                <option value="income">Income (Inflow - Subscriptions, Zakath, Donations)</option>
                <option value="both">Both (Income &amp; Expense)</option>
              </select>
            </div>

            <div class="ietype-new-actions">
              <button type="button" class="ietype-new-btn ietype-new-btn-cancel" onclick="main_dashboard_05_04_A_OPEN()">Cancel</button>
              <button type="button" class="ietype-new-btn ietype-new-btn-save" id="btn-save-ietype" onclick="submitIncomeExpenseType()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span id="btn-save-ietype-text">Save Type</span>
              </button>
            </div>
          </div>
        </section>
      </div>
    </main>

  </div>
</div>

<script>
  window.settingsIncomeExpenseTypePrepareNew = function() {
    document.getElementById('ietype-id').value = '0';
    document.getElementById('ietype-name').value = '';
    document.getElementById('ietype-category').value = 'expense';
    document.getElementById('ietype-panel-header-title').innerText = 'Add Income / Expense Type';
    document.getElementById('ietype-breadcrumb-title').innerText = 'Add Type';
    document.getElementById('btn-save-ietype-text').innerText = 'Save Type';
  };

  window.settingsIncomeExpenseTypeLoadEdit = function(id, name, category) {
    document.getElementById('ietype-id').value = id;
    document.getElementById('ietype-name').value = name;
    document.getElementById('ietype-category').value = category || 'expense';
    document.getElementById('ietype-panel-header-title').innerText = 'Edit Category / Type';
    document.getElementById('ietype-breadcrumb-title').innerText = 'Edit Type';
    document.getElementById('btn-save-ietype-text').innerText = 'Update Type';
  };

  function submitIncomeExpenseType() {
    const id = document.getElementById('ietype-id').value;
    const name = document.getElementById('ietype-name').value.trim();
    const category = document.getElementById('ietype-category').value;

    if (!name) {
      alert('Please enter a type name.');
      document.getElementById('ietype-name').focus();
      return;
    }

    const saveBtn = document.getElementById('btn-save-ietype');
    saveBtn.disabled = true;

    const formData = new FormData();
    formData.append('type_id', id);
    formData.append('type_name', name);
    formData.append('type_category', category);

    fetch('<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_type_save.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      saveBtn.disabled = false;
      const res = Array.isArray(data) ? data[0] : data;
      if (res && res.error === '0') {
        alert(res.message || 'Saved successfully!');
        if (typeof fetchTypesFromDB === 'function') {
          fetchTypesFromDB();
        }
        if (typeof main_dashboard_05_04_A_OPEN === 'function') {
          main_dashboard_05_04_A_OPEN();
        }
      } else {
        alert('Error: ' + (res ? res.message : 'Unknown error'));
      }
    })
    .catch(err => {
      saveBtn.disabled = false;
      alert('Connection error occurred.');
      console.error(err);
    });
  }
</script>
