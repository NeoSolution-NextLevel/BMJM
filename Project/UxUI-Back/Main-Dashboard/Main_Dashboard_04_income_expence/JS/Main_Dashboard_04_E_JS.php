<script>
    var currentExpenseTypeId = 0;

    window.prepareAddTransaction = function(typeId) {
        currentExpenseTypeId = (typeof typeId === 'number') ? typeId : (parseInt(typeId, 10) || 0);
        
        // Reset form
        $('#add-tx-amount').val('');
        $('#add-tx-dis').val('');
        
        // Default today's date
        var today = new Date().toISOString().split('T')[0];
        $('#add-tx-date').val(today);
        
        loadExpenseCategories(currentExpenseTypeId);
    };

    function loadExpenseCategories(selectedId) {
        var categorySelect = $('#add-tx-category');
        categorySelect.html('<option value="">Loading expense categories...</option>');
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_type_list.php",
            type: "POST",
            data: { type_filter: 'expense' },
            dataType: 'json',
            success: function(data) {
                handleCategoryChange(data, selectedId);
            },
            error: function() {
                categorySelect.html('<option value="">Error loading categories</option>');
            }
        });
    }

    function handleCategoryChange(data, selectedId) {
        var categorySelect = $('#add-tx-category');
        var opts = '<option value="">-- Select Expense Category --</option>';
                if (data && data.length > 0) {
                    $.each(data, function(idx, item) {
                        var isSel = (selectedId && selectedId == item.id) ? ' selected' : '';
                        opts += `<option value="${item.id}"${isSel}>${item.name}</option>`;
                    });
                } else {
                    opts = '<option value="">No expense categories found (Add in Settings)</option>';
                }
                categorySelect.html(opts);
    }

    function submitTransaction() {
        var categoryId = $('#add-tx-category').val();
        var amount = parseFloat($('#add-tx-amount').val());
        var dateOfDoc = $('#add-tx-date').val();
        var dis = $('#add-tx-dis').val().trim();
        
        if (!categoryId || categoryId <= 0) {
            alert('Please select an expense category.');
            $('#add-tx-category').focus();
            return;
        }
        
        if (!amount || isNaN(amount) || amount <= 0) {
            alert('Please enter a valid amount greater than 0.');
            $('#add-tx-amount').focus();
            return;
        }
        
        if (!dateOfDoc) {
            alert('Please select the date.');
            $('#add-tx-date').focus();
            return;
        }
        
        if (!dis) {
            alert('Please enter description, staff name, or voucher/bill reference.');
            $('#add-tx-dis').focus();
            return;
        }
        
        var saveBtn = $('#btn-save-tx');
        var originalBtnText = saveBtn.html();
        saveBtn.prop('disabled', true).html('Saving Expense...');
        
        var postData = {
            transaction_type: 'expense',
            type_id: categoryId,
            amount: amount,
            date_of_doc: dateOfDoc,
            dis: dis
        };
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Income_Expense/Income_Expense_add.php",
            type: "POST",
            data: postData,
            dataType: 'json',
            success: function(resp) {
                saveBtn.prop('disabled', false).html(originalBtnText);
                var res = Array.isArray(resp) ? resp[0] : resp;
                if (res && res.error === '0') {
                    alert('Expense record saved successfully!');
                    
                    $('#add-tx-amount').val('');
                    $('#add-tx-dis').val('');
                    
                    if (typeof window.Main_Dashboard_04_C_RELOAD === 'function') {
                        window.Main_Dashboard_04_C_RELOAD();
                    }
                    
                    if (typeof Main_Dashboard_04_C_OPEN === 'function') {
                        Main_Dashboard_04_C_OPEN();
                    }
                } else {
                    alert('Failed to save expense: ' + (res ? res.message : 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                saveBtn.prop('disabled', false).html(originalBtnText);
                alert('Connection error while saving expense.');
                console.error(error);
            }
        });
    }

    function cancelAddTransaction() {
        if (typeof Main_Dashboard_04_C_OPEN === 'function') {
            Main_Dashboard_04_C_OPEN();
        } else {
            window.history.back();
        }
    }
</script>
