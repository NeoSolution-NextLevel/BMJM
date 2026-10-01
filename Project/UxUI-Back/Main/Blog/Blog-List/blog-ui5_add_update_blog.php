<!-- components/content/create_blog.php -->


<style>
    /* ================= MAIN CONTENT AREA ================= */
    .erp-content-area {
        flex: 1;
        padding: 2rem;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        min-height: calc(100vh - 50px - 2rem);
        background: var(--erp-surface-alt);
    }

    .erp-sidebar.collapsed~.erp-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }

    /* ================= PAGE TITLE & BREADCRUMB ================= */
    .erp-page-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        color: var(--erp-primary-dark);
        text-align: center;
        letter-spacing: -0.5px;
    }

    .erp-breadcrumb-global {
        font-size: 0.875rem;
        color: var(--erp-text-tertiary);
        text-align: center;
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .erp-breadcrumb__separator {
        color: var(--erp-border-dark);
    }

    /* ================= MAIN CARD ================= */
    .erp-createblog-card {
        background: var(--erp-surface);
        border-radius: 0.75rem;
        border: 1px solid var(--erp-border);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header */
    .erp-createblog-card__header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, var(--erp-primary) 0%, var(--erp-primary-dark) 100%);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .erp-createblog-card__title {
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .erp-btn--icon {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
        font-size: 1.25rem;
        cursor: pointer;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .erp-btn--icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    /* ================= FORM CONTAINER ================= */
    .erp-createblog-card__body {
        padding: 2rem;
        background: var(--erp-surface-alt);
    }

    .erp-createblog-form {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    /* ================= FORM ELEMENTS ================= */
    .erp-form-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .erp-form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .erp-form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--erp-text-secondary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .erp-form-required {
        color: var(--erp-error-dark);
    }

    .erp-form-input,
    .erp-form-textarea,
    .erp-form-select {
        padding: 0.875rem 1rem;
        border: 1px solid var(--erp-border);
        border-radius: 0.625rem;
        background: var(--erp-surface);
        color: var(--erp-text-primary);
        font-size: 0.9375rem;
        transition: all 0.2s ease;
        width: 100%;
    }

    .erp-form-input:focus,
    .erp-form-textarea:focus,
    .erp-form-select:focus {
        outline: none;
        border-color: var(--erp-primary);
        box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.1);
    }

    .erp-form-input::placeholder,
    .erp-form-textarea::placeholder {
        color: var(--erp-text-tertiary);
        opacity: 0.7;
    }

    .erp-form-textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.5;
    }

    .erp-form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23718096' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px;
        padding-right: 2.5rem;
    }

    /* ================= INFORMATION NOTE ================= */
    .erp-info-note {
        background: rgba(229, 62, 62, 0.05);
        border: 1px solid rgba(229, 62, 62, 0.2);
        border-radius: 0.625rem;
        padding: 1.25rem;
        margin-top: 0.5rem;
    }

    .erp-info-note__title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--erp-error-dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .erp-info-note__text {
        font-size: 0.8125rem;
        color: var(--erp-text-secondary);
        line-height: 1.5;
    }

    /* ================= IMAGE UPLOAD SECTION ================= */
    .erp-image-upload {
        background: var(--erp-primary-dark);
        border-radius: 0.625rem;
        height: 12rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        margin-top: 1rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .erp-image-upload:hover {
        background: var(--erp-primary);
    }

    .erp-image-upload.has-image {
        background: var(--erp-surface);
        border: 2px dashed var(--erp-border);
    }

    .erp-image-upload__icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.8;
    }

    .erp-image-upload__text {
        font-size: 1.125rem;
        font-weight: 500;
        text-align: center;
    }

    .erp-image-upload__preview {
        max-width: 90%;
        max-height: 80%;
        object-fit: contain;
        border-radius: 0.5rem;
        display: none;
    }

    .erp-image-upload.has-image .erp-image-upload__preview {
        display: block;
    }

    .erp-image-upload.has-image .erp-image-upload__icon,
    .erp-image-upload.has-image .erp-image-upload__text {
        display: none;
    }

    .erp-image-upload__input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .erp-image-upload__remove {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        background: var(--erp-error-dark);
        color: white;
        border: none;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        transition: background 0.2s;
    }

    .erp-image-upload.has-image:hover .erp-image-upload__remove {
        display: flex;
    }

    .erp-image-upload__remove:hover {
        background: var(--erp-error-darker);
    }

    /* Image Actions */
    .erp-image-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1rem;
    }

    .erp-btn--image {
        padding: 0.875rem;
        border: none;
        border-radius: 0.625rem;
        background: var(--erp-primary);
        color: white;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .erp-btn--image:hover {
        background: var(--erp-primary-dark);
        transform: translateY(-1px);
    }

    .erp-btn--image.secondary {
        background: var(--erp-border);
        color: var(--erp-text-primary);
    }

    .erp-btn--image.secondary:hover {
        background: var(--erp-border-dark);
    }

    /* ================= HTML CONTENT SECTION ================= */
    .erp-html-section {
        background: var(--erp-surface);
        border-radius: 0.625rem;
        border: 1px solid var(--erp-border);
        overflow: hidden;
    }

    .erp-html-section__header {
        padding: 1rem 1.5rem;
        background: var(--erp-surface-alt);
        border-bottom: 1px solid var(--erp-border);
    }

    .erp-html-section__title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--erp-text-primary);
    }

    .erp-html-section__body {
        padding: 1.5rem;
    }

    .erp-form-textarea--code {
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        background: var(--erp-surface-alt);
        min-height: 200px;
    }

    /* ================= FILE UPLOAD SECTION ================= */
    .erp-file-upload {
        border: 2px dashed var(--erp-primary-light);
        border-radius: 0.75rem;
        padding: 2.5rem 2rem;
        text-align: center;
        background: var(--erp-primary-subtle);
        margin-top: 1.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .erp-file-upload:hover {
        border-color: var(--erp-primary);
        background: rgba(66, 153, 225, 0.05);
    }

    .erp-file-upload__icon {
        width: 3.5rem;
        height: 3.5rem;
        background: linear-gradient(135deg, var(--erp-primary) 0%, var(--erp-primary-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        color: white;
        font-size: 1.5rem;
    }

    .erp-file-upload__title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--erp-primary-dark);
        margin-bottom: 0.5rem;
    }

    .erp-file-upload__subtitle {
        font-size: 0.875rem;
        color: var(--erp-text-tertiary);
        margin-bottom: 0.75rem;
    }

    .erp-file-upload__requirements {
        font-size: 0.75rem;
        color: var(--erp-text-tertiary);
        font-style: italic;
    }

    .erp-file-upload__input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .erp-file-upload__filename {
        margin-top: 1rem;
        font-size: 0.875rem;
        color: var(--erp-accent-success);
        font-weight: 500;
        display: none;
    }

    .erp-file-upload.has-file .erp-file-upload__filename {
        display: block;
    }

    /* ================= FOOTER ACTIONS ================= */
    .erp-createblog-card__footer {
        padding: 1.5rem 2rem;
        border-top: 1px solid var(--erp-border);
        background: var(--erp-surface);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .erp-btn--action {
        padding: 0.875rem 2rem;
        border: none;
        border-radius: 0.625rem;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .erp-btn--secondary {
        background: var(--erp-border);
        color: var(--erp-text-primary);
    }

    .erp-btn--secondary:hover {
        background: var(--erp-border-dark);
        transform: translateY(-1px);
    }

    .erp-btn--primary {
        background: linear-gradient(135deg, var(--erp-primary) 0%, var(--erp-primary-light) 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(44, 82, 130, 0.2);
    }

    .erp-btn--primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(44, 82, 130, 0.3);
    }

    /* Character Counter */
    .erp-char-counter {
        font-size: 0.75rem;
        color: var(--erp-text-tertiary);
        text-align: right;
        margin-top: 0.25rem;
    }

    .erp-char-counter.warning {
        color: var(--erp-warning-dark);
    }

    .erp-char-counter.error {
        color: var(--erp-error-dark);
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
        .erp-content-area {
            padding: 1.5rem;
        }

        .erp-createblog-card {
            max-width: 100%;
        }

        .erp-createblog-form {
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .erp-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 5.625rem 1rem 3.75rem 1rem;
        }

        .erp-page-title {
            font-size: 1.5rem;
            padding: 0 1rem;
        }

        .erp-breadcrumb-global {
            padding: 0 1rem;
            font-size: 0.8125rem;
            margin-bottom: 1.5rem;
        }

        .erp-createblog-card__header {
            padding: 1.25rem 1.5rem;
        }

        .erp-createblog-card__body {
            padding: 1.5rem;
        }

        .erp-createblog-form {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .erp-image-upload {
            height: 10rem;
        }

        .erp-createblog-card__footer {
            padding: 1.25rem 1.5rem;
            flex-direction: column;
        }

        .erp-btn--action {
            width: 100%;
        }

        .erp-file-upload {
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .erp-page-title {
            font-size: 1.375rem;
        }

        .erp-createblog-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .erp-createblog-card__title {
            font-size: 1.125rem;
        }

        .erp-image-actions {
            grid-template-columns: 1fr;
        }

        .erp-form-input,
        .erp-form-textarea,
        .erp-form-select {
            padding: 0.75rem;
        }
    }

    /* Print styles */
    @media print {
        .erp-createblog-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .erp-image-upload,
        .erp-file-upload,
        .erp-btn--action {
            display: none;
        }
    }

    /* ================= MODAL POPUP ================= */
    .erp-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .erp-modal-overlay.active {
        display: flex;
        opacity: 1;
    }

    .erp-modal-content {
        background: #fff;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        max-width: 400px;
        width: 90%;
        text-align: center;
        transform: scale(0.9);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .erp-modal-overlay.active .erp-modal-content {
        transform: scale(1);
    }

    .erp-modal-icon {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
    }

    .erp-modal-icon.success {
        background: rgba(72, 187, 120, 0.1);
        color: #48bb78;
    }

    .erp-modal-icon.error {
        background: rgba(245, 101, 101, 0.1);
        color: #f56565;
    }

    .erp-modal-icon.info {
        background: rgba(66, 153, 225, 0.1);
        color: #4299e1;
    }

    .erp-modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
    }

    .erp-modal-text {
        font-size: 0.9375rem;
        color: #4a5568;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .erp-modal-btn {
        width: 100%;
        padding: 0.875rem;
        border: none;
        border-radius: 0.625rem;
        font-weight: 600;
        cursor: pointer;
        background: var(--erp-primary);
        color: white;
        transition: all 0.2s;
    }

    .erp-modal-btn:hover {
        background: var(--erp-primary-dark);
        transform: translateY(-1px);
    }
</style>

<!-- Modal Overlay -->
<div id="erpMessageModal" class="erp-modal-overlay">
    <div class="erp-modal-content">
        <div class="erp-modal-icon" id="erpModalIcon"></div>
        <h3 class="erp-modal-title" id="erpModalTitle">Notification</h3>
        <p class="erp-modal-text" id="erpModalText"></p>
        <button type="button" class="erp-modal-btn" onclick="closeErpModal()">OK</button>
    </div>
</div>

<main class="erp-content-area" id="blog_list_btn_add_blog_container_02" style="display: none;">
    <!-- ================= PAGE TITLE & BREADCRUMB ================= -->
    <h1 class="erp-page-title">Blog Management</h1>
    <nav class="erp-breadcrumb-global">
        <span>Dashboard</span>
        <span class="erp-breadcrumb__separator">/</span>
        <span>Blog Management</span>
        <span class="erp-breadcrumb__separator">/</span>
        <span><span id="blog_ui5_add_blog_main_container_heading_txt_val_01"></span> Blog</span>
    </nav>

    <!-- ================= CREATE BLOG CARD ================= -->
    <section class="erp-createblog-card">
        <!-- Header -->
        <header class="erp-createblog-card__header">
            <h1 class="erp-createblog-card__title">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                </svg>
                <span id="blog_ui5_add_blog_main_container_heading_txt_val_02"></span> Blog - <?php echo $company_obj->get_compnay_short_name(); ?>
            </h1>
            <button class="erp-btn--icon" id="erpCloseBtn" aria-label="Close" onclick="Blog_List_button_Main_dash_bord_blog_list_OPEN()">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </header>

        <!-- Form Body -->
        <div class="erp-createblog-card__body">
            <input type="hidden" id="blog_ui5_add_blog_and_update_view_state" value="0">
            <input type="hidden" id="blog_ui5_add_blog_and_update_blog_id" value="0">
            <form class="erp-createblog-form" method="POST" id="body_01_01_C_01_from_01">
                <!-- Left Column -->
                <div class="erp-form-section">
                    <!-- Heading -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            Heading
                            <span class="erp-form-required">*</span>
                        </label>
                        <input type="text" class="erp-form-input" id="body_01_01_C_01_heading" placeholder="e.g., Getting Started with Web Development" required>
                    </div>

                    <!-- URI -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            URI
                            <span class="erp-form-required">*</span>
                        </label>
                        <input type="text" class="erp-form-input" id="body_01_01_C_01_uri" placeholder="e.g., getting-started-web-development" required>
                    </div>

                    <!-- SEO Description -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            SEO Description
                            <span class="erp-form-required">*</span>
                        </label>
                        <textarea class="erp-form-textarea" placeholder="Brief description for search engines..." id="body_01_01_C_01_seo_dis" required></textarea>
                        <div class="erp-char-counter" id="seoDescCounter">0/160 characters</div>
                    </div>

                    <!-- SEO Keywords -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            SEO Keywords
                            <span class="erp-form-required">*</span>
                        </label>
                        <textarea class="erp-form-textarea" placeholder="web, development, tutorial, beginner" id="body_01_01_C_01_seo_keywords" required></textarea>
                        <div class="erp-char-counter" id="body_01_01_C_01_seo_keywordsCounter">0/500 characters</div>
                    </div>

                    <!-- Blog Type -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            Type of Blog
                            <span class="erp-form-required">*</span>
                        </label>
                        <select class="erp-form-select" required id="body_01_01_C_01_type_of_blog">

                        </select>
                    </div>

                    <!-- Information Note -->
                    <div class="erp-info-note">
                        <div class="erp-info-note__title">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                            </svg>
                            Important Note
                        </div>
                        <div class="erp-info-note__text">
                            In this HTML code, the process involves uploading an image, retrieving the image path, and then using that path within the code to display the image.
                            The code should only include HTML content, without using the body tag, and all styling must be done with inline CSS only.
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="erp-form-group">
                        <label class="erp-form-label">
                            Blog Image
                            <span class="erp-form-required">*</span>
                        </label>
                        <input type="hidden" id="body_02_B_03_IMAGE_from_id_image_pth_txt">

                        <div class="erp-image-upload" id="imageUploadArea">

                            <div class="erp-image-upload__icon">
                                <svg viewBox="0 0 24 24" width="48" height="48" fill="currentColor">
                                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                                </svg>
                            </div>
                            <div class="erp-image-upload__text">Click to upload blog image</div>
                            <img class="erp-image-upload__preview" id="imagePreview" alt="Blog image preview">
                            <button type="button" class="erp-image-upload__remove" id="removeImageBtn">×</button>
                            <input type="file" class="erp-image-upload__input" id="imageInput" accept="image/*" required>
                        </div>

                        <!-- Image Actions -->
                        <div class="erp-image-actions">
                            <button type="button" class="erp-btn--image" id="uploadImageBtn">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                    <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2v9.67z" />
                                </svg>
                                Upload Image
                            </button>
                            <button type="button" class="erp-btn--image secondary" id="scanImageBtn">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 16H6c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1z" />
                                </svg>
                                Scan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="erp-form-section">
                    <!-- HTML Content -->
                    <div class="erp-html-section">
                        <div class="erp-html-section__header">
                            <div class="erp-html-section__title">
                                HTML Content
                                <span class="erp-form-required">*</span>
                            </div>
                        </div>
                        <div class="erp-html-section__body">
                            <div class="erp-form-group">
                                <label class="erp-form-label">
                                    Information Data HTML CODE (2000 characters maximum)
                                    <span class="erp-form-required">*</span>
                                </label>
                                <textarea class="erp-form-textarea erp-form-textarea--code"
                                    placeholder="&lt;div style='padding: 20px;'&gt;&#10;  &lt;h1&gt;Your Content Here&lt;/h1&gt;&#10;  &lt;p&gt;Write your HTML content...&lt;/p&gt;&#10;&lt;/div&gt;"
                                    id="body_01_01_C_01_html_code"
                                    rows="10"
                                    required></textarea>
                                <div class="erp-char-counter" id="body_01_01_C_01_html_codeCounter">0/2000 characters</div>
                            </div>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="erp-file-upload" id="fileUploadArea">
                        <div class="erp-file-upload__icon">
                            <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z" />
                            </svg>
                        </div>
                        <div class="erp-file-upload__title">Upload HTML/File</div>
                        <div class="erp-file-upload__subtitle">Click or drag a file here</div>
                        <div class="erp-file-upload__requirements">Supports .html and .php files only</div>
                        <div class="erp-file-upload__filename" id="fileName"></div>
                        <input type="file" class="erp-file-upload__input" id="body_01_01_C_01_file" accept=".html,.htm,.php">
                    </div>
                    <p id="message"></p>

                </div>

            </form>
        </div>

        <!-- Footer Actions -->
        <footer class="erp-createblog-card__footer">
            <button type="button" class="erp-btn--action erp-btn--secondary" id="cancelBtn" onclick="Blog_List_button_Main_dash_bord_blog_list_OPEN()">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
                Cancel
            </button>
            <button type="submit" class="erp-btn--action erp-btn--primary" id="processBlogBtn" form="body_01_01_C_01_from_01">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                    <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" />
                </svg>
                Process Blog
            </button>
        </footer>
    </section>
</main>