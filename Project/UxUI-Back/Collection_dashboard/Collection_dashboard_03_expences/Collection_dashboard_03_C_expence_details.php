<style>
  /* ===================================================================
     bmjm Admin — Expense Voucher Print View
     =================================================================== */
  :root{
    --colln-expense-slip-green-950:#0B2E24;
    --colln-expense-slip-green-800:#123832;
    --colln-expense-slip-green-700:#1B4B41;
    --colln-expense-slip-gold-600:#B8923D;
    --colln-expense-slip-gold-500:#C9A227;
    --colln-expense-slip-cream-50:#FAF7F0;
    --colln-expense-slip-cream-100:#F2EDE0;
    --colln-expense-slip-white:#FFFFFF;
    --colln-expense-slip-ink-900:#1E2B26;
    --colln-expense-slip-ink-600:#5A6A62;
    --colln-expense-slip-ink-400:#8B978F;
    --colln-expense-slip-border:#E6E0D0;
    --colln-expense-slip-radius-md:12px;
    --colln-expense-slip-radius-lg:32px;
    --colln-expense-slip-shadow:0 16px 40px rgba(11,46,36,0.12);
    --colln-expense-slip-shadow-sm:0 2px 8px rgba(11,46,36,0.06);
  }

  .collection-details-panel{
    width: 100%; max-width: 900px; margin: 0 auto;
    background: var(--colln-expense-slip-cream-50);
    border-radius:var(--colln-expense-slip-radius-lg);
    box-shadow:var(--colln-expense-slip-shadow);
    overflow:hidden; border:1px solid var(--colln-expense-slip-border);
    display: flex; flex-direction: column;
    min-height: calc(100vh - 180px);
  }
  
  .collection-details-header{
    background:linear-gradient(135deg,var(--colln-green-800),var(--colln-green-950));
    color:var(--colln-white);
    padding:26px 40px;
    display:flex;align-items:center;justify-content:space-between;
  }
  .collection-details-title{
    display:flex;align-items:center;gap:12px;
    font-family:'Poppins',Inter,sans-serif;
    font-size:22px;font-weight:600;
  }
  .collection-details-close{
    width:36px;height:36px;border-radius:50%;
    border:1px solid rgba(250,247,240,0.25);
    background:transparent;color:var(--colln-cream-50);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;transition:all .2s ease;
  }
  .collection-details-close:hover{ background:rgba(250,247,240,0.15); }

  /* ---------- Body layout: receipt + side actions ---------- */
  .payment-slip-body{
    display:flex;align-items:flex-start;gap:24px;
    padding:40px;flex-wrap:wrap;
  }

  /* ---------- Receipt card ---------- */
  .payment-slip-receipt{
    flex:1 1 480px; max-width:600px;
    background:var(--colln-expense-slip-white);
    border:1px solid var(--colln-expense-slip-border);
    border-radius:var(--colln-expense-slip-radius-md);
    box-shadow:var(--colln-expense-slip-shadow-sm);
    padding:40px; margin: 0 auto;
  }
  .payment-slip-receipt-header{text-align:center;margin-bottom:6px;}
  .payment-slip-logo{width:52px;height:52px;object-fit:contain;margin-bottom:8px;}
  .payment-slip-org-name{
    font-family:'Poppins',Inter,sans-serif;
    font-size:16px;font-weight:700;letter-spacing:0.03em;
    color:var(--colln-expense-slip-green-950);margin:0;
  }
  .payment-slip-org-sub{font-size:10.5px;letter-spacing:0.08em;color:var(--colln-expense-slip-gold-600);margin:1px 0 8px;text-transform:uppercase;}
  .payment-slip-org-line{font-size:11.5px;color:var(--colln-expense-slip-ink-600);margin:2px 0;}

  .payment-slip-title{
    text-align:center;font-size:14px;font-weight:700;letter-spacing:0.08em;
    color:var(--colln-expense-slip-ink-900);text-transform:uppercase;
    margin:18px 0 16px;
    padding-top:14px;border-top:1px dashed var(--colln-expense-slip-border);
  }

  .payment-slip-meta{margin-bottom:18px;}
  .payment-slip-meta-row{display:flex;gap:10px;font-size:13px;padding:3px 0;}
  .payment-slip-meta-label{width:90px;flex:none;font-weight:600;color:var(--colln-expense-slip-ink-600);}
  .payment-slip-meta-value{color:var(--colln-expense-slip-ink-900);}

  table.payment-slip-table{width:100%;border-collapse:collapse;margin-bottom:14px;}
  .payment-slip-table thead th{
    text-align:left;font-size:11px;letter-spacing:0.05em;text-transform:uppercase;
    color:var(--colln-expense-slip-white);background:var(--colln-expense-slip-green-800);
    padding:9px 12px;
  }
  .payment-slip-table thead th.payment-slip-col-amount{text-align:right;}
  .payment-slip-table td{padding:12px 12px;font-size:13.5px;border-bottom:1px solid var(--colln-expense-slip-cream-100);}
  .payment-slip-table td.payment-slip-col-amount{text-align:right;font-variant-numeric:tabular-nums;}
  .payment-slip-table tfoot td{
    font-weight:800;font-size:15px;
    border-top:2px solid var(--colln-expense-slip-ink-900);border-bottom:none;
    padding-top:12px;
  }
  .payment-slip-table tfoot td.payment-slip-col-amount{text-align:right;font-variant-numeric:tabular-nums; color: #B0453A;}

  .payment-slip-thanks{
    text-align:center;font-weight:700;letter-spacing:0.04em;
    color:var(--colln-expense-slip-green-800);font-size:14px;
    margin:24px 0 10px;
  }
  .payment-slip-foot{text-align:center;font-size:10.5px;color:var(--colln-expense-slip-ink-400);margin:2px 0;}
  .payment-slip-foot-credit{text-align:center;font-size:9.5px;color:var(--colln-expense-slip-ink-400);margin-top:10px;}

  /* ---------- Side actions ---------- */
  .payment-slip-actions{
    flex:0 0 200px;display:flex;flex-direction:column;gap:12px;
  }
  .payment-slip-action-btn{
    height:44px;border-radius:6px;
    border:none;cursor:pointer;
    font-size:13px;font-weight:600;
    display:flex;align-items:center;justify-content:center;gap:8px;
    background:var(--colln-expense-slip-green-800);color:var(--colln-expense-slip-cream-50);
    transition:background .15s ease, transform .1s ease;
  }
  .payment-slip-action-btn:hover{background:var(--colln-expense-slip-green-950);}
  .payment-slip-action-btn.payment-slip-action-print{
    background:linear-gradient(135deg,var(--colln-expense-slip-gold-500),var(--colln-expense-slip-gold-600));
    color:var(--colln-expense-slip-green-950);
  }
  .payment-slip-action-btn.payment-slip-action-print:hover{filter:brightness(0.96);}
  .payment-slip-action-btn svg{width:16px;height:16px;}

  /* ---------- Print ---------- */
  @media print{
    .project-collection-app { display: block !important; }
    .project-collection-main { grid-area: auto !important; padding: 0 !important; margin: 0 !important; }
    .bmjm-sidebar { display: none !important; }
    .project-collection-topbar { display: none !important; }
    .collection-details-header { display: none !important; }
    .payment-slip-actions { display: none !important; }
    body { background: white !important; }
    .collection-dashboard-wrapper { padding: 0 !important; margin: 0 auto !important; }
    .collection-details-panel{ border:none; box-shadow:none; max-width: 100%; border-radius: 0; min-height: auto;}
    .payment-slip-body{ padding:0; flex-direction: column; align-items: center; justify-content: center; }
    .payment-slip-receipt{ border:none; box-shadow:none; max-width: 600px; width: 100%; padding: 0; margin: 0 auto;}
  }
</style>

<div data-page="project" id="Collection_Dashboard_03_C" style="display:none;">
<div class="project-collection-app">
  <?php include "../UxUI-Back/Includes/Sidebar_collection.php"; ?>

  <header class="project-collection-topbar">
    <div class="project-collection-topbar-heading">
      <h1>Payment Dashboard</h1>
      <p>Dashboard Control System</p>
    </div>
    <div class="project-collection-topbar-actions">
      <!-- Standard header actions inherited -->
    </div>
  </header>

  <main class="project-collection-main">
    <div class="collection-dashboard-wrapper">
        <section class="collection-dashboard-content" style="background: transparent; border: none; box-shadow: none;">
            
            <div class="collection-new-wrapper">
                <div class="collection-details-panel">
            
                  <div class="collection-details-header">
                    <div class="collection-details-title">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                      Expense Voucher View
                    </div>
                    <a class="collection-details-close" onclick="Collection_Dashboard_03_A_OPEN()" title="Close Record">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                  </div>
            
                  <div class="payment-slip-body">
                      
                      <!-- ===== Printable receipt ===== -->
                        <div class="payment-slip-receipt" id="payment-slip-receipt">
                          <div class="payment-slip-receipt-header">
                            <img src="../assets/images/common-images/logo.png" class="payment-slip-logo" alt="Bambalapitiya Jumma Masjid logo" onerror="this.style.display='none'">
                            <p class="payment-slip-org-name">BAMBALAPITIYA JUMMA MASJID</p>
                            <p class="payment-slip-org-sub">Expense Voucher</p>
                            <p class="payment-slip-org-line">193/73, Asiri Uyana, Kerawalapitiya Road, Hendala, Wattala</p>
                            <p class="payment-slip-org-line">011 771 0877 &nbsp;|&nbsp; info@bmjm.lk</p>
                          </div>
                
                          <h3 class="payment-slip-title">Internal Expense Voucher</h3>
                
                          <div class="payment-slip-meta">
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Date</span>
                              <span class="payment-slip-meta-value" id="slip-view-date">...</span>
                            </div>
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Status</span>
                              <span class="payment-slip-meta-value" id="slip-view-status">...</span>
                            </div>
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Category</span>
                              <span class="payment-slip-meta-value" id="slip-view-category">...</span>
                            </div>
                          </div>
                
                          <table class="payment-slip-table">
                            <thead>
                              <tr>
                                  <th>Description & Annotations</th>
                                  <th class="payment-slip-col-amount">Amount - LKR</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td id="slip-view-desc">...</td>
                                  <td class="payment-slip-col-amount" id="slip-view-amount-cell">0.00</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                  <td>Total Expense Authorized</td>
                                  <td class="payment-slip-col-amount" id="slip-view-amount-total">0.00</td>
                              </tr>
                            </tfoot>
                          </table>
                
                          <p class="payment-slip-thanks">Record Generated Successfully</p>
                          <p class="payment-slip-foot">Bambalapitiya Jumma Masjid &nbsp;|&nbsp; www.bmjm.lk &nbsp;|&nbsp; 011 771 0877 &nbsp;|&nbsp; info@bmjm.lk</p>
                          <p class="payment-slip-foot-credit">System Powered by Neo Solution</p>
                        </div>
                
                        <!-- ===== Actions ===== -->
                        <div class="payment-slip-actions">
                          <button class="payment-slip-action-btn payment-slip-action-print" onclick="window.print()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 9V3h12v6M6 18h12v3H6v-3ZM4 9h16a2 2 0 0 1 2 2v5h-4M2 16v-5a2 2 0 0 1 2-2"/></svg>
                            Print Voucher
                          </button>
                          
                          <button class="payment-slip-action-btn" onclick="Collection_Dashboard_03_A_OPEN()" style="background: var(--colln-expense-slip-cream-100); color: var(--colln-expense-slip-ink-900); margin-top: 10px;">
                            Return to List
                          </button>
                        </div>

                  </div>
                  
                </div>
            </div>
            
        </section>
    </div>
  </main>
</div>
</div>

<?php 
if (file_exists(__DIR__ . '/JS/Collection_dashboard_03_C_JS.php')) {
    include_once __DIR__ . '/JS/Collection_dashboard_03_C_JS.php';
}
?>
