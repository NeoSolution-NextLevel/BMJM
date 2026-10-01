<?php
include_once 'imports/need/session_setup.php';
include_once 'imports/need/DB.php';
include_once 'imports/Company_Info/Company_Info_Variable_List.php';
include_once 'View-List/Main/Google-Login/Main_User_Google_Login_Config.php';
include_once 'View-List/Main/Microsoft-Login/Main_User_Microsoft_Login_Config.php';
include_once 'Controller/Main/Cook_Managment/Cook_Managing.php';

function bmjm_login_dashboard_url($access_control_id)
{
    $access_control_id = (int) $access_control_id;

    if ($access_control_id === 1) {
        return 'UxUi/Main-Dashboard.php';
    }

    if ($access_control_id === 2) {
        return 'UxUi/User_dashboard.php';
    }

    return null;
}

function bmjm_login_return_url($access_control_id)
{
    if ((int) $access_control_id !== 1) {
        return null;
    }

    $return_url = isset($_SESSION['login_return_url']) ? $_SESSION['login_return_url'] : '';
    return $return_url === 'UxUi/Admin-Notifications.php' ? $return_url : null;
}

$pending_login_return_url = isset($_SESSION['login_return_url']) && $_SESSION['login_return_url'] === 'UxUi/Admin-Notifications.php'
    ? $_SESSION['login_return_url']
    : '';

$existing_cook_id = isset($_SESSION['user_main_cook_id']) ? $_SESSION['user_main_cook_id'] : '';

if ($existing_cook_id !== '' && $existing_cook_id !== '0') {
    $cookie_check_obj = new Cook_Management($existing_cook_id);

    if ($cookie_check_obj->check_login_availability()) {
        $existing_access_level = $cookie_check_obj->get_access_level_id();
        $dashboard_url = bmjm_login_return_url($existing_access_level);
        if ($dashboard_url === null) {
            $dashboard_url = bmjm_login_dashboard_url($existing_access_level);
        }

        if ($dashboard_url !== null) {
            header('Location: ' . $home_page . $dashboard_url);
            exit;
        }
    }
}

