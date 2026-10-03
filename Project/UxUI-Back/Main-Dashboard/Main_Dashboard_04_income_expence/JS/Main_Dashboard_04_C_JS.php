<script>
    var expenseDataStore = [];

    function fetchExpenseTotals() {
        var sending_value = {};
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Income_Expense/Expense_list.php",
            type: "POST",
            data: sending_value,
            dataType: 'json',
            success: function(data) {
                if(data && data.length > 0) {
                    expenseDataStore = data;
                } else {
                    expenseDataStore = [];
                }
                renderExpenseGrid();
            },
            error: function(xhr, status, error) {
                $('#expense_type_grid').html('<div class="expense-ov-loading" style="color:var(--expense-ov-danger);">Error establishing connection to backend.</div>');
                console.error(error);
            }
        });
    }

    function renderExpenseGrid() {
        var grid = $('#expense_type_grid');
        var grandDisplay = $('#expense_grand_total_display');
        
        var q = ($('#expense-search').val() || '').trim().toLowerCase();
        
        var filteredData = expenseDataStore.filter(function(item) {
            return !q || String(item.type_name).toLowerCase().includes(q);
        });

        if(filteredData.length === 0) {
            grid.html('<div class="expense-ov-loading">No expense types found.</div>');
            grandDisplay.html('<span>LKR</span> 0.00');
            return;
        }

        var grandTotal = 0;
        var htmlContent = '';
        
        $.each(filteredData, function(idx, item) {
            var amount = parseFloat(item.total_amount) || 0;
            grandTotal += amount;
            htmlContent += `
            <div class="expense-type-card" style="cursor: pointer;" onclick="Main_Dashboard_04_D_OPEN(${item.id})">
                <div class="expense-type-header">
                    <div class="expense-type-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 3v4M8 3v4M12 12v3M12 17v.5"/></svg>
                    </div>
                    <div>
                        <div class="expense-type-badge">Expense Category</div>
                        <div class="expense-type-name">${item.type_name}</div>
                    </div>
                </div>
                <div class="expense-type-amount">${amount.toLocaleString('en-LK', {minimumFractionDigits: 2})}</div>
            </div>
            `;
        });
        
        grid.html(htmlContent);
        grandDisplay.html('<span>LKR</span> ' + grandTotal.toLocaleString('en-LK', {minimumFractionDigits: 2}));
    }

    window.Main_Dashboard_04_C_RELOAD = function() {
        fetchExpenseTotals();
    };

    $(document).ready(function() {
        fetchExpenseTotals();
    });
</script>
