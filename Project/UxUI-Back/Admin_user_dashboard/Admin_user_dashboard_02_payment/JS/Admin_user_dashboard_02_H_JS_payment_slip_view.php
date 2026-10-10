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
    window.currentAdminPaymentSlipId = slipId;
    window.currentAdminBankSlipId = 0;
    if (typeof Admin_user_dashboard_02_H_OPEN === 'function') {
        Admin_user_dashboard_02_H_OPEN(slipId);
    } else {
        loadPaymentSlipDetail(slipId);
    }
}

function showAdminPaymentSlipEmptyState(title, desc) {
    var emptyBox = document.getElementById('payment-slip-empty-state-h');
    var receiptBox = document.querySelector('#Admin_user_dashboard_02_H .payment-slip-receipt');
    var actionsBox = document.querySelector('#Admin_user_dashboard_02_H .payment-slip-actions');
    var titleEl = document.getElementById('payment-slip-empty-title-h');
    var descEl = document.getElementById('payment-slip-empty-desc-h');

    if (title && titleEl) titleEl.textContent = title;
    if (desc && descEl) descEl.textContent = desc;

    if (emptyBox) emptyBox.style.display = 'block';
    if (receiptBox) receiptBox.style.display = 'none';
    if (actionsBox) actionsBox.style.display = 'none';
}

function showAdminPaymentSlipReceipt() {
    var emptyBox = document.getElementById('payment-slip-empty-state-h');
    var receiptBox = document.querySelector('#Admin_user_dashboard_02_H .payment-slip-receipt');
    var actionsBox = document.querySelector('#Admin_user_dashboard_02_H .payment-slip-actions');

    if (emptyBox) emptyBox.style.display = 'none';
    if (receiptBox) receiptBox.style.display = 'block';
    if (actionsBox) actionsBox.style.display = 'flex';
}

function handleBankSlipImageError() {
    var image = document.getElementById('bank-review-image-h');
    var link = document.getElementById('bank-review-image-link-h');
    var missing = document.getElementById('bank-review-image-missing-h');
    if (image) image.style.display = 'none';
    if (link) link.style.display = 'none';
    if (missing) missing.style.display = 'flex';
}

function resetAdminPaymentSlipView() {
    var nameElem = document.getElementById('payment-slip-name-h');
    var mobileElem = document.getElementById('payment-slip-mobile-h');
    var addressElem = document.getElementById('payment-slip-address-h');
    var itemsElem = document.getElementById('payment-slip-items-h');
    var totalElem = document.getElementById('payment-slip-total-h');
    var statusElem = document.getElementById('payment-slip-status-h');
    var methodElem = document.getElementById('payment-slip-method-h');
    var reviewStatusElem = document.getElementById('payment-slip-review-status-h');
    var numberElem = document.getElementById('payment-slip-number-h');
    var dateElem = document.getElementById('payment-slip-date-h');
    var rejectReason = document.getElementById('bank-review-reject-reason-h');

    if (statusElem) statusElem.textContent = '';
    if (rejectReason) rejectReason.value = '';
    if (nameElem) nameElem.textContent = '-';
    if (mobileElem) mobileElem.textContent = '-';
    if (addressElem) addressElem.textContent = '-';
    if (numberElem) numberElem.textContent = '-';
    if (dateElem) dateElem.textContent = '-';
    if (methodElem) methodElem.textContent = '-';
    if (reviewStatusElem) reviewStatusElem.textContent = '-';
    if (itemsElem) itemsElem.innerHTML = '<tr><td colspan="2" style="text-align:center;color:var(--payment-slip-ink-400);padding:14px;">Loading receipt details...</td></tr>';
    if (totalElem) totalElem.textContent = '-';
}