$company_obj = new Company_Info_Variable_List();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#0B2E24">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title>Login · bmjm Mosque</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bmjm-member-mobile.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  :root{
    --login-green-950:#0B2E24;
    --login-green-800:#123832;
    --login-green-700:#1B4B41;
    --login-gold-600:#B8923D;
    --login-gold-500:#C9A227;
    --login-gold-300:#E4C766;
    --login-cream-50:#FAF7F0;
    --login-cream-100:#F2EDE0;
    --login-white:#FFFFFF;
    --login-ink-900:#1E2B26;
    --login-ink-600:#5A6A62;
    --login-ink-400:#8B978F;
    --login-border:#E6E0D0;
    --login-danger:#B0453A;
    --login-radius-sm:8px;
    --login-radius-lg:22px;
    --login-shadow:0 20px 60px rgba(11,46,36,0.18);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;height:100%;}

  body{
    background:var(--login-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--login-ink-900);
    -webkit-font-smoothing:antialiased;
    min-height:100vh;
    display:flex;align-items:center;justify-content:center;
    padding:24px;
  }

  .login-card{
    width:100%;max-width:920px;
    background:var(--login-white);
    border-radius:var(--login-radius-lg);
    box-shadow:var(--login-shadow);
    overflow:hidden;
    display:grid;
    grid-template-columns:1fr 1fr;
    min-height:560px;
  }

  /* ===== Left brand panel ===== */
  .login-brand{
    position:relative;
    background:linear-gradient(300deg,var(--login-green-800),var(--login-green-950));
    color:var(--login-cream-50);
    padding:48px 44px;
    display:flex;flex-direction:column;justify-content:space-between;
    overflow:hidden;
  }
  .login-brand::before{
    content:"";
    position:absolute;inset:0;
    z-index:1;
    background:linear-gradient(160deg, rgba(11,46,36,0.75), rgba(11,46,36,0.55));
    pointer-events:none;
  }

  .login-brand-photo{
    position:absolute;inset:0;
    z-index:0;
    width:100%;height:100%;
    object-fit:cover;
  }
  .login-brand-mark{
    position:relative;
    z-index:2;
    display:flex;align-items:center;gap:12px;
  }
  .login-brand-logo{
    width:200px;height:200px;
    object-fit:contain;
    flex:0 0 44px;
  }
  .login-brand-mark-text{font-family:'Poppins',Inter,sans-serif;font-size:15px;font-weight:700;letter-spacing:0.01em;}
  .login-brand-mark-text span{display:block;font-family:'Inter',sans-serif;font-size:11px;font-weight:500;color:rgba(250,247,240,0.6);margin-top:2px;letter-spacing:0.03em;}

  .login-brand-copy{position:relative;z-index:2;margin-top:auto;}
  .login-brand-copy h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:30px;font-weight:700;line-height:1.28;
    margin:0 0 14px;
  }
  .login-brand-copy p{
    font-size:14px;line-height:1.6;
    color:rgba(250,247,240,0.75);
    margin:0;
    max-width:340px;
  }

  .login-brand-foot{
    position:relative;
    z-index:2;
    display:flex;align-items:center;gap:8px;
    font-size:11.5px;color:rgba(250,247,240,0.5);
    margin-top:40px;
  }
  .login-brand-foot span{width:5px;height:5px;border-radius:50%;background:var(--login-gold-300);}

  /* ===== Right form panel ===== */
  .login-form-panel{
    padding:52px 48px;
    display:flex;flex-direction:column;justify-content:center;
  }
  .login-form-heading h2{
    font-family:'Poppins',Inter,sans-serif;
    font-size:24px;font-weight:700;
    color:var(--login-green-950);
    margin:0 0 6px;
  }
  .login-form-heading p{
    font-size:13.5px;color:var(--login-ink-600);
    margin:0 0 30px;
  }

  .login-alert{
    display:flex;align-items:center;gap:10px;
    background:rgba(176,69,58,0.08);
    border:1px solid rgba(176,69,58,0.28);
    color:var(--login-danger);
    border-radius:var(--login-radius-sm);
    padding:12px 14px;
    font-size:13px;font-weight:600;
    margin-bottom:22px;
  }
  .login-alert svg{width:16px;height:16px;flex:0 0 16px;}

  .login-field{display:flex;flex-direction:column;gap:6px;margin-bottom:18px;}
  .login-field label{font-size:12px;font-weight:700;color:var(--login-ink-900);}
  .login-input-wrap{position:relative;}
  .login-input{
    width:100%;height:46px;
    border:1px solid var(--login-border);
    border-radius:var(--login-radius-sm);
    padding:0 14px;
    font-size:13.5px;font-family:inherit;
    color:var(--login-ink-900);
    background:var(--login-cream-50);
    outline:none;
    transition:border-color .15s ease, background .15s ease;
  }
  .login-input:focus{border-color:var(--login-gold-500);background:var(--login-white);}
  .login-input::placeholder{color:var(--login-ink-400);}
  .login-input[type="password"],
  .login-input.has-toggle{padding-right:44px;}

  .login-toggle-visibility{
    position:absolute;right:6px;top:50%;transform:translateY(-50%);
    width:34px;height:34px;border-radius:50%;
    border:none;background:transparent;color:var(--login-ink-400);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:background .15s ease,color .15s ease;
  }
  .login-toggle-visibility:hover{background:var(--login-cream-100);color:var(--login-green-700);}
  .login-toggle-visibility svg{width:17px;height:17px;}

  .login-row-between{
    display:flex;align-items:center;justify-content:space-between;
    margin-bottom:26px;
  }
  .login-remember{
    display:flex;align-items:center;gap:8px;
    font-size:12.5px;color:var(--login-ink-600);
    cursor:pointer;
  }
  .login-remember input{width:15px;height:15px;accent-color:var(--login-green-700);cursor:pointer;}
  .login-forgot{
    font-size:12.5px;font-weight:700;
    color:var(--login-green-700);
    text-decoration:none;
  }
  .login-forgot:hover{text-decoration:underline;}

  .login-submit{
    width:100%;height:48px;
    border:none;border-radius:var(--login-radius-sm);
    background:linear-gradient(135deg,var(--login-gold-500),var(--login-gold-600));
    color:var(--login-green-950);
    font-size:13.5px;font-weight:700;letter-spacing:0.02em;
    cursor:pointer;
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
    transition:box-shadow .15s ease,transform .1s ease;
  }
  .login-submit:hover{box-shadow:0 6px 18px rgba(184,146,61,0.45);}
  .login-submit:active{transform:translateY(1px);}
  .login-submit:disabled{opacity:0.7;cursor:not-allowed;}

  .login-divider{display:flex;align-items:center;gap:12px;margin:22px 0;}
  .login-divider-line{flex:1;height:1px;background:var(--login-border);}
  .login-divider-text{font-size:11px;font-weight:700;letter-spacing:0.04em;color:var(--login-ink-400);text-transform:uppercase;}

  .login-google-btn{
    width:100%;height:46px;
    border:1px solid var(--login-border);
    border-radius:var(--login-radius-sm);
    background:var(--login-white);
    color:var(--login-ink-900);
    font-size:13.5px;font-weight:600;font-family:inherit;
    display:flex;align-items:center;justify-content:center;gap:10px;
    cursor:pointer;text-decoration:none;
    transition:background .15s ease,border-color .15s ease,box-shadow .15s ease;
  }
  .login-google-btn:hover{background:var(--login-cream-50);border-color:var(--login-ink-400);box-shadow:0 2px 8px rgba(11,46,36,0.06);}
  .login-google-btn:active{transform:translateY(1px);}
  .login-google-btn svg{width:18px;height:18px;flex:0 0 18px;}

  .login-signup-note{
    text-align:center;
    font-size:12.5px;color:var(--login-ink-600);
    margin-top:22px;
  }
  .login-signup-note a{color:var(--login-green-700);font-weight:700;text-decoration:none;}
  .login-signup-note a:hover{text-decoration:underline;}

  .login-footnote{
    text-align:center;
    font-size:11.5px;color:var(--login-ink-400);
    margin-top:18px;
  }

  @media (max-width:760px){
    body{padding:16px;align-items:flex-start;}
    .login-card{grid-template-columns:1fr;min-height:0;}
    .login-brand{padding:24px 22px 18px;}
    .login-brand-logo{width:84px;height:84px;flex:none;}
    .login-brand-copy{margin-top:18px;}
    .login-brand-copy h1{font-size:22px;}
    .login-brand-foot{margin-top:16px;}
    .login-form-panel{padding:24px 20px 28px;}
    .login-input,.login-submit,.login-google-btn{height:48px;font-size:16px;}
  }
