<script type="text/javascript">
    function Settings_body_01_D_07_bank_account_list() {
        var list = document.getElementById("settings-bank-account-list");
        var empty = document.getElementById("settings-bank-account-empty");
        
        var searchTxtObj = document.getElementById("settings-bank-account-search");
        var searchTxt = searchTxtObj ? searchTxtObj.value.trim() : "";
        
        var searchTypeObj = document.getElementById("settings-bank-account-type");
        var searchType = searchTypeObj ? searchTypeObj.value : "account";

        var sending_value = "search_txt=" + encodeURIComponent(searchTxt) + "&search_type=" + encodeURIComponent(searchType);

        if(list) list.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 40px; color: var(--colln-ink-400);">Loading bank accounts...</td></tr>`;

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Settings/bank_details/view_bank_account_details.php",
            type: "POST",
            data: sending_value,
            cache: false,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    
                    if (searchTxt !== "") {
                        var q = searchTxt.toLowerCase();
                        json_data = json_data.filter(function(r) {
                            var b_name = (r.bank_name || "").toLowerCase();
                            var b_branch = (r.branch || "").toLowerCase();
                            var b_acc = (r.ac_no || "").toLowerCase();
                            if(searchType === 'bank') return b_name.includes(q);
                            if(searchType === 'branch') return b_branch.includes(q);
                            return b_acc.includes(q); 
                        });
                    }

                    Settings_body_01_D_07_set_bank_account_data(json_data);
                } catch(e) {
                    console.error("Error parsing bank list:", e);
                    if(list) list.innerHTML = '';
                    if(empty) empty.style.display = 'block';
                }
            },
            error: function() {
                if(list) list.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 40px; color: var(--colln-danger);">Fatal Network Error.</td></tr>`;
            }
        });
    }

    function Settings_body_01_D_07_set_bank_account_data(json_data) {
        var list = document.getElementById("settings-bank-account-list");
        var empty = document.getElementById("settings-bank-account-empty");

        if (!list) return;
        list.innerHTML = "";

        if (!Array.isArray(json_data) || json_data.length === 0) {
            if (empty) empty.style.display = "block";
            return;
        }

        if (empty) empty.style.display = "none";

        json_data.forEach(function(bankAccount) {
            var row = document.createElement("tr");

            var bankCell = document.createElement("td");
            var bankName = document.createElement("span");
            bankName.className = "colln-bold-txt";
            bankName.textContent = bankAccount.bank_name || "N/A";
            var bankType = document.createElement("span");
            bankType.className = "colln-sub-txt";
            bankType.textContent = bankAccount.ac_name || "Account holder not set";
            bankCell.appendChild(bankName);
            bankCell.appendChild(bankType);

            var branchCell = document.createElement("td");
            var branch = document.createElement("span");
            branch.className = "colln-branch-badge";
            branch.textContent = bankAccount.branch || "Main Branch";
            branchCell.appendChild(branch);

            var accountCell = document.createElement("td");
            var accountNumber = document.createElement("span");
            accountNumber.className = "colln-bold-txt";
            accountNumber.style.letterSpacing = "0.1em";
            accountNumber.style.color = "var(--colln-gold-600)";
            accountNumber.textContent = bankAccount.ac_no || "Pending";
            accountCell.appendChild(accountNumber);

            var actionCell = document.createElement("td");
            var configureButton = document.createElement("button");
            configureButton.type = "button";
            configureButton.className = "colln-action-btn";
            configureButton.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg><span>Edit</span>';
            configureButton.addEventListener("click", function() {
                main_dashboard_05_03_B_OPEN(parseInt(bankAccount.id, 10) || 0);
            });
            actionCell.appendChild(configureButton);

            row.appendChild(bankCell);
            row.appendChild(branchCell);
            row.appendChild(accountCell);
            row.appendChild(actionCell);
            list.appendChild(row);
        });
    }

    $(document).ready(function() {
        Settings_body_01_D_07_bank_account_list();
    });
</script>
