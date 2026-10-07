<script type="text/javascript">
function previewMainDepositImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewImg = document.getElementById("main-deposit-image-preview-img");
            var placeholder = document.getElementById("main-deposit-placeholder-inner");
            var removeBtn = document.getElementById("main-deposit-remove-preview-btn");
            var depositSlipTxt = document.getElementById("deposit_slip_image_pth_txt");
            var hiddenPath = document.getElementById("deposit-image-path-hidden");

            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.style.display = "block";
            }
            if (placeholder) placeholder.style.display = "none";
            if (removeBtn) removeBtn.style.display = "flex";
            if (depositSlipTxt) depositSlipTxt.value = e.target.result;
            if (hiddenPath) hiddenPath.value = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeMainDepositImage(event) {
    if (event) event.stopPropagation();
    var previewImg = document.getElementById("main-deposit-image-preview-img");
    var placeholder = document.getElementById("main-deposit-placeholder-inner");
    var removeBtn = document.getElementById("main-deposit-remove-preview-btn");
    var depositSlipTxt = document.getElementById("deposit_slip_image_pth_txt");
    var hiddenPath = document.getElementById("deposit-image-path-hidden");
    var fileInput = document.getElementById("main-deposit-file-upload");
    var scanInput = document.getElementById("main-deposit-scan-upload");

    if (previewImg) {
        previewImg.src = "";
        previewImg.style.display = "none";
    }
    if (placeholder) placeholder.style.display = "flex";
    if (removeBtn) removeBtn.style.display = "none";
    if (depositSlipTxt) depositSlipTxt.value = "";
    if (hiddenPath) hiddenPath.value = "";
    if (fileInput) fileInput.value = "";
    if (scanInput) scanInput.value = "";
}

