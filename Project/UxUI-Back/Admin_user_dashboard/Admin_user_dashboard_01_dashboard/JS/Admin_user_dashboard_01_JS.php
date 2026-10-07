<script>
    function getQueryParam(param) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function formatMoneyLK(num) {
        var n = parseFloat(num || 0);
        return n.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function Member_body_01_01_A_01_Memeber_Details_Display() {
        var memberIdEl = document.getElementById("Member_Profile_id");
        var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : getQueryParam("id");

        if (!member_id) {
            console.warn("No member ID provided.");
            return;
        }

        var sending_value = "id=" + encodeURIComponent(member_id);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/view_single_member.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                console.log("Member Details Response:", response);
                try {
                    var json_data = JSON.parse(response);
                    if (Array.isArray(json_data) && json_data.length > 0) {
                        OPEN_DATA_BODY_FOR_VIEW_Member_body_01_01_A_01_form(json_data[0]);
                    }
                } catch(e) {
                    console.error("Error parsing member details:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("Failed to load member details:", error);
            }
        });
    }

    function OPEN_DATA_BODY_FOR_VIEW_Member_body_01_01_A_01_form(json) {
        if (!json) return;

        var phoneVal = json.phone_mobile || json.notification_moible_no || json.notification_whatup || '—';
        var memNoVal = json.membership_no || (json.id ? String(json.id).padStart(5, '0') : '—');
        var addressVal = json.residence_address_M || json.road_name_M || '—';

        var sidebarMember = document.getElementById('bmjm-sidebar-member');
        var sidebarMemberName = document.getElementById('bmjm-sidebar-member-name');
        var sidebarMemberNumber = document.getElementById('bmjm-sidebar-member-number');
        if (sidebarMember && sidebarMemberName && sidebarMemberNumber) {
            sidebarMemberName.textContent = json.name_M || 'Member';
            sidebarMemberNumber.textContent = 'Member No: ' + memNoVal;
            sidebarMember.hidden = false;
        }

        // 1. Populate member details card
        var detailsContainer = document.getElementById('dashboard2-details');
        if (detailsContainer) {
            var rows = [
                { label: "Member Name",   value: json.name_M || '—' },
                { label: "Address",       value: addressVal },
                { label: "Contact No",    value: phoneVal },
                { label: "Email",         value: json.email || '—' },
                { label: "Membership No", value: memNoVal }
            ];
            detailsContainer.innerHTML = rows.map(function(r) {
                return '<div class="dashboard2-details-row">' +
                       '  <div class="dashboard2-details-label">' + r.label + '</div>' +
                       '  <div class="dashboard2-details-colon">:</div>' +
                       '  <div class="dashboard2-details-value">' + r.value + '</div>' +
                       '</div>';
            }).join('');
        }

        // 2. Populate due amount
        var dueVal = parseFloat(json.due_to_pay || 0);
        var dueEl = document.getElementById('dashboard2-due-amount');
        if (dueEl) {
            dueEl.textContent = 'LKR ' + (dueVal < 0 ? '-' : '') + formatMoneyLK(Math.abs(dueVal));
            dueEl.classList.toggle('dashboard2-amount-negative', dueVal < 0);
        }

        // 3. Populate monthly subscription amount
        var subVal = parseFloat(json.monlty_payment || 0);
        var subEl = document.getElementById('dashboard2-subscription-amount');
        if (subEl) {
            subEl.textContent = 'LKR ' + formatMoneyLK(subVal);
        }

        // 4. Update hidden membership number input
        var memNoEl = document.getElementById('Member_Profile_membership_no');
        if (memNoEl) {
            memNoEl.value = memNoVal;
        }

        // 5. Trigger payment list loading for this member
        body_01_01_A_01_Payment_list_Display();
    }

    // function body_01_01_A_01_Payment_list_Display() {
    //     var memberIdEl = document.getElementById("Member_Profile_id");
    //     var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : getQueryParam("id");
    //     var membershipNoEl = document.getElementById("Member_Profile_membership_no");
    //     var membership_no = membershipNoEl ? membershipNoEl.value : "";

    //     var tbody = document.getElementById("dashboard2-tbody");
    //     var empty = document.getElementById("dashboard2-empty");

    //     if (!member_id && !membership_no) {
    //         if (tbody) tbody.innerHTML = "";
    //         if (empty) empty.style.display = "block";
    //         return;
    //     }

    //     var sending_value = "filter_by_bmjm_member_list_id=" + encodeURIComponent(member_id) +
    //                        "&member_id=" + encodeURIComponent(member_id) +
    //                        "&membership_no=" + encodeURIComponent(membership_no);

    //     $.ajax({
    //         url: "<?php echo $pth; ?>View-List/Payment/payment_list.php",
    //         type: "POST",
    //         data: sending_value,
    //         success: function(response) {
    //             console.log("Payment List Response:", response);
    //             try {
    //                 var json_data = JSON.parse(response);
    //                 if (!Array.isArray(json_data) || json_data.length === 0) {
    //                     if (tbody) tbody.innerHTML = "";
    //                     if (empty) empty.style.display = "block";
    //                 } else {
    //                     if (empty) empty.style.display = "none";
    //                     if (tbody) {
    //                         tbody.innerHTML = json_data.map(function(p) {
    //                             var payType = "Payment";
    //                             if (p.pay_resion_subcption == "1") payType = "Subscription";
    //                             else if (p.pay_resion_donation == "1") payType = "Donation";
    //                             else if (p.pay_resion_zakath == "1") payType = "Zakath";
    //                             else if (p.pay_resion_projects == "1") payType = "Projects";

    //                             var amountVal = parseFloat(p.val_01 || p.amount || 0);

    //                             return '<tr>' +
    //                                    '  <td class="dashboard2-date">' + (p.payment_date || p.sdt || '') + '</td>' +
    //                                    '  <td class="dashboard2-type">' + payType + '</td>' +
    //                                    '  <td class="dashboard2-ref">' + (p.dis || p.slip_no || ('TRX-' + p.id)) + '</td>' +
    //                                    '  <td class="dashboard2-amount">' + formatMoneyLK(amountVal) + '</td>' +
    //                                    '  <td class="dashboard2-action-cell">' +
    //                                    '    <button class="dashboard2-icon-only" title="More options" aria-label="More options" onclick="if(typeof Admin_user_dashboard_01_B_OPEN===\'function\'){Admin_user_dashboard_01_B_OPEN();}">' +
    //                                    '      <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.9"/><circle cx="12" cy="12" r="1.9"/><circle cx="19" cy="12" r="1.9"/></svg>' +
    //                                    '    </button>' +
    //                                    '  </td>' +
    //                                    '</tr>';
    //                         }).join('');
    //                     }
    //                 }
    //             } catch(e) {
    //                 console.error("Error parsing payment list:", e);
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Failed to load payment list:", error);
    //         }
    //     });
    // }

    $(document).ready(function() {
        Member_body_01_01_A_01_Memeber_Details_Display();
    });
</script>