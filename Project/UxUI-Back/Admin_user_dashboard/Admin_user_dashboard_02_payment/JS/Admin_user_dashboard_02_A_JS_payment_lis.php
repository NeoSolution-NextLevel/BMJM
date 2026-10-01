

<script>
/**
 * Payment List — Dashboard JavaScript Logic
 * bmjm Admin · Main Dashboard 02 A
 */

var currentPaymentPage = 1;

function escapePaymentHtml(str) {
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function paymentRender(page) {
    if (page) {
        currentPaymentPage = page;
    }

    var startDateObj = document.getElementById('payment-start-date');
    var endDateObj = document.getElementById('payment-end-date');
    var typeObj = document.getElementById('payment-type');
    var otherTypeObj = document.getElementById('payment-other-type');
    var statusObj = document.getElementById('payment-status');
    var perPageObj = document.getElementById('payment-perpage');

    var startDate = startDateObj ? startDateObj.value : '';
    var endDate = endDateObj ? endDateObj.value : '';
    var typeVal = typeObj ? typeObj.value : 'all';
    var otherTypeVal = otherTypeObj ? otherTypeObj.value : 'all';
    var statusVal = statusObj ? statusObj.value : 'all';
    var perPage = perPageObj ? parseInt(perPageObj.value, 10) : 50;

    // Filter by member only when the admin explicitly selected a member.
    // The dashboard URL id is an encrypted login token, not a member ID.
    var member_id = '';
    var memberIdEl = document.getElementById("Member_Profile_id");
    if (memberIdEl && memberIdEl.value) {
        member_id = memberIdEl.value;
    }

    var sending_values = "payment_type=" + encodeURIComponent(typeVal) +
                         "&other_type=" + encodeURIComponent(otherTypeVal) +
                         "&payment_status=" + encodeURIComponent(statusVal) +
                         "&start_date=" + encodeURIComponent(startDate) +
                         "&end_date=" + encodeURIComponent(endDate) +
                         "&member_id=" + encodeURIComponent(member_id || '') +
                         "&filter_by_bmjm_member_list_id=" + encodeURIComponent(member_id || '');

    // 1. Get Count
    $.ajax({
        url: "<?php echo $pth; ?>View-List/Payment/payment_list.php",
        type: 'POST',
        data: "count=1&" + sending_values,
        cache: false,
        dataType: 'json',
        success: function(data) {
            var totalCount = 0;
            if (Array.isArray(data) && data.length > 0 && (data[0].count !== undefined || data[0].total_count !== undefined)) {
                totalCount = parseInt(data[0].count || data[0].total_count, 10);
            }
            var tbody = document.getElementById('payment-tbody');
            var emptyElem = document.getElementById('payment-empty');
            var countElem = document.getElementById('payment-count');
            var paginationElem = document.getElementById('payment-pagination');

            if (totalCount === 0) {
                if (tbody) tbody.innerHTML = '';
                if (emptyElem) emptyElem.style.display = 'block';
                if (countElem) countElem.textContent = '0 payments found';
                if (paginationElem) paginationElem.innerHTML = '';
                return;
            }

            if (emptyElem) emptyElem.style.display = 'none';

            var totalPages = Math.ceil(totalCount / perPage);
            if (currentPaymentPage > totalPages) { currentPaymentPage = totalPages; }
            if (currentPaymentPage < 1) { currentPaymentPage = 1; }

            var offset = (currentPaymentPage - 1) * perPage;

            var paginated_sending_values = "st_count=" + encodeURIComponent(offset) + 
                                           "&per_page=" + encodeURIComponent(perPage) +
                                           "&" + sending_values;

            // 2. Fetch Paginated Records
            $.ajax({
                url: "<?php echo $pth; ?>View-List/Payment/payment_list.php",
                type: 'POST',
                data: paginated_sending_values,
                cache: false,
                dataType: 'json',
                success: function(rows) {
                    if (!tbody) return;

                    if (!Array.isArray(rows) || rows.length === 0) {
                        tbody.innerHTML = '';
                        if (emptyElem) emptyElem.style.display = 'block';
                        if (countElem) countElem.textContent = '0 payments found';
                        if (paginationElem) paginationElem.innerHTML = '';
                        return;
                    }

                    var html = '';
                    for (var i = 0; i < rows.length; i++) {
                        var p = rows[i];

                        // Reason Label
                        var typeLabel = 'General';
                        if (parseInt(p.pay_resion_subcption, 10) === 1) typeLabel = 'Subscription';
                        else if (parseInt(p.pay_resion_zakath, 10) === 1) typeLabel = 'Zakath';
                        else if (parseInt(p.pay_resion_donation, 10) === 1) typeLabel = 'Donation';
                        else if (parseInt(p.pay_resion_projects, 10) === 1) typeLabel = 'Project';

                        // Member name / identifier
                        var memberName = p.person_name || (p.membership_no ? 'Member #' + p.membership_no : 'Payment #' + p.id);
                        var dateStr = p.payment_date || (p.sdt ? p.sdt.split(' ')[0] : '');
                        var amountVal = parseFloat(p.amount || 0);
                        var formattedAmount = amountVal.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                        var methodLabel = parseInt(p.is_bank_deposit, 10) === 1 ? 'Bank transfer' : (parseInt(p.is_IPG, 10) === 1 ? 'Online' : 'Cash');
                        var statusLabel = 'Completed';
                        var statusClass = 'complete';
                        if (parseInt(p.is_bank_deposit, 10) === 1) {
                            if (parseInt(p.bank_approve_cancel, 10) === 1) {
                                statusLabel = 'Rejected';
                                statusClass = 'rejected';
                            } else if (parseInt(p.bank_approve_state, 10) === 1) {
                                statusLabel = 'Approved';
                                statusClass = 'approved';
                            } else {
                                statusLabel = 'Pending review';
                                statusClass = 'pending';
                            }
                        }

                        html += '<tr>' +
                            '<td class="payment-name">' + escapePaymentHtml(memberName) + '</td>' +
                            '<td><span class="payment-type-tag">' + escapePaymentHtml(typeLabel) + '</span></td>' +
                            '<td>' + escapePaymentHtml(methodLabel) + '</td>' +
                            '<td><span class="payment-status-tag payment-status-' + statusClass + '">' + escapePaymentHtml(statusLabel) + '</span></td>' +
                            '<td class="payment-date">' + escapePaymentHtml(dateStr) + '</td>' +
                            '<td class="payment-amount">' + formattedAmount + '</td>' +
                            '<td class="payment-action-cell"><button class="payment-view" onclick="openPaymentSlipView(' + p.id + ')">View</button></td>' +
                            '</tr>';
                    }
                    tbody.innerHTML = html;

                    // Update count display
                    var startItem = offset + 1;
                    var endItem = Math.min(offset + rows.length, totalCount);
                    if (countElem) {
                        countElem.textContent = 'Showing ' + startItem + ' - ' + endItem + ' of ' + totalCount + ' payments';
                    }

                    // Render Pagination Controls
                    renderPaymentPagination(currentPaymentPage, totalPages);
                },
                error: function(err) {
                    console.error("Error fetching payment rows:", err);
                }
            });
        },
        error: function(err) {
            console.error("Error fetching payment count:", err);
        }
    });
}

function renderPaymentPagination(currentPage, totalPages) {
    var paginationElem = document.getElementById('payment-pagination');
    if (!paginationElem) return;

    if (totalPages <= 1) {
        paginationElem.innerHTML = '';
        return;
    }

    var html = '';

    // Prev Button
    html += '<button class="payment-page-btn" ' + (currentPage === 1 ? 'disabled' : '') + ' onclick="paymentRender(' + (currentPage - 1) + ')">Prev</button>';

    var startPage = Math.max(1, currentPage - 2);
    var endPage = Math.min(totalPages, currentPage + 2);

    if (startPage > 1) {
        html += '<button class="payment-page-btn" onclick="paymentRender(1)">1</button>';
        if (startPage > 2) {
            html += '<span style="padding:4px 6px;color:var(--payment-ink-400);">...</span>';
        }
    }

    for (var p = startPage; p <= endPage; p++) {
        var activeClass = p === currentPage ? ' is-active' : '';
        html += '<button class="payment-page-btn' + activeClass + '" onclick="paymentRender(' + p + ')">' + p + '</button>';
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            html += '<span style="padding:4px 6px;color:var(--payment-ink-400);">...</span>';
        }
        html += '<button class="payment-page-btn" onclick="paymentRender(' + totalPages + ')">' + totalPages + '</button>';
    }

    // Next Button
    html += '<button class="payment-page-btn" ' + (currentPage === totalPages ? 'disabled' : '') + ' onclick="paymentRender(' + (currentPage + 1) + ')">Next</button>';

    paginationElem.innerHTML = html;
}

function viewPaymentDetail(slipId) {
    openPaymentSlipView(slipId);
}

function initPaymentList() {
    if (document.getElementById('Admin_user_dashboard_02_A')) {
        paymentRender(1);
    }
}

if (typeof $ !== 'undefined') {
    $(document).ready(initPaymentList);
} else {
    document.addEventListener('DOMContentLoaded', initPaymentList);
}
</script>
