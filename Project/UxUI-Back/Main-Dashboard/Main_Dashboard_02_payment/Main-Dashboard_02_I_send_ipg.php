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
  }

  .ipg-modal-panel {
    width: 100%;
    background: var(--payment-type-cream-50);
    border-radius: var(--payment-type-radius-lg);
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    overflow: hidden;
    border: 1px solid var(--payment-type-border);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
  }

  .ipg-modal-header {
    background: linear-gradient(135deg, var(--payment-type-green-800), var(--payment-type-green-950));
    color: var(--payment-type-cream-50);
    padding: 24px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .ipg-modal-title {
    display: flex; align-items: center; gap: 12px;
    font-family: 'Poppins', Inter, sans-serif;
    font-size: 20px;
    font-weight: 600;
  }
  .ipg-modal-title svg {
    width: 20px; height: 20px; color: var(--payment-type-gold-300);
  }

  .ipg-modal-close {
    width: 32px; height: 32px; border-radius: 50%;
    border: 1px solid rgba(250,247,240,0.25);
    background: transparent; color: var(--payment-type-cream-50);
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; cursor: pointer; transition: background .15s ease;
  }
  .ipg-modal-close:hover {
    background: rgba(250,247,240,0.12);
  }

  .ipg-modal-body {
    padding: 32px;
    color: var(--payment-type-ink-900);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
  }

  .ipg-col-left {
    display: flex;
    flex-direction: column;
  }

  .ipg-col-right {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .ipg-amount-box {
    background: var(--payment-type-white);
    padding: 32px 24px;
    border-radius: var(--payment-type-radius-sm);
    text-align: center;
    margin-bottom: 24px;
    border: 1px solid var(--payment-type-border);
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
  }

  .ipg-amount-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--payment-type-ink-600);
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .ipg-amount-value {
    width: 100%;
    text-align: center;
    border: none;
    font-size: 42px;
    font-weight: 800;
    font-family: inherit;
    color: var(--payment-type-green-950);
    background: transparent;
    outline: none;
    transition: color 0.2s;
  }
  
  .ipg-amount-value:focus {
    color: var(--payment-type-gold-600);
  }
  .ipg-amount-value::-webkit-inner-spin-button, 
  .ipg-amount-value::-webkit-outer-spin-button { 
    -webkit-appearance: none; margin: 0; 
  }
  
  .ipg-final-total-display {
    font-size: 14px;
    font-weight: 500;
    color: var(--payment-type-ink-600);
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px dashed var(--payment-type-border);
  }
  .ipg-final-total-display strong {
    color: var(--payment-type-green-950);
    font-size: 16px;
  }

  .ipg-warning-note {
    color: var(--payment-type-gold-600);
    background: var(--payment-type-cream-100);
    border: 1px solid var(--payment-type-border);
    border-radius: var(--payment-type-radius-sm);
    padding: 16px 20px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 24px;
    line-height: 1.5;
    display: flex; gap: 12px; align-items: center;
  }

  .ipg-bank-fee-group {
    background: var(--payment-type-white);
    border: 1px solid var(--payment-type-border);
    border-radius: var(--payment-type-radius-sm);
    padding: 24px;
  }

  .ipg-bank-fee-label {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--payment-type-ink-900);
    margin-bottom: 12px;
    display: block;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }

  .ipg-bank-fee-input-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .ipg-bank-fee-input {
    width: 120px;
    height: 46px;
    border: 1px solid var(--payment-type-border);
    border-radius: var(--payment-type-radius-sm);
    padding: 0 16px;
    font-size: 16px;
    font-weight: 600;
    background: var(--payment-type-cream-50);
    color: var(--payment-type-ink-900);
    outline: none;
    transition: border-color 0.15s ease, box-shadow .15s ease;
  }
  .ipg-bank-fee-input:focus {
    border-color: var(--payment-type-gold-500);
    box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.15);
  }

  .ipg-bank-fee-symbol {
    font-size: 18px;
    font-weight: 700;
    color: var(--payment-type-ink-600);
  }

  .ipg-type-heading {
    text-align: left;
    font-size: 14px;
    font-weight: 600;
    color: var(--payment-type-ink-900);
    margin: 0 0 20px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--payment-type-border);
    padding-bottom: 12px;
  }

  .ipg-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 32px;
  }

  .ipg-checkbox-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 15px;
    font-weight: 500;
    color: var(--payment-type-ink-900);
    cursor: pointer;
    background: var(--payment-type-white);
    padding: 16px 20px;
    border: 1px solid var(--payment-type-border);
    border-radius: var(--payment-type-radius-sm);
    transition: background 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
  }
  .ipg-checkbox-label:hover {
    background: var(--payment-type-cream-100);
    border-color: var(--payment-type-ink-400);
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  }

  .ipg-checkbox-label input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--payment-type-green-700);
  }

  .ipg-modal-footer {
    display: flex;
    gap: 16px;
    margin-top: auto;
  }

  .ipg-btn {
    flex: 1;
    height: 52px;
    border: none;
    border-radius: var(--payment-type-radius-sm);
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: transform .1s ease, box-shadow .15s ease, background .15s ease;
    display: inline-flex; justify-content: center; align-items: center; gap: 10px;
  }

  .ipg-btn:active {
    transform: translateY(1px);
  }

  .ipg-btn-cancel {
    background: var(--payment-type-cream-100);
    color: var(--payment-type-ink-900);
    border: 1px solid var(--payment-type-border);
  }

  .ipg-btn-cancel:hover {
    background: #E8E2D2;
  }

  .ipg-btn-process {
    background: linear-gradient(135deg, var(--payment-type-gold-500), var(--payment-type-gold-600));
    color: var(--payment-type-green-950);
    box-shadow: 0 4px 12px rgba(184, 146, 61, 0.35);
  }

  .ipg-btn-process:hover {
    background: linear-gradient(135deg, var(--payment-type-gold-300), var(--payment-type-gold-500));
    box-shadow: 0 6px 16px rgba(184, 146, 61, 0.45);
  }

  @media (max-width:900px){
    .payment-type-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
    .payment-type-main{padding:26px 18px 50px;}
    .ipg-modal-body{grid-template-columns: 1fr;}
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
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Send Payment IPG.
          </div>
          <button class="ipg-modal-close" onclick="if(typeof main_dashboard_02_D_OPEN === 'function') { main_dashboard_02_D_OPEN(); } else { window.history.back(); }" title="Close" aria-label="Close">✕</button>
        </div>

        <div class="ipg-modal-body">
          
          <div class="ipg-col-left">
            <div class="ipg-amount-box">
              <label class="ipg-amount-title" for="ipg-base-amount-input">Adjustable Base Amount (LKR)</label>
              <input type="number" id="ipg-base-amount-input" class="ipg-amount-value" value="0.00" oninput="updateBaseAmount()">
              <div class="ipg-final-total-display">
                Total to Charge (with fees): <strong><span id="ipg-due-amount-display">0.00</span></strong>
              </div>
            </div>

            <div class="ipg-warning-note">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
              If you add a bank fee, your total amount will increase by that percentage automatically prior to generating the link.
            </div>

            <div class="ipg-bank-fee-group">
              <label class="ipg-bank-fee-label" for="ipg-bank-fee-input">Add Bank Fee Percentage</label>
              <div class="ipg-bank-fee-input-wrap">
                <input type="number" id="ipg-bank-fee-input" value="0.0" step="0.1" min="0" class="ipg-bank-fee-input" oninput="calculateIPGTotal()">
                <span class="ipg-bank-fee-symbol">%</span>
              </div>
            </div>
          </div>

          <div class="ipg-col-right">
            <div>
              <div class="ipg-type-heading">Delivery Method</div>

              <div class="ipg-checkbox-group">
                <label class="ipg-checkbox-label">
                  <span>Send By SMS</span>
                  <input type="checkbox" id="ipg-send-sms">
                </label>

                <label class="ipg-checkbox-label">
                  <span>Send By Email</span>
                  <input type="checkbox" id="ipg-send-email">
                </label>

                <label class="ipg-checkbox-label">
                  <span>Send By URL By Whatsapp</span>
                  <input type="checkbox" id="ipg-send-whatsapp">
                </label>
              </div>
            </div>

            <div class="ipg-modal-footer">
              <button type="button" class="ipg-btn ipg-btn-cancel" onclick="if(typeof main_dashboard_02_D_OPEN === 'function') { main_dashboard_02_D_OPEN(); } else { window.history.back(); }">Cancel</button>
              <button type="button" class="ipg-btn ipg-btn-process" onclick="processSendIPG()">Process Payment Link</button>
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
