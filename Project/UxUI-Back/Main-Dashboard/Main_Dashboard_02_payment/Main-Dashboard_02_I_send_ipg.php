<?php 
    $pth = "../"; 
    $active_page = "payment-subscription";
    $page_title = "Send Payment IPG · bmjm Admin";
    include '../UxUI-Back/Includes/header.php'; 
?>

<style>
  /* ===================================================================
     bmjm Admin — Design tokens (shared values)
     =================================================================== */
  :root{
    --payment-type-green-950:#0B2E24;
    --payment-type-green-800:#123832;
    --payment-type-green-700:#1B4B41;
    --payment-type-gold-600:#B8923D;
    --payment-type-gold-500:#C9A227;
    --payment-type-gold-300:#E4C766;
    --payment-type-cream-50:#FAF7F0;
    --payment-type-cream-100:#F2EDE0;
    --payment-type-white:#FFFFFF;
    --payment-type-ink-900:#1E2B26;
    --payment-type-ink-600:#5A6A62;
    --payment-type-ink-400:#8B978F;
    --payment-type-border:#E6E0D0;
    --payment-type-radius-sm:8px;
    --payment-type-radius-lg:22px;
    --payment-type-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--payment-type-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--payment-type-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px; 
  }

  .payment-type-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .payment-type-topbar{
    grid-area:topbar;
    background:var(--payment-type-white);
    border-bottom:1px solid var(--payment-type-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .payment-type-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--payment-type-green-950);
  }
  .payment-type-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--payment-type-ink-400);}
  .payment-type-topbar-actions{display:flex;align-items:center;gap:18px;}
  .payment-type-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--payment-type-cream-100);color:var(--payment-type-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .payment-type-icon-btn:hover{background:var(--payment-type-gold-300);}
  .payment-type-icon-btn svg{width:16px;height:16px;}

  .payment-type-main{
    grid-area:main;
    padding:26px 30px 50px;
    display:flex;
    flex-direction:column;
  }

  .payment-type-breadcrumb{font-size:12px;color:var(--payment-type-ink-400);margin-bottom:16px;}
  .payment-type-breadcrumb a{color:var(--payment-type-ink-400);text-decoration:none;}
  .payment-type-breadcrumb a:hover{color:var(--payment-type-green-700);}
  .payment-type-breadcrumb span{color:var(--payment-type-green-700);font-weight:600;}

  /* IPG Modal Custom Styles */
  .ipg-modal-wrapper {
    flex: 1;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 10px 0 30px;
  }

  .ipg-modal-panel {
    width: 100%;
    max-width: 820px;
    background: #FAF7F0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
    border: 1px solid #e7e2d4;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
  }

  .ipg-modal-header {
    background: #0B2E24;
    color: #ffffff;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .ipg-modal-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: inherit;
    font-size: 18px;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: -0.01em;
  }
  .ipg-modal-title svg {
    width: 22px;
    height: 22px;
    color: #d4a320;
  }

  .ipg-modal-close {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,0.45);
    background: transparent;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    transition: all .15s ease;
    padding: 0;
  }
  .ipg-modal-close:hover {
    background: rgba(255,255,255,0.15);
    border-color: #ffffff;
  }

  .ipg-modal-body {
    padding: 24px;
    color: var(--payment-type-ink-900);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  .ipg-col-left {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .ipg-col-right {
    display: flex;
    flex-direction: column;
  }

  /* Left Column Cards */
  .ipg-card-white {
    background: #ffffff;
    border: 1px solid #e8e4d9;
    border-radius: 12px;
    padding: 18px 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02);
  }

  .ipg-card-header {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14.5px;
    font-weight: 700;
    color: #1E2B26;
  }
  .ipg-info-circle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 1.2px solid #94a3b8;
    color: #64748b;
    font-size: 10px;
    font-weight: 700;
    line-height: 1;
    font-style: normal;
    cursor: help;
  }

  /* Mint Big Amount Display */
  .ipg-mint-box {
    background: #edf7f1;
    border-radius: 10px;
    padding: 14px 18px;
    margin: 12px 0 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }
  .ipg-mint-currency {
    font-size: 20px;
    font-weight: 800;
    color: #0B2E24;
  }
  .ipg-mint-input {
    font-size: 36px;
    font-weight: 800;
    color: #0B2E24;
    background: transparent;
    border: none;
    outline: none;
    font-family: inherit;
    text-align: left;
    width: 180px;
  }
  .ipg-mint-input::-webkit-inner-spin-button,
  .ipg-mint-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .ipg-total-with-fees-label {
    text-align: center;
    font-size: 12px;
    color: #64748b;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    margin-top: 8px;
  }
  .ipg-total-with-fees-value {
    text-align: center;
    font-size: 17px;
    font-weight: 800;
    color: #0B2E24;
    margin-top: 2px;
  }

  /* Warning Alert Box */
  .ipg-alert-warning {
    background: #fef6e7;
    border: 1px solid #fde68a;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }
  .ipg-alert-icon {
    flex: 0 0 20px;
    margin-top: 1px;
    color: #d97706;
  }
  .ipg-alert-text {
    font-size: 12px;
    color: #92400e;
    line-height: 1.45;
    margin: 0;
  }

  /* Bank Fee Group */
  .ipg-fee-input-wrap {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid #d1d5db;
    border-radius: 8px;
    width: 140px;
    height: 42px;
    margin-top: 10px;
    overflow: hidden;
    background: #ffffff;
    transition: border-color .15s ease, box-shadow .15s ease;
  }
  .ipg-fee-input-wrap:focus-within {
    border-color: #0B2E24;
    box-shadow: 0 0 0 3px rgba(11, 46, 36, 0.12);
  }
  .ipg-fee-field {
    border: none;
    outline: none;
    width: 95px;
    height: 100%;
    padding: 0 12px;
    font-size: 15px;
    font-weight: 600;
    color: #1E2B26;
    background: transparent;
    font-family: inherit;
  }
  .ipg-fee-suffix {
    width: 45px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    border-left: 1px solid #e2e8f0;
    font-size: 14px;
    font-weight: 600;
    color: #475569;
  }

  /* Right Column: Delivery Method */
  .ipg-delivery-heading {
    font-size: 15px;
    font-weight: 700;
    color: #1E2B26;
    margin: 0 0 3px;
  }
  .ipg-delivery-subheading {
    font-size: 12.5px;
    color: #64748b;
    margin: 0 0 16px;
  }

  .ipg-delivery-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 24px;
  }

  .ipg-delivery-card {
    background: #ffffff;
    border: 1.5px solid #e8e4d9;
    border-radius: 12px;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    transition: all 0.15s ease;
    user-select: none;
  }
  .ipg-delivery-card:hover {
    border-color: #0B2E24;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  }

  .ipg-delivery-icon-box {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 32px;
  }
  .ipg-delivery-text {
    flex: 1;
    min-width: 0;
  }
  .ipg-delivery-title {
    font-size: 14px;
    font-weight: 700;
    color: #1E2B26;
    margin: 0 0 2px;
  }
  .ipg-delivery-desc {
    font-size: 12px;
    color: #64748b;
    margin: 0;
    line-height: 1.35;
  }

  .ipg-custom-checkbox {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    accent-color: #0B2E24;
    cursor: pointer;
    flex: 0 0 20px;
  }

  /* Footer Actions */
  .ipg-modal-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    margin-top: auto;
    padding-top: 14px;
  }
  .ipg-btn-cancel-custom {
    background: #ebe7dc;
    border: 1px solid #d5cfbf;
    border-radius: 8px;
    color: #1E2B26;
    height: 42px;
    padding: 0 24px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .15s ease;
  }
  .ipg-btn-cancel-custom:hover {
    background: #ded9cd;
  }

  .ipg-btn-process-custom {
    background: #DCA524;
    color: #1E2B26;
    border: none;
    border-radius: 8px;
    height: 42px;
    padding: 0 22px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 6px rgba(220,165,36,0.25);
    transition: all .15s ease;
  }
  .ipg-btn-process-custom:hover {
    background: #c8951d;
    box-shadow: 0 4px 12px rgba(220,165,36,0.35);
  }
  .ipg-btn-cancel-custom:active, .ipg-btn-process-custom:active {
    transform: translateY(1px);
  }

  @media (max-width: 820px){
    .payment-type-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-type-main{padding:20px 14px 40px;}
    .ipg-modal-body {
      grid-template-columns: 1fr;
      gap: 20px;
      padding: 18px;
    }
    .ipg-modal-footer {
      flex-direction: column-reverse;
      width: 100%;
    }
    .ipg-btn-cancel-custom, .ipg-btn-process-custom {
      width: 100%;
    }
  }
