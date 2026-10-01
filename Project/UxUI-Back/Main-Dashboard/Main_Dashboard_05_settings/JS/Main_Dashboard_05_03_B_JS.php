<script>
    function Settings_body_01_D_08_show_error(message) {
        var errorBody = document.getElementById("Settings_body_01_D_08_error_msg_body");
        var errorText = document.getElementById("Settings_body_01_D_08_error_msg");
        if (errorText) errorText.textContent = message;
        if (errorBody) errorBody.style.display = "block";
    }

    function Settings_body_01_D_08_set_mode(isEdit) {
        var title = document.getElementById("settings-bank-account-form-title");
        var panel = document.getElementById("settings-bank-account-form-panel");
        var button = document.getElementById("Settings_body_01_D_08_btn");
        var titleText = isEdit ? "Edit Bank Account" : "Add New Bank Account";

        if (title) {
            var svg = title.querySelector("svg");
            title.textContent = titleText;
            if (svg) title.insertBefore(svg, title.firstChild);
        }
        if (panel) panel.setAttribute("aria-label", titleText);
        if (button) button.textContent = isEdit ? "Update" : "Save";
        document.title = titleText + " - bmjm Admin";
    }

    window.settingsBankAccountPrepareNew = function() {
        var form = document.getElementById("Settings_body_01_D_08_from_01");
        var id = document.getElementById("Settings_body_01_D_08_id");
        var errorBody = document.getElementById("Settings_body_01_D_08_error_msg_body");

        if (form) form.reset();
        if (id) id.value = "";
        if (errorBody) errorBody.style.display = "none";
        Settings_body_01_D_08_set_mode(false);
    };

    window.settingsBankAccountLoadEdit = function(bankAccountId) {
        window.settingsBankAccountPrepareNew();
        Settings_body_01_D_08_set_mode(true);

        var editId = document.getElementById("Settings_body_01_D_08_id");
        var button = document.getElementById("Settings_body_01_D_08_btn");
        var loadSucceeded = false;
        if (editId) editId.value = bankAccountId;
        if (button) {
            button.disabled = true;
            button.textContent = "Loading...";
        }

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Settings/bank_details/get_bank_account_details.php",
            type: "POST",
            dataType: "json",
            data: { id: bankAccountId },
            success: function(data) {
                if (!data || data.error !== "0") {
                    Settings_body_01_D_08_show_error(data && data.message ? data.message : "Bank account details could not be loaded.");
                    return;
                }

                document.getElementById("Settings_body_01_D_08_id").value = data.id;
                document.getElementById("Settings_body_01_D_08_bank_name").value = data.bank_name || "";
                document.getElementById("Settings_body_01_D_08_branch").value = data.branch || "";
                document.getElementById("Settings_body_01_D_08_ac_no").value = data.ac_no || "";
                document.getElementById("Settings_body_01_D_08_ac_name").value = data.ac_name || "";
                document.getElementById("Settings_body_01_D_08_swif_code").value = data.swif_code || "";
                document.getElementById("Settings_body_01_D_08_current_ac").checked = data.current_ac === "1";
                document.getElementById("Settings_body_01_D_08_savings_ac").checked = data.savings_ac === "1";
                document.getElementById("Settings_body_01_D_08_dis").value = data.dis || "";
                loadSucceeded = true;
            },
            error: function() {
                Settings_body_01_D_08_show_error("Bank account details could not be loaded.");
            },
            complete: function() {
                if (button) {
                    button.disabled = !loadSucceeded;
                    button.textContent = "Update";
                }
                if (!loadSucceeded && editId) editId.value = "";
            }
        });
    };

    function Settings_body_01_D_08_from_01_SUMBIT(event) {
        event.preventDefault();
        var form = document.getElementById("Settings_body_01_D_08_from_01");
        var editId = document.getElementById("Settings_body_01_D_08_id");
        var val_01 = document.getElementById("Settings_body_01_D_08_bank_name");
        var val_02 = document.getElementById("Settings_body_01_D_08_branch");
        var val_03 = document.getElementById("Settings_body_01_D_08_ac_no");
        var val_04 = document.getElementById("Settings_body_01_D_08_ac_name");
        var val_05 = document.getElementById("Settings_body_01_D_08_swif_code");
        var val_06 = document.getElementById("Settings_body_01_D_08_current_ac");
        var val_07 = document.getElementById("Settings_body_01_D_08_savings_ac");
        var val_08 = document.getElementById("Settings_body_01_D_08_dis");

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        var sending_value = "val_01=" + encodeURIComponent(val_01.value) +
            "&val_02=" + encodeURIComponent(val_02.value) +
            "&val_03=" + encodeURIComponent(val_03.value) +
            "&val_04=" + encodeURIComponent(val_04.value) +
            "&val_05=" + encodeURIComponent(val_05.value) +
            "&val_08=" + encodeURIComponent(val_08.value);

        if (editId && editId.value !== "") {
            sending_value += "&id=" + encodeURIComponent(editId.value);
        }

        if (val_06.checked) {
            sending_value = sending_value + "&current_ac=1";
        }

        if (val_07.checked) {
            sending_value = sending_value + "&savings_ac=1";
        }

        // alert(sending_value);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Settings/bank_details/add_bank_account_details.php",
            type: "POST",
            data: sending_value,
            beforeSend: function() {
                var button = document.getElementById("Settings_body_01_D_08_btn");
                if (button) {
                    button.disabled = true;
                    button.textContent = editId && editId.value !== "" ? "Updating..." : "Saving...";
                }
            },
            success: function(res) {
                var json;
                try {
                    json = JSON.parse(res);
                } catch (error) {
                    Settings_body_01_D_08_show_error("The server returned an invalid response.");
                    return;
                }

                if (json[0] && json[0].error === "0") {
                    if (typeof Settings_body_01_D_07_bank_account_list === "function") {
                        Settings_body_01_D_07_bank_account_list();
                    }
                    main_dashboard_05_03_A_OPEN();
                } else {
                    var message = json[0] && json[0].error
                        ? json[0].error
                        : "Bank account could not be saved.";
                    if (message === "already have Account Number") {
                        message = "This account number is already assigned to another bank account.";
                    }
                    Settings_body_01_D_08_show_error(message);
                }
            },
            error: function() {
                Settings_body_01_D_08_show_error("Bank account could not be saved because of a network error.");
            },
            complete: function() {
                var button = document.getElementById("Settings_body_01_D_08_btn");
                if (button) {
                    button.disabled = false;
                    button.textContent = editId && editId.value !== "" ? "Update" : "Save";
                }
            }
        });
    }
</script>
