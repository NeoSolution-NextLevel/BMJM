<script>
let currentProjectTickets = [];

function init_c3_tickets_render() {
    var selectedProjectId = document.getElementById("payment_selected_project_id") ? document.getElementById("payment_selected_project_id").value : null;
    
    if (selectedProjectId) {
        $.ajax({
            url: "../../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php",
            type: "POST",
            dataType: "json",
            data: { id: selectedProjectId },
            success: function(resp) {
                if (resp && resp.error === 0 && resp.have_tickets == 1) {
                    currentProjectTickets = resp.tickets || [];
                    renderC3Tickets();
                } else {
                    if (typeof main_dashboard_02_D_OPEN === 'function') main_dashboard_02_D_OPEN(); // Fallback securely
                }
            },
            error: function() {
                window.bmjmShowPopup({ type: 'error', title: 'Load Error', message: 'Failed to retrieve ticketing structure.' });
                if (typeof main_dashboard_02_D_OPEN === 'function') main_dashboard_02_D_OPEN();
            }
        });
    }
}

function renderC3Tickets() {
    let html = "";
    currentProjectTickets.forEach(t => {
        let maxAvailable = Math.max(0, parseInt(t.qty) - parseInt(t.sold_qty));
        html += `
        <div class="ticket-row">
            <div class="ticket-info">
                <div class="ticket-title">${t.name}</div>
                <div class="ticket-desc">Available capacities: ${maxAvailable} remaining</div>
            </div>
            <div class="ticket-controls">
                <div class="ticket-price">LKR ${Number(t.price).toLocaleString('en-US', {minimumFractionDigits:2})}</div>
                <input type="number" class="ticket-qty-input c3-ticket-val" data-price="${t.price}" data-id="${t.id}" min="0" max="${maxAvailable}" value="0" onchange="calculateC3Tickets()" onkeyup="calculateC3Tickets()">
            </div>
        </div>
        `;
    });
    
    if (currentProjectTickets.length === 0) {
        html = `<div style="text-align:center; padding:40px; color:#888;">No tickets available for this project.</div>`;
    }
    
    document.getElementById("payment-ticket-container").innerHTML = html;
    calculateC3Tickets();
}

function calculateC3Tickets() {
    let total = 0;
    let inputs = document.querySelectorAll(".c3-ticket-val");
    inputs.forEach(inp => {
        let maxQty = parseInt(inp.getAttribute("max")) || 0;
        let qty = parseInt(inp.value) || 0;
        
        // Ensure UI cannot override max limit naturally
        if (qty > maxQty) {
            qty = maxQty;
            inp.value = maxQty;
        }
        if (qty < 0) {
            qty = 0;
            inp.value = 0;
        }
        
        let price = parseFloat(inp.getAttribute("data-price")) || 0;
        total += (qty * price);
    });
    
    document.getElementById("payment-ticket-total-disp").innerText = "Total: LKR " + total.toLocaleString('en-US', {minimumFractionDigits: 2});
    
    // Store in global DOM states for cash_payment endpoints
    var el = document.getElementById("payment_ticket_total_amount");
    if (!el) {
        el = document.createElement("input");
        el.type = "hidden";
        el.id = "payment_ticket_total_amount";
        document.body.appendChild(el);
    }
    el.value = total;
}

function proceedToPaymentAfterTickets() {
    var totalAmt = parseFloat(document.getElementById("payment_ticket_total_amount").value) || 0;
    
    if (totalAmt <= 0) {
        window.bmjmShowPopup({ type: 'warning', title: 'Tickets Required', message: 'Please specify ticket quantities, or click Back to abandon ticket selection.' });
        return;
    }
    
    // Natively override standard member dues values specifically enforcing Ticket Total sums.
    var cashDueAmount = document.getElementById("cash-payment-due-amount");
    if (cashDueAmount) cashDueAmount.innerText = totalAmt.toLocaleString('en-US', {minimumFractionDigits: 2});
    
    var hiddenDue = document.getElementById("DashBord_Payment_body_member_list_amount");
    if (hiddenDue) hiddenDue.value = totalAmt;
    
    // Auto populate the Cash Transaction Interface Amount and lock it
    var cashInput = document.getElementById("cash-paying-amount");
    if (cashInput) {
        cashInput.value = totalAmt;
        cashInput.setAttribute("readonly", "readonly");
        cashInput.style.backgroundColor = "rgba(250, 247, 240, 0.4)"; // Visually indicate locked status
    }
    
    // Auto populate the Bank Transaction Interface Amount and lock it
    var bankInput1 = document.getElementById("deposit-amount");
    if (bankInput1) {
        bankInput1.value = totalAmt;
        bankInput1.setAttribute("readonly", "readonly");
        bankInput1.style.backgroundColor = "rgba(250, 247, 240, 0.4)";
    }
    var bankInput2 = document.getElementById("DashBord_Payment_body_01_B_05_01_from_01_val_1");
    if (bankInput2) {
        bankInput2.value = totalAmt;
        bankInput2.setAttribute("readonly", "readonly");
        bankInput2.style.backgroundColor = "rgba(250, 247, 240, 0.4)";
    }
    
    // Store array of selected tickets into hidden JSON field array string in case DB needs array injection later on slip validation!
    let selectedTickersArr = [];
    document.querySelectorAll(".c3-ticket-val").forEach(inp => {
        if(parseInt(inp.value) > 0) {
             selectedTickersArr.push({
                 id: inp.dataset.id,
                 qty: inp.value
             });
        }
    });
    let tickStore = document.getElementById("payment_selected_tickets_json");
    if(!tickStore){
        tickStore = document.createElement("input");
        tickStore.type = "hidden";
        tickStore.id = "payment_selected_tickets_json";
        document.body.appendChild(tickStore);
    }
    tickStore.value = JSON.stringify(selectedTickersArr);

    if(typeof main_dashboard_02_D_OPEN === 'function') {
        main_dashboard_02_D_OPEN();
    }
}
</script>
