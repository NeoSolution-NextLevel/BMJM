<?php
if (!class_exists('Company_Info_Variable_List')) {
    include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
}
$sidebar_comp_info = new Company_Info_Variable_List();
$sidebar_back_url = $sidebar_comp_info->get_compnay_full_web();
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
    margin-top:auto;
    border-top:1px solid rgba(201,162,39,0.18);
    font-size:11px;
    color:rgba(250,247,240,0.4);
    line-height:1.5;
    width:100%;
  }

  .sidebar-backdrop {
    visibility: hidden; position: fixed; inset: 0; background: rgba(7,24,19,0.62); z-index: 900;
    backdrop-filter: blur(3px); transition: opacity 0.25s ease, visibility 0.25s ease; opacity: 0;
  }
  .sidebar-backdrop.active { visibility: visible; opacity: 1; }

  .bmjm-mobile-menu-button,
  .bmjm-sidebar-close {
    display:none;
    width:40px;
    height:40px;
    flex:0 0 40px;
    align-items:center;
    justify-content:center;
    border:1px solid rgba(11,46,36,0.12);
    border-radius:8px;
    background:#F2EDE0;
    color:var(--bmjm-sidebar-green-950);
    cursor:pointer;
  }
  .bmjm-mobile-menu-button svg,
  .bmjm-sidebar-close svg { width:21px;height:21px; }
  .bmjm-sidebar-close { position:absolute;top:18px;right:16px;background:rgba(255,255,255,0.08);color:#FAF7F0;border-color:rgba(255,255,255,0.14); }

  @media (max-width:900px){
    .dashboard2-topbar,.dashboard3-topbar {
      display:grid !important;
      grid-template-columns:40px minmax(0,1fr) auto;
      align-items:center;
      gap:12px;
      padding-left:14px !important;
      padding-right:14px !important;
    }
    .dashboard2-topbar-heading,.dashboard3-topbar-heading { min-width:0; }
    .dashboard2-topbar-heading h1,.dashboard3-topbar-heading h1,
    .dashboard2-topbar-heading p,.dashboard3-topbar-heading p {
      overflow:hidden;
      text-overflow:ellipsis;
      white-space:nowrap;
    }
    .bmjm-sidebar {
        display:flex;position:fixed;left:0;top:0;bottom:0;z-index:1000;width:min(84vw,320px);
        transform:translateX(-105%);transition:transform 0.3s cubic-bezier(0.2,0.8,0.2,1);
        box-shadow:12px 0 40px rgba(0,0,0,0.32);border-radius:0 12px 12px 0;
    }
    .bmjm-sidebar.sidebar-open { transform: translateX(0); }
    .bmjm-mobile-menu-button,.bmjm-sidebar-close { display:flex; }
    .bmjm-sidebar-brand { padding-right:48px; }
    body.bmjm-mobile-menu-open { overflow:hidden; }
  }
</style>

<aside class="bmjm-sidebar" aria-label="Member navigation">
  <button type="button" class="bmjm-sidebar-close" onclick="close_mobile_sidebar()" aria-label="Close menu" title="Close menu">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
  </button>
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
    
    <li class="bmjm-sidebar-nav-item" data-page="dashboard" onclick="if(typeof user_dashboard_01_A_OPEN === 'function'){ user_dashboard_01_A_OPEN(); close_mobile_sidebar(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.4"/><path d="M2.5 20c1-4 3.4-6 6.5-6s5.5 2 6.5 6"/><circle cx="18" cy="9" r="2.4"/><path d="M15.8 14c2.4.2 4 1.9 4.7 5.2"/></svg>Dashboard</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="payment" onclick="if(typeof user_dashboard_02_A_OPEN === 'function'){ user_dashboard_02_A_OPEN(); close_mobile_sidebar(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Payment</a>
    </li>
    <li class="bmjm-sidebar-nav-item" data-page="settings" onclick="if(typeof user_dashboard_03_A_OPEN === 'function'){ user_dashboard_03_A_OPEN(); close_mobile_sidebar(); }">
      <a href="javascript:void(0);"><svg class="bmjm-sidebar-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="6" width="18" height="12" rx="1.8"/><path d="M3 10h18"/></svg>Settings</a>
    </li>
  </ul>

  <div class="bmjm-sidebar-foot"> 
    &copy; <?php echo date("Y"); ?> - <?php echo $sidebar_comp_info->get_compnay_name()." | ";?> 
    <a href="https://www.neosolution.lk/" target="_blank" rel="noopener noreferrer" style="color:white;">Neo Solution</a>
  </div>
</aside>

<div class="sidebar-backdrop" onclick="close_mobile_sidebar()" aria-hidden="true"></div>

<script>
  function open_mobile_sidebar(button) {
      var app = button ? button.closest('[class$="-app"]') : null;
      var sidebar = app ? app.querySelector('.bmjm-sidebar') : document.querySelector('.bmjm-sidebar');
      var backdrop = app ? app.querySelector('.sidebar-backdrop') : document.querySelector('.sidebar-backdrop');
      if (!sidebar || !backdrop) return;
      sidebar.classList.add('sidebar-open');
      backdrop.classList.add('active');
      sidebar.setAttribute('aria-hidden', 'false');
      document.body.classList.add('bmjm-mobile-menu-open');
      var closeButton = sidebar.querySelector('.bmjm-sidebar-close');
      if (closeButton) closeButton.focus();
  }
  function close_mobile_sidebar() {
      document.querySelectorAll('.bmjm-sidebar').forEach(function(sb) {
          sb.classList.remove('sidebar-open');
          if (window.innerWidth <= 900) sb.setAttribute('aria-hidden', 'true');
      });
      document.querySelectorAll('.sidebar-backdrop').forEach(function(bd) {
          bd.classList.remove('active');
      });
      document.body.classList.remove('bmjm-mobile-menu-open');
  }

  function install_mobile_sidebar_buttons() {
    document.querySelectorAll('.bmjm-sidebar').forEach(function(sidebar) {
      var app = sidebar.parentElement;
      if (!app || app.querySelector('.bmjm-mobile-menu-button')) return;
      var header = app.querySelector('header');
      if (!header) return;
      var button = document.createElement('button');
      button.type = 'button';
      button.className = 'bmjm-mobile-menu-button';
      button.setAttribute('aria-label', 'Open menu');
      button.setAttribute('title', 'Menu');
      button.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>';
      button.addEventListener('click', function() { open_mobile_sidebar(button); });
      header.insertBefore(button, header.firstChild);
    });
  }

  (function bmjmSidebarInit(){
    const current = document.body.getAttribute('data-page');
    if(!current) return;
    document.querySelectorAll('.bmjm-sidebar-nav-item').forEach(function(item){
      item.classList.toggle('bmjm-sidebar-active', item.getAttribute('data-page') === current);
    });
    install_mobile_sidebar_buttons();
    setTimeout(install_mobile_sidebar_buttons, 0);
  })();

  document.addEventListener('DOMContentLoaded', install_mobile_sidebar_buttons);
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') close_mobile_sidebar();
  });
</script>
