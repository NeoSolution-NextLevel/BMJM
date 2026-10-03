<script>
var collectionPaymentCreateContext = null;

function collectionPaymentFormatMoney(value) {
    var amount = parseFloat(value);
    if (!Number.isFinite(amount)) amount = 0;
    return amount.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function getActiveCollectionIdForPayment() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

function loadCollectionPaymentCreateContext() {
    var collectionId = getActiveCollectionIdForPayment();

    if (!collectionId) {
        $("#collection-payment-context-name").text("No collection selected");
        return;
    }

    callCollectionPaymentViewList(collectionId);
}

function callCollectionPaymentViewList(collectionId) {
    $.ajax({
        url: "../../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php",
        type: "POST",
        dataType: "json",
        data: { id: collectionId },
        success: function(response) {
            if (!response || response.error !== 0) {
                $("#collection-payment-context-name").text("Collection not found");
                return;
            }

            setCollectionPaymentCreateData(response);
        },
        error: function(xhr) {
            console.error("Collection context loading failed:", xhr);
            $("#collection-payment-context-name").text("Unable to load collection");
        }
    });
}

function setCollectionPaymentCreateData(response) {
    collectionPaymentCreateContext = response;

    var budget = parseFloat(response.fix_amount) || 0;
    var collected = parseFloat(response.collected_amount) || 0;
    var remaining = Math.max(budget - collected, 0);
    var isFixed = String(response.is_fix_budget) === "1";

    $("#collection-payment-project-name").val(response.project_name || "Collection Payment");
    $("#collection-payment-is-fixed").val(isFixed ? "1" : "0");
    $("#collection-payment-remaining").val(remaining);
    $("#collection-payment-context-name").text(response.project_name || "Collection Payment");
    $("#collection-payment-context-collected").text(collectionPaymentFormatMoney(collected));

    if (isFixed) {
        $("#collection-payment-context-remaining-label").html(
            "LKR <span id=\"collection-payment-context-remaining\">" +
            collectionPaymentFormatMoney(remaining) +
            "</span>"
        );
        $("#collection-payment-limit-help")
            .text("Maximum allowed from remaining target: LKR " + collectionPaymentFormatMoney(remaining))
            .show();
    } else {
        $("#collection-payment-context-remaining-label").text("Open target");
        $("#collection-payment-limit-help").hide();
    }
}

function submitCollectionNewPayment() {
    var isValid = true;
    var requiredFields = $("#collection-payment-new-form").find("[required]");

    requiredFields.each(function() {
        if (!$(this).val()) {
            $(this).closest(".collection-new-field").addClass("collection-new-invalid");
            isValid = false;
        } else {
            $(this).closest(".collection-new-field").removeClass("collection-new-invalid");
        }
    });

    if (!isValid) return;

    var collectionId = getActiveCollectionIdForPayment();
    if (!collectionId) {
        alert("Error: Active collection ID missing from URL.");
        return;
    }

    var amount = parseFloat($("#collection-payment-amount").val());
    if (!Number.isFinite(amount) || amount <= 0) {
        alert("Please enter a valid payment amount.");
        return;
    }

    if ($("#collection-payment-is-fixed").val() === "1") {
        var remaining = parseFloat($("#collection-payment-remaining").val()) || 0;
        if (amount > remaining) {
            alert("Payment cannot exceed the remaining collection target of LKR " + collectionPaymentFormatMoney(remaining) + ".");
            return;
        }
    }

    var method = $("input[name='collection_payment_method']:checked").val();
    var sendingValue =
        "val_01=" + encodeURIComponent(amount) +
        "&val_02=" + encodeURIComponent($("#collection-payment-note").val() || "Collection dashboard payment") +
        "&val_03=" + encodeURIComponent($("#collection-payment-donor-name").val()) +
        "&val_04=" + encodeURIComponent($("#collection-payment-address").val() || "") +
        "&val_05=" + encodeURIComponent($("#collection-payment-membership-no").val() || "") +
        "&member_email=" + encodeURIComponent($("#collection-payment-email").val() || "") +
        "&member_mobile_no=" + encodeURIComponent($("#collection-payment-phone").val() || "") +
        "&bmjm_member_list_id=0" +
        "&is_member=0" +
        "&pay_resion_projects=1" +
        "&wwjm_projects_collection_list_id=" + encodeURIComponent(collectionId) +
        "&wwjm_projects_collection_list_name=" + encodeURIComponent($("#collection-payment-project-name").val() || "Collection Payment");

    if (method === "bank") {
        sendingValue += "&wwjm_payment_sliip_id_bank_deposite=1";
    } else {
        sendingValue += "&is_cash=1";
    }

    var btn = document.getElementById("collection-payment-save-btn");
    var originalText = btn ? btn.innerHTML : "";
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = "Saving...";
    }

    $.ajax({
        url: "../../View-List/Payment/create_wwjm_payment_slip.php",
        type: "POST",
        dataType: "json",
        data: sendingValue,
        cache: false,
        success: function(response) {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }

            var res = response && response[0] ? response[0] : null;
            if (res && res.error === "0") {
                $("#collection-payment-new-form")[0].reset();
                Collection_Dashboard_02_A_OPEN();

                if (typeof loadCollectionPayments === "function") {
                    loadCollectionPayments();
                }
                if (typeof loadCollectionDashboardData === "function") {
                    loadCollectionDashboardData();
                }

                alert("Collection payment saved successfully. Receipt ID: " + res.id);
            } else {
                alert("Payment save failed: " + (res ? res.error : "Unknown error"));
            }
        },
        error: function(xhr) {
            if (btn) {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
            console.error("Collection payment save failed:", xhr);
            alert("Network error while saving payment.");
        }
    });
}
</script>