function loadPaymentSlipDetail(slipId) {
    if (!slipId) {
        showAdminPaymentSlipEmptyState(
            'No Receipt Selected',
            'No payment receipt ID was provided. Please choose a payment from the list to view its receipt.'
        );
        return;
    }

    resetAdminPaymentSlipView();

    var nameElem = document.getElementById('payment-slip-name-h');
    var mobileElem = document.getElementById('payment-slip-mobile-h');
    var addressElem = document.getElementById('payment-slip-address-h');
    var itemsElem = document.getElementById('payment-slip-items-h');
    var totalElem = document.getElementById('payment-slip-total-h');
    var methodElem = document.getElementById('payment-slip-method-h');
    var reviewStatusElem = document.getElementById('payment-slip-review-status-h');
    var bankPanel = document.getElementById('bank-review-panel-h');
    var bankBadge = document.getElementById('bank-review-badge-h');
    var bankImage = document.getElementById('bank-review-image-h');
    var bankImageLink = document.getElementById('bank-review-image-link-h');
    var bankControls = document.getElementById('bank-review-controls-h');
    var bankReason = document.getElementById('bank-review-reason-h');
    var bankImageMissing = document.getElementById('bank-review-image-missing-h');
    var numberElem = document.getElementById('payment-slip-number-h');
    var dateElem = document.getElementById('payment-slip-date-h');

    $.ajax({
        url: "<?php echo $pth; ?>View-List/Payment/single_payment_slip.php",
        type: 'POST',
        data: { id: slipId },
        cache: false,
        dataType: 'json',
        success: function(data) {
            if (Array.isArray(data) && data.length > 0) {
                showAdminPaymentSlipReceipt();
                var p = data[0];

                var memberName = p.person_name || (p.membership_no ? 'Member #' + p.membership_no : 'Payment #' + (p.id || slipId));
                if (nameElem) nameElem.textContent = memberName;
                if (mobileElem) mobileElem.textContent = p.phone_number || '-';
                if (addressElem) addressElem.textContent = p.address || '-';
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
                window.currentAdminBankSlipId = parseInt(p.bank_deposit_slip_id || 0, 10);
                if (bankControls) bankControls.style.display = isBank && reviewClass === 'pending' && window.currentAdminBankSlipId ? 'flex' : 'none';
                if (bankReason) {
                    bankReason.textContent = p.bank_review_reason ? 'Review note: ' + p.bank_review_reason : '';
                    bankReason.style.display = p.bank_review_reason ? 'block' : 'none';
                }
                if (bankImage && bankImageLink) {
                    var imagePath = String(p.bank_image_pth || '');
                    var imageUrl = imagePath;
                    if (imagePath && !/^(data:|https?:|\/)/i.test(imagePath)) imageUrl = '<?php echo $pth; ?>' + imagePath;
                    if (bankImageMissing) bankImageMissing.style.display = imagePath ? 'none' : 'flex';
                    bankImage.onerror = handleBankSlipImageError;
                    bankImage.src = imageUrl;
                    bankImage.style.display = imagePath ? 'block' : 'none';
                    bankImageLink.href = imagePath ? imageUrl : '#';
                    bankImageLink.style.display = imagePath ? 'block' : 'none';
                }

                // Reason Label
                var reasonLabel = 'General Payment';
                if (parseInt(p.pay_resion_subcption, 10) === 1) reasonLabel = 'Subscription';
                else if (parseInt(p.pay_resion_zakath, 10) === 1) reasonLabel = 'Zakath';
                else if (parseInt(p.pay_resion_donation, 10) === 1) reasonLabel = 'Donation';
                else if (parseInt(p.pay_resion_projects, 10) === 1) reasonLabel = 'Project';

                if (p.dis && p.dis.trim() !== '') {
                    reasonLabel += ' (' + p.dis.trim() + ')';
                }

                var amountVal = parseFloat(p.amount || 0);
                var formattedAmount = amountVal.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                if (itemsElem) {
                    itemsElem.innerHTML = '<tr><td>' + escapeSlipHtml(reasonLabel) + '</td><td class="payment-slip-col-amount">' + formattedAmount + '</td></tr>';
                }

                if (totalElem) {
                    totalElem.textContent = formattedAmount;
                }
            } else {
                showAdminPaymentSlipEmptyState(
                    'Receipt Not Found',
                    'Payment receipt #' + slipId + ' could not be found or has been removed.'
                );
            }
        },
        error: function(err) {
            console.error("Error fetching single payment slip:", err);
            showAdminPaymentSlipEmptyState(
                'Unable to Load Receipt',
                'Unable to retrieve payment receipt #' + slipId + '. Please check your connection or return to the payment list.'
            );
        }
    });
}

function reviewBankPayment(action) {
    var bankSlipId = parseInt(window.currentAdminBankSlipId || 0, 10);
    var paymentSlipId = parseInt(window.currentAdminPaymentSlipId || 0, 10);
    var statusElem = document.getElementById('payment-slip-status-h');
    var reasonElem = document.getElementById('bank-review-reject-reason-h');
    var reason = reasonElem ? reasonElem.value.trim() : '';
    if (!bankSlipId || !paymentSlipId) return;
    if (action === 'reject' && !reason) {
        if (statusElem) statusElem.textContent = 'Enter a reason before rejecting this payment.';
        if (reasonElem) reasonElem.focus();
        return;
    }
    var confirmation = action === 'approve'
        ? 'Approve this bank transfer payment?'
        : 'Reject this bank transfer payment?';
    if (!window.confirm(confirmation)) return;

    var controls = document.querySelectorAll('#bank-review-controls-h button');
    controls.forEach(function(button) { button.disabled = true; });
    if (statusElem) statusElem.textContent = action === 'approve' ? 'Approving bank transfer...' : 'Rejecting bank transfer...';

    $.ajax({
        url: "<?php echo $pth; ?>UxUi/Verification-Process/bank_deposit_varification_manager.php?raw_id=" + encodeURIComponent(paymentSlipId),
        type: 'POST',
        dataType: 'json',
        data: { ajax: '1', action_type: action === 'reject' ? 'cancel' : 'approve', cancel_reason: reason },
        success: function(response) {
            controls.forEach(function(button) { button.disabled = false; });
            if (response && response.status === 'success') {
                loadPaymentSlipDetail(window.currentAdminPaymentSlipId);
                if (statusElem) statusElem.textContent = response.message;
                if (typeof paymentRender === 'function') paymentRender(currentPaymentPage || 1);
            } else if (statusElem) {
                statusElem.textContent = (response && response.message) || 'Unable to review this payment.';
            }
        },
        error: function() {
            controls.forEach(function(button) { button.disabled = false; });
            if (statusElem) statusElem.textContent = 'Unable to review this payment.';
        }
    });
}
</script>
