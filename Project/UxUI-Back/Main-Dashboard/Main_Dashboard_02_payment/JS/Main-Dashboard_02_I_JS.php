<script>
    // Global variable to store base due amount and user data
    let ipgBaseAmount = 0;
    let currentIPGMember = {};

    function openSendIPG() {
        // Step 1: Open the modal safely
        var ipgElem = document.getElementById("Main_dashboard_02_I");
        if (ipgElem) {
            if (typeof main_dashboard_close_all === "function") {
                main_dashboard_close_all();
            }
            ipgElem.style.display = "block";
            if (typeof setSidebarActive === "function") {
                setSidebarActive('payment');
            }
        }

        // Step 2: Fetch the member due amount
        var member_list_id = document.getElementById("DashBord_Payment_body_member_list_id");
        var member_val = member_list_id ? (member_list_id.value !== undefined ? member_list_id.value : member_list_id.textContent) : "";

        if (!member_val || member_val === "") {
            console.error("No member selected.");
            return;
        }

        document.getElementById("ipg-due-amount-display").innerText = "Loading...";
        document.getElementById("ipg-base-amount-input").value = "";
        
        var sending_value = "id=" + encodeURIComponent(member_val);
        var projId = document.getElementById("payment_selected_project_id");
        var projNameEl = document.getElementById("payment_selected_project_name");
        if (projId && projId.value) {
            sending_value += "&wwjm_projects_collection_list_id=" + encodeURIComponent(projId.value);
            if (projNameEl && projNameEl.value) {
                sending_value += "&wwjm_projects_collection_list_name=" + encodeURIComponent(projNameEl.value);
            }
        }
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/view_single_member.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (json_data.length > 0) {
                        currentIPGMember = json_data[0];
                        
                        var overrideFlag = document.getElementById("Project_Override_Show_Due") ? document.getElementById("Project_Override_Show_Due").value : "0";
                        if (overrideFlag === "1") {
                             ipgBaseAmount = parseFloat(document.getElementById("DashBord_Payment_body_due_to_pay").value) || 0;
                        } else {
                             ipgBaseAmount = parseFloat(json_data[0].due_to_pay) || 0;
                        }
                        
                        document.getElementById("ipg-base-amount-input").value = ipgBaseAmount;
                        calculateIPGTotal();
                    }
                } catch(e) {
                    console.error("Failed to parse member data", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to load Member Data:", error);
            }
        });
    }

    function updateBaseAmount() {
        var baseInput = document.getElementById("ipg-base-amount-input");
        ipgBaseAmount = parseFloat(baseInput.value) || 0;
        
        // --- FIXED BUDGET MAXIMUM CONSTRAINT PROTECTION ---
        var paymentTypeElIpg = document.getElementById("DashBord_Payment_body_paying_type_default");
        var paymentTypeIpg = paymentTypeElIpg ? paymentTypeElIpg.value : "";
        if (paymentTypeIpg === "Projects" || paymentTypeIpg === "Project" || paymentTypeIpg === "projects") {
            var overrideFlagIpg = document.getElementById("Project_Override_Show_Due");
            if (overrideFlagIpg && overrideFlagIpg.value === "1") {
                var maxDueIpg = parseFloat(document.getElementById("DashBord_Payment_body_due_to_pay").value) || 0;
                if (ipgBaseAmount > maxDueIpg) {
                    alert("Cannot exceed the project's remaining fixed budget of LKR " + maxDueIpg.toLocaleString() + " !");
                    ipgBaseAmount = maxDueIpg;
                    if (baseInput) baseInput.value = maxDueIpg;
                }
            }
        }
        // --- END BOUNDS PROTECTION ---
        
        calculateIPGTotal();
    }

    function calculateIPGTotal() {
        var feeInput = document.getElementById("ipg-bank-fee-input");
        var feePercent = parseFloat(feeInput.value) || 0;
        
        var totalAmount = ipgBaseAmount * (1 + (feePercent / 100));
        
        var formatted = totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("ipg-due-amount-display").innerText = formatted;
        
        return totalAmount.toFixed(2);
    }

    function processSendIPG() {
        var totalAmount = calculateIPGTotal();
        
        var cus_name = currentIPGMember.name_M || "";
        var cus_phone = currentIPGMember.phone_mobile || "";
        var cus_email = currentIPGMember.email || "";
        var cus_address = currentIPGMember.address_residence || "";
        var cus_whatsapp = currentIPGMember.notification_whatup || cus_phone;
        var cus_sms = currentIPGMember.notification_moible_no || cus_phone;
        
        var payment_type = document.getElementById("DashBord_Payment_body_paying_type_default");
        var member_id = document.getElementById("DashBord_Payment_body_member_list_id");
        var bank_fee_amount = document.getElementById("ipg-bank-fee-input");
        
        var sms = document.getElementById("ipg-send-sms");
        var email = document.getElementById("ipg-send-email");
        var whats_app = document.getElementById("ipg-send-whatsapp");

        var hasSms = sms && sms.checked;
        var hasEmail = email && email.checked;
        var hasWhatsApp = whats_app && whats_app.checked;

        if (!hasSms && !hasEmail && !hasWhatsApp) {
            alert("Please select at least one delivery option (Send By SMS, Send By Email, or Send By URL By Whatsapp).");
            return;
        }

        var sending_value = "val_01=" + encodeURIComponent(totalAmount) +
            "&val_02=" + encodeURIComponent(cus_name) +
            "&val_03=" + encodeURIComponent(cus_phone) +
            "&val_04=" + encodeURIComponent(cus_email) +
            "&val_05=" + encodeURIComponent(cus_address) +
            "&val_06=" + encodeURIComponent(bank_fee_amount ? bank_fee_amount.value : "0") +
            "&val_07=" + encodeURIComponent(cus_whatsapp) +
            "&val_08=" + encodeURIComponent(cus_sms);

        if (payment_type && payment_type.value) {
            if (payment_type.value == "subcription" || payment_type.value == "Subscription" || payment_type.value == "subscription") sending_value += "&subcription=1";
            else if (payment_type.value == "Zakath" || payment_type.value == "zakath") sending_value += "&zakath=1";
            else if (payment_type.value == "Donation" || payment_type.value == "donation") sending_value += "&donation=1";
            else if (payment_type.value == "Projects" || payment_type.value == "projects" || payment_type.value == "Project") sending_value += "&project=1";
        }

        if (member_id && member_id.value !== "") {
            sending_value += "&is_member=1&member_list_id=" + encodeURIComponent(member_id.value);
        }

        var projId = document.getElementById("payment_selected_project_id");
        var projNameEl = document.getElementById("payment_selected_project_name");
        if (projId && projId.value) {
            sending_value += "&wwjm_projects_collection_list_id=" + encodeURIComponent(projId.value);
            if (projNameEl && projNameEl.value) {
                sending_value += "&wwjm_projects_collection_list_name=" + encodeURIComponent(projNameEl.value);
            }
        }

        if (hasSms) sending_value += "&by_sms=1";
        if (hasEmail) sending_value += "&by_email=1";
        if (hasWhatsApp) sending_value += "&by_whats_app=1";

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Payment/create_IPG_Send_By_URL.php",
            type: "POST",
            data: sending_value,
            success: function(response) { 
                let data;
                try {
                    data = typeof response === "string" ? JSON.parse(response) : response;
                } catch (e) {
                    console.error("Invalid JSON response", e);
                    alert("System response error. Please try again.");
                    return;
                }

                if (Array.isArray(data) && data.length > 0 && data[0].error && data[0].error !== "0") {
                    alert("Error processing IPG link: " + data[0].error);
                    return;
                }

                if (hasWhatsApp) {
                    if (data.length > 0 && data[0].whatsapp_url) {
                        window.open(data[0].whatsapp_url, "_blank");
                    } else {
                        console.error("WhatsApp URL not found in response");
                    }
                }

                if (hasSms || hasEmail) {
                    var sentChannels = [];
                    if (hasSms) sentChannels.push("SMS");
                    if (hasEmail) sentChannels.push("Email");
                    alert("Payment IPG link sent successfully via " + sentChannels.join(" & ") + "!");
                }

                // Navigate back sequentially or close if possible
                if (typeof main_dashboard_02_D_OPEN === "function") {
                    main_dashboard_02_D_OPEN();
                } else {
                    window.history.back();
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to process payment IPG:", error);
                alert("Network error processing payment link.");
            }
        });
    }
</script>