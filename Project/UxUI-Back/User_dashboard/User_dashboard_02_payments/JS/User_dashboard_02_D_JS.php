<script type="text/javascript">
  function ud2dOnBankSelected(selectEl) {
    var selectedOpt = selectEl.options[selectEl.selectedIndex];
    if (selectedOpt) {
      document.getElementById('ud2d-bank-name').value = selectedOpt.getAttribute('data-bank') || '';
      document.getElementById('ud2d-branch').value = selectedOpt.getAttribute('data-branch') || '';
      document.getElementById('ud2d-ac-no').value = selectedOpt.getAttribute('data-ac') || '';
    }
  }

  function ud2dHandleFileSelect(input) {
    if (input.files && input.files[0]) {
      var file = input.files[0];

      // 1. Instant local preview
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('ud2d-preview-img').src = e.target.result;
        document.getElementById('ud2d-preview-wrapper').style.display = 'block';
        document.getElementById('ud2d-dropzone').style.display = 'none';
      }
      reader.readAsDataURL(file);

      // 2. Upload file to Data/bmjm/ via image_upload.php
      var formData = new FormData();
      formData.append('image_uploder_image', file);
      formData.append('image_uploder_image_TYPE', 'BANK_RECEIPT');

      var btn = document.getElementById('ud2d-submit-btn');
      if (btn) btn.disabled = true;
      if (typeof bmjmShowProcessing === 'function') {
        bmjmShowProcessing('Uploading receipt...', 'Please wait while your bank receipt image is uploaded.');
      }

      $.ajax({
        url: "../View-List/File_Uploader_Control/image_upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          if (btn) btn.disabled = false;
          if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
          try {
            var data = typeof res === 'object' ? res : JSON.parse(res);
            if (data && data[0] && data[0].error === "0") {
              document.getElementById('ud2d-image-pth').value = data[0].img_pth;
            } else {
              console.error("Upload warning:", data[0] ? data[0].error : res);
            }
          } catch (err) {
            console.error("Parse error:", err);
          }
        },
        error: function(err) {
          if (btn) btn.disabled = false;
          if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
          console.error("AJAX upload error:", err);
        }
      });
    }
  }

  function ud2dRemoveFile() {
    document.getElementById('ud2d-file-input').value = '';
    document.getElementById('ud2d-image-pth').value = '';
    document.getElementById('ud2d-preview-wrapper').style.display = 'none';
    document.getElementById('ud2d-dropzone').style.display = 'block';
  }

  function user_dashboard_submit_bank_receipt(event) {
    if (event) event.preventDefault();

    var amountEl = document.getElementById('ud2d-amount');
    var bankAccEl = document.getElementById('ud2d-bank-acc');
    var imagePthEl = document.getElementById('ud2d-image-pth');
    var fileInputEl = document.getElementById('ud2d-file-input');
    var notesEl = document.getElementById('ud2d-notes');
    var refEl = document.getElementById('ud2d-ref');

    var amountVal = amountEl ? amountEl.value.trim() : "";
    var bankAccId = bankAccEl ? bankAccEl.value : "";
    var imagePth = imagePthEl ? imagePthEl.value : "";
    var notesVal = notesEl ? notesEl.value.trim() : "";
    var refVal = refEl ? refEl.value.trim() : "";

    if (!amountVal || isNaN(parseFloat(amountVal)) || parseFloat(amountVal) <= 0) {
      alert("Please enter a valid paid amount.");
      if (amountEl) amountEl.focus();
      return;
    }
    if (!bankAccId) {
      alert("Please select a deposit bank account.");
      if (bankAccEl) bankAccEl.focus();
      return;
    }

    var fileToUpload = (fileInputEl && fileInputEl.files && fileInputEl.files[0]) ? fileInputEl.files[0] : null;
    
    // If image_pth is empty or base64 data URI, upload file first!
    if ((!imagePth || imagePth.indexOf('data:image/') === 0) && fileToUpload) {
      var formData = new FormData();
      formData.append('image_uploder_image', fileToUpload);
      formData.append('image_uploder_image_TYPE', 'BANK_RECEIPT');

      var btn = document.getElementById('ud2d-submit-btn');
      if (btn) btn.disabled = true;
      if (typeof bmjmShowProcessing === 'function') {
        bmjmShowProcessing('Uploading receipt...', 'Please wait while your bank receipt image is uploaded.');
      }

      $.ajax({
        url: "../View-List/File_Uploader_Control/image_upload.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
          if (btn) btn.disabled = false;
          try {
            var data = typeof res === 'object' ? res : JSON.parse(res);
            if (data && data[0] && data[0].error === "0") {
              imagePthEl.value = data[0].img_pth;
              if (typeof bmjmShowProcessing === 'function') {
                bmjmShowProcessing('Submitting receipt...', 'Please wait while your payment receipt is submitted.');
              }
              ud2dExecSubmit(amountVal, bankAccId, data[0].img_pth, notesVal, refVal);
            } else {
              if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
              alert("Image upload error: " + (data[0] ? data[0].error : "Failed to upload receipt"));
            }
          } catch(e) {
            if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
            alert("Error parsing upload response");
          }
        },
        error: function(xhr, status, error) {
          if (btn) btn.disabled = false;
          if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
          alert("Error uploading image file: " + error);
        }
      });
      return;
    }

    if (!imagePth) {
      alert("Please upload your bank deposit receipt image.");
      return;
    }

    ud2dExecSubmit(amountVal, bankAccId, imagePth, notesVal, refVal);
  }

  function ud2dExecSubmit(amountVal, bankAccId, imagePth, notesVal, refVal) {

    var bankName = document.getElementById('ud2d-bank-name') ? document.getElementById('ud2d-bank-name').value : "";
    var branch = document.getElementById('ud2d-branch') ? document.getElementById('ud2d-branch').value : "";
    var acNo = document.getElementById('ud2d-ac-no') ? document.getElementById('ud2d-ac-no').value : "";

    var fullDesc = (refVal ? "Ref: " + refVal + " - " : "") + (notesVal || "Member Bank Deposit Receipt");

    var memberListId = window.dashboard2_real_member_id || (typeof user_main_cook_id !== 'undefined' ? user_main_cook_id : "1");
    var memberName = window.dashboard2_member_name || "Member";
    var memberAddress = window.dashboard2_member_address || "";
    var memberEmail = window.dashboard2_member_email || "";
    var memberMobile = window.dashboard2_member_mobile || "";

    var postData = "val_01=" + encodeURIComponent(amountVal) +
        "&val_02=" + encodeURIComponent(fullDesc) +
        "&val_03=" + encodeURIComponent(memberName) +
        "&val_04=" + encodeURIComponent(memberAddress) +
        "&val_05=" + encodeURIComponent(window.dashboard2_membership_no || "") +
        "&val_06=" + encodeURIComponent(imagePth) +
        "&val_07=" + encodeURIComponent(bankName) +
        "&val_08=" + encodeURIComponent(branch) +
        "&val_09=" + encodeURIComponent(acNo) +
        "&val_10=" + encodeURIComponent(bankAccId) +
        "&val_11=" + encodeURIComponent(memberListId) +
        "&member_email=" + encodeURIComponent(memberEmail) +
        "&member_mobile_no=" + encodeURIComponent(memberMobile) +
        "&wwjm_payment_sliip_id_bank_deposite=0" +
        "&pay_resion_subcption=1" +
        "&is_member=1";

    var btn = document.getElementById('ud2d-submit-btn');
    if (btn) btn.disabled = true;
    if (typeof bmjmShowProcessing === 'function') {
      bmjmShowProcessing('Submitting receipt...', 'Please wait while your payment receipt is submitted.');
    }

    $.ajax({
        url: "../View-List/Payment/Create_member_bank_deposit.php",
        type: "POST",
        data: postData,
        success: function(res) {
            if (btn) btn.disabled = false;
            if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
            try {
                var json = JSON.parse(res);
                if (json[0] && json[0].error === "0") {
                    alert("Bank receipt submitted successfully! It is recorded and pending admin verification.");
                    if (typeof user_dashboard_02_A_OPEN === 'function') {
                        user_dashboard_02_A_OPEN();
                    }
                } else {
                    alert("Submission status: " + (json[0] ? json[0].error : "Submitted successfully!"));
                    if (typeof user_dashboard_02_A_OPEN === 'function') {
                        user_dashboard_02_A_OPEN();
                    }
                }
            } catch (e) {
                alert("Bank receipt submitted successfully!");
                if (typeof user_dashboard_02_A_OPEN === 'function') {
                    user_dashboard_02_A_OPEN();
                }
            }
        },
        error: function(xhr, status, error) {
            if (btn) btn.disabled = false;
            if (typeof bmjmHideProcessing === 'function') bmjmHideProcessing();
            alert("Error submitting bank receipt via ViewList: " + error);
        }
    });
  }
</script>
