<?php
    $pth = "../";
    $active_page = "settings-user-account";
    $page_title = "Block Request · bmjm Admin";
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

    $id = isset($_GET['id']) ? (int) $_GET['id'] : (isset($_POST['id']) ? (int) $_POST['id'] : 1);
    $user = user_account_find($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
        // TODO(backend): mark the account/member as blocked, e.g.
        // $stmt = $pdo->prepare('UPDATE users SET blocked = 1 WHERE id = ?');
        // $stmt->execute([$id]);

        header('Location: settings-user-account.php?blocked=' . $id);
        exit;
    }
?>


<style>
  :root{
    --user-account-block-green-950:#0B2E24;
    --user-account-block-green-800:#123832;
    --user-account-block-gold-500:#C9A227;
    --user-account-block-gold-300:#E4C766;
    --user-account-block-cream-50:#FAF7F0;
    --user-account-block-cream-100:#F2EDE0;
    --user-account-block-white:#FFFFFF;
    --user-account-block-ink-900:#1E2B26;
    --user-account-block-ink-600:#5A6A62;
    --user-account-block-ink-400:#8B978F;
    --user-account-block-border:#E6E0D0;
    --user-account-block-danger:#B0453A;
    --user-account-block-danger-dark:#8F382E;
    --user-account-block-radius-sm:8px;
    --user-account-block-radius-lg:22px;
    --user-account-block-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--user-account-block-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--user-account-block-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px;
  }

  .user-account-block-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .user-account-block-topbar{
    grid-area:topbar;
    background:var(--user-account-block-white);
    border-bottom:1px solid var(--user-account-block-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .user-account-block-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--user-account-block-green-950);
  }
  .user-account-block-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--user-account-block-ink-400);}
  .user-account-block-topbar-actions{display:flex;align-items:center;gap:18px;}
  .user-account-block-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--user-account-block-cream-100);color:var(--user-account-block-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .user-account-block-icon-btn:hover{background:var(--user-account-block-gold-300);}
  .user-account-block-icon-btn svg{width:16px;height:16px;}

  @media (max-width:900px){
    .user-account-block-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
  }

  .user-account-block-main{grid-area:main;padding:26px 30px 50px;}

  .user-account-block-breadcrumb{font-size:12px;color:var(--user-account-block-ink-400);margin-bottom:16px;}
  .user-account-block-breadcrumb a{color:var(--user-account-block-ink-400);text-decoration:none;}
  .user-account-block-breadcrumb a:hover{color:var(--user-account-block-green-800);}
  .user-account-block-breadcrumb span{color:var(--user-account-block-danger);font-weight:600;}

  .user-account-block-panel{
    background:var(--user-account-block-white);
    border-radius:var(--user-account-block-radius-lg);
    box-shadow:var(--user-account-block-shadow);
    overflow:hidden;
    border:1px solid var(--user-account-block-border);
  }

  .user-account-block-panel-header{
    background:linear-gradient(135deg,var(--user-account-block-danger),var(--user-account-block-danger-dark));
    color:var(--user-account-block-cream-50);
    padding:22px 28px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .user-account-block-panel-header h1{
    margin:0;font-family:'Poppins',Inter,sans-serif;
    font-size:22px;font-weight:700;
  }
  .user-account-block-panel-close{
    width:32px;height:32px;border-radius:50%;flex:0 0 32px;
    border:1px solid rgba(250,247,240,0.3);
    background:transparent;color:var(--user-account-block-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;font-size:14px;
    cursor:pointer;transition:background .15s ease;
  }
  .user-account-block-panel-close:hover{background:rgba(250,247,240,0.14);}

  .user-account-block-notice{
    margin:20px 28px 0;
    padding:12px 16px;
    background:rgba(176,69,58,0.08);
    border:1px solid rgba(176,69,58,0.25);
    border-radius:var(--user-account-block-radius-sm);
    color:var(--user-account-block-danger);
    font-size:12.5px;font-weight:600;
  }

  .user-account-block-body{
    padding:22px 30px 10px;
    display:grid;
    grid-template-columns:repeat(2, minmax(200px, 1fr));
    gap:0 30px;
  }
  .user-account-block-row{
    display:flex;flex-direction:column;gap:4px;
    padding:14px 0;
    border-bottom:1px solid var(--user-account-block-border);
    font-size:13.5px;
  }
  .user-account-block-row.is-full{grid-column:1 / -1;}
  .user-account-block-label{
    color:var(--user-account-block-ink-600);
    font-weight:600;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:0.03em;
  }
  .user-account-block-colon{display:none;}
  .user-account-block-value{
    color:var(--user-account-block-ink-900);
    font-weight:700;
    font-size:15px;
  }

  @media (max-width:640px){
    .user-account-block-body{grid-template-columns:1fr;}
  }

  .user-account-block-footer{
    display:flex;justify-content:flex-end;gap:10px;
    padding:20px 28px 26px;
  }
  .user-account-block-btn{
    height:42px;padding:0 20px;
    border-radius:var(--user-account-block-radius-sm);
    border:none;cursor:pointer;
    font-size:12.5px;font-weight:700;letter-spacing:0.01em;
    text-decoration:none;
    display:inline-flex;align-items:center;justify-content:center;
    transition:background .15s ease, box-shadow .15s ease, color .15s ease;
  }
  .user-account-block-btn-ghost{background:var(--user-account-block-cream-100);color:var(--user-account-block-ink-900);}
  .user-account-block-btn-ghost:hover{background:var(--user-account-block-border);}
  .user-account-block-btn-danger{
    background:var(--user-account-block-danger);
    color:var(--user-account-block-cream-50);
  }
  .user-account-block-btn-danger:hover{background:var(--user-account-block-danger-dark);}

  .user-account-block-notfound{
    padding:60px 28px;text-align:center;color:var(--user-account-block-ink-400);font-size:14px;
  }
</style>

<div data-page="settings" id="Admin_user_dashboard_03_C">

<div class="user-account-block-app">

 <?php include "../UxUI-Back/Includes/Sidebar_admin_user_dashboard.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="user-account-block-topbar">
    <div class="user-account-block-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="user-account-block-topbar-actions">
      <button class="user-account-block-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="user-account-block-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="user-account-block-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="user-account-block-main">
    <p class="user-account-block-breadcrumb">
      <a href="dashboard.php">Dashboard</a> /
      <a href="settings.php">Settings</a> /
      <a href="settings-user-account.php">User Account</a> /
      <?php if ($user): ?><a href="user-account-profile.php?id=<?= (int) $user['id'] ?>">Profile</a> / <?php endif; ?>
      <span>Block Request</span>
    </p>

    <section class="user-account-block-panel" aria-label="Block Request">

      <div class="user-account-block-panel-header">
        <h1>Block Request</h1>
        <a class="user-account-block-panel-close"
           onclick="Admin_user_dashboard_03_B_OPEN()"
           title="Close" aria-label="Close">✕</a>
      </div>

        <div class="user-account-block-notice">
          This will submit a block request for this account. This action should be reviewed before final removal of access.
        </div>

        <form method="post" id="block-profile-form" onsubmit="event.preventDefault(); blockProfile();">
          <input type="hidden" id="block_profile_id" name="id" value="">

          <div class="user-account-block-body">
            <div class="user-account-block-row">
              <span class="user-account-block-label">Name</span>
              <span class="user-account-block-colon">:</span>
              <span class="user-account-block-value" id="block_profile_name">—</span>
            </div>
            <div class="user-account-block-row is-full">
              <span class="user-account-block-label">Address</span>
              <span class="user-account-block-colon">:</span>
              <span class="user-account-block-value" id="block_profile_address">—</span>
            </div>
            <div class="user-account-block-row">
              <span class="user-account-block-label">Membership No</span>
              <span class="user-account-block-colon">:</span>
              <span class="user-account-block-value" id="block_profile_membership_no">—</span>
            </div>
          </div>

          <div class="user-account-block-footer">
            <a class="user-account-block-btn user-account-block-btn-ghost"
               onclick="Admin_user_dashboard_03_A_OPEN()">Cancel</a>
            <button type="submit" class="user-account-block-btn user-account-block-btn-danger">Process</button>
          </div>
        </form>

    </section>

  </main>

</div>

<div id="bmjm-footer-root"></div>
<!-- <script src="footer-loader.js"></script> -->

</div>
<?php include_once __DIR__ . '/JS/Admin_user_dashboard_03_C_JS.php'; ?>