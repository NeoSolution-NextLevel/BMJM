<?php
$bmjm_logout_base_path = isset($pth) ? $pth : '';

if ($bmjm_logout_base_path === '') {
  $bmjm_request_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
  $bmjm_path_parts = explode('/', trim($bmjm_request_path, '/'));
  array_pop($bmjm_path_parts);
  $bmjm_logout_base_path = str_repeat('../', count($bmjm_path_parts));
}

$bmjm_logout_url = $bmjm_logout_base_path . 'View-List/Main/Main_User_Logout.php';
$bmjm_login_url = $bmjm_logout_base_path . 'Login.php';
$bmjm_render_shared_header = empty($bmjm_suppress_shared_header);
$bmjm_header_title = isset($bmjm_header_title) ? $bmjm_header_title : 'Dashboard';
$bmjm_header_subtitle = isset($bmjm_header_subtitle) ? $bmjm_header_subtitle : 'Dashboard Control System';
?>
<?php if ($bmjm_render_shared_header): ?>
<header class="dashboard2-topbar">
    <div class="dashboard2-topbar-heading">
      <h1><?php echo htmlspecialchars($bmjm_header_title, ENT_QUOTES, 'UTF-8'); ?></h1>
      <p><?php echo htmlspecialchars($bmjm_header_subtitle, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
    <div class="dashboard2-topbar-actions">
      <!-- <button class="dashboard2-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="dashboard2-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button> -->
      <button
        type="button"
        class="dashboard2-icon-btn bmjm-user-logout-btn"
        title="Sign out"
        aria-label="Sign out"
        data-logout-url="<?php echo htmlspecialchars($bmjm_logout_url, ENT_QUOTES, 'UTF-8'); ?>"
        data-login-url="<?php echo htmlspecialchars($bmjm_login_url, ENT_QUOTES, 'UTF-8'); ?>"
      >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>
<?php endif; ?>

<?php if (!isset($bmjm_processing_loader_markup_loaded)): ?>
<?php $bmjm_processing_loader_markup_loaded = true; ?>
<style>
  #bmjm-processing-loader {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: rgba(11, 46, 36, 0.45);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
  }

  #bmjm-processing-loader.bmjm-processing-loader-show {
    display: flex;
  }

  .bmjm-processing-loader-card {
    width: min(360px, 100%);
    border: 1px solid rgba(228, 199, 102, 0.3);
    border-radius: 8px;
    background: #ffffff;
    box-shadow: 0 24px 60px rgba(11, 46, 36, 0.25);
    padding: 28px 24px;
    text-align: center;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
    color: #0B2E24;
  }

  .bmjm-processing-spinner {
    width: 48px;
    height: 48px;
    margin: 0 auto 18px;
    border-radius: 50%;
    border: 4px solid #F2EDE0;
    border-top-color: #C9A227;
    animation: bmjmProcessingSpin 0.8s linear infinite;
  }

  .bmjm-processing-title {
    font-size: 17px;
    font-weight: 800;
    margin-bottom: 6px;
  }

  .bmjm-processing-text {
    font-size: 13px;
    line-height: 1.45;
    color: #5A6A62;
  }

  .bmjm-processing-progress {
    height: 4px;
    margin-top: 18px;
    overflow: hidden;
    border-radius: 2px;
    background: #F2EDE0;
  }

  .bmjm-processing-progress-bar {
    display: block;
    width: 0;
    height: 100%;
    border-radius: inherit;
    background: #1B4B41;
    transition: width 0.24s ease;
  }

  #bmjm-processing-loader.bmjm-processing-loader-compact {
    inset: 0 0 auto;
    height: 4px;
    display: block;
    padding: 0;
    background: transparent;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
    pointer-events: none;
  }

  #bmjm-processing-loader.bmjm-processing-loader-compact .bmjm-processing-loader-card {
    width: 100%;
    padding: 0;
    border: 0;
    border-radius: 0;
    background: transparent;
    box-shadow: none;
  }

  #bmjm-processing-loader.bmjm-processing-loader-compact .bmjm-processing-spinner,
  #bmjm-processing-loader.bmjm-processing-loader-compact .bmjm-processing-title,
  #bmjm-processing-loader.bmjm-processing-loader-compact .bmjm-processing-text {
    display: none;
  }

  #bmjm-processing-loader.bmjm-processing-loader-compact .bmjm-processing-progress {
    height: 4px;
    margin: 0;
    border-radius: 0;
    background: rgba(27, 75, 65, 0.16);
  }

  @keyframes bmjmProcessingSpin {
    to { transform: rotate(360deg); }
  }
