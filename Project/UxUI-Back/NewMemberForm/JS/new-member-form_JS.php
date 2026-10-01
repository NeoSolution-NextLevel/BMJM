    <!-- <script type="text/javascript">
        function New_member_front_from_01_SUBMIT(event) {

            event.preventDefault();
            // preloader_show();


            var savedRoadId = localStorage.getItem("selectedRoadId");
            // alert(savedRoadId);

            var val_01 = document.getElementById("New_member_front_form_from_01_val_01"); // name
            var val_02 = document.getElementById("New_member_front_form_from_01_val_02"); //residensce address

            // type radio buttons
            var val_04_check_01 = document.getElementById("New_member_front_form_from_01_val_04_check_01"); // owner
            var val_04_check_02 = document.getElementById("New_member_front_form_from_01_val_04_check_02"); // tenant


            var val_05 = document.getElementById("New_member_front_form_from_01_val_05"); // NIC No
            // var val_07 = document.getElementById("New_member_front_form_from_01_val_07"); //residence

            // var val_08 = document.getElementById("New_member_front_form_from_01_val_08"); 
            var val_09 = document.getElementById("New_member_front_form_from_01_val_09"); //mobile

            var val_10 = document.getElementById("New_member_front_form_from_01_val_10"); //whatsapp
            var val_11 = document.getElementById("New_member_front_form_from_01_val_11"); //mobile data

            var val_12 = document.getElementById("New_member_front_form_from_01_val_12"); //email
            var val_13 = document.getElementById("New_member_front_form_from_01_val_13"); //profession

            var val_15 = document.getElementById("New_member_front_form_from_01_val_15"); //monthly maintain amount
            // var val_16 = document.getElementById("New_member_front_form_from_01_val_16"); //membership no
            var val_17 ="0";
            //var val_17 = document.getElementById("New_member_front_form_from_01_val_17"); //opening balance

            var val_21 = document.getElementById("New_member_front_form_from_01_val_21"); //interducer_name_01
            var val_22 = document.getElementById("New_member_front_form_from_01_val_22"); //interducer_membership_no_01
            var val_23 = document.getElementById("New_member_front_form_from_01_val_23"); //interducer_contact_01

            var val_24 = document.getElementById("New_member_front_form_from_01_val_24"); //interducer_name_02
            var val_25 = document.getElementById("New_member_front_form_from_01_val_25"); //interducer_membership_no_02
            var val_26 = document.getElementById("New_member_front_from_01_val_26"); //interducer_contact_02

            var val_20 = savedRoadId;

            // send type  radio buttons
            var val_18_check_01 = document.getElementById("New_member_front_form_from_01_val_18_check_01"); // sms
            var val_18_check_02 = document.getElementById("New_member_front_form_from_01_val_18_check_01"); // email

            if (!val_04_check_01.checked && !val_04_check_02.checked) {
                create_error(
                    document.getElementById("front_member_road_id"),
                    'member_create_front_error_msg',
                    "Please select at least one option (Own House or Rented House)."
                );
                return;
            }

            // alert("member road id : " + val_20.value);

            // Build the data string
            var sending_value =
                "&val_01=" + encodeURIComponent(val_01.value) +
                "&val_02=" + encodeURIComponent(val_02.value) +
                // "&val_03=" + encodeURIComponent(selectedName) +
                "&val_05=" + encodeURIComponent(val_05.value) +
                // "&val_07=" + encodeURIComponent(val_07.value) +
                // "&val_08=" + encodeURIComponent(val_08.value) +
                "&val_09=" + encodeURIComponent(val_09.value) +
                "&val_10=" + encodeURIComponent(val_10.value) +
                "&val_11=" + encodeURIComponent(val_11.value) +
                "&val_12=" + encodeURIComponent(val_12.value) +
                "&val_13=" + encodeURIComponent(val_13.value) +
                "&val_15=" + encodeURIComponent(val_15.value) +
                // "&val_16=" + encodeURIComponent(val_16.value) +
                "&val_17=" + encodeURIComponent(val_17) +
                "&val_20=" + encodeURIComponent(val_20) +
                "&val_21=" + encodeURIComponent(val_21.value) +
                "&val_22=" + encodeURIComponent(val_22.value) +
                "&val_23=" + encodeURIComponent(val_23.value) +
                "&val_24=" + encodeURIComponent(val_24.value) +
                "&val_25=" + encodeURIComponent(val_25.value) +
                "&val_26=" + encodeURIComponent(val_26.value);



            if (val_04_check_01.checked) {
                sending_value = sending_value + "&owner=0";
                // alert(val_04_check_01.checked);
            }


            if (val_04_check_02.checked) {
                sending_value = sending_value + "&tenant=0";
            }

            sending_value += "&self_account=0";
            sending_value += "&front_form=0";

            // // Validate type selection

            // if (val_18_check_01.checked) {
            //     sending_value = sending_value + "&sms=0";
            // } else if (val_18_check_02.checked) {
            //     sending_value = sending_value + "&email=0";
            // }
            $.ajax({
                url: "<?php echo $pth; ?>View-List/Member/create_member.php",
                type: "POST",
                data: sending_value,
                success: function(res) {
                    // alert(res);

                    var json = JSON.parse(res);
                    if (json[0].error === "0") {
                        new_member_form_email_notification();

                        // alert("Member saved successfully");

                    } else {
                        alert(json[0].error);
                    }

                }
            });
        }


        function new_member_form_email_notification() {
            window.location.href = "<?php echo $pth; ?>index.php";


        }
    </script> -->



    <script type="text/javascript">
        function New_member_front_from_01_SUBMIT(event) {
            event.preventDefault();

            // --- 1. SETUP & ERROR HANDLING ---
            var errorBody = document.getElementById("body_01_01_C_01_error_msg_body");
            var errorMsg = document.getElementById("member_create_front_error_msg");

            // Reset Error State
            errorBody.style.display = "none";
            errorMsg.innerText = "";

            // Helper function to stop process and show error
            function triggerError(message, element) {
                errorBody.style.display = "block";
                errorMsg.innerText = message;
                if (element) {
                    element.focus();
                    // Optional: Highlight border
                    // element.style.border = "1px solid red"; 
                }
                return false;
            }

            // --- 2. GET DOM ELEMENTS ---
            var savedRoadId = localStorage.getItem("selectedRoadId");
            var val_01 = document.getElementById("New_member_front_form_from_01_val_01"); // name
            var val_02 = document.getElementById("New_member_front_form_from_01_val_02"); // address
            var val_04_check_01 = document.getElementById("New_member_front_form_from_01_val_04_check_01"); // owner
            var val_04_check_02 = document.getElementById("New_member_front_form_from_01_val_04_check_02"); // tenant
            var val_05 = document.getElementById("New_member_front_form_from_01_val_05"); // NIC
            var val_09 = document.getElementById("New_member_front_form_from_01_val_09"); // secondary mobile
            var val_10 = document.getElementById("New_member_front_form_from_01_val_10"); // whatsapp
            var val_11 = document.getElementById("New_member_front_form_from_01_val_11"); // mobile data checkbox
            var val_12 = document.getElementById("New_member_front_form_from_01_val_12"); // email
            var val_13 = document.getElementById("New_member_front_form_from_01_val_13"); // profession
            var val_15 = document.getElementById("New_member_front_form_from_01_val_15"); // amount
            var val_17 = "0";

            // Recommenders
            var val_21 = document.getElementById("New_member_front_form_from_01_val_21");
            var val_22 = document.getElementById("New_member_front_form_from_01_val_22"); // Rec 1 Mem No
            var val_23 = document.getElementById("New_member_front_form_from_01_val_23");
            var val_24 = document.getElementById("New_member_front_form_from_01_val_24");
            var val_25 = document.getElementById("New_member_front_form_from_01_val_25"); // Rec 2 Mem No
            var val_26 = document.getElementById("New_member_front_from_01_val_26");

            var val_20 = savedRoadId;

            // --- 3. VALIDATIONS ---

            // A. Basic Required Fields
            if (val_01.value.trim() === "") return triggerError("Please enter the Member Name.", val_01);
            if (val_02.value.trim() === "") return triggerError("Please enter the Residence Address.", val_02);

            // B. Radio Buttons (Own/Rent)
            if (!val_04_check_01.checked && !val_04_check_02.checked) {
                return triggerError("Please select at least one option (Own House or Rented House).", null);
            }

            // C. NIC Validation (Sri Lanka: 9 digits+V/X OR 12 digits)
            var nicPattern = /^([0-9]{9}[vVxX]|[0-9]{12})$/;
            if (!nicPattern.test(val_05.value.trim())) {
                return triggerError("Invalid NIC format. Example: 123456789V or 199012345678", val_05);
            }

            // D. WhatsApp Validation (Clean spaces, check 07x format)
            var cleanWA = val_10.value.replace(/[\s-]/g, ''); // Remove spaces/dashes
            val_10.value = cleanWA; // Update the input value to the clean version

            var mobilePattern = /^07\d{8}$/; // Starts with 07, total 10 digits
            if (!mobilePattern.test(cleanWA)) {
                return triggerError("Invalid WhatsApp Number. Must be a 10-digit mobile starting with 07.", val_10);
            }

            // E. Secondary Phone Validation (Clean spaces, check 0xx format)
            var cleanSec = val_09.value.replace(/[\s-]/g, '');
            val_09.value = cleanSec; // Update input

            var phonePattern = /^0\d{9}$/; // Starts with 0, total 10 digits
            if (!phonePattern.test(cleanSec)) {
                return triggerError("Invalid Secondary Number. Must be 10 digits starting with 0.", val_09);
            }

            // F. Email Validation (Only if not empty)
            if (val_12.value.trim() !== "") {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(val_12.value.trim())) {
                    return triggerError("Please enter a valid Email Address.", val_12);
                }
            }

            // G. Profession
            if (val_13.value.trim() === "") return triggerError("Please enter the Profession.", val_13);

            // H. Amount Validation (Minimum 500)
            if (val_15.value === "" || parseFloat(val_15.value) < 500) {
                return triggerError("Monthly Subscription must be at least 500 LKR.", val_15);
            }

            // I. Recommender Validations (Ensure Membership IDs are present)
            if (val_22.value.trim() === "") return triggerError("Please enter Recommender 01 Membership Number.", val_22);
            if (val_25.value.trim() === "") return triggerError("Please enter Recommender 02 Membership Number.", val_25);


            // --- 4. PREPARE DATA FOR SENDING ---
            // (Validation passed, proceed to build string)

            var sending_value =
                "&val_01=" + encodeURIComponent(val_01.value) +
                "&val_02=" + encodeURIComponent(val_02.value) +
                "&val_05=" + encodeURIComponent(val_05.value) +
                "&val_09=" + encodeURIComponent(val_09.value) + // Now sends clean number
                "&val_10=" + encodeURIComponent(val_10.value) + // Now sends clean number
                "&val_11=" + encodeURIComponent(val_11.value) +
                "&val_12=" + encodeURIComponent(val_12.value) +
                "&val_13=" + encodeURIComponent(val_13.value) +
                "&val_15=" + encodeURIComponent(val_15.value) +
                "&val_17=" + encodeURIComponent(val_17) +
                "&val_20=" + encodeURIComponent(val_20) +
                "&val_21=" + encodeURIComponent(val_21.value) +
                "&val_22=" + encodeURIComponent(val_22.value) +
                "&val_23=" + encodeURIComponent(val_23.value) +
                "&val_24=" + encodeURIComponent(val_24.value) +
                "&val_25=" + encodeURIComponent(val_25.value) +
                "&val_26=" + encodeURIComponent(val_26.value);

            if (val_04_check_01.checked) {
                sending_value = sending_value + "&owner=0";
            }

            if (val_04_check_02.checked) {
                sending_value = sending_value + "&tenant=0";
            }

            sending_value += "&self_account=0";
            sending_value += "&front_form=0";

            // --- 5. AJAX SUBMISSION ---
            $.ajax({
                url: "<?php echo $pth; ?>View-List/Member/create_member.php",
                type: "POST",
                data: sending_value,
                success: function(res) {
                    // alert(res);
                    try {
                        var json = JSON.parse(res);
                        if (json[0].error === "0") {
                            window.location.href = "<?php echo $home_page_url; ?>";

                        } else {

                            document.getElementById("new_member_form_error_content").style.display = "block";
                            document.getElementById("new_member_form_error_content_text").innerText = "";
                            document.getElementById("new_member_form_error_content_text").innerText = json[0].error;
                        }
                    } catch (e) {
                        console.log("JSON Parse Error: " + res);
                        alert("System Error: Invalid response from server.");
                    }
                }
            });
        }

        function new_member_form_email_notification() {
            window.location.href = "<?php echo $home_page_url; ?>";
        }
    </script>