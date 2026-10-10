<?php 
$pth = "../";
$active_page = "dashboard2";
$page_title = "Choose Payment Option · Bmjm Member";

// include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     bmjm Member Dashboard — Select Payment Type (Unique Namespace: ud2c-)
     =================================================================== */
  :root{
    --ud2c-green-950:#0B2E24; --ud2c-green-800:#123832;
    --ud2c-green-700:#1B4B41; --ud2c-green-600:#245F52;
    --ud2c-gold-600:#B8923D; --ud2c-gold-500:#C9A227; --ud2c-gold-300:#E4C766;
    --ud2c-cream-50:#FAF7F0; --ud2c-cream-100:#F2EDE0; --ud2c-white:#FFFFFF;
    --ud2c-ink-900:#1E2B26; --ud2c-ink-600:#5A6A62; --ud2c-ink-400:#8B978F;
    --ud2c-border:#E6E0D0;
    --ud2c-radius-sm:8px; --ud2c-radius-md:16px; --ud2c-radius-lg:16px;
    --ud2c-shadow:0 12px 32px rgba(11,46,36,0.06);
    --ud2c-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--ud2c-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--ud2c-ink-900); -webkit-font-smoothing:antialiased;
  }

  .ud2c-app{
    display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr;
    min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .ud2c-topbar{
    grid-area:topbar; background:var(--ud2c-white); border-bottom:1px solid var(--ud2c-border);
    display:flex; align-items:center; justify-content:space-between; padding:0 28px;
  }
  .ud2c-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif; font-size:18px; font-weight:600; margin:0; color:var(--ud2c-green-950);
  }
  .ud2c-topbar-heading p{ margin:2px 0 0; font-size:12px; color:var(--ud2c-ink-400); }
  .ud2c-topbar-actions{display:flex;align-items:center;gap:10px;}
  .ud2c-icon-btn{
    width:36px;height:36px;border-radius:10px; display:flex;align-items:center;justify-content:center;
    background:var(--ud2c-cream-100); color:var(--ud2c-green-800); border:1px solid var(--ud2c-border);cursor:pointer; transition:all .2s ease;
  }
  .ud2c-icon-btn:hover{
    background:var(--ud2c-gold-300); border-color:var(--ud2c-gold-500); color: var(--ud2c-green-950);
  }
  .ud2c-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .ud2c-main{
    grid-area:main; padding:28px 32px 36px; min-width: 0;
    display:flex; align-items:flex-start; justify-content:center;
    min-height:calc(100vh - 64px);
    animation: ud2cFadeSlideUp 0.6s var(--ud2c-cubic) forwards;
  }
  @keyframes ud2cFadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  .ud2c-panel {
    width:100%; max-width:780px;
    background: var(--ud2c-white); border-radius: var(--ud2c-radius-lg);
    border: 1px solid var(--ud2c-border); box-shadow: var(--ud2c-shadow); overflow: hidden;
  }
  .ud2c-panel-header {
    background: linear-gradient(135deg, var(--ud2c-green-800), var(--ud2c-green-950));
    color: var(--ud2c-cream-50); padding: 24px 32px;
    display: flex; justify-content: space-between; align-items: center;
  }
  .ud2c-panel-title {
    display:flex; align-items:center; gap:12px;
    font-family:'Poppins', sans-serif; font-size:22px; font-weight:700;
  }
  .ud2c-panel-title svg { width:22px; height:22px; color:var(--ud2c-gold-300); }
  .ud2c-panel-close {
    width:32px; height:32px; border-radius:50%; border:1px solid rgba(250,247,240,0.25);
    background:transparent; color:var(--ud2c-cream-50); display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .2s ease; text-decoration:none;
  }
  .ud2c-panel-close:hover { background:rgba(250,247,240,0.15); }

  .ud2c-panel-body { padding: 40px; }
  .ud2c-subheading { text-align:center; margin-bottom:30px; }
  .ud2c-subheading h3 { font-size:20px; font-weight:700; color:var(--ud2c-green-950); margin:0 0 6px 0; font-family:'Poppins', sans-serif; }
  .ud2c-subheading p { font-size:14px; color:var(--ud2c-ink-600); margin:0; }

  .ud2c-options-grid {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 24px;
  }

  .ud2c-card {
    position: relative; display: flex; flex-direction: column; align-items: center; text-align: center;
    padding: 36px 24px; border-radius: 18px; border: 2px solid var(--ud2c-border);
    background: var(--ud2c-white); color: var(--ud2c-ink-900); text-decoration: none;
    cursor: pointer; transition: all 0.3s var(--ud2c-cubic); overflow: hidden;
  }
  .ud2c-card::before {
    content: ""; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(201,162,39,0.06) 0%, transparent 100%);
    opacity: 0; transition: opacity 0.3s ease;
  }
  .ud2c-card-icon {
    width: 64px; height: 64px; border-radius: 16px; background: var(--ud2c-cream-100);
    display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
    color: var(--ud2c-green-800); transition: all 0.3s ease;
  }
  .ud2c-card-icon svg { width: 32px; height: 32px; }

  .ud2c-card-title {
    font-size: 18px; font-weight: 700; font-family: 'Poppins', sans-serif;
    color: var(--ud2c-green-950); margin-bottom: 8px; position: relative;
  }
  .ud2c-card-desc {
    font-size: 13px; color: var(--ud2c-ink-600); line-height: 1.5; position: relative; margin: 0;
  }

  .ud2c-card:hover {
    border-color: var(--ud2c-gold-500); transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(184,146,61,0.15);
  }
  .ud2c-card:hover::before { opacity: 1; }
  .ud2c-card:hover .ud2c-card-icon {
    background: var(--ud2c-gold-300); color: var(--ud2c-green-950); transform: scale(1.08);
  }

  .ud2c-back-btn {
    width: 100%; height: 48px; border-radius: var(--ud2c-radius-sm); border: none;
    background: var(--ud2c-cream-100); color: var(--ud2c-ink-900); font-size: 14px; font-weight: 600;
    cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: all 0.2s ease; text-decoration: none;
  }
  .ud2c-back-btn:hover { background: var(--ud2c-border); color: var(--ud2c-green-950); }
  .ud2c-back-btn svg { width: 16px; height: 16px; }

  @media (max-width: 768px) {
    .ud2c-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .ud2c-main{padding: 14px;}
    .ud2c-options-grid { grid-template-columns: 1fr; }
    .ud2c-panel-body { padding: 18px; }
    .ud2c-panel-header { padding: 16px 18px; }
    .ud2c-panel-title { font-size: 17px; }
  }
