<?php
    $pth = "../";
    $active_page = "settings-user-account";
    $page_title = "Edit Profile · bmjm Admin";
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

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
        $mobile = trim($_POST['mobile'] ?? '');
        if ($mobile === '') {
            $errors[] = 'Mobile (Local Notification) is required.';
        }

        if (empty($errors)) {
            // TODO(backend): persist the changes, e.g.
            // $stmt = $pdo->prepare('UPDATE users SET email=?, residence_address=?, road_name=?,
            //     residence_type=?, monthly_maintain_amount=?, mobile=?, whatsapp=? WHERE id=?');
            // $stmt->execute([...]);

            header('Location: user-account-profile.php?id=' . $id);
            exit;
        }
    }
?>
<style>
  :root{
    --user-account-edit-green-950:#0B2E24;
    --user-account-edit-green-800:#123832;
    --user-account-edit-green-700:#1B4B41;
    --user-account-edit-gold-600:#B8923D;
    --user-account-edit-gold-500:#C9A227;
    --user-account-edit-gold-300:#E4C766;
    --user-account-edit-cream-50:#FAF7F0;
    --user-account-edit-cream-100:#F2EDE0;
    --user-account-edit-white:#FFFFFF;
    --user-account-edit-ink-900:#1E2B26;
    --user-account-edit-ink-600:#5A6A62;
    --user-account-edit-ink-400:#8B978F;
    --user-account-edit-border:#E6E0D0;
    --user-account-edit-danger:#B0453A;
    --user-account-edit-radius-sm:8px;
    --user-account-edit-radius-lg:22px;
    --user-account-edit-shadow:0 6px 24px rgba(11,46,36,0.08);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}

  body{
    background:var(--user-account-edit-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--user-account-edit-ink-900);
    -webkit-font-smoothing:antialiased;
    padding-bottom:40px;
  }

  .user-account-edit-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  .user-account-edit-topbar{
    grid-area:topbar;
    background:var(--user-account-edit-white);
    border-bottom:1px solid var(--user-account-edit-border);
    display:flex;align-items:center;justify-content:space-between;
    padding:0 30px;
  }
  .user-account-edit-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif;
    font-size:19px;font-weight:600;margin:0;
    color:var(--user-account-edit-green-950);
  }
  .user-account-edit-topbar-heading p{margin:1px 0 0;font-size:11.5px;color:var(--user-account-edit-ink-400);}
  .user-account-edit-topbar-actions{display:flex;align-items:center;gap:18px;}
  .user-account-edit-icon-btn{
    width:34px;height:34px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:var(--user-account-edit-cream-100);color:var(--user-account-edit-green-800);
    border:none;cursor:pointer;transition:background .15s ease;
  }
  .user-account-edit-icon-btn:hover{background:var(--user-account-edit-gold-300);}
  .user-account-edit-icon-btn svg{width:16px;height:16px;}

  @media (max-width:900px){
    .user-account-edit-app{grid-template-columns:1fr;grid-template-areas:"topbar" "main";}
  }

  .user-account-edit-main{grid-area:main;padding:26px 30px 50px;}

  .user-account-edit-breadcrumb{font-size:12px;color:var(--user-account-edit-ink-400);margin-bottom:16px;}
  .user-account-edit-breadcrumb a{color:var(--user-account-edit-ink-400);text-decoration:none;}
  .user-account-edit-breadcrumb a:hover{color:var(--user-account-edit-green-700);}
  .user-account-edit-breadcrumb span{color:var(--user-account-edit-green-700);font-weight:600;}

  .user-account-edit-panel{
    background:var(--user-account-edit-white);
    border-radius:var(--user-account-edit-radius-lg);
    box-shadow:var(--user-account-edit-shadow);
    overflow:hidden;
    border:1px solid var(--user-account-edit-border);
  }

  .user-account-edit-panel-header{
    background:linear-gradient(135deg,var(--user-account-edit-green-800),var(--user-account-edit-green-950));
    color:var(--user-account-edit-cream-50);
    padding:22px 28px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .user-account-edit-panel-header h1{
    margin:0;font-family:'Poppins',Inter,sans-serif;
    font-size:22px;font-weight:700;
  }
  .user-account-edit-panel-close{
    width:32px;height:32px;border-radius:50%;flex:0 0 32px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--user-account-edit-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none;font-size:14px;
    cursor:pointer;transition:background .15s ease;
  }
  .user-account-edit-panel-close:hover{background:rgba(250,247,240,0.12);}

  .user-account-edit-body{
    padding:24px 30px 4px;
    display:grid;
    grid-template-columns:repeat(2, minmax(220px, 1fr));
    gap:0 30px;
    align-items:start;
  }
  .user-account-edit-body > .user-account-edit-error,
  .user-account-edit-body > .user-account-edit-field.is-full,
  .user-account-edit-body > .user-account-edit-row-with-check{
    grid-column:1 / -1;
  }

  @media (max-width:700px){
    .user-account-edit-body{grid-template-columns:1fr;}
  }

  .user-account-edit-error{
    background:rgba(176,69,58,0.1);
    border:1px solid rgba(176,69,58,0.3);
    color:var(--user-account-edit-danger);
    border-radius:var(--user-account-edit-radius-sm);
    padding:12px 16px;
    font-size:13px;font-weight:600;
    margin-bottom:18px;
  }

  .user-account-edit-field{display:flex;flex-direction:column;gap:6px;margin-bottom:16px;}
  .user-account-edit-field label{font-size:12px;font-weight:700;color:var(--user-account-edit-ink-900);}
  .user-account-edit-field label.is-required::after{content:" *";color:var(--user-account-edit-danger);}
  .user-account-edit-input,.user-account-edit-select{
    height:42px;
    border:1px solid var(--user-account-edit-border);
    border-radius:var(--user-account-edit-radius-sm);
    padding:0 14px;
    font-size:13.5px;font-family:inherit;
    color:var(--user-account-edit-ink-900);
    background:var(--user-account-edit-white);
    outline:none;
    transition:border-color .15s ease;
  }
  .user-account-edit-input:focus,.user-account-edit-select:focus{border-color:var(--user-account-edit-gold-500);}
  .user-account-edit-input:disabled{background:var(--user-account-edit-cream-100);color:var(--user-account-edit-ink-400);}
  .user-account-edit-radio-row{display:flex;gap:20px;align-items:center;}
  .user-account-edit-check{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--user-account-edit-ink-900);cursor:pointer;}
  .user-account-edit-check input{width:15px;height:15px;accent-color:var(--user-account-edit-green-700);cursor:pointer;}
  .user-account-edit-inline-check{display:flex;align-items:center;gap:7px;font-size:12px;color:var(--user-account-edit-ink-600);white-space:nowrap;margin-top:8px;}
  .user-account-edit-inline-check input{width:14px;height:14px;accent-color:var(--user-account-edit-green-700);cursor:pointer;}
  .user-account-edit-row-with-check{display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;}
  .user-account-edit-row-with-check .user-account-edit-field{flex:1;min-width:200px;margin-bottom:0;}

  .user-account-edit-footer{
    display:flex;justify-content:flex-end;gap:10px;
    padding:20px 28px 26px;
  }
  .user-account-edit-btn{
    height:42px;padding:0 20px;
    border-radius:var(--user-account-edit-radius-sm);
    border:none;cursor:pointer;
    font-size:12.5px;font-weight:700;letter-spacing:0.01em;
    text-decoration:none;
    display:inline-flex;align-items:center;justify-content:center;
    transition:background .15s ease, box-shadow .15s ease, color .15s ease;
  }
  .user-account-edit-btn-ghost{background:var(--user-account-edit-cream-100);color:var(--user-account-edit-ink-900);}
  .user-account-edit-btn-ghost:hover{background:var(--user-account-edit-border);}
  .user-account-edit-btn-primary{
    background:linear-gradient(135deg,var(--user-account-edit-gold-500),var(--user-account-edit-gold-600));
    color:var(--user-account-edit-green-950);
    box-shadow:0 4px 12px rgba(184,146,61,0.35);
  }
  .user-account-edit-btn-primary:hover{box-shadow:0 6px 16px rgba(184,146,61,0.45);}

  .user-account-edit-notfound{
    padding:60px 28px;text-align:center;color:var(--user-account-edit-ink-400);font-size:14px;
  }
