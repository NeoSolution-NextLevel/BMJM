<style>
.ticket-panel {
    background:var(--payment-project-white);
    border-radius:var(--payment-project-radius-lg);
    box-shadow:var(--payment-project-shadow);
    overflow:hidden;
    border:1px solid var(--payment-project-border);
}
.ticket-row {
    display:flex;align-items:center;justify-content:space-between;
    padding:14px 18px;
    background:var(--payment-project-cream-50);
    border:1px solid var(--payment-project-border);
    margin-bottom:10px;
    border-radius:var(--payment-project-radius-sm);
    transition: all 0.2s ease;
}
.ticket-row:hover {
    background:var(--payment-project-white);
    border-color:var(--payment-project-gold-500);
}
.ticket-info {
    display:flex;flex-direction:column;
}
.ticket-title { font-size:16px; font-weight:700; color:var(--payment-project-green-950); }
.ticket-desc { font-size:13px; color:var(--payment-project-ink-600); margin-top:2px; font-weight:500;}

.ticket-controls {
    display:flex;align-items:center;gap:18px;
}
.ticket-qty-input {
    width: 60px; height:38px; text-align:center;
    border:1px solid var(--payment-project-border);
    border-radius:var(--payment-project-radius-sm);
    outline:none;
    font-size:15px; font-family:inherit; font-weight:700;
}
.ticket-qty-input:focus { border-color:var(--payment-project-gold-500); }
.ticket-price {
    font-size: 16px; font-weight: 700; color: var(--payment-project-green-800); width: 120px; text-align:right;
}

.ticket-footer {
    padding: 20px 30px; display:flex; justify-content:space-between; align-items:center;
    border-top:1px solid var(--payment-project-border);
    background: var(--payment-project-cream-50);
}
.ticket-total {
    font-size: 20px; font-weight:700; color:var(--payment-project-green-950);
}
.btn-proceed {
    height:44px;padding:0 28px;
    background:linear-gradient(135deg,var(--payment-project-green-800),var(--payment-project-green-950));
    color:var(--payment-project-cream-50);
    border:none;border-radius:8px;
    font-weight:700;cursor:pointer; font-family:inherit; font-size:14px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.btn-proceed:active { transform: translateY(2px); }
</style>

<div data-page="payment" id="Main_dashboard_02_C3" style="display:none;">
    <div class="payment-project-app">
       <?php include "../UxUI-Back/Includes/Sidebar.php"; ?>
       
       <header class="payment-project-topbar">
          <div class="payment-project-topbar-heading">
            <h1>Dashboard</h1>
            <p>Dashboard Control System</p>
          </div>
          <div class="payment-project-topbar-actions">
            <!-- Global header actions -->
          </div>
       </header>
       
       <main class="payment-project-main">
         <p class="payment-project-breadcrumb">
          <a href="javascript:void(0)">Dashboard</a> /
          <a href="javascript:void(0)">Payment</a> /
          <a href="javascript:void(0)" onclick="main_dashboard_02_B_OPEN()">Create Payment</a> /
          <span>Select Tickets</span>
        </p>

        <section class="payment-project-panel ticket-panel">
          <div class="payment-project-panel-header">
            <div class="payment-project-panel-title">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 5.88V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1v1.12"/><path d="M22 10v9a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-9a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2z"/></svg>
              Select Purchase Quantities
            </div>
            <a class="payment-project-panel-close" onclick="main_dashboard_02_C_OPEN()" title="Back">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            </a>
          </div>

          <div style="padding: 26px 30px;">
              <div id="payment-ticket-container">
                  <div style="text-align:center; padding: 40px; color:#888;">Fetching ticket database...</div>
              </div>
          </div>
          
          <div class="ticket-footer">
              <div class="ticket-total" id="payment-ticket-total-disp">Total: LKR 0.00</div>
              <button class="btn-proceed" onclick="proceedToPaymentAfterTickets()">Proceed to Payment Hub</button>
          </div>
        </section>
       </main>
    </div>
</div>
