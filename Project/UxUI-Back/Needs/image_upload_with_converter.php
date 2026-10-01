
<form id="image_uploder_uploadForm" enctype="multipart/form-data"  style="display: none;">
    <input type="hidden" value="CHEQUE_IMAGE" id="image_uploder_image_TYPE" name="image_uploder_image_TYPE">
    <input type="hidden" value="1" id="image_uploder_MULTI" name="image_uploder_MULTI">
    <input type="hidden" value="multiple_image_body" id="image_uploder_MULTI_LIST_BODY_NAME" name="image_uploder_MULTI_LIST_BODY_NAME">
    <!--image_uploder_MULTI 1 is only one ///// 0 is multiple--> 
    <input type="file" id="image_uploder_image" name="image_uploder_image"  required>

</form>
<input type="hidden" id="image_uploder_img_pth">
<canvas id="canvas" style="display:none;"></canvas>

<div id="image_uploder_response"></div>
<div id="multiple_image_body" style="display: none;"></div>


<script type="text/javascript">
    var image_uploader_form_id;

    let image_uploader_map = new Map();
    var image_uploader_map_id = 0;

    document.getElementById('image_uploder_image').addEventListener('change', function (event) {
//         image_uploder_process(event);
        image_uploader_map_id = 0;
        image_uploader_map.clear();
        const file = event.target.files[0];
        if (file) {
            const fileType = file.type;
            if (fileType === 'application/pdf') {
                image_uploder_pdf_ready(event); // Call your function for PDFs
            } else if (fileType.startsWith('image/')) {
                image_uploder_process(event); // Call your function for images
            } else {
                create_error_without_field(image_uploader_form_id + '_error_msg', 'Unsupported file type. Please upload an image or PDF.');
            }
        }
    });


    function image_uploder_pdf_ready(event) {
        const fileInput = document.getElementById('image_uploder_image');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const pdfData = new Uint8Array(e.target.result);

                pdfjsLib.getDocument(pdfData).promise.then(pdf => {
                    const numPages = pdf.numPages;
                    const imagePromises = [];

                    for (let pageNum = 1; pageNum <= numPages; pageNum++) {
                        imagePromises.push(
                                pdf.getPage(pageNum).then(page => {
                            const scale = 1.5;
                            const viewport = page.getViewport({scale});
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };

                            return page.render(renderContext).promise.then(() => {
                                const imageData = canvas.toDataURL('image/jpeg');
                                return {pageNum, imageData}; // Return an object with page number and image data
                            });
                        })
                                );
                    }

                    Promise.all(imagePromises).then(images => {
                        pdf_uploadImages(images);
                    }).catch(error => {
                        create_error_without_field(image_uploader_form_id + '_error_msg', "Error processing PDF:" + error);
                    });
                }).catch(error => {
                    create_error_without_field(image_uploader_form_id + '_error_msg', "Error loading PDF:" + error);
                });
            };
            reader.readAsArrayBuffer(file);
        } else {
            create_error_without_field(image_uploader_form_id + '_error_msg', "No file selected. " + error);
        }
    }

    function pdf_uploadImages(images) {
        document.getElementById('preloader').style.display = "block";

        const uploadPromises = images.map(({ pageNum, imageData }) => {
            const formData = new FormData();
            formData.append('pageNum', pageNum);
            formData.append('imageData', imageData);
            formData.append('image_uploder_image_TYPE', document.getElementById("image_uploder_image_TYPE").value);

            return fetch('<?php echo $pth; ?>View-List/File_Uploader_Control/image_pdf_img_list.php', {
                method: 'POST',
                body: formData
            })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {

                            if (document.getElementById("image_uploder_MULTI").value == "1") {
                                document.getElementById(image_uploader_form_id + "_image_pth_txt").value = data.filePath;
                                document.getElementById("image_uploder_img_pth").value = data.filePath;
//                                alert("test---"+data.filePath);
                                image_uploader_map.set(image_uploader_map_id, data.filePath);
                                image_uploder_update_image_to_show(data.filePath);

                            } else {
                                image_uploader_map_id++;
                                image_uploader_map.set(image_uploader_map_id, data.filePath);
                                document.getElementById("preloader").style.display = "block";

                            }
//                           
                        } else {
//                        console.error(`Page ${pageNum} failed to upload:`, data.error);
                            throw new Error(`Page ${pageNum} Error: ${data.error}`);
                        }
                    });
        });

        Promise.all(uploadPromises)
                .then(results => {
                    document.getElementById('preloader').style.display = "none";
//                    for (let i = 0; i < image_uploader_map.length; i++) {
//                        alert(i+"--"+image_uploader_map.get(i));
//                        image_uploader_list_to_body(i, image_uploader_map.get(i));
//                    }

                    image_uploader_map.forEach((value, key) => {
                        image_uploader_list_to_body(key, value);
                    });

//                    image_uploder_close_all_image_body();
                })
                .catch(error => {
                    document.getElementById('preloader').style.display = "none";
                    document.getElementById('response').innerText = 'An error occurred while uploading the images.';
                });
    }

    function image_uploder_process(event) {
        document.getElementById("preloader").style.display = "block";
        const file = event.target.files[0];
        const img = new Image();
        const reader = new FileReader();

        reader.onload = function (e) {
            img.src = e.target.result;
            img.onload = function () {
                const canvas = document.getElementById('canvas');
                const ctx = canvas.getContext('2d');

                // Set canvas dimensions to desired size
                const MAX_WIDTH = 800; // Set desired width
                const scaleSize = MAX_WIDTH / img.width;
                canvas.width = MAX_WIDTH;
                canvas.height = img.height * scaleSize;

                // Draw the image on canvas
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                // Get the resized image data URL
                canvas.toBlob(function (blob) {
                    const formData = new FormData();
                    formData.append('image_uploder_image', blob, file.name);
                    formData.append('image_uploder_image_TYPE', document.getElementById('image_uploder_image_TYPE').value);

                    // Submit the form data via AJAX
                    fetch('<?php echo $pth; ?>View-List/File_Uploader_Control/image_upload.php', {
                        method: 'POST',
                        body: formData
                    })
                            .then(response => response.json())
                            .then(data => {
                                if (data[0].error === "0") {
                                    document.getElementById(image_uploader_form_id + "_image_pth_txt").value = data[0].img_pth;
                                    document.getElementById("image_uploder_img_pth").value = data[0].img_pth;
                                    if (document.getElementById("image_uploder_MULTI").value == "0") {
                                        image_uploader_map.set(image_uploader_map_id, data[0].img_pth);
                                        image_uploader_map.forEach((value, key) => {
                                            image_uploader_list_to_body(key, value);
                                        });
                                        document.getElementById("preloader").style.display = "none";
                                    } else {
                                        image_uploder_update_image_to_show(data[0].img_pth);
                                    }


                                } else {
                                    create_error_without_field(image_uploader_form_id + '_error_msg', data[0].error);
                                }
                            })
                            .catch(error => {
                                create_error_without_field(image_uploader_form_id + '_error_msg', "An error occurred while uploading the image.");
                            });
                }, 'image/jpeg', 0.7); // 0.7 for quality reduction
            };
        };
        reader.readAsDataURL(file);
    }

    function image_uploder_close_all_image_body() {
        document.getElementById(image_uploader_form_id + "_image_not_found_body").style.display = "none";
        document.getElementById(image_uploader_form_id + "_body").style.display = "none";
        document.getElementById(image_uploader_form_id + "_del_request_body").style.display = "none";
        document.getElementById(image_uploader_form_id + "_del_btn").style.display = "none";
    }

    function image_uploder_image_form_rest() {
        image_uploder_close_all_image_body();
        document.getElementById("image_uploder_uploadForm").reset();
        document.getElementById(image_uploader_form_id + "_image_not_found_body").style.display = "block";
        document.getElementById(image_uploader_form_id + "_image_pth_txt").value = "";
        document.getElementById("image_uploder_img_pth").value = "";
        document.getElementById(image_uploader_form_id + "_error_msg_body").style.display = "none"; // Corrected line
    }

    function image_uploder_show_image() {
        image_uploder_close_all_image_body();
        document.getElementById(image_uploader_form_id + "_body").style.display = "block";
        document.getElementById(image_uploader_form_id + "_del_btn").style.display = "block";
    }

    function image_uploder_update_image_to_show(image_pth) {
        image_uploder_close_all_image_body();
        document.getElementById(image_uploader_form_id + "_del_btn").style.display = "block";
        var image_uploder_form_id_body_obj = document.getElementById(image_uploader_form_id + "_body");
        image_uploder_form_id_body_obj.style.display = "block";

        var image_uploder_form_id_obj = document.getElementById(image_uploader_form_id + "_IMG");
        image_uploder_form_id_obj.setAttribute("src", "<?php echo $pth; ?>" + image_pth);
        document.getElementById("preloader").style.display = "none";
    }

    function image_uploder_update_del_request_form() {
        document.getElementById(image_uploader_form_id + "_del_btn").style.display = "none";
        document.getElementById(image_uploader_form_id + "_del_request_body").style.display = "block";
    }
    function image_uploader_list_to_body(id, image_pth) {
//        alert(id + " -- " + image_pth);
        var get_body = document.getElementById(document.getElementById("image_uploder_MULTI_LIST_BODY_NAME").value);
        // Create the main row container
        var row_01 = document.createElement("div");
        row_01.setAttribute("class", "col-lg-4 w3-padding-16 w3-margin-bottom");

// Create the container for the image and button
        var container = document.createElement("div");
        container.setAttribute("class", "container-fluid w3-round w3-theme-l3");

// Create the row for the image
        var row_01_col_01 = document.createElement("div");
        row_01_col_01.setAttribute("class", "row");

// Create the column for the image
        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-12 w3-padding-16");

// Create the image element
        var img = document.createElement("img");
        img.setAttribute("src", "<?php echo $pth; ?>" + image_pth);
        img.setAttribute("class", "w3-image w3-round");

// Append the image to the column
        col_01.appendChild(img);

// Append the column to the row
        row_01_col_01.appendChild(col_01);

// Append the row to the container
        container.appendChild(row_01_col_01);

// Create the row for the button
        var row_01_col_02 = document.createElement("div");
        row_01_col_02.setAttribute("class", "row w3-margin-bottom");

// Create the column for the button
        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-12");

// Create the button element
        var button = document.createElement("button");
        button.setAttribute("class", "w3-button w3-red w3-padding w3-strong w3-block w3-round");
        button.textContent = "Delete Image";
        button.addEventListener("click", function () {
            // Remove the main row container when the button is clicked
            row_01.remove();
            image_uploader_map.delete(id);
        });

// Append the button to the column
        col_02.appendChild(button);

// Append the column to the row
        row_01_col_02.appendChild(col_02);

// Append the row to the container
        container.appendChild(row_01_col_02);

// Append the container to the main row container
        row_01.appendChild(container);

// Append the main row container to the body or a specific parent element
        get_body.appendChild(row_01);

    }

    function image_uploder_remveo_image() {
        var sending_value = "pth_of_image=" + document.getElementById("image_uploder_img_pth").value;
        $.ajax({
            url: "<?php echo $pth; ?>View-List/File_Uploader_Control/image_remove.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data, textStatus, jqXHR) {
                var json = eval(data);
                if (json.length == 0) {
                    image_uploder_image_form_rest();
                } else {
                    create_error_without_field(image_uploader_form_id + '_error_msg', json[0].error);
                }
            }
        });
    }

    // Placeholder for the function to display error messages

    function mobile_scan_image() {
        $("#image_uploder_myModal").modal('show');
    }

    function mobile_scan_image_close() {
        $("#image_uploder_myModal").modal('hide');
    }