</style>

<div id="bmjm-processing-loader" role="status" aria-live="polite" aria-hidden="true">
  <div class="bmjm-processing-loader-card">
    <div class="bmjm-processing-spinner" aria-hidden="true"></div>
    <div class="bmjm-processing-title" id="bmjm-processing-loader-title">Processing...</div>
    <div class="bmjm-processing-text" id="bmjm-processing-loader-text">Please wait while the system saves your data.</div>
    <div class="bmjm-processing-progress" role="progressbar" aria-label="Request progress" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
      <span class="bmjm-processing-progress-bar"></span>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if (!isset($bmjm_ui_modals_loaded)): ?>
<?php $bmjm_ui_modals_loaded = true; ?>
<style>
  @keyframes bmjmModalSpin {
    to { transform: rotate(360deg); }
  }

  /* ---- Logout Confirmation Modal & Common Popup Modal ---- */
  #bmjm-logout-modal,
  #bmjm-common-popup {
    position: fixed;
    inset: 0;
    z-index: 100000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: rgba(11, 46, 36, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.25s cubic-bezier(0.2, 0.8, 0.2, 1), visibility 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
  }

  #bmjm-common-popup {
    z-index: 100001;
  }

  #bmjm-logout-modal.bmjm-logout-modal-open,
  #bmjm-common-popup.bmjm-popup-open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }

  .bmjm-logout-card,
  .bmjm-popup-card {
    position: relative;
    width: min(400px, 100%);
    background: #FFFFFF;
    border: 1px solid #E6E0D0;
    border-radius: 22px;
    box-shadow: 0 24px 64px rgba(11, 46, 36, 0.28), 0 4px 16px rgba(11, 46, 36, 0.08);
    padding: 30px 26px 26px;
    text-align: center;
    color: #1E2B26;
    transform: translateY(16px) scale(0.96);
    transition: transform 0.28s cubic-bezier(0.2, 0.8, 0.2, 1);
    overflow: hidden;
  }

  .bmjm-logout-card::before,
  .bmjm-popup-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #123832, #C9A227, #B0453A);
  }

  .bmjm-popup-card[data-popup-type="success"]::before {
    background: linear-gradient(90deg, #123832, #1B7A4A, #C9A227);
  }

  .bmjm-popup-card[data-popup-type="warning"]::before {
    background: linear-gradient(90deg, #C9A227, #B8923D);
  }

  .bmjm-popup-card[data-popup-type="error"]::before {
    background: linear-gradient(90deg, #B0453A, #D45B4E);
  }

  .bmjm-popup-card[data-popup-type="info"]::before {
    background: linear-gradient(90deg, #0B2E24, #1B4B41, #C9A227);
  }

  #bmjm-logout-modal.bmjm-logout-modal-open .bmjm-logout-card,
  #bmjm-common-popup.bmjm-popup-open .bmjm-popup-card {
    transform: translateY(0) scale(1);
  }

  .bmjm-logout-close,
  .bmjm-popup-close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid #E6E0D0;
    background: #FAF7F0;
    color: #5A6A62;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0;
    transition: all 0.2s ease;
  }

  .bmjm-logout-close:hover,
  .bmjm-popup-close:hover {
    background: #F2EDE0;
    color: #0B2E24;
    transform: rotate(90deg);
  }

  .bmjm-logout-close svg,
  .bmjm-popup-close svg {
    width: 16px;
    height: 16px;
  }

  .bmjm-logout-icon-wrap,
  .bmjm-popup-icon-wrap {
    width: 64px;
    height: 64px;
    margin: 4px auto 18px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(176, 69, 58, 0.14), rgba(201, 162, 39, 0.12));
    border: 1px solid rgba(176, 69, 58, 0.2);
    color: #B0453A;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 20px rgba(176, 69, 58, 0.12);
  }

  .bmjm-popup-card[data-popup-type="success"] .bmjm-popup-icon-wrap {
    background: linear-gradient(135deg, rgba(27, 122, 74, 0.15), rgba(27, 122, 74, 0.06));
    border-color: rgba(27, 122, 74, 0.24);
    color: #1B7A4A;
    box-shadow: 0 8px 20px rgba(27, 122, 74, 0.12);
  }

  .bmjm-popup-card[data-popup-type="warning"] .bmjm-popup-icon-wrap {
    background: linear-gradient(135deg, rgba(201, 162, 39, 0.18), rgba(184, 146, 61, 0.08));
    border-color: rgba(201, 162, 39, 0.32);
    color: #9A741C;
    box-shadow: 0 8px 20px rgba(201, 162, 39, 0.14);
  }

  .bmjm-popup-card[data-popup-type="error"] .bmjm-popup-icon-wrap {
    background: linear-gradient(135deg, rgba(176, 69, 58, 0.15), rgba(176, 69, 58, 0.06));
    border-color: rgba(176, 69, 58, 0.25);
    color: #B0453A;
    box-shadow: 0 8px 20px rgba(176, 69, 58, 0.12);
  }

  .bmjm-popup-card[data-popup-type="info"] .bmjm-popup-icon-wrap {
    background: linear-gradient(135deg, rgba(18, 56, 50, 0.14), rgba(201, 162, 39, 0.1));
    border-color: rgba(18, 56, 50, 0.22);
    color: #123832;
    box-shadow: 0 8px 20px rgba(11, 46, 36, 0.1);
  }

  .bmjm-logout-icon-wrap svg,
  .bmjm-popup-icon-wrap svg {
    width: 28px;
    height: 28px;
  }

  .bmjm-logout-title,
  .bmjm-popup-title {
    font-family: 'Poppins', 'Inter', sans-serif;
    font-size: 20px;
    font-weight: 700;
    color: #0B2E24;
    margin: 0 0 8px;
    letter-spacing: -0.01em;
  }

  .bmjm-logout-desc,
  .bmjm-popup-desc {
    font-size: 13.5px;
    line-height: 1.55;
    color: #5A6A62;
    margin: 0 0 22px;
    word-break: break-word;
  }

  .bmjm-logout-error {
    display: none;
    margin: 0 0 18px;
    padding: 10px 14px;
    border-radius: 10px;
    background: rgba(176, 69, 58, 0.1);
    border: 1px solid rgba(176, 69, 58, 0.28);
    color: #B0453A;
    font-size: 12.5px;
    font-weight: 600;
    text-align: left;
    align-items: center;
    gap: 8px;
  }

  .bmjm-logout-error.is-visible {
    display: flex;
  }

  .bmjm-logout-error svg {
    width: 16px;
    height: 16px;
    flex: 0 0 16px;
  }

  .bmjm-logout-actions,
  .bmjm-popup-actions {
    display: flex;
    gap: 12px;
  }

  .bmjm-logout-btn,
  .bmjm-popup-btn {
    flex: 1;
    height: 44px;
    border-radius: 10px;
    font-family: inherit;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.18s ease;
    outline: none;
  }

  .bmjm-logout-btn:disabled,
  .bmjm-popup-btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
  }

  .bmjm-logout-btn-cancel {
    background: #FAF7F0;
    border: 1px solid #E6E0D0;
    color: #1E2B26;
  }

  .bmjm-logout-btn-cancel:hover:not(:disabled) {
    background: #F2EDE0;
    border-color: #D5CEBC;
  }

  .bmjm-logout-btn-confirm {
    background: linear-gradient(135deg, #C24B3F, #9E352B);
    border: none;
    color: #FFFFFF;
    box-shadow: 0 6px 16px rgba(176, 69, 58, 0.3);
  }

  .bmjm-logout-btn-confirm:hover:not(:disabled) {
    box-shadow: 0 8px 22px rgba(176, 69, 58, 0.42);
    transform: translateY(-1px);
  }

  .bmjm-logout-btn-confirm:active:not(:disabled) {
    transform: translateY(0);
  }

  .bmjm-popup-btn-primary {
    background: linear-gradient(135deg, #C9A227, #B8923D);
    border: none;
    color: #0B2E24;
    box-shadow: 0 6px 16px rgba(184, 146, 61, 0.32);
  }

  .bmjm-popup-card[data-popup-type="success"] .bmjm-popup-btn-primary {
    background: linear-gradient(135deg, #1B7A4A, #125835);
    color: #FFFFFF;
    box-shadow: 0 6px 16px rgba(27, 122, 74, 0.28);
  }

  .bmjm-popup-card[data-popup-type="error"] .bmjm-popup-btn-primary {
    background: linear-gradient(135deg, #C24B3F, #9E352B);
    color: #FFFFFF;
    box-shadow: 0 6px 16px rgba(176, 69, 58, 0.28);
  }

  .bmjm-popup-btn-primary:hover:not(:disabled) {
    transform: translateY(-1px);
    filter: brightness(1.03);
  }

  .bmjm-popup-btn-primary:active:not(:disabled) {
    transform: translateY(0);
  }

  .bmjm-logout-btn-spinner {
    display: none;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.35);
    border-top-color: #FFFFFF;
    animation: bmjmModalSpin 0.7s linear infinite;
  }

  #bmjm-logout-modal.is-loading .bmjm-logout-btn-spinner {
    display: inline-block;
  }

  #bmjm-logout-modal.is-loading .bmjm-logout-btn-icon {
    display: none;
  }

  @media (max-width: 520px) {
    #bmjm-logout-modal,
    #bmjm-common-popup {
      align-items: flex-end;
      padding: 12px;
    }

    .bmjm-logout-card,
    .bmjm-popup-card {
      width: 100%;
      max-width: none;
      border-radius: 20px;
      padding: 26px 20px 20px;
      transform: translateY(32px);
    }

    #bmjm-logout-modal.bmjm-logout-modal-open .bmjm-logout-card,
    #bmjm-common-popup.bmjm-popup-open .bmjm-popup-card {
      transform: translateY(0);
    }

    .bmjm-logout-actions {
      flex-direction: column-reverse;
      gap: 10px;
    }

    .bmjm-logout-btn,
    .bmjm-popup-btn {
      width: 100%;
      height: 46px;
      font-size: 14px;
    }
  }
