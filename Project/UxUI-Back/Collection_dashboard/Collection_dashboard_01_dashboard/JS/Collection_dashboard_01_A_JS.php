<script>
// Execute dynamically when document is ready
document.addEventListener("DOMContentLoaded", function() {
    loadCollectionDashboardData();
});

function loadCollectionDashboardData() {
    // Extract ID from URL Parameters
    const urlParams = new URLSearchParams(window.location.search);
    const collectionId = urlParams.get('id');

    // Simple fallback UI if ID is not present
    if (!collectionId) {
        $("#dashboard_project_name").text("Unknown Collection");
        $("#dashboard_collection_id_label").text("Collection ID - N/A");
        return;
    }

    $("#dashboard_collection_id_label").text("Collection ID #" + collectionId);

    // Call bmjm's Single Data JSON Endpoint via jQuery Ajax
    $.ajax({
        url: "../../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php",
        type: "POST",
        dataType: "json",
        data: {
            id: collectionId
        },
        success: function(response) {
            if (response.error === 0) {
                // Populate Text values
                $("#dashboard_summary_header").text("Summary Dashboard / " + response.project_name);
                $("#dashboard_project_name").text(response.project_name);
                
                // Populate visual cover image
                let imgPath = response.project_img_pth ? "../../" + response.project_img_pth : "../../assets/images/sample_project.jpg";
                $("#dashboard_img_box").css("background-image", "url('" + imgPath + "')");
                
                // Format numbers to 2 decimal places with basic localized string equivalent manually for safety
                let formatMoney = (amount) => Number(amount).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                
                let budgetAmount = parseFloat(response.fix_amount) || 0;
                
                // Read from newly exposed DB field instead of masking zero
                let collectedAmount = parseFloat(response.collected_amount) || 0;
                let remainingRequired = budgetAmount - collectedAmount;

                $("#dashboard_kpi_budget").text(formatMoney(budgetAmount));
                $("#dashboard_kpi_collected").text(formatMoney(collectedAmount));
                $("#dashboard_kpi_remaining").text(formatMoney(remainingRequired));

                // Process Dates
                if (response.fix_end_date && response.fix_end_date !== "0000-00-00" && response.is_end_date === "1") {
                    let targetDate = new Date(response.fix_end_date);
                    let now = new Date();
                    
                    // Format Date string: short month, date, year
                    let formattedDate = targetDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    $("#dashboard_kpi_target_date").text(formattedDate);
                    
                    // Calculate Remaining Days
                    let diffTime = targetDate - now;
                    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                    
                    if (diffDays < 0) {
                        $("#dashboard_kpi_days").text("Overdue");
                    } else {
                        $("#dashboard_kpi_days").text(diffDays + " Days");
                    }
                } else {
                    $("#dashboard_kpi_target_date").text("N/A");
                    $("#dashboard_kpi_days").text("-");
                }

            } else {
                $("#dashboard_project_name").text("Record not found");
                $("#dashboard_summary_header").text("Summary Dashboard / Error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching Collection DATA:", error);
            $("#dashboard_project_name").text("Data Fetch Failed");
        }
    });

}
</script>