</script>
<script type="text/javascript">
//// Set the form ID
////    var 
//
//// Get the image and magnifier elements
//    const img = document.getElementById("body_11_01_E_Approved_From_Mang_Show_id_view_image");
//    const magnifier = document.getElementById("body_11_01_E_Approved_From_Mang_Show_id_magnifier");
//
//// Add event listeners if elements exist
//    if (img && magnifier) {
//        console.log("Image and magnifier elements found");
////        alert("Image and magnifier elements found");
//        img.addEventListener('mousemove', magnify);
//        img.addEventListener('mouseout', () => magnifier.style.display = 'none');
//    } else {
//        console.error("Image or magnifier element not found. Please check your IDs.");
////        alert("Image or magnifier element not found. Please check your IDs.");
//    }
//    function magnify(e) {
//        magnifier.style.display = 'block';
//
////        alert("1");
//
//        const magnifierSize = magnifier.offsetWidth / 2;
//        const imgRect = img.getBoundingClientRect();
//        const x = e.clientX - imgRect.left;
//        const y = e.clientY - imgRect.top;
//
//        // Adjust the position to keep the magnifier within the image boundaries
//        let offsetX = x - magnifierSize;
//        let offsetY = y - magnifierSize;
//
//        if (offsetX < 0)
//            offsetX = 0;
//        if (offsetY < 0)
//            offsetY = 0;
//        if (offsetX + magnifierSize * 2 > img.width)
//            offsetX = img.width - magnifierSize * 2;
//        if (offsetY + magnifierSize * 2 > img.height)
//            offsetY = img.height - magnifierSize * 2;
//
//        magnifier.style.left = `${offsetX}px`;
//        magnifier.style.top = `${offsetY}px`;
//
//        const zoomLevel = 3; // Set the zoom level
//
//        magnifier.style.backgroundImage = `url(${img.src})`;
//        magnifier.style.backgroundSize = `${img.width * zoomLevel}px ${img.height * zoomLevel}px`;
//        magnifier.style.backgroundPosition = `-${x * zoomLevel - magnifierSize}px -${y * zoomLevel - magnifierSize}px`;
//    }