</style>

<div data-page="payment" id="Main_dashboard_02_I">

<div class="payment-type-app">

     <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="payment-type-topbar">
    <div class="payment-type-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="payment-type-topbar-actions">
      <button class="payment-type-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="payment-type-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="payment-type-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="payment-type-main">
    <p class="payment-type-breadcrumb">
      <a href="javascript:void(0);" onclick="if(typeof main_dashboard_02_A_OPEN === 'function') main_dashboard_02_A_OPEN();">Dashboard</a> /
      <a href="javascript:void(0);" onclick="if(typeof main_dashboard_02_A_OPEN === 'function') main_dashboard_02_A_OPEN();">Payment</a> /
      <a href="javascript:void(0);" onclick="if(typeof main_dashboard_02_C_OPEN === 'function') main_dashboard_02_C_OPEN();">Subscription</a> /
      <a href="javascript:void(0);" onclick="if(typeof main_dashboard_02_D_OPEN === 'function') main_dashboard_02_D_OPEN();">Choose Payment Type</a> /
      <span>Send Payment IPG.</span>
    </p>

    <div class="ipg-modal-wrapper">
      <section class="ipg-modal-panel" aria-label="Send Payment IPG">
        
        <div class="ipg-modal-header">
          <div class="ipg-modal-title">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Send Payment IPG
          </div>
          <button class="ipg-modal-close" onclick="if(typeof main_dashboard_02_D_OPEN === 'function') { main_dashboard_02_D_OPEN(); } else { window.history.back(); }" title="Close" aria-label="Close">✕</button>
        </div>

        <div class="ipg-modal-body">
          
          <!-- LEFT COLUMN -->
          <div class="ipg-col-left">
            <div class="ipg-card-white">
              <div class="ipg-card-header">
                Payment Amount (LKR)
                <span class="ipg-info-circle" title="Base amount before processing fee">i</span>
              </div>
              <div class="ipg-mint-box">
                <span class="ipg-mint-currency">LKR</span>
                <input type="number" id="ipg-base-amount-input" class="ipg-mint-input" value="200.00" step="0.01" oninput="updateBaseAmount()">
              </div>
              <div class="ipg-total-with-fees-label">
                Total to Charge (with fees)
                <span class="ipg-info-circle" title="Final amount charged including fee percentage">i</span>
              </div>
              <div class="ipg-total-with-fees-value">
                LKR <span id="ipg-due-amount-display">200.00</span>
              </div>
            </div>

            <div class="ipg-alert-warning">
              <div class="ipg-alert-icon">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
              </div>
              <p class="ipg-alert-text">
                A bank fee will be added to the total amount based on the percentage entered below. Please ensure the correct percentage is set before generating the payment link.
              </p>
            </div>

            <div class="ipg-card-white">
              <div class="ipg-card-header">
                Bank Fee Percentage
                <span class="ipg-info-circle" title="Percentage added as bank processing charge">i</span>
              </div>
              <div class="ipg-fee-input-wrap">
                <input type="number" id="ipg-bank-fee-input" value="0.0" step="0.1" min="0" class="ipg-fee-field" oninput="calculateIPGTotal()">
                <span class="ipg-fee-suffix">%</span>
              </div>
            </div>
          </div>

          <!-- RIGHT COLUMN -->
          <div class="ipg-col-right">
            <div>
              <div class="ipg-delivery-heading">Delivery Method</div>
              <div class="ipg-delivery-subheading">Select how you would like to send the payment link to the member.</div>

              <div class="ipg-delivery-options">
                <!-- SMS Option -->
                <div class="ipg-delivery-card" onclick="document.getElementById('ipg-send-sms').click()">
                  <div class="ipg-delivery-icon-box">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="#2563eb"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                  </div>
                  <div class="ipg-delivery-text">
                    <div class="ipg-delivery-title">Send payment link via SMS</div>
                    <div class="ipg-delivery-desc">The payment link will be sent to the member's registered mobile number.</div>
                  </div>
                  <input type="checkbox" id="ipg-send-sms" class="ipg-custom-checkbox" onclick="event.stopPropagation()">
                </div>

                <!-- Email Option -->
                <div class="ipg-delivery-card" onclick="document.getElementById('ipg-send-email').click()">
                  <div class="ipg-delivery-icon-box">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="#2563eb"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                  </div>
                  <div class="ipg-delivery-text">
                    <div class="ipg-delivery-title">Send payment link via Email</div>
                    <div class="ipg-delivery-desc">The payment link will be sent to the member's registered email address.</div>
                  </div>
                  <input type="checkbox" id="ipg-send-email" class="ipg-custom-checkbox" onclick="event.stopPropagation()">
                </div>

                <!-- WhatsApp Option -->
                <div class="ipg-delivery-card" onclick="document.getElementById('ipg-send-whatsapp').click()">
                  <div class="ipg-delivery-icon-box">
                    <svg viewBox="0 0 24 24" width="24" height="24" fill="#22c55e"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.05 22L7.3 20.62C8.75 21.41 10.38 21.83 12.04 21.83C17.5 21.83 21.95 17.38 21.95 11.92C21.95 9.27 20.92 6.78 19.05 4.91C17.18 3.03 14.69 2 12.04 2ZM12.05 20.15C10.57 20.15 9.12 19.75 7.85 19L7.55 18.82L4.43 19.64L5.26 16.59L5.06 16.27C4.24 14.97 3.8 13.46 3.8 11.91C3.8 7.37 7.5 3.67 12.05 3.67C14.25 3.67 16.31 4.53 17.87 6.09C19.42 7.65 20.28 9.72 20.28 11.92C20.28 16.46 16.59 20.15 12.05 20.15Z"/></svg>
                  </div>
                  <div class="ipg-delivery-text">
                    <div class="ipg-delivery-title">Send payment link via WhatsApp</div>
                    <div class="ipg-delivery-desc">The payment link will be sent via WhatsApp.</div>
                  </div>
                  <input type="checkbox" id="ipg-send-whatsapp" class="ipg-custom-checkbox" onclick="event.stopPropagation()">
                </div>
              </div>
            </div>

            <div class="ipg-modal-footer">
              <button type="button" class="ipg-btn-cancel-custom" onclick="if(typeof main_dashboard_02_D_OPEN === 'function') { main_dashboard_02_D_OPEN(); } else { window.history.back(); }">Cancel</button>
              <button type="button" class="ipg-btn-process-custom" onclick="processSendIPG()">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                Generate Payment Link
              </button>
            </div>
          </div>

        </div>

      </section>
    </div>
  </main>

