<!-- components/content/blog_type.php -->

<style>
    /* ================= MAIN CONTENT AREA ================= */
    .erp-blog3-content-area {
        flex: 1;
        padding: 32px;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        min-height: calc(100vh - 50px - 32px);
        background: var(--erp-surface-alt);
    }

    .erp-sidebar.collapsed~.erp-blog3-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }

    /* ================= PAGE TITLE & BREADCRUMB ================= */
    .erp-blog3-page-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 8px 0;
        color: var(--erp-primary-dark);
        padding-top: 10px;
    }

    .erp-blog3-breadcrumb-global {
        font-size: 14px;
        color: var(--erp-text-tertiary);
        text-align: center;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .erp-blog3-breadcrumb__separator {
        color: var(--erp-border-dark);
    }

    /* ================= BLOG TYPE CARD ================= */
    .erp-blog3-card {
        background: var(--erp-surface);
        border-radius: 10px;
        border: 1px solid var(--erp-border);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        max-width: 900px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header */
    .erp-blog3-card__header {
        padding: 20px 24px;
        background: var(--erp-primary);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px 10px 0 0;
    }

    .erp-blog3-card__title {
        font-size: 18px;
        font-weight: 600;
    }

    .erp-blog3-btn--icon {
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

    .erp-blog3-btn--icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* ================= FORM ================= */
    .erp-blog3-card__body {
        padding: 24px;
    }

    .erp-blog3-form__group {
        margin-bottom: 25px;
    }

    .erp-blog3-form__label {
        font-size: 13px;
        color: var(--erp-text-tertiary);
        margin-bottom: 8px;
        display: block;
        font-weight: 600;
    }

    .erp-blog3-form__label--required::after {
        content: " *";
        color: var(--erp-error-dark);
    }

    .erp-blog3-form__input {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid var(--erp-border);
        background: var(--erp-surface);
        color: var(--erp-text-primary);
        font-size: 14px;
        transition: all 0.2s;
    }

    .erp-blog3-form__input:focus {
        outline: none;
        border-color: var(--erp-primary-light);
        box-shadow: 0 0 0 3px var(--erp-primary-subtle);
    }

    .erp-blog3-form__input::placeholder {
        color: var(--erp-text-tertiary);
        opacity: 0.7;
    }

    /* ================= ACTIONS ================= */
    .erp-blog3-actions {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .erp-blog3-btn {
        flex: 1;
        padding: 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
        min-height: 44px;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .erp-blog3-btn--secondary {
        background: var(--erp-border);
        color: var(--erp-text-primary);
    }

    .erp-blog3-btn--secondary:hover {
        background: var(--erp-border-dark);
        transform: translateY(-1px);
    }

    .erp-blog3-btn--primary {
        background: var(--erp-primary);
        color: #fff;
    }

    .erp-blog3-btn--primary:hover {
        background: var(--erp-primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* ================= TYPES LIST (if needed) ================= */
    .erp-blog3-types-list {
        margin-top: 30px;
        border-top: 1px dashed var(--erp-border-dark);
        padding-top: 20px;
    }

    .erp-blog3-types-list__title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--erp-primary-dark);
    }

    .erp-blog3-types-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    .erp-blog3-type-tag {
        background: var(--erp-surface-alt);
        border: 1px solid var(--erp-border);
        padding: 10px 15px;
        border-radius: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
    }

    .erp-blog3-type-tag__actions {
        display: flex;
        gap: 8px;
    }

    .erp-blog3-type-tag__btn {
        background: none;
        border: none;
        color: var(--erp-text-tertiary);
        cursor: pointer;
        font-size: 12px;
        padding: 4px;
        border-radius: 3px;
        transition: all 0.2s;
    }

    .erp-blog3-type-tag__btn:hover {
        background: var(--erp-primary-subtle);
        color: var(--erp-primary);
    }

    .erp-blog3-type-tag__btn--delete:hover {
        background: var(--erp-error-light);
        color: var(--erp-error-dark);
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
        .erp-blog3-content-area {
            padding: 24px;
        }

        .erp-blog3-card {
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .erp-blog3-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 90px 16px 60px 16px;
        }

        .erp-blog3-page-title {
            font-size: 24px;
            padding: 0 16px;
        }

        .erp-blog3-breadcrumb-global {
            padding: 0 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .erp-blog3-card__header {
            padding: 16px 20px;
        }

        .erp-blog3-card__body {
            padding: 20px;
        }

        .erp-blog3-actions {
            flex-direction: column;
            gap: 12px;
        }

        .erp-blog3-types-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .erp-blog3-page-title {
            font-size: 22px;
        }

        .erp-blog3-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .erp-blog3-card__title {
            font-size: 16px;
        }

        .erp-blog3-form__group {
            margin-bottom: 20px;
        }

        .erp-blog3-btn {
            padding: 12px;
            font-size: 14px;
        }

        .erp-blog3-types-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 360px) {
        .erp-blog3-card__body {
            padding: 16px;
        }

        .erp-blog3-form__input {
            padding: 10px;
            font-size: 14px;
        }
    }

    /* Print styles */
    @media print {
        .erp-blog3-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .erp-blog3-page-title {
            margin-top: 20px;
        }

        .erp-blog3-btn {
            display: none;
        }

        .erp-blog3-form__input {
            border: 1px solid #ddd;
        }
    }
</style>

<main class="erp-blog3-content-area" id="type_of_blog_list_btn_add_blog_type_main_content_01">
    <!-- ================= PAGE TITLE & BREADCRUMB ================= -->
    <h1 class="erp-blog3-page-title">Blog Management</h1>
    <nav class="erp-blog3-breadcrumb-global">
        <span>Dashboard</span>
        <span class="erp-blog3-breadcrumb__separator">/</span>
        <span>Blog Management</span>
        <span class="erp-blog3-breadcrumb__separator">/</span>
        <span>Create Blog Type</span>
    </nav>

    <!-- ================= CREATE BLOG TYPE CARD ================= -->
    <section class="erp-blog3-card">
        <header class="erp-blog3-card__header">
            <h1 class="erp-blog3-card__title">Create New Blog Type</h1>
            <button class="erp-blog3-btn--icon" id="erpBlog3CloseBtn" onclick="Main_dash_bord_blog_type_list_btn_blog_type_list_OPEN()">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="white">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </header>

        <div class="erp-blog3-card__body">
            <form id="blog_setup_01_add_type_of_blog_from" method="POST">

                <div class="erp-blog3-form__group">
                    <label class="erp-blog3-form__label erp-blog3-form__label--required">Type Of Blog</label>
                    <input type="text" class="erp-blog3-form__input" name="blog3_type" placeholder="e.g., Web Development, Technology, Marketing" required id="blog_setup_01_add_type_of_blog_from_name">
                </div>

                <!-- Actions -->
                <div class="erp-blog3-actions">
                    <button type="button" class="erp-blog3-btn erp-blog3-btn--secondary" id="blog3CancelBtn" onclick="Main_dash_bord_blog_type_list_btn_blog_type_list_OPEN()">
                        <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right: 8px;">
                            <path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                        </svg>
                        Cancel
                    </button>
                    <button type="submit" class="erp-blog3-btn erp-blog3-btn--primary" id="blog3SaveBtn">
                        <svg viewBox="0 0 24 24" width="16" height="16" style="margin-right: 8px;">
                            <path fill="white" d="M21 7v14H3V3h14l4 4zm-10 9v-4h2v4h-2zm2-8V5H5v14h14V9h-4V7h-2v1h-2z" />
                        </svg>
                        Save Blog Type
                    </button>
                </div>
            </form>


        </div>
    </section>
</main>

<script>

</script>