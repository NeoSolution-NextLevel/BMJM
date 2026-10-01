<script>
    var signupRoadData = [];
    var signupSelectedRoadId = '';
    var signupSelectedRoadName = '';
    var signupSubmitting = false;

    function signupEscapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function signupShowStep(step) {
        var road = document.getElementById('signup-step-road');
        var form = document.getElementById('signup-step-form');
        var success = document.getElementById('signup-step-success');
        var shell = document.getElementById('signup-shell');
        if (road) road.style.display = step === 'road' ? 'block' : 'none';
        if (form) form.style.display = step === 'form' ? 'block' : 'none';
        if (success) success.style.display = step === 'success' ? 'block' : 'none';
        if (shell) shell.setAttribute('data-step', step);
        document.querySelectorAll('[data-step-item]').forEach(function(el) {
            var item = el.getAttribute('data-step-item');
            el.classList.toggle('is-active', item === step);
            el.classList.toggle('is-done', (step === 'form' && item === 'road') || (step === 'success' && item !== 'success'));
        });
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function signupRenderRoads() {
        var searchInput = document.getElementById('signup-road-search');
        var q = searchInput ? searchInput.value.trim().toLowerCase() : '';
        var list = document.getElementById('signup-road-list');
        var empty = document.getElementById('signup-road-empty');
        if (!list) return;

        var filtered = signupRoadData.filter(function(item) {
            var name = (item.road_name || item.name || '').toString().toLowerCase();
            return !q || name.indexOf(q) !== -1;
        });

        if (filtered.length === 0) {
            list.innerHTML = '';
            if (empty) empty.style.display = 'block';
            return;
        }

        if (empty) empty.style.display = 'none';
        list.innerHTML = filtered.map(function(item) {
            var roadName = item.road_name || item.name || '';
            var roadId = item.id || '';
            return '<div class="signup-road-row">' +
                '<span class="signup-road-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></span>' +
                '<span class="signup-road-name">' + signupEscapeHtml(roadName) + '</span>' +
                '<button type="button" class="signup-road-select" data-id="' + signupEscapeHtml(roadId) + '" data-name="' + signupEscapeHtml(roadName) + '">Select</button>' +
                '</div>';
        }).join('');

        list.querySelectorAll('.signup-road-select').forEach(function(btn) {
            btn.addEventListener('click', function() {
                signupSelectRoad(btn.getAttribute('data-id'), btn.getAttribute('data-name'));
            });
        });
    }

    function signupLoadRoads() {
        var searchInput = document.getElementById('signup-road-search');
        var q = searchInput ? searchInput.value.trim() : '';

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/road_view.php",
            type: "GET",
            data: { search_txt: q },
            success: function(response) {
                try {
                    var json_data = JSON.parse(response);
                    signupRoadData = Array.isArray(json_data) ? json_data : [];
                } catch (e) {
                    signupRoadData = [];
                }
                signupRenderRoads();
            },
            error: function() {
                signupRoadData = [];
                signupRenderRoads();
            }
        });
    }

    function signupSelectRoad(roadId, roadName) {
        if (!roadId) {
            alert('Please select a valid road.');
            return;
        }
        signupSelectedRoadId = String(roadId);
        signupSelectedRoadName = roadName || '';
        try { localStorage.setItem('selectedRoadId', signupSelectedRoadId); } catch (e) {}

        var idInput = document.getElementById('signup-road-id');
        if (idInput) idInput.value = signupSelectedRoadId;

        var label = document.getElementById('signup-selected-road-label');
        if (label) {
            label.textContent = signupSelectedRoadName
                ? signupSelectedRoadName
                : 'Road selected';
        }
        signupShowStep('form');
        signupSyncWhatsApp();
    }

    function signupSyncWhatsApp() {
        var isSame = document.getElementById('signup-whatsapp-same');
        var mobileInput = document.getElementById('signup-mobile');
        var whatsappInput = document.getElementById('signup-whatsapp');
        var whatsappWrap = document.getElementById('signup-field-whatsapp');

        if (isSame && whatsappWrap) {
            if (isSame.checked) {
                whatsappWrap.style.display = 'none';
                if (mobileInput && whatsappInput) {
                    whatsappInput.value = mobileInput.value;
                }
            } else {
                whatsappWrap.style.display = 'flex';
            }
        }
    }

    function signupSetInvalid(wrapId, invalid) {
        var wrap = document.getElementById(wrapId);
        if (wrap) wrap.classList.toggle('signup-invalid', !!invalid);
        return !invalid;
    }

    function signupGetVal(id) {
        var el = document.getElementById(id);
        return el ? el.value.trim() : '';
    }

    function signupIsChecked(id) {
        var el = document.getElementById(id);
        return !!(el && el.checked);
    }

    function signupSyncZakathSelection(changedBox) {
        var payee = document.getElementById('signup-zakath-payee');
        var receiver = document.getElementById('signup-zakath-receive');
        if (!payee || !receiver || !changedBox || !changedBox.checked) return;

        if (changedBox === payee) {
            receiver.checked = false;
        } else if (changedBox === receiver) {
            payee.checked = false;
        }
    }

    function signupMemberSubmit(event) {
        if (event) event.preventDefault();
        if (signupSubmitting) return false;

        var formError = document.getElementById('signup-form-error');
        if (formError) {
            formError.style.display = 'none';
            formError.textContent = '';
        }

        signupSyncWhatsApp();

        var isSame = document.getElementById('signup-whatsapp-same');
        var valid = true;
        var firstInvalid = null;

        function requireField(id, wrapId) {
            var input = document.getElementById(id);
            var filled = !!(input && input.value.trim().length > 0);
            signupSetInvalid(wrapId, !filled);
            if (!filled) {
                valid = false;
                if (!firstInvalid && input) firstInvalid = input;
            }
        }

        requireField('signup-name', 'signup-field-name');
        requireField('signup-address', 'signup-field-address');
        requireField('signup-nic', 'signup-field-nic');
        requireField('signup-mobile', 'signup-field-mobile');
        requireField('signup-secondary', 'signup-field-secondary');
        if (!isSame || !isSame.checked) {
            requireField('signup-whatsapp', 'signup-field-whatsapp');
        }

        var own = signupIsChecked('signup-own-house');
        var rented = signupIsChecked('signup-rented-house');
        var residingError = document.getElementById('signup-residing-error');
        if (!own && !rented) {
            valid = false;
            if (residingError) residingError.style.display = 'block';
        } else if (residingError) {
            residingError.style.display = 'none';
        }

        var nic = signupGetVal('signup-nic');
        var nicPattern = /^([0-9]{9}[vVxX]|[0-9]{12})$/;
        if (nic && !nicPattern.test(nic.replace(/\s/g, ''))) {
            signupSetInvalid('signup-field-nic', true);
            valid = false;
            if (!firstInvalid) firstInvalid = document.getElementById('signup-nic');
        }

        var mobilePattern = /^07\d{8}$/;
        var phonePattern = /^0\d{9}$/;
        var mobile = signupGetVal('signup-mobile').replace(/[\s-]/g, '');
        var secondary = signupGetVal('signup-secondary').replace(/[\s-]/g, '');
        var whatsapp = (isSame && isSame.checked) ? mobile : signupGetVal('signup-whatsapp').replace(/[\s-]/g, '');

        if (mobile && !mobilePattern.test(mobile)) {
            signupSetInvalid('signup-field-mobile', true);
            valid = false;
            if (!firstInvalid) firstInvalid = document.getElementById('signup-mobile');
        }
        if (whatsapp && !mobilePattern.test(whatsapp) && !(isSame && isSame.checked)) {
            signupSetInvalid('signup-field-whatsapp', true);
            valid = false;
            if (!firstInvalid) firstInvalid = document.getElementById('signup-whatsapp');
        }
        if (secondary && !phonePattern.test(secondary)) {
            signupSetInvalid('signup-field-secondary', true);
            valid = false;
            if (!firstInvalid) firstInvalid = document.getElementById('signup-secondary');
        }

        var email = signupGetVal('signup-email');
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            valid = false;
            if (formError) {
                formError.style.display = 'block';
                formError.textContent = 'Please enter a valid email address.';
            }
        }

        var subAmount = signupGetVal('signup-subscription');
        if (subAmount === '' || parseFloat(subAmount) < 500) {
            signupSetInvalid('signup-field-subscription', true);
            valid = false;
            if (!firstInvalid) firstInvalid = document.getElementById('signup-subscription');
        } else {
            signupSetInvalid('signup-field-subscription', false);
        }

        document.querySelectorAll('.signup-contact-person').forEach(function(sec, idx) {
            var memEl = sec.querySelector('.signup-contact-membership');
            var contactEl = sec.querySelector('.signup-contact-contact');
            var memWrap = document.getElementById('signup-field-ref' + (idx + 1) + '-membership');
            var contactWrap = document.getElementById('signup-field-ref' + (idx + 1) + '-contact');
            var memOk = memEl && memEl.value.trim().length > 0;
            var contactOk = contactEl && contactEl.value.trim().length > 0;
            if (memWrap) memWrap.classList.toggle('signup-invalid', !memOk);
            if (contactWrap) contactWrap.classList.toggle('signup-invalid', !contactOk);
            if (!memOk || !contactOk) {
                valid = false;
                if (!firstInvalid) firstInvalid = !memOk ? memEl : contactEl;
            }
        });

        var roadId = signupSelectedRoadId || signupGetVal('signup-road-id');
        if (!roadId) {
            valid = false;
            if (formError) {
                formError.style.display = 'block';
                formError.textContent = 'Please select a road before submitting.';
            }
            signupShowStep('road');
            return false;
        }

        if (!valid) {
            if (firstInvalid) firstInvalid.focus();
            return false;
        }

        var contactPersons = [];
        document.querySelectorAll('.signup-contact-person').forEach(function(sec) {
            var nameEl = sec.querySelector('.signup-contact-name');
            var memEl = sec.querySelector('.signup-contact-membership');
            var contactEl = sec.querySelector('.signup-contact-contact');
            contactPersons.push({
                name: nameEl ? nameEl.value.trim() : '',
                membership_no: memEl ? memEl.value.trim() : '',
                contact: contactEl ? contactEl.value.trim() : ''
            });
        });

        var cp1 = contactPersons[0] || { name: '', membership_no: '', contact: '' };
        var cp2 = contactPersons[1] || { name: '', membership_no: '', contact: '' };

        var formData = {
            val_01: signupGetVal('signup-name'),
            val_02: signupGetVal('signup-address'),
            val_05: nic.replace(/\s/g, ''),
            val_09: mobile,
            val_10: whatsapp,
            val_11: secondary,
            val_12: email,
            val_13: signupGetVal('signup-profession'),
            val_15: subAmount,
            val_17: '0',
            val_20: roadId,
            val_21: cp1.name,
            val_22: cp1.membership_no,
            val_23: cp1.contact,
            val_24: cp2.name,
            val_25: cp2.membership_no,
            val_26: cp2.contact,
            contact_persons: JSON.stringify(contactPersons)
        };

        if (own) formData.owner = '1';
        if (rented) formData.tenant = '1';
        if (signupIsChecked('signup-subscription-flag')) formData.account_type_subcrption = '1';
        if (signupIsChecked('signup-zakath-payee')) {
            formData.zakath_pay_state = '1';
        } else if (signupIsChecked('signup-zakath-receive')) {
            formData.account_type_zakath_reciver = '1';
        }

        var submitBtn = document.getElementById('signup-submit-btn');
        if (submitBtn) submitBtn.disabled = true;
        signupSubmitting = true;
        if (typeof preloader_show === 'function') preloader_show();

        $.ajax({
            url: "<?php echo $pth; ?>View-List/member_register/process_new_member.php",
            type: "POST",
            data: formData,
            success: function(response) {
                if (typeof preloader_hide === 'function') preloader_hide();
                signupSubmitting = false;
                if (submitBtn) submitBtn.disabled = false;

                try {
                    var json = JSON.parse(response);
                    if (json && json[0] && json[0].error === '0') {
                        try { localStorage.removeItem('selectedRoadId'); } catch (e) {}
                        signupShowStep('success');
                    } else {
                        var errorMsg = (json && json[0] && json[0].error) ? json[0].error : 'Could not complete signup. Please try again.';
                        if (formError) {
                            formError.style.display = 'block';
                            formError.textContent = errorMsg;
                        } else {
                            alert(errorMsg);
                        }
                    }
                } catch (e) {
                    if (formError) {
                        formError.style.display = 'block';
                        formError.textContent = 'System error. Please try again.';
                    }
                }
            },
            error: function() {
                if (typeof preloader_hide === 'function') preloader_hide();
                signupSubmitting = false;
                if (submitBtn) submitBtn.disabled = false;
                if (formError) {
                    formError.style.display = 'block';
                    formError.textContent = 'Network error. Please try again.';
                }
            }
        });

        return false;
    }

    $(document).ready(function() {
        signupLoadRoads();

        var searchInput = document.getElementById('signup-road-search');
        if (searchInput) {
            searchInput.addEventListener('input', signupRenderRoads);
            searchInput.addEventListener('keyup', signupRenderRoads);
        }

        var isSame = document.getElementById('signup-whatsapp-same');
        var mobileInput = document.getElementById('signup-mobile');
        if (isSame) isSame.addEventListener('change', signupSyncWhatsApp);
        if (mobileInput) {
            mobileInput.addEventListener('input', function() {
                if (isSame && isSame.checked) signupSyncWhatsApp();
            });
        }
        signupSyncWhatsApp();

        var ownHouse = document.getElementById('signup-own-house');
        var rentedHouse = document.getElementById('signup-rented-house');
        if (ownHouse && rentedHouse) {
            ownHouse.addEventListener('change', function() {
                if (ownHouse.checked) rentedHouse.checked = false;
            });
            rentedHouse.addEventListener('change', function() {
                if (rentedHouse.checked) ownHouse.checked = false;
            });
        }

        var zakathPayee = document.getElementById('signup-zakath-payee');
        var zakathReceiver = document.getElementById('signup-zakath-receive');
        if (zakathPayee) zakathPayee.addEventListener('change', function() { signupSyncZakathSelection(zakathPayee); });
        if (zakathReceiver) zakathReceiver.addEventListener('change', function() { signupSyncZakathSelection(zakathReceiver); });

        var closeBtn = document.getElementById('signup-form-close');
        var cancelBtn = document.getElementById('signup-cancel-btn');
        function backToRoads() { signupShowStep('road'); }
        if (closeBtn) closeBtn.addEventListener('click', backToRoads);
        if (cancelBtn) cancelBtn.addEventListener('click', backToRoads);
        signupShowStep('road');
    });
</script>
