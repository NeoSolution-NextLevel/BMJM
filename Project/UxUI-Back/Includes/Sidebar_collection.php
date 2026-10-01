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
    
    <li class="bmjm-sidebar-nav-item" data-page="dashboard" onclick="if(typeof Collection_Dashboard_01_A_OPEN === 'function'){ Collection_Dashboard_01_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.4"/><path d="M2.5 20c1-4 3.4-6 6.5-6s5.5 2 6.5 6"/><circle cx="18" cy="9" r="2.4"/><path d="M15.8 14c2.4.2 4 1.9 4.7 5.2"/></svg>Dashboard</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="payment" onclick="if(typeof Collection_Dashboard_02_A_OPEN === 'function'){ Collection_Dashboard_02_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Payment</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="profile" onclick="if(typeof Collection_Dashboard_03_A_OPEN === 'function'){ Collection_Dashboard_03_A_OPEN(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Expences</a>
    </li>
    
    <li class="bmjm-sidebar-nav-item" data-page="accounts" >
      <a href="<?php echo $home_page ?>UxUi/Main-Dashboard.php"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>Go Back To Dashboard</a>
    </li>
   
  </ul>
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