</style>

<div id="bmjm-logout-modal" role="dialog" aria-modal="true" aria-labelledby="bmjm-logout-modal-title" aria-describedby="bmjm-logout-modal-desc" aria-hidden="true">
  <div class="bmjm-logout-card">
    <button type="button" class="bmjm-logout-close" id="bmjm-logout-modal-close" aria-label="Close dialog" title="Close">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="bmjm-logout-icon-wrap" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/>
        <line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
    </div>
    <h2 class="bmjm-logout-title" id="bmjm-logout-modal-title">Sign Out?</h2>
    <p class="bmjm-logout-desc" id="bmjm-logout-modal-desc">Are you sure you want to end your current session? You will need to sign in again to access your dashboard.</p>
    <div class="bmjm-logout-error" id="bmjm-logout-modal-error" role="alert">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span id="bmjm-logout-modal-error-text">Sign out failed. Please try again.</span>
    </div>
    <div class="bmjm-logout-actions">
      <button type="button" class="bmjm-logout-btn bmjm-logout-btn-cancel" id="bmjm-logout-modal-cancel">Cancel</button>
      <button type="button" class="bmjm-logout-btn bmjm-logout-btn-confirm" id="bmjm-logout-modal-confirm">
        <span class="bmjm-logout-btn-spinner" aria-hidden="true"></span>
        <svg class="bmjm-logout-btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        <span id="bmjm-logout-modal-confirm-text">Yes, Sign Out</span>
      </button>
    </div>
  </div>
