<script type="text/javascript">
function previewDepositImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var previewImg = document.getElementById("deposit-image-preview-img");
            var placeholder = document.getElementById("deposit-placeholder-inner");
            var removeBtn = document.getElementById("deposit-remove-preview-btn");
            var hiddenPath = document.getElementById("deposit-image-path-hidden");
            var depositSlipTxt = document.getElementById("deposit_slip_image_pth_txt");

            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.style.display = "block";
            }
            if (placeholder) placeholder.style.display = "none";
            if (removeBtn) removeBtn.style.display = "flex";
            if (hiddenPath) hiddenPath.value = e.target.result;
            if (depositSlipTxt) depositSlipTxt.value = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function removeDepositImage(event) {
    if (event) event.stopPropagation();
    var previewImg = document.getElementById("deposit-image-preview-img");
    var placeholder = document.getElementById("deposit-placeholder-inner");
    var removeBtn = document.getElementById("deposit-remove-preview-btn");
    var hiddenPath = document.getElementById("deposit-image-path-hidden");
    var depositSlipTxt = document.getElementById("deposit_slip_image_pth_txt");
    var fileInput = document.getElementById("deposit-file-upload");
    var scanInput = document.getElementById("deposit-scan-upload");

    if (previewImg) {
        previewImg.src = "";
        previewImg.style.display = "none";
    }
    if (placeholder) placeholder.style.display = "flex";
    if (removeBtn) removeBtn.style.display = "none";
    if (hiddenPath) hiddenPath.value = "";
    if (depositSlipTxt) depositSlipTxt.value = "";
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

    var urlParams = new URLSearchParams(window.location.search);
    var member_list_id = urlParams.get('id');

    if (!member_list_id) {
        var profileIdInput = document.getElementById('Member_body_01_01_A_01_Memeber_Profile_id');
        if (profileIdInput && profileIdInput.value) {
            member_list_id = profileIdInput.value;
        }
    }

    var imagePathEl = document.getElementById("deposit-image-path-hidden");
    var bankNameEl = document.getElementById("DashBord_Payment_body_01_B_05_bank_name");
    var branchEl = document.getElementById("DashBord_Payment_body_01_B_05_branch_name");
    var acNoEl = document.getElementById("DashBord_Payment_body_01_B_05_ac_no");
    var bankAccIdEl = document.getElementById("DashBord_Payment_body_01_B_05_bank_account_details_id");
    var payingTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");

    var image_pth = imagePathEl ? imagePathEl.value : "";
    var bank_name = bankNameEl ? bankNameEl.value : "";
    var branch = branchEl ? branchEl.value : "";
    var ac_no = acNoEl ? acNoEl.value : "";
    var bank_account_details_id = bankAccIdEl ? bankAccIdEl.value : "";
    
    if (!bank_account_details_id) {
        alert("Please select a deposit bank account first.");
        if (typeof Admin_user_dashboard_02_F_OPEN === "function") {
            Admin_user_dashboard_02_F_OPEN();
        }
        return;
    }

    if (!member_list_id) {
        alert("Please select a member first.");
        if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
            Admin_user_dashboard_02_A_OPEN();
        }
        return;
    }

    // Helper to perform the actual submission once we have member data (or default it)
    function executeDepositPost(personNm, addr, memEmail, memMobile) {
        var postData = "val_01=" + encodeURIComponent(amountVal) +
            "&val_02=" + encodeURIComponent(descVal) +
            "&val_03=" + encodeURIComponent(personNm) +
            "&val_04=" + encodeURIComponent(addr) +
            "&val_05=" + encodeURIComponent("") + // membership no omitted if fetched below
            "&val_06=" + encodeURIComponent(image_pth) +
            "&val_07=" + encodeURIComponent(bank_name) +
            "&val_08=" + encodeURIComponent(branch) +
            "&val_09=" + encodeURIComponent(ac_no) +
            "&val_10=" + encodeURIComponent(bank_account_details_id) +
            "&val_11=" + encodeURIComponent(member_list_id) +
            "&member_email=" + encodeURIComponent(memEmail) +
            "&member_mobile_no=" + encodeURIComponent(memMobile) +
            "&wwjm_payment_sliip_id_bank_deposite=0";

        var pType = payingTypeEl ? payingTypeEl.value : "";
        if (pType === "subcription" || pType === "subscription") {
            postData += "&pay_resion_subcption=0";
        } else if (pType === "Donation" || pType === "donation") {
            postData += "&pay_resion_donation=0";
        } else if (pType === "Zakath" || pType === "zakath") {
            postData += "&pay_resion_zakath=0";
        }

        $.ajax({
            url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Payment/Create_member_bank_deposit.php",
            type: "POST",
            data: postData,
            success: function(res) {
                try {
                    var json = JSON.parse(res);
                    if (json[0] && json[0].error === "0") {
                        alert("Bank deposit payment submitted successfully!");
                        if (amountEl) amountEl.value = "";
                        if (descEl) descEl.value = "";
                        removeDepositImage();
                        if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                            Admin_user_dashboard_02_A_OPEN();
                        }
                    } else {
                        alert("Failed to submit bank deposit: " + (json[0] ? json[0].error : "Unknown error"));
                    }
                } catch (e) {
                    console.error("Response parsing error:", e, res);
                    alert("Bank deposit payment processed.");
                    if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                        Admin_user_dashboard_02_A_OPEN();
                    }
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error submitting deposit: " + error);
            }
        });
    }

    // Fetch member data to fulfill API requirements
    $.ajax({
        url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/view_single_member.php",
        type: "POST",
        data: "id=" + encodeURIComponent(member_list_id),
        success: function(response) {
            try {
                var memData = JSON.parse(response);
                if (memData.length > 0) {
                    executeDepositPost(
                        memData[0].name_M || "",
                        memData[0].address_residence || "",
                        memData[0].email || "",
                        memData[0].phone_mobile || ""
                    );
                } else {
                    executeDepositPost("", "", "", ""); // fallback
                }
            } catch(e) {
                executeDepositPost("", "", "", ""); // fallback
            }
        },
        error: function() {
            executeDepositPost("", "", "", ""); // fallback
        }
    });
}

function DashBord_Payment_body_01_B_05_01_from_01_SUMBIT(event) {
    if (event) event.preventDefault();
    submitBankDeposit();
}
</script>