<script>
document.addEventListener("DOMContentLoaded", function() {
    loadCollectionPayments();
});

function loadCollectionPayments() {
    const urlParams = new URLSearchParams(window.location.search);
    const collectionId = urlParams.get('id');

    var tbody = document.getElementById("payment-list-dynamic-tbody");
    if (!tbody) return;

    if (!collectionId) {
        tbody.innerHTML = `<tr><td colspan="7"><div class="list-empty-state">No Collection Context Provided</div></td></tr>`;
        return;
    }

    // Interactive Skeleton State
    tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 40px; font-weight: 500; color: rgba(139, 151, 143, 0.8);">Loading recent collection transactions...</td></tr>`;

    $.ajax({
        url: "../../View-List/Projects/wwjm_projects_collection_list/bmjm_collection_payments_JSON_VIEW.php",
        type: "POST",
        dataType: "json",
        data: { id: collectionId },
        success: function(response) {
            tbody.innerHTML = "";
            if (response && response.length > 0) {
                let html = "";
                response.forEach((payment, index) => {
                    let formatMoney = (val) => Number(val).toLocaleString('en-US', {minimumFractionDigits: 2});
                    
                    let targetDate = new Date(payment.date);
                    let formattedDate = targetDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    
                    let badgeClass = payment.status === "Completed" ? "badge-success" : "badge-pending";

                    html += `
                    <tr>
                        <td class="td-bold">#RCP-${payment.slip_id.toString().padStart(6, '0')}</td>
                        <td>${payment.person_name}</td>
                        <td>${formattedDate}</td>
                        <td>${payment.method}</td>
                        <td class="td-bold">${formatMoney(payment.amount)}</td>
                        <td><span class="badge ${badgeClass}">${payment.status}</span></td>
                        <td><button class="table-action-btn" onclick="Collection_Dashboard_02_B_OPEN(${payment.slip_id})">View</button></td>
                    </tr>
                    `;
                });
                tbody.innerHTML = html;
            } else {
                tbody.innerHTML = `<tr><td colspan="7"><div class="list-empty-state">No registered transactions linked to this active collection.</div></td></tr>`;
            }
        },
        error: function(err) {
            console.error("AJAX Fetch Failure: ", err);
            tbody.innerHTML = `<tr><td colspan="7"><div class="list-empty-state">Failed to establish connection to Collection Records.</div></td></tr>`;
        }
    });
}
</script>