</div>

<div id="bmjm-common-popup" role="alertdialog" aria-modal="true" aria-labelledby="bmjm-common-popup-title" aria-describedby="bmjm-common-popup-desc" aria-hidden="true">
  <div class="bmjm-popup-card" id="bmjm-common-popup-card" data-popup-type="info">
    <button type="button" class="bmjm-popup-close" id="bmjm-common-popup-close" aria-label="Close notification" title="Close">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="bmjm-popup-icon-wrap" id="bmjm-common-popup-icon" aria-hidden="true"></div>
    <h2 class="bmjm-popup-title" id="bmjm-common-popup-title">Notice</h2>
    <p class="bmjm-popup-desc" id="bmjm-common-popup-desc"></p>
    <div class="bmjm-popup-actions">
      <button type="button" class="bmjm-popup-btn bmjm-popup-btn-primary" id="bmjm-common-popup-ok">OK</button>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if (!isset($bmjm_logout_script_loaded)): ?>
<?php $bmjm_logout_script_loaded = true; ?>
<script>
window.bmjmLogoutUrl = <?php echo json_encode($bmjm_logout_url); ?>;
window.bmjmLoginUrl = <?php echo json_encode($bmjm_login_url); ?>;

(function initbmjmProcessingLoader(){
  if (window.bmjmProcessingLoaderReady) return;
  window.bmjmProcessingLoaderReady = true;

  var activeProcessCount = 0;
  var hideTimer = null;
  var progressTimers = [];
  var mutationUrlPattern = /(ADD_UPDATE|UPDATE_DATA|Create_|create_|add_|process_new|process_|submit_|save_|remove|DELETE|TOGGLE|image_upload|image_remove|Create_member_bank_deposit|create_new_expense)/i;

  function getLoader() {
    return document.getElementById('bmjm-processing-loader');
  }

  function clearProgressTimers() {
    progressTimers.forEach(function(timer) { clearTimeout(timer); });
    progressTimers = [];
  }

  function setProgress(loader, value) {
    var progress = loader.querySelector('.bmjm-processing-progress');
    var progressBar = loader.querySelector('.bmjm-processing-progress-bar');
    if (progress) progress.setAttribute('aria-valuenow', String(value));
    if (progressBar) progressBar.style.width = value + '%';
  }

  function startProgress(loader) {
    clearProgressTimers();
    loader.classList.remove('bmjm-processing-loader-compact');
    setProgress(loader, 8);
    progressTimers.push(setTimeout(function() { setProgress(loader, 36); }, 120));
    progressTimers.push(setTimeout(function() { setProgress(loader, 58); }, 320));
    progressTimers.push(setTimeout(function() {
      setProgress(loader, 70);
      loader.classList.add('bmjm-processing-loader-compact');
      loader.setAttribute('aria-hidden', 'true');
    }, 650));
  }

  function showProcessing(title, text) {
    var loader = getLoader();
    if (!loader) return;

    var titleEl = document.getElementById('bmjm-processing-loader-title');
    var textEl = document.getElementById('bmjm-processing-loader-text');

    if (titleEl) titleEl.textContent = title || 'Processing...';
    if (textEl) textEl.textContent = text || 'Please wait while the system saves your data.';

    if (hideTimer) {
      clearTimeout(hideTimer);
      hideTimer = null;
    }

    loader.classList.add('bmjm-processing-loader-show');
    loader.setAttribute('aria-hidden', 'false');
    startProgress(loader);
  }

  function hideProcessing(force) {
    var loader = getLoader();
    if (!loader) return;

    if (force) activeProcessCount = 0;
    if (activeProcessCount > 0) return;

    clearProgressTimers();
    setProgress(loader, 100);
    hideTimer = setTimeout(function() {
      loader.classList.remove('bmjm-processing-loader-show', 'bmjm-processing-loader-compact');
      loader.setAttribute('aria-hidden', 'true');
      setProgress(loader, 0);
    }, 150);
  }

  function beginProcessing(title, text) {
    activeProcessCount++;
    showProcessing(title, text);
  }

  function endProcessing() {
    activeProcessCount = Math.max(0, activeProcessCount - 1);
    hideProcessing(false);
  }

  function shouldShowForRequest(method, url) {
    var requestMethod = (method || 'GET').toUpperCase();
    var requestUrl = String(url || '');
    if (requestMethod === 'GET' || /Main_User_Logout\.php/i.test(requestUrl)) return false;
    return mutationUrlPattern.test(requestUrl) || requestMethod === 'POST' || requestMethod === 'PUT' || requestMethod === 'PATCH' || requestMethod === 'DELETE';
  }

  window.bmjmShowProcessing = function(title, text) {
    activeProcessCount = Math.max(activeProcessCount, 1);
    showProcessing(title, text);
  };

  window.bmjmHideProcessing = function() {
    activeProcessCount = 0;
    hideProcessing(true);
  };

  if (typeof window.preloader_show !== 'function') {
    window.preloader_show = function() {
      window.bmjmShowProcessing('Processing...', 'Please wait while the system completes your request.');
    };
  }

  if (typeof window.preloader_hide !== 'function') {
    window.preloader_hide = function() {
      window.bmjmHideProcessing();
    };
  }

  if (typeof window.pre_loader_show !== 'function') {
    window.pre_loader_show = window.preloader_show;
  }

  if (typeof window.pre_loader_hide !== 'function') {
    window.pre_loader_hide = window.preloader_hide;
  }

  if (typeof window.admin_panel_perloader_show !== 'function') {
    window.admin_panel_perloader_show = window.preloader_show;
  }

  if (typeof window.admin_panel_perloader_hide !== 'function') {
    window.admin_panel_perloader_hide = window.preloader_hide;
  }

  function bindJqueryLoader() {
    if (!window.jQuery || window.bmjmJqueryLoaderBound) return;
    window.bmjmJqueryLoaderBound = true;

    window.jQuery(document)
      .ajaxSend(function(event, jqXHR, settings) {
        if (!settings || !shouldShowForRequest(settings.type || settings.method, settings.url)) return;
        jqXHR.bmjmShowsProcessing = true;
        beginProcessing('Processing...', 'Please wait while the system saves your data.');
      })
      .ajaxComplete(function(event, jqXHR) {
        if (!jqXHR || !jqXHR.bmjmShowsProcessing || jqXHR.bmjmProcessingFinished) return;
        jqXHR.bmjmProcessingFinished = true;
        endProcessing();
      });
  }

  bindJqueryLoader();
  if (!window.bmjmJqueryLoaderBound) {
    var jqueryWait = setInterval(function() {
      bindJqueryLoader();
      if (window.bmjmJqueryLoaderBound) clearInterval(jqueryWait);
    }, 250);
    setTimeout(function() { clearInterval(jqueryWait); }, 5000);
  }

  if (window.fetch && !window.bmjmFetchLoaderBound) {
    window.bmjmFetchLoaderBound = true;
    var originalFetch = window.fetch.bind(window);

    window.fetch = function(input, init) {
      var requestMethod = init && init.method ? init.method : (input && input.method ? input.method : 'GET');
      var requestUrl = typeof input === 'string' ? input : (input && input.url ? input.url : '');
      var showLoader = shouldShowForRequest(requestMethod, requestUrl);

      if (showLoader) {
        beginProcessing('Processing...', 'Please wait while the system saves your data.');
      }

      return originalFetch(input, init).finally(function() {
        if (showLoader) endProcessing();
      });
    };
  }

  document.addEventListener('submit', function(event) {
    var form = event.target;
    if (!form || !form.tagName || form.tagName.toLowerCase() !== 'form') return;

    var method = (form.getAttribute('method') || 'GET').toUpperCase();
    if (method === 'POST' || shouldShowForRequest(method, form.getAttribute('action'))) {
      setTimeout(function() {
        if (event.defaultPrevented) return;
        window.bmjmShowProcessing('Processing...', 'Please wait while the system submits your data.');
      }, 0);
    }
  }, true);
})();

