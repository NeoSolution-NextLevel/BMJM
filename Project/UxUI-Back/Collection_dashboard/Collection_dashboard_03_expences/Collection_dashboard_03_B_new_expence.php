<style>
  /* ===================================================================
     bmjm Admin — Form UI Redesign
     Bambalapitiya Jumma Mosque · Expense Dashboard · Add New Expense
     =================================================================== */
  :root{
    --colln-green-950:#0B2E24;
    --colln-green-800:#123832;
    --colln-green-700:#1B4B41;
    --colln-gold-600:#B8923D;
    --colln-gold-500:#C9A227;
    --colln-gold-300:#E4C766;
    --colln-cream-50:#FAF7F0;
    --colln-cream-100:#F2EDE0;
    --colln-white:#FFFFFF;
    --colln-ink-900:#1E2B26;
    --colln-ink-600:#5A6A62;
    --colln-ink-400:#8B978F;
    --colln-border:#E6E0D0;
    --colln-danger:#B0453A;
    --colln-radius-sm:14px;
    --colln-radius-md:20px;
    --colln-radius-lg:32px;
    --colln-shadow-card: 0 16px 40px rgba(11,46,36,0.12);
    --colln-shadow-hover: 0 12px 40px rgba(11,46,36,0.08);
    --colln-cubic: cubic-bezier(0.2, 0.8, 0.2, 1);
  }

  .collection-new-app{
    display:grid;
    grid-template-columns:248px 1fr;
    grid-template-rows:64px 1fr;
    min-height:100vh;
    grid-template-areas:
      "sidebar topbar"
      "sidebar main";
  }

  /* Form Container */
  .collection-new-wrapper {
    display: flex; align-items: stretch; justify-content: stretch; width: 100%;
  }
  .collection-new-panel{
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius:var(--colln-radius-lg);
    box-shadow:var(--colln-shadow-card);
    overflow:hidden; border:1px solid var(--colln-white);
    display: flex; flex-direction: column;
    min-height: calc(100vh - 180px);
    transition: transform 0.4s var(--colln-cubic);
  }
  .collection-new-panel-header{
    background:linear-gradient(135deg,var(--colln-green-800),var(--colln-green-950));
    color:var(--colln-white);
    padding:36px 48px;
    display:flex;align-items:center;justify-content:space-between;
    position: relative; overflow: hidden;
  }
  .collection-new-panel-header::before {
    content: ''; position: absolute; right: 0; top: -50px;
    width: 200px; height: 200px; border-radius: 50%;
    background: var(--colln-gold-500); filter: blur(40px); opacity: 0.2;
    pointer-events: none;
  }
  .collection-new-panel-title{
    display:flex;align-items:center;gap:16px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:26px;font-weight:700;
    position: relative; z-index: 2;
  }
  .collection-new-panel-title svg{width:24px;height:24px;flex:0 0 24px;color:var(--colln-gold-300);}
  
  .collection-new-panel-close{
    width:42px;height:42px;border-radius:50%;flex:0 0 42px;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--colln-cream-50);
    display:flex;align-items:center;justify-content:center;
    text-decoration:none; position: relative; z-index: 2;
    cursor:pointer;transition:all .2s var(--colln-cubic);
  }
  .collection-new-panel-close:hover{
    background:rgba(250,247,240,0.15); transform: rotate(90deg);
  }

  /* Stack Layout */
  .colln-stack { display: flex; flex-direction: column; gap: 24px; margin-top: 24px; padding-bottom: 24px;}
  .colln-bento-card {
    background: var(--colln-white); border: 1px solid var(--colln-border);
    border-radius: var(--colln-radius-md); padding: 28px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: all 0.3s var(--colln-cubic);
  }
  .colln-bento-card:hover { border-color: var(--colln-gold-300); box-shadow: 0 8px 30px rgba(0,0,0,0.06); }
  
  .collection-new-form{padding:30px 48px; min-height: 100%;}
  .collection-new-section-heading{
    display: flex; align-items: center; gap: 14px;
    font-size:13.5px;font-weight:800;letter-spacing:0.08em;
    color:var(--colln-green-800); text-transform: uppercase; margin-bottom: 24px;
  }
  .collection-new-section-heading::after {
    content: ''; flex: 1; height: 1px; background: var(--colln-border);
  }
  .collection-new-section-heading:first-child { margin-top: 0; }

  /* Input Fields */
  .collection-new-field{ display:flex;flex-direction:column;gap:10px;margin-bottom:28px; }
  .collection-new-field:last-child { margin-bottom: 0; }
  .collection-new-field label{ font-size:14.5px;font-weight:700; color:var(--colln-ink-900); }
  .collection-new-required{color:var(--colln-danger);margin-left:4px;font-weight:800; font-size: 16px;}
  
  .collection-new-field input[type="text"],
  .collection-new-field input[type="number"],
  .collection-new-field input[type="date"],
  .collection-new-field input[type="time"],
  .collection-new-select,
  .collection-new-field textarea{
    width: 100%; border:2px solid var(--colln-border); border-radius:var(--colln-radius-sm);
    padding:16px 20px; font-size:15px; font-weight: 500; font-family:inherit;
    color:var(--colln-ink-900); background:var(--colln-white); outline:none; transition:all .2s var(--colln-cubic);
  }
  .collection-new-field input[type="text"], .collection-new-field input[type="date"],
  .collection-new-field input[type="time"], .collection-new-select,
  .collection-new-field input[type="number"] { height:56px; }
  .collection-new-field textarea{ min-height:100px; resize:vertical; padding-top: 18px; }
  
  .collection-new-select { appearance: none; background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%238B978F" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>') no-repeat right 16px center / 16px; cursor: pointer;}
  .collection-new-field input:focus, .collection-new-field textarea:focus, .collection-new-select:focus {
    border-color:var(--colln-green-700); box-shadow:0 8px 24px rgba(27, 75, 65, 0.08); transform: translateY(-2px);
  }

  .colln-row { display: flex; gap: 20px; }
  .colln-row .collection-new-field { flex: 1; margin-bottom: 0; }

  /* Pills for check/radio */
  .colln-pill-group { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; }
  .colln-pill {
      background: var(--colln-white); border: 2px solid var(--colln-border);
      padding: 14px 22px; border-radius: 12px; display: inline-flex; align-items: center; gap: 10px;
      font-weight: 700; font-size: 14px; color: var(--colln-ink-600); cursor: pointer; transition: all 0.2s;
  }
  .colln-pill input { width: 18px; height: 18px; accent-color: var(--colln-green-700); cursor: pointer;}
  .colln-pill:hover, .colln-pill:has(input:checked) {
      border-color: var(--colln-gold-500); color: var(--colln-green-950);
      background: rgba(201, 162, 39, 0.05); box-shadow: 0 4px 12px rgba(201,162,39,0.1);
  }

  /* Submit Action Card - Sticky Footer */
  .collection-new-actions-sticky {
      position: sticky; bottom: 0; left: 0; right: 0;
      background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px);
      padding: 24px 48px; border-top: 1px solid var(--colln-border);
      display: flex; align-items: center; justify-content: flex-end; gap: 16px;
      z-index: 100; border-radius: 0 0 var(--colln-radius-lg) var(--colln-radius-lg);
  }
  .collection-new-btn-ghost{
    height: 56px; padding: 0 32px; border-radius:var(--colln-radius-sm);
    text-decoration:none; display:inline-flex;align-items:center;gap:10px;
    font-size:15px;font-weight:700;letter-spacing:0.02em; cursor:pointer;
    transition:all .3s var(--colln-cubic);
    background: rgba(139, 151, 143, 0.1); color:var(--colln-ink-900); border: 2px solid transparent;
  }
  .collection-new-btn-ghost:hover{
    background:var(--colln-white); border-color: var(--colln-border); box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  .collection-new-btn-primary{
    height: 56px; padding: 0 40px; border-radius: var(--colln-radius-sm); border: none; cursor: pointer;
    font-size:16px;font-weight:800;letter-spacing:0.02em;
    background: linear-gradient(135deg, var(--colln-gold-500), var(--colln-gold-600)); color: var(--colln-green-950);
    display:flex;align-items:center;justify-content:center; gap: 10px; transition:all .3s var(--colln-cubic);
    box-shadow:0 6px 16px rgba(184,146,61,0.25);
  }
  .collection-new-btn-primary:hover{ box-shadow:0 10px 24px rgba(184,146,61,0.4); transform: translateY(-2px); }

  @media (max-width:900px){
    .collection-new-panel-header { padding: 30px; }
    .collection-new-form { padding: 30px; }
    .colln-bento-card { padding: 20px; }
    .colln-row { flex-direction: column; gap: 24px;}
    .collection-new-actions-sticky { flex-direction: column-reverse; padding: 24px; }
    .collection-new-btn-ghost, .collection-new-btn-primary { width: 100%; justify-content: center; }
  }
</style>

<div data-page="project" id="Collection_Dashboard_03_B" style="display:none;">

<div class="project-collection-app">

  <!-- Uses Global Sidebar created by User -->
  <?php include "../UxUI-Back/Includes/Sidebar_collection.php"; ?>

  <!-- ================= TOPBAR ================= -->
  <header class="project-collection-topbar">
    <div class="project-collection-topbar-heading">
      <h1>Payment Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="project-collection-topbar-actions">
      <button class="project-collection-icon-btn" title="Notifications">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 10a6 6 0 1 1 12 0c0 4 1.5 5.5 1.5 5.5H4.5S6 14 6 10Z"/><path d="M10 19a2 2 0 0 0 4 0"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Messages">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 6 8.5 6.5L20.5 6"/></svg>
      </button>
      <button class="project-collection-icon-btn" title="Sign out">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h3"/><path d="M15 8l4 4-4 4M19 12H9"/></svg>
      </button>
    </div>
  </header>

  <!-- ================= MAIN ================= -->
  <main class="project-collection-main">
    
    <div class="collection-dashboard-wrapper">
        <section class="collection-dashboard-content" style="background: transparent; border: none; box-shadow: none;">
            
            <div class="collection-new-wrapper">
                <div class="collection-new-panel" aria-label="Create new expence">
            
                  <!-- Header -->
                  <div class="collection-new-panel-header">
                    <div class="collection-new-panel-title">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                      Add New Expense.
                    </div>
                    <a class="collection-new-panel-close" onclick="Collection_Dashboard_03_A_OPEN()" title="Cancel">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                  </div>
            
                  <!-- Form Component -->
                  <form class="collection-new-form" id="expense-new-form" novalidate onsubmit="return false;">
                    
                    <div class="colln-stack">
                      
                          <div class="colln-bento-card">
                              <div class="collection-new-section-heading">Expense Core Info</div>
                              
                              <div class="colln-row">
                                  <div class="collection-new-field">
                                    <label>Expense Date<span class="collection-new-required">*</span></label>
                                    <input type="date" id="expense-new-date" name="date" required value="<?php echo date('Y-m-d'); ?>">
                                  </div>
                                  <div class="collection-new-field">
                                    <label>Amount (LKR)<span class="collection-new-required">*</span></label>
                                    <input type="number" id="expense-new-amount" name="amount" placeholder="Rs. 5,000.00" required>
                                  </div>
                                  </div>
                              
                              <div class="collection-new-field">
                                <label>Description / Reason<span class="collection-new-required">*</span></label>
                                <textarea id="expense-new-description" name="description" placeholder="E.g. Purchased food supplies for the event..." required></textarea>
                              </div>
                              
                              <div class="collection-new-field" style="display:none;">
                                  <!-- Category auto-mapped on server side based on active project -->
                              </div>
                          </div>
                      
                          <div class="colln-bento-card">
                              <div class="collection-new-section-heading">Payee & Method Details</div>
                              
                              <div class="collection-new-field">
                                <label>Vendor / Payee</label>
                                <input type="text" id="expense-new-vendor" name="vendor" placeholder="E.g. Supplier Name">
                              </div>
                              
                              <div class="collection-new-section-heading" style="margin-top: 24px;">Payment Source</div>
                              <div class="colln-pill-group" style="margin-bottom: 0;">
                                  <label class="colln-pill"><input type="radio" name="payment_method" value="cash" checked> Cash</label>
                                  <label class="colln-pill"><input type="radio" name="payment_method" value="bank"> Bank Transfer</label>
                                  <label class="colln-pill"><input type="radio" name="payment_method" value="cheque"> Cheque</label>
                              </div>
                          </div>
                          
                    </div>
                  </form>
                  
                  <div class="collection-new-actions-sticky">
                      <a class="collection-new-btn-ghost" href="javascript:void(0);" onclick="Collection_Dashboard_03_A_OPEN()">Cancel</a>
                      <button type="button" class="collection-new-btn-primary" onclick="submitCollectionNewExpense();">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                          Save Expense
                      </button>
                  </div>
                  
                </div>
            </div>
            
        </section>
    </div>
    
  </main>
</div>

</div>

<?php 
if (file_exists(__DIR__ . '/JS/Collection_dashboard_03_B_JS.php')) {
    include_once __DIR__ . '/JS/Collection_dashboard_03_B_JS.php';
}
?>
