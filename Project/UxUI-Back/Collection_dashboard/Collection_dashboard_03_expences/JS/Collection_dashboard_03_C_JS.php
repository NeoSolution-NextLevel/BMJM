<script>
function loadSingleExpenseDetails(expenseId) {
    if(!expenseId) return;
    
    // Clear panel details briefly to display loading state
    $("#slip-view-date").text("Loading...");
    $("#slip-view-status").text("...");
    $("#slip-view-category").text("...");
    $("#slip-view-desc").text("Loading...");
    $("#slip-view-amount-cell").text("0.00");
    $("#slip-view-amount-total").text("0.00");
    
    $.ajax({
        url: "../../View-List/Projects/bmjm_projects_collection_income_expence_data_info_list/single_expense_detail_JSON_VIEW.php",
        type: "POST",
        dataType: "json",
        data: { id: expenseId },
        success: function(response) {
            if(response && response.error === 0) {
                // Populate Printable Voucher DOM mapping
                let formattedDate = response.date;
                try {
                    formattedDate = new Date(response.date).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: '2-digit', minute:'2-digit' });
                } catch(e) {}
                
                let numericTotal = Number(response.amount).toLocaleString('en-US', {minimumFractionDigits: 2});
                
                $("#slip-view-date").text(formattedDate);
                $("#slip-view-status").text(response.status);
                $("#slip-view-category").text(response.category);
                $("#slip-view-desc").text(response.description);
                $("#slip-view-amount-cell").text(numericTotal);
                $("#slip-view-amount-total").text(numericTotal);
                
            } else {
                alert(response.msg || "Error pulling expense ledger details.");
            }
        },
        error: function(xhr) {
            console.error("Fetch Data Failure:", xhr);
            alert("Backend communication interrupted connecting to JSON endpoint.");
        }
    });
}
</script>
