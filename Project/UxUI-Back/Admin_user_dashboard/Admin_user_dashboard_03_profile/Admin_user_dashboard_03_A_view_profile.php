<?php

    $pth = "../";
    $active_page = "settings-user-account"; // keep the Settings/User Account tab highlighted
    $page_title = "Profile · bmjm Admin";
    include '../UxUI-Back/Includes/header.php'; 

    if (!function_exists('user_account_all')) {
        function user_account_all() {
            return [
                1 => [
                    'id' => 1,
                    'name' => 'M.I.M. Farook',
                    'email' => 'farook@bmjm.lk',
                    'role' => 'admin',
                    'residenceAddress' => 'No 12, Green Lane, Bambalapitiya',
                    'roadName' => 'road 1',
                    'nicNo' => '902345678V',
                    'residenceType' => 'owner',
                    'mobile' => '+94 77 123 4567',
                    'whatsapp' => '+94 77 123 4567',
                    'whatsappSame' => true,
                    'profession' => 'Businessman',
                    'monthlyMaintainAmount' => 95,
                    'membershipNo' => '000010237',
                    'dueAmount' => 0,
                    'blocked' => false,
                ],
                2 => [
                    'id' => 2,
                    'name' => 'A.L.M. Rifky',
                    'email' => 'rifky@bmjm.lk',
                    'role' => 'editor',
                    'residenceAddress' => 'No 45, Station Road, Bambalapitiya',
                    'roadName' => 'road 2',
                    'nicNo' => '885671234V',
                    'residenceType' => 'rented',
                    'mobile' => '+94 71 234 5678',
                    'whatsapp' => '+94 76 987 6543',
                    'whatsappSame' => false,
                    'profession' => 'Accountant',
                    'monthlyMaintainAmount' => 95,
                    'membershipNo' => '000010112',
                    'dueAmount' => -2850,
                    'blocked' => false,
                ],
                3 => [
                    'id' => 3,
                    'name' => 'S.H. Nawaz',
                    'email' => 'nawaz@bmjm.lk',
                    'role' => 'editor',
                    'residenceAddress' => 'No 8, Mosque Lane, Bambalapitiya',
                    'roadName' => 'road 1',
                    'nicNo' => '921122334V',
                    'residenceType' => 'owner',
                    'mobile' => '+94 70 345 6789',
                    'whatsapp' => '+94 70 345 6789',
                    'whatsappSame' => true,
                    'profession' => 'Teacher',
                    'monthlyMaintainAmount' => 95,
                    'membershipNo' => '000010089',
                    'dueAmount' => 0,
                    'blocked' => false,
                ],
                4 => [
                    'id' => 4,
                    'name' => 'F. Careem',
                    'email' => 'careem@bmjm.lk',
                    'role' => 'viewer',
                    'residenceAddress' => 'No 21, Main Street, Bambalapitiya',
                    'roadName' => 'road 3',
                    'nicNo' => '956789012V',
                    'residenceType' => 'rented',
                    'mobile' => '+94 77 456 7890',
                    'whatsapp' => '+94 77 456 7890',
                    'whatsappSame' => true,
                    'profession' => 'Shop Owner',
                    'monthlyMaintainAmount' => 95,
                    'membershipNo' => '000010195',
                    'dueAmount' => -9500,
                    'blocked' => false,
                ],
            ];
        }
    }

    if (!function_exists('user_account_find')) {
        function user_account_find($id) {
            $all = user_account_all();
            $id = (int) $id;
            return isset($all[$id]) ? $all[$id] : null;
        }
    }

    if (!function_exists('user_account_money')) {
        function user_account_money($amount) {
            $amount = (float) $amount;
            $sign = $amount < 0 ? '-' : '';
            return 'LKR ' . $sign . number_format(abs($amount), 2);
        }
    }

    $id = isset($_GET['id']) ? (int) $_GET['id'] : 1;
    $user = user_account_find($id);
