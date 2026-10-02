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
    justify-content:flex-start;
    align-items:center;
    padding:18px 0 26px 18px; /* left padding */
    margin-bottom:22px;
    border-bottom:1px solid rgba(201,162,39,.18);
    text-decoration:none;
}

  .bmjm-sidebar-brand-mark{
    width:110px;
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
    margin-top:18px;
    border-top:1px solid rgba(201,162,39,0.18);
    font-size:11px;
    color:rgba(250,247,240,0.4);
    line-height:1.5;
  }

  @media (max-width:900px){
    .bmjm-sidebar{display:none;}
  }
</style>

<?php
// Ensure feature flags are loaded when sidebar is included standalone.
if (!defined('BMJM_FEATURE_FLAGS_LOADED')) {
    include_once __DIR__ . '/../../imports/feature_flags/feature_flags.php';
}
?>

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

  <ul class="bmjm-sidebar-nav">
    <li class="bmjm-sidebar-nav-item" data-page="dashboard" onclick="if(typeof main_dashboard_00_OPEN === 'function'){ main_dashboard_00_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 11.5 12 4l9 7.5"/><path d="M5 10v9h14v-9"/></svg>Dashboard</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="member-list" onclick="if(typeof main_dashboard_01_A_OPEN === 'function'){ main_dashboard_01_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.4"/><path d="M2.5 20c1-4 3.4-6 6.5-6s5.5 2 6.5 6"/><circle cx="18" cy="9" r="2.4"/><path d="M15.8 14c2.4.2 4 1.9 4.7 5.2"/></svg>Member</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="payment" onclick="if(typeof main_dashboard_02_A_OPEN === 'function'){ main_dashboard_02_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Payment</a>
    </li>    

    <?php if ($BMJM_FEATURE_COLLECTION): ?>
    <li class="bmjm-sidebar-nav-item" data-page="project" onclick="if(typeof Main_Dashboard_03_B_OPEN === 'function'){ Main_Dashboard_03_B_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3.5" y="4" width="17" height="16" rx="1.6"/><path d="M8 2.5v3M16 2.5v3M3.5 9.5h17"/></svg>Project</a>
    </li>
    <?php endif; ?>
    
    <li class="bmjm-sidebar-nav-item" data-page="accounts" onclick="if(typeof Main_Dashboard_04_A_OPEN === 'function'){ Main_Dashboard_04_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>Income &amp; Expense</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="notifications" onclick="if(typeof Main_Dashboard_06_A_OPEN === 'function'){ Main_Dashboard_06_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>Notifications</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="settings" onclick="if(typeof main_dashboard_05_01_OPEN === 'function'){ main_dashboard_05_01_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="2.6"/><path d="M19.4 13.4a7.6 7.6 0 0 0 0-2.8l2-1.5-2-3.4-2.3.9a7.5 7.5 0 0 0-2.4-1.4L14.3 3h-4l-.4 2.2a7.5 7.5 0 0 0-2.4 1.4l-2.3-.9-2 3.4 2 1.5a7.6 7.6 0 0 0 0 2.8l-2 1.5 2 3.4 2.3-.9c.7.6 1.5 1.1 2.4 1.4L10.3 21h4l.4-2.2c.9-.3 1.7-.8 2.4-1.4l2.3.9 2-3.4-2-1.5Z"/></svg>Settings</a>
    </li>
    
    <!-- <li class="bmjm-sidebar-nav-item" data-page="website-management">
      <a href="website-management.php"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5"/><path d="M3.5 12h17M12 3.5c2.4 2.4 3.6 5.4 3.6 8.5s-1.2 6.1-3.6 8.5c-2.4-2.4-3.6-5.4-3.6-8.5S9.6 5.9 12 3.5Z"/></svg>Website Management</a>
    </li> -->
  </ul>

  <div class="bmjm-sidebar-foot"> 
    &copy; <?php echo date("Y"); ?> - <?php echo $company_obj->get_compnay_name()." | ";?> 
    <a href="https://www.neosolution.lk/" target="block" style="color:white;">Neo Solution</a>
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

