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
    if (requestMethod === 'GET') return false;
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

(function initbmjmUserLogout(){
  if (window.bmjmUserLogoutReady) return;
  window.bmjmUserLogoutReady = true;

  function redirectToLogin(loginUrl) {
    window.location.href = loginUrl || '../Login.php';
  }

  document.addEventListener('click', function(event) {
    var button = event.target.closest('.bmjm-user-logout-btn, button[title="Sign out"], button[aria-label="Sign out"], [data-logout-action="main-user"]');
    if (!button) return;

    event.preventDefault();

    var logoutUrl = button.getAttribute('data-logout-url') || window.bmjmLogoutUrl || '../View-List/Main/Main_User_Logout.php';
    var loginUrl = button.getAttribute('data-login-url') || window.bmjmLoginUrl || '../Login.php';

    button.disabled = true;

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
        throw new Error(result && result.error ? result.error : 'Logout failed');
      })
      .catch(function(error) {
        console.error('bmjm logout failed:', error);
        button.disabled = false;
        alert('Logout failed. Please try again.');
      });
  });
})();
</script>
<?php endif; ?>
