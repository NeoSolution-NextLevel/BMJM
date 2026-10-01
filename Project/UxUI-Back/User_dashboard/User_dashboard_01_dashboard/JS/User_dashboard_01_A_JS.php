<script>
    function formatMoneyLK(num) {
        var n = parseFloat(num || 0);
        return n.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function formatUserDashboardDate(dateValue) {
        if (!dateValue) return '--';
        var parts = String(dateValue).split('-');
        if (parts.length !== 3) return dateValue;
        var date = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, parseInt(parts[2], 10));
        return date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function userDashboardPaymentSortValue(payment) {
        var rawDate = payment.payment_date || payment.sdt || '';
        var parsedDate = Date.parse(rawDate.replace(' ', 'T'));
        return isNaN(parsedDate) ? 0 : parsedDate;
    }

    function sortUserDashboardPaymentsLatestFirst(payments) {
        return payments.slice().sort(function(a, b) {
            var dateDiff = userDashboardPaymentSortValue(b) - userDashboardPaymentSortValue(a);
            if (dateDiff !== 0) return dateDiff;
            return parseInt(b.id || 0, 10) - parseInt(a.id || 0, 10);
        });
    }

    function User_Dashboard_01_A_Fetch_Profile() {
        var loginIdEl = document.getElementById("main_user_login_id");
        var login_id = loginIdEl ? loginIdEl.value : null;

        if (!login_id) {
            console.warn("No login ID initialized for User Session.");
            return;
        }

        var sending_value = "main_user_login_id=" + encodeURIComponent(login_id);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/view_single_member.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (Array.isArray(json_data) && json_data.length > 0) {
                        User_Dashboard_01_A_Render_UI(json_data[0]);
                    } else {
                        console.warn("User account not linked to a member profile securely.");
                    }
                } catch(e) {
                    console.error("Error parsing user profile details:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to load user profile:", error);
            }
        });
    }

    function User_Dashboard_01_A_Render_UI(json) {
        if (!json) return;

        var phoneVal = json.phone_mobile || json.notification_moible_no || json.notification_whatup || 'Unknown';
        var memNoVal = json.membership_no || (json.id ? String(json.id).padStart(5, '0') : '—');
        
        // Populate Hidden Member IDs for Payment Queries below
        var memProfileEl = document.getElementById('Member_Profile_id');
        var memNoEl = document.getElementById('Member_Profile_membership_no');
        if (memProfileEl && json.id) memProfileEl.value = json.id;
        if (memNoEl) memNoEl.value = memNoVal;

        // 0. Populate User Profile Hero Banner cleanly!
        if(document.getElementById('ud-user-name')) {
            document.getElementById('ud-user-name').innerText = json.name_M || 'Unregistered Member';
            document.getElementById('ud-user-id').innerText = 'ID: ' + memNoVal;
            document.getElementById('ud-user-mobile').innerText = phoneVal;
        }

        // 1. Populate due amount
        var dueVal = parseFloat(json.due_to_pay || 0);
        var dueEl = document.getElementById('dashboard2-due-amount');
        if (dueEl) {
            dueEl.innerHTML = '<span>LKR</span> ' + (dueVal < 0 ? '-' : '') + formatMoneyLK(Math.abs(dueVal));
            dueEl.classList.toggle('dashboard2-amount-negative', dueVal > 0); 
        }

        // 2. Populate monthly subscription amount
        var subVal = parseFloat(json.monlty_payment || 0);
        var subEl = document.getElementById('dashboard2-subscription-amount');
        if (subEl) {
            subEl.innerHTML = '<span>LKR</span> ' + formatMoneyLK(subVal);
        }

        var nextDateEl = document.getElementById('ud-next-date');
        if (nextDateEl) {
            nextDateEl.innerText = subVal > 0 ? formatUserDashboardDate(json.next_subscription_date) : 'Not scheduled';
        }

        // 3. Trigger payment list loading immediately utilizing the newly set #Member_Profile_id !
        User_Dashboard_01_A_Fetch_Payments();
    }

    function User_Dashboard_01_A_Fetch_Payments() {
        var memberIdEl = document.getElementById("Member_Profile_id");
        var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : "";
        var membershipNoEl = document.getElementById("Member_Profile_membership_no");
        var membership_no = membershipNoEl ? membershipNoEl.value : "";

        var tbody = document.getElementById("dashboard2-tbody");
        var empty = document.getElementById("dashboard2-empty");

        if (!member_id) {
            if (tbody) tbody.innerHTML = "";
            if (empty) empty.style.display = "block";
            return;
        }

        var sending_value = "filter_by_bmjm_member_list_id=" + encodeURIComponent(member_id) +
                           "&member_id=" + encodeURIComponent(member_id) +
                           "&membership_no=" + encodeURIComponent(membership_no);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Payment/payment_list.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (!Array.isArray(json_data) || json_data.length === 0) {
                        if (tbody) tbody.innerHTML = "";
                        if (empty) empty.style.display = "block";
                    } else {
                        if (empty) empty.style.display = "none";
                        json_data = sortUserDashboardPaymentsLatestFirst(json_data);
                        if (tbody) {
                            tbody.innerHTML = json_data.map(function(p) {
                                var payType = "Subscription";
                                if (p.pay_resion_subcption == "1") { payType = "Subscription"; }
                                else if (p.pay_resion_donation == "1") { payType = "Donation"; }
                                else if (p.pay_resion_zakath == "1") { payType = "Zakath"; }
                                else if (p.pay_resion_projects == "1") { payType = "Projects"; }

                                var amountVal = parseFloat(p.val_01 || p.amount || 0);
                                var refCode = p.slip_no ? p.slip_no : ('TRX-' + p.id);
                                var noteText = p.dis ? p.dis : '';

                                var isRejected = (p.is_bank_deposit == "1" && p.bank_approve_cancel == "1");

                                var actionBtnHtml = '';
                                if (isRejected) {
                                    var rReason = p.bank_cancel_reason ? p.bank_cancel_reason : 'Rejected by Finance Admin';
                                    actionBtnHtml = '<span class="status-badge status-rejected" title="' + rReason.replace(/"/g, '&quot;') + '">Rejected</span>';
                                } else {
                                    actionBtnHtml = '<button type="button" class="ud-btn-view-receipt" onclick="openReceiptModal(' + p.id + ')">' +
                                                    '  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>' +
                                                    '  <span>Receipt</span>' +
                                                    '</button>';
                                }

                                return '<tr>' +
                                       '  <td class="dashboard2-date" data-label="Date">' + (p.payment_date || p.sdt || '') + '</td>' +
                                       '  <td data-label="Type"><span class="cat-text">' + payType + '</span></td>' +
                                       '  <td class="dashboard2-ref" data-label="Reference">' +
                                       '    <div class="ud-ref-block">' +
                                       '      <div class="ref-code">' + refCode + '</div>' +
                                            (noteText ? '<div class="ref-sub" title="' + noteText.replace(/"/g, '&quot;') + '">' + noteText + '</div>' : '') +
                                       '    </div>' +
                                       '  </td>' +
                                       '  <td class="dashboard2-amount" data-label="Amount">' + formatMoneyLK(amountVal) + '</td>' +
                                       '  <td class="dashboard2-action-cell" data-label="Action">' + actionBtnHtml + '</td>' +
                                       '</tr>';
                            }).join('');
                        }
                    }
                } catch(e) {
                    console.error("Error parsing payment list:", e);
                }
            }
        });
    }

    $(document).ready(function() {
        User_Dashboard_01_A_Fetch_Profile();
    });
</script>
