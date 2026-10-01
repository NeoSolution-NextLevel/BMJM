<script type="text/javascript">
    function neo_solution_04_list_data_list() {
        var container = document.getElementById("need_image_blog_list_of_need_image_main_container_body_data_SET_DB");
        $(container).empty();

        var search_txt = document.getElementById('blog_ui2_lis_Need_Image_in_blog_search_txt').value;

        var sending_value = "search_txt=" + encodeURIComponent(search_txt);

       

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/View_Image_List.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function(response) {
                // alert(response);
                
                // Handle the successful response here
                var json = JSON.parse(response);

                if (json.length == 0) {
                    $(container).empty();

                    load_blog_type_to_body_response_empty_single_image_list_content(container);

                    return;
                }
                for (var i = 0; i < json.length; i++) {
                    // console.log(json[i]);
                    neo_solution_04_body_01_list_data(json[i]);
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors here
            }
        });
    }

    function load_blog_type_to_body_response_empty_single_image_list_content(container) {

        // Main wrapper
        var emptyState = document.createElement("div");
        emptyState.className = "erp-blog2-empty-state";

        // Icon div
        var iconDiv = document.createElement("div");
        iconDiv.className = "erp-blog2-empty-state__icon";

        var icon = document.createElement("i");
        icon.className = "fas fa-image";

        iconDiv.appendChild(icon);

        // Title
        var title = document.createElement("h3");
        title.className = "erp-blog2-empty-state__title";
        title.innerHTML = "No Reference Images";

        // Text paragraph
        var text = document.createElement("p");
        text.className = "erp-blog2-empty-state__text";
        text.innerHTML = `
    You haven't added any reference images yet. 
    Reference images are used as inspirations and guides for your blogs.
`;

        // Button
        var button = document.createElement("button");
        button.className = "erp-blog2-btn--add";
        button.innerHTML = '<i class="fas fa-plus-circle"></i> Add Your First Image';

        // Button click event
        button.onclick = function() {
            Need_Image_button_Main_dash_bord_need_image_ADD_OPEN();
        };

        // Append all elements
        emptyState.appendChild(iconDiv);
        emptyState.appendChild(title);
        emptyState.appendChild(text);
        emptyState.appendChild(button);

        // Add to container
        container.appendChild(emptyState);

    }



    function neo_solution_04_body_01_list_data(json_data) {
        // MAIN CONTAINER
        const imgGridContainer = document.getElementById("need_image_blog_list_of_need_image_main_container_body_data_SET_DB");

        // ================= IMAGE CARD =================
        const imgCard = document.createElement("div");
        imgCard.className = "erp-blog2-image-card";
        imgCard.setAttribute("data-title", "asdasd");

        // ================= IMAGE =================
        const img = document.createElement("img");
        img.className = "erp-blog2-image-card__img";
        img.src = "<?php echo $home_page ?>" + json_data.img_pth;
        img.alt = json_data.alt;

        // ================= ACTION BUTTONS WRAP =================
        const actionsDiv = document.createElement("div");
        actionsDiv.className = "erp-blog2-image-card__actions";

        // PREVIEW BUTTON
        const previewBtn = document.createElement("button");
        previewBtn.className = "erp-blog2-action-btn";
        previewBtn.title = "Delete"; // Changed from "Preview" to "Delete"
        previewBtn.innerHTML = `<i class="fas fa-trash-alt"></i>`; // Changed icon to delete
        previewBtn.onclick = function() {
            blog_ui2_lis_Need_Image_in_blog_list_view_delete_btn_image_remove(json_data.img_pth, json_data.id);

        };

        // VIEW DETAILS BUTTON
        const viewBtn = document.createElement("button");
        viewBtn.className = "erp-blog2-action-btn";
        viewBtn.title = "View Details";
        viewBtn.innerHTML = `<i class="fas fa-file-alt"></i>`;
        viewBtn.onclick = function() {
            blog2ViewDetails(1);
        };

        // append buttons
        actionsDiv.appendChild(previewBtn);
        actionsDiv.appendChild(viewBtn);

        // ================= OVERLAY TITLE =================
        const overlayDiv = document.createElement("div");
        overlayDiv.className = "erp-blog2-image-card__overlay";
        overlayDiv.textContent = json_data.alt;

        // ================= FINAL APPEND =================
        imgCard.appendChild(img);
        imgCard.appendChild(actionsDiv);
        imgCard.appendChild(overlayDiv);

        imgGridContainer.appendChild(imgCard);



    }

    //image remove with project
    function blog_ui2_lis_Need_Image_in_blog_list_view_delete_btn_image_remove(pth_of_image, blog_image_id) {


        var sending_value = "pth_of_image=" + encodeURIComponent(pth_of_image);

        // alert(sending_value);

        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_remove.php",
            method: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                console.log(response)
                neo_solution_04_delete_btn_view_image_delete(blog_image_id)

                console.log(response);

            }
        })

    }

    function neo_solution_04_delete_btn_view_image_delete(blog_image_id) {


        var sending_value = "id=" + encodeURIComponent(blog_image_id) + "&delete_data=0";
        // alert(sending_value)
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/Create_Blog_Images.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function(response) {
                // alert(response);
                // Handle the successful response here
                var json = JSON.parse(response);
                for (var i = 0; i < json.length; i++) {
                    // console.log(json[i]);
                    neo_solution_04_list_data_list();
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors here
            }
        });

    }
</script>