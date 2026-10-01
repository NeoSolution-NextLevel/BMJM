<script>
    /* ===================================================================
       Admin_user_dashboard_01_B.php — Payment Slip View Logic
       =================================================================== */

    function populatePaymentSlipView(pData) {
        var memberIdEl = document.getElementById("Member_Profile_id");
        var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : "";

        if (member_id) {
            var requestUrl = "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/view_single_member.php";
            fetch(requestUrl, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=" + encodeURIComponent(member_id)
            })
            .then(function(res) { return res.json(); })
            .then(function(memData) {
                if (Array.isArray(memData) && memData.length > 0) {
                    var m = memData[0];
                    var nameEl = document.getElementById("payment-slip-name");
                    if (nameEl) nameEl.textContent = m.name_M || "—";

                    var mobEl = document.getElementById("payment-slip-mobile");
                    if (mobEl) mobEl.textContent = m.phone_mobile || m.notification_moible_no || "—";

                    var addrEl = document.getElementById("payment-slip-address");
                    if (addrEl) addrEl.textContent = m.residence_address_M || m.road_name_M || "—";
                }
            })
            .catch(function(err) { console.error("Error fetching member for slip:", err); });
        }

        if (pData) {
            renderPaymentSlipItem(pData);
        }
    }

    function renderPaymentSlipItem(p) {
        var itemsTbody = document.getElementById("payment-slip-items");
        var totalEl = document.getElementById("payment-slip-total");

        var payType = "Subscription";
        if (p.pay_resion_donation == "1") payType = "Donation";
        else if (p.pay_resion_zakath == "1") payType = "Zakath";
        else if (p.pay_resion_projects == "1") payType = "Projects";

        var amt = parseFloat(p.val_01 || p.amount || 0);
        var formattedAmt = amt.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        if (itemsTbody) {
            itemsTbody.innerHTML = '<tr>' +
                                   '  <td>' + payType + '</td>' +
                                   '  <td class="payment-slip-col-amount">' + formattedAmt + '</td>' +
                                   '</tr>';
        }
        if (totalEl) {
            totalEl.textContent = formattedAmt;
        }
    }
</script>