</style>

<div data-page="settings" id="Admin_user_dashboard_03_B">

<div class="user-account-edit-app">

  <?php include "../UxUI-Back/Includes/Sidebar_admin_user_dashboard.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="user-account-edit-topbar">
    <div class="user-account-edit-topbar-heading">
      <h1>Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="user-account-edit-topbar-actions">
      <button class="user-account-edit-icon-btn" title="Notifications" aria-label="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="user-account-edit-icon-btn" title="Messages" aria-label="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="user-account-edit-icon-btn" title="Sign out" aria-label="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="user-account-edit-main">
    <p class="user-account-edit-breadcrumb">
      <a href="dashboard.php">Dashboard</a> /
      <a href="settings.php">Settings</a> /
      <a href="settings-user-account.php">User Account</a> /
      <?php if ($user): ?><a href="user-account-profile.php?id=<?= (int) $user['id'] ?>">Profile</a> / <?php endif; ?>
      <span>Edit</span>
    </p>

    <section class="user-account-edit-panel" aria-label="Edit Profile">

      <div class="user-account-edit-panel-header">
        <h1>Edit Profile</h1>
        <a class="user-account-edit-panel-close"
           href="<?= $user ? 'user-account-profile.php?id=' . (int) $user['id'] : 'settings-user-account.php' ?>"
           title="Close" aria-label="Close">✕</a>
      </div>

        <form method="post" onsubmit="return submitProfileEditForm(event);">
          <input type="hidden" id="edit_profile_id" name="id" value="">

          <div class="user-account-edit-body">

            <div class="user-account-edit-field">
              <label for="edit_profile_email">Email</label>
              <input type="email" class="user-account-edit-input" id="edit_profile_email" name="email"
                     value="" placeholder="name@example.com">
            </div>

            <div class="user-account-edit-field is-full">
              <label for="edit_profile_address">Residence Address</label>
              <input type="text" class="user-account-edit-input" id="edit_profile_address" name="residenceAddress"
                     value="" placeholder="Residence address">
            </div>

            <div class="user-account-edit-field">
              <label for="edit_profile_road_name">Road Name</label>
              <select class="user-account-edit-select" id="edit_profile_road_name" name="roadName">
                <option value="">Select road</option>
              </select>
            </div>

            <div class="user-account-edit-field is-full">
              <label>What is your current residing status</label>
              <div class="user-account-edit-radio-row">
                <label class="user-account-edit-check">
                  <input type="radio" id="edit_profile_residence_owner" name="residenceType" value="owner" checked>
                  Own House
                </label>
                <label class="user-account-edit-check">
                  <input type="radio" id="edit_profile_residence_rented" name="residenceType" value="rented">
                  Rented House
                </label>
              </div>
            </div>

            <div class="user-account-edit-field">
              <label for="edit_profile_monthly_amount">Monthly Maintain Amount</label>
              <input type="number" step="0.01" class="user-account-edit-input" id="edit_profile_monthly_amount"
                     name="monthlyMaintainAmount" value="" min="0" placeholder="0.00">
            </div>

            <div class="user-account-edit-field">
              <label for="edit_profile_zakath_type">Zakath Status</label>
              <select class="user-account-edit-select" id="edit_profile_zakath_type" name="zakathType">
                <option value="none">Not applicable</option>
                <option value="payee">Zakath Payee</option>
                <option value="receiver">Zakath Receiver</option>
              </select>
            </div>

            <div class="user-account-edit-row-with-check">
              <div class="user-account-edit-field">
                <label for="edit_profile_mobile" class="is-required">Mobile (Local Notification)</label>
                <input type="tel" class="user-account-edit-input" id="edit_profile_mobile" name="mobile"
                       value="" placeholder="07x xxx xxxx" required>
              </div>
              <label class="user-account-edit-inline-check">
                <input type="checkbox" id="edit_profile_whatsapp_same" name="whatsappSame" value="1"
                       onclick="userAccountEditToggleWhatsapp()">
                WhatsApp on this number?
              </label>
            </div>

            <div class="user-account-edit-field is-full" style="margin-top:16px;">
              <label for="edit_profile_whatsapp">Whats App Number</label>
              <input type="tel" class="user-account-edit-input" id="edit_profile_whatsapp" name="whatsapp"
                     value="" placeholder="07x xxx xxxx">
            </div>

          </div>

          <div class="user-account-edit-footer">
            <button type="button" class="user-account-edit-btn user-account-edit-btn-ghost"
               onclick="if(typeof Admin_user_dashboard_03_A_OPEN === 'function') { Admin_user_dashboard_03_A_OPEN(); }">Cancel</button>
            <button type="submit" class="user-account-edit-btn user-account-edit-btn-primary">Change</button>
          </div>
        </form>

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
<?php include_once __DIR__ . '/JS/Admin_user_dashboard_03_B_JS.php'; ?>
