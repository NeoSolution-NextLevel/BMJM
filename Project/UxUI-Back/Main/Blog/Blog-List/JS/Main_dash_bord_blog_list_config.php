<script type="text/javascript">
    function Blog_List_button_Main_dash_bord_close_all() {
        document.getElementById("blog_list_btn_list_blog_container_01").style.display = "none"; // blog list
        document.getElementById("blog_list_btn_add_blog_container_02").style.display = "none"; // Add blog or update blog 

    }


    // blog list
    function Blog_List_button_Main_dash_bord_blog_list_OPEN() {
        //    alert("1");
        Blog_List_button_Main_dash_bord_close_all();
        document.getElementById("blog_list_btn_list_blog_container_01").style.display = "block";
        load_blog_list();
    }

    // Add blog or update blog 
    function Blog_List_button_Main_dash_bord_add_blog_OPEN(new_blog_or_update_blog_state) {

        console.log("add and update page state : " + new_blog_or_update_blog_state);

        document.getElementById("blog_ui5_add_blog_and_update_view_state").value = new_blog_or_update_blog_state;

        Blog_List_button_Main_dash_bord_close_all();
        document.getElementById("blog_list_btn_add_blog_container_02").style.display = "block";

        if (new_blog_or_update_blog_state === "add_new") {

            document.getElementById("blog_ui5_add_blog_main_container_heading_txt_val_01").innerHTML = "Add New";
            document.getElementById("blog_ui5_add_blog_main_container_heading_txt_val_02").innerHTML = "Add New";
            var imagePreview = document.getElementById('imagePreview');
            var imageUploadArea = document.getElementById('imageUploadArea');
            var imageInput = document.getElementById('imageInput');

            imagePreview.src = '';
            imageUploadArea.classList.remove('has-image');
            imageInput.value = '';



            document.getElementById("body_01_01_C_01_from_01").reset();

            //clear fie uplder
            // Clear file input
            const fileInput = document.getElementById("body_01_01_C_01_file");
            fileInput.value = ""; // IMPORTANT

            // Clear file name display
            document.getElementById("fileName").innerHTML = "";

            // Optional: remove selected UI state (if you add CSS class)
            document.getElementById("fileUploadArea").classList.remove("file-selected");

            //load default Blog list for new blog 
            load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog_SET_DB("add_new");


            document.getElementById("blog_ui5_add_blog_and_update_blog_id").value = "0";
        } else if (new_blog_or_update_blog_state === "update_blog") {

            document.getElementById("blog_ui5_add_blog_main_container_heading_txt_val_01").innerHTML = "Update";
            document.getElementById("blog_ui5_add_blog_main_container_heading_txt_val_02").innerHTML = "Update";

            //load single blog data for  update
            blog_ui5_add_update_blog_JS_single_blog_list_view_SET_DB();

        }
    }
</script>