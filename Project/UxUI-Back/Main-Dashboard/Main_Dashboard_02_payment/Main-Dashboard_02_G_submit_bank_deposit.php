<?php 
    $pth = "../"; 
    $active_page = "payment-subscription"; // Tells the sidebar to highlight this tab
    $page_title = "Submit Bank Deposit · Subscription Payment · bmjm Admin";
include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (shared values)
     Bambalapitiya Jumma Masjid · Dashboard · Payment · Submit Bank Deposit
     =================================================================== */
  :root{
    --payment-deposit-green-950:#0B2E24;
    --payment-deposit-green-800:#123832;
    --payment-deposit-green-700:#1B4B41;
    --payment-deposit-gold-600:#B8923D;
    --payment-deposit-gold-500:#C9A227;
    --payment-deposit-gold-300:#E4C766;
    --payment-deposit-cream-50:#FAF7F0;
    --payment-deposit-cream-100:#F2EDE0;
    --payment-deposit-white:#FFFFFF;
    --payment-deposit-ink-900:#1E2B26;
    --payment-deposit-ink-600:#5A6A62;
    --payment-deposit-ink-400:#8B978F;
    --payment-deposit-border:#E6E0D0;
    --payment-deposit-radius-sm:8px;
    --payment-deposit-radius-lg:22px;
    --payment-deposit-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--payment-deposit-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--payment-deposit-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px; 
  }

  .payment-deposit-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .payment-deposit-topbar{
    grid-area:topbar;
    background:var(--payment-deposit-white);
    border-bottom:1px solid var(--payment-deposit-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .payment-deposit-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--payment-deposit-green-950);
  }
  .payment-deposit-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--payment-deposit-ink-400);}
  .payment-deposit-topbar-actions{display:flex;align-items:center;gap:18px;}
  .payment-deposit-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--payment-deposit-cream-100);color:var(--payment-deposit-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .payment-deposit-icon-btn:hover{background:var(--payment-deposit-gold-300);}
  .payment-deposit-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .payment-deposit-main{
    grid-area:main;
    padding:26px 30px 50px;
    display:flex;
    flex-direction:column;
  }

  .payment-deposit-breadcrumb{font-size:12px;color:var(--payment-deposit-ink-400);margin-bottom:16px;}
  .payment-deposit-breadcrumb a{color:var(--payment-deposit-ink-400);text-decoration:none;}
  .payment-deposit-breadcrumb a:hover{color:var(--payment-deposit-green-700);}
  .payment-deposit-breadcrumb span{color:var(--payment-deposit-green-700);font-weight:600;}

  .payment-deposit-panel-wrapper{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:20px;
    min-height:calc(100vh - 150px);
  }

  .payment-deposit-panel{
    width:100%;
    max-width:440px;
    background:var(--payment-deposit-white);
    border-radius:16px;
    box-shadow:0 10px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
    overflow:hidden;
    border:1px solid #e2e8f0;
  }

  .payment-deposit-panel-header{
    background:#0B2E24;
    color:var(--payment-deposit-white);
    padding:16px 20px;
    display:flex;align-items:center;justify-content:space-between;
    border-bottom:1px solid rgba(0,0,0,0.05);
  }
  .payment-deposit-panel-title{
    display:flex;align-items:center;gap:10px;
    font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
    font-size:17px;font-weight:700;
    color:#ffffff;
    letter-spacing:-0.01em;
  }
  .payment-deposit-panel-close{
    width:28px;height:28px;border-radius:50%;flex:0 0 28px;
    border:1.5px solid rgba(255,255,255,0.45);
    background:transparent;color:#ffffff;
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;
    cursor:pointer;transition:all .15s ease;
    padding:0;
  }
  .payment-deposit-panel-close:hover{
    background:rgba(255,255,255,0.15);
    border-color:#ffffff;
  }

  .payment-deposit-body{
    padding:20px 22px 24px;
    background:#fbfdfc;
  }

  .payment-deposit-form-group{
    margin-bottom:16px;
  }
  .payment-deposit-label{
    display:block;
    font-size:13.5px;
    font-weight:700;
    color:var(--payment-deposit-ink-900);
    margin-bottom:6px;
  }
  .payment-deposit-input, .payment-deposit-textarea{
    width:100%;
    border:1.5px solid #d1d5db;
    border-radius:8px;
    padding:10px 14px;
    font-size:14px;
    font-family:inherit;
    color:var(--payment-deposit-ink-900);
    background:var(--payment-deposit-white);
    outline:none;
    transition:border-color .15s ease, box-shadow .15s ease;
  }
  .payment-deposit-input{
    height:42px;
  }
  .payment-deposit-input:focus, .payment-deposit-textarea:focus{
    border-color:#0B2E24;
    box-shadow:0 0 0 3px rgba(11,46,36,0.12);
  }
  .payment-deposit-textarea{
    resize:vertical;
    min-height:82px;
  }

  /* Upload Box matching screenshot */
  .payment-deposit-upload-section{
    background:#ffffff;
    border:1px solid #e2e8f0;
    border-radius:12px;
    padding:10px;
    margin-bottom:20px;
    box-shadow:inset 0 1px 2px rgba(0,0,0,0.02);
  }
  .payment-deposit-image-preview{
    width:100%;
    height:120px;
    background:#dbe0e6;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    overflow:hidden;
    margin-bottom:10px;
  }
  .payment-deposit-preview-card{
    width:130px;
    height:94px;
    background:#ffffff;
    border:1px dashed #cbd5e1;
    border-radius:6px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:6px;
    box-shadow:0 1px 3px rgba(0,0,0,0.04);
    position:relative;
  }
  .payment-deposit-preview-card img{
    max-width:100%;
    max-height:100%;
    object-fit:contain;
  }
  .payment-deposit-placeholder-inner{
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    color:#94a3b8;
    user-select:none;
  }
  .payment-deposit-placeholder-inner svg{
    width:26px;
    height:26px;
    stroke:#94a3b8;
    margin-bottom:3px;
  }
  .payment-deposit-placeholder-inner span{
    font-size:11px;
    font-weight:500;
    color:#94a3b8;
  }
  .payment-deposit-remove-preview{
    position:absolute;
    top:-6px;
    right:-6px;
    width:20px;
    height:20px;
    border-radius:50%;
    background:#ef4444;
    color:#ffffff;
    border:2px solid #ffffff;
    display:none;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    font-size:11px;
    line-height:1;
    box-shadow:0 1px 4px rgba(0,0,0,0.2);
    z-index:2;
  }
  .payment-deposit-remove-preview:hover{
    background:#dc2626;
  }
  
  .payment-deposit-upload-actions{
    display:flex;
    gap:10px;
  }
  .payment-deposit-btn-action{
    flex:1;
    height:38px;
    background:#f8fafc;
    border:1.5px solid #cbd5e1;
    border-radius:8px;
    font-size:13.5px;
    font-weight:600;
    color:#0B2E24;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:7px;
    cursor:pointer;
    transition:all .15s ease;
  }
  .payment-deposit-btn-action:hover{
    background:#f0fdf4;
    border-color:#0B2E24;
    color:#0B2E24;
  }
  .payment-deposit-btn-action svg{
    width:16px;
    height:16px;
  }

  /* Footer actions: right-aligned with Cancel and signature Theme Green Submit */
  .payment-deposit-footer-actions{
    display:flex;
    justify-content:flex-end;
    align-items:center;
    gap:10px;
    margin-top:16px;
  }
  .payment-deposit-btn-cancel, .payment-deposit-btn-submit{
    height:40px;
    display:flex;align-items:center;justify-content:center;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;font-weight:600;
    text-decoration:none;
    transition:all .15s ease;
  }
  .payment-deposit-btn-cancel{
    background:#f8fafc;
    color:#334155;
    border:1.5px solid #cbd5e1;
    padding:0 24px;
  }
  .payment-deposit-btn-cancel:hover{
    background:#e2e8f0;
    color:#0f172a;
    border-color:#94a3b8;
  }
  
  .payment-deposit-btn-submit{
    background:#085438;
    color:#ffffff;
    border:1.5px solid #085438;
    padding:0 28px;
    box-shadow:0 2px 6px rgba(8,84,56,0.2);
  }
  .payment-deposit-btn-submit:hover{
    background:#06402b;
    border-color:#06402b;
    box-shadow:0 4px 14px rgba(8,84,56,0.35);
  }
  .payment-deposit-btn-cancel:active, .payment-deposit-btn-submit:active{
    transform:translateY(1px);
  }

  /* This shared uploader modal has no Bootstrap shell on the admin SPA. */
  #Main_dashboard_02_G #image_uploder_myModal{display:none!important;}

  @media (max-width:900px){
    .payment-deposit-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-deposit-main{padding:20px 14px 40px;}
    .payment-deposit-panel-wrapper{padding:10px 0;}
  }
</style>

<div data-page="payment" id="Main_dashboard_02_G">

<div class="payment-deposit-app">

   <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="payment-deposit-topbar">
    <div class="payment-deposit-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="payment-deposit-topbar-actions">
      <button class="payment-deposit-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="payment-deposit-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="payment-deposit-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="payment-deposit-main">
    <p class="payment-deposit-breadcrumb">
      <a href="payment.php">Dashboard</a> /
      <a href="payment.php">Payment</a> /
      <a href="payment-new.php">Create Payment</a> /
      <a href="payment-subscription.php">Subscription</a> /
      <span>Bank Deposit</span>
    </p>

    <div class="payment-deposit-panel-wrapper">
      <section class="payment-deposit-panel" aria-label="Bank Deposit">
        
        <div class="payment-deposit-panel-header">
          <div class="payment-deposit-panel-title">
            Bank Deposit..
          </div>
          <a class="payment-deposit-panel-close" onclick="main_dashboard_02_F_OPEN()" title="Close" aria-label="Close">
            <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" stroke-width="2.2" fill="none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </a>
        </div>

        <div class="payment-deposit-body">
          <input type="hidden" id="DashBord_Payment_body_01_B_05_bank_account_details_id" value="">
          <input type="hidden" id="DashBord_Payment_body_01_B_05_bank_name" value="">
          <input type="hidden" id="DashBord_Payment_body_01_B_05_branch_name" value="">
          <input type="hidden" id="DashBord_Payment_body_01_B_05_ac_no" value="">
          
          <!-- Guest Manual Input Block (Hidden by Default) -->
          <div id="bank-deposit-guest-section" style="display:none; margin-bottom: 20px;">
            <div class="payment-deposit-form-group">
                <label class="payment-deposit-label" for="bank-manual-name">Guest Name</label>
                <input type="text" class="payment-deposit-input" id="bank-manual-name" placeholder="Enter guest name">
            </div>
            <div class="payment-deposit-form-group">
                <label class="payment-deposit-label" for="bank-manual-phone">Phone Number</label>
                <input type="text" class="payment-deposit-input" id="bank-manual-phone" placeholder="Enter phone number">
            </div>
            <div class="payment-deposit-form-group">
                <label class="payment-deposit-label" for="bank-manual-email">Email Address (Optional)</label>
                <input type="email" class="payment-deposit-input" id="bank-manual-email" placeholder="Enter email address">
            </div>
            <div class="payment-deposit-form-group">
                <label class="payment-deposit-label" for="bank-manual-address">Physical Address</label>
                <input type="text" class="payment-deposit-input" id="bank-manual-address" placeholder="Enter full address">
            </div>
          </div>

          <div class="payment-deposit-form-group">
            <label class="payment-deposit-label" for="deposit-amount">Amount Has Paid</label>
            <input type="number" class="payment-deposit-input" id="deposit-amount" min="0.01" step="0.01" inputmode="decimal" placeholder="4000">
          </div>

          <div class="payment-deposit-form-group">
            <label class="payment-deposit-label" for="deposit-description">Description</label>
            <textarea class="payment-deposit-textarea" id="deposit-description" placeholder="testingg"></textarea>
          </div>

          <div class="payment-deposit-upload-section">
            <div class="payment-deposit-image-preview" id="main-deposit-image-preview-box">
              <div class="payment-deposit-preview-card" id="main-deposit-preview-card">
                <button type="button" class="payment-deposit-remove-preview" id="main-deposit-remove-preview-btn" onclick="removeMainDepositImage(event)" title="Remove image">✕</button>
                <div class="payment-deposit-placeholder-inner" id="main-deposit-placeholder-inner">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                  </svg>
                  <span>No Image</span>
                </div>
                <img id="main-deposit-image-preview-img" style="display:none; max-width:100%; max-height:100%; object-fit:contain;" alt="Deposit slip preview">
              </div>
            </div>

            <div class="payment-deposit-upload-actions">
              <button type="button" class="payment-deposit-btn-action" onclick="document.getElementById('main-deposit-file-upload').click()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                  <polyline points="17 8 12 3 7 8"/>
                  <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                Upload Image
              </button>
              <input type="file" id="main-deposit-file-upload" style="display:none;" accept="image/*" onchange="previewMainDepositImage(this)">
              <input type="file" id="main-deposit-scan-upload" style="display:none;" accept="image/*" capture="environment" onchange="previewMainDepositImage(this)">
              <input type="hidden" id="deposit_slip_image_pth_txt" value="">
              <input type="hidden" id="deposit-image-path-hidden" value="">

              <button type="button" class="payment-deposit-btn-action" onclick="document.getElementById('main-deposit-scan-upload').click()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                  <circle cx="12" cy="13" r="4"/>
                </svg>
                Scan
              </button>
            </div>
            
            <!-- Global Component Hidden Dependencies for compatibility -->
            <div id="deposit_slip_image_not_found_body" style="display:none;"></div>
            <div id="deposit_slip_body" style="display:none;"><img id="deposit_slip_IMG" style="display:none;" alt=""></div>
            <div id="preloader" style="display:none;"></div>
            <div id="deposit_slip_del_request_body" style="display:none;"></div>
            <div id="deposit_slip_error_msg_body" style="display:none;"></div>
          </div>

          <div class="payment-deposit-footer-actions">
            <button type="button" class="payment-deposit-btn-cancel" onclick="main_dashboard_02_F_OPEN()">Cancel</button>
            <button type="button" class="payment-deposit-btn-submit" onclick="submitBankDeposit()">Submit</button>
          </div>

        </div>

      </section>
    </div>
  </main>

</div>

<?php include __DIR__ . '/JS/Main-Dashboard_02_G_JS.php'; ?>


</div>


