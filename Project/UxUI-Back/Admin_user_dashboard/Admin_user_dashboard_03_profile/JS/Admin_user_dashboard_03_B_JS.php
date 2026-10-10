<script>
    /* ===================================================================
       Admin_user_dashboard_03_B_JS.php — Profile Edit Logic
       =================================================================== */

    function getEditProfileMemberId() {
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

    function loadProfileRoads(selectedRoadId) {
        var roadEl = document.getElementById("edit_profile_road_name");
        if (!roadEl) return Promise.resolve();

        var requestUrl = "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/road_view.php";
        return fetch(requestUrl, { method: "POST" })
            .then(function(response) { return response.json(); })
            .then(function(roads) {
                roadEl.innerHTML = '<option value="">Select road</option>';
                if (Array.isArray(roads)) {
                    roads.forEach(function(road) {
                        var option = document.createElement("option");
                        option.value = road.id;
                        option.textContent = road.road_name;
                        roadEl.appendChild(option);
                    });
                }
                if (selectedRoadId) roadEl.value = String(selectedRoadId);
            });
    }

    function populateProfileEditForm() {
        var member_id = getEditProfileMemberId();
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
            console.log("Edit Profile Fetch Response:", responseText);
            try {
                var json_data = JSON.parse(responseText);
                if (Array.isArray(json_data) && json_data.length > 0) {
                    fillEditProfileForm(json_data[0]);
                }
            } catch(e) {
                console.error("Error parsing edit profile response:", e);
            }
        })
        .catch(function(error) {
            console.error("Failed to fetch member details for edit:", error);
        });
    }

    function fillEditProfileForm(json) {
        if (!json) return;

        var idEl = document.getElementById("edit_profile_id");
        if (idEl) idEl.value = json.id || "";

        var nameEl = document.getElementById("edit_profile_name");
        if (nameEl) nameEl.value = json.name_M || "";

        var emailEl = document.getElementById("edit_profile_email");
        if (emailEl) {
            emailEl.value = json.email || "";
            emailEl.dataset.originalEmail = json.email || "";
        }

        var addrEl = document.getElementById("edit_profile_address");
        if (addrEl) addrEl.value = json.residence_address_M || "";

        var roadEl = document.getElementById("edit_profile_road_name");
        if (roadEl) {
            loadProfileRoads(json.wwjm_road_name_id);
        }

        var isOwner = (json.owner == "1" || json.residenceType === "owner");
        var radioOwner = document.getElementById("edit_profile_residence_owner");
        var radioRented = document.getElementById("edit_profile_residence_rented");
        if (radioOwner && radioRented) {
            if (isOwner) {
                radioOwner.checked = true;
            } else {
                radioRented.checked = true;
            }
        }

        var mntEl = document.getElementById("edit_profile_monthly_amount");
        if (mntEl) {
            mntEl.value = json.monlty_payment || "0.00";
            mntEl.min = json.monlty_payment || "0";
        }

        var zakathEl = document.getElementById("edit_profile_zakath_type");
        if (zakathEl) {
            if (json.account_type_zakath_reciver == "1") {
                zakathEl.value = "receiver";
            } else if (json.account_type_zakath_payee == "1" || json.zakath_pay_state == "1") {
                zakathEl.value = "payee";
            } else {
                zakathEl.value = "none";
            }
        }

        var mobileEl = document.getElementById("edit_profile_mobile");
        if (mobileEl) mobileEl.value = json.phone_mobile || json.notification_moible_no || "";

        var waEl = document.getElementById("edit_profile_whatsapp");
        if (waEl) waEl.value = json.notification_whatup || "";

        var sameCheck = document.getElementById("edit_profile_whatsapp_same");
        if (sameCheck && mobileEl && waEl) {
            if (mobileEl.value && mobileEl.value === waEl.value) {
                sameCheck.checked = true;
                waEl.disabled = true;
            } else {
                sameCheck.checked = false;
                waEl.disabled = false;
            }
        }
    }

    function userAccountEditToggleWhatsapp() {
        var sameCheck = document.getElementById("edit_profile_whatsapp_same");
        var mobileEl = document.getElementById("edit_profile_mobile");
        var waEl = document.getElementById("edit_profile_whatsapp");
        if (sameCheck && mobileEl && waEl) {
            waEl.disabled = sameCheck.checked;
            if (sameCheck.checked) {
                waEl.value = mobileEl.value;
            }
        }
    }

    function userAccountEditSyncWhatsapp() {
        var sameCheck = document.getElementById("edit_profile_whatsapp_same");
        var mobileEl = document.getElementById("edit_profile_mobile");
        var waEl = document.getElementById("edit_profile_whatsapp");
        if (sameCheck && sameCheck.checked && mobileEl && waEl) {
            waEl.value = mobileEl.value;
        }
    }

    function submitProfileEditForm(event) {
        if (event) event.preventDefault();

        var idEl = document.getElementById("edit_profile_id");
        var nameEl = document.getElementById("edit_profile_name");
        var emailEl = document.getElementById("edit_profile_email");
        var addrEl = document.getElementById("edit_profile_address");
        var roadEl = document.getElementById("edit_profile_road_name");
        var radioOwner = document.getElementById("edit_profile_residence_owner");
        var mntEl = document.getElementById("edit_profile_monthly_amount");
        var mobileEl = document.getElementById("edit_profile_mobile");
        var waEl = document.getElementById("edit_profile_whatsapp");
        var sameCheck = document.getElementById("edit_profile_whatsapp_same");
        var zakathEl = document.getElementById("edit_profile_zakath_type");

        var member_id = idEl ? idEl.value : getEditProfileMemberId();
        var name = nameEl ? nameEl.value.trim() : "";
        var email = emailEl ? emailEl.value.trim() : "";
        if (!email && emailEl && emailEl.dataset.originalEmail) {
            email = emailEl.dataset.originalEmail;
        }
        var residence_address_M = addrEl ? addrEl.value : "";
        var road_name_M = roadEl ? roadEl.value : "";
        var residence_type = (radioOwner && radioOwner.checked) ? "owner" : "rented";
        var monlty_payment = mntEl ? mntEl.value : "";
        var phone_mobile = mobileEl ? mobileEl.value : "";
        var notification_whatup = sameCheck && sameCheck.checked && mobileEl
            ? mobileEl.value
            : (waEl ? waEl.value : "");
        var zakath_type = zakathEl ? zakathEl.value : "none";

        if (!/^\d{10}$/.test(phone_mobile)) {
            if (mobileEl) {
                mobileEl.setCustomValidity("Enter exactly 10 digits.");
                mobileEl.reportValidity();
                mobileEl.setCustomValidity("");
            }
            return false;
        }
        if (notification_whatup !== "" && !/^\d{10}$/.test(notification_whatup)) {
            if (waEl) {
                waEl.setCustomValidity("Enter exactly 10 digits, or leave blank.");
                waEl.reportValidity();
                waEl.setCustomValidity("");
            }
            return false;
        }

        var sending_data = "id=" + encodeURIComponent(member_id) +
                           "&name_M=" + encodeURIComponent(name) +
                           "&email=" + encodeURIComponent(email) +
                           "&residence_address_M=" + encodeURIComponent(residence_address_M) +
                           "&bmjm_road_name_id=" + encodeURIComponent(road_name_M) +
                           "&residence_type=" + encodeURIComponent(residence_type) +
                           "&monlty_payment=" + encodeURIComponent(monlty_payment) +
                           "&phone_mobile=" + encodeURIComponent(phone_mobile) +
                           "&notification_whatup=" + encodeURIComponent(notification_whatup) +
                           "&zakath_type=" + encodeURIComponent(zakath_type);

        var requestUrl = "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/update_single_member.php";

        fetch(requestUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: sending_data
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(json_res) {
            console.log("Update response:", json_res);
            if (json_res && json_res.status === "success") {
                if (typeof fetchMemberProfileData === "function") {
                    fetchMemberProfileData();
                }
                if (typeof window.bmjmShowPopup === 'function') {
                    window.bmjmShowPopup({
                        type: 'success',
                        title: 'Profile Updated',
                        message: 'Profile updated successfully!',
                        onClose: function() {
                            if (typeof Admin_user_dashboard_03_A_OPEN === "function") {
                                Admin_user_dashboard_03_A_OPEN();
                            }
                        }
                    });
                } else if (typeof Admin_user_dashboard_03_A_OPEN === "function") {
                    Admin_user_dashboard_03_A_OPEN();
                }
            } else {
                if (typeof window.bmjmShowPopup === 'function') {
                    window.bmjmShowPopup({
                        type: 'error',
                        title: 'Update Failed',
                        message: 'Error updating profile: ' + (json_res.message || 'Unknown error')
                    });
                }
            }
        })
        .catch(function(err) {
            console.error("Profile update failed:", err);
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'error',
                    title: 'Submission Failed',
                    message: 'Failed to submit profile update.'
                });
            }
        });

        return false;
    }

    document.addEventListener('DOMContentLoaded', function() {
        populateProfileEditForm();
    });
    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        populateProfileEditForm();
    }
</script>
