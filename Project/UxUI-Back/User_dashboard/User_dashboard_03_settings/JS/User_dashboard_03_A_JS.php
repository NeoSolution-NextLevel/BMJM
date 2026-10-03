<script>
    function formatSettingsMoneyLK(num) {
        const n = parseFloat(num || 0);
        return 'LKR ' + n.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function showToast(message, type) {
        const toast = document.getElementById('settings-toast');
        if (!toast) return;
        toast.className = 'toast-alert ' + type;
        toast.innerText = message;
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 4000);
    }

    function showProfileToast(message, type) {
        const toast = document.getElementById('profile-settings-toast');
        if (!toast) return;
        toast.className = 'toast-alert ' + type;
        toast.innerText = message;
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 4000);
    }

    function showProfileUpdateError(message) {
        showProfileToast(message, 'error');
        load_settings_member_profile(false);
    }

    function setSettingsValue(id, value) {
        const el = document.getElementById(id);
        if (el) el.value = value || '';
    }

    function setSettingsText(id, value) {
        const el = document.getElementById(id);
        if (el) el.innerText = value || '-';
    }

    function normalizeSettingsPhone(value) {
        return String(value || '').replace(/[^\d+]/g, '').trim();
    }

    function normalizeSettingsEmail(value) {
        return String(value || '').trim().toLowerCase();
    }

    function getSettingsLoginId() {
        const loginEl = document.getElementById("main_user_login_id");
        return loginEl ? loginEl.value : "";
    }

    function sync_settings_whatsapp() {
        const sameCheck = document.getElementById('setting_whatsapp_same');
        const mobileEl = document.getElementById('setting_mobile');
        const whatsappEl = document.getElementById('setting_whatsapp');
        if (!sameCheck || !mobileEl || !whatsappEl) return;

        if (sameCheck.checked) {
            whatsappEl.value = mobileEl.value;
            whatsappEl.readOnly = true;
        } else {
            whatsappEl.readOnly = false;
        }
    }

    function load_settings_roads(selectedRoadId) {
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/road_view.php",
            type: "POST",
            success: function(response) {
                try {
                    const roads = typeof response === 'object' ? response : JSON.parse(response);
                    render_settings_roads(roads, selectedRoadId);
                } catch (e) {
                    showProfileToast('Unable to load the road list.', 'error');
                }
            },
            error: function() {
                showProfileToast('Unable to load the road list.', 'error');
            }
        });
    }

    function render_settings_roads(roads, selectedRoadId) {
        const roadEl = document.getElementById('setting_road');
        if (!roadEl) return;

        roadEl.innerHTML = '<option value="">Select road</option>';

        if (Array.isArray(roads)) {
            roads.forEach(function(road) {
                const option = document.createElement('option');
                option.value = road.id;
                option.textContent = road.road_name;
                roadEl.appendChild(option);
            });
        }

        roadEl.value = selectedRoadId ? String(selectedRoadId) : '';
    }

    function fill_settings_member_profile(data) {
        if (!data) return;

        const mobile = data.notification_moible_no || data.phone_mobile || '';
        const whatsapp = data.notification_whatup || '';
        const monthlyPayment = data.monlty_payment || "0.00";
        const dueAmount = data.due_to_pay || "0.00";

        setSettingsValue('setting_member_id', data.id || '');
        setSettingsValue('setting_name', data.name_M || '');
        setSettingsValue('setting_email', data.email || '');
        setSettingsValue('setting_nic', data.nic_M || '');
        setSettingsValue('setting_address', data.residence_address_M || '');
        setSettingsValue('setting_address_display', data.residence_address_M || '');
        setSettingsValue('setting_mobile', mobile);
        setSettingsValue('setting_whatsapp', whatsapp);
        setSettingsValue('setting_monthly_payment', monthlyPayment);

        const monthlyPaymentEl = document.getElementById('setting_monthly_payment');
        if (monthlyPaymentEl) {
            monthlyPaymentEl.min = monthlyPayment;
            monthlyPaymentEl.dataset.currentAmount = monthlyPayment;
        }

        const zakathEl = document.getElementById('setting_zakath_type');
        if (zakathEl) {
            if (data.account_type_zakath_reciver === '1') {
                zakathEl.value = 'receiver';
            } else if (data.account_type_zakath_payee === '1' || data.zakath_pay_state === '1') {
                zakathEl.value = 'payee';
            } else {
                zakathEl.value = 'none';
            }
        }

        load_settings_roads(data.wwjm_road_name_id || '');

        setSettingsText('setting_membership_no', data.membership_no || data.id || '-');
        setSettingsText('setting_monthly_payment_display', formatSettingsMoneyLK(monthlyPayment));
        setSettingsText('setting_road_display', data.road_name_M || '-');
        setSettingsText('setting_due_display', formatSettingsMoneyLK(dueAmount));

        const twoFactorEl = document.getElementById('setting_2fa_toggle');
        if (twoFactorEl) twoFactorEl.checked = data.is_two_factor_auth_enable === "1";

        const sameCheck = document.getElementById('setting_whatsapp_same');
        if (sameCheck) {
            sameCheck.checked = !!mobile && mobile === whatsapp;
            sync_settings_whatsapp();
        }
    }

    function load_settings_member_profile(showLoader) {
        const loginId = getSettingsLoginId();
        if (!loginId) {
            showToast("Member account not found. Please log in again.", "error");
            return;
        }

        if (showLoader && typeof bmjmShowProcessing === 'function') {
            bmjmShowProcessing('Loading profile...', 'Please wait while your member details are loaded.');
        }

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/view_single_member.php",
            type: "POST",
            data: { main_user_login_id: loginId },
            success: function(response) {
                if (showLoader && typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                try {
                    const json = JSON.parse(response);
                    if (Array.isArray(json) && json[0]) {
                        fill_settings_member_profile(json[0]);
                    } else {
                        showToast("Unable to load member profile details.", "error");
                    }
                } catch(e) {
                    showToast("Server configuration error.", "error");
                }
            },
            error: function() {
                if (showLoader && typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                showToast("Failed to load member profile details.", "error");
            }
        });
    }

    function update_profile_details(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        sync_settings_whatsapp();

        const memberId = document.getElementById("setting_member_id").value;
        const loginId = getSettingsLoginId();
        const name = document.getElementById("setting_name").value.trim();
        const mobile = normalizeSettingsPhone(document.getElementById("setting_mobile").value);
        const whatsapp = normalizeSettingsPhone(document.getElementById("setting_whatsapp").value);
        const email = normalizeSettingsEmail(document.getElementById("setting_email").value);
        const address = document.getElementById("setting_address_display").value.trim();
        const roadId = document.getElementById("setting_road").value;
        const monthlyPaymentEl = document.getElementById("setting_monthly_payment");
        const monthlyPayment = monthlyPaymentEl.value.trim();
        const currentMonthlyPayment = parseFloat(monthlyPaymentEl.dataset.currentAmount || '0');
        const zakathType = document.getElementById("setting_zakath_type").value;
        const submitBtn = document.querySelector('#profile-settings-form button[type="submit"]');

        if (!memberId) {
            showProfileUpdateError("Member profile is still loading. Please try again.");
            return false;
        }

        if (!name) {
            showProfileUpdateError("Please enter your full name.");
            return false;
        }

        if (!email) {
            showProfileUpdateError("Please enter your email address.");
            return false;
        }

        const emailField = document.getElementById("setting_email");
        if (emailField && !emailField.checkValidity()) {
            showProfileUpdateError("Please enter a valid email address.");
            return false;
        }

        if (!address) {
            showProfileUpdateError("Please enter your residence address.");
            return false;
        }

        if (!mobile) {
            showProfileUpdateError("Please enter your mobile number.");
            return false;
        }

        if (!roadId) {
            showProfileUpdateError("Please select your street or road.");
            return false;
        }

        if (monthlyPayment === '' || !Number.isFinite(Number(monthlyPayment)) || Number(monthlyPayment) < currentMonthlyPayment) {
            showProfileUpdateError("Monthly subscription amount must be equal to or greater than " + formatSettingsMoneyLK(currentMonthlyPayment) + ".");
            return false;
        }

        setSettingsValue('setting_address', address);

        if (submitBtn) submitBtn.disabled = true;
        if (typeof bmjmShowProcessing === 'function') {
            bmjmShowProcessing('Updating profile...', 'Please wait while your contact details are saved.');
        }
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/update_single_member.php",
            type: "POST",
            data: { 
                id: memberId,
                main_user_login_id: loginId,
                name_M: name,
                email: email,
                residence_address_M: address,
                phone_mobile: mobile,
                notification_whatup: whatsapp,
                bmjm_road_name_id: roadId,
                monlty_payment: monthlyPayment,
                zakath_type: zakathType
            },
            success: function(response) {
                if (submitBtn) submitBtn.disabled = false;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                try {
                    const json = typeof response === 'object' ? response : JSON.parse(response);
                    if (json && json.status === "success") {
                        setSettingsValue('setting_name', name);
                        setSettingsValue('setting_email', email);
                        setSettingsValue('setting_address', address);
                        setSettingsValue('setting_address_display', address);
                        setSettingsValue('setting_mobile', mobile);
                        setSettingsValue('setting_whatsapp', whatsapp);
                        showProfileToast("Profile details updated successfully!", "success");
                        load_settings_member_profile(false);
                    } else {
                        showProfileUpdateError((json && json.message) || "Failed to update profile information.");
                    }
                } catch(e) {
                    showProfileUpdateError("Server configuration error.");
                }
            },
            error: function() {
                if (submitBtn) submitBtn.disabled = false;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                showProfileUpdateError("Failed to update profile information.");
            }
        });

        return false;
    }

    function update_password_details(event) {
        event.preventDefault();
        const oldP = document.getElementById("setting_old_password").value;
        const newP = document.getElementById("setting_new_password").value;
        const confP = document.getElementById("setting_confirm_password").value;
        
        if (newP !== confP) {
            showToast("New passwords do not match!", "error");
            return;
        }

        if (newP.length < 6) {
            showToast("New password must be at least 6 characters.", "error");
            return;
        }

        const loginId = document.getElementById("main_user_login_id").value;
        const submitBtn = document.querySelector('#security-settings-form button[type="submit"]');
        if (submitBtn) submitBtn.disabled = true;
        if (typeof bmjmShowProcessing === 'function') {
            bmjmShowProcessing('Changing password...', 'Please wait while your password is updated.');
        }

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/update_password_member.php",
            type: "POST",
            data: { 
                main_user_login_id: loginId,
                old_password: oldP,
                new_password: newP
            },
            success: function(response) {
                if (submitBtn) submitBtn.disabled = false;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                try {
                    const json = JSON.parse(response);
                    if (json && json[0] && json[0].error === "0") {
                        showToast("Password changed securely!", "success");
                        document.getElementById("security-settings-form").reset();
                    } else {
                        showToast(json[0].error || "Failed to update password.", "error");
                    }
                } catch(e) {
                    showToast("Server configuration error.", "error");
                }
            },
            error: function() {
                if (submitBtn) submitBtn.disabled = false;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                showToast("Failed to update password.", "error");
            }
        });
    }
    
    function toggle_2fa_setting(checkbox) {
        const loginId = document.getElementById("main_user_login_id").value;
        const newStatus = checkbox.checked ? 1 : 0;
        checkbox.disabled = true;
        if (typeof bmjmShowProcessing === 'function') {
            bmjmShowProcessing('Updating security...', 'Please wait while your two-factor setting is saved.');
        }
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/update_2fa_state.php",
            type: "POST",
            data: { 
                main_user_login_id: loginId,
                is_two_factor_auth_enable: newStatus
            },
            success: function(response) {
                checkbox.disabled = false;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                try {
                    const json = JSON.parse(response);
                    if (json && json[0] && json[0].error === "0") {
                        if (newStatus === 1) {
                            showToast("2FA successfully enabled! You will now receive an OTP via SMS when logging in.", "success");
                        } else {
                            showToast("2FA disabled. Standard password login is now active.", "success");
                        }
                    } else {
                        checkbox.checked = !checkbox.checked; // Revert visually on fail
                        showToast("Failed to update 2FA settings.", "error");
                    }
                } catch(e) {
                    checkbox.checked = !checkbox.checked;
                    showToast("System error occurred.", "error");
                }
            },
            error: function() {
                checkbox.disabled = false;
                checkbox.checked = !checkbox.checked;
                if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
                showToast("Failed to update 2FA settings.", "error");
            }
        });
    }

    $(document).ready(function() {
        load_settings_member_profile(false);

        $('#setting_mobile').on('input', function() {
            const sameCheck = document.getElementById('setting_whatsapp_same');
            if (sameCheck && sameCheck.checked) {
                sync_settings_whatsapp();
            }
        });
    });
</script>
