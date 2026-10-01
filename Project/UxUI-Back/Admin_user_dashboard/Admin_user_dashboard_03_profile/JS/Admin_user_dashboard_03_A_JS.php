<script>
    /* ===================================================================
       Admin_user_dashboard_03_A_JS.php — Dynamic Profile View Logic
       =================================================================== */

    function getProfileMemberId() {
        var memberIdEl = document.getElementById("Member_Profile_id");
        if (memberIdEl && memberIdEl.value) {
            return memberIdEl.value;
        }
        var urlParams = new URLSearchParams(window.location.search);
        var urlId = urlParams.get("id");
        if (urlId) {
            return urlId;
        }
        return "";
    }

    function formatMoneyLKR(amount) {
        var val = parseFloat(amount || 0);
        var sign = val < 0 ? '-' : '';
        return 'LKR ' + sign + Math.abs(val).toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function fetchMemberProfileData() {
        var member_id = getProfileMemberId();
        var sending_value = "id=" + encodeURIComponent(member_id);

        var requestUrl = "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/view_single_member.php";

        fetch(requestUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: sending_value
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(responseText) {
            console.log("Member Profile Response:", responseText);
            try {
                var json_data = JSON.parse(responseText);
                if (Array.isArray(json_data) && json_data.length > 0) {
                    renderMemberProfileDetails(json_data[0]);
                }
            } catch(e) {
                console.error("Error parsing member profile response:", e);
            }
        })
        .catch(function(error) {
            console.error("Failed to load member profile details:", error);
        });
    }

    function renderMemberProfileDetails(json) {
        if (!json) return;

        // 1. Name
        var nameEl = document.getElementById("profile_view_name");
        if (nameEl) nameEl.textContent = json.name_M || '—';

        // 2. Residence Address
        var addrEl = document.getElementById("profile_view_address");
        if (addrEl) addrEl.textContent = json.residence_address_M || json.road_name_M || '—';

        // 3. Road Name
        var roadEl = document.getElementById("profile_view_road_name");
        if (roadEl) roadEl.textContent = json.road_name_M || '—';

        // 4. NIC No
        var nicEl = document.getElementById("profile_view_nic");
        if (nicEl) nicEl.textContent = json.nic_M || '—';

        // 5. Residence Type
        var resEl = document.getElementById("profile_view_residence_type");
        if (resEl) {
            resEl.textContent = (json.owner == "1" || json.residenceType === "owner") ? "Owner" : "Tenant";
        }

        // 6. Mobile
        var mobileEl = document.getElementById("profile_view_mobile");
        if (mobileEl) mobileEl.textContent = json.phone_mobile || json.notification_moible_no || '—';

        // 7. Whatsapp
        var waEl = document.getElementById("profile_view_whatsapp");
        if (waEl) waEl.textContent = json.notification_whatup || json.phone_mobile || '—';

        // 8. Email
        var emailEl = document.getElementById("profile_view_email");
        if (emailEl) emailEl.textContent = json.email || '—';

        // 9. Profession
        var profEl = document.getElementById("profile_view_profession");
        if (profEl) profEl.textContent = json.profetion || '—';

        // 10. Monthly Maintain Amount
        var mntEl = document.getElementById("profile_view_monthly_amount");
        if (mntEl) mntEl.textContent = formatMoneyLKR(json.monlty_payment);

        // 11. Membership No
        var memNoEl = document.getElementById("profile_view_membership_no");
        if (memNoEl) {
            memNoEl.textContent = json.membership_no || (json.id ? String(json.id).padStart(5, '0') : '—');
        }

        // 12. Due Amount
        var dueEl = document.getElementById("profile_view_due_amount");
        if (dueEl) {
            var dueVal = parseFloat(json.due_to_pay || 0);
            dueEl.textContent = formatMoneyLKR(dueVal);
            if (dueVal < 0) {
                dueEl.classList.add("is-danger");
            } else {
                dueEl.classList.remove("is-danger");
            }
        }
    }

    function Admin_user_dashboard_03_A_CANCEL() {
        if (typeof Admin_user_dashboard_01_OPEN === "function") {
            Admin_user_dashboard_01_OPEN();
        } else {
            window.location.href = "<?php echo isset($pth) ? $pth : '../'; ?>UxUi/Admin_user_dashboard.php";
        }

        return false;
    }

    document.addEventListener('DOMContentLoaded', function() {
        fetchMemberProfileData();
    });
    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        fetchMemberProfileData();
    }
</script>
