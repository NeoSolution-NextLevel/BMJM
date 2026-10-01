<!-- C:\xampp\htdocs\NeoSolutionCompanyWebsite\UxUi-Back\Dash-Bord\Blog-List\JS\type_of_blog\blog_setup_01_list_data_JS.php -->
<script type="text/javascript">
    function load_type_of_blog_list() {

        var search_txt = document.getElementById("blog_ui4_blog_type_list_search_txt").value;
        var get_body = document.getElementById("type_of_blog_list_btn_type_list_data_SET_DB");
        $(get_body).empty();
        // var sending_value = "search_type_of_blog_like=" + get_seach_val;
        // alert(sending_value);


        
        sending_value = "search_type_of_blog_like=" + encodeURIComponent(search_txt);

        $.ajax({
            type: "POST",
            url: "<?php echo $pth; ?>View-List/Main/Blog/type_of_blogs/list_type_of_blogs.php",
            data: sending_value,
            success: function(data) {
                // alert(data);
               


                var json_decode = JSON.parse(data);
                console.log(json_decode);
                if (json_decode.length == 0) {
                    $(get_body).empty();

                    load_blog_type_to_body_response_empty_content(get_body, "Blog Type");


                    return;
                }
                for (var i = 0; i < json_decode.length; i++) {


                    console.log(json_decode[i]);
                    load_blog_type_to_body(json_decode[i]);
                }
                if (json_decode.length === 0) {

                }

            }
        });
    }



    function load_blog_type_to_body(json_data) {

        // MAIN CONTAINER
        const typeContainer = document.getElementById("type_of_blog_list_btn_type_list_data_SET_DB");

        // ================= BLOG TYPE ROW =================
        const blogTypeRow = document.createElement("div");
        blogTypeRow.className = "blog4-erp-blogtype-row";
        blogTypeRow.setAttribute("data-name", json_data.type_of_blog);
        blogTypeRow.setAttribute("data-status", "active");

        // ================= NAME SECTION =================
        const nameDiv = document.createElement("div");
        nameDiv.className = "blog4-erp-blogtype-row__name";

        // ICON
        const iconDiv = document.createElement("div");
        iconDiv.className = "blog4-erp-blogtype-row__icon";
        iconDiv.innerHTML = `
<svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
  <path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z" />
</svg>
`;

        // NAME TEXT
        const nameSpan = document.createElement("span");
        nameSpan.textContent = json_data.type_of_blog;

        // append icon + name
        nameDiv.appendChild(iconDiv);
        nameDiv.appendChild(nameSpan);

        // ================= STATUS =================
        const statusDiv = document.createElement("div");

        if (json_data.active_state == "1") {
            statusDiv.className = "blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--active";
            statusDiv.textContent = "Active";

        } else {
            statusDiv.className = "blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--inactive";
            statusDiv.textContent = "Inactive";


        }


        // ================= ACTIONS =================
        const actionsDiv = document.createElement("div");
        actionsDiv.className = "blog4-erp-blogtype-row__actions";

        // DELETE BUTTON
        const deleteBtn = document.createElement("button");
        deleteBtn.className = "blog4-erp-btn--edit"; // Reusing danger style for delete
        deleteBtn.setAttribute("aria-label", "Delete");
        deleteBtn.innerHTML = `
<svg viewBox="0 0 24 24" width="16" height="16">
  <path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
</svg>
`;
        deleteBtn.onclick = function() {
            deleteBlogType(json_data.id);
        };

        // DEACTIVATE BUTTON
        const deactivateBtn = document.createElement("button");

        if (json_data.active_state == "1") {
            deactivateBtn.className = "blog4-erp-btn--action blog4-erp-btn--danger";
            deactivateBtn.textContent = "Deactivate";

            deactivateBtn.onclick = function() {
                blog_setup_01_list_data_active_deactive_state_change(json_data.id, "1");
            };


        } else {
            deactivateBtn.className = "blog4-erp-btn--action blog4-erp-btn--activate";
            deactivateBtn.textContent = "Activate";

            deactivateBtn.onclick = function() {
                blog_setup_01_list_data_active_deactive_state_change(json_data.id, "0");
            };



        }


        // append buttons (changed order)
        actionsDiv.appendChild(deactivateBtn); // Activate/Deactivate first
        actionsDiv.appendChild(deleteBtn); // Delete button second

        // ================= FINAL APPEND =================
        blogTypeRow.appendChild(nameDiv);
        blogTypeRow.appendChild(statusDiv);
        blogTypeRow.appendChild(actionsDiv);

        typeContainer.appendChild(blogTypeRow);

    }

    // Placeholder function for deleting a blog type
    function deleteBlogType(blog_id) {

        var sending_value = "id=" + encodeURIComponent(blog_id) + "&remove_list=0";

        // alert(sending_value);
        $.ajax({
            type: "POST",
            url: "<?php echo $pth; ?>View-List/Main/Blog/type_of_blogs/add_update_type_of_blog.php",
            data: sending_value,
            success: function(data) {
                // alert(data);
                var json = JSON.parse(data);
                if (json.length == 0) {
                    load_type_of_blog_list();
                } else {
                    console.log(json[0].error);
                }

            }
        });
        // Future implementation would go here
    }

    function blog_setup_01_list_data_active_deactive_state_change(id, state) {
        var sending_value = "id=" + id;
        if (state == 0) {
            sending_value += "&active_state=0";
        } else {
            sending_value += "&deactive_state=1";
        }
        // alert(sending_value);
        $.ajax({
            type: "POST",
            url: "<?php echo $pth; ?>View-List/Main/Blog/type_of_blogs/add_update_type_of_blog.php",
            data: sending_value,
            success: function(data) {
                // alert(data);
                var json = JSON.parse(data);
                if (json.length == 0) {
                    load_type_of_blog_list();
                } else {
                    console.log(json[0].error);
                }

            }
        });

    }
</script>