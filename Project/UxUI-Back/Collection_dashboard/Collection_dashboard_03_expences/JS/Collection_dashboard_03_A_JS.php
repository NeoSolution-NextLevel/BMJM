<script>
document.addEventListener("DOMContentLoaded", function() {
    loadCollectionExpensesData();
});

function loadCollectionExpensesData() {
    const urlParams = new URLSearchParams(window.location.search);
    const collectionId = urlParams.get('id');

    if (!collectionId) return;

    $.ajax({
        url: "../../View-List/Projects/bmjm_projects_collection_income_expence_data_info_list/bmjm_projects_collection_expenses_JSON_VIEW.php",
        type: "POST",
        dataType: "json",
        data: { id: collectionId },
        success: function(response) {
            let tbody = $("#collection-dashboard-expense-tbody");
            tbody.empty();
            
            if (response && response.length > 0) {
                response.forEach(function(item) {
                    // Try to format date properly or fallback to string
                    let formattedDate = item.date;
                    try {
                        formattedDate = new Date(item.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    } catch(e) {}
                    
                    let formatMoney = Number(item.amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    
                    // Simple HTML escaping for display
                    let descriptionSafe = $('<div>').text(item.description).html();
                    let categorySafe = $('<div>').text(item.category).html();
                    
                    let tr = `<tr>
                                <td>${formattedDate}</td>
                                <td style="font-weight: 700">${descriptionSafe}</td>
                                <td>Cash</td>
                                <td class="td-bold-price">${formatMoney}</td>
                                <td><button class="table-action-btn" onclick="Collection_Dashboard_03_C_OPEN(${item.id})">Details</button></td>
                              </tr>`;
                    tbody.append(tr);
                });
            } else {
                tbody.append("<tr><td colspan='7' style='text-align:center;'>No expenses found for this collection.</td></tr>");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching Expenses DATA:", error);
            $("#collection-dashboard-expense-tbody").html("<tr><td colspan='7' style='text-align:center;'>Failed to load expenses data.</td></tr>");
        }
    });
}
</script>
