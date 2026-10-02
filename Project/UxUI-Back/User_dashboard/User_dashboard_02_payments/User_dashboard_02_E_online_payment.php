<?php 
$pth = "../";
$active_page = "dashboard2";
$page_title = "Pay Online · Bmjm Member";

include_once __DIR__ . '/../../../imports/Company_Info/Company_Info_Variable_List.php';
$Company_Info = new Company_Info_Variable_List();
$is_onpay_on = $Company_Info->get_is_onpay_active(); 
$is_payhere_on = $Company_Info->get_is_payhere_active();

// include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     bmjm Member Dashboard — Pay Online IPG (Unique Namespace: ud2e-)
     =================================================================== */
  :root{
    --ud2e-green-950:#0B2E24; --ud2e-green-800:#123832;
    --ud2e-green-700:#1B4B41; --ud2e-green-600:#245F52;
    --ud2e-gold-600:#B8923D; --ud2e-gold-500:#C9A227; --ud2e-gold-300:#E4C766;
    --ud2e-cream-50:#FAF7F0; --ud2e-cream-100:#F2EDE0; --ud2e-white:#FFFFFF;
    --ud2e-ink-900:#1E2B26; --ud2e-ink-600:#5A6A62; --ud2e-ink-400:#8B978F;
    --ud2e-border:#E6E0D0;
    --ud2e-radius-sm:8px; --ud2e-radius-md:16px; --ud2e-radius-lg:16px;
    --ud2e-shadow:0 12px 32px rgba(11,46,36,0.06);
    --ud2e-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--ud2e-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--ud2e-ink-900); -webkit-font-smoothing:antialiased;
  }

  .ud2e-app{
    display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr;
    min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .ud2e-topbar{
    grid-area:topbar; background:var(--ud2e-white); border-bottom:1px solid var(--ud2e-border);
    display:flex; align-items:center; justify-content:space-between; padding:0 28px;
  }
  .ud2e-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif; font-size:18px; font-weight:600; margin:0; color:var(--ud2e-green-950);
  }
  .ud2e-topbar-heading p{ margin:2px 0 0; font-size:12px; color:var(--ud2e-ink-400); }
  .ud2e-topbar-actions{display:flex;align-items:center;gap:10px;}
  .ud2e-icon-btn{
    width:36px;height:36px;border-radius:10px; display:flex;align-items:center;justify-content:center;
    background:var(--ud2e-cream-100); color:var(--ud2e-green-800); border:1px solid var(--ud2e-border);cursor:pointer; transition:all .2s ease;
  }
  .ud2e-icon-btn:hover{
    background:var(--ud2e-gold-300); border-color:var(--ud2e-gold-500); color: var(--ud2e-green-950);
  }
  .ud2e-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .ud2e-main{
    grid-area:main; padding:28px 32px 36px; min-width: 0;
    display:flex; align-items:flex-start; justify-content:center;
    min-height:calc(100vh - 64px);
    animation: ud2eFadeSlideUp 0.6s var(--ud2e-cubic) forwards;
  }
  @keyframes ud2eFadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  .ud2e-panel {
    width:100%; max-width:640px;
    background: var(--ud2e-white); border-radius: var(--ud2e-radius-lg);
    border: 1px solid var(--ud2e-border); box-shadow: var(--ud2e-shadow); overflow: hidden;
  }
  .ud2e-panel-header {
    background: linear-gradient(135deg, var(--ud2e-green-800), var(--ud2e-green-950));
    color: var(--ud2e-cream-50); padding: 22px 30px;
    display: flex; justify-content: space-between; align-items: center;
  }
  .ud2e-panel-title {
    display:flex; align-items:center; gap:12px;
    font-family:'Poppins', sans-serif; font-size:20px; font-weight:700;
  }
  .ud2e-panel-title svg { width:20px; height:20px; color:var(--ud2e-gold-300); }
  .ud2e-panel-close {
    width:32px; height:32px; border-radius:50%; border:1px solid rgba(250,247,240,0.25);
    background:transparent; color:var(--ud2e-cream-50); display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .2s ease; text-decoration:none;
  }
  .ud2e-panel-close:hover { background:rgba(250,247,240,0.15); }

  .ud2e-body { padding: 32px; }

  /* Amount Box */
  .ud2e-amount-box {
    background: var(--ud2e-cream-50); border: 2px solid var(--ud2e-border);
    border-radius: var(--ud2e-radius-md); padding: 24px; text-align: center;
    margin-bottom: 24px; transition: border-color 0.2s ease;
  }
  .ud2e-amount-box:focus-within { border-color: var(--ud2e-gold-500); }
  .ud2e-amount-label {
    font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
    color: var(--ud2e-ink-600); margin-bottom: 10px; display: block;
  }
  .ud2e-amount-input-wrap {
    display: flex; align-items: center; justify-content: center; gap: 8px;
  }
  .ud2e-currency-tag {
    font-size: 26px; font-weight: 800; color: var(--ud2e-green-950); font-family: 'Poppins', sans-serif;
  }
  .ud2e-amount-input {
    width: 240px; border: none; background: transparent; text-align: center;
    font-size: 38px; font-weight: 800; font-family: 'Poppins', sans-serif;
    color: var(--ud2e-green-950); outline: none;
  }
  .ud2e-amount-input::-webkit-inner-spin-button, .ud2e-amount-input::-webkit-outer-spin-button {
    -webkit-appearance: none; margin: 0;
  }

  /* Quick Amount Chips */
  .ud2e-preset-label {
    font-size: 12.5px; font-weight: 600; color: var(--ud2e-ink-600); margin-bottom: 8px; display: block;
  }
  .ud2e-presets-grid {
    display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; justify-content: center;
  }
  .ud2e-preset-chip {
    padding: 8px 16px; border-radius: 20px; border: 1px solid var(--ud2e-border);
    background: var(--ud2e-white); font-size: 13px; font-weight: 600; color: var(--ud2e-green-950);
    cursor: pointer; transition: all 0.2s ease;
  }
  .ud2e-preset-chip:hover, .ud2e-preset-chip.active {
    background: var(--ud2e-green-950); color: var(--ud2e-gold-300); border-color: var(--ud2e-green-950);
  }

  /* Gateway Security Banner */
  .ud2e-security-card {
    display: flex; align-items: center; gap: 14px; background: var(--ud2e-cream-100);
    border: 1px solid var(--ud2e-border); border-radius: var(--ud2e-radius-sm); padding: 14px 18px;
    margin-bottom: 24px;
  }
  .ud2e-security-icon { color: var(--ud2e-gold-600); flex-shrink: 0; }
  .ud2e-security-text p { margin: 0; font-size: 12.5px; color: var(--ud2e-ink-600); line-height: 1.4; }
  .ud2e-security-text strong { color: var(--ud2e-green-950); font-weight: 600; }

  /* Payment Gateway Badges */
  .ud2e-badges-row {
    display: flex; align-items: center; justify-content: center; gap: 16px; margin-bottom: 24px;
    font-size: 12px; font-weight: 600; color: var(--ud2e-ink-400);
  }
  .ud2e-badge-pill {
    padding: 4px 12px; border-radius: 12px; background: var(--ud2e-cream-100);
    font-size: 11px; font-weight: 700; color: var(--ud2e-green-800); border: 1px solid var(--ud2e-border);
  }

  .ud2e-gateway-selector { margin-bottom: 20px; }
  .ud2e-gateway-label {
    color: var(--ud2e-ink-600); font-size: 12.5px; font-weight: 600;
    text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px;
  }
  .ud2e-gateway-options { display: flex; gap: 12px; }
  .ud2e-gateway-option {
    flex: 1; background: var(--ud2e-cream-50); border: 1px solid var(--ud2e-border);
    padding: 12px; border-radius: var(--ud2e-radius-sm); cursor: pointer;
    display: flex; align-items: center; gap: 8px; font-weight: 600;
    font-size: 13.5px; color: var(--ud2e-green-950); min-width: 0;
  }

  /* Footer Actions */
  .ud2e-footer-actions {
    display: flex; gap: 14px; margin-top: 10px;
  }
  .ud2e-btn-cancel, .ud2e-btn-pay {
    flex: 1; height: 50px; border-radius: var(--ud2e-radius-sm); border: none;
    font-size: 14.5px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center;
    gap: 10px; transition: all 0.2s ease; text-decoration: none;
  }
  .ud2e-btn-cancel {
    background: var(--ud2e-cream-100); color: var(--ud2e-ink-900);
  }
  .ud2e-btn-cancel:hover { background: var(--ud2e-border); color: var(--ud2e-green-950); }
  .ud2e-btn-pay {
    background: linear-gradient(135deg, var(--ud2e-gold-500), var(--ud2e-gold-600));
    color: var(--ud2e-green-950); box-shadow: 0 4px 14px rgba(184,146,61,0.3);
  }
  .ud2e-btn-pay:hover {
    transform: translateY(-1px); box-shadow: 0 6px 20px rgba(184,146,61,0.4);
    background: linear-gradient(135deg, var(--ud2e-gold-300), var(--ud2e-gold-500));
  }

  @media (max-width: 768px) {
    .ud2e-app { grid-template-columns: 1fr; grid-template-areas: "topbar" "main"; }
    .ud2e-topbar { min-height: 64px; padding: 10px 14px; gap: 12px; }
    .ud2e-topbar-heading h1 { font-size: 16px; line-height: 1.25; }
    .ud2e-topbar-heading p { font-size: 11.5px; }
    .ud2e-topbar-actions { gap: 6px; }
    .ud2e-icon-btn { width: 34px; height: 34px; border-radius: 8px; }
    .ud2e-main { padding: 14px; min-height: calc(100vh - 64px); align-items: stretch; }
    .ud2e-panel { max-width: none; border-radius: 12px; }
    .ud2e-panel-header { padding: 16px; gap: 12px; }
    .ud2e-panel-title { font-size: 17px; line-height: 1.25; gap: 10px; min-width: 0; }
    .ud2e-panel-title svg { width: 18px; height: 18px; flex-shrink: 0; }
    .ud2e-panel-close { flex-shrink: 0; }
    .ud2e-body { padding: 16px; }
    .ud2e-amount-box { padding: 18px 12px; margin-bottom: 18px; }
    .ud2e-amount-input-wrap { gap: 6px; }
    .ud2e-currency-tag { font-size: 20px; }
    .ud2e-amount-input { width: min(100%, 190px); font-size: 30px; }
    .ud2e-presets-grid { justify-content: flex-start; gap: 8px; margin-bottom: 18px; }
    .ud2e-preset-chip { flex: 1 1 calc(50% - 8px); min-width: 124px; padding: 9px 10px; }
    .ud2e-security-card { align-items: flex-start; padding: 14px; margin-bottom: 18px; }
    .ud2e-badges-row { flex-wrap: wrap; justify-content: flex-start; gap: 8px; margin-bottom: 18px; }
    .ud2e-badges-row > span:first-child { flex-basis: 100%; }
    .ud2e-gateway-options { flex-direction: column; gap: 8px; }
    .ud2e-gateway-option { width: 100%; }
    .ud2e-footer-actions { flex-direction: column; }
    .ud2e-footer-actions button { width: 100%; min-height: 48px; }
    .ud2e-btn-pay { min-height: 52px; line-height: 1.25; padding: 0 12px; text-align: center; }
  }

  @media (max-width: 380px) {
    .ud2e-main { padding: 10px; }
    .ud2e-body { padding: 12px; }
    .ud2e-panel-header { padding: 14px 12px; }
    .ud2e-panel-title { font-size: 15.5px; }
    .ud2e-amount-input-wrap { flex-wrap: wrap; }
    .ud2e-amount-input { width: 100%; font-size: 28px; }
    .ud2e-preset-chip { flex-basis: 100%; }
  }
