<script>
    var expenseTransactionDataStore = [];
    var current_expense_type_id = 0;

    window.load_expense_transactions_for_category = function(type_id) {
        current_expense_type_id = type_id;
        fetchExpenseTransactions();
    };

    function openAddExpenseForCurrentCategory() {
        if (typeof Main_Dashboard_04_E_OPEN === 'function') {
            Main_Dashboard_04_E_OPEN('expense', current_expense_type_id);
        }
    }

    function fetchExpenseTransactions() {
        if(current_expense_type_id === 0) {
            $('#expense-tx-table-body').html('<tr><td colspan="4" class="expense-empty-state" style="color:var(--expense-in-danger);">Invalid Expense Category ID provided.</td></tr>');
            return;
        }

        var sending_value = { 
            type_id: current_expense_type_id,
            start_date: $('#expense-tx-start-date').val(),
            end_date: $('#expense-tx-end-date').val()
        };
        $('#expense-tx-table-body').html('<tr><td colspan="4" class="expense-empty-state">Loading expenses from backend...</td></tr>');
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Income_Expense/Expense_transactions_list.php",
            type: "POST",
            data: sending_value,
            dataType: 'json',
            success: function(data) {
                if(data && data.transactions && data.transactions.length > 0) {
                    expenseTransactionDataStore = data.transactions;
                    if(data.category_name && data.category_name !== 'Unknown') {
                        $('#expense-category-title-display').text(data.category_name + ' Expenses');
                    }
                } else {
                    expenseTransactionDataStore = [];
                    if(data.category_name && data.category_name !== 'Unknown') {
                        $('#expense-category-title-display').text(data.category_name + ' Expenses');
                    }
                }
                renderExpenseTransactionTable();
            },
            error: function(xhr, status, error) {
                $('#expense-tx-table-body').html('<tr><td colspan="4" class="expense-empty-state" style="color:var(--expense-in-danger);">Error fetching expense records.</td></tr>');
                console.error(error);
            }
        });
    }

    function renderExpenseTransactionTable() {
        var tbody = $('#expense-tx-table-body');
        var txTotalDisplay = $('#expense-tx-total');
        
        var q = ($('#expense-tx-search').val() || '').trim().toLowerCase();
        
        var filteredData = expenseTransactionDataStore.filter(function(item) {
            var searchStr = String(item.description + " " + item.date + " " + item.id).toLowerCase();
            return !q || searchStr.includes(q);
        });

        if(filteredData.length === 0) {
            tbody.html('<tr><td colspan="4" class="expense-empty-state">No expense records found.</td></tr>');
            txTotalDisplay.html('LKR 0.00');
            return;
        }

        var categoryTotal = 0;
        var htmlContent = '';
        
        $.each(filteredData, function(idx, item) {
            var amount = parseFloat(item.amount) || 0;
            categoryTotal += amount;
            
            htmlContent += `
            <tr>
                <td style="color:var(--expense-in-ink-400);">#${item.id}</td>
                <td style="font-weight:600;">${item.date}</td>
                <td>${item.description || '-'}</td>
                <td class="td-bold-expense-price" style="text-align:right;">${amount.toLocaleString('en-LK', {minimumFractionDigits: 2})}</td>
            </tr>
            `;
        });
        
        tbody.html(htmlContent);
        txTotalDisplay.html('LKR ' + categoryTotal.toLocaleString('en-LK', {minimumFractionDigits: 2}));
    }
</script>
