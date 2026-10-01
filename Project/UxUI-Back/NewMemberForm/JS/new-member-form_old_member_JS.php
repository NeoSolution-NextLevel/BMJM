    <script type="text/javascript">
        function Old_member_front_from_01_SUBMIT(event) {

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
            var val_17 = document.getElementById("New_member_front_form_from_01_val_17"); //opening balance


            var val_20 = savedRoadId;

            var val_27 = document.getElementById("New_member_front_form_from_01_val_27"); //Membership  No


            // alert("member road id : " + val_20.value);

            // Build the data string
            var sending_value =
                "val_01=" + encodeURIComponent(val_01.value) +
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
                "&val_17=" + encodeURIComponent(val_17.value) +
                "&val_20=" + encodeURIComponent(val_20) +
                "&val_27=" + encodeURIComponent(val_27.value) +
                "&account_type_subcrption=0";



            if (val_04_check_01.checked) {
                sending_value = sending_value + "&owner=0";
                // alert(val_04_check_01.checked);
            }


            if (val_04_check_02.checked) {
                sending_value = sending_value + "&tenant=0";
            }

            sending_value += "&self_account=0";
            sending_value += "&front_form=0" + "&existing_member_check=0";


            // alert(sending_value);

            $.ajax({
                url: "<?php echo $pth; ?>View-List/Member/create_member.php",
                type: "POST",
                data: sending_value,
                success: function(res) {

                    var json = JSON.parse(res);
                    if (json[0].error === "0") {
                        window.location.href = "<?php echo $home_page_url; ?>";
                    } else {
                        document.getElementById("new_member_form_old_member_error_content").style.display = "block";
                        document.getElementById("new_member_form_old_member_error_txt").innerText = " ";

                        document.getElementById("new_member_form_old_member_error_txt").innerText = json[0].error;
                    }

                }
            });
        }
    </script>