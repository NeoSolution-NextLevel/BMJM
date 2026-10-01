<style>
    /* ================= MAIN CONTENT AREA ================= */
    .erp-blog-content-area {
        flex: 1;
        padding: 32px;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        min-height: calc(100vh - 50px - 32px);
        background: var(--erp-surface-alt);
    }

    .erp-sidebar.collapsed~.erp-blog-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }

    /* ================= PAGE TITLE & BREADCRUMB ================= */
    .erp-blog-page-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 8px 0;
        color: var(--erp-primary-dark);
        padding-top: 10px;
    }

    .erp-blog-breadcrumb-global {
        font-size: 14px;
        color: var(--erp-text-tertiary);
        text-align: center;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .erp-blog-breadcrumb__separator {
        color: var(--erp-border-dark);
    }

    /* ================= BLOG CARD ================= */
    .erp-blog-card {
        background: var(--erp-surface);
        border-radius: 10px;
        border: 1px solid var(--erp-border);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        max-width: 800px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header */
    .erp-blog-card__header {
        padding: 20px 24px;
        background: var(--erp-primary);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px 10px 0 0;
    }

    .erp-blog-card__title {
        font-size: 18px;
        font-weight: 600;
    }

    .erp-blog-btn--icon {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .erp-blog-btn--icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* ================= FORM ================= */
    .erp-blog-card__body {
        padding: 24px;
    }

    .erp-blog-form__group {
        margin-bottom: 18px;
    }

    .erp-blog-form__label {
        font-size: 13px;
        color: var(--erp-text-tertiary);
        margin-bottom: 6px;
        display: block;
    }

    .erp-blog-form__label--required::after {
        content: " *";
        color: var(--erp-error-dark);
    }

    .erp-blog-form__input {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid var(--erp-border);
        background: var(--erp-surface);
        color: var(--erp-text-primary);
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .erp-blog-form__input:focus {
        outline: none;
        border-color: var(--erp-primary-light);
        box-shadow: 0 0 0 3px var(--erp-primary-subtle);
    }

    /* ================= IMAGE UPLOAD AREA ================= */
    .erp-blog-image-upload-area {
        position: relative;
        background: var(--erp-primary-dark);
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        color: white;
        margin-bottom: 20px;
        min-height: 170px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s;
        overflow: hidden;
    }

    .erp-blog-image-upload-area:hover {
        background: var(--erp-primary);
    }

    .erp-blog-image-upload-area.has-image {
        background: var(--erp-surface-alt);
        border: 2px dashed var(--erp-border-dark);
        padding: 10px;
    }

    .erp-blog-image-upload-area__icon {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.8;
    }

    .erp-blog-image-upload-area__text {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .erp-blog-image-upload-area__subtext {
        font-size: 12px;
        opacity: 0.7;
        position: absolute;
        bottom: 8px;
        left: 12px;
    }

    .erp-blog-image-upload-area__preview {
        max-width: 100%;
        max-height: 140px;
        object-fit: contain;
        border-radius: 6px;
        display: none;
    }

    .erp-blog-image-upload-area.has-image .erp-blog-image-upload-area__preview {
        display: block;
    }

    .erp-blog-image-upload-area.has-image .erp-blog-image-upload-area__icon,
    .erp-blog-image-upload-area.has-image .erp-blog-image-upload-area__text {
        display: none;
    }

    .erp-blog-image-upload-area__remove {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--erp-error-dark);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 16px;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: background 0.2s;
    }

    .erp-blog-image-upload-area.has-image:hover .erp-blog-image-upload-area__remove {
        display: flex;
    }

    .erp-blog-image-upload-area__remove:hover {
        background: var(--erp-error-darker);
    }

    .erp-blog-image-upload-area__input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* ================= ACTION BUTTONS ================= */
    .erp-blog-action-buttons {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .erp-blog-btn--action {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: var(--erp-primary);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .erp-blog-btn--action:hover {
        background: var(--erp-primary-dark);
        transform: translateY(-1px);
    }

    .erp-blog-btn--action.secondary {
        background: var(--erp-border-dark);
        color: var(--erp-text-primary);
    }

    .erp-blog-btn--action.secondary:hover {
        background: var(--erp-border);
    }

    /* ================= FOOTER ACTIONS ================= */
    .erp-blog-card__footer {
        padding: 20px 24px;
        border-top: 1px solid var(--erp-border);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .erp-blog-btn {
        padding: 10px 18px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
        min-height: 40px;
        min-width: 120px;
    }

    .erp-blog-btn--secondary {
        background: var(--erp-border);
        color: var(--erp-text-primary);
    }

    .erp-blog-btn--secondary:hover {
        background: var(--erp-border-dark);
    }

    .erp-blog-btn--primary {
        background: var(--erp-primary);
        color: #fff;
    }

    .erp-blog-btn--primary:hover {
        background: var(--erp-primary-dark);
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
        .erp-blog-content-area {
            padding: 24px;
        }

        .erp-blog-card {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .erp-blog-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 90px 16px 60px 16px;
        }

        .erp-blog-page-title {
            font-size: 24px;
            padding: 0 16px;
        }

        .erp-blog-breadcrumb-global {
            padding: 0 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .erp-blog-card__header {
            padding: 16px 20px;
        }

        .erp-blog-card__body {
            padding: 20px;
        }

        .erp-blog-action-buttons {
            flex-direction: column;
        }

        .erp-blog-card__footer {
            padding: 16px 20px;
            flex-direction: column;
            align-items: stretch;
        }

        .erp-blog-btn {
            width: 100%;
            min-width: 0;
        }

        .erp-blog-image-upload-area {
            min-height: 140px;
            padding: 30px 20px;
        }
    }

    @media (max-width: 480px) {
        .erp-blog-page-title {
            font-size: 22px;
        }

        .erp-blog-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .erp-blog-card__title {
            font-size: 16px;
        }

        .erp-blog-form__group {
            margin-bottom: 16px;
        }

        .erp-blog-image-upload-area {
            min-height: 120px;
            padding: 20px;
        }

        .erp-blog-image-upload-area__icon {
            font-size: 36px;
        }

        .erp-blog-image-upload-area__text {
            font-size: 14px;
        }

        .erp-blog-btn {
            padding: 12px 16px;
            font-size: 14px;
        }
    }

    @media (max-width: 360px) {
        .erp-blog-card__body {
            padding: 16px;
        }

        .erp-blog-image-upload-area {
            min-height: 100px;
            padding: 15px;
        }

        .erp-blog-image-upload-area__icon {
            font-size: 32px;
        }

        .erp-blog-action-buttons {
            gap: 8px;
        }
    }

    /* Print styles */
    @media print {
        .erp-blog-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .erp-blog-page-title {
            margin-top: 20px;
        }

        .erp-blog-image-upload-area {
            border: 1px solid #ddd;
            background: white !important;
            color: black !important;
        }
    }
</style>

<main class="erp-blog-content-area" id="need_image_blog_ad_new_need_image_main_container">
    <!-- ================= PAGE TITLE & BREADCRUMB ================= -->
    <h1 class=" erp-blog-page-title">Blog Management</h1>
    <nav class="erp-blog-breadcrumb-global">
        <span>Dashboard</span>
        <span class="erp-blog-breadcrumb__separator">/</span>
        <span>Blog Management</span>
        <span class="erp-blog-breadcrumb__separator">/</span>
        <span>Create New Blog</span>
    </nav>

    <!-- ================= CREATE BLOG CARD ================= -->
    <section class="erp-blog-card">
        <header class="erp-blog-card__header">
            <h1 class="erp-blog-card__title">Create New Image</h1>
            <button class="erp-blog-btn--icon" id="erpBlogCloseBtn" onclick="Need_Image_button_Main_dash_bord_need_image_LIST_OPEN()">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="white">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </header>

        <div class="erp-blog-card__body">
            <form id="neo_solution_04_body_02_from" method="POST" enctype="multipart/form-data">
                <div class="erp-blog-form__group">
                    <label class="erp-blog-form__label erp-blog-form__label--required">Image Label</label>
                    <input type="text" class="erp-blog-form__input" id="neo_solution_04_body_02_from_val_01" name="image_label" placeholder="type of image " required>
                </div>

                <!-- Image Upload Area -->
                <input type="hidden" id="neo_solution_04_body_02_from_image_pth_txt" value="0">
                <div class="erp-blog-image-upload-area" id="blogImageUploadArea">
                    <div class="erp-blog-image-upload-area__icon">
                        <svg viewBox="0 0 24 24" width="48" height="48" fill="white">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                        </svg>
                    </div>
                    <div class="erp-blog-image-upload-area__text">Item Image Not Found</div>
                    <div class="erp-blog-image-upload-area__subtext">NEO</div>
                    <img class="erp-blog-image-upload-area__preview" id="blogImagePreview" alt="Preview">
                    <button class="erp-blog-image-upload-area__remove" id="blogRemoveImageBtn" type="button">×</button>
                    <input type="file" class="erp-blog-image-upload-area__input" id="blogImageUpload" name="blog_image" accept="image/*">
                </div>

                <!-- Action Buttons -->
                <div class="erp-blog-action-buttons">
                    <button type="button" class="erp-blog-btn--action" id="blog_ui1_add_Need_new_Image_blog_image_upload_btn">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="white">
                            <path d="M19 12v7H5v-7H3v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7h-2zm-6 .67l2.59-2.58L17 11.5l-5 5-5-5 1.41-1.41L11 12.67V3h2v9.67z" />
                        </svg>
                        Upload Image
                    </button>
                    <button type="button" class="erp-blog-btn--action secondary" id="blogScanBtn">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 16H6c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1h12c.55 0 1 .45 1 1v12c0 .55-.45 1-1 1z" />
                        </svg>
                        Scan
                    </button>
                </div>
            </form>
        </div>

        <footer class="erp-blog-card__footer">
            <button class="erp-blog-btn erp-blog-btn--secondary" id="blogCancelBtn" onclick="Need_Image_button_Main_dash_bord_need_image_LIST_OPEN()">
                <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right: 8px; vertical-align: middle;">
                    <path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
                Cancel
            </button>
            <button class="erp-blog-btn erp-blog-btn--primary" id="blogSubmitBtn" type="submit" form="neo_solution_04_body_02_from">
                <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right: 8px; vertical-align: middle;">
                    <path fill="white" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                </svg>
                Submit
            </button>
        </footer>
    </section>
</main>