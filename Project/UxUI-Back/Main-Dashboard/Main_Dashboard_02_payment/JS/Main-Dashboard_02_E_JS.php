<script type="text/javascript">
  var currentCashPaymentMember = null;

  function cashPaymentDisplayType(paymentType) {
      var normalized = String(paymentType || '').trim().toLowerCase();
      if (normalized === 'subcription' || normalized === 'subscription') return 'Subscription';
      if (normalized === 'zakath') return 'Zakath';
      if (normalized === 'donation') return 'Donation';
      if (normalized === 'projects' || normalized === 'project') return 'Project';
      return paymentType || 'Payment';
  }

  function cashPaymentFormatAmount(value) {
      var amount = parseFloat(value);
      if (!Number.isFinite(amount)) amount = 0;
      return Math.abs(amount).toLocaleString('en-LK', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
      });
  }

  function loadCashPaymentData() {
      var memberIdEl = document.getElementById("DashBord_Payment_body_member_list_id") || document.getElementById("selected-member-id");
      var memberId = memberIdEl ? memberIdEl.value : null;

      // Ensure Contextual Adjustments natively hide visually irrelevant data!
      var paymentTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");
      var paymentType = paymentTypeEl && typeof normalizeMainDashboardPaymentReason === 'function'
          ? normalizeMainDashboardPaymentReason(paymentTypeEl.value)
          : '';

      var titleEl = document.getElementById("cash-payment-type-title");
      if (titleEl) {
          if (paymentType === "Projects") {
              var projNameEl = document.getElementById("payment_selected_project_name");
              titleEl.innerText = projNameEl ? projNameEl.value : "Project";
          } else {
              titleEl.innerText = paymentType;
          }
      }

      var dueSection = document.getElementById("cash-payment-due-section");
      var isProjectOverride = false;
      var paymentOverrideDelta = "0.00";

      if (paymentType === "Projects") {
          var overrideFlag = document.getElementById("Project_Override_Show_Due") ? document.getElementById("Project_Override_Show_Due").value : "0";
          if (overrideFlag === "1") {
              isProjectOverride = true;
              paymentOverrideDelta = document.getElementById("DashBord_Payment_body_due_to_pay") ? document.getElementById("DashBord_Payment_body_due_to_pay").value : "0.00";
          }
      }

      if (dueSection) {
          if (paymentType === "Projects" || paymentType === "Donation" || paymentType === "Zakath") {
              if (isProjectOverride) {
                  dueSection.style.display = "block";
              } else {
                  dueSection.style.display = "none";
              }
          } else {
              dueSection.style.display = "block";
          }
      }

      var guestSection = document.getElementById("cash-payment-guest-section");
      var staticInfoRows = document.querySelectorAll(".payment-cash-info-row");

      // --- ANONYMOUS GUEST BYPASS ---
      if (!memberId || memberId == "0") {
          currentCashPaymentMember = { id: 0 }; // Synthesized native empty state
          
          if (guestSection) guestSection.style.display = "block"; // Unhide manual inputs
          if (staticInfoRows) staticInfoRows.forEach(row => row.style.display = "none"); // Hide static labels
          
          // Securely allow the target Due block to persist visibly if explicitly mandated by the Project Limits
          if (dueSection) {
              if (!isProjectOverride) {
                  dueSection.style.display = "none";
              } else {
                  dueSection.style.display = "block";
                  var cashDueAmount = document.getElementById("cash-payment-due-amount");
                  if (cashDueAmount) cashDueAmount.innerText = paymentOverrideDelta;
              }
          }
          return; // Skip sending unnecessary DB lookups since we have no ID!
      } else {
          if (guestSection) guestSection.style.display = "none";
          if (staticInfoRows) staticInfoRows.forEach(row => row.style.display = "flex");
      }

      // --- STANDARD MEMBER DB RETRIEVAL ---
      var sending_value = "search_txt=" + encodeURIComponent(memberId) + "&search_by=id";
      
      $.ajax({
          url: "<?php echo $pth; ?>View-List/Member/view_member_list.php",
          type: 'POST',
          data: sending_value,
          cache: false,
          success: function(data) {
              try {
                  var json = eval(data);
                  if (json && json.length > 0) {
                      var member = json[0];
                      currentCashPaymentMember = member; // Store globally for submission
                      
                      var cashMemberNo = document.getElementById("cash-payment-member-no");
                      if (cashMemberNo) cashMemberNo.innerText = member.membership_no || '';
                      
                      var cashMemberName = document.getElementById("cash-payment-member-name");
                      if (cashMemberName) cashMemberName.innerText = member.name_M || '';
                      
                      var cashDueAmount = document.getElementById("cash-payment-due-amount");
                      if (cashDueAmount) {
                          if (isProjectOverride) {
                               cashDueAmount.innerText = paymentOverrideDelta;
                          } else {
                               cashDueAmount.innerText = member.due_to_pay || '0.00';
                          }
                      }
                  }
              } catch(e) {
                  console.error("Error parsing member data: ", e);
              }
          }
      });
  }

  function openCashPayment() {
      // Fetch the data first before opening the interface
      loadCashPaymentData();
      if (typeof main_dashboard_02_E_OPEN === "function") {
          main_dashboard_02_E_OPEN();
      } else {
          // Fallback if not inside the SPA dashboard wrapper
          window.location.href = 'Main-Dashboard_02_E_cash_payment.php';
      }
  }

  function processCashPayment() {
    console.log("Processing cash payment...");
    
    // --- GUEST OVERRIDE BINDING ---
    // If the system physically flagged an anonymous entry, wrap the manual UI inputs identically!
    if (currentCashPaymentMember && currentCashPaymentMember.id == 0) {
        currentCashPaymentMember.name_M = document.getElementById('cash-manual-name').value || "Guest";
        currentCashPaymentMember.phone_mobile = document.getElementById('cash-manual-phone').value || "";
        currentCashPaymentMember.email = document.getElementById('cash-manual-email').value || "";
        currentCashPaymentMember.residence_address_M = document.getElementById('cash-manual-address').value || "";
        currentCashPaymentMember.membership_no = "Guest";
        currentCashPaymentMember.due_to_pay = "0.00";
    }

    if (!currentCashPaymentMember) {
        var memberIdEl = document.getElementById("DashBord_Payment_body_member_list_id") || document.getElementById("selected-member-id");
        var mNo = document.getElementById("cash-payment-member-no") ? document.getElementById("cash-payment-member-no").innerText.trim() : "";
        var mName = document.getElementById("cash-payment-member-name") ? document.getElementById("cash-payment-member-name").innerText.trim() : "";
        var mAddress = document.getElementById("DashBord_Payment_body_member_list_address") ? document.getElementById("DashBord_Payment_body_member_list_address").value : "";
        var mEmail = document.getElementById("DashBord_Payment_body_member_list_email") ? document.getElementById("DashBord_Payment_body_member_list_email").value : "";
        var mPhone = document.getElementById("DashBord_Payment_body_member_list_phone_number") ? document.getElementById("DashBord_Payment_body_member_list_phone_number").value : "";
        var mDue = document.getElementById("cash-payment-due-amount") ? document.getElementById("cash-payment-due-amount").innerText.trim() : "";

        if (memberIdEl && memberIdEl.value) {
            currentCashPaymentMember = {
                id: memberIdEl.value,
                membership_no: mNo,
                name_M: mName,
                residence_address_M: mAddress,
                email: mEmail,
                phone_mobile: mPhone,
                due_to_pay: mDue
            };
        }
    }

    if (!currentCashPaymentMember) {
        alert("Error: Member data not loaded.");
        return;
    }
    
    var payingAmount = document.getElementById('cash-paying-amount').value;
    if (!payingAmount || isNaN(payingAmount) || payingAmount <= 0) {
        alert("Please enter a valid paying amount.");
        return;
    }
    
    // --- FIXED BUDGET MAXIMUM CONSTRAINT PROTECTION ---
    var paymentTypeElCsh = document.getElementById("DashBord_Payment_body_paying_type_default");
    var paymentTypeCsh = paymentTypeElCsh ? paymentTypeElCsh.value : "";
    if (paymentTypeCsh === "Projects" || paymentTypeCsh === "Project" || paymentTypeCsh === "projects") {
        var overrideFlagCsh = document.getElementById("Project_Override_Show_Due");
        if (overrideFlagCsh && overrideFlagCsh.value === "1") {
            var maxDueCsh = parseFloat(document.getElementById("DashBord_Payment_body_due_to_pay").value) || 0;
            if (parseFloat(payingAmount) > maxDueCsh) {
                alert("Cannot exceed the project's remaining fixed budget of LKR " + maxDueCsh.toLocaleString() + " !");
                return;
            }
        }
    }
    // --- END BOUNDS PROTECTION ---
    
    var sendSms = document.getElementById('cash-slip-sms').checked;
    var sendEmail = document.getElementById('cash-slip-email').checked;
    var printSlip = document.getElementById('cash-slip-print').checked;
    
    // Determine dynamic reason flag based on hidden select state
    var paymentTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");
    var paymentType = paymentTypeEl && typeof normalizeMainDashboardPaymentReason === 'function'
        ? normalizeMainDashboardPaymentReason(paymentTypeEl.value)
        : '';
    var reasonField = typeof getMainDashboardPaymentReasonFlag === 'function'
        ? getMainDashboardPaymentReasonFlag(paymentType)
        : '';
    if (!reasonField) {
        alert('Please select Subscription, Zakath, Donation, or Projects before submitting.');
        return;
    }
    var reasonFlag = '&' + reasonField + '=1';
    
    // Always pass the project ID conditionally mapping it if needed backend, regardless of "Donation" or "Projects" type
    var projId = document.getElementById("payment_selected_project_id");
    var projNameEl = document.getElementById("payment_selected_project_name");
    
    if (projId && projId.value) {
        reasonFlag += "&wwjm_projects_collection_list_id=" + encodeURIComponent(projId.value);
        if (projNameEl && projNameEl.value) {
            reasonFlag += "&wwjm_projects_collection_list_name=" + encodeURIComponent(projNameEl.value);
        }
    }

    var tickJsonEl = document.getElementById("payment_selected_tickets_json");
    if (tickJsonEl && tickJsonEl.value) {
        reasonFlag += "&payment_selected_tickets_json=" + encodeURIComponent(tickJsonEl.value);
    }
    
    var isMemberFlag = (currentCashPaymentMember.id == 0) ? 0 : 1; // Structurally block internal member array assignments if physically guest!

    var sending_value = "val_01=" + encodeURIComponent(payingAmount) +
                        "&val_02=0" +
                        "&val_03=" + encodeURIComponent(currentCashPaymentMember.name_M || "") +
                        "&val_04=" + encodeURIComponent(currentCashPaymentMember.residence_address_M || "") +
                        "&val_05=" + encodeURIComponent(currentCashPaymentMember.membership_no || "") +
                        "&member_email=" + encodeURIComponent(currentCashPaymentMember.email || "") +
                        "&member_mobile_no=" + encodeURIComponent(currentCashPaymentMember.phone_mobile || "") +
                        "&bmjm_member_list_id=" + encodeURIComponent(currentCashPaymentMember.id) +
                        "&is_cash=1" +
                        "&is_member=" + isMemberFlag + 
                        reasonFlag;
                        
    // Display loading state
    var btn = document.querySelector('.payment-cash-btn-process');
    var originalText = btn.innerText;
    btn.innerText = "Processing...";
    btn.disabled = true;
    
    $.ajax({
        url: "<?php echo $pth; ?>View-List/Payment/create_bmjm_payment_slip.php",
        type: 'POST',
        data: sending_value,
        cache: false,
        success: function(data) {
            btn.innerText = originalText;
            btn.disabled = false;
            
            try {
                var json = eval(data);
                if (json && json[0] && json[0].error === "0") {
                    alert("Payment submitted successfully! Receipt ID: " + json[0].id);
                    document.getElementById('cash-paying-amount').value = "";
                    
                    // You could add logic here to trigger SMS/Email or open print view based on checkboxes
                    if (typeof main_dashboard_02_C_OPEN === "function") {
                        // Return to member list on success
                        main_dashboard_02_C_OPEN();
                    }
                } else {
                    alert("Failed to submit payment: " + (json[0].error || "Unknown error"));
                }
            } catch(e) {
                console.error("Payment submission error:", e, data);
                alert("An error occurred while submitting the payment.");
            }
        },
        error: function() {
            btn.innerText = originalText;
            btn.disabled = false;
            alert("Network error occurred. Please try again.");
        }
    });
  }
</script>
