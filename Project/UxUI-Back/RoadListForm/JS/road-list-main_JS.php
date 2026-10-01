<script type="text/javascript">
    function load_member_road_front_list() {
        //        alert("test 1");
        var front_member_road_data_bodydata_body_1 = document.getElementById("front_member_road_data_bodydata_body_1");


        var member_list_search_txt_obj = document.getElementById("member_road_front_search_txt");
        var searchTxt = member_list_search_txt_obj ? member_list_search_txt_obj.value.trim() : "";



        $(front_member_road_data_bodydata_body_1).empty();

        var page_count = 0;

        // var sending_value = "searchTxt=" + encodeURIComponent(searchTxt);

        var sending_value = {
            search_txt: searchTxt
        };

        // alert("test");


        // alert("text 1");
        //        alert(sending_value);
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/road_view.php",
            type: "POST",
            data: sending_value,
            catch: false,
            success: function(response) {
                console.log(response);

                var json_data = JSON.parse(response);
                if (json_data.length == 0) {
                    var div_row = document.createElement("div");
                    div_row.setAttribute("class", "row w3-margin-top");
                    var col = document.createElement("div");
                    col.setAttribute("class", "col-lg-12 w3-center w3-padding-16 w3-topbar w3-bottombar");
                    col.appendChild(document.createTextNode("No Road Found "));
                    div_row.appendChild(col);
                    front_member_road_data_bodydata_body_1.appendChild(div_row);
                } else {
                    for (var i = 0; i < json_data.length; i++) {
                        load_member_road_front_list_data(json_data[i]);
                    }
                }
            }
        });
    }

    function load_member_road_front_list_data(json) {
        var container = document.getElementById("front_member_road_data_bodydata_body_1");

        // Create li
        var li = document.createElement("li");
        li.setAttribute("class", "road-item");

        // Create span for road name
        var span = document.createElement("span");
        span.setAttribute("class", "road-name");
        span.textContent = json.road_name;

        // Create "Select" link
        var a = document.createElement("a");
        a.setAttribute("class", "select-btn");
        a.textContent = "Select";

        // Add click event (instead of just link)
        a.addEventListener("click", function(e) {
            e.preventDefault(); // stop normal navigation

            // Save selected road ID
            localStorage.setItem("selectedRoadId", json.id);

            var memberType = document.getElementById("road_list_main_member_type");

            if (memberType.value == "new") {
                window.location.href = "<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>";

            } else if (memberType.value == "old") {
                window.location.href = "<?php echo $pth; ?>UxUI-Back/NewMemberForm/new-member-form_old_member<?php echo $online_offline_extention; ?>";
            }

            // Redirect manually
        });

        // Append span and a into li
        li.appendChild(span);
        li.appendChild(a);

        // Append li into UL container
        container.appendChild(li);
    }


    load_member_road_front_list();
</script>