<script>
    function extractBodyContent(htmlText) {
        // Remove DOCTYPE
        htmlText = htmlText.replace(/<!DOCTYPE[^>]*>/gi, "");

        // Create temp DOM
        const parser = new DOMParser();
        const doc = parser.parseFromString(htmlText, "text/html");

        // If body exists → return only body content
        if (doc.body) {
            return doc.body.innerHTML.trim();
        }

        // Fallback: remove html/head/body tags manually
        return htmlText
            .replace(/<html[^>]*>/gi, "")
            .replace(/<\/html>/gi, "")
            .replace(/<head[^>]*>[\s\S]*?<\/head>/gi, "")
            .replace(/<body[^>]*>/gi, "")
            .replace(/<\/body>/gi, "")
            .trim();
    }

    function file_upload_scan_and_txt_past_action() {

        var body_01_01_C_01_html_code_obj = document.getElementById("body_01_01_C_01_html_code");
        body_01_01_C_01_html_code_obj.value = "";

        const body_01_01_C_01_file = document.getElementById('body_01_01_C_01_file');
        const fileName = document.getElementById('fileName');
        const fileUploadArea = document.getElementById('fileUploadArea');

        body_01_01_C_01_file.value = "";
        fileName.textContent = "";
        fileUploadArea.classList.remove('has-file');

    }


    // Content-specific JavaScript for create blog
    document.addEventListener('DOMContentLoaded', function() {
        const erpCloseBtn = document.getElementById('erpCloseBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const processBlogBtn = document.getElementById('processBlogBtn');
        const body_01_01_C_01_from_01 = document.getElementById('body_01_01_C_01_from_01');

        // Form elements
        const body_01_01_C_01_heading = document.getElementById('body_01_01_C_01_heading');
        const body_01_01_C_01_uri = document.getElementById('body_01_01_C_01_uri');
        const body_01_01_C_01_seo_dis = document.getElementById('body_01_01_C_01_seo_dis');
        const body_01_01_C_01_seo_keywords = document.getElementById('body_01_01_C_01_seo_keywords');
        const body_01_01_C_01_type_of_blog = document.getElementById('body_01_01_C_01_type_of_blog');
        const body_01_01_C_01_html_code = document.getElementById('body_01_01_C_01_html_code');

        // Image upload elements
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const uploadImageBtn = document.getElementById('uploadImageBtn');
        const scanImageBtn = document.getElementById('scanImageBtn');

        // File upload elements
        const fileUploadArea = document.getElementById('fileUploadArea');
        const body_01_01_C_01_file = document.getElementById('body_01_01_C_01_file');
        const fileName = document.getElementById('fileName');

        // Character counters
        const seoDescCounter = document.getElementById('seoDescCounter');
        const body_01_01_C_01_seo_keywordsCounter = document.getElementById('body_01_01_C_01_seo_keywordsCounter');
        const body_01_01_C_01_html_codeCounter = document.getElementById('body_01_01_C_01_html_codeCounter');

        /* =========================================================
           INITIAL SETUP
           ========================================================= */
        // updateCharacterCounters();


        // Attach event listeners for character counting
        // body_01_01_C_01_seo_dis.addEventListener('input', updateCharacterCounters);
        // body_01_01_C_01_seo_keywords.addEventListener('input', updateCharacterCounters);
        // body_01_01_C_01_html_code.addEventListener('input', updateCharacterCounters);

        /* =========================================================
           IMAGE UPLOAD FUNCTIONALITY
           ========================================================= */
        // Trigger file input when clicking upload area
        imageUploadArea.addEventListener('click', (e) => {
            if (e.target !== imageInput && !e.target.closest('.erp-image-upload__remove')) {
                imageInput.click();
            }
        });

        // Trigger file input from upload button
        uploadImageBtn.addEventListener('click', () => {
            imageInput.click();
        });

        // Handle image selection
        imageInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            admin_panel_perloader_show();

            // Validate image
            if (!file.type.match('image.*')) {
                alert('Please select an image file (JPG, PNG, GIF, etc.)');
                return;
            }

            // If file bigger than 5MB → compress
            let finalFile = file;

            if (file.size > 5 * 1024 * 1024) {
                console.log("Compressing image...");
                finalFile = await compressImage(file, 5, 0.85); // 85% quality
            }

            console.log("Original size:", file.size / 1024 / 1024, "MB");
            console.log("Compressed size:", finalFile.size / 1024 / 1024, "MB");

            // Preview compressed image
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imageUploadArea.classList.add('has-image');
            };
            reader.readAsDataURL(finalFile);

            // Send compressed file
            blog_ui5_add_blog_image_uploader_save_haddle(finalFile);
        });

        // Remove image
        removeImageBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            imagePreview.src = '';
            imageUploadArea.classList.remove('has-image');
            imageInput.value = '';

            blog_ui5_add_blog_image_uploader_remove_haddle();
        });

        // Scan button (placeholder functionality)
        scanImageBtn.addEventListener('click', () => {
            alert('Image scanning functionality would be implemented here.');
        });

        /* =========================================================
           FILE UPLOAD FUNCTIONALITY
           ========================================================= */
        fileUploadArea.addEventListener('click', (e) => {
            file_upload_scan_and_txt_past_action();

        });

        body_01_01_C_01_file.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                // Clear existing content first
                body_01_01_C_01_html_code.value = "";

                // Validate file type
                const validTypes = ['.html', '.php'];
                const fileExt = '.' + file.name.split('.').pop().toLowerCase();

                if (!validTypes.includes(fileExt)) {
                    alert('Please select a .html or .php file only.');
                    body_01_01_C_01_file.value = '';
                    return;
                }

                // Check file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size should be less than 2MB');
                    body_01_01_C_01_file.value = '';
                    return;
                }

                // Show file name
                fileName.textContent = file.name;
                fileUploadArea.classList.add('has-file');

                // Load file content into textarea
                const reader = new FileReader();
                reader.onload = (e) => {
                    let content = e.target.result;

                    // 🔥 REMOVE HTML, HEAD, BODY TAGS
                    content = extractBodyContent(content);

                    // Set cleaned content to textarea
                    body_01_01_C_01_html_code.value = content;

                    // Reset UI
                    body_01_01_C_01_file.value = "";
                    fileName.textContent = "";
                    fileUploadArea.classList.remove('has-file');
                };
                reader.readAsText(file);

            }
        });

        /* =========================================================
           FORM VALIDATION & SUBMISSION
           ========================================================= */
        body_01_01_C_01_from_01.addEventListener('submit', (e) => {
            e.preventDefault();

            body_01_01_C_01_from_01_SUMBIT();
            // Reset form
            body_01_01_C_01_from_01.reset();
            imageUploadArea.classList.remove('has-image');
            fileUploadArea.classList.remove('has-file');
            // updateCharacterCounters();
        });



        /* =========================================================
           AUTO-GENERATE URI FROM HEADING & VALIDATION
           ========================================================= */
        function sanitizeURI(text) {
            return text.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // Remove symbols
                .replace(/\s+/g, '-') // Spaces to dashes
                .replace(/-+/g, '-') // Multiple dashes to single dash
                .replace(/^-+|-+$/g, ''); // Trim dashes from start/end
        }

        body_01_01_C_01_heading.addEventListener('blur', function() {
            if (body_01_01_C_01_heading.value.trim() && !body_01_01_C_01_uri.value.trim()) {
                body_01_01_C_01_uri.value = sanitizeURI(body_01_01_C_01_heading.value);
            }
        });

        body_01_01_C_01_uri.addEventListener('input', function() {
            // Prevent / and symbols, allow only alphanumeric and -
            let cursorPosition = this.selectionStart;
            let originalLength = this.value.length;

            let sanitized = this.value.toLowerCase()
                .replace(/[^a-z0-9-]/g, '-') // Replace symbols with dash
                .replace(/-+/g, '-'); // Collapse multiple dashes

            if (this.value !== sanitized) {
                this.value = sanitized;
                // Adjust cursor position if characters were removed/replaced
                let newPosition = cursorPosition - (originalLength - sanitized.length);
                this.setSelectionRange(newPosition, newPosition);
            }
        });

        /* =========================================================
           KEYBOARD SHORTCUTS
           ========================================================= */
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save/submit
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                processBlogBtn.click();
            }

            // Escape to cancel
            if (e.key === 'Escape') {
                cancelBtn.click();
            }
        });

        /* =========================================================
           DRAG AND DROP FOR FILES
           ========================================================= */
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
            imageUploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
            imageUploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
            imageUploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            this.classList.add('dragover');
        }

        function unhighlight(e) {
            this.classList.remove('dragover');
        }

        // Handle drop for files
        fileUploadArea.addEventListener('drop', handleFileDrop, false);
        imageUploadArea.addEventListener('drop', handleImageDrop, false);

        function handleFileDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                body_01_01_C_01_file.files = files;
                body_01_01_C_01_file.dispatchEvent(new Event('change'));
            }
        }

        function handleImageDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                imageInput.files = files;
                imageInput.dispatchEvent(new Event('change'));
            }
        }
    });





    // ------------------------------------------------------------------------------------------------------------------------------


    //data base set and get functions implamentation 

    function closeErpModal() {
        const modal = document.getElementById('erpMessageModal');
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    function showMessage(text, type) {
        const modal = document.getElementById('erpMessageModal');
        const iconContainer = document.getElementById('erpModalIcon');
        const titleEl = document.getElementById('erpModalTitle');
        const textEl = document.getElementById('erpModalText');

        if (!modal) return;

        // Set Icon and Title based on type
        iconContainer.className = 'erp-modal-icon ' + type;
        if (type === 'ok' || type === 'success') {
            iconContainer.innerHTML = '✓';
            iconContainer.className = 'erp-modal-icon success';
            titleEl.textContent = 'Success!';
        } else if (type === 'error') {
            iconContainer.innerHTML = '✕';
            titleEl.textContent = 'Error';
        } else {
            iconContainer.innerHTML = 'i';
            iconContainer.className = 'erp-modal-icon info';
            titleEl.textContent = 'Information';
        }

        textEl.textContent = text || '';

        // Show Modal
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.add('active');
        }, 10);
    }


    function blog_ui5_add_update_blog_JS_single_blog_list_view_SET_DB() {

        var blog_id = document.getElementById("blog_ui5_add_blog_and_update_blog_id").value;

        var sending_value = "id=" + encodeURIComponent(blog_id);
        admin_panel_perloader_show();


        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/View_Single_Blog.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                admin_panel_perloader_hide();

                var json_response = JSON.parse(response);
                if (json_response.length == 0) {
                    showMessage("Couldn't load please try again", "error");

                    //navigate to blog list
                    Blog_List_button_Main_dash_bord_blog_list_OPEN();
                    return;
                } else {
                    console.log("Single Blog Data : " + json_response[0]);
                    blog_ui5_add_update_blog_JS_single_blog_list_view_SHOW_DATA(json_response[0]);

                }


            },
        });



    }


    //load single blog data (in update state)
    function blog_ui5_add_update_blog_JS_single_blog_list_view_SHOW_DATA(json) {

        var body_01_01_C_01_heading_obj = document.getElementById("body_01_01_C_01_heading"); // Blog heading
        var body_01_01_C_01_uri_obj = document.getElementById("body_01_01_C_01_uri"); // Blog URL
        var body_01_01_C_01_seo_dis_obj = document.getElementById("body_01_01_C_01_seo_dis"); // Blog Seo Dis 
        var body_02_B_03_IMAGE_from_id_image_pth_txt_obj = document.getElementById("body_02_B_03_IMAGE_from_id_image_pth_txt"); // Blog Image path 
        var body_01_01_C_01_seo_keywords_obj = document.getElementById("body_01_01_C_01_seo_keywords"); // Blog Seo key words 
        var body_01_01_C_01_type_of_blog_obj = document.getElementById("body_01_01_C_01_type_of_blog"); // Type name Blog 
        var body_01_01_C_01_html_code_obj = document.getElementById("body_01_01_C_01_html_code"); // Blog  information  data 

        // Image elements
        const imagePreview = document.getElementById('imagePreview');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('imageInput');

        $(body_01_01_C_01_heading_obj).empty();
        $(body_01_01_C_01_uri_obj).empty();
        $(body_01_01_C_01_seo_dis_obj).empty();
        $(body_02_B_03_IMAGE_from_id_image_pth_txt_obj).empty();
        $(body_01_01_C_01_seo_keywords_obj).empty();
        $(body_01_01_C_01_type_of_blog_obj).empty();
        $(body_01_01_C_01_html_code_obj).empty();

        body_01_01_C_01_heading_obj.value = json.heading;
        body_01_01_C_01_uri_obj.value = json.url_data;
        body_01_01_C_01_seo_dis_obj.value = json.seo_dis;
        body_02_B_03_IMAGE_from_id_image_pth_txt_obj.value = json.image_path;
        body_01_01_C_01_seo_keywords_obj.value = json.key_words;
        body_01_01_C_01_html_code_obj.value = json.infomation_data;

        // Ensure URI is editable
        body_01_01_C_01_uri_obj.disabled = true;


        load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog_SET_DB(json.type_of_blog);

        if (json.image_path && json.image_path !== "0") {
            imagePreview.src = "<?php echo $home_page; ?>" + json.image_path;
            imageUploadArea.classList.add('has-image');
            imageInput.removeAttribute('required');
        }

    }

    function body_01_01_C_01_from_01_SUMBIT_URI_validation() {
        var val_02 = document.getElementById("body_01_01_C_01_uri").value;

        // Regex for lowercase a-z, 0-9, and -
        // Ensure it doesn't start or end with a dash and only contains allowed chars
        var uriRegex = /^[a-z0-9]+(-[a-z0-9]+)*$/;

        if (!val_02) {
            showMessage('URI cannot be empty.', 'error');
            return false;
        }

        if (!uriRegex.test(val_02)) {
            if (val_02.includes('--')) {
                showMessage('URI cannot contain double dashes (--).', 'error');
            } else if (val_02.startsWith('-') || val_02.endsWith('-')) {
                showMessage('URI cannot start or end with a dash (-).', 'error');
            } else {
                showMessage('Invalid URI. Use only alphanumeric characters and single dashes (-).', 'error');
            }
            return false;
        }

        return true;
    }


    //form submition to data save to database 
    function body_01_01_C_01_from_01_SUMBIT() {

        //update or add new blog
        var update_or_add_new_blog_state = document.getElementById("blog_ui5_add_blog_and_update_view_state").value;


        if (!body_01_01_C_01_from_01_SUMBIT_URI_validation()) {
            return;
        }


        // ---- feature detection (show error in message area) ----
        var hasFormData = !!window.FormData;
        var hasFileInput = 'files' in document.createElement('input');
        if (!hasFormData || !hasFileInput) {
            showMessage('Your browser does not support file uploads on this page. Please update your browser or use a different one.', 'error');
            return;
        }

        // ---- collect fields ----
        var val_01 = document.getElementById("body_01_01_C_01_heading").value;
        var val_02 = document.getElementById("body_01_01_C_01_uri").value;
        var val_03 = document.getElementById("body_01_01_C_01_seo_dis").value;
        var val_04 = document.getElementById("body_02_B_03_IMAGE_from_id_image_pth_txt").value;
        var val_05 = document.getElementById("body_01_01_C_01_html_code").value; // textarea fallback
        var val_06 = document.getElementById("body_01_01_C_01_seo_keywords").value;
        var val_07 = document.getElementById("body_01_01_C_01_type_of_blog").value;

        // alert("image path : " + val_04);


        var body_01_01_C_01_show_on_all_blogs_obj = document.getElementById("body_01_01_C_01_show_on_all_blogs");


        var fileInput = document.getElementById("body_01_01_C_01_file");
        var file = (fileInput && fileInput.files && fileInput.files[0]) ? fileInput.files[0] : null;

        // ---- validate URI ----
        var forbiddenChars = /[\/\\\s]/;
        if (!val_02 || forbiddenChars.test(val_02)) {
            showMessage('Invalid URI. Try another URI.', 'error');
            return;
        }

        // ---- validate file (if selected) ----
        if (file) {
            var okExt = /\.(html?|php)$/i.test(file.name);
            if (!okExt) {
                showMessage('Only .html, .htm, or .php files are allowed.', 'error');
                return;
            }
            // Optional size guard: 2 MB (adjust if needed)
            var MAX_BYTES = 10 * 1024 * 1024;
            if (file.size > MAX_BYTES) {
                showMessage('Selected file is too large (max 10 MB).', 'error');
                return;
            }
        }

        // ---- build multipart payload ----
        var fd = new FormData();
        fd.append("val_01", val_01);
        fd.append("val_02", val_02);
        fd.append("val_03", val_03);
        fd.append("val_04", val_04);
        fd.append("val_06", val_06);
        fd.append("val_05", val_05);
        fd.append("val_07", val_07);

        if (body_01_01_C_01_show_on_all_blogs_obj && body_01_01_C_01_show_on_all_blogs_obj.checked) {
            // show on all blogs
            fd.append("show", "01"); // show on all blogs
        } else {
            // do not show on all blogs
        }

        if (file) {
            fd.append("file", file); // PHP: read from $_FILES['file']
        } else {
            // Fallback: textarea HTML
        }

        if (val_04 !== "") fd.append("image_val", "0");

        // ---- send ----
        showMessage('Uploading…', 'info');

        // alert(fd);
        var for_update_or_create_ajaax_url = "No URl SET FOR Ajax";

        if (update_or_add_new_blog_state === "add_new") {
            for_update_or_create_ajaax_url = "<?php echo $pth; ?>View-List/Main/Blog/Create_New_Blog.php";


        } else if (update_or_add_new_blog_state === "update_blog") {

            blog_id = document.getElementById("blog_ui5_add_blog_and_update_blog_id").value;
            fd.append("id", blog_id);

            for_update_or_create_ajaax_url = "<?php echo $pth; ?>View-List/Main/Blog/Updata_blog_data.php";


        }

        console.log("===== FORM DATA DEBUG =====");

        for (var pair of fd.entries()) {
            console.log(pair[0] + " = ", pair[1]);
        }
        admin_panel_perloader_show();

        // alert("Check Console → FormData logged");
        $.ajax({
            url: for_update_or_create_ajaax_url,
            type: "POST",
            data: fd,
            processData: false, // IMPORTANT for FormData
            contentType: false, // IMPORTANT for FormData
            cache: false,
            xhr: function() {
                var xhr = $.ajaxSettings.xhr();

                xhr.addEventListener("load", function() {
                    console.log("XHR Response Text:", xhr.responseText);
                    // alert("XHR Response: " + xhr.responseText);
                    showMessage('Uploading… ' + pct + '%', 'info');

                });

                return xhr;
            },
            success: function(response) {
                // alert(response);
                admin_panel_perloader_hide();


                console.log("Raw for create or Update Response  :", response);

                let data;
                try {
                    data = (typeof response === "string") ? JSON.parse(response) : response;
                } catch (e) {
                    console.error("JSON Parse Error", e);
                    return;
                }

                console.log("Parsed Data:", data);

                // Check cookie invalid
                if (data[0].error === "cookie-ID-is-invalid") {

                    // alert("Session expired! Redirecting...");

                    let errorMsg = encodeURIComponent("Re-Login-Required");
                    window.location.href =
                        "<?php echo $home_page ?><?php echo $User_login_url ?>Failed-Page<?php echo $online_offline_extention ?>?error=" + errorMsg;

                    return;
                }

                // Check invalid URL
                if (data[0].message === "already-in-use-URI") {

                    showMessage('This URI Already in. Try another URL.', 'error');

                    return;
                }

                // Success case
                if (data[0].error === "0") {
                    document.getElementById("body_01_01_C_blog_id").value = data[0].id;
                    showMessage("Saved successfully.", "ok");
                    Blog_List_button_Main_dash_bord_blog_list_OPEN();
                } else {
                    showMessage("Error: " + data[0].error, "error");
                }
            },
            error: function(xhr, status, err) {
                // alert(xhr);
                console.error("AJAX error:", status, xhr);

                showMessage('AJAX error: ' + (err || status), 'error');
            }
        });
    }


    //load blog type to select option 
    function load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog_SET_DB(add_or_update_blog_type) {
        var sending_value = "active_state=0";
        // alert("load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog");

        var container = document.getElementById("body_01_01_C_01_type_of_blog");
        $(container).empty();


        var defult_option = document.createElement("option");

        if (add_or_update_blog_type === "add_new") {


            defult_option.value = "";
            defult_option.text = "-- Select Blog Type --";

        } else {
            defult_option.value = add_or_update_blog_type;
            defult_option.text = add_or_update_blog_type;
        }


        container.appendChild(defult_option);



        $.ajax({
            url: "<?php echo $pth; ?>View-List/Main/Blog/type_of_blogs/list_type_of_blogs.php",
            type: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                var json_response = JSON.parse(response);
                if (json_response.length > 0) {

                    for (var i = 0; i < json_response.length; i++) {

                        //skip for same blog have in dublication
                        if (json_response[i].type_of_blog == add_or_update_blog_type) {
                            continue;
                        }
                        load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog_SHOW_DATA(json_response[i], container)

                    }
                } else {

                    var empty_option = document.createElement("option");
                    empty_option.value = "";
                    empty_option.text = "No Blog Types Found";
                    container.appendChild(empty_option);
                }

            },
        });
    }

    function load_blog_types_to_create_new_blog_body_01_01_C_01_type_of_blog_SHOW_DATA(json, container) {


        var option = document.createElement("option");
        option.value = json.type_of_blog;
        option.text = json.type_of_blog;

        container.appendChild(option);


    }



    //blog image adding function implementation
    function blog_ui5_add_blog_image_uploader_save_haddle(file) {
        // Prepare FormData
        var formData = new FormData();
        formData.append("image_uploder_image", file);
        formData.append("image_uploder_image_TYPE", "ITEM");

        // alert(formData);
        // AJAX Upload

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
                admin_panel_perloader_hide();


                if (data[0].error == "0") {

                    // alert(data[0].img_pth);

                    // Save image path to hidden input
                    document.getElementById("body_02_B_03_IMAGE_from_id_image_pth_txt").value = data[0].img_pth;

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

    //blog image remove to project file function  implementation
    function blog_ui5_add_blog_image_uploader_remove_haddle() {

        var pth_of_image = document.getElementById("body_02_B_03_IMAGE_from_id_image_pth_txt").value;

        var sending_value = "pth_of_image=" + pth_of_image;

        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_remove.php",
            method: "POST",
            data: sending_value,
            success: function(response) {
                // alert(response);
                console.log(response);
                document.getElementById("body_02_B_03_IMAGE_from_id_image_pth_txt").value = "0";


            }
        })

    }
</script>


<!-- Optional helper styles -->
<style>
    #message.msg-error {
        color: #d32f2f;
    }

    #message.msg-ok {
        color: #2e7d32;
    }

    #message.msg-info {
        color: #1976d2;
    }

    .file-box.disabled {
        opacity: .6;
        pointer-events: none;
    }
</style>