(function initBmjmCommonPopup(){
  if (window.bmjmCommonPopupReady) return;
  window.bmjmCommonPopupReady = true;

  var popupOnCloseCallback = null;
  var popupReturnFocusEl = null;

  var ICONS = {
    success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
    error: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    warning: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
    info: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>'
  };

  var DEFAULT_TITLES = {
    success: 'Success',
    error: 'Something Went Wrong',
    warning: 'Attention Required',
    info: 'Notice'
  };

  function inferPopupType(msg) {
    var text = String(msg || '').toLowerCase();
    if (/success|submitted|recorded|completed|verified/.test(text)) return 'success';
    if (/please enter|please select|please upload|please fill|please choose|valid amount|valid paid/.test(text)) return 'warning';
    if (/error|failed|invalid|unable|network/.test(text)) return 'error';
    return 'info';
  }

  window.bmjmShowPopup = function(optionsOrMessage, type, title, onClose) {
    var modal = document.getElementById('bmjm-common-popup');
    if (modal && modal.parentNode !== document.body) {
      document.body.appendChild(modal);
    }
    var card = document.getElementById('bmjm-common-popup-card');
    var iconEl = document.getElementById('bmjm-common-popup-icon');
    var titleEl = document.getElementById('bmjm-common-popup-title');
    var descEl = document.getElementById('bmjm-common-popup-desc');
    var okBtn = document.getElementById('bmjm-common-popup-ok');

    var opts = {};
    if (optionsOrMessage && typeof optionsOrMessage === 'object') {
      opts = optionsOrMessage;
    } else {
      opts = {
        message: String(optionsOrMessage !== undefined ? optionsOrMessage : ''),
        type: type,
        title: title,
        onClose: onClose
      };
    }

    var resolvedType = opts.type || inferPopupType(opts.message);
    if (!ICONS[resolvedType]) resolvedType = 'info';
    var resolvedTitle = opts.title || DEFAULT_TITLES[resolvedType];
    var resolvedBtnText = opts.buttonText || 'OK';

    if (!modal || !card) return;

    popupReturnFocusEl = document.activeElement;
    popupOnCloseCallback = typeof opts.onClose === 'function' ? opts.onClose : null;

    card.setAttribute('data-popup-type', resolvedType);
    if (iconEl) iconEl.innerHTML = ICONS[resolvedType];
    if (titleEl) titleEl.textContent = resolvedTitle;
    if (descEl) descEl.textContent = opts.message || '';
    if (okBtn) okBtn.textContent = resolvedBtnText;

    modal.classList.add('bmjm-popup-open');
    modal.setAttribute('aria-hidden', 'false');

    setTimeout(function() {
      if (okBtn) okBtn.focus();
    }, 50);
  };

  window.bmjmClosePopup = function() {
    var modal = document.getElementById('bmjm-common-popup');
    if (!modal || !modal.classList.contains('bmjm-popup-open')) return;
    modal.classList.remove('bmjm-popup-open');
    modal.setAttribute('aria-hidden', 'true');

    var cb = popupOnCloseCallback;
    var focusEl = popupReturnFocusEl;
    popupOnCloseCallback = null;
    popupReturnFocusEl = null;

    if (typeof cb === 'function') {
      cb();
    } else if (focusEl && typeof focusEl.focus === 'function') {
      focusEl.focus();
    }
  };

  document.addEventListener('DOMContentLoaded', function() {
    var popupModal = document.getElementById('bmjm-common-popup');
    if (popupModal && popupModal.parentNode !== document.body) {
      document.body.appendChild(popupModal);
    }
  });

  document.addEventListener('click', function(event) {
    var modal = document.getElementById('bmjm-common-popup');
    if (!modal || !modal.classList.contains('bmjm-popup-open')) return;
    if (event.target === modal || event.target.closest('#bmjm-common-popup-close, #bmjm-common-popup-ok')) {
      event.preventDefault();
      window.bmjmClosePopup();
    }
  });

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      var modal = document.getElementById('bmjm-common-popup');
      if (modal && modal.classList.contains('bmjm-popup-open')) {
        event.preventDefault();
        window.bmjmClosePopup();
      }
    }
  });
})();

