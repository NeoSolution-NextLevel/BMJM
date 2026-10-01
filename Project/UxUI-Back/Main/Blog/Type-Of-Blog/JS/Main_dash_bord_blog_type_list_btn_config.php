<script type="text/javascript">
    function Main_dash_bord_blog_type_list_btn_Close_all() {
        document.getElementById("type_of_blog_list_btn_add_blog_type_main_content_01").style.display = "none";

        document.getElementById("type_of_blog_list_btn_type_list_main_content_01").style.display = "none";


    }


    // blog type list
    function Main_dash_bord_blog_type_list_btn_blog_type_list_OPEN() {
        //    alert("1");
        Main_dash_bord_blog_type_list_btn_Close_all();
        document.getElementById("type_of_blog_list_btn_type_list_main_content_01").style.display = "block";

        //load blog type list 
        load_type_of_blog_list();
    }

    // Add blog  type 
    function Main_dash_bord_blog_type_list_btn_add_blog_type_OPEN() {
        //    alert("1");
        Main_dash_bord_blog_type_list_btn_Close_all();
        document.getElementById("type_of_blog_list_btn_add_blog_type_main_content_01").style.display = "block";
    }









    // ---------------------------------------------------------------------------------------------------------------------------------------

    //load empty container for blog ERP 
    function load_blog_type_to_body_response_empty_content(container_obj, Blog_ERP__state) {

        // Main wrapper
        var emptyState = document.createElement("div");
        emptyState.className = "erp-empty-state";

        // Icon div
        var iconDiv = document.createElement("div");
        iconDiv.className = "erp-empty-state__icon";

        var icon = document.createElement("i");
        icon.className = "fa fa-folder-open-o";

        iconDiv.appendChild(icon);

        // Title
        var title = document.createElement("h3");
        title.className = "erp-empty-state__title";
        title.innerHTML = "No " + Blog_ERP__state + " Found";

        // Text
        var text = document.createElement("p");
        text.className = "erp-empty-state__text";
        text.innerHTML = "It looks like you haven't created any " + Blog_ERP__state + " yet. Start sharing your stories today!";

        // Button
        var button = document.createElement("button");
        button.className = "erp-btn-primary";
        button.innerHTML = '<i class="fa fa-plus"></i> Create First ' + Blog_ERP__state;

        // Button click
        button.onclick = function() {
            if (Blog_ERP__state == "Blog") {
                Blog_List_button_Main_dash_bord_add_blog_OPEN('add_new');
            } else if (Blog_ERP__state == "Blog Type") {
                Main_dash_bord_blog_type_list_btn_add_blog_type_OPEN();


            } else if (Blog_ERP__state == "Blog Image") {
                Need_Image_button_Main_dash_bord_need_image_LIST_OPEN();
            }
        };

        // Append all
        emptyState.appendChild(iconDiv);
        emptyState.appendChild(title);
        emptyState.appendChild(text);
        emptyState.appendChild(button);

        container_obj.appendChild(emptyState);

    }
</script>