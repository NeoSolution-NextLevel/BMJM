<script>
    /* ===================================================================
       Admin_user_dashboard_03_C_JS.php — Block Profile View Logic
       =================================================================== */

    function populateBlockProfileData() {
        var memberIdEl = document.getElementById("Member_Profile_id");
        var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : "";
        if (!member_id) {
            var urlParams = new URLSearchParams(window.location.search);
            member_id = urlParams.get("id");
        }

        if (!member_id) return;

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
                var nameEl = document.getElementById("block_profile_name");
                if (nameEl) nameEl.textContent = m.name_M || "—";

                var addrEl = document.getElementById("block_profile_address");
                if (addrEl) addrEl.textContent = m.residence_address_M || m.road_name_M || "—";

                var memNoEl = document.getElementById("block_profile_membership_no");
                if (memNoEl) memNoEl.textContent = m.membership_no || (m.id ? String(m.id).padStart(5, '0') : "—");

                var inputIdEl = document.getElementById("block_profile_id");
                if (inputIdEl) inputIdEl.value = m.id;
            }
        })
        .catch(function(err) { console.error("Error populating block profile data:", err); });
    }

    function blockProfile(){
        var memberIdEl = document.getElementById("Member_Profile_id");
        var member_id = (memberIdEl && memberIdEl.value) ? memberIdEl.value : "";
        if (!member_id) {
            var urlParams = new URLSearchParams(window.location.search);
            member_id = urlParams.get("id");
        }

        if (!member_id) return;

        var requestUrl = "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/block_member.php";
        fetch(requestUrl, {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "id=" + encodeURIComponent(member_id)
        })
        .then(function(res) { return res.json(); })
        .then(function(responseData) {
            if (responseData && responseData.status === "success") {
                alert("Member has been successfully blocked.");
            } else {
                alert("Failed to block member: " + (responseData.message || "Unknown error"));
            }
        })
        .catch(function(err) { console.error("Error blocking member:", err); });
    }

    document.addEventListener('DOMContentLoaded', function() {
        populateBlockProfileData();
    });
    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        populateBlockProfileData();
    }
</script>
