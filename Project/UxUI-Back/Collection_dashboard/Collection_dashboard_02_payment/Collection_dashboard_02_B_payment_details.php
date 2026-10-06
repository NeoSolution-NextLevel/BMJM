<style>
  /* ===================================================================
     bmjm Admin — Payment Receipt Print View
     =================================================================== */
  :root{
    --colln-payment-slip-green-950:#0B2E24;
    --colln-payment-slip-green-800:#123832;
    --colln-payment-slip-green-700:#1B4B41;
    --colln-payment-slip-gold-600:#B8923D;
    --colln-payment-slip-gold-500:#C9A227;
    --colln-payment-slip-cream-50:#FAF7F0;
    --colln-payment-slip-cream-100:#F2EDE0;
    --colln-payment-slip-white:#FFFFFF;
    --colln-payment-slip-ink-900:#1E2B26;
    --colln-payment-slip-ink-600:#5A6A62;
    --colln-payment-slip-ink-400:#8B978F;
    --colln-payment-slip-border:#E6E0D0;
    --colln-payment-slip-radius-md:12px;
    --colln-payment-slip-radius-lg:32px;
    --colln-payment-slip-shadow:0 16px 40px rgba(11,46,36,0.12);
    --colln-payment-slip-shadow-sm:0 2px 8px rgba(11,46,36,0.06);
  }

  .collection-details-panel{
    width: 100%; max-width: 900px; margin: 0 auto;
    background: var(--colln-payment-slip-cream-50);
    border-radius:var(--colln-payment-slip-radius-lg);
    box-shadow:var(--colln-payment-slip-shadow);
    overflow:hidden; border:1px solid var(--colln-payment-slip-border);
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
    background:var(--colln-payment-slip-white);
    border:1px solid var(--colln-payment-slip-border);
    border-radius:var(--colln-payment-slip-radius-md);
    box-shadow:var(--colln-payment-slip-shadow-sm);
    padding:40px; margin: 0 auto;
  }
  .payment-slip-receipt-header{text-align:center;margin-bottom:6px;}
  .payment-slip-logo{width:52px;height:52px;object-fit:contain;margin-bottom:8px;}
  .payment-slip-org-name{
    font-family:'Poppins',Inter,sans-serif;
    font-size:16px;font-weight:700;letter-spacing:0.03em;
    color:var(--colln-payment-slip-green-950);margin:0;
  }
  .payment-slip-org-sub{font-size:10.5px;letter-spacing:0.08em;color:var(--colln-payment-slip-gold-600);margin:1px 0 8px;text-transform:uppercase;}
  .payment-slip-org-line{font-size:11.5px;color:var(--colln-payment-slip-ink-600);margin:2px 0;}

  .payment-slip-title{
    text-align:center;font-size:14px;font-weight:700;letter-spacing:0.08em;
    color:var(--colln-payment-slip-ink-900);text-transform:uppercase;
    margin:18px 0 16px;
    padding-top:14px;border-top:1px dashed var(--colln-payment-slip-border);
  }

  .payment-slip-meta{margin-bottom:18px;}
  .payment-slip-meta-row{display:flex;gap:10px;font-size:13px;padding:3px 0;}
  .payment-slip-meta-label{width:90px;flex:none;font-weight:600;color:var(--colln-payment-slip-ink-600);}
  .payment-slip-meta-value{color:var(--colln-payment-slip-ink-900);}

  table.payment-slip-table{width:100%;border-collapse:collapse;margin-bottom:14px;}
  .payment-slip-table thead th{
    text-align:left;font-size:11px;letter-spacing:0.05em;text-transform:uppercase;
    color:var(--colln-payment-slip-white);background:var(--colln-payment-slip-green-800);
    padding:9px 12px;
  }
  .payment-slip-table thead th.payment-slip-col-amount{text-align:right;}
  .payment-slip-table td{padding:12px 12px;font-size:13.5px;border-bottom:1px solid var(--colln-payment-slip-cream-100);}
  .payment-slip-table td.payment-slip-col-amount{text-align:right;font-variant-numeric:tabular-nums;}
  .payment-slip-table tfoot td{
    font-weight:800;font-size:15px;
    border-top:2px solid var(--colln-payment-slip-ink-900);border-bottom:none;
    padding-top:12px;
  }
  .payment-slip-table tfoot td.payment-slip-col-amount{text-align:right;font-variant-numeric:tabular-nums; color: var(--colln-payment-slip-green-950);}

  .payment-slip-thanks{
    text-align:center;font-weight:700;letter-spacing:0.04em;
    color:var(--colln-payment-slip-green-800);font-size:14px;
    margin:24px 0 10px;
  }
  .payment-slip-foot{text-align:center;font-size:10.5px;color:var(--colln-payment-slip-ink-400);margin:2px 0;}
  .payment-slip-foot-credit{text-align:center;font-size:9.5px;color:var(--colln-payment-slip-ink-400);margin-top:10px;}

  /* ---------- Side actions ---------- */
  .payment-slip-actions{
    flex:0 0 200px;display:flex;flex-direction:column;gap:12px;
  }
  .payment-slip-action-btn{
    height:44px;border-radius:6px;
    border:none;cursor:pointer;
    font-size:13px;font-weight:600;
    display:flex;align-items:center;justify-content:center;gap:8px;
    background:var(--colln-payment-slip-green-800);color:var(--colln-payment-slip-cream-50);
    transition:background .15s ease, transform .1s ease;
  }
  .payment-slip-action-btn:hover{background:var(--colln-payment-slip-green-950);}
  .payment-slip-action-btn.payment-slip-action-print{
    background:linear-gradient(135deg,var(--colln-payment-slip-gold-500),var(--colln-payment-slip-gold-600));
    color:var(--colln-payment-slip-green-950);
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

<div data-page="project" id="Collection_Dashboard_02_B" style="display:none;">
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
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="4" y="3" width="16" height="18" rx="2"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                      Payment Slip View
                    </div>
                    <a class="collection-details-close" onclick="Collection_Dashboard_02_A_OPEN()" title="Close Record">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </a>
                  </div>
            
                  <div class="payment-slip-body">
                      
                      <!-- ===== Printable receipt ===== -->
                        <div class="payment-slip-receipt" id="payment-02-slip-receipt">
                          <div class="payment-slip-receipt-header">
                            <img src="../assets/images/common-images/logo.png" class="payment-slip-logo" alt="Bambalapitiya Jumma Masjid logo" onerror="this.style.display='none'">
                            <p class="payment-slip-org-name">BAMBALAPITIYA JUMMA MASJID</p>
                            <p class="payment-slip-org-sub">Payment Receipt</p>
                            <p class="payment-slip-org-line">193/73, Asiri Uyana, Kerawalapitiya Road, Hendala, Wattala</p>
                            <p class="payment-slip-org-line">011 771 0877 &nbsp;|&nbsp; info@bmjm.lk</p>
                          </div>
                
                          <h3 class="payment-slip-title">Payment Receipt</h3>
                
                          <div class="payment-slip-meta">
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">ID #</span>
                              <span class="payment-slip-meta-value" id="slip-view-02-id" style="font-weight: 700;">...</span>
                            </div>
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Donor Name</span>
                              <span class="payment-slip-meta-value" id="slip-view-02-name">...</span>
                            </div>
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Date</span>
                              <span class="payment-slip-meta-value" id="slip-view-02-date">...</span>
                            </div>
                            <div class="payment-slip-meta-row">
                              <span class="payment-slip-meta-label">Status</span>
                              <span class="payment-slip-meta-value" id="slip-view-02-status">...</span>
                            </div>
                          </div>
                
                          <table class="payment-slip-table">
                            <thead>
                              <tr>
                                  <th>Method & Reference</th>
                                  <th class="payment-slip-col-amount">Amount - LKR</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td id="slip-view-02-method">...</td>
                                  <td class="payment-slip-col-amount" id="slip-view-02-amount-cell">0.00</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                  <td>Total Paid Amount</td>
                                  <td class="payment-slip-col-amount" id="slip-view-02-amount-total">0.00</td>
                              </tr>
                            </tfoot>
                          </table>
                
                          <p class="payment-slip-thanks">Thank You, Come Again</p>
                          <p class="payment-slip-foot">Bambalapitiya Jumma Masjid &nbsp;|&nbsp; www.bmjm.lk &nbsp;|&nbsp; 011 771 0877 &nbsp;|&nbsp; info@bmjm.lk</p>
                          <p class="payment-slip-foot-credit">System Powered by Neo Solution</p>
                        </div>
                
                        <!-- ===== Actions ===== -->
                        <div class="payment-slip-actions">
                          <button class="payment-slip-action-btn payment-slip-action-print" onclick="window.print()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 9V3h12v6M6 18h12v3H6v-3ZM4 9h16a2 2 0 0 1 2 2v5h-4M2 16v-5a2 2 0 0 1 2-2"/></svg>
                            Print Receipt
                          </button>
                          
                          <button class="payment-slip-action-btn" onclick="Collection_Dashboard_02_A_OPEN()" style="background: var(--colln-payment-slip-cream-100); color: var(--colln-payment-slip-ink-900); margin-top: 10px;">
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
if (file_exists(__DIR__ . '/JS/Collection_dashboard_02_B_JS.php')) {
    include_once __DIR__ . '/JS/Collection_dashboard_02_B_JS.php';
}
?>
