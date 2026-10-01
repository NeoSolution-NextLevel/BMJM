<script>
function loadSinglePaymentDetails(slipId) {
    if(!slipId) return;
    
    // Fallback UI reset while loading
    $("#slip-view-02-id").text("Loading...");
    $("#slip-view-02-name").text("...");
    $("#slip-view-02-date").text("...");
    $("#slip-view-02-status").text("...");
    $("#slip-view-02-method").text("Loading...");
    $("#slip-view-02-amount-cell").text("0.00");
    $("#slip-view-02-amount-total").text("0.00");
    
    $.ajax({
        url: "../../View-List/Projects/wwjm_projects_collection_list/single_collection_payment_JSON_VIEW.php",
        type: "POST",
        dataType: "json",
        data: { id: slipId },
        success: function(response) {
            if(response && response.error === 0) {
                
                let formattedDate = response.date;
                try {
                    formattedDate = new Date(response.date).toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: '2-digit', minute:'2-digit' });
                } catch(e) {}
                
                let numericTotal = Number(response.amount).toLocaleString('en-US', {minimumFractionDigits: 2});
                let paddedID = "#RCP-" + response.slip_id.toString().padStart(6, '0');
                
                $("#slip-view-02-id").text(paddedID);
                $("#slip-view-02-name").text(response.person_name);
                $("#slip-view-02-date").text(formattedDate);
                $("#slip-view-02-status").text(response.status);
                $("#slip-view-02-method").text(response.method);
                $("#slip-view-02-amount-cell").text(numericTotal);
                $("#slip-view-02-amount-total").text(numericTotal);
                
            } else {
                alert(response.msg || "Error pulling income payment details.");
            }
        },
        error: function(xhr) {
            console.error("AJAX Failed:", xhr);
            alert("Backend communication interrupted connecting to JSON endpoint.");
        }
    });
}
</script>
