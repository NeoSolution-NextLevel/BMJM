<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';
include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
$company_obj = new Company_Info_Variable_List();
if (empty($_SESSION['forgot_password_csrf'])) {
    $_SESSION['forgot_password_csrf'] = bin2hex(random_bytes(32));
}
$forgot_password_csrf = $_SESSION['forgot_password_csrf'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#0B2E24">
<title>Forgot Password | bmjm Mosque</title>
<link rel="icon" type="image/x-icon" href="<?php echo htmlspecialchars($company_obj->get_compnay_logo_icon_url(), ENT_QUOTES, 'UTF-8'); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --reset-green-950: #0B2E24;
    --reset-green-800: #123832;
    --reset-green-700: #1B4B41;
    --reset-gold-600: #B8923D;
    --reset-gold-500: #C9A227;
    --reset-gold-300: #E4C766;
    --reset-cream-50: #FAF7F0;
    --reset-cream-100: #F2EDE0;
    --reset-white: #FFFFFF;
    --reset-ink-900: #1E2B26;
    --reset-ink-600: #5A6A62;
    --reset-border: #E6E0D0;
    --reset-danger: #B0453A;
    --reset-radius: 8px;
    --reset-shadow: 0 18px 48px rgba(11, 46, 36, 0.13);
  }

  * { box-sizing: border-box; }
  [hidden] { display: none !important; }

  html, body { margin: 0; min-height: 100%; }

  body {
    min-height: 100vh;
    display: grid;
    grid-template-rows: 64px 1fr 46px;
    background: var(--reset-cream-50);
    color: var(--reset-ink-900);
    font-family: 'Inter', sans-serif;
  }

  .reset-site-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 0 clamp(18px, 5vw, 64px);
    background: var(--reset-green-950);
    border-bottom: 2px solid var(--reset-gold-500);
    color: var(--reset-white);
  }

  .reset-site-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    color: inherit;
    text-decoration: none;
  }

  .reset-site-brand img {
    width: 44px;
    height: 44px;
    object-fit: contain;
  }

  .reset-site-brand strong {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    line-height: 1.2;
  }

  .reset-site-brand span {
    display: block;
    margin-top: 2px;
    color: rgba(255,255,255,.65);
    font-size: 11px;
  }

  .reset-header-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--reset-cream-50);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
  }

  .reset-header-link:hover { color: var(--reset-gold-300); }
  .reset-header-link svg { width: 17px; height: 17px; }

  .reset-main {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 34px 20px;
  }

  .reset-shell {
    width: min(920px, 100%);
    min-height: 520px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
    border: 1px solid var(--reset-border);
    border-radius: var(--reset-radius);
    background: var(--reset-white);
    box-shadow: var(--reset-shadow);
  }

  .reset-brand-panel {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    overflow: hidden;
    padding: 42px;
    color: var(--reset-cream-50);
    background: var(--reset-green-950);
  }

  .reset-brand-photo {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .reset-brand-panel::after {
    position: absolute;
    inset: 0;
    content: "";
    background: linear-gradient(180deg, rgba(11,46,36,.30), rgba(11,46,36,.94));
  }

  .reset-brand-content { position: relative; z-index: 1; }

  .reset-brand-logo {
    width: 116px;
    height: 116px;
    object-fit: contain;
    margin-bottom: 28px;
  }

  .reset-brand-content h1 {
    margin: 0 0 12px;
    font-family: 'Poppins', sans-serif;
    font-size: 29px;
    line-height: 1.25;
    letter-spacing: 0;
  }

  .reset-brand-content p {
    max-width: 340px;
    margin: 0;
    color: rgba(250,247,240,.78);
    font-size: 14px;
    line-height: 1.65;
  }

  .reset-form-panel {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 46px;
  }

  .reset-form-heading h2 {
    margin: 0 0 7px;
    color: var(--reset-green-950);
    font-family: 'Poppins', sans-serif;
    font-size: 24px;
    letter-spacing: 0;
  }

  .reset-form-heading p {
    margin: 0 0 28px;
    color: var(--reset-ink-600);
    font-size: 13.5px;
    line-height: 1.55;
  }

  .reset-methods {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 22px;
    padding: 4px;
    border: 1px solid var(--reset-border);
    border-radius: var(--reset-radius);
    background: var(--reset-cream-50);
  }

  .reset-method { position: relative; }
  .reset-method input { position: absolute; opacity: 0; pointer-events: none; }

  .reset-method label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    border-radius: 5px;
    color: var(--reset-ink-600);
    cursor: pointer;
    font-size: 13px;
    font-weight: 700;
  }

  .reset-method input:checked + label {
    background: var(--reset-green-700);
    color: var(--reset-white);
    box-shadow: 0 2px 8px rgba(11,46,36,.16);
  }

  .reset-method svg { width: 17px; height: 17px; }
  .reset-field { margin-bottom: 20px; }

  .reset-field label {
    display: block;
    margin-bottom: 8px;
    color: var(--reset-green-950);
    font-size: 12.5px;
    font-weight: 700;
  }

  .reset-input-wrap { position: relative; }

  .reset-input-wrap svg {
    position: absolute;
    top: 50%;
    left: 14px;
    width: 18px;
    height: 18px;
    color: var(--reset-ink-600);
    transform: translateY(-50%);
    pointer-events: none;
  }

  .reset-input {
    width: 100%;
    height: 48px;
    padding: 0 14px 0 44px;
    border: 1px solid var(--reset-border);
    border-radius: var(--reset-radius);
    outline: none;
    color: var(--reset-ink-900);
    background: var(--reset-white);
    font: inherit;
    font-size: 14px;
  }

  .reset-input:focus {
    border-color: var(--reset-gold-500);
    box-shadow: 0 0 0 3px rgba(201,162,39,.16);
  }

  .reset-hint {
    display: block;
    margin-top: 7px;
    color: var(--reset-ink-600);
    font-size: 11.5px;
  }

  .reset-submit {
    width: 100%;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border: 0;
    border-radius: var(--reset-radius);
    background: var(--reset-gold-500);
    color: var(--reset-green-950);
    cursor: pointer;
    font: inherit;
    font-size: 14px;
    font-weight: 800;
  }

  .reset-submit:hover { background: var(--reset-gold-300); }
  .reset-submit:disabled { opacity: .65; cursor: wait; }
  .reset-submit svg { width: 18px; height: 18px; }

  .reset-message {
    display: none;
    margin-top: 16px;
    padding: 11px 13px;
    border: 1px solid rgba(27,75,65,.24);
    border-radius: var(--reset-radius);
    background: rgba(27,75,65,.07);
    color: var(--reset-green-800);
    font-size: 12.5px;
    line-height: 1.45;
  }

  .reset-message.is-error {
    border-color: rgba(176,69,58,.30);
    background: rgba(176,69,58,.08);
    color: var(--reset-danger);
  }

  .reset-code-input {
    padding-left: 14px;
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: 6px;
  }

  .reset-step-title {
    margin: 0 0 8px;
    color: var(--reset-green-950);
    font-family: 'Poppins', sans-serif;
    font-size: 17px;
    letter-spacing: 0;
  }

  .reset-step-copy {
    margin: 0 0 20px;
    color: var(--reset-ink-600);
    font-size: 12.5px;
    line-height: 1.55;
  }

  .reset-back {
    display: flex;
    justify-content: center;
    margin-top: 22px;
  }

  .reset-back a {
    color: var(--reset-green-700);
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
  }

  .reset-back a:hover { color: var(--reset-gold-600); }

  .reset-site-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 0 clamp(18px, 5vw, 64px);
    background: var(--reset-green-950);
    color: rgba(255,255,255,.65);
    font-size: 11.5px;
  }

  .reset-site-footer strong { color: var(--reset-cream-50); font-weight: 600; }

  @media (max-width: 760px) {
    body { grid-template-rows: 58px 1fr auto; }
    .reset-site-brand span { display: none; }
    .reset-main { align-items: flex-start; padding: 18px 14px 24px; }
    .reset-shell { grid-template-columns: 1fr; min-height: 0; }
    .reset-brand-panel { min-height: 210px; padding: 24px; }
    .reset-brand-logo { width: 78px; height: 78px; margin-bottom: 14px; }
    .reset-brand-content h1 { font-size: 21px; }
    .reset-brand-content p { font-size: 12.5px; }
    .reset-form-panel { padding: 28px 22px 32px; }
    .reset-input, .reset-submit { height: 50px; font-size: 16px; }
    .reset-site-footer { min-height: 58px; flex-direction: column; justify-content: center; gap: 4px; text-align: center; }
  }
