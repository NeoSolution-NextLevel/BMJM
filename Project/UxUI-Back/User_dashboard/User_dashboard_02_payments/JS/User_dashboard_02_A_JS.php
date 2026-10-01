<script>
    function formatMoneyLK(num) {
        var n = parseFloat(num || 0);
        return n.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
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

    function User_Dashboard_02_A_Fetch_Profile_And_Payments() {
        var loginIdEl = document.getElementById("main_user_login_id");
        if (!loginIdEl) {
            loginIdEl = document.getElementById("dashboard2_main_user_login_id");
        }
        var login_id = loginIdEl ? loginIdEl.value : null;

        if (!login_id) {
            console.warn("No login ID initialized for User Session.");
            $('#dashboard2-master-empty').show();
            return;
        }

        var sending_value = "main_user_login_id=" + encodeURIComponent(login_id);

        $.ajax({
            url: "../View-List/Member/view_single_member.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (Array.isArray(json_data) && json_data.length > 0) {
                        var real_member_id = json_data[0].id;
                        var membership_no = json_data[0].membership_no;
                        window.dashboard2_real_member_id = real_member_id;
                        window.dashboard2_membership_no = membership_no;
                        User_Dashboard_02_A_Fetch_Payments(real_member_id, membership_no);
                    } else {
                        console.warn("User account not linked to a member profile securely.");
                        $('#dashboard2-master-empty').show();
                    }
                } catch(e) {
                    console.error("Error parsing user profile details:", e);
                    $('#dashboard2-master-empty').show();
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to load user profile:", error);
                $('#dashboard2-master-empty').show();
            }
        });
    }

    function User_Dashboard_02_A_Fetch_Payments(member_id, membership_no) {
        var start_date = $('#tx-start-date').val() || "";
        var end_date = $('#tx-end-date').val() || "";
        var search_txt = $('#tx-search').val() || "";

        if (!member_id) {
            var profileEl = $('#Member_Profile_id');
            if (profileEl.length > 0 && profileEl.data('real_member_id')) {
                member_id = profileEl.data('real_member_id');
                membership_no = profileEl.data('membership_no');
            } else {
                member_id = window.dashboard2_real_member_id || "";
                membership_no = window.dashboard2_membership_no || "";
            }
        }
        if (!member_id) {
            return; 
        }

        var tbody = document.getElementById("dashboard2-master-tbody");
        var empty = document.getElementById("dashboard2-master-empty");

        bodyHtml = '<tr><td colspan="6" style="text-align:center; padding: 40px; color: var(--bmjm-slate-400);">Loading payment ledger records...</td></tr>';
        if (tbody) tbody.innerHTML = bodyHtml;

        var sending_value = "filter_by_bmjm_member_list_id=" + encodeURIComponent(member_id) +
                           "&member_id=" + encodeURIComponent(member_id) +
                           "&membership_no=" + encodeURIComponent(membership_no) +
                           "&start_date=" + encodeURIComponent(start_date) +
                           "&end_date=" + encodeURIComponent(end_date) +
                           "&search_txt=" + encodeURIComponent(search_txt);

        $.ajax({
            url: "../View-List/Payment/payment_list.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    if (!Array.isArray(json_data) || json_data.length === 0) {
                        if (tbody) tbody.innerHTML = "";
                        if (empty) empty.style.display = "block";
                        $('#stat-total-amount').text("LKR 0.00");
                        $('#stat-total-count').text("0");
                        $('#stat-pending-count').text("0 Pending");
                    } else {
                        if (empty) empty.style.display = "none";
                        json_data = sortUserDashboardPaymentsLatestFirst(json_data);
                        
                        var filtered_data = json_data;
                        if (search_txt.trim().length > 0) {
                            var q = search_txt.toLowerCase();
                            filtered_data = json_data.filter(function(p) {
                                var ref = (p.dis || p.slip_no || ('TRX-' + p.id)).toLowerCase();
                                var type = "Payment";
                                if (p.pay_resion_subcption == "1") type = "Subscription";
                                else if (p.pay_resion_donation == "1") type = "Donation";
                                else if (p.pay_resion_zakath == "1") type = "Zakath";
                                else if (p.pay_resion_projects == "1") type = "Projects";
                                type = type.toLowerCase();
                                return ref.includes(q) || type.includes(q);
                            });
                        }

                        // Compute Stats Metrics
                        var totalSum = 0;
                        var pendingCount = 0;
                        json_data.forEach(function(p) {
                            if (p.is_bank_deposit == "1" && p.bank_approve_state != "1" && p.bank_approve_cancel != "1") {
                                pendingCount++;
                            }
                            if (p.is_bank_deposit != "1" || p.bank_approve_state == "1") {
                                totalSum += parseFloat(p.val_01 || p.amount || 0);
                            }
                        });

                        $('#stat-total-amount').text("LKR " + formatMoneyLK(totalSum));
                        $('#stat-total-count').text(json_data.length);
                        $('#stat-pending-count').text(pendingCount + " Pending");

                        if (filtered_data.length === 0) {
                            if (tbody) tbody.innerHTML = "";
                            if (empty) empty.style.display = "block";
                        } else {
                            if (tbody) {
                                tbody.innerHTML = filtered_data.map(function(p, idx) {
                                    var payType = "Payment";
                                    var catClass = "cat-subscription";
                                    if (p.pay_resion_subcption == "1") { payType = "Subscription"; catClass = "cat-subscription"; }
                                    else if (p.pay_resion_donation == "1") { payType = "Donation"; catClass = "cat-donation"; }
                                    else if (p.pay_resion_zakath == "1") { payType = "Zakath"; catClass = "cat-zakath"; }
                                    else if (p.pay_resion_projects == "1") { payType = "Projects"; catClass = "cat-projects"; }
                                    
                                    var gateway = "Direct";
                                    if(p.is_bank_deposit == "1") { gateway = "Bank Slip"; }
                                    else if(p.is_cash == "1") { gateway = "Cash"; }
                                    else if(p.is_IPG == "1") { gateway = "Online IPG"; }

                                    var rawDate = p.payment_date || p.sdt || '';
                                    var dateParts = rawDate.split(' ');
                                    var dateVal = dateParts[0] || 'N/A';
                                    var timeVal = dateParts[1] || '';

                                    var amountVal = parseFloat(p.val_01 || p.amount || 0);
                                    var refCode = p.slip_no ? p.slip_no : ('TRX-' + p.id);
                                    var noteText = p.dis ? p.dis : 'Member Payment Log';
                                    var delay = (idx * 0.03).toFixed(2);

                                    var statusHtml = '';
                                    if (p.is_bank_deposit == "1") {
                                        if (p.bank_approve_state == "1") {
                                            statusHtml = '<span class="status-badge status-approved">Approved</span>';
                                        } else if (p.bank_approve_cancel == "1") {
                                            var reasonText = p.bank_cancel_reason ? p.bank_cancel_reason : 'Deposit slip verification rejected by Finance Admin';
                                            statusHtml = '<span class="status-badge status-rejected" title="Click to view rejection reason: ' + reasonText.replace(/"/g, '&quot;') + '" onclick="openReceiptModal(' + p.id + ')" style="cursor:pointer;">Rejected</span>';
                                        } else {
                                            statusHtml = '<span class="status-badge status-pending">Pending Review</span>';
                                        }
                                    } else {
                                        statusHtml = '<span class="status-badge status-approved">Completed</span>';
                                    }

                                    return '<tr class="ledger-row" style="animation: fadeIn 0.3s ease forwards; opacity: 0; animation-delay: ' + delay + 's;">' +
                                           '  <td data-label="Date">' +
                                           '    <div style="font-weight:700; color:var(--bmjm-slate-900);">' + dateVal + '</div>' +
                                                (timeVal ? '<div style="font-size:11.5px; color:var(--bmjm-slate-400); margin-top:2px;">' + timeVal + '</div>' : '') +
                                           '  </td>' +
                                           '  <td data-label="Category"><span class="cat-pill">' + payType + '</span></td>' +
                                           '  <td data-label="Reference">' +
                                           '    <div class="ud-ref-block">' +
                                           '      <div class="ref-code">#' + refCode + '</div>' +
                                           '      <div class="ref-sub" title="' + noteText.replace(/"/g, '&quot;') + '">' + noteText + '</div>' +
                                           '    </div>' +
                                           '  </td>' +
                                           '  <td data-label="Method"><span class="method-badge">' + gateway + '</span></td>' +
                                           '  <td data-label="Status">' + statusHtml + '</td>' +
                                           '  <td class="amount-display" data-label="Amount">LKR ' + formatMoneyLK(amountVal) + '</td>' +
                                           '  <td data-label="Action">' +
                                           '    <button type="button" onclick="openReceiptModal(' + p.id + ')" class="btn-filter" style="height:32px; padding:0 14px; font-size:12px; font-weight:700; display:inline-flex; align-items:center; border-radius:8px; cursor:pointer; color:var(--bmjm-green-950); background:var(--bmjm-slate-100); border:1px solid var(--bmjm-slate-200);">' +
                                           '      View' +
                                           '    </button>' +
                                           '  </td>' +
                                           '</tr>';
                                }).join('');
                            }
                        }
                    }
                } catch(e) {
                    console.error("Error parsing payment list:", e);
                    if (tbody) tbody.innerHTML = "";
                    if (empty) empty.style.display = "block";
                }
            },
            error: function() {
                if (tbody) tbody.innerHTML = "";
                if (empty) empty.style.display = "block";
            }
        });
    }

    function user_dashboard_pay_now() {
        if (typeof main_dashboard_02_B_OPEN === 'function') {
            main_dashboard_02_B_OPEN();
        } else if (typeof user_dashboard_02_B_OPEN === 'function') {
            user_dashboard_02_B_OPEN();
        } else {
            
            window.location.href = "<?php echo $home_page ?>UxUi/Main-Dashboard.php";
        }
    }

    $(document).ready(function() {
        User_Dashboard_02_A_Fetch_Profile_And_Payments();

        $('#btn-apply-filter').on('click', function(){
            User_Dashboard_02_A_Fetch_Payments();
        });
        
        $('#tx-search').on('input', function(){
             User_Dashboard_02_A_Fetch_Payments();
        });
        
        $('#tx-start-date, #tx-end-date').on('change', function(){
             User_Dashboard_02_A_Fetch_Payments();
        });
    });
</script>
