<script>
    var transactionDataStore = [];
    var current_type_id = 0;

    window.load_transactions_for_category = function(type_id) {
        current_type_id = type_id;
        fetchTransactions();
    };

    function fetchTransactions() {
        if(current_type_id === 0) {
            $('#tx-table-body').html('<tr><td colspan="4" class="empty-state" style="color:var(--projc-danger);">Invalid Category ID provided.</td></tr>');
            return;
        }

        var sending_value = { 
            type_id: current_type_id,
            start_date: $('#tx-start-date').val(),
            end_date: $('#tx-end-date').val()
        };
        $('#tx-table-body').html('<tr><td colspan="4" class="empty-state">Loading transactions from backend...</td></tr>');
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_transactions_list.php",
            type: "POST",
            data: sending_value,
            dataType: 'json',
            success: function(data) {
                if(data && data.transactions && data.transactions.length > 0) {
                    transactionDataStore = data.transactions;
                    if(data.category_name && data.category_name !== 'Unknown') {
                        $('#category-title-display').text(data.category_name + ' Transactions');
                    }
                } else {
                    transactionDataStore = [];
                }
                renderTransactionTable();
            },
            error: function(xhr, status, error) {
                $('#tx-table-body').html('<tr><td colspan="4" class="empty-state" style="color:var(--projc-danger);">Error fetching transaction records.</td></tr>');
                console.error(error);
            }
        });
    }

    function renderTransactionTable() {
        var tbody = $('#tx-table-body');
        var txTotalDisplay = $('#tx-total');
        
        var q = ($('#tx-search').val() || '').trim().toLowerCase();
        
        var filteredData = transactionDataStore.filter(function(item) {
            var searchStr = String(item.description + " " + item.date + " " + item.id).toLowerCase();
            return !q || searchStr.includes(q);
        });

        if(filteredData.length === 0) {
            tbody.html('<tr><td colspan="4" class="empty-state">No transactions match your search.</td></tr>');
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
                <td style="color:var(--projc-ink-400);">#${item.id}</td>
                <td style="font-weight:600;">${item.date}</td>
                <td>${item.description || '-'}</td>
                <td class="td-bold-price" style="text-align:right;">${amount.toLocaleString('en-LK', {minimumFractionDigits: 2})}</td>
            </tr>
            `;
        });
        
        tbody.html(htmlContent);
        txTotalDisplay.html('LKR ' + categoryTotal.toLocaleString('en-LK', {minimumFractionDigits: 2}));
    }
</script>
