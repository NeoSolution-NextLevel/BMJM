<?php
if (!class_exists('Company_Info_Variable_List')) {
  include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
}
$sidebar_admin_comp_info = new Company_Info_Variable_List();
$sidebar_admin_dashboard_url = 'Main-Dashboard.php?page=members';
?>
<!-- ===================================================================
     bmjm-sidebar — Reusable sidebar component (bmjm Admin Dashboard)
     Include this on every dashboard page. Two ways to use it:

     1) PHP pages (recommended — this is what member-list.php uses):
            include $pth.'Includes/Sidebar.php';

     2) Static HTML/JS pages (no PHP available):
        Put an empty container where the sidebar should go and load
        it with fetch:
            <div id="bmjm-sidebar-root"></div>
            <script src="../Includes/sidebar-loader.js"></script>

     To highlight the current page's nav item, set a data-page
     attribute on <body>, matching one of the data-page values below:
        <body data-page="member-list">
     =================================================================== -->

<style>
  :root{
    --bmjm-sidebar-green-950:#0B2E24;
    --bmjm-sidebar-green-800:#123832;
    --bmjm-sidebar-gold-500:#C9A227;
    --bmjm-sidebar-gold-300:#E4C766;
    --bmjm-sidebar-cream-50:#FAF7F0;
    --bmjm-sidebar-radius-sm:6px;
  }

  .bmjm-sidebar{
    grid-area:sidebar;
    background:linear-gradient(180deg,var(--bmjm-sidebar-green-950) 0%,#0E362A 100%);
    color:var(--bmjm-sidebar-cream-50);
    display:flex;
    flex-direction:column;
    padding:26px 18px;
    position:sticky;
    top:0;
    height:100vh;
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    box-sizing:border-box;
  }

  .bmjm-sidebar-brand{
    display:flex;
    justify-content:center;
    align-items:center;
    padding:8px 0 20px;
    margin-bottom:16px;
    border-bottom:1px solid rgba(201,162,39,.18);
    text-decoration:none;
  }

  .bmjm-sidebar-brand-mark{
    width:140px;
    height:auto;
    flex:none;
  }
  .bmjm-sidebar-brand-mark img{
    width:100%;
    height:auto;
    display:block;
    object-fit:contain;
  }
  .bmjm-sidebar-brand-mark svg{width:100%;height:100%;display:block;}
  .bmjm-sidebar-brand-text{line-height:1.2;}
  .bmjm-sidebar-brand-text strong{
    display:block;
    font-family:'Poppins',Inter,sans-serif;
    font-weight:600;
    font-size:15px;
    letter-spacing:0.02em;
    color:var(--bmjm-sidebar-gold-300);
  }
  .bmjm-sidebar-brand-text span{
    display:block;
    font-size:10.5px;
    letter-spacing:0.14em;
    text-transform:uppercase;
    color:rgba(250,247,240,0.55);
    margin-top:2px;
  }

  .bmjm-sidebar-member{
    display:flex;
    align-items:center;
    gap:12px;
    min-width:0;
    margin:0 0 20px;
    padding:12px;
    border:1px solid rgba(250,247,240,0.12);
    border-radius:8px;
    background:rgba(250,247,240,0.06);
  }
  .bmjm-sidebar-member[hidden]{display:none;}
  .bmjm-sidebar-member-avatar{
    width:42px;
    height:42px;
    flex:0 0 42px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:var(--bmjm-sidebar-cream-50);
    color:var(--bmjm-sidebar-green-950);
  }
  .bmjm-sidebar-member-avatar svg{width:23px;height:23px;}
  .bmjm-sidebar-member-info{min-width:0;}
  .bmjm-sidebar-member-name{
    display:block;
    overflow:hidden;
    color:var(--bmjm-sidebar-cream-50);
    font-size:13px;
    font-weight:600;
    text-overflow:ellipsis;
    white-space:nowrap;
  }
  .bmjm-sidebar-member-number{
    display:block;
    margin-top:3px;
    color:rgba(250,247,240,0.65);
    font-size:11px;
  }
  .bmjm-sidebar-section-title{
    margin:0 0 8px;
    padding:0 14px;
    color:var(--bmjm-sidebar-gold-300);
    font-family:'Poppins',Inter,sans-serif;
    font-size:13px;
    font-weight:600;
  }

  .bmjm-sidebar-nav{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px;flex:1;}
  .bmjm-sidebar-nav-item a{
    display:flex;align-items:center;gap:12px;
    padding:11px 14px;
    border-radius:var(--bmjm-sidebar-radius-sm);
    color:rgba(250,247,240,0.72);
    text-decoration:none;
    font-size:13.5px;
    font-weight:500;
    border-left:3px solid transparent;
    transition:background .15s ease,color .15s ease,border-color .15s ease;
  }
  .bmjm-sidebar-nav-item a:hover{
    background:rgba(201,162,39,0.10);
    color:var(--bmjm-sidebar-cream-50);
  }
  .bmjm-sidebar-nav-item.bmjm-sidebar-active a{
    background:rgba(201,162,39,0.16);
    color:var(--bmjm-sidebar-gold-300);
    border-left-color:var(--bmjm-sidebar-gold-500);
    font-weight:600;
  }
  .bmjm-sidebar-nav-icon{width:16px;height:16px;flex:0 0 16px;opacity:0.9;}

  .bmjm-sidebar-foot{
    padding-top:18px;
    margin-top:auto;
    border-top:1px solid rgba(201,162,39,0.18);
    font-size:11px;
    color:rgba(250,247,240,0.4);
    line-height:1.5;
    width:100%;
  }

  @media (max-width:900px){
    .bmjm-sidebar{display:none;}
  }
</style>

<aside class="bmjm-sidebar">
  <a href="dashboard.php" class="bmjm-sidebar-brand">
    <div class="bmjm-sidebar-brand-mark" aria-hidden="true">
      <!-- Replace assets/logo.png with your real mosque logo file.
           If it fails to load, this falls back to the gold star mark
           so the sidebar never looks broken. -->
      <img src="../../assets/images/logo_dashboard.png"
           onerror="this.replaceWith(document.getElementById('bmjm-sidebar-fallback-mark').content.cloneNode(true).firstElementChild)">

    </div>
  </a>

  <div class="bmjm-sidebar-member" id="bmjm-sidebar-member" hidden>
    <div class="bmjm-sidebar-member-avatar" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a4.2 4.2 0 1 0 0-8.4 4.2 4.2 0 0 0 0 8.4Zm0 2c-4.1 0-7.5 2.1-7.5 4.7V21h15v-2.3c0-2.6-3.4-4.7-7.5-4.7Z"/></svg>
    </div>
    <div class="bmjm-sidebar-member-info">
      <strong class="bmjm-sidebar-member-name" id="bmjm-sidebar-member-name"></strong>
      <span class="bmjm-sidebar-member-number" id="bmjm-sidebar-member-number"></span>
    </div>
  </div>

  <h2 class="bmjm-sidebar-section-title">Member Profile</h2>
  <ul class="bmjm-sidebar-nav">
    
    <li class="bmjm-sidebar-nav-item" data-page="dashboard" onclick="if(typeof Admin_user_dashboard_01_OPEN === 'function'){ Admin_user_dashboard_01_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.4"/><path d="M2.5 20c1-4 3.4-6 6.5-6s5.5 2 6.5 6"/><circle cx="18" cy="9" r="2.4"/><path d="M15.8 14c2.4.2 4 1.9 4.7 5.2"/></svg>Dashboard</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="payment" onclick="if(typeof Admin_user_dashboard_02_A_OPEN === 'function'){ Admin_user_dashboard_02_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Payment</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="profile" onclick="if(typeof Admin_user_dashboard_03_A_OPEN === 'function'){ Admin_user_dashboard_03_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Profile</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="accounts">
      <a href="<?php echo htmlspecialchars($sidebar_admin_dashboard_url, ENT_QUOTES, 'UTF-8'); ?>"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>Go Back to Dashboard</a>
    </li>
   
  </ul>

  <div class="bmjm-sidebar-foot">
    &copy; <?php echo date("Y"); ?> - <?php echo htmlspecialchars($sidebar_admin_comp_info->get_compnay_name(), ENT_QUOTES, 'UTF-8'); ?> |
    <a href="https://www.neosolution.lk/" target="_blank" rel="noopener noreferrer" style="color:white;">Neo Solution</a>
  </div>
</aside>

<script>
  // Highlights the nav item matching <body data-page="...">.
  // Safe to run whether this file was included server-side (PHP)
  // or injected client-side via sidebar-loader.js.
  (function bmjmSidebarInit(){
    const current = document.body.getAttribute('data-page');
    if(!current) return;
    document.querySelectorAll('.bmjm-sidebar-nav-item').forEach(function(item){
      item.classList.toggle('bmjm-sidebar-active', item.getAttribute('data-page') === current);
    });
  })();
</script>
