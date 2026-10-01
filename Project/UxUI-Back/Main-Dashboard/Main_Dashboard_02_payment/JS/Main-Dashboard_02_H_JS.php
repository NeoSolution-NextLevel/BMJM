<script>
/**
 * Payment Slip View — Dashboard JavaScript Logic
 * bmjm Admin · Main Dashboard 02 H
 */

function escapeSlipHtml(str) {
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function openPaymentSlipView(slipId) {
    window.currentMainPaymentSlipId = slipId;
    window.currentMainBankSlipId = 0;
    if (typeof main_dashboard_02_H_OPEN === 'function') {
        main_dashboard_02_H_OPEN();
    }
    resetMainPaymentSlipView();
    loadPaymentSlipDetail(slipId);
}

function handleMainBankSlipImageError() {
    var image = document.getElementById('bank-review-image');
    var link = document.getElementById('bank-review-image-link');
    var missing = document.getElementById('bank-review-image-missing');
    if (image) image.style.display = 'none';
    if (link) link.style.display = 'none';
    if (missing) missing.style.display = 'flex';
}

function renderMainPaymentSlip(p, slipId) {
    var nameElem = document.getElementById('payment-slip-name');
    var mobileElem = document.getElementById('payment-slip-mobile');
    var addressElem = document.getElementById('payment-slip-address');
    var itemsElem = document.getElementById('payment-slip-items');
    var totalElem = document.getElementById('payment-slip-total');
    var methodElem = document.getElementById('payment-slip-method');
    var reviewStatusElem = document.getElementById('payment-slip-review-status');
    var bankPanel = document.getElementById('bank-review-panel');
    var bankBadge = document.getElementById('bank-review-badge');
    var bankImage = document.getElementById('bank-review-image');
    var bankImageLink = document.getElementById('bank-review-image-link');
    var bankImageMissing = document.getElementById('bank-review-image-missing');
    var bankControls = document.getElementById('bank-review-controls');
    var bankReason = document.getElementById('bank-review-reason');
    var numberElem = document.getElementById('payment-slip-number');
    var dateElem = document.getElementById('payment-slip-date');

    var memberName = p.person_name || (p.membership_no ? 'Member #' + p.membership_no : 'Payment #' + p.id);
    if (nameElem) nameElem.textContent = memberName;
    if (mobileElem) mobileElem.textContent = p.phone_number || 'N/A';
    if (addressElem) addressElem.textContent = p.address || 'N/A';
    if (numberElem) numberElem.textContent = '#' + String(p.id || slipId).padStart(5, '0');
    if (dateElem) dateElem.textContent = p.payment_date || (p.sdt ? p.sdt.split(' ')[0] : '-');

    var isBank = parseInt(p.is_bank_deposit, 10) === 1;
    var methodLabel = isBank ? 'Bank transfer' : (parseInt(p.is_IPG, 10) === 1 ? 'Online payment' : 'Cash');
    var reviewLabel = 'Completed';
    var reviewClass = 'approved';
    if (isBank) {
        if (parseInt(p.bank_approve_cancel, 10) === 1) {
            reviewLabel = 'Rejected';
            reviewClass = 'rejected';
        } else if (parseInt(p.bank_approve_state, 10) === 1) {
            reviewLabel = 'Approved';
            reviewClass = 'approved';
        } else {
            reviewLabel = 'Pending review';
            reviewClass = 'pending';
        }
    }

    if (methodElem) methodElem.textContent = methodLabel;
    if (reviewStatusElem) reviewStatusElem.textContent = reviewLabel;
    if (bankPanel) bankPanel.style.display = isBank ? 'block' : 'none';
    if (bankBadge) {
        bankBadge.className = 'bank-review-status ' + reviewClass;
        bankBadge.textContent = reviewLabel;
    }

    window.currentMainBankSlipId = parseInt(p.bank_deposit_slip_id || 0, 10);
    if (bankControls) bankControls.style.display = isBank && reviewClass === 'pending' && window.currentMainBankSlipId ? 'flex' : 'none';
    if (bankReason) {
        bankReason.textContent = p.bank_review_reason ? 'Review note: ' + p.bank_review_reason : '';
        bankReason.style.display = p.bank_review_reason ? 'block' : 'none';
    }

    if (bankImage && bankImageLink) {
        var imagePath = String(p.bank_image_pth || '');
        var imageUrl = imagePath;
        if (imagePath && !/^(data:|https?:|\/)/i.test(imagePath)) imageUrl = '<?php echo $pth; ?>' + imagePath;
        if (bankImageMissing) bankImageMissing.style.display = imagePath ? 'none' : 'flex';
        bankImage.src = imageUrl;
        bankImage.style.display = imagePath ? 'block' : 'none';
        bankImageLink.href = imagePath ? imageUrl : '#';
        bankImageLink.style.display = imagePath ? 'block' : 'none';
    }

    var reasonLabel = 'General Payment';
    if (parseInt(p.pay_resion_subcption, 10) === 1) reasonLabel = 'Subscription';
    else if (parseInt(p.pay_resion_zakath, 10) === 1) reasonLabel = 'Zakath';
    else if (parseInt(p.pay_resion_donation, 10) === 1) reasonLabel = 'Donation';
    else if (parseInt(p.pay_resion_projects, 10) === 1) reasonLabel = 'Project';

    if (p.dis && p.dis.trim() !== '') reasonLabel += ' (' + p.dis.trim() + ')';

    var amountVal = parseFloat(p.amount || 0);
    var formattedAmount = amountVal.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    if (itemsElem) itemsElem.innerHTML = '<tr><td>' + escapeSlipHtml(reasonLabel) + '</td><td class="payment-slip-col-amount">' + formattedAmount + '</td></tr>';
    if (totalElem) totalElem.textContent = formattedAmount;
}

function resetMainPaymentSlipView() {
    var statusElem = document.getElementById('payment-slip-status');
    if (statusElem) statusElem.textContent = '';
}

function renderEmptyMainPaymentSlip() {
    var nameElem = document.getElementById('payment-slip-name');
    var mobileElem = document.getElementById('payment-slip-mobile');
    var addressElem = document.getElementById('payment-slip-address');
    var itemsElem = document.getElementById('payment-slip-items');
    var totalElem = document.getElementById('payment-slip-total');

    if (nameElem) nameElem.textContent = 'N/A';
    if (mobileElem) mobileElem.textContent = 'N/A';
    if (addressElem) addressElem.textContent = 'N/A';
    if (itemsElem) itemsElem.innerHTML = '<tr><td colspan="2">No payment slip details found.</td></tr>';
    if (totalElem) totalElem.textContent = '0.00';
}

function loadPaymentSlipDetail(slipId) {
    if (!slipId) return;

    $.ajax({
        url: "<?php echo $pth; ?>View-List/Payment/single_payment_slip.php",
        type: 'POST',
        data: { id: slipId },
        cache: false,
        dataType: 'json',
        success: function(data) {
            if (Array.isArray(data) && data.length > 0) {
                renderMainPaymentSlip(data[0], slipId);
            } else {
                renderEmptyMainPaymentSlip();
            }
        },
        error: function(err) {
            console.error("Error fetching single payment slip:", err);
        }
    });
}

function reviewMainBankPayment(action) {
    var bankSlipId = parseInt(window.currentMainBankSlipId || 0, 10);
    var paymentSlipId = parseInt(window.currentMainPaymentSlipId || 0, 10);
    var reasonElem = document.getElementById('bank-review-reject-reason');
    var statusElem = document.getElementById('payment-slip-status');
    var reason = reasonElem ? reasonElem.value.trim() : '';
    if (!bankSlipId || !paymentSlipId) return;
    if (action === 'reject' && !reason) { if (statusElem) statusElem.textContent = 'Enter a reason before rejecting.'; if (reasonElem) reasonElem.focus(); return; }
    if (!window.confirm(action === 'approve' ? 'Approve this bank transfer payment?' : 'Reject this bank transfer payment?')) return;
    $.ajax({
        url: "<?php echo $pth; ?>UxUi/Verification-Process/bank_deposit_varification_manager.php?raw_id=" + encodeURIComponent(paymentSlipId), type: 'POST', dataType: 'json',
        data: { ajax: '1', action_type: action === 'reject' ? 'cancel' : 'approve', cancel_reason: reason },
        success: function(response) {
            if (response && response.status === 'success') {
                loadPaymentSlipDetail(window.currentMainPaymentSlipId);
                if (statusElem) statusElem.textContent = response.message;
                if (typeof paymentRender === 'function') paymentRender(currentPaymentPage || 1);
            } else if (statusElem) statusElem.textContent = (response && response.message) || 'Unable to review payment.';
        },
        error: function() { if (statusElem) statusElem.textContent = 'Unable to review payment.'; }
    });
}
</script>