</style>
</head>
<body>

<div class="login-card">

  <!-- ================= LEFT BRAND PANEL ================= -->
  <div class="login-brand">
    <img class="login-brand-photo" src="assets/images/mosque-photo.jpg" alt="" aria-hidden="true" onerror="this.style.display='none'">

    <div class="login-brand-mark">
      <img class="login-brand-logo" src="assets/images/logo_dashboard.png" alt="bmjm logo" onerror="this.style.display='none'">
    </div>

    <div class="login-brand-copy">
      <h1>Welcome to your member portal.</h1>
      <p>Sign in to access your mosque account, view updates, and stay connected with the community.</p>
    </div>

    <div class="login-brand-foot">
      <span></span> Member Portal
    </div>
  </div>

  <!-- ================= RIGHT FORM PANEL ================= -->
  <div class="login-form-panel">
    <div class="login-form-heading">
      <h2>Welcome back</h2>
      <p>Sign in with your account to continue.</p>
    </div>

    <div class="login-alert" id="loginAlert" style="display: none;">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v5M12 16h.01"/></svg>
      <span id="loginAlertMsg">Invalid email or password.</span>
    </div>

    <form id="user_login_form" method="post" onsubmit="return User_Login_Submit(event)" novalidate>

      <div class="login-field">
        <label for="email">Email</label>
        <input type="email" class="login-input" id="email" name="email"
               placeholder="name@bmjm.lk" required autofocus>
      </div>

      <div class="login-field">
        <label for="password">Password</label>
        <div class="login-input-wrap">
          <input type="password" class="login-input has-toggle" id="password" name="password"
                 placeholder="••••••••" required>
          <button type="button" class="login-toggle-visibility" id="loginTogglePassword" aria-label="Show password">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
              <path d="M1.5 12S5 5 12 5s10.5 7 10.5 7-3.5 7-10.5 7S1.5 12 1.5 12Z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="login-row-between">
        <label class="login-remember">
          <input type="checkbox" name="remember" id="remember">
          Remember me
        </label>
        <a class="login-forgot" href="<?php echo $home_page ?><?php echo $User_login_url ?>Forgot-Password<?php echo $online_offline_extention ?>">Forgot password?</a>
      </div>

      <button type="submit" class="login-submit" id="loginSubmitBtn">Sign In</button>
    </form>

    <div class="login-divider">
      <span class="login-divider-line"></span>
      <span class="login-divider-text">or continue with</span>
      <span class="login-divider-line"></span>
    </div>

    <a href="<?php echo $google_login_url; ?>" class="login-google-btn">
      <svg viewBox="0 0 48 48">
        <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.8 1.1 8 3l5.7-5.7C34.6 6 29.6 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.2-.1-2.3-.4-3.5Z"/>
        <path fill="#FF3D00" d="m6.3 14.7 6.6 4.8C14.6 15.8 18.9 13 24 13c3.1 0 5.8 1.1 8 3l5.7-5.7C34.6 7 29.6 5 24 5c-7.7 0-14.4 4.3-17.7 10.7Z"/>
        <path fill="#4CAF50" d="M24 44c5.5 0 10.4-1.9 14.3-5.1l-6.6-5.6c-2.1 1.5-4.7 2.4-7.7 2.4-5.2 0-9.6-3.3-11.3-7.9l-6.5 5C9.5 39.6 16.2 44 24 44Z"/>
        <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.2-4.1 5.6l6.6 5.6C41.9 35.9 44 30.4 44 24c0-1.2-.1-2.3-.4-3.5Z"/>
      </svg>
      Continue with Google
    </a>

    <p class="login-signup-note">Don't have an account? <a href="<?php echo $home_page ?>Registration.php">Sign up</a></p>

    <p class="login-footnote">&copy; <?php echo date("Y"); ?> - <?php echo $company_obj->get_compnay_name()." | ";?> 
    <a href="https://www.neosolution.lk/" target="block" style="color:black;">Neo Solution</a></p>
  </div>

