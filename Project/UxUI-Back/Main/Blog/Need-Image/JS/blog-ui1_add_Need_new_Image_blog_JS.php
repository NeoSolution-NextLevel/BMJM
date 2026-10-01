<script type="text/javascript">
    // Content-specific JavaScript for blog creation
    document.addEventListener('DOMContentLoaded', function() {
        const erpBlogCloseBtn = document.getElementById('erpBlogCloseBtn');
        const blogCancelBtn = document.getElementById('blogCancelBtn');
        const blogSubmitBtn = document.getElementById('blogSubmitBtn');
        const blog_ui1_add_Need_new_Image_blog_image_upload_btn = document.getElementById('blog_ui1_add_Need_new_Image_blog_image_upload_btn');
        const blogScanBtn = document.getElementById('blogScanBtn');
        const neo_solution_04_body_02_from = document.getElementById('neo_solution_04_body_02_from');
        const blogImageUpload = document.getElementById('blogImageUpload');
        const blogImageUploadArea = document.getElementById('blogImageUploadArea');
        const blogImagePreview = document.getElementById('blogImagePreview');
        const blogRemoveImageBtn = document.getElementById('blogRemoveImageBtn');

        /* =========================================================
           IMAGE UPLOAD FUNCTIONALITY
           ========================================================= */
        if (blogImageUpload) {
            blogImageUpload.addEventListener('change', async (event) => { // ✅ async added
                const file = event.target.files[0];
                if (!file) return;

                // Validate image
                if (!file.type.match('image.*')) {
                    alert('Please select an image file (JPG, PNG, GIF, etc.)');
                    return;
                }

                let finalFile = file;

                // Compress if > 5MB
                if (file.size > 5 * 1024 * 1024) {
                    console.log("Compressing image...");
                    finalFile = await compressImage(file, 5, 0.85);
                }

                console.log("Original:", (file.size / 1024 / 1024).toFixed(2), "MB");
                console.log("Compressed:", (finalFile.size / 1024 / 1024).toFixed(2), "MB");

                // Preview compressed image
                const reader = new FileReader();
                reader.onload = (e) => {
                    blogImagePreview.src = e.target.result;
                    blogImageUploadArea.classList.add('has-image');
                };
                reader.readAsDataURL(finalFile);

                // Upload compressed file
                blog_ui1_add_Need_new_Image_blog__upload_file_haddle(finalFile);
            });
        }

        // Upload button triggers file input
        if (blog_ui1_add_Need_new_Image_blog_image_upload_btn) {
            blog_ui1_add_Need_new_Image_blog_image_upload_btn.addEventListener('click', () => {
                if (blogImageUpload) {
                    blogImageUpload.click();
                }
            });
        }

        // Remove image
        if (blogRemoveImageBtn) {
            blogRemoveImageBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                blogImagePreview.src = '';
                blogImageUploadArea.classList.remove('has-image');
                if (blogImageUpload) blogImageUpload.value = '';

                blog_ui1_add_Need_new_Image_blog__upload_file_image_remove();


            });
        }

        // Click on upload area to trigger file input
        if (blogImageUploadArea) {
            blogImageUploadArea.addEventListener('click', (e) => {
                if (!e.target.closest('.erp-blog-image-upload-area__remove') && blogImageUpload) {
                    blogImageUpload.click();
                }
            });
        }



        // Handle scan button
        if (blogScanBtn) {
            blogScanBtn.addEventListener('click', () => {
                alert('Scan functionality');


            });
        }

        // Handle form submission
        if (neo_solution_04_body_02_from) {
            neo_solution_04_body_02_from.addEventListener('submit', (e) => {
                e.preventDefault();

                // Validate form
                const formData = new FormData(neo_solution_04_body_02_from);
                const imageLabel = formData.get('image_label');

                if (!imageLabel || imageLabel.trim() === '') {
                    alert('Please enter an image label');
                    return;
                }

                neo_solution_04_body_02_from_submit();



                // Reset form after successful submission
                neo_solution_04_body_02_from.reset();
                blogImageUploadArea.classList.remove('has-image');
            });
        }


        /* =========================================================
           FORM VALIDATION
           ========================================================= */
        const labelInput = neo_solution_04_body_02_from.querySelector('input[name="image_label"]');
        if (labelInput) {
            labelInput.addEventListener('blur', () => {
                const label = labelInput.value.trim();
                if (label.length > 100) {
                    alert('Image label should be less than 100 characters');
                    labelInput.focus();
                }
            });
        }
    });


    function blog_ui1_add_Need_new_Image_blog__upload_file_haddle(file) {

        // Prepare FormData
        var formData = new FormData();
        formData.append("image_uploder_image", file);
        formData.append("image_uploder_image_TYPE", "ITEM");

        // alert(formData);
        // AJAX Upload
        admin_panel_perloader_show();
        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_upload.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // alert(response);
                console.log(response);

                console.log("Raw Response:", response);

                var data = JSON.parse(response);

                if (data[0].error == "0") {
                    admin_panel_perloader_hide();

                    // alert(data[0].img_pth);

                    // Save image path to hidden input
                    document.getElementById("neo_solution_04_body_02_from_image_pth_txt").value = data[0].img_pth;

                    console.log("Image Path Saved:", data[0].img_pth);

                } else {
                    alert("Upload Error: " + data[0].error);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error:", error);
                // alert("Upload Failed");
            }
        });



    }


    //image remove with project
    function blog_ui1_add_Need_new_Image_blog__upload_file_image_remove() {

        var pth_of_image = document.getElementById("neo_solution_04_body_02_from_image_pth_txt").value;

        var sending_value = "pth_of_image=" + pth_of_image;

        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_remove.php",
            method: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                console.log(response);

            }
        })

    }


    //insert into the database 
    function neo_solution_04_body_02_from_submit() {
        admin_panel_perloader_show();

        var neo_solution_04_body_02_from_val_01_obj = document.getElementById("neo_solution_04_body_02_from_val_01");
        var neo_solution_04_body_02_from_image_pth_txt_obj = document.getElementById("neo_solution_04_body_02_from_image_pth_txt");


        var sending_value = "image_name=" + neo_solution_04_body_02_from_val_01_obj.value + "&image_path=" + neo_solution_04_body_02_from_image_pth_txt_obj.value;
        console.log(sending_value);
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/Create_Blog_Images.php",
            method: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                admin_panel_perloader_hide();
                console.log(response);

                //got image list 
                Need_Image_button_Main_dash_bord_need_image_LIST_OPEN();
            }
        })
    }
</script>