</style>

<div data-page="payment" id="user_dashboard_02_E">
  <div class="ud2e-app">
    <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="ud2e-topbar">
      <div class="ud2e-topbar-heading">
        <h1>Online Payment Gateway</h1>
        <p>Instant secure card checkout</p>
      </div>
      <div class="ud2e-topbar-actions">
        <!-- <button class="ud2e-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="ud2e-icon-btn" title="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button> -->
        <button
          type="button"
          class="ud2e-icon-btn bmjm-user-logout-btn"
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
    <main class="ud2e-main">
      <section class="ud2e-panel">
        <div class="ud2e-panel-header">
          <div class="ud2e-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/><path d="M6 15h2"/><path d="M12 15h4"/></svg>
            Pay Online (IPG Gateway)
          </div>
          <a class="ud2e-panel-close" onclick="user_dashboard_02_C_OPEN()">✕</a>
        </div>

        <div class="ud2e-body">
          <form id="ud2e-ipg-form" onsubmit="user_dashboard_proceed_to_ipg(event)">
            
            <div class="ud2e-amount-box">
              <span class="ud2e-amount-label">Enter Amount to Pay</span>
              <div class="ud2e-amount-input-wrap">
                <span class="ud2e-currency-tag">LKR</span>
                <input type="number" class="ud2e-amount-input" id="ud2e-amount-field" placeholder="0.00" min="1" step="0.01" required>
              </div>
            </div>

            <span class="ud2e-preset-label">Or select a quick amount:</span>
            <div class="ud2e-presets-grid">
              <button type="button" class="ud2e-preset-chip" onclick="ud2eSetAmount(500)">LKR 500</button>
              <button type="button" class="ud2e-preset-chip" onclick="ud2eSetAmount(1000)">LKR 1,000</button>
              <button type="button" class="ud2e-preset-chip" onclick="ud2eSetAmount(2500)">LKR 2,500</button>
              <button type="button" class="ud2e-preset-chip" onclick="ud2eSetAmount(5000)">LKR 5,000</button>
              <button type="button" class="ud2e-preset-chip" onclick="ud2eSetAmount(10000)">LKR 10,000</button>
            </div>

            <div class="ud2e-security-card">
              <div class="ud2e-security-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              </div>
              <div class="ud2e-security-text">
                <p><strong>256-Bit Encrypted Payment Gateway</strong><br>You will be redirected to the secure bank checkout page to complete your payment.</p>
              </div>
            </div>

            <!-- Dynamic Payment Gateway Selector -->
            <?php if ($is_onpay_on == 1 && $is_payhere_on == 1): ?>
              <div class="ud2e-gateway-selector">
                <div class="ud2e-gateway-label">Select Payment Gateway</div>
                <div class="ud2e-gateway-options">
                  <label class="ud2e-gateway-option">
                    <input type="radio" name="payment_gateway" value="onepay" checked>
                    OnePay Gateway
                  </label>
                  <label class="ud2e-gateway-option">
                    <input type="radio" name="payment_gateway" value="payhere">
                    PayHere Gateway
                  </label>
                </div>
              </div>
            <?php elseif ($is_onpay_on == 1): ?>
              <input type="hidden" name="payment_gateway" value="onepay">
            <?php elseif ($is_payhere_on == 1): ?>
              <input type="hidden" name="payment_gateway" value="payhere">
            <?php else: ?>
              <input type="hidden" name="payment_gateway" value="onepay">
            <?php endif; ?>

            <div class="ud2e-badges-row">
              <span>Accepted Methods:</span>
              <span class="ud2e-badge-pill">VISA</span>
              <span class="ud2e-badge-pill">MasterCard</span>
              <span class="ud2e-badge-pill">AMEX</span>
            </div>

            <div class="ud2e-footer-actions">
              <button type="button" class="ud2e-btn-cancel" onclick="user_dashboard_02_C_OPEN()">Cancel</button>
              <button type="submit" class="ud2e-btn-pay">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                Proceed to Payment Gateway
              </button>
            </div>

          </form>

          <!-- Hidden Form Forwarder to Active IPG Handler -->
          <form id="pay-form-forwarder" method="POST" action="../../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php">
            <input type="hidden" name="ipg_send_by_url_sec_id" id="forward-ipg-sec-id" value="">
            <input type="hidden" name="customer-pay-amount" id="forward-customer-pay-amount" value="">
          </form>

        </div>
      </section>
    </main>
  </div>
