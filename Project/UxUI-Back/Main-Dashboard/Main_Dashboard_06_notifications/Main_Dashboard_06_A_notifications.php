<?php
if (!isset($pth) || $pth === '') {
    $pth = "../";
}
$active_page = "notifications";
$page_title = "Notifications - bmjm Admin";
?>

<style>
  :root{
    --notify-green-950:#0B2E24;
    --notify-green-800:#123832;
    --notify-green-700:#1B4B41;
    --notify-gold-600:#B8923D;
    --notify-gold-500:#C9A227;
    --notify-gold-300:#E4C766;
    --notify-gold-50:#FCF8E8;
    --notify-cream-50:#FAF7F0;
    --notify-cream-100:#F2EDE0;
    --notify-white:#FFFFFF;
    --notify-ink-900:#1E2B26;
    --notify-ink-600:#5A6A62;
    --notify-ink-400:#8B978F;
    --notify-border:#E6E0D0;
    --notify-danger:#B91C1C;
    --notify-radius-sm:8px;
    --notify-radius-lg:18px;
    --notify-shadow:0 8px 26px rgba(11,46,36,0.08);
  }

  .notify-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:"sidebar topbar" "sidebar main";
    background:var(--notify-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--notify-ink-900);
    width:100%;
    min-width:0;
  }
  .notify-app.is-standalone{
    grid-template-columns:1fr;
    grid-template-areas:"topbar" "main";
  }
  .notify-topbar{
    grid-area:topbar;
    background:var(--notify-white);
    border-bottom:1px solid var(--notify-border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
  }
  .notify-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;
    font-weight:600;
    color:var(--notify-green-950);
    margin:0;
  }
  .notify-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--notify-ink-400);}
  .notify-main{grid-area:main;padding:28px 32px 44px;min-width:0;overflow-x:hidden;}
  .notify-breadcrumb{
    font-size:12px;
    color:var(--notify-ink-400);
    margin:0 0 16px;
  }
  .notify-breadcrumb a{color:var(--notify-ink-400);text-decoration:none;}
  .notify-breadcrumb a:hover{color:var(--notify-green-700);}
  .notify-breadcrumb span{color:var(--notify-green-700);font-weight:600;}
  .notify-panel{
    background:var(--notify-white);
    border:1px solid var(--notify-border);
    border-radius:var(--notify-radius-lg);
    box-shadow:var(--notify-shadow);
    overflow:hidden;
    min-width:0;
  }
  .notify-panel-header{
    background:linear-gradient(135deg,var(--notify-green-800),var(--notify-green-950));
    color:var(--notify-cream-50);
    padding:20px 24px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
  }
  .notify-panel-header-row{
    width:100%;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
  }
  .notify-panel-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:18px;
    font-weight:700;
  }
  .notify-panel-title svg{width:19px;height:19px;color:var(--notify-gold-300);}
  .notify-panel-close{
    width:32px;
    height:32px;
    border-radius:50%;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;
    color:var(--notify-cream-50);
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    cursor:pointer;
    transition:background .15s ease;
  }
  .notify-panel-close:hover{background:rgba(250,247,240,0.12);}
  .notify-panel-body{padding:22px 24px;}
  .notify-list-body{padding:0;}
  .notify-field{display:flex;flex-direction:column;gap:7px;margin-bottom:16px;}
  .notify-field label{font-size:12.5px;font-weight:800;color:var(--notify-green-950);}
  .notify-field input,
  .notify-field select,
  .notify-field textarea{
    width:100%;
    border:1px solid var(--notify-border);
    border-radius:var(--notify-radius-sm);
    background:var(--notify-white);
    color:var(--notify-ink-900);
    font:inherit;
    font-size:13.5px;
    outline:none;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
  .notify-field input,
  .notify-field select{height:42px;padding:0 12px;}
  .notify-field textarea{min-height:110px;resize:vertical;padding:12px;}
  .notify-field input:focus,
  .notify-field select:focus,
  .notify-field textarea:focus{
    border-color:var(--notify-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.14);
  }
  .notify-mini-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
  .notify-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:6px;}
  .notify-btn{
    min-height:42px;
    border-radius:var(--notify-radius-sm);
    border:1px solid transparent;
    padding:0 16px;
    font-size:13px;
    font-weight:800;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
  }
  .notify-btn-primary{
    color:var(--notify-green-950);
    background:linear-gradient(135deg,var(--notify-gold-300),var(--notify-gold-600));
    box-shadow:0 4px 13px rgba(184,146,61,0.28);
  }
  .notify-btn-ghost{
    color:var(--notify-green-800);
    background:var(--notify-cream-50);
    border-color:var(--notify-border);
  }
  .notify-toast{
    display:none;
    padding:12px 14px;
    margin:0 0 16px;
    border-radius:var(--notify-radius-sm);
    font-size:13px;
    font-weight:700;
  }
  .notify-toast.success{background:#E6F4EA;color:#1E4620;border:1px solid #CEE8D6;}
  .notify-toast.warning{background:#FFF4D6;color:#8A5A00;border:1px solid #F2D48A;}
  .notify-toast.error{background:#FCE8E6;color:#A50E0E;border:1px solid #F6CFCB;}
  .notify-main > .notify-toast{margin:0 0 16px;}

  .notify-list-toolbar{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:14px;
    margin-bottom:0;
    padding:22px 30px 24px;
    flex-wrap:wrap;
  }
  .notify-search{
    flex:1;
    min-width:260px;
    max-width:520px;
  }
  .notify-filter-bar{
    flex:1 1 680px;
    display:grid;
    grid-template-columns:minmax(260px, 1.6fr) minmax(170px, .7fr) minmax(170px, .7fr);
    gap:12px;
    align-items:end;
  }
  .notify-filter-field{
    display:flex;
    flex-direction:column;
    gap:6px;
    min-width:0;
  }
  .notify-search label{
    display:block;
    margin-bottom:6px;
    color:var(--notify-ink-600);
    font-size:12.5px;
    font-weight:700;
  }
  .notify-search input{
    width:100%;
    height:42px;
    border:1px solid var(--notify-border);
    border-radius:var(--notify-radius-sm);
    background:var(--notify-white);
    color:var(--notify-ink-900);
    font:inherit;
    font-size:13.5px;
    outline:none;
    padding:0 13px;
  }
  .notify-search input:focus{
    border-color:var(--notify-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.14);
  }
  .notify-filter-field label{
    color:var(--notify-ink-600);
    font-size:12.5px;
    font-weight:700;
  }
  .notify-filter-field select{
    width:100%;
    height:42px;
    border:1px solid var(--notify-border);
    border-radius:var(--notify-radius-sm);
    background:var(--notify-white);
    color:var(--notify-ink-900);
    font:inherit;
    font-size:13.5px;
    outline:none;
    padding:0 12px;
    cursor:pointer;
  }
  .notify-filter-field select:focus{
    border-color:var(--notify-gold-500);
    box-shadow:0 0 0 3px rgba(201,162,39,0.14);
  }
  .notify-result-count{
    color:var(--notify-ink-600);
    font-size:12px;
    font-weight:600;
    margin:4px 0 0;
  }
  .notify-table-tools{display:flex;align-items:center;gap:10px;flex-wrap:wrap;}
  .notify-table-wrap{overflow-x:auto;padding:0 30px 8px;}
  .notify-table{width:100%;border-collapse:collapse;min-width:720px;}
  .notify-table th{
    text-align:left;
    color:var(--notify-ink-600);
    font-size:11px;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:0;
    padding:0 12px 11px;
    border-bottom:1px solid var(--notify-border);
  }
  .notify-table td{
    padding:14px 12px;
    border-bottom:1px solid var(--notify-cream-100);
    font-size:13px;
    vertical-align:top;
  }
  .notify-title-cell{font-weight:800;color:var(--notify-green-950);}
  .notify-muted{color:var(--notify-ink-400);font-size:12px;margin-top:4px;}
  .notify-message-cell{
    display:flex;
    align-items:flex-start;
    gap:12px;
    min-width:0;
  }
  .notify-message-copy{min-width:0;}
  .notify-pill{
    display:inline-flex;
    align-items:center;
    min-height:28px;
    border-radius:999px;
    padding:0 10px;
    background:var(--notify-cream-100);
    color:var(--notify-green-800);
    font-size:12px;
    font-weight:900;
    white-space:nowrap;
  }
  .notify-target-number{font-size:15px;font-weight:900;color:var(--notify-green-950);}
  .notify-date{color:var(--notify-ink-600);font-weight:700;white-space:nowrap;}
  .notify-empty{
    display:none;
    text-align:center;
    padding:42px 18px;
    color:var(--notify-ink-400);
    font-size:13.5px;
    border-top:1px solid var(--notify-cream-100);
  }
  .notify-empty strong{
    display:block;
    color:var(--notify-green-950);
    font-size:15px;
    margin-bottom:5px;
  }
  .notify-view{display:none;}
  .notify-view.is-active{display:block;}
  .notify-footer-field{
    display:flex;
    flex-direction:column;
    gap:6px;
  }
  .notify-footer-field label{
    color:var(--notify-ink-600);
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
  }
  .notify-footer-field select{
    height:42px;
    border:1px solid var(--notify-border);
    border-radius:var(--notify-radius-sm);
    background:var(--notify-white);
    padding:0 10px;
    font-size:13px;
    color:var(--notify-ink-900);
    min-width:130px;
    cursor:pointer;
  }
  .notify-upload{
    border:1px dashed var(--notify-border);
    border-radius:var(--notify-radius-sm);
    padding:16px;
    background:var(--notify-cream-50);
  }
  .notify-upload input[type="file"]{
    position:absolute;
    width:1px;
    height:1px;
    overflow:hidden;
    clip:rect(0 0 0 0);
  }
  .notify-upload-control{
    display:flex;
    align-items:center;
    gap:12px;
    min-height:44px;
  }
  .notify-upload-button{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:38px;
    padding:0 16px;
    border-radius:var(--notify-radius-sm);
    border:1px solid var(--notify-gold-500);
    background:var(--notify-white);
    color:var(--notify-green-950);
    font-size:13px;
    font-weight:800;
    cursor:pointer;
    white-space:nowrap;
  }
  .notify-upload-button:hover{
    background:var(--notify-gold-50);
    border-color:var(--notify-gold-700);
  }
  .notify-upload-file-name{
    min-width:0;
    flex:1;
    color:var(--notify-ink-600);
    font-size:13px;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
  }
  .notify-image-preview{
    display:none;
    margin-top:12px;
    align-items:center;
    gap:12px;
  }
  .notify-image-preview img,
  .notify-image-thumb{
    width:54px;
    height:54px;
    object-fit:cover;
    border-radius:var(--notify-radius-sm);
    border:1px solid var(--notify-border);
    background:var(--notify-white);
  }
  .notify-image-preview span{font-size:12px;color:var(--notify-ink-600);word-break:break-word;}
  .notify-pagination-info{font-size:12.5px;color:var(--notify-ink-600);font-weight:700;}
  .notify-panel-footer{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:14px 30px 26px;
    gap:12px;
    flex-wrap:wrap;
  }
  .notify-pagination-footer{
    justify-content:center;
    padding-top:0;
  }
  .notify-pagination-nav{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    flex-wrap:wrap;
  }
  .notify-btn:disabled{opacity:.45;cursor:not-allowed;box-shadow:none;}

  @media (max-width:1000px){
    .notify-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .notify-main{padding:20px 16px 34px;}
    .notify-panel{display:block;height:auto;min-height:0;}
    .notify-panel-header{height:auto;min-height:0;flex:none;}
    .notify-panel-header-row{height:auto;min-height:0;}
    .notify-list-toolbar{height:auto;min-height:0;flex:none;}
    .notify-filter-bar{
      grid-template-columns:1fr 1fr;
      flex:none;
      width:100%;
      height:auto;
      min-height:0;
      align-content:start;
      grid-auto-rows:max-content;
    }
    .notify-search{max-width:none;}
    .notify-filter-bar .notify-search{grid-column:1 / -1;}
    .notify-list-toolbar{align-items:stretch;flex-direction:column;}
    .notify-table-tools{justify-content:space-between;}
    .notify-panel-footer{align-items:stretch;}
    .notify-footer-field select{width:100%;}
  }
  @media (max-width:700px){
    .notify-app{grid-template-rows:58px minmax(0, 1fr);min-height:100%;}
    .notify-topbar{padding:0 16px;min-width:0;}
    .notify-topbar-heading{min-width:0;}
    .notify-topbar-heading h1{font-size:17px;}
    .notify-topbar-heading p{font-size:10.5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .notify-main{padding:16px 12px 28px;}
    .notify-breadcrumb{margin-bottom:12px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
    .notify-panel-header{padding:17px 18px;}
    .notify-panel-header-row{min-width:0;}
    .notify-panel-title{font-size:16px;min-width:0;overflow-wrap:anywhere;}
    .notify-panel-close{flex:0 0 32px;}
    .notify-list-toolbar{padding:18px;}
    .notify-filter-bar{grid-template-columns:minmax(0, 1fr);min-width:0;}
    .notify-filter-field,.notify-search{height:auto;min-height:0;align-self:start;}
    .notify-search{min-width:0;}
    .notify-table-tools{display:grid;grid-template-columns:1fr 1fr;width:100%;}
    .notify-table-tools .notify-btn{width:100%;padding:0 12px;}
    .notify-table-wrap{overflow:visible;padding:0 18px 8px;}
    .notify-table,
    .notify-table thead,
    .notify-table tbody,
    .notify-table tr,
    .notify-table td{
      display:block;
      width:100%;
      min-width:0;
    }
    .notify-table{border-collapse:separate;border-spacing:0;}
    .notify-table thead{display:none;}
    .notify-table tr{
      border:1px solid var(--notify-border);
      border-radius:var(--notify-radius-sm);
      background:var(--notify-white);
      margin-bottom:12px;
      overflow:hidden;
    }
    .notify-table td{
      position:relative;
      border-bottom:1px solid var(--notify-cream-100);
      padding:12px 12px 12px 110px;
      min-height:46px;
    }
    .notify-table td:last-child{border-bottom:0;}
    .notify-table td::before{
      content:attr(data-label);
      position:absolute;
      left:12px;
      top:14px;
      width:82px;
      color:var(--notify-ink-600);
      font-size:10.5px;
      font-weight:900;
      text-transform:uppercase;
    }
    .notify-message-cell{gap:10px;}
    .notify-message-copy{width:100%;}
    .notify-title-cell,.notify-muted{overflow-wrap:anywhere;}
    .notify-muted{line-height:1.45;}
    .notify-panel-footer{
      padding:12px 18px 20px;
      flex-direction:column;
    }
    .notify-pagination-nav{
      display:grid;
      grid-template-columns:1fr;
      width:100%;
    }
    .notify-pagination-info{text-align:center;order:-1;}
    .notify-panel-body{padding:18px;}
    .notify-upload-control{min-width:0;}
    .notify-actions .notify-btn{flex:1 1 auto;}
  }
  @media (max-width:480px){
    .notify-main{padding:12px 8px 24px;}
    .notify-panel{border-radius:var(--notify-radius-sm);box-shadow:none;}
    .notify-panel-header{padding:14px 12px;}
    .notify-panel-title{font-size:15px;gap:8px;}
    .notify-list-toolbar{padding:14px 12px;gap:12px;}
    .notify-table-tools{grid-template-columns:1fr;gap:8px;}
    .notify-table-wrap{padding:0 10px 6px;}
    .notify-table tr{margin-bottom:10px;}
    .notify-table td{padding:10px 10px 10px 88px;min-height:42px;}
    .notify-table td::before{left:10px;top:12px;width:66px;font-size:9.5px;}
    .notify-message-cell{align-items:flex-start;flex-direction:column;}
    .notify-image-thumb{width:48px;height:48px;}
    .notify-pill{white-space:normal;text-align:center;line-height:1.25;padding:6px 9px;}
    .notify-panel-body{padding:14px 12px;}
    .notify-field textarea{min-height:130px;}
    .notify-upload{padding:12px;}
    .notify-upload-control{align-items:stretch;flex-direction:column;}
    .notify-upload-button{width:100%;}
    .notify-upload-file-name{white-space:normal;overflow-wrap:anywhere;}
    .notify-image-preview{align-items:flex-start;}
    .notify-actions{display:grid;grid-template-columns:1fr;width:100%;}
    .notify-actions .notify-btn{width:100%;}
    .notify-panel-footer{padding:10px 12px 16px;}
  }
</style>

<div data-page="notifications" id="Main_Dashboard_06_A">
  <div class="notify-app<?php echo !empty($bmjm_notification_standalone) ? ' is-standalone' : ''; ?>">
    <?php if (empty($bmjm_notification_standalone)) { include __DIR__ . '/../../Includes/Sidebar.php'; } ?>

    <header class="notify-topbar">
      <div class="notify-topbar-heading">
        <h1>Notifications</h1>
        <p>Member App Notification Center</p>
      </div>
    </header>

    <main class="notify-main">
      <div id="admin-notification-toast" class="notify-toast"></div>
      <div id="admin-notification-list-view" class="notify-view is-active">
        <p class="notify-breadcrumb">
          <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> /
          <span>Notifications</span>
        </p>

        <section class="notify-panel">
          <div class="notify-panel-header">
            <div class="notify-panel-header-row">
              <div class="notify-panel-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
                Notification List
              </div>
              <a class="notify-panel-close" onclick="main_dashboard_00_OPEN()" title="Close" aria-label="Close">&times;</a>
            </div>
          </div>

          <div class="notify-list-toolbar">
            <div class="notify-filter-bar">
              <div class="notify-search">
                <label for="admin-notification-search">Search</label>
                <input type="search" id="admin-notification-search" placeholder="Search title or message" oninput="adminNotificationsSearchDelay()">
              </div>
              <div class="notify-filter-field">
                <label for="admin-notification-audience">Audience</label>
                <select id="admin-notification-audience" onchange="adminNotificationsFilterChange()">
                  <option value="all_members" selected>All members</option>
                  <option value="automatic">Automatic</option>
                  <option value="subscription">Subscription members</option>
                  <option value="zakath_payee">Zakath payers</option>
                  <option value="zakath_receiver">Zakath receivers</option>
                  <option value="all">All notifications</option>
                </select>
              </div>
              <div class="notify-filter-field">
                <label for="admin-notification-sort">Sort</label>
                <select id="admin-notification-sort" onchange="adminNotificationsFilterChange()">
                  <option value="newest" selected>Newest first</option>
                  <option value="oldest">Oldest first</option>
                  <option value="recipients_high">Recipients high to low</option>
                  <option value="recipients_low">Recipients low to high</option>
                  <option value="title_az">Title A to Z</option>
                  <option value="title_za">Title Z to A</option>
                </select>
              </div>
            </div>
            <div class="notify-table-tools">
              <button type="button" class="notify-btn notify-btn-ghost" onclick="adminNotificationsLoad()">Refresh</button>
              <button type="button" class="notify-btn notify-btn-primary" onclick="adminNotificationShowAdd()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
                Add New
              </button>
            </div>
          </div>

          <div class="notify-panel-body notify-list-body">
            <div class="notify-table-wrap">
              <table class="notify-table">
                <thead>
                  <tr>
                    <th>Notification</th>
                    <th>Audience</th>
                    <th>Recipients</th>
                    <th>Created</th>
                  </tr>
                </thead>
                <tbody id="admin-notification-tbody"></tbody>
              </table>
              <div class="notify-empty" id="admin-notification-empty">
                <strong>No notifications found</strong>
                Create a new notification or change the search text.
              </div>
            </div>
            <div class="notify-panel-footer">
              <div class="notify-result-count" id="admin-notification-result-summary">Loading notifications...</div>
              <div class="notify-footer-field">
                <label for="admin-notification-per-page">Per page</label>
                <select id="admin-notification-per-page" onchange="adminNotificationsPerPageChange()">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
              </div>
            </div>
            <div class="notify-panel-footer notify-pagination-footer">
              <div class="notify-pagination-nav">
                <button type="button" class="notify-btn notify-btn-ghost" id="admin-notification-prev" onclick="adminNotificationsChangePage(-1)">Previous</button>
                <div class="notify-pagination-info" id="admin-notification-page-info">Page 1 of 1</div>
                <button type="button" class="notify-btn notify-btn-ghost" id="admin-notification-next" onclick="adminNotificationsChangePage(1)">Next</button>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div id="admin-notification-add-view" class="notify-view">
        <p class="notify-breadcrumb">
          <a href="javascript:void(0);" onclick="main_dashboard_00_OPEN()">Dashboard</a> /
          <a href="javascript:void(0);" onclick="adminNotificationShowList()">Notifications</a> /
          <span>Add Notification</span>
        </p>

        <section class="notify-panel">
          <div class="notify-panel-header">
            <div class="notify-panel-header-row">
              <div class="notify-panel-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
                Add Notification
              </div>
              <a class="notify-panel-close" onclick="adminNotificationShowList()" title="Back to list" aria-label="Back to list">&times;</a>
            </div>
          </div>
          <div class="notify-panel-body">
            <form id="admin-notification-form" enctype="multipart/form-data" onsubmit="return adminNotificationSubmit(event, 'send_now');">
              <div class="notify-field">
                <label for="notification-title">Title</label>
                <input type="text" id="notification-title" name="title" maxlength="120" required>
              </div>
              <div class="notify-field">
                <label for="notification-message">Message</label>
                <textarea id="notification-message" name="message" maxlength="500" required></textarea>
              </div>
              <div class="notify-field">
                <label for="notification-audience">Audience</label>
                <select id="notification-audience" name="audience">
                  <option value="all_members">All Members</option>
                  <option value="subscription">Subscription members</option>
                  <option value="zakath_payee">Zakath payers</option>
                  <option value="zakath_receiver">Zakath receivers</option>
                </select>
              </div>
              <div class="notify-field">
                <label for="notification-image-file">Upload Image</label>
                <div class="notify-upload">
                  <div class="notify-upload-control">
                    <label class="notify-upload-button" for="notification-image-file">Choose Image</label>
                    <span class="notify-upload-file-name" id="notification-image-file-name">No image selected</span>
                  </div>
                  <input type="file" id="notification-image-file" name="notification_image" accept="image/png,image/jpeg,image/gif,image/webp" onchange="adminNotificationPreviewImage()">
                  <div class="notify-image-preview" id="notification-image-preview">
                    <img id="notification-image-preview-img" src="" alt="">
                    <span id="notification-image-preview-name"></span>
                  </div>
                </div>
              </div>
              <div class="notify-actions">
                <button type="submit" class="notify-btn notify-btn-primary">Send Now</button>
                <button type="button" class="notify-btn notify-btn-ghost" onclick="adminNotificationReset()">Clear</button>
                <button type="button" class="notify-btn notify-btn-ghost" onclick="adminNotificationShowList()">Cancel</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </main>
  </div>
</div>

<?php include_once __DIR__ . '/JS/Main_Dashboard_06_A_JS.php'; ?>
