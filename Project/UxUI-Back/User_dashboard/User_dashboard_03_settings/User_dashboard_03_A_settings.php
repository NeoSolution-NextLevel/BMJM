<?php
$pth = "../";
$active_page = "dashboard3";
$page_title = "Account Settings · bmjm Member";

// include '../UxUI-Back/Includes/header.php';  
?>

<style>
  :root{
    --dashboard3-green-950:#0B2E24;
    --dashboard3-green-800:#123832;
    --dashboard3-green-700:#1B4B41;
    --dashboard3-green-600:#245F52;
    --dashboard3-gold-600:#B8923D;
    --dashboard3-gold-500:#C9A227;
    --dashboard3-cream-50:#FAF7F0;
    --dashboard3-cream-100:#F2EDE0;
    --dashboard3-white:#FFFFFF;
    --dashboard3-ink-900:#1E2B26;
    --dashboard3-ink-600:#5A6A62;
    --dashboard3-border:#E6E0D0;
    --dashboard3-danger:#D94948;
    --dashboard3-radius-lg:16px;
    --dashboard3-radius-sm:8px;
    --dashboard3-shadow:0 12px 32px rgba(11,46,36,0.06);
    --dashboard3-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }
  
  html,body{margin:0;padding:0;background:var(--dashboard3-cream-50);font-family:'Inter',sans-serif;}
  
  .dashboard3-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .dashboard3-topbar{
    grid-area:topbar;
    background:var(--dashboard3-white);
    border-bottom:1px solid var(--dashboard3-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 28px;
  }
  .dashboard3-topbar-heading h1{font-family:'Poppins',sans-serif;font-size:18px;font-weight:600;margin:0;color:var(--dashboard3-green-950);}
  .dashboard3-topbar-heading p{margin:2px 0 0;font-size:12px;color:var(--dashboard3-ink-600);}
  .dashboard3-topbar-actions{display:flex;align-items:center;gap:10px;}
  .dashboard3-icon-btn{
    width:36px;height:36px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    background:var(--dashboard3-cream-100);color:var(--dashboard3-green-800);
    border:1px solid var(--dashboard3-border);cursor:pointer;
    transition:all .2s ease;
  }
  .dashboard3-icon-btn:hover{
    background:rgba(201,162,39,0.22);
    border-color:var(--dashboard3-gold-500);
    color:var(--dashboard3-green-950);
    transform:translateY(-1px);
  }
  .dashboard3-icon-btn svg{width:18px;height:18px;}
  
  .dashboard3-main{
    grid-area:main;
    padding: 28px 32px 36px;
    animation: fadeSlideUp 0.6s var(--dashboard3-cubic) forwards;
  }
  @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  .settings-grid {
    display: grid;
    grid-template-columns: 3fr 2fr;
    gap: 24px;
  }
  
  .settings-panel {
    background: var(--dashboard3-white); border-radius: var(--dashboard3-radius-lg);
    border: 1px solid var(--dashboard3-border); box-shadow: var(--dashboard3-shadow); overflow: hidden;
  }
  
  .settings-panel-header {
    padding: 18px 24px; border-bottom: 1px solid var(--dashboard3-cream-100);
    background: rgba(250, 247, 240, 0.4); display:flex; align-items:center; gap:12px;
  }
  .settings-panel-header h2 { font-size: 16px; font-weight: 700; color: var(--dashboard3-green-950); margin: 0; font-family:'Poppins', sans-serif;}
  .settings-panel-header svg { width:20px; height:20px; color:var(--dashboard3-gold-500); }
  
  .settings-form-body {
    padding: 24px;
  }
  
  .form-group { margin-bottom: 20px; }
  .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--dashboard3-ink-600); margin-bottom: 8px; }
  .form-group input, .form-group select {
    width: 100%; height: 46px; border: 1px solid var(--dashboard3-border); border-radius: var(--dashboard3-radius-sm);
    padding: 0 16px; font-size: 14px; font-family: inherit; color: var(--dashboard3-ink-900);
    transition: all 0.2s ease; outline:none; background:var(--dashboard3-white);
  }
  .form-group input:focus, .form-group select:focus { border-color: var(--dashboard3-gold-500); box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.15); }
  .form-group input[readonly] { background: var(--dashboard3-cream-50); color: var(--dashboard3-ink-600); cursor:not-allowed; }

  .profile-fields-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 18px;
  }
  .profile-fields-grid .form-group { margin-bottom: 0; min-width: 0; }
  .profile-fields-grid .profile-field-full { grid-column: 1 / -1; }
  
  .btn-submit {
    height: 46px; width: 100%; background: linear-gradient(135deg, var(--dashboard3-gold-500), var(--dashboard3-gold-600));
    color: var(--dashboard3-green-950); font-weight: 700; font-size: 14px; border: none; border-radius: var(--dashboard3-radius-sm);
    cursor: pointer; transition: all 0.2s ease; display:flex; align-items:center; justify-content:center; gap:8px;
    box-shadow: 0 4px 14px rgba(184, 146, 61, 0.3);
  }
  .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(184, 146, 61, 0.4); }
  
  .toggle-switch { position: relative; width: 48px; height: 28px; flex: 0 0 48px; }
  .toggle-track {
      position: absolute; top:0; left:0; right:0; bottom:0;
      background: #D8D1C2;
      border: 2px solid #B9A878;
      border-radius: 34px;
      box-shadow: inset 0 1px 3px rgba(11,46,36,0.18);
      cursor: pointer;
      transition: 0.3s;
  }
  .toggle-track:before {
      position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px;
      background-color: var(--dashboard3-white);
      border: 1px solid rgba(11,46,36,0.18);
      border-radius: 50%;
      box-shadow: 0 2px 5px rgba(11,46,36,0.25);
      transition: 0.3s;
  }
  input:checked + .toggle-track {
      background: var(--dashboard3-green-700);
      border-color: var(--dashboard3-gold-500);
  }
  input:checked + .toggle-track:before { transform: translateX(20px); }
  input:disabled + .toggle-track { opacity: 0.65; cursor: wait; }

  .toast-alert {
      display: none; padding: 14px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 20px;
  }
  .toast-alert.success { background: #E6F4EA; color: #1E4620; border: 1px solid #CEE8D6; }
  .toast-alert.error { background: #FCE8E6; color: #A50E0E; border: 1px solid #F6CFCB; }

  .member-summary {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 22px;
  }
  .member-summary-item {
    border: 1px solid var(--dashboard3-border);
    border-radius: var(--dashboard3-radius-sm);
    background: var(--dashboard3-cream-50);
    padding: 12px 14px;
    min-width: 0;
  }
  .member-summary-label {
    color: var(--dashboard3-ink-600);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 4px;
  }
  .member-summary-value {
    color: var(--dashboard3-green-950);
    font-size: 13.5px;
    font-weight: 700;
    overflow-wrap: anywhere;
  }

  .checkbox-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: -8px 0 20px;
    color: var(--dashboard3-ink-600);
    font-size: 12.5px;
    font-weight: 600;
  }
  .checkbox-row input { width: 16px; height: 16px; accent-color: var(--dashboard3-gold-500); }

  @media (max-width: 1200px) {
    .profile-fields-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .member-summary { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }

  @media (max-width: 900px) {
    .dashboard3-app { grid-template-columns: 1fr; grid-template-areas: "topbar" "main"; }
    .settings-grid { grid-template-columns: 1fr; }
    .dashboard3-main { padding: 16px 14px 28px; }
    .settings-form-body { padding: 18px; }
    .form-group input { font-size: 16px; height: 48px; }
    .profile-fields-grid { grid-template-columns: 1fr; }
    .profile-fields-grid .profile-field-full { grid-column: auto; }
    .member-summary { grid-template-columns: 1fr; }
  }
</style>

<div data-page="dashboard3" id="user_dashboard_03_A">
  <input type="hidden" id="main_user_login_id" value="<?php echo isset($user_id) ? htmlspecialchars($user_id) : ''; ?>">

  <div class="dashboard3-app">
    <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

    <header class="dashboard3-topbar">
      <div class="dashboard3-topbar-heading">
        <h1>Settings & Security</h1>
        <p>Account details and password</p>
      </div>
      <div class="dashboard3-topbar-actions">
        <button
          type="button"
          class="dashboard3-icon-btn bmjm-user-logout-btn"
          title="Sign out"
          aria-label="Sign out"
          data-logout-url="<?php echo htmlspecialchars($pth . 'View-List/Main/Main_User_Logout.php', ENT_QUOTES, 'UTF-8'); ?>"
          data-login-url="<?php echo htmlspecialchars($pth . 'Login.php', ENT_QUOTES, 'UTF-8'); ?>"
        >
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
        </button>
      </div>
    </header>

    <main class="dashboard3-main">
        <div id="settings-toast" class="toast-alert"></div>
        
        <div class="settings-grid">
            
            <!-- Profile Settings -->
            <div class="settings-panel">
                <div class="settings-panel-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <h2>Profile Information</h2>
                </div>
                <div class="settings-form-body">
                    <form id="profile-settings-form" onsubmit="return update_profile_details(event)" novalidate>
                        <input type="hidden" id="setting_member_id">
                        <input type="hidden" id="setting_address">

                        <div class="member-summary" aria-label="Member summary">
                            <div class="member-summary-item">
                                <div class="member-summary-label">Membership No</div>
                                <div class="member-summary-value" id="setting_membership_no">-</div>
                            </div>
                            <div class="member-summary-item">
                                <div class="member-summary-label">Monthly Payment</div>
                                <div class="member-summary-value" id="setting_monthly_payment_display">LKR 0.00</div>
                            </div>
                            <div class="member-summary-item">
                                <div class="member-summary-label">Street / Road</div>
                                <div class="member-summary-value" id="setting_road_display">-</div>
                            </div>
                            <div class="member-summary-item">
                                <div class="member-summary-label">Due Balance</div>
                                <div class="member-summary-value" id="setting_due_display">LKR 0.00</div>
                            </div>
                        </div>

                        <div class="profile-fields-grid">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" id="setting_name">
                            </div>
                            <div class="form-group">
                                <label>Registered Email</label>
                                <input type="email" id="setting_email">
                            </div>
                            <div class="form-group">
                                <label>NIC (Read Only)</label>
                                <input type="text" id="setting_nic" readonly>
                            </div>
                            <div class="form-group profile-field-full">
                                <label>Residence Address</label>
                                <input type="text" id="setting_address_display">
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" id="setting_mobile" required>
                            </div>
                            <div class="form-group">
                                <label>WhatsApp Number</label>
                                <input type="text" id="setting_whatsapp">
                            </div>
                            <div class="form-group">
                                <label for="setting_road">Street / Road</label>
                                <select id="setting_road" required>
                                    <option value="">Select road</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="setting_monthly_payment">Monthly Subscription Amount</label>
                                <input type="number" id="setting_monthly_payment" min="0" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="setting_zakath_type">Zakath Status</label>
                                <select id="setting_zakath_type" required>
                                    <option value="none">Not applicable</option>
                                    <option value="payee">Zakath Payee</option>
                                    <option value="receiver">Zakath Receiver</option>
                                </select>
                            </div>
                        </div>
                        <label class="checkbox-row">
                            <input type="checkbox" id="setting_whatsapp_same" onchange="sync_settings_whatsapp()">
                            WhatsApp number is same as mobile
                        </label>
                        <div id="profile-settings-toast" class="toast-alert" role="status" aria-live="polite"></div>
                        <button type="submit" class="btn-submit">Update Profile</button>
                    </form>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="settings-panel">
                <div class="settings-panel-header">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <h2>Security & Password</h2>
                </div>
                <div class="settings-form-body">
                    <form id="security-settings-form" onsubmit="update_password_details(event)">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" id="setting_old_password" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="setting_new_password" required minlength="6">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" id="setting_confirm_password" required minlength="6">
                        </div>
                        
                        <div class="form-group" style="padding-top:10px; border-top:1px solid var(--dashboard3-cream-100); margin-top:24px;">
                            <label style="display:flex; align-items:center; justify-content:space-between; cursor:pointer;">
                                <span>
                                    <strong style="color:var(--dashboard3-green-950); display:block; font-size:14px; margin-bottom:4px;">Two-Factor Authentication (OTP)</strong>
                                    <span style="color:var(--dashboard3-ink-400); font-size:11.5px; font-weight:normal;">Require an SMS code when logging in for enhanced security.</span>
                                </span>
                                <!-- Custom Toggle Switch -->
                                <div class="toggle-switch">
                                    <input type="checkbox" id="setting_2fa_toggle" onchange="toggle_2fa_setting(this)" style="display:none;">
                                    <div class="toggle-track"></div>
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="btn-submit" style="margin-top: 10px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 2v6h6"/></svg>
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </main>
  </div>
</div>
<?php include 'JS/User_dashboard_03_A_JS.php'; ?>