function submitBankDeposit() {
    var amountEl = document.getElementById("deposit-amount") || document.getElementById("DashBord_Payment_body_01_B_05_01_from_01_val_1");
    var descEl = document.getElementById("deposit-description") || document.getElementById("DashBord_Payment_body_01_B_05_01_from_01_val_2");

    var amountVal = amountEl ? amountEl.value.trim() : "";
    var descVal = descEl ? descEl.value.trim() : "";

    if (!amountVal || isNaN(parseFloat(amountVal)) || parseFloat(amountVal) <= 0) {
        alert("Please enter a valid paid amount.");
        if (amountEl) amountEl.focus();
        return;
    }

    // --- FIXED BUDGET MAXIMUM CONSTRAINT PROTECTION ---
    var payingTypeElBnk = document.getElementById("DashBord_Payment_body_paying_type_default");
    var paymentTypeBnk = payingTypeElBnk ? payingTypeElBnk.value : "";
    if (paymentTypeBnk === "Projects" || paymentTypeBnk === "Project" || paymentTypeBnk === "projects") {
        var overrideFlagBnk = document.getElementById("Project_Override_Show_Due");
        if (overrideFlagBnk && overrideFlagBnk.value === "1") {
            var maxDueBnk = parseFloat(document.getElementById("DashBord_Payment_body_due_to_pay").value) || 0;
            if (parseFloat(amountVal) > maxDueBnk) {
                alert("Cannot exceed the project's remaining fixed budget of LKR " + maxDueBnk.toLocaleString() + " !");
                if (amountEl) amountEl.focus();
                return;
            }
        }
    }
    // --- END BOUNDS PROTECTION ---

    var membershipNoEl = document.getElementById("DashBord_Payment_body_member_list_membership_no");
    var imagePathEl = document.getElementById("deposit_slip_image_pth_txt") || document.getElementById("deposit-image-path-hidden");
    var bankNameEl = document.getElementById("DashBord_Payment_body_01_B_05_bank_name");
    var branchEl = document.getElementById("DashBord_Payment_body_01_B_05_branch_name");
    var acNoEl = document.getElementById("DashBord_Payment_body_01_B_05_ac_no");
    var bankAccIdEl = document.getElementById("DashBord_Payment_body_01_B_05_bank_account_details_id");
    var memberListIdEl = document.getElementById("DashBord_Payment_body_member_list_id");
    var nonMemberStateEl = document.getElementById("DashBord_Payment_body_01_B_08_02_non_member_state");
    var payingTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");

    var membership_no = membershipNoEl ? membershipNoEl.value : "";
    var image_pth = imagePathEl ? imagePathEl.value : "";
    var bank_name = bankNameEl ? bankNameEl.value : "";
    var branch = branchEl ? branchEl.value : "";
    var ac_no = acNoEl ? acNoEl.value : "";
    var bank_account_details_id = bankAccIdEl ? bankAccIdEl.value : "";
    if (!bank_account_details_id) {
        alert("Please select a deposit bank account first.");
        if (typeof main_dashboard_02_F_OPEN === "function") {
            main_dashboard_02_F_OPEN();
        }
        return;
    }
    var member_list_id = memberListIdEl ? memberListIdEl.value : "";
    var isGuest = (!member_list_id || member_list_id == "0");
    var non_member_state = (nonMemberStateEl && nonMemberStateEl.value == "1") ? "1" : "0";

    if (!isGuest && non_member_state !== "1" && !member_list_id) {
        alert("Please select a member first.");
        if (typeof main_dashboard_02_C_OPEN === "function") {
            main_dashboard_02_C_OPEN();
        }
        return;
    }

    var person_name = "";
    var address = "";
    var member_email = "";
    var member_mobile_no = "";

    // Explicit Context Binding: Safely execute routing evaluating exactly which UI controls rendered the input mathematically.
    if (isGuest) {
        person_name = document.getElementById("bank-manual-name") ? document.getElementById("bank-manual-name").value || "Guest" : "Guest";
        address = document.getElementById("bank-manual-address") ? document.getElementById("bank-manual-address").value || "" : "";
        member_email = document.getElementById("bank-manual-email") ? document.getElementById("bank-manual-email").value || "" : "";
        member_mobile_no = document.getElementById("bank-manual-phone") ? document.getElementById("bank-manual-phone").value || "" : "";
    } else if (non_member_state === "1") {
        var pNameEl = document.getElementById("DashBord_Payment_body_01_B_08_02_person_name");
        var addrEl = document.getElementById("DashBord_Payment_body_01_B_08_02_address");
        var emailEl = document.getElementById("DashBord_Payment_body_01_B_08_02_non_mem_email");
        var phoneEl = document.getElementById("DashBord_Payment_body_01_B_08_02_non_mem_phone_no");

        person_name = pNameEl ? pNameEl.value : "";
        address = addrEl ? addrEl.value : "";
        member_email = emailEl ? emailEl.value : "";
        member_mobile_no = phoneEl ? phoneEl.value : "";
    } else {
        var mNameEl = document.getElementById("DashBord_Payment_body_member_list_name");
        var mAddrEl = document.getElementById("DashBord_Payment_body_member_list_address");
        var mEmailEl = document.getElementById("DashBord_Payment_body_member_list_email");
        var mPhoneEl = document.getElementById("DashBord_Payment_body_member_list_phone_number");

        person_name = mNameEl ? mNameEl.value : "";
        address = mAddrEl ? mAddrEl.value : "";
        member_email = mEmailEl ? mEmailEl.value : "";
        member_mobile_no = mPhoneEl ? mPhoneEl.value : "";
    }

    var postData = "val_01=" + encodeURIComponent(amountVal) +
        "&val_02=" + encodeURIComponent(descVal) +
        "&val_03=" + encodeURIComponent(person_name) +
        "&val_04=" + encodeURIComponent(address) +
        "&val_05=" + encodeURIComponent(membership_no) +
        "&val_06=" + encodeURIComponent(image_pth) +
        "&val_07=" + encodeURIComponent(bank_name) +
        "&val_08=" + encodeURIComponent(branch) +
        "&val_09=" + encodeURIComponent(ac_no) +
        "&val_10=" + encodeURIComponent(bank_account_details_id) +
        "&val_11=" + encodeURIComponent(member_list_id) +
        "&member_email=" + encodeURIComponent(member_email) +
        "&member_mobile_no=" + encodeURIComponent(member_mobile_no) +
        "&wwjm_payment_sliip_id_bank_deposite=0";

    var pType = payingTypeEl && typeof normalizeMainDashboardPaymentReason === 'function'
        ? normalizeMainDashboardPaymentReason(payingTypeEl.value)
        : '';
    var reasonField = typeof getMainDashboardPaymentReasonFlag === 'function'
        ? getMainDashboardPaymentReasonFlag(pType)
        : '';
    if (!reasonField) {
        alert('Please select Subscription, Zakath, Donation, or Projects before submitting.');
        return;
    }
    postData += '&' + reasonField + '=1';
    
    var projId = document.getElementById("payment_selected_project_id");
    var projNameEl = document.getElementById("payment_selected_project_name");
    
    if (projId && projId.value) {
        postData += "&wwjm_projects_collection_list_id=" + encodeURIComponent(projId.value);
        if (projNameEl && projNameEl.value) {
            postData += "&wwjm_projects_collection_list_name=" + encodeURIComponent(projNameEl.value);
        }
    }

    var tickJsonEl = document.getElementById("payment_selected_tickets_json");
    if (tickJsonEl && tickJsonEl.value) {
        postData += "&payment_selected_tickets_json=" + encodeURIComponent(tickJsonEl.value);
    }

    // Mathematically evaluate Member presence natively
    var isMemberFlag = (isGuest || non_member_state === "1") ? 0 : 1;
    postData += "&is_member=" + isMemberFlag;

    // Flag authorizing the system to skip the pending deposit queue and clear directly for Admins inline.
    postData += "&is_admin_direct_approval=1";

    var submitBtn = document.querySelector("#Main_dashboard_02_G .payment-deposit-btn-submit");
    var originalLabel = submitBtn ? submitBtn.textContent : "Submit";
    if (submitBtn) {
        submitBtn.textContent = "Submitting...";
        submitBtn.disabled = true;
    }

    $.ajax({
        url: "<?php echo $pth; ?>View-List/Payment/Create_member_bank_deposit.php",
        type: "POST",
        data: postData,
        success: function(res) {
            if (submitBtn) {
                submitBtn.textContent = originalLabel;
                submitBtn.disabled = false;
            }
            try {
                var json = JSON.parse(res);
                if (json[0] && json[0].error === "0") {
                    alert("Bank deposit payment submitted successfully!");
                    if (amountEl) amountEl.value = "";
                    if (descEl) descEl.value = "";
                    removeMainDepositImage();
                    if (typeof main_dashboard_02_A_OPEN === "function") {
                        main_dashboard_02_A_OPEN();
                    } else if (typeof DashBord_Payment_body_01_B_01_OPEN === "function") {
                        DashBord_Payment_body_01_B_01_OPEN();
                    }
                } else {
                    alert("Failed to submit bank deposit: " + (json[0] ? json[0].error : "Unknown error"));
                }
            } catch (e) {
                console.error("Response parsing error:", e, res);
                alert("Bank deposit payment processed.");
                if (typeof main_dashboard_02_A_OPEN === "function") {
                    main_dashboard_02_A_OPEN();
                }
            }
        },
        error: function(xhr, status, error) {
            if (submitBtn) {
                submitBtn.textContent = originalLabel;
                submitBtn.disabled = false;
            }
            alert("AJAX error submitting deposit: " + error);
        }
    });
}

function DashBord_Payment_body_01_B_05_01_from_01_SUMBIT(event) {
    if (event) event.preventDefault();
    submitBankDeposit();
}
</script>