?>
<style>
  :root{
    --user-account-profile-green-950:#0B2E24;
    --user-account-profile-green-800:#123832;
    --user-account-profile-green-700:#1B4B41;
    --user-account-profile-gold-600:#B8923D;
    --user-account-profile-gold-500:#C9A227;
    --user-account-profile-gold-300:#E4C766;
    --user-account-profile-cream-50:#FAF7F0;
    --user-account-profile-cream-100:#F2EDE0;
    --user-account-profile-white:#FFFFFF;
    --user-account-profile-ink-900:#1E2B26;
    --user-account-profile-ink-600:#5A6A62;
    --user-account-profile-ink-400:#8B978F;
    --user-account-profile-border:#E6E0D0;
    --user-account-profile-danger:#B0453A;
    --user-account-profile-radius-sm:8px;
    --user-account-profile-radius-lg:22px;
    --user-account-profile-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--user-account-profile-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--user-account-profile-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px;
  }

  .user-account-profile-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .user-account-profile-topbar{
    grid-area:topbar;
    background:var(--user-account-profile-white);
    border-bottom:1px solid var(--user-account-profile-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .user-account-profile-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--user-account-profile-green-950);
  }
  .user-account-profile-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--user-account-profile-ink-400);}
  .user-account-profile-topbar-actions{display:flex;align-items:center;gap:18px;}
  .user-account-profile-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--user-account-profile-cream-100);color:var(--user-account-profile-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .user-account-profile-icon-btn:hover{background:var(--user-account-profile-gold-300);}
  .user-account-profile-icon-btn svg{width:16px;height:16px;}

  @media (max-width:900px){
    .user-account-profile-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
  }

  .user-account-profile-main{grid-area:main;padding:26px 30px 50px;}

  .user-account-profile-breadcrumb{font-size:12px;color:var(--user-account-profile-ink-400);margin-bottom:16px;}
  .user-account-profile-breadcrumb a{color:var(--user-account-profile-ink-400);text-decoration:none;}
  .user-account-profile-breadcrumb a:hover{color:var(--user-account-profile-green-700);}
  .user-account-profile-breadcrumb span{color:var(--user-account-profile-green-700);font-weight:600;}

  .user-account-profile-panel{
    background:var(--user-account-profile-white);
    border-radius:var(--user-account-profile-radius-lg);
    box-shadow:var(--user-account-profile-shadow);
    overflow:hidden;
    border:1px solid var(--user-account-profile-border);
  }

  .user-account-profile-panel-header{
    background:linear-gradient(135deg,var(--user-account-profile-green-800),var(--user-account-profile-green-950));
    color:var(--user-account-profile-cream-50);
    padding:22px 28px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .user-account-profile-panel-header h1{
    margin:0;font-family:'Poppins',Inter,sans-serif;
    font-size:22px;font-weight:700;
  }
  .user-account-profile-panel-close{
    width:32px;height:32px;border-radius:50%;flex:0 0 32px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--user-account-profile-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;font-size:14px;
    cursor:pointer;transition:background .15s ease;
  }
  .user-account-profile-panel-close:hover{background:rgba(250,247,240,0.12);}

  .user-account-profile-body{
    padding:24px 30px 10px;
    display:grid;
    grid-template-columns:repeat(2, minmax(220px, 1fr));
    gap:0 40px;
  }
  .user-account-profile-row{
    display:flex;flex-direction:column;gap:4px;
    padding:14px 0;
    border-bottom:1px solid var(--user-account-profile-border);
    font-size:13.5px;
  }
  .user-account-profile-row.is-full{grid-column:1 / -1;}
  .user-account-profile-label{
    color:var(--user-account-profile-ink-600);
    font-weight:600;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:0.03em;
  }
  .user-account-profile-colon{display:none;}
  .user-account-profile-value{
    color:var(--user-account-profile-ink-900);
    font-weight:700;
    font-size:15px;
  }
  .user-account-profile-value.is-danger{color:var(--user-account-profile-danger);}

  @media (max-width:640px){
    .user-account-profile-body{grid-template-columns:1fr;}
  }

  .user-account-profile-footer{
    display:flex;justify-content:flex-end;gap:10px;
    padding:20px 28px 26px;
  }
  .user-account-profile-btn{
    height:42px;padding:0 20px;
    border-radius:var(--user-account-profile-radius-sm);
    border:none;cursor:pointer;
    font-size:12.5px;font-weight:700;letter-spacing:0.01em;
    text-decoration:none;
    display:inline-flex;align-items:center;justify-content:center;
    transition:background .15s ease, box-shadow .15s ease, color .15s ease;
  }
  .user-account-profile-btn-ghost{background:var(--user-account-profile-cream-100);color:var(--user-account-profile-ink-900);}
  .user-account-profile-btn-ghost:hover{background:var(--user-account-profile-border);}
  .user-account-profile-btn-primary{
    background:linear-gradient(135deg,var(--user-account-profile-gold-500),var(--user-account-profile-gold-600));
    color:var(--user-account-profile-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .user-account-profile-btn-primary:hover{box-shadow:0 6px 16px rgba(184,146,61,0.45);}
  .user-account-profile-btn-danger{
    background:var(--user-account-profile-danger);
    color:var(--user-account-profile-cream-50);
  }
  .user-account-profile-btn-danger:hover{background:#943a30;}

  .user-account-profile-notfound{
    padding:60px 28px;text-align:center;color:var(--user-account-profile-ink-400);font-size:14px;
  }
</style>



<div data-page="settings" id="Admin_user_dashboard_03_A">

<div class="user-account-profile-app">

  <?php include "../UxUI-Back/Includes/Sidebar_admin_user_dashboard.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="user-account-profile-topbar">
    <div class="user-account-profile-topbar-heading">
      <h1>Member Profile</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="user-account-profile-topbar-actions">
      <button class="user-account-profile-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="user-account-profile-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="user-account-profile-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="user-account-profile-main">
    <p class="user-account-profile-breadcrumb">
      <a href="dashboard.php">Dashboard</a> /
      <a href="settings.php">Settings</a> /
      <a href="settings-user-account.php">User Account</a> /
      <span>Profile</span>
    </p>

    <section class="user-account-profile-panel" aria-label="Profile">

      <div class="user-account-profile-panel-header">
        <h1>Profile</h1>
        <a class="user-account-profile-panel-close" href="#" onclick="return Admin_user_dashboard_03_A_CANCEL();" title="Close" aria-label="Close">✕</a>
      </div>

        <div class="user-account-profile-body">
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Name</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_name">—</span>
          </div>
          <div class="user-account-profile-row is-full">
            <span class="user-account-profile-label">Residence Address</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_address">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Road Name</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_road_name">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">NIC No</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_nic">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Residence</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_residence_type">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Mobile</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_mobile">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Whatsapp</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_whatsapp">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Email</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_email">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Profession</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_profession">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Monthly Maintain Amount</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_monthly_amount">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Membership No</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_membership_no">—</span>
          </div>
          <div class="user-account-profile-row">
            <span class="user-account-profile-label">Due Amount</span>
            <span class="user-account-profile-colon">:</span>
            <span class="user-account-profile-value" id="profile_view_due_amount">—</span>
          </div>
        </div>

        <div class="user-account-profile-footer">
          <a class="user-account-profile-btn user-account-profile-btn-ghost" href="#" onclick="return Admin_user_dashboard_03_A_CANCEL();">Cancel</a>
          <a class="user-account-profile-btn user-account-profile-btn-danger" onclick="Admin_user_dashboard_03_C_OPEN()">Block</a>
          <a class="user-account-profile-btn user-account-profile-btn-primary" onclick="Admin_user_dashboard_03_B_OPEN()">Edit</a>
        </div>

    </section>

  </main>

</div>

<!-- Loads sidebar.php into # above. Remove this line
     if you switch to a PHP include instead. -->


<!-- ================= FOOTER (shared component) =================
     PHP projects: delete this div and put include 'footer.php';
     in its place instead. -->
<div id="bmjm-footer-root"></div>
<!-- <script src="footer-loader.js"></script> -->



      

</div>
<?php include_once __DIR__ . '/JS/Admin_user_dashboard_03_A_JS.php'; ?>
