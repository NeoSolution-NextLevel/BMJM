<!-- C:\xampp\htdocs\NeoSolutionCompanyWebsite\UxUi-Back\Dash-Bord\Blog-List\JS\body_01_01_C_JS.php -->
<script type="text/javascript">
    function load_blog_list() {
        const container = document.getElementById("blog_list_btn_list_blog_container_data_SET_list");
        $(container).empty();

        var seaarch_txt = document.getElementById("blog_ui6_Blog_list_search_txt").value;

        var sending_value = "search_txt=" + encodeURIComponent(seaarch_txt) + "&count=0";


        // alert(sending_value);
       


        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/View_Blog.php",
            type: "POST",
            data: sending_value,
            dataType: "json",
            success: function(json) {
                // alert(json);
                console.log(json);
               
                // console.log("JSON:", json);

                if (json[0].count == 0) {
                    // Handle empty response
                    $(container).empty();

                    load_blog_type_to_body_response_empty_content(container, "Blog");
                    return;

                } else {
                    var get_pagination_button_body = document.getElementById("blog_ui6_Blog_list_PAGINATION_BUTTON_BODY");
                    $(get_pagination_button_body).empty();
                    var iProcut_count = 0;
                    var get_total_count_txt = json[0].count;
                    var get_total_count_int = parseInt(get_total_count_txt);

                    if (get_total_count_int == 0) {
                        // No data found
                    }

                    // alert("1");
                    var page_count = 0;
                    document.getElementById("pagination_total_data_count").value = get_total_count_txt;
                    var per_page_count_selector = document.getElementById("blog_ui6_Blog_list_pre_page_selector");

                    if (get_total_count_int > parseInt(per_page_count_selector.value)) {
                        var processing_data_count = parseInt(get_total_count_txt) - (get_total_count_int % parseInt(per_page_count_selector.value));
                        var no_of_page = processing_data_count / parseInt(per_page_count_selector.value);
                        if (processing_data_count == 0) {} else {
                            for (iProcut_count = 1; iProcut_count <= no_of_page; iProcut_count++) {
                                blog_ui6_Blog_list_button_list(iProcut_count);
                            }
                            iProcut_count--;
                        }
                        if ((get_total_count_int % parseInt(per_page_count_selector.value)) > 0) {
                            iProcut_count++;
                            if (iProcut_count == 1) {
                                // First page
                            } else {
                                blog_ui6_Blog_list_button_list(iProcut_count);
                            }
                        }
                    }
                    // alert("2");
                    blog_ui6_Blog_list_Selected_data("1", document.getElementById("blog_ui6_Blog_list_pre_page_selector").value);
                }
            },
            error: function(xhr) {
                console.log("ERROR RESPONSE:", xhr.responseText);
                alert("AJAX ERROR");
            }
        });



    }

    function blog_ui6_Blog_list_button_list(iProcut_count) {
        var get_pagination_button_body = document.getElementById("blog_ui6_Blog_list_PAGINATION_BUTTON_BODY");
        var btn = document.createElement("button");
        btn.setAttribute("class", "erp-action-btn erp-action-btn--edit");
        btn.setAttribute("style", "min-width:30px; padding:6px 10px; margin-right:4px;");
        btn.setAttribute("id", "blog_ui6_Blog_list_pagination_" + iProcut_count);
        btn.appendChild(document.createTextNode(iProcut_count));
        get_pagination_button_body.appendChild(btn);
        btn.addEventListener("click", function() {
            blog_ui6_Blog_list_Selected_data(iProcut_count, document.getElementById("blog_ui6_Blog_list_pre_page_selector").value);
        });
    }




    function blog_ui6_Blog_list_Selected_data(st_count, per_page) {
        var get_body = document.getElementById("Member_body_01_A_JS_Member_List_data_body");
        $(get_body).empty();

        if (parseInt(document.getElementById("pagination_total_data_count").value) > parseInt(document.getElementById("blog_ui6_Blog_list_pre_page_selector").value)) {
            document.getElementById("blog_ui6_Blog_list_pagination_" + st_count).disabled = true;


            if (document.getElementById("pagination_total_holder_id").value == "0") {
                // First page
            } else {
                var get_button_obj = document.getElementById("blog_ui6_Blog_list_pagination_" + document.getElementById("blog_ui6_Blog_list_pagination_holder_id").value);
                // get_button_obj.disabled = false;
            }
            document.getElementById("blog_ui6_Blog_list_pagination_holder_id").value = st_count;
        }


        var start_count_int = (parseInt(st_count) - 1) * parseInt(document.getElementById("blog_ui6_Blog_list_pre_page_selector").value);
        var sending_value = "st_count=" + start_count_int + "&per_page=" + per_page + "&page_data=0";

        // alert(sending_value);

        var seaarch_txt = document.getElementById("blog_ui6_Blog_list_search_txt").value;

        sending_value += "&search_txt=" + encodeURIComponent(seaarch_txt);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/View_Blog.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function(data, textStatus, jqXHR) {
                // alert(data);
                console.log(data);
                var json = eval(data);
                if (json.length == 0) {

                } else {
                    // alert(json.length);
                    for (var i = 0; i < json.length; i++) {
                        load_blog_data(json[i])
                    }
                }
            }
        });
    }

    function load_blog_data(blog) {
        // main container
        const blogContainer = document.getElementById("blog_list_btn_list_blog_container_data_SET_list");

        // ================= BLOG ITEM CARD =================
        const blogItem = document.createElement("div");
        blogItem.className = "erp-blog-item";

        // ================= THUMBNAIL =================
        const thumbDiv = document.createElement("div");
        thumbDiv.className = "erp-thumbnail";

        const blogImg = document.createElement("img");
        blogImg.src = "<?php echo $home_page; ?>" + blog.image_path;
        blogImg.alt = "Tech Blog";

        // onerror fallback
        blogImg.onerror = function() {
            this.style.display = "none";
            this.parentElement.textContent = "No Image";
        };

        thumbDiv.appendChild(blogImg);

        // ================= CONTENT =================
        const blogContent = document.createElement("div");
        blogContent.className = "erp-blog-content";

        // title
        const blogTitle = document.createElement("h3");
        blogTitle.className = "erp-blog-title";
        blogTitle.textContent = blog.heading;

        // status span
        const statusSpan = document.createElement("span");
        statusSpan.className = "erp-status erp-status-active";

        if (blog.show_on_all_blogs == "1") {
            statusSpan.className = "erp-status erp-status-active";

            statusSpan.textContent = "Active";
        } else {
            statusSpan.className = "erp-status erp-status-hidden";
            statusSpan.textContent = "Hide";

        }

        blogTitle.appendChild(statusSpan);

        // meta
        const blogMeta = document.createElement("div");
        blogMeta.className = "erp-blog-meta";
        blogMeta.textContent = blog.key_words;

        // excerpt
        const blogExcerpt = document.createElement("p");
        blogExcerpt.className = "erp-blog-excerpt";
        blogExcerpt.textContent = blog.seo_dis;

        // append content
        blogContent.appendChild(blogTitle);
        blogContent.appendChild(blogMeta);
        blogContent.appendChild(blogExcerpt);

        // ================= ACTION BUTTONS =================
        const blogActions = document.createElement("div");
        blogActions.className = "erp-blog-actions";

        // Hide button
        const btnHide = document.createElement("button");

        if (blog.show_on_all_blogs == "1") {
            btnHide.className = "erp-btn-action erp-btn-red";
            btnHide.textContent = "Hide";


            btnHide.onclick = function() {
                show_hide_on_web_blog(blog.id, "hide")
            };




        } else {
            btnHide.className = "erp-btn-action erp-btn-blue";
            btnHide.style = "background: var(--erp-accent-success)";
            btnHide.textContent = "Show";

            btnHide.onclick = function() {
                show_hide_on_web_blog(blog.id, "show")
            };




        }



        // Update button
        const btnUpdate = document.createElement("button");
        btnUpdate.className = "erp-btn-action erp-btn-blue";
        btnUpdate.textContent = "Update";
        btnUpdate.onclick = function() {
            document.getElementById("blog_ui5_add_blog_and_update_blog_id").value = blog.id;
            Blog_List_button_Main_dash_bord_add_blog_OPEN("update_blog");
        };

        // View button

        // btnView.innerHTML = `<i class="fa fa-globe"></i>`; // Changed to world icon
        const btnView = document.createElement("a");
        btnView.className = "erp-btn-action erp-btn-icon-only erp-btn-blue";
        btnView.title = "View";
        btnView.innerHTML = `<i class="fa fa-globe"></i>`;
        btnView.target = "_blank";
        btnView.rel = "noopener noreferrer";

        <?php if ($online_state) { ?>
            btnView.href = "<?php echo $company_obj->get_compnay_full_web(); ?>My-Blog/" + blog.url_data;
        <?php } else { ?>
            btnView.href = "<?php echo $company_obj->get_compnay_full_web(); ?>Hidden-Blog.php?url=" + blog.url_data;
        <?php } ?>

        // Delete button (NEW)
        const btnDelete = document.createElement("button");
        btnDelete.className = "erp-btn-action erp-btn-icon-only erp-btn-gray"; // Changed from erp-btn-red to erp-btn-gray
        btnDelete.title = "Delete";
        btnDelete.innerHTML = `<i class="fa fa-trash"></i>`; // Font Awesome trash icon
        btnDelete.onclick = function() {
            remove_image_in_saved_project_in_single_blog(blog.id, blog.image_path, blog.url_data);
        };


        // append buttons (NEW ORDER)
        blogActions.appendChild(btnUpdate);
        blogActions.appendChild(btnHide);
        blogActions.appendChild(btnView);
        blogActions.appendChild(btnDelete); // Delete button after View

        // ================= FINAL APPEND =================
        blogItem.appendChild(thumbDiv);
        blogItem.appendChild(blogContent);
        blogItem.appendChild(blogActions);

        blogContainer.appendChild(blogItem);



    }





    function remove_image_in_saved_project_in_single_blog(blog_id, image_pth, url_data) {

        var sending_value = "pth_of_image=" + encodeURIComponent(image_pth);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_remove.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);

                deleteblog_list_single_item(blog_id, url_data)
            },
            error: function(err) {
                console.error("Failed to update blog visibility", err);
            }
        });


    }

    function deleteblog_list_single_item(blog_id, url_data) {

        var sending_value = "id=" + encodeURIComponent(blog_id) + "&remove_blog_item=1&remove_url_data_file=" + encodeURIComponent(url_data);



        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/Updata_blog_data.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                load_blog_list(true);
            },
            error: function(err) {
                console.error("Failed to update blog visibility", err);
            }
        });

    }


    function show_hide_on_web_blog(id, type_of_show) {
        var sending_value = "";
        if (type_of_show === "show") {
            sending_value = "id=" + id + "&show_data=1&show_state=1&update_blog_edite_romve=0";
        } else if (type_of_show === "hide") {
            sending_value = "id=" + id + "&hide_data=0&show_state=0&update_blog_edite_romve=0";
        }


        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/Updata_blog_data.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                load_blog_list(true);
            },
            error: function(err) {
                console.error("Failed to update blog visibility", err);
            }
        });
    }
</script>