</div>

<script>
  function ud2eSetAmount(val) {
    document.getElementById('ud2e-amount-field').value = val;
    document.querySelectorAll('.ud2e-preset-chip').forEach(function(chip) {
      chip.classList.remove('active');
    });
    if (event && event.target) {
      event.target.classList.add('active');
    }
  }

  function user_dashboard_proceed_to_ipg(event) {
    event.preventDefault();
    var amt = parseFloat(document.getElementById('ud2e-amount-field').value);
    if (isNaN(amt) || amt <= 0) {
      alert("Please enter a valid amount to proceed.");
      return;
    }

    var btn = document.querySelector('.ud2e-btn-pay');
    var originalHtml = btn.innerHTML;
    btn.innerHTML = 'Connecting to Payment Gateway...';
    btn.disabled = true;
    btn.style.opacity = '0.75';
    btn.style.pointerEvents = 'none';
    if (typeof bmjmShowProcessing === 'function') {
      bmjmShowProcessing('Connecting to payment gateway...', 'Please wait while we prepare your secure checkout.');
    }

    var gwElement = document.querySelector('input[name="payment_gateway"]:checked') || document.querySelector('input[name="payment_gateway"][type="hidden"]');
    var gw = gwElement ? gwElement.value : 'onepay';

    var payload = new FormData();
    payload.append('project_id', '1');
    payload.append('project_name', 'bmjm Member Online Payment');
    payload.append('amount', amt);
    payload.append('is_member', '0');
    payload.append('name', 'Member Payment');
    payload.append('phone', '0770000000');

    fetch('../../../UxUi/Payment_IPG/Project_IPG_Public_Processor.php', {
      method: 'POST',
      body: payload
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
      if (res.error === "0" && res.sec_id) {
        document.getElementById('forward-ipg-sec-id').value = res.sec_id;
        document.getElementById('forward-customer-pay-amount').value = amt;

        var f = document.getElementById('pay-form-forwarder');
        if (gw === 'payhere') {
          f.action = "../../../View-List/Payment_gateway/PayHere/payment_gatways_process_payhere.php";
        } else {
          f.action = "../../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php";
        }
        if (typeof bmjmShowProcessing === 'function') {
          bmjmShowProcessing('Redirecting...', 'Please wait while we send you to the payment gateway.');
        }
        f.submit();
      } else {
        if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
        btn.innerHTML = originalHtml;
        btn.disabled = false;
        btn.style.opacity = '1';
        btn.style.pointerEvents = 'auto';
        alert(res.message || "Failed to initialize payment gateway session. Please try again.");
      }
    })
    .catch(function(e) {
      if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
      btn.innerHTML = originalHtml;
      btn.disabled = false;
      btn.style.opacity = '1';
      btn.style.pointerEvents = 'auto';
      alert("Network error communicating with payment gateway server.");
    });
  }
</script>

