<script type="text/javascript">
    let ipgBaseAmountAdmin = 0;
    let currentIPGMemberAdmin = {};

    function getAdminIPGMemberId() {
        var profileIdInput = document.getElementById('Member_Profile_id');
        if (profileIdInput && profileIdInput.value) {
            return profileIdInput.value;
        }

        var legacyProfileIdInput = document.getElementById('Member_body_01_01_A_01_Memeber_Profile_id');
        if (legacyProfileIdInput && legacyProfileIdInput.value) {
            return legacyProfileIdInput.value;
        }

        var urlParams = new URLSearchParams(window.location.search);
        var urlMemberId = urlParams.get('id');
        return /^\d+$/.test(urlMemberId || '') ? urlMemberId : "";
    }

    function Admin_user_dashboard_02_I_OPEN_AND_LOAD() {
        // Step 1: Open the modal side via normal handler
        if (typeof Admin_user_dashboard_02_I_OPEN === "function") {
            Admin_user_dashboard_02_I_OPEN();
        }

        // Step 2: Fetch the member due amount
        var memberId = getAdminIPGMemberId();

        if (!memberId) {
            console.error("No member selected for IPG link generation!");
            return;
        }

        document.getElementById("ipg-due-amount-display").innerText = "Loading...";
        document.getElementById("ipg-base-amount-input").value = "";
        
        var sending_value = "id=" + encodeURIComponent(memberId);
        
        $.ajax({
            url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/view_single_member.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (json_data.length > 0) {
                        currentIPGMemberAdmin = json_data[0];
                        ipgBaseAmountAdmin = parseFloat(json_data[0].due_to_pay) || 0;
                        document.getElementById("ipg-base-amount-input").value = ipgBaseAmountAdmin;
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
        ipgBaseAmountAdmin = parseFloat(baseInput.value) || 0;
        calculateIPGTotal();
    }

    function calculateIPGTotal() {
        var feeInput = document.getElementById("ipg-bank-fee-input");
        var feePercent = parseFloat(feeInput.value) || 0;
        
        var totalAmount = ipgBaseAmountAdmin * (1 + (feePercent / 100));
        
        var formatted = totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById("ipg-due-amount-display").innerText = formatted;
        
        return totalAmount.toFixed(2);
    }

    function processSendIPG() {
        if (!currentIPGMemberAdmin || !currentIPGMemberAdmin.id) {
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'warning',
                    title: 'Loading Member Data',
                    message: 'Member data is still loading. Please wait a moment and try again.'
                });
            }
            return;
        }

        var totalAmount = calculateIPGTotal();
        
        var cus_name = currentIPGMemberAdmin.name_M || "";
        var cus_phone = currentIPGMemberAdmin.phone_mobile || "";
        var cus_email = currentIPGMemberAdmin.email || "";
        var cus_address = currentIPGMemberAdmin.address_residence || currentIPGMemberAdmin.residence_address_M || "";
        var cus_whatsapp = currentIPGMemberAdmin.notification_whatup || cus_phone;
        var cus_sms = currentIPGMemberAdmin.notification_moible_no || cus_phone;
        
        var payment_type = document.getElementById("DashBord_Payment_body_paying_type_default");
        var member_id = currentIPGMemberAdmin.id;
        var bank_fee_amount = document.getElementById("ipg-bank-fee-input");
        
        var sms = document.getElementById("ipg-send-sms");
        var email = document.getElementById("ipg-send-email");
        var whats_app = document.getElementById("ipg-send-whatsapp");

        var hasSms = sms && sms.checked;
        var hasEmail = email && email.checked;
        var hasWhatsApp = whats_app && whats_app.checked;

        if (!hasSms && !hasEmail && !hasWhatsApp) {
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'warning',
                    title: 'Select Delivery Option',
                    message: 'Please select at least one delivery option (Send By SMS, Send By Email, or Send By URL By Whatsapp).'
                });
            }
            return;
        }

        if (hasSms && !cus_sms) {
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'warning',
                    title: 'Mobile Number Missing',
                    message: 'This member does not have a mobile/SMS number saved. Please update the member phone number or choose another delivery method.'
                });
            }
            return;
        }

        if (hasEmail && !cus_email) {
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'warning',
                    title: 'Email Address Missing',
                    message: 'This member does not have an email address saved. Please update the member email or choose another delivery method.'
                });
            }
            return;
        }

        if (hasWhatsApp && !cus_whatsapp) {
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'warning',
                    title: 'WhatsApp Number Missing',
                    message: 'This member does not have a WhatsApp/mobile number saved. Please update the member phone number or choose another delivery method.'
                });
            }
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
            if (payment_type.value === "subcription") sending_value += "&subcription=1";
            else if (payment_type.value === "Zakath") sending_value += "&zakath=1";
            else if (payment_type.value === "Donation") sending_value += "&donation=1";
            else if (payment_type.value === "Project") sending_value += "&project=1";
        }

        if (member_id && member_id !== "") {
            sending_value += "&is_member=1&member_list_id=" + encodeURIComponent(member_id);
        }

        if (hasSms) sending_value += "&by_sms=1";
        if (hasEmail) sending_value += "&by_email=1";
        if (hasWhatsApp) sending_value += "&by_whats_app=1";

        $.ajax({
            url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Payment/create_IPG_Send_By_URL.php",
            type: "POST",
            data: sending_value,
            success: function(response) { 
                let data;
                try {
                    data = typeof response === "string" ? JSON.parse(response) : response;
                } catch (e) {
                    console.error("Invalid JSON response", e);
                    window.bmjmShowPopup({ type: 'error', title: 'Response Error', message: 'System response error. Please try again.' });
                    return;
                }

                if (Array.isArray(data) && data.length > 0 && data[0].error && data[0].error !== "0") {
                    window.bmjmShowPopup({ type: 'error', title: 'IPG Link Error', message: 'Error processing IPG link: ' + data[0].error });
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
                    window.bmjmShowPopup({ type: 'success', title: 'Payment Link Sent', message: 'Payment IPG link sent successfully via ' + sentChannels.join(' & ') + '!' });
                }

                if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                    Admin_user_dashboard_02_A_OPEN();
                } else {
                    window.history.back();
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to process payment IPG:", error);
                window.bmjmShowPopup({ type: 'error', title: 'Connection Error', message: 'Network error processing payment link.' });
            }
        });
    }
</script>
