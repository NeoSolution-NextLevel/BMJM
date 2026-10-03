<script>
    var incomeDataStore = [];

    function fetchIncomeTotals() {
        var sending_value = {};
        $.ajax({
            
            url: "<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_list.php",
            type: "POST",
            data: sending_value,
            dataType: 'json',
            success: function(data) {
                if(data && data.length > 0) {
                    incomeDataStore = data;
                } else {
                    incomeDataStore = [];
                }
                renderIncomeGrid();
            },
            error: function(xhr, status, error) {
                $('#income_type_grid').html('<div class="income-tracker-loading" style="color:var(--projc-danger);">Error establishing connection to backend.</div>');
                console.error(error);
            }
        });
    }

    function renderIncomeGrid() {
        var grid = $('#income_type_grid');
        var grandDisplay = $('#grand_total_display');
        
        var q = ($('#income-search').val() || '').trim().toLowerCase();
        
        var filteredData = incomeDataStore.filter(function(item) {
            return !q || String(item.type_name).toLowerCase().includes(q);
        });

        if(filteredData.length === 0) {
            grid.html('<div class="income-tracker-loading">No income types found.</div>');
            grandDisplay.html('<span>LKR</span> 0.00');
            return;
        }

        var grandTotal = 0;
        var htmlContent = '';
        
        $.each(filteredData, function(idx, item) {
            var amount = parseFloat(item.total_amount) || 0;
            grandTotal += amount;
            htmlContent += `
            <div class="income-type-card" style="cursor: pointer;" onclick="Main_Dashboard_04_B_OPEN(${item.id})">
                <div class="income-type-header">
                    <div class="income-type-icon">
                        LKR
                    </div>
                    <div>
                        <div class="income-type-badge">Income Group</div>
                        <div class="income-type-name">${item.type_name}</div>
                    </div>
                </div>
                <div class="income-type-amount">${amount.toLocaleString('en-LK', {minimumFractionDigits: 2})}</div>
            </div>
            `;
        });
        
        grid.html(htmlContent);
        grandDisplay.html('<span>LKR</span> ' + grandTotal.toLocaleString('en-LK', {minimumFractionDigits: 2}));
    }

    $(document).ready(function() {
        fetchIncomeTotals();
    });
</script>