</div>

<script>
  // Password Visibility Toggle
  document.getElementById('loginTogglePassword').addEventListener('click', function(){
    const field = document.getElementById('password');
    const isHidden = field.type === 'password';
    field.type = isHidden ? 'text' : 'password';
    this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
  });

  // Login Form Submission to Backend
  function User_Login_Submit(event) {
    if (event) event.preventDefault();

    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const alertBox = document.getElementById("loginAlert");
    const alertMsg = document.getElementById("loginAlertMsg");
    const submitBtn = document.getElementById("loginSubmitBtn");

    const email = emailInput.value.trim();
    const password = passwordInput.value;

    if (!email || !password) {
      alertMsg.textContent = "Please enter both email and password.";
      alertBox.style.display = "flex";
      return false;
    }

    alertBox.style.display = "none";
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = "Signing In...";
    }

    const sendingValue = "val_01=" + encodeURIComponent(email) +
                         "&val_02=" + encodeURIComponent(password);

    $.ajax({
      url: "<?php echo isset($pth) ? $pth : ''; ?>View-List/Main/User_Login_Check.php",
      type: "POST",
      data: sendingValue,
      success: function(res) {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = "Sign In";
        }
        try {
          const json = typeof res === "object" ? res : JSON.parse(res);

          if (json[0] && json[0].error === "0") {
            if (json[0].google_authentication === "1") {
              const type = encodeURIComponent("Google-Authentication");
              window.location.href = "<?php echo $home_page ?><?php echo $User_login_url ?>OTP-Two-step-Verification<?php echo $online_offline_extention ?>?type=" + type;
            } else if (json[0].is_two_factor_auth_enable === "1") {
              const type = encodeURIComponent("Two-Factor-Authentication");
              window.location.href = "<?php echo $home_page ?><?php echo $User_login_url ?>OTP-Two-step-Verification<?php echo $online_offline_extention ?>?type=" + type;
            } else {
              const accessLevel = json[0].main_user_account_access_level_list_id;
              if (accessLevel == "1") {
                const adminReturnUrl = <?php echo json_encode($pending_login_return_url); ?>;
                window.location.href = "<?php echo $home_page ?>" + (adminReturnUrl || "UxUi/Main-Dashboard.php");
              } else if (accessLevel == "2") {
                window.location.href = "<?php echo $home_page ?>UxUi/User_dashboard.php";
              } else {
                const sucessMsg = encodeURIComponent("User-Login-Successful");
                window.location.href = "<?php echo $home_page ?><?php echo $User_login_url ?>Successful-Page<?php echo $online_offline_extention ?>?message=" + sucessMsg;
              }
            }
          } else {
            const errMsg = (json[0] && json[0].error) ? json[0].error : "Invalid email or password.";
            alertMsg.textContent = errMsg;
            alertBox.style.display = "flex";
          }
        } catch (e) {
          console.error("Parse error:", e, res);
          alertMsg.textContent = "An error occurred during sign in. Please try again.";
          alertBox.style.display = "flex";
        }
      },
      error: function(err) {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = "Sign In";
        }
        console.error("AJAX error:", err);
        alertMsg.textContent = "Network error. Please try again.";
        alertBox.style.display = "flex";
      }
    });

    return false;
  }
</script>

</body>
</html>