</style>
</head>
<body>
  <header class="reset-site-header">
    <a class="reset-site-brand" href="../../Login.php" aria-label="bmjm login">
      <img src="../../assets/images/logo_dashboard.png" alt="bmjm logo">
      <span>
        <strong><?php echo htmlspecialchars($company_obj->get_compnay_name(), ENT_QUOTES, 'UTF-8'); ?></strong>
        <span>Member Management System</span>
      </span>
    </a>
    <a class="reset-header-link" href="../../Login.php">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/><path d="M9 12h10"/></svg>
      Back to login
    </a>
  </header>

  <main class="reset-main">
    <section class="reset-shell" aria-labelledby="reset-title">
      <div class="reset-brand-panel">
        <img class="reset-brand-photo" src="../../assets/images/mosque.jpg" alt="" aria-hidden="true">
        <div class="reset-brand-content">
          <img class="reset-brand-logo" src="../../assets/images/logo_dashboard.png" alt="bmjm logo">
          <h1>Recover your account securely.</h1>
          <p>Choose your registered contact method and we will help you return to your member account.</p>
        </div>
      </div>

      <div class="reset-form-panel">
        <div class="reset-form-heading">
          <h2 id="reset-title">Forgot password?</h2>
          <p>Select where you would like to receive your password reset code.</p>
        </div>

        <form id="reset-form" method="post" action="#">
          <input type="hidden" id="reset-csrf" value="<?php echo htmlspecialchars($forgot_password_csrf, ENT_QUOTES, 'UTF-8'); ?>">

          <div id="request-step">
            <div class="reset-methods" aria-label="Reset method">
            <div class="reset-method">
              <input type="radio" id="email-method" name="reset-method" value="email" checked>
              <label for="email-method">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                Email
              </label>
            </div>
            <div class="reset-method">
              <input type="radio" id="sms-method" name="reset-method" value="sms">
              <label for="sms-method">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M10 18h4"/></svg>
                SMS
              </label>
            </div>
            </div>

            <div class="reset-field" id="email-group">
            <label for="reset-email">Registered email</label>
            <div class="reset-input-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
              <input class="reset-input" id="reset-email" type="email" name="email" placeholder="name@example.com" autocomplete="email" required>
            </div>
            <span class="reset-hint">Use the email connected to your bmjm account.</span>
            </div>

            <div class="reset-field" id="mobile-group" hidden>
            <label for="reset-mobile">Registered mobile number</label>
            <div class="reset-input-wrap">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M10 18h4"/></svg>
              <input class="reset-input" id="reset-mobile" type="tel" name="mobile" placeholder="07X XXX XXXX" autocomplete="tel" pattern="[+0-9 ()-]+" disabled>
            </div>
            <span class="reset-hint">Use the mobile number registered with your account.</span>
            </div>

            <button class="reset-submit" id="send-code-button" type="submit">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
              Send reset code
            </button>
          </div>

          <div id="verify-step" hidden>
            <h3 class="reset-step-title">Enter verification code</h3>
            <p class="reset-step-copy">Enter the six-digit code sent to your selected contact method. It expires in 10 minutes.</p>
            <div class="reset-field">
              <label for="reset-code">Verification code</label>
              <input class="reset-input reset-code-input" id="reset-code" type="text" inputmode="numeric" autocomplete="one-time-code" maxlength="6" pattern="[0-9]{6}">
            </div>
            <button class="reset-submit" id="verify-code-button" type="button">
              Verify code
            </button>
          </div>

          <div id="password-step" hidden>
            <h3 class="reset-step-title">Choose a new password</h3>
            <p class="reset-step-copy">Use at least eight characters and choose a password you do not use elsewhere.</p>
            <div class="reset-field">
              <label for="new-password">New password</label>
              <input class="reset-input" id="new-password" type="password" minlength="8" autocomplete="new-password">
            </div>
            <div class="reset-field">
              <label for="confirm-password">Confirm new password</label>
              <input class="reset-input" id="confirm-password" type="password" minlength="8" autocomplete="new-password">
            </div>
            <button class="reset-submit" id="reset-password-button" type="button">
              Update password
            </button>
          </div>

          <div id="complete-step" hidden>
            <h3 class="reset-step-title">Password updated</h3>
            <p class="reset-step-copy">Your password has been changed and previous device sessions have been signed out.</p>
            <a class="reset-submit" href="../../Login.php">Continue to sign in</a>
          </div>

          <div class="reset-message" id="reset-message" role="status" aria-live="polite">
            Password reset status.
          </div>

          <div class="reset-back"><a href="../../Login.php">Return to sign in</a></div>
        </form>
      </div>
    </section>
  </main>

  <footer class="reset-site-footer">
    <span><strong><?php echo htmlspecialchars($company_obj->get_compnay_short_name(), ENT_QUOTES, 'UTF-8'); ?></strong> Member Management System</span>
    <span>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($company_obj->get_compnay_name(), ENT_QUOTES, 'UTF-8'); ?></span>
  </footer>

