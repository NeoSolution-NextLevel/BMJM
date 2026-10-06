<script>
(function () {
	var app = document.getElementById('receipt-app');
	if (!app) return;

	function setText(id, value) {
		var element = document.getElementById(id);
		if (element) element.textContent = value || 'N/A';
	}

	function showError(message) {
		var error = document.getElementById('receipt-error');
		var status = document.getElementById('receipt-status');
		if (status) status.hidden = true;
		if (error) {
			error.textContent = message;
			error.hidden = false;
		}
	}

	function setStatus(kind, title, detail) {
		var status = document.getElementById('receipt-status');
		if (!status) return;
		status.className = 'alert-banner alert-' + kind;
		status.replaceChildren();
		var heading = document.createElement('strong');
		heading.textContent = title;
		status.appendChild(heading);
		if (detail) status.appendChild(document.createTextNode(' ' + detail));
	}

	function renderReceipt(payment) {
		var member = payment.member_details || {};
		var paymentId = payment.id || app.dataset.paymentId;
		var storedReference = String(payment.dis || '').trim();
		var bankReference = String(payment.bank_slip_no || '').trim();
		var reference = storedReference && storedReference !== '0'
			? storedReference
			: (bankReference && bankReference !== '0' ? bankReference : 'REC-' + String(paymentId).padStart(5, '0'));
		var isBank = String(payment.is_bank_deposit) === '1';
		var isCancelled = isBank && String(payment.bank_approve_cancel) === '1';
		var isApproved = !isBank || String(payment.bank_approve_state) === '1';
		var amountValue = payment.bank_amount !== '' && payment.bank_amount !== null
			? payment.bank_amount
			: payment.amount;
		var amount = Number(amountValue || 0).toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
		var category = 'Payment';
		if (String(payment.pay_resion_subcption) === '1') category = 'Subscription';
		else if (String(payment.pay_resion_donation) === '1') category = 'Donation';
		else if (String(payment.pay_resion_zakath) === '1') category = 'Zakath';
		else if (String(payment.pay_resion_projects) === '1') category = 'Projects';

		setText('receipt-reference', reference);
		setText('receipt-table-reference', reference);
		setText('receipt-member-name', member.name || payment.person_name || 'Member');
		setText('receipt-membership', member.membership_no || payment.membership_no || 'N/A');
		setText('receipt-mobile', member.mobile || member.notification_mobile || payment.phone_number || 'N/A');
		setText('receipt-email', member.email || payment.email || 'N/A');
		setText('receipt-address', member.address || payment.address || 'N/A');
		setText('receipt-date', payment.bank_submitted_date || payment.payment_date || payment.sdt || 'N/A');
		setText('receipt-category', category + ' Contribution');
		setText('receipt-method', isBank ? 'Bank Deposit' : (String(payment.is_IPG) === '1' ? 'Online Payment' : 'Cash / Direct'));
		setText('receipt-line-amount', 'LKR ' + amount);
		setText('receipt-total', 'LKR ' + amount);

		var imagePath = String(payment.bank_image_pth || '').trim();
		if (isBank && imagePath) {
			var imageElement = document.getElementById('receipt-slip-image');
			var imageSection = document.getElementById('receipt-slip-image-section');
			var imageUrl = /^(data:image\/|https?:\/\/)/i.test(imagePath)
				? imagePath
				: '../../../' + imagePath.replace(/^\/+/, '');
			if (imageElement && imageSection) {
				imageElement.src = imageUrl;
				imageElement.addEventListener('error', function () { imageSection.hidden = true; }, { once: true });
				imageSection.hidden = false;
			}
		}

		var printButton = document.getElementById('receipt-print');
		if (isApproved && !isCancelled) {
			setStatus('approved', 'Payment Verified & Approved', '— Official payment receipt registered in bmjm member ledger.');
			if (printButton) {
				printButton.disabled = false;
				printButton.className = 'btn-action btn-print-active';
			}
		} else if (isCancelled) {
			setStatus('rejected', 'Transaction Verification Rejected / Cancelled', 'Rejection Reason: ' + (payment.bank_review_reason || 'Bank deposit slip verification rejected by Finance Admin'));
		} else {
			setStatus('pending', 'Bank Deposit Pending Verification', '— Your bank slip has been received and is under review by Finance Admin. Official receipt printing will unlock upon approval.');
		}
	}

	// var backButton = document.getElementById('receipt-back');
	// if (backButton) {
	// 	backButton.addEventListener('click', function () {
	// 		if (window.parent && typeof window.parent.closeReceiptModal === 'function') {
	// 			window.parent.closeReceiptModal();
	// 		} else if (window.history.length > 1) {
	// 			window.history.back();
	// 		} else {
	// 			window.location.href = '../../../UxUi/User_dashboard.php';
	// 		}
	// 	});
	// }

	var printButton = document.getElementById('receipt-print');
	if (printButton) printButton.addEventListener('click', function () { window.print(); });

	var paymentId = app.dataset.paymentId;
	if (!paymentId || paymentId === '0') {
		showError('No payment record was selected.');
		return;
	}

	fetch(app.dataset.apiUrl, {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
		body: new URLSearchParams({ id: paymentId })
	})
		.then(function (response) {
			if (!response.ok) throw new Error('Payment details could not be loaded.');
			return response.json();
		})
		.then(function (records) {
			if (!Array.isArray(records) || !records.length) {
				showError('No payment record was found for this receipt.');
				return;
			}
			renderReceipt(records[0]);
		})
		.catch(function () { showError('Unable to load this receipt. Please return to your payment history and try again.'); });
})();
</script>