(function initbmjmUserLogout(){
  if (window.bmjmUserLogoutReady) return;
  window.bmjmUserLogoutReady = true;

  var pendingTriggerBtn = null;
  var isLoggingOut = false;

  function getModalElements() {
    var modal = document.getElementById('bmjm-logout-modal');
    if (modal && modal.parentNode !== document.body) {
      document.body.appendChild(modal);
    }
    return {
      modal: modal,
      closeBtn: document.getElementById('bmjm-logout-modal-close'),
      cancelBtn: document.getElementById('bmjm-logout-modal-cancel'),
      confirmBtn: document.getElementById('bmjm-logout-modal-confirm'),
      confirmText: document.getElementById('bmjm-logout-modal-confirm-text'),
      errorBox: document.getElementById('bmjm-logout-modal-error'),
      errorText: document.getElementById('bmjm-logout-modal-error-text')
    };
  }

  document.addEventListener('DOMContentLoaded', function() {
    var logoutModal = document.getElementById('bmjm-logout-modal');
    if (logoutModal && logoutModal.parentNode !== document.body) {
      document.body.appendChild(logoutModal);
    }
  });

  function setModalLoading(loading) {
    isLoggingOut = loading;
    var els = getModalElements();
    if (!els.modal) return;
    els.modal.classList.toggle('is-loading', loading);
    if (els.cancelBtn) els.cancelBtn.disabled = loading;
    if (els.closeBtn) els.closeBtn.disabled = loading;
    if (els.confirmBtn) els.confirmBtn.disabled = loading;
    if (els.confirmText) els.confirmText.textContent = loading ? 'Signing Out...' : 'Yes, Sign Out';
  }

  function showModalError(message) {
    var els = getModalElements();
    if (!els.errorBox || !els.errorText) return;
    els.errorText.textContent = message || 'Sign out failed. Please try again.';
    els.errorBox.classList.add('is-visible');
  }

  function clearModalError() {
    var els = getModalElements();
    if (!els.errorBox) return;
    els.errorBox.classList.remove('is-visible');
  }

  function openLogoutModal(triggerBtn) {
    var els = getModalElements();
    if (!els.modal) return;
    pendingTriggerBtn = triggerBtn || null;
    clearModalError();
    setModalLoading(false);
    els.modal.classList.add('bmjm-logout-modal-open');
    els.modal.setAttribute('aria-hidden', 'false');
    setTimeout(function() {
      if (els.cancelBtn) els.cancelBtn.focus();
    }, 50);
  }

  function closeLogoutModal() {
    if (isLoggingOut) return;
    var els = getModalElements();
    if (!els.modal) return;
    els.modal.classList.remove('bmjm-logout-modal-open');
    els.modal.setAttribute('aria-hidden', 'true');
    clearModalError();
    if (pendingTriggerBtn && typeof pendingTriggerBtn.focus === 'function') {
      pendingTriggerBtn.focus();
    }
    pendingTriggerBtn = null;
  }

  function redirectToLogin(loginUrl) {
    window.location.href = loginUrl || '../Login.php';
  }

  function executeLogout() {
    if (isLoggingOut) return;
    var button = pendingTriggerBtn;
    var logoutUrl = (button && button.getAttribute('data-logout-url')) || window.bmjmLogoutUrl || '../View-List/Main/Main_User_Logout.php';
    var loginUrl = (button && button.getAttribute('data-login-url')) || window.bmjmLoginUrl || '../Login.php';

    clearModalError();
    setModalLoading(true);
    if (button) button.disabled = true;

    fetch(logoutUrl, {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then(function(response) {
        if (!response.ok) {
          throw new Error('Logout request failed');
        }
        return response.json();
      })
      .then(function(data) {
        var result = Array.isArray(data) ? data[0] : data;
        if (result && result.error === '0') {
          redirectToLogin(loginUrl);
          return;
        }
        throw new Error(result && result.error ? result.error : 'Sign out failed. Please try again.');
      })
      .catch(function(error) {
        console.error('bmjm logout failed:', error);
        if (button) button.disabled = false;
        setModalLoading(false);
        showModalError(error && error.message ? error.message : 'Sign out failed. Please try again.');
      });
  }

  document.addEventListener('click', function(event) {
    var modal = document.getElementById('bmjm-logout-modal');
    if (modal && modal.classList.contains('bmjm-logout-modal-open')) {
      if (event.target === modal || event.target.closest('#bmjm-logout-modal-close, #bmjm-logout-modal-cancel')) {
        event.preventDefault();
        closeLogoutModal();
        return;
      }
      if (event.target.closest('#bmjm-logout-modal-confirm')) {
        event.preventDefault();
        executeLogout();
        return;
      }
    }

    var button = event.target.closest('.bmjm-user-logout-btn, button[title="Sign out"], button[aria-label="Sign out"], [data-logout-action="main-user"]');
    if (!button) return;

    event.preventDefault();
    openLogoutModal(button);
  });

  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      var modal = document.getElementById('bmjm-logout-modal');
      if (modal && modal.classList.contains('bmjm-logout-modal-open')) {
        event.preventDefault();
        closeLogoutModal();
      }
    }
  });
})();
</script>
<?php endif; ?>