</style>

<div data-page="payment" id="user_dashboard_02_C">
  <div class="ud2c-app">
    <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="ud2c-topbar">
      <div class="ud2c-topbar-heading">
        <h1>Payment Method</h1>
        <p>Member Financial Services</p>
      </div>
      <div class="ud2c-topbar-actions">
        <!-- <button class="ud2c-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="ud2c-icon-btn" title="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button> -->
        <button
          type="button"
          class="ud2c-icon-btn bmjm-user-logout-btn"
          title="Sign out"
          aria-label="Sign out"
          data-logout-url="<?php echo htmlspecialchars($pth . 'View-List/Main/Main_User_Logout.php', ENT_QUOTES, 'UTF-8'); ?>"
          data-login-url="<?php echo htmlspecialchars($pth . 'Login.php', ENT_QUOTES, 'UTF-8'); ?>"
        >
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
        </button>
      </div>
    </header>

    <!-- ================= MAIN ================= -->
    <main class="ud2c-main">
      <section class="ud2c-panel">
        <div class="ud2c-panel-header">
          <div class="ud2c-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Select Payment Option
          </div>
          <a class="ud2c-panel-close" onclick="user_dashboard_02_B_OPEN()">✕</a>
        </div>

        <div class="ud2c-panel-body">
          <div class="ud2c-subheading">
            <h3>How would you like to pay?</h3>
            <p>Choose your preferred payment method below to proceed with your transaction.</p>
          </div>

          <div class="ud2c-options-grid">
            <!-- Option 1: Bank Payment -->
            <a class="ud2c-card" onclick="user_dashboard_select_method('bank')">
              <div class="ud2c-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <path d="M3 21h18"/><path d="M3 10h18"/><path d="M5 6l7-3 7 3"/><path d="M4 10v11"/><path d="M20 10v11"/><path d="M8 14v3"/><path d="M12 14v3"/><path d="M16 14v3"/>
                </svg>
              </div>
              <div class="ud2c-card-title">Bank Payment</div>
              <p class="ud2c-card-desc">Direct bank deposit or wire transfer with receipt slip upload</p>
            </a>

            <!-- Option 2: Pay Online -->
            <a class="ud2c-card" onclick="user_dashboard_select_method('online')">
              <div class="ud2c-card-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                  <rect x="2" y="5" width="20" height="14" rx="2"/>
                  <line x1="2" y1="10" x2="22" y2="10"/>
                  <path d="M6 15h2"/><path d="M12 15h4"/>
                </svg>
              </div>
              <div class="ud2c-card-title">Pay Online</div>
              <p class="ud2c-card-desc">Instant online card payment powered by secure payment gateway</p>
            </a>
          </div>

          <button class="ud2c-back-btn" onclick="user_dashboard_02_B_OPEN()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
            Back to Options
          </button>
        </div>
      </section>
    </main>
  </div>
</div>

<script>
  function user_dashboard_select_method(method) {
    if (method === 'bank') {
      if (typeof user_dashboard_02_D_OPEN === 'function') {
        user_dashboard_02_D_OPEN();
      } else if (typeof user_dashboard_02_F_OPEN === 'function') {
        user_dashboard_02_F_OPEN();
      } else {
        bmjmShowPopup({
          type: 'info',
          title: 'Payment Method',
          message: 'Bank Payment selected.'
        });
      }
    } else if (method === 'online') {
      if (typeof user_dashboard_02_E_OPEN === 'function') {
        user_dashboard_02_E_OPEN();
      } else if (typeof user_dashboard_02_IPG_OPEN === 'function') {
        user_dashboard_02_IPG_OPEN();
      } else {
        bmjmShowPopup({
          type: 'info',
          title: 'Payment Method',
          message: 'Pay Online selected.'
        });
      }
    }
  }
</script>