</div>

</div>














<!-- 
//old code



<div class="container-fluid" id="DashBord_Payment_01_01_B_1_A_03_send_IPG">
    <div class="row w3-theme-l3">
        <div class="col-lg-3"></div>
        <div class="col-lg-6  ">
            <div class="container-fluid w3-theme-l4 w3-margin-bottom">
                <div class="row w3-theme-dark w3-padding-16">
                    <div class="col-lg-10 w3-xxlarge w3-strong w3-header w3-animate-zoom" id="Member_body_01_01_B_1_A_03_headding">
                        Send Payment IPG.
                    </div>
                    <div class="col-lg-2 w3-xlarge">
                        <button class="w3-button w3-round w3-theme-dark w3-hover-theme w3-padding w3-block w3-animate-zoom" onclick="DashBord_Payment_body_01_B_02_OPEN()">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-1"></div>

                    <div class="col-lg-10">
                        <div class="container-fluid w3-padding" id="Member_body_01_01_B_1_A_03_cash_subcription_data_body_03">
                            <div class="row w3-theme-l3 w3-padding">
                                <div class="col-lg-12 w3-padding w3-animate-zoom w3-center w3-xxlarge w3-strong">
                                    Due Amount
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 w3-padding w3-animate-zoom w3-center w3-xxlarge w3-strong" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_val_01">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                </div>

                <div class="row">
                    <div class="col-lg-1"></div>

                    <div class="col-lg-10 ">
                        <span class="w3-text-red w3-strong"> you add the bank fee, your total amount will increase by a small percentage. </span>
                    </div>
                    <div class="col-lg-1"></div>

                </div>

                <form method="POST" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_form_01" onsubmit="return DashBord_Payment_01_01_B_1_A_03_send_IPG_submit_form_01(event)">
                    <div class="row w3-margin-top">
                        <div class="col-lg-1"></div>

                        <div class="col-lg-10 w3-strong">
                            <span class="">Add Bank Fee</span>
                        </div>

                        <div class="col-lg-1"></div>

                    </div>

                    <div class="row ">
                        <div class="col-lg-1"></div>


                        <div class="col-lg-2">
                            <input type="number" class="w3-input w3-round w3-border w3-border-black w3-animate-zoom" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_val_02" name="DashBord_Payment_01_01_B_1_A_03_send_IPG_val_02" placeholder="0.0%">

                        </div>
                        <div class="col-lg-1 w3-strong w3-xlarge"> % </div>
                        <div class="col-lg-8"></div>

                    </div>


                    <div class="row">

                        <div class="col-lg-12 w3-strong w3-center w3-xlarge ">
                            Type
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>

                        <div class="col-lg-5 ">
                            <input type="checkbox" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_01" name="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_001" class="w3-check ">
                            <span class="w3-strong"> Send By SMS </span>
                        </div>
                        <div class="col-lg-3"></div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>


                        <div class="col-lg-5 ">
                            <input type="checkbox" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_02" name="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_002" class="w3-check ">
                            <span class="w3-strong"> Send By Email </span>
                        </div>
                        <div class="col-lg-3"></div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>

                        <div class="col-lg-5 ">
                            <input type="checkbox" id="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_03" name="DashBord_Payment_01_01_B_1_A_03_send_IPG_check_003" class="w3-check ">
                            <span class="w3-strong"> Send By URL By Whatsapp </span>
                        </div>
                        <div class="col-lg-3"></div>

                    </div>








                    <div class="row w3-margin-bottom">

                        <div class="col-lg-6 w3-margin-top">
                            <button type="button" class="w3-theme-dark w3-round w3-padding-16 w3-strong w3-button w3-block w3-animate-zoom" id="Member_body_01_01_B_1_A_03_cancel_btn" onclick="DashBord_Payment_body_01_B_02_OPEN()">
                                Cancel
                            </button>
                        </div>


                        <div class="col-lg-6 w3-margin-top">
                            <button type="submit" class="w3-theme-dark w3-round w3-padding-16 w3-strong w3-button w3-block w3-animate-zoom" id="Member_body_01_01_B_1_A_03_approve_btn">
                                Process
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-lg-3"></div>

    </div>
</div> -->
