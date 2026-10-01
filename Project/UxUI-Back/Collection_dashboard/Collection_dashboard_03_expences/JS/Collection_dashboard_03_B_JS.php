<script>
function submitCollectionNewExpense() {
    // Basic Form validation
    let isValid = true;
    let requiredFields = $('#expense-new-form').find('[required]');
    
    requiredFields.each(function() {
        if (!$(this).val()) {
            $(this).parent('.collection-new-field').addClass('collection-new-invalid');
            isValid = false;
        } else {
            $(this).parent('.collection-new-field').removeClass('collection-new-invalid');
        }
    });

    if (!isValid) return;

    // Grab URL Param ID dynamically
    const urlParams = new URLSearchParams(window.location.search);
    const collectionId = urlParams.get('id');

    if (!collectionId) {
        alert("Error: Active Project ID missing from context URL.");
        return;
    }

    let date = $('#expense-new-date').val();
    let amount = $('#expense-new-amount').val();
    let desc = $('#expense-new-description').val();
    let vendor = $('#expense-new-vendor').val();
    let method = $('input[name="payment_method"]:checked').val();

    // Include vendor in desc for tracking purposes if provided 
    let finalDesc = vendor && vendor.trim().length > 0 ? desc + " (Vendor: " + vendor + ")" : desc;

    $.ajax({
        url: "../../View-List/Projects/bmjm_projects_collection_income_expence_data_info_list/create_new_expense_JSON.php",
        type: "POST",
        dataType: "json",
        data: {
            project_id: collectionId,
            date: date,
            amount: amount,
            description: finalDesc,
            payment_method: method
        },
        success: function(response) {
            let res = response[0];
            if (res.error === "0") {
                // Return to table screen automatically & Refresh table
                Collection_Dashboard_03_A_OPEN();
                
                // Triggers the data loader written in 03_A_JS so the new record is visually displayed immediately.
                if (typeof loadCollectionExpensesData === "function") {
                    loadCollectionExpensesData();
                }

                // Reset Form state
                $('#expense-new-form')[0].reset();
                $('#expense-new-date').val(new Date().toISOString().split('T')[0]); // Reset to today

                alert("Expense mapped to project seamlessly!");
            } else {
                alert("Creation Error: " + res.error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error mapping expense:", error);
            alert("Network routing error. Please inspect logs.");
        }
    });
}
</script>
