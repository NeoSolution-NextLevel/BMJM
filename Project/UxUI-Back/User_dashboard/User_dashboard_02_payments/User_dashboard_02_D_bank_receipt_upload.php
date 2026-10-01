<?php 
$pth = "../";
$active_page = "dashboard2";
$page_title = "Upload Bank Receipt · bmjm Member";

// include '../UxUI-Back/Includes/header.php';  
?>

<style>
  /* ===================================================================
     bmjm Member Dashboard — Upload Bank Receipt (Unique Namespace: ud2d-)
     =================================================================== */
  :root{
    --ud2d-green-950:#0B2E24; --ud2d-green-800:#123832;
    --ud2d-green-700:#1B4B41; --ud2d-green-600:#245F52;
    --ud2d-gold-600:#B8923D; --ud2d-gold-500:#C9A227; --ud2d-gold-300:#E4C766;
    --ud2d-cream-50:#FAF7F0; --ud2d-cream-100:#F2EDE0; --ud2d-white:#FFFFFF;
    --ud2d-ink-900:#1E2B26; --ud2d-ink-600:#5A6A62; --ud2d-ink-400:#8B978F;
    --ud2d-border:#E6E0D0; --ud2d-danger:#D94948;
    --ud2d-radius-sm:8px; --ud2d-radius-md:16px; --ud2d-radius-lg:16px;
    --ud2d-shadow:0 12px 32px rgba(11,46,36,0.06);
    --ud2d-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--ud2d-cream-50);
    font-family:'Inter',-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif;
    color:var(--ud2d-ink-900); -webkit-font-smoothing:antialiased;
  }

  .ud2d-app{
    display:grid; grid-template-columns:248px 1fr; grid-template-rows:64px 1fr;
    min-height:100vh; grid-template-areas: "sidebar topbar" "sidebar main";
  }

  /* ---------- Topbar ---------- */
  .ud2d-topbar{
    grid-area:topbar; background:var(--ud2d-white); border-bottom:1px solid var(--ud2d-border);
    display:flex; align-items:center; justify-content:space-between; padding:0 28px;
  }
  .ud2d-topbar-heading h1{
    font-family:'Poppins',Inter,sans-serif; font-size:18px; font-weight:600; margin:0; color:var(--ud2d-green-950);
  }
  .ud2d-topbar-heading p{ margin:2px 0 0; font-size:12px; color:var(--ud2d-ink-400); }
  .ud2d-topbar-actions{display:flex;align-items:center;gap:10px;}
  .ud2d-icon-btn{
    width:36px;height:36px;border-radius:10px; display:flex;align-items:center;justify-content:center;
    background:var(--ud2d-cream-100); color:var(--ud2d-green-800); border:1px solid var(--ud2d-border);cursor:pointer; transition:all .2s ease;
  }
  .ud2d-icon-btn:hover{
    background:var(--ud2d-gold-300); border-color:var(--ud2d-gold-500); color: var(--ud2d-green-950);
  }
  .ud2d-icon-btn svg{width:16px;height:16px;}

  /* ---------- Main ---------- */
  .ud2d-main{
    grid-area:main; padding:28px 32px 36px; min-width: 0;
    display:flex; align-items:flex-start; justify-content:center;
    min-height:calc(100vh - 64px);
    animation: ud2dFadeSlideUp 0.6s var(--ud2d-cubic) forwards;
  }
  @keyframes ud2dFadeSlideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

  .ud2d-panel {
    width:100%; max-width:680px;
    background: var(--ud2d-white); border-radius: var(--ud2d-radius-lg);
    border: 1px solid var(--ud2d-border); box-shadow: var(--ud2d-shadow); overflow: hidden;
  }
  .ud2d-panel-header {
    background: linear-gradient(135deg, var(--ud2d-green-800), var(--ud2d-green-950));
    color: var(--ud2d-cream-50); padding: 22px 30px;
    display: flex; justify-content: space-between; align-items: center;
  }
  .ud2d-panel-title {
    display:flex; align-items:center; gap:12px;
    font-family:'Poppins', sans-serif; font-size:20px; font-weight:700;
  }
  .ud2d-panel-title svg { width:20px; height:20px; color:var(--ud2d-gold-300); }
  .ud2d-panel-close {
    width:32px; height:32px; border-radius:50%; border:1px solid rgba(250,247,240,0.25);
    background:transparent; color:var(--ud2d-cream-50); display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:background .2s ease; text-decoration:none;
  }
  .ud2d-panel-close:hover { background:rgba(250,247,240,0.15); }

  .ud2d-body { padding: 32px; }

  .ud2d-form-row {
    display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-bottom: 18px;
  }

  .ud2d-form-group { margin-bottom: 18px; }
  .ud2d-label {
    display: block; font-size: 13px; font-weight: 600; color: var(--ud2d-ink-900); margin-bottom: 6px;
  }
  .ud2d-input, .ud2d-select, .ud2d-textarea {
    width: 100%; height: 44px; border: 1px solid var(--ud2d-border); border-radius: var(--ud2d-radius-sm);
    padding: 0 14px; font-size: 14px; font-family: inherit; color: var(--ud2d-ink-900);
    background: var(--ud2d-white); transition: all 0.2s ease; outline:none;
  }
  .ud2d-select { cursor: pointer; }
  .ud2d-textarea { height: 80px; padding: 10px 14px; resize: vertical; }
  .ud2d-input:focus, .ud2d-select:focus, .ud2d-textarea:focus {
    border-color: var(--ud2d-gold-500); box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.15);
  }

  /* Dropzone / Upload Box */
  .ud2d-dropzone {
    border: 2px dashed var(--ud2d-border); border-radius: var(--ud2d-radius-md);
    background: var(--ud2d-cream-50); padding: 24px; text-align: center;
    cursor: pointer; transition: all 0.25s ease; position: relative; margin-bottom: 24px;
  }
  .ud2d-dropzone:hover {
    border-color: var(--ud2d-gold-500); background: rgba(201,162,39,0.04);
  }
  .ud2d-dropzone-icon {
    width: 48px; height: 48px; border-radius: 12px; background: var(--ud2d-cream-100);
    color: var(--ud2d-green-800); display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px; transition: all 0.2s ease;
  }
  .ud2d-dropzone:hover .ud2d-dropzone-icon {
    background: var(--ud2d-gold-300); color: var(--ud2d-green-950); transform: scale(1.05);
  }
  .ud2d-dropzone-icon svg { width: 24px; height: 24px; }
  .ud2d-dropzone-text { font-size: 14px; font-weight: 600; color: var(--ud2d-green-950); margin-bottom: 4px; }
  .ud2d-dropzone-subtext { font-size: 12px; color: var(--ud2d-ink-400); }

  .ud2d-preview-wrapper {
    display: none; position: relative; width: 100%; height: 160px; border-radius: var(--ud2d-radius-md);
    overflow: hidden; border: 1px solid var(--ud2d-border); margin-bottom: 20px; background: #000;
  }
  .ud2d-preview-img { width: 100%; height: 100%; object-fit: contain; }
  .ud2d-remove-btn {
    position: absolute; top: 10px; right: 10px; background: var(--ud2d-danger); color: #fff;
    border: none; border-radius: 6px; padding: 6px 12px; font-size: 12px; font-weight: 600;
    cursor: pointer; transition: background 0.2s ease;
  }
  .ud2d-remove-btn:hover { background: #b83635; }

  /* Footer Actions */
  .ud2d-footer-actions {
    display: flex; gap: 14px; margin-top: 10px;
  }
  .ud2d-btn-cancel, .ud2d-btn-submit {
    flex: 1; height: 46px; border-radius: var(--ud2d-radius-sm); border: none;
    font-size: 14px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center;
    gap: 8px; transition: all 0.2s ease; text-decoration: none;
  }
  .ud2d-btn-cancel {
    background: var(--ud2d-cream-100); color: var(--ud2d-ink-900);
  }
  .ud2d-btn-cancel:hover { background: var(--ud2d-border); color: var(--ud2d-green-950); }
  .ud2d-btn-submit {
    background: linear-gradient(135deg, var(--ud2d-gold-500), var(--ud2d-gold-600));
    color: var(--ud2d-green-950); box-shadow: 0 4px 14px rgba(184,146,61,0.25);
  }
  .ud2d-btn-submit:hover {
    transform: translateY(-1px); box-shadow: 0 6px 18px rgba(184,146,61,0.35);
  }

  @media (max-width: 768px) {
    .ud2d-app { grid-template-columns: 1fr; grid-template-areas: "topbar" "main"; }
    .ud2d-main { padding: 14px; }
    .ud2d-form-row { grid-template-columns: 1fr; gap: 0; }
    .ud2d-body { padding: 16px; }
    .ud2d-footer-actions { flex-direction: column; }
    .ud2d-footer-actions a,
    .ud2d-footer-actions button { width: 100%; min-height: 48px; }
  }
</style>

<div data-page="payment" id="user_dashboard_02_D">
  <div class="ud2d-app">
    <?php include "../UxUI-Back/Includes/Sidebar_user_dashboard.php"; ?>

    <!-- ================= TOPBAR ================= -->
    <header class="ud2d-topbar">
      <div class="ud2d-topbar-heading">
        <h1>Bank Deposit Receipt</h1>
        <p>Submit payment verification slip</p>
      </div>
      <div class="ud2d-topbar-actions">
        <!-- <button class="ud2d-icon-btn" title="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
        </button>
        <button class="ud2d-icon-btn" title="Messages">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
        </button> -->
        <button
          type="button"
          class="ud2d-icon-btn bmjm-user-logout-btn"
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
    <main class="ud2d-main">
      <section class="ud2d-panel">
        <div class="ud2d-panel-header">
          <div class="ud2d-panel-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 21h18"/><path d="M3 10h18"/><path d="M5 6l7-3 7 3"/><path d="M4 10v11"/><path d="M20 10v11"/><path d="M8 14v3"/><path d="M12 14v3"/><path d="M16 14v3"/></svg>
            Upload Bank Receipt
          </div>
          <a class="ud2d-panel-close" onclick="user_dashboard_02_C_OPEN()">✕</a>
        </div>

        <div class="ud2d-body">
          <form id="ud2d-receipt-form" onsubmit="user_dashboard_submit_bank_receipt(event)">
            
            <input type="hidden" id="ud2d-bank-name" value="">
            <input type="hidden" id="ud2d-branch" value="">
            <input type="hidden" id="ud2d-ac-no" value="">
            <input type="hidden" id="ud2d-image-pth" value="">
            
            <div class="ud2d-form-row">
              <div class="ud2d-form-group">
                <label class="ud2d-label" for="ud2d-amount">Paid Amount (LKR) *</label>
                <input type="number" class="ud2d-input" id="ud2d-amount" placeholder="e.g. 5000.00" step="0.01" required>
              </div>
              <div class="ud2d-form-group">
                <label class="ud2d-label" for="ud2d-date">Deposit Date *</label>
                <input type="date" class="ud2d-input" id="ud2d-date" required>
              </div>
            </div>

            <div class="ud2d-form-row">
              <div class="ud2d-form-group">
                <label class="ud2d-label" for="ud2d-bank-acc">Deposited Bank Account *</label>
                <select class="ud2d-select" id="ud2d-bank-acc" onchange="ud2dOnBankSelected(this)" required>
                  <option value="">-- Select Mosque Bank Account --</option>
                  <?php
                  include_once __DIR__ . '/../../../Controller/bank_account_details/bank_account_details_LIST.php';
                  $ud2d_bank_list = new bank_account_details_LIST();
                  $ud2d_bank_list->get_all_data();
                  $ud2d_result = $ud2d_bank_list->get_result();
                  if ($ud2d_result) {
                      while ($row = $ud2d_result->fetch_assoc()) {
                          $b_name = htmlspecialchars($row['bank_name']);
                          $b_branch = htmlspecialchars($row['branch']);
                          $b_ac = htmlspecialchars($row['ac_no']);
                          echo '<option value="' . htmlspecialchars($row['id']) . '" data-bank="' . $b_name . '" data-branch="' . $b_branch . '" data-ac="' . $b_ac . '">' . $b_name . ' - ' . $b_branch . ' (' . $b_ac . ')</option>';
                      }
                  }
                  ?>
                </select>
              </div>
              <div class="ud2d-form-group">
                <label class="ud2d-label" for="ud2d-ref">Transaction / Slip Reference No.</label>
                <input type="text" class="ud2d-input" id="ud2d-ref" placeholder="e.g. TR-99881122">
              </div>
            </div>

            <div class="ud2d-form-group">
              <label class="ud2d-label" for="ud2d-notes">Payment Description / Notes</label>
              <textarea class="ud2d-textarea" id="ud2d-notes" placeholder="Enter any additional notes about your payment..."></textarea>
            </div>

            <div class="ud2d-form-group">
              <label class="ud2d-label">Upload Receipt Slip (Image / PDF) *</label>
              
              <input type="file" id="ud2d-file-input" accept="image/*" style="display:none;" onchange="ud2dHandleFileSelect(this)">
              
              <div class="ud2d-dropzone" id="ud2d-dropzone" onclick="document.getElementById('ud2d-file-input').click()">
                <div class="ud2d-dropzone-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                </div>
                <div class="ud2d-dropzone-text">Click to choose bank receipt file</div>
                <div class="ud2d-dropzone-subtext">Supports PNG, JPG, JPEG (Max 5MB)</div>
              </div>

              <div class="ud2d-preview-wrapper" id="ud2d-preview-wrapper">
                <img id="ud2d-preview-img" class="ud2d-preview-img" alt="Bank Slip Preview">
                <button type="button" class="ud2d-remove-btn" onclick="ud2dRemoveFile()">Remove</button>
              </div>
            </div>

            <div class="ud2d-footer-actions">
              <button type="button" class="ud2d-btn-cancel" onclick="user_dashboard_02_C_OPEN()">Cancel</button>
              <button type="submit" class="ud2d-btn-submit" id="ud2d-submit-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M5 12l5 5L20 7"/></svg>
                Submit Receipt
              </button>
            </div>

          </form>
        </div>
      </section>
    </main>
  </div>
</div>

<?php include __DIR__ . '/JS/User_dashboard_02_D_JS.php'; ?>