<script>
  let resetToken = '';

  function toggleResetMethod() {
    const useEmail = document.getElementById('email-method').checked;
    const emailGroup = document.getElementById('email-group');
    const mobileGroup = document.getElementById('mobile-group');
    const emailInput = document.getElementById('reset-email');
    const mobileInput = document.getElementById('reset-mobile');

    emailGroup.hidden = !useEmail;
    mobileGroup.hidden = useEmail;
    emailInput.required = useEmail;
    emailInput.disabled = !useEmail;
    mobileInput.required = !useEmail;
    mobileInput.disabled = useEmail;
  }

  function showResetMessage(message, isError) {
    const messageEl = document.getElementById('reset-message');
    messageEl.textContent = message;
    messageEl.classList.toggle('is-error', !!isError);
    messageEl.style.display = 'block';
  }

  function showResetStep(stepId) {
    ['request-step', 'verify-step', 'password-step', 'complete-step'].forEach(function(id) {
      document.getElementById(id).hidden = id !== stepId;
    });
  }

  function submitResetAction(action, values, button) {
    const data = new FormData();
    data.append('action', action);
    data.append('csrf_token', document.getElementById('reset-csrf').value);
    if (resetToken) {
      data.append('reset_token', resetToken);
    }
    Object.keys(values).forEach(function(key) {
      data.append(key, values[key]);
    });

    const originalText = button.textContent;
    button.disabled = true;
    button.textContent = 'Please wait...';

    return fetch('../../View-List/Main/Forgot_Password_Process.php', {
      method: 'POST',
      body: data,
      credentials: 'same-origin',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(function(response) {
        return response.json().catch(function() {
          throw new Error('The server returned an invalid response.');
        });
      })
      .then(function(result) {
        if (!result || result.status !== 'success') {
          throw new Error((result && result.message) || 'The request could not be completed.');
        }
        showResetMessage(result.message, false);
        return result;
      })
      .catch(function(error) {
        showResetMessage(error.message || 'The request could not be completed.', true);
        throw error;
      })
      .finally(function() {
        button.disabled = false;
        button.textContent = originalText;
      });
  }

  document.getElementById('email-method').addEventListener('change', toggleResetMethod);
  document.getElementById('sms-method').addEventListener('change', toggleResetMethod);

  document.getElementById('reset-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const method = document.getElementById('email-method').checked ? 'email' : 'sms';
    const identifier = method === 'email'
      ? document.getElementById('reset-email').value.trim()
      : document.getElementById('reset-mobile').value.trim();
    const button = document.getElementById('send-code-button');

    if (!identifier) {
      showResetMessage('Enter your registered ' + (method === 'email' ? 'email address.' : 'mobile number.'), true);
      return;
    }

    submitResetAction('request_code', {
      method: method,
      identifier: identifier
    }, button).then(function(result) {
      if (result.next_step === 'verify') {
        resetToken = result.reset_token || '';
        if (!resetToken) {
          throw new Error('The password reset request could not be started.');
        }
        showResetStep('verify-step');
        document.getElementById('reset-code').focus();
      }
    }).catch(function() {});
  });

  document.getElementById('verify-code-button').addEventListener('click', function() {
    const code = document.getElementById('reset-code').value.replace(/\D/g, '');
    if (code.length !== 6) {
      showResetMessage('Enter the complete six-digit verification code.', true);
      return;
    }

    submitResetAction('verify_code', { code: code }, this).then(function(result) {
      if (result.next_step === 'reset') {
        showResetStep('password-step');
        document.getElementById('new-password').focus();
      }
    }).catch(function() {});
  });

  document.getElementById('reset-code').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 6);
  });

  document.getElementById('reset-password-button').addEventListener('click', function() {
    const newPassword = document.getElementById('new-password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (newPassword.length < 8) {
      showResetMessage('Your new password must contain at least 8 characters.', true);
      return;
    }
    if (newPassword !== confirmPassword) {
      showResetMessage('The password confirmation does not match.', true);
      return;
    }

    submitResetAction('reset_password', {
      new_password: newPassword,
      confirm_password: confirmPassword
    }, this).then(function(result) {
      if (result.next_step === 'complete') {
        resetToken = '';
        document.getElementById('reset-message').style.display = 'none';
        showResetStep('complete-step');
      }
    }).catch(function() {});
  });
</script>
</body>
</html>
