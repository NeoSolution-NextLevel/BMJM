<script type="text/javascript">
  var currentCashPaymentMemberAdmin = null;

  function loadCashPaymentDataAdmin() {
      // The URL contains an encrypted token; the dashboard exposes its numeric member ID here.
      var profileIdInput = document.getElementById('Member_Profile_id');
      var memberId = profileIdInput && profileIdInput.value ? profileIdInput.value : '';

      if (!memberId) {
          var urlParams = new URLSearchParams(window.location.search);
          memberId = urlParams.get('id');
      }

      if (!memberId) {
          console.error("No member selected for cash payment!");
          setCashPaymentReadyAdmin(false);
          return;
      }

      currentCashPaymentMemberAdmin = null;
      setCashPaymentReadyAdmin(false);
      var sending_value = "id=" + encodeURIComponent(memberId);
      
      $.ajax({
          url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Member/view_single_member.php",
          type: 'POST',
          data: sending_value,
          cache: false,
          success: function(data) {
              try {
                  var json = typeof data === 'string' ? JSON.parse(data) : data;
                  if (json && json.length > 0) {
                      var member = json[0];
                      currentCashPaymentMemberAdmin = member; // Store globally for submission
                      
                      var cashMemberNo = document.getElementById("cash-payment-member-no");
                      if (cashMemberNo) cashMemberNo.innerText = member.membership_no || '';
                      
                      var cashMemberName = document.getElementById("cash-payment-member-name");
                      if (cashMemberName) cashMemberName.innerText = member.name_M || '';
                      
                      var cashDueAmount = document.getElementById("cash-payment-due-amount");
                      if (cashDueAmount) cashDueAmount.innerText = member.due_to_pay || '0.00';
                      
                      // Update global hidden fields if they exist
                      var hiddenNo = document.getElementById("selected-payment-member-no");
                      if(hiddenNo) hiddenNo.value = member.membership_no || '';
                      var hiddenName = document.getElementById("selected-payment-member-name");
                      if(hiddenName) hiddenName.value = member.name_M || '';
                      var hiddenAmount = document.getElementById("selected-payment-due-amount");
                      if(hiddenAmount) hiddenAmount.value = member.due_to_pay || '';
                      setCashPaymentReadyAdmin(true);
                  } else {
                      setCashPaymentReadyAdmin(false);
                      console.error("Member lookup returned no data.");
                  }
              } catch(e) {
                  setCashPaymentReadyAdmin(false);
                  console.error("Error parsing member data: ", e);
              }
          },
          error: function(xhr) {
              setCashPaymentReadyAdmin(false);
              console.error("Failed to load member data:", xhr.status, xhr.responseText);
          }
      });
  }

  function setCashPaymentReadyAdmin(isReady) {
      var btn = document.querySelector('#Admin_user_dashboard_02_E .payment-cash-btn-process');
      if (!btn) return;
      btn.disabled = !isReady;
      btn.innerText = isReady ? "Process Payment" : "Loading...";
  }

  function Admin_user_dashboard_02_E_OPEN_AND_LOAD() {
      if (typeof Admin_user_dashboard_02_E_OPEN === "function") {
          Admin_user_dashboard_02_E_OPEN();
      }
  }

  function processCashPayment() {
    console.log("Processing cash payment...");
    
    if (!currentCashPaymentMemberAdmin) {
        if (typeof window.bmjmShowPopup === 'function') {
            window.bmjmShowPopup({
                type: 'error',
                title: 'Member Data Missing',
                message: 'Member data is not loaded yet. Please wait or reload the page.'
            });
        }
        return;
    }
    
    var payingAmount = document.getElementById('cash-paying-amount').value;
    if (!payingAmount || isNaN(payingAmount) || payingAmount <= 0) {
        if (typeof window.bmjmShowPopup === 'function') {
            window.bmjmShowPopup({
                type: 'warning',
                title: 'Invalid Amount',
                message: 'Please enter a valid paying amount.'
            });
        }
        return;
    }
    
    var sendSms = document.getElementById('cash-slip-sms').checked ? 1 : 0;
    var sendEmail = document.getElementById('cash-slip-email').checked ? 1 : 0;
    var printSlip = document.getElementById('cash-slip-print').checked ? 1 : 0;
    
    var sending_value = "val_01=" + encodeURIComponent(payingAmount) +
                        "&val_02=0" +
                        "&val_03=" + encodeURIComponent(currentCashPaymentMemberAdmin.name_M || "") +
                        "&val_04=" + encodeURIComponent(currentCashPaymentMemberAdmin.residence_address_M || "") +
                        "&val_05=" + encodeURIComponent(currentCashPaymentMemberAdmin.membership_no || "") +
                        "&member_email=" + encodeURIComponent(currentCashPaymentMemberAdmin.email || "") +
                        "&member_mobile_no=" + encodeURIComponent(currentCashPaymentMemberAdmin.phone_mobile || "") +
                        "&bmjm_member_list_id=" + encodeURIComponent(currentCashPaymentMemberAdmin.id) +
                        "&is_cash=1" +
                        "&is_member=1" +
                        "&pay_resion_subcption=1"; 
                        
    // Display loading state
    var btn = document.querySelector('.payment-cash-btn-process');
    var originalText = btn.innerText;
    btn.innerText = "Processing Payment...";
    btn.disabled = true;
    
    $.ajax({
        url: "<?php echo isset($pth) ? $pth : '../'; ?>View-List/Payment/create_wwjm_payment_slip.php",
        type: 'POST',
        data: sending_value,
        cache: false,
        success: function(data) {
            btn.innerText = originalText;
            btn.disabled = false;
            
            try {
                var json = eval(data);
                if (json && json[0] && json[0].error === "0") {
                    document.getElementById('cash-paying-amount').value = "";
                    if (typeof window.bmjmShowPopup === 'function') {
                        window.bmjmShowPopup({
                            type: 'success',
                            title: 'Payment Recorded',
                            message: 'Payment submitted successfully! Receipt ID: ' + json[0].id,
                            onClose: function() {
                                if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                                    Admin_user_dashboard_02_A_OPEN();
                                }
                            }
                        });
                    } else if (typeof Admin_user_dashboard_02_A_OPEN === "function") {
                        Admin_user_dashboard_02_A_OPEN();
                    }
                } else {
                    if (typeof window.bmjmShowPopup === 'function') {
                        window.bmjmShowPopup({
                            type: 'error',
                            title: 'Payment Failed',
                            message: 'Failed to submit payment: ' + (json[0].error || 'Unknown error')
                        });
                    }
                }
            } catch(e) {
                console.error("Payment submission error:", e, data);
                if (typeof window.bmjmShowPopup === 'function') {
                    window.bmjmShowPopup({
                        type: 'error',
                        title: 'Submission Error',
                        message: 'An error occurred while submitting the payment.'
                    });
                }
            }
        },
        error: function() {
            btn.innerText = originalText;
            btn.disabled = false;
            if (typeof window.bmjmShowPopup === 'function') {
                window.bmjmShowPopup({
                    type: 'error',
                    title: 'Connection Error',
                    message: 'Network error occurred. Please try again.'
                });
            }
        }
    });
  }
</script>