</script>


<style type="text/css">

    .magnifier {
        position: absolute;
        border: 3px solid #000;
        border-radius: 50%;
        cursor: none;
        display: none;
        width: 250px;
        height: 250px;
        overflow: hidden;
        pointer-events: none; /* Prevents interference with mouse events */
        background-repeat: no-repeat;
    }

</style>

<div class="modal fade w3-white w3-opacity w3-right" data-backdrop="static" data-keyboard="false" id="image_uploder_myModal" role="dialog">
    <input type="hidden" id="image_uploder_myModal_scan_image">
    <input type="hidden" id="image_uploder_myModal_pic_image">
    <input type="hidden" id="image_uploder_myModal_normal_image_uploader">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-body" id="myModalbody">
                <div class="container-fluid w3-theme-l3 w3-padding">
                    <div class="row w3-theme-dark w3-header w3-xlarge w3-padding">
                        <div class="col-lg-10 w3-padding">
                            Mobile Sync Image Upload Wizard
                        </div>
                        <div class="col-lg-2">
                            <button class="w3-theme-dark w3-round w3-hover w3-padding w3-button w3-block" onclick="mobile_scan_image_close()">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 w3-padding">

                        </div>

                        <div class="row w3-padding">
                            <div class="col-lg-12 w3-padding w3-justify">
                                Scan the QR code using your mobile device or upload a picture of the QR code. After uploading, press the refresh button to proceed. Please do not close the popup window while scanning or uploading the image
                            </div>
                        </div>
                        <div class="row w3-margin-top">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10">
                                <button class="w3-button w3-round w3-theme-dark w3-strong w3-block w3-padding-16">
                                    Refresh
                                </button>
                            </div>
                            <div class="col-lg-1"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>