<style>
  .collection-payment-new-summary {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }
  .collection-payment-new-stat {
    background: var(--colln-cream-50);
    border: 1px solid var(--colln-border);
    border-radius: 14px;
    padding: 18px;
  }
  .collection-payment-new-stat span {
    display: block;
    color: var(--colln-ink-600);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .06em;
    text-transform: uppercase;
    margin-bottom: 6px;
  }
  .collection-payment-new-stat strong {
    color: var(--colln-green-950);
    font-size: 18px;
  }
  .collection-payment-new-help {
    color: var(--colln-ink-600);
    font-size: 13px;
    font-weight: 600;
    margin-top: -14px;
  }
  .collection-payment-new-actions {
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    margin-top: 12px;
  }
  @media (max-width:900px) {
    .collection-payment-new-summary {
      grid-template-columns: 1fr;
    }
    .collection-payment-new-actions {
      flex-direction: column-reverse;
    }
  }
</style>

<div data-page="project" id="Collection_Dashboard_02_C" style="display:none;">
<div class="project-collection-app">

  <?php include "../UxUI-Back/Includes/Sidebar_collection.php"; ?>

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

  <main class="project-collection-main">
    <div class="collection-dashboard-wrapper">
      <section class="collection-dashboard-content" style="background: transparent; border: none; box-shadow: none;">
        <div class="collection-new-wrapper">
          <div class="collection-new-panel" aria-label="Create collection payment">

            <div class="collection-new-panel-header">
              <div class="collection-new-panel-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                Add Collection Payment
              </div>
              <a class="collection-new-panel-close" onclick="Collection_Dashboard_02_A_OPEN()" title="Cancel">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
              </a>
            </div>

            <form class="collection-new-form" id="collection-payment-new-form" novalidate onsubmit="return false;">
              <input type="hidden" id="collection-payment-project-name" value="">
              <input type="hidden" id="collection-payment-is-fixed" value="0">
              <input type="hidden" id="collection-payment-remaining" value="0">

              <div class="collection-payment-new-summary">
                <div class="collection-payment-new-stat">
                  <span>Collection</span>
                  <strong id="collection-payment-context-name">Loading...</strong>
                </div>
                <div class="collection-payment-new-stat">
                  <span>Collected</span>
                  <strong>LKR <span id="collection-payment-context-collected">0.00</span></strong>
                </div>
                <div class="collection-payment-new-stat">
                  <span>Remaining</span>
                  <strong id="collection-payment-context-remaining-label">LKR <span id="collection-payment-context-remaining">0.00</span></strong>
                </div>
              </div>

              <div class="colln-stack">
                <div class="colln-bento-card">
                  <div class="collection-new-section-heading">Donor Details</div>
                  <div class="colln-row">
                    <div class="collection-new-field">
                      <label>Donor Name<span class="collection-new-required">*</span></label>
                      <input type="text" id="collection-payment-donor-name" required placeholder="Enter donor name">
                    </div>
                    <div class="collection-new-field">
                      <label>Membership No</label>
                      <input type="text" id="collection-payment-membership-no" placeholder="Optional">
                    </div>
                  </div>
                  <div class="colln-row" style="margin-top:24px;">
                    <div class="collection-new-field">
                      <label>Mobile Number</label>
                      <input type="text" id="collection-payment-phone" placeholder="Optional">
                    </div>
                    <div class="collection-new-field">
                      <label>Email Address</label>
                      <input type="text" id="collection-payment-email" placeholder="Optional">
                    </div>
                  </div>
                  <div class="collection-new-field" style="margin-top:24px;">
                    <label>Address</label>
                    <textarea id="collection-payment-address" placeholder="Optional"></textarea>
                  </div>
                </div>

                <div class="colln-bento-card">
                  <div class="collection-new-section-heading">Payment Details</div>
                  <div class="colln-row">
                    <div class="collection-new-field">
                      <label>Amount (LKR)<span class="collection-new-required">*</span></label>
                      <input type="number" id="collection-payment-amount" min="0.01" step="0.01" inputmode="decimal" required placeholder="Rs. 5,000.00">
                      <p class="collection-payment-new-help" id="collection-payment-limit-help" style="display:none;"></p>
                    </div>
                    <div class="collection-new-field">
                      <label>Payment Method</label>
                      <div class="colln-pill-group" style="margin-bottom:0;">
                        <label class="colln-pill"><input type="radio" name="collection_payment_method" value="cash" checked> Cash</label>
                        <label class="colln-pill"><input type="radio" name="collection_payment_method" value="bank"> Bank Transfer</label>
                      </div>
                    </div>
                  </div>
                  <div class="collection-new-field" style="margin-top:24px;">
                    <label>Note / Reference</label>
                    <textarea id="collection-payment-note" placeholder="Optional payment reference or description"></textarea>
                  </div>
                </div>
              </div>

              <div class="collection-payment-new-actions">
                <a class="collection-new-btn-ghost" href="javascript:void(0);" onclick="Collection_Dashboard_02_A_OPEN()">Cancel</a>
                <button type="button" class="collection-new-btn-primary" id="collection-payment-save-btn" onclick="submitCollectionNewPayment();">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                  Save Payment
                </button>
              </div>
            </form>

          </div>
        </div>
      </section>
    </div>
  </main>
</div>
</div>

<?php
if (file_exists(__DIR__ . '/JS/Collection_dashboard_02_C_JS.php')) {
    include_once __DIR__ . '/JS/Collection_dashboard_02_C_JS.php';
}
?>
