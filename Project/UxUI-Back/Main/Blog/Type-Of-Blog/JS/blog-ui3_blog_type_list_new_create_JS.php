<!-- C:\xampp\htdocs\NeoSolutionCompanyWebsite\UxUi-Back\Dash-Bord\Blog-List\JS\type_of_blog\blog_setup_01_add_type_of_blog_JS.php -->
<script type="text/javascript">
    // Content-specific JavaScript for blog3 type creation
    document.addEventListener('DOMContentLoaded', function() {
        const erpBlog3CloseBtn = document.getElementById('erpBlog3CloseBtn');
        const blog3CancelBtn = document.getElementById('blog3CancelBtn');
        const blog3SaveBtn = document.getElementById('blog3SaveBtn');
        const blog_setup_01_add_type_of_blog_from = document.getElementById('blog_setup_01_add_type_of_blog_from');
        const blog3TypeInput = document.querySelector('input[name="blog3_type"]');
        const blog3TypesListSection = document.getElementById('blog3TypesListSection');
        const blog3TypesGrid = document.getElementById('blog3TypesGrid');

        // Load types on page load
        // blog3LoadExistingTypes();



        /* =========================================================
           FORM SUBMISSION
           ========================================================= */
        if (blog_setup_01_add_type_of_blog_from) {
            blog_setup_01_add_type_of_blog_from.addEventListener('submit', (e) => {
                e.preventDefault();

                const blog3Type = blog3TypeInput.value.trim();

                // Validation
                if (!blog3Type) {
                    alert('Please enter a blog type');
                    blog3TypeInput.focus();
                    return;
                }

                if (blog3Type.length > 50) {
                    alert('Blog type should be less than 50 characters');
                    blog3TypeInput.focus();
                    return;
                }



                // In real implementation, send to API
                console.log('Creating blog3 type:', blog3Type);


                //insert into database
                blog_setup_01_add_type_of_blog_SUMBIT();

                // Show success message
                // alert(`Blog type "${blog3Type}" created successfully!`);

                // Reset form
                blog_setup_01_add_type_of_blog_from.reset();
                blog3TypeInput.focus();
            });
        }

        // Also trigger form submission on save button click
        if (blog3SaveBtn) {
            blog3SaveBtn.addEventListener('click', () => {
                blog_setup_01_add_type_of_blog_from.dispatchEvent(new Event('submit'));
            });
        }

        /* =========================================================
           INPUT VALIDATION
           ========================================================= */
        if (blog3TypeInput) {
            blog3TypeInput.addEventListener('input', function() {
                // Remove extra spaces
                this.value = this.value.replace(/\s+/g, ' ').trimStart();

                // Limit length
                if (this.value.length > 50) {
                    this.value = this.value.substring(0, 50);
                    alert('Maximum 50 characters allowed');
                }
            });

            // Auto-capitalize first letter
            blog3TypeInput.addEventListener('blur', function() {
                if (this.value.length > 0) {
                    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                }
            });
        }

        /* =========================================================
           KEYBOARD SHORTCUTS
           ========================================================= */
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (blog3SaveBtn) {
                    blog3SaveBtn.click();
                }
            }


        });
    });



    function blog_setup_01_add_type_of_blog_SUMBIT() {


        admin_panel_perloader_show();

        var type_of_blog_name = document.getElementById("blog_setup_01_add_type_of_blog_from_name").value;

        if (type_of_blog_name == "") {

        }
        var sending_value = "type_of_blog_name=" + type_of_blog_name;
        // alert(sending_value)
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/type_of_blogs/add_update_type_of_blog.php",
            type: "POST",
            data: sending_value,
            success: function(response) {

                admin_panel_perloader_hide();

                // alert(response);
                // Handle the response from the servermain_dashbord_blog_typeof_blog_btn_OPEN 
                var json = JSON.parse(response);
                if (json[0].error == "0") {
                    main_dashbord_blog_typeof_blog_btn_OPEN();
                } else {
                    create_error(document.getElementById("blog_setup_01_add_type_of_blog_from_name"), 'blog_setup_01_add_type_of_blog_from_error_msg', json[0].error);
                }

            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the request
            }
        });
    }
</script>