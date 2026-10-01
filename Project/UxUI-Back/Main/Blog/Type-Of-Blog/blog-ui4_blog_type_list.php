<style>
    /* ================= MAIN CONTENT AREA ================= */
    .blog4-erp-content-area {
        flex: 1;
        padding: 2rem;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        min-height: calc(100vh - 50px - 2rem);
        background: var(--erp-surface-alt);
    }

    .blog4-erp-sidebar.collapsed~.blog4-erp-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }

    /* ================= PAGE TITLE & BREADCRUMB ================= */
    .blog4-erp-page-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        color: var(--erp-primary-dark);
        text-align: center;
        letter-spacing: -0.5px;
    }

    .blog4-erp-breadcrumb-global {
        font-size: 0.875rem;
        color: var(--erp-text-tertiary);
        text-align: center;
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .blog4-erp-breadcrumb__separator {
        color: var(--erp-border-dark);
    }

    /* ================= MAIN CARD ================= */
    .blog4-erp-blogtypelist-card {
        background: var(--erp-surface);
        border-radius: 0.75rem;
        border: 1px solid var(--erp-border);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        max-width: 1000px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header */
    .blog4-erp-blogtypelist-card__header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, var(--erp-primary) 0%, var(--erp-primary-dark) 100%);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .blog4-erp-blogtypelist-card__title {
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .blog4-erp-btn--icon {
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

    .blog4-erp-btn--icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    /* ================= SEARCH SECTION ================= */
    .blog4-erp-blogtypelist-card__search {
        padding: 1.5rem 2rem;
        background: var(--erp-surface-alt);
        border-bottom: 1px solid var(--erp-border);
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1rem;
        align-items: center;
    }

    .blog4-erp-search-box {
        position: relative;
    }

    .blog4-erp-search-box__input {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        border-radius: 0.625rem;
        border: 1px solid var(--erp-border);
        background: var(--erp-surface);
        color: var(--erp-text-primary);
        font-size: 0.9375rem;
        transition: all 0.2s ease;
    }

    .blog4-erp-search-box__input:focus {
        outline: none;
        border-color: var(--erp-primary);
        box-shadow: 0 0 0 3px rgba(44, 82, 130, 0.1);
    }

    .blog4-erp-search-box__input::placeholder {
        color: var(--erp-text-tertiary);
        opacity: 0.7;
    }

    .blog4-erp-search-box__icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--erp-text-tertiary);
        font-size: 1rem;
        pointer-events: none;
    }

    .blog4-erp-btn--new {
        padding: 0.875rem 1.5rem;
        border: none;
        border-radius: 0.625rem;
        background: linear-gradient(135deg, var(--erp-primary) 0%, var(--erp-primary-light) 100%);
        color: white;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        white-space: nowrap;
        height: 3rem;
        box-shadow: 0 2px 8px rgba(44, 82, 130, 0.2);
    }

    .blog4-erp-btn--new:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(44, 82, 130, 0.3);
    }

    /* ================= LIST SECTION ================= */
    .blog4-erp-blogtypelist-card__list {
        padding: 1.5rem 2rem;
        max-height: 500px;
        overflow-y: auto;
    }

    /* Table Header */
    .blog4-erp-blogtype-header {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: var(--erp-surface-alt);
        border-radius: 0.5rem;
        margin-bottom: 0.75rem;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--erp-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Blog Type Row */
    .blog4-erp-blogtype-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 1rem;
        padding: 1.25rem;
        background: var(--erp-surface);
        border: 1px solid var(--erp-border);
        border-radius: 0.625rem;
        margin-bottom: 0.75rem;
        align-items: center;
        transition: all 0.2s ease;
    }

    .blog4-erp-blogtype-row:hover {
        border-color: var(--erp-primary-light);
        background: var(--erp-primary-subtle);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .blog4-erp-blogtype-row__name {
        font-size: 1rem;
        font-weight: 500;
        color: var(--erp-text-primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .blog4-erp-blogtype-row__icon {
        width: 2.5rem;
        height: 2.5rem;
        background: linear-gradient(135deg, var(--erp-primary-light) 0%, var(--erp-primary) 100%);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .blog4-erp-blogtype-row__status {
        font-size: 0.8125rem;
        font-weight: 500;
        padding: 0.375rem 0.875rem;
        border-radius: 2rem;
        text-align: center;
        justify-self: start;
    }

    .blog4-erp-blogtype-row__status--active {
        background: rgba(56, 161, 105, 0.1);
        color: var(--erp-accent-success);
        border: 1px solid rgba(56, 161, 105, 0.2);
    }

    .blog4-erp-blogtype-row__status--inactive {
        background: rgba(229, 62, 62, 0.1);
        color: var(--erp-error-dark);
        border: 1px solid rgba(229, 62, 62, 0.2);
    }

    .blog4-erp-blogtype-row__actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    /* Action Buttons */
    .blog4-erp-btn--action {
        padding: 0.625rem 1.25rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.8125rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 140px;
        justify-content: center;
    }

    .blog4-erp-btn--danger {
        background: linear-gradient(135deg, var(--erp-error-dark) 0%, #c53030 100%);
        color: white;
        box-shadow: 0 2px 6px rgba(229, 62, 62, 0.2);
    }

    .blog4-erp-btn--danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
    }

    .blog4-erp-btn--activate {
        background: linear-gradient(135deg, var(--erp-accent-success) 0%, #2f855a 100%);
        color: white;
        box-shadow: 0 2px 6px rgba(56, 161, 105, 0.2);
    }

    .blog4-erp-btn--activate:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(56, 161, 105, 0.3);
    }

    .blog4-erp-btn--edit {
        background: var(--erp-surface);
        color: var(--erp-text-secondary);
        border: 1px solid var(--erp-border);
        padding: 0.625rem;
        min-width: auto;
        width: 2.5rem;
        height: 2.5rem;
    }

    .blog4-erp-btn--edit:hover {
        background: var(--erp-primary-subtle);
        color: var(--erp-primary);
        border-color: var(--erp-primary-light);
    }

    /* Empty State */
    .blog4-erp-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--erp-text-tertiary);
    }

    .blog4-erp-empty-state__icon {
        width: 5rem;
        height: 5rem;
        background: var(--erp-surface-alt);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--erp-border-dark);
        font-size: 2rem;
    }

    .blog4-erp-empty-state__text {
        font-size: 1.125rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--erp-text-secondary);
    }

    .blog4-erp-empty-state__subtext {
        font-size: 0.9375rem;
        opacity: 0.7;
        max-width: 400px;
        margin: 0 auto;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
        .blog4-erp-content-area {
            padding: 1.5rem;
        }

        .blog4-erp-blogtypelist-card {
            max-width: 100%;
        }

        .blog4-erp-blogtype-header,
        .blog4-erp-blogtype-row {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .blog4-erp-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 5.625rem 1rem 3.75rem 1rem;
        }

        .blog4-erp-page-title {
            font-size: 1.5rem;
            padding: 0 1rem;
        }

        .blog4-erp-breadcrumb-global {
            padding: 0 1rem;
            font-size: 0.8125rem;
            margin-bottom: 1.5rem;
        }

        .blog4-erp-blogtypelist-card__header {
            padding: 1.25rem 1.5rem;
        }

        .blog4-erp-blogtypelist-card__search {
            padding: 1.25rem 1.5rem;
            grid-template-columns: 1fr;
        }

        .blog4-erp-blogtypelist-card__list {
            padding: 1.25rem 1.5rem;
        }

        .blog4-erp-blogtype-header {
            display: none;
        }

        .blog4-erp-blogtype-row {
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1.5rem;
        }

        .blog4-erp-blogtype-row__name {
            font-size: 1.125rem;
        }

        .blog4-erp-blogtype-row__status {
            justify-self: start;
        }

        .blog4-erp-blogtype-row__actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .blog4-erp-btn--action {
            min-width: 100%;
        }

        .blog4-erp-btn--new {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .blog4-erp-page-title {
            font-size: 1.375rem;
        }

        .blog4-erp-blogtypelist-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .blog4-erp-blogtypelist-card__title {
            font-size: 1.125rem;
        }

        .blog4-erp-blogtype-row {
            padding: 1.25rem;
        }

        .blog4-erp-empty-state {
            padding: 3rem 1rem;
        }
    }

    /* Scrollbar Styling */
    .blog4-erp-blogtypelist-card__list::-webkit-scrollbar {
        width: 6px;
    }

    .blog4-erp-blogtypelist-card__list::-webkit-scrollbar-track {
        background: var(--erp-surface-alt);
        border-radius: 3px;
    }

    .blog4-erp-blogtypelist-card__list::-webkit-scrollbar-thumb {
        background: var(--erp-border-dark);
        border-radius: 3px;
    }

    .blog4-erp-blogtypelist-card__list::-webkit-scrollbar-thumb:hover {
        background: var(--erp-text-tertiary);
    }

    /* Print styles */
    @media print {
        .blog4-erp-blogtypelist-card {
            box-shadow: none;
            border: 1px solid #ddd;
        }

        .blog4-erp-blogtypelist-card__search,
        .blog4-erp-btn--icon,
        .blog4-erp-btn--action {
            display: none;
        }

        .blog4-erp-blogtype-row {
            break-inside: avoid;
            border: 1px solid #ddd;
        }
    }
</style>

<main class="blog4-erp-content-area" id="type_of_blog_list_btn_type_list_main_content_01">
    <!-- ================= PAGE TITLE & BREADCRUMB ================= -->
    <h1 class="blog4-erp-page-title">Blog Management</h1>
    <nav class="blog4-erp-breadcrumb-global">
        <span>Dashboard</span>
        <span class="blog4-erp-breadcrumb__separator">/</span>
        <span>Blog Management</span>
        <span class="blog4-erp-breadcrumb__separator">/</span>
        <span>Blog Type List</span>
    </nav>

    <!-- ================= MAIN CARD ================= -->
    <section class="blog4-erp-blogtypelist-card">
        <!-- Header -->
        <header class="blog4-erp-blogtypelist-card__header">
            <h1 class="blog4-erp-blogtypelist-card__title">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                </svg>
                Blog Type List
            </h1>
            <button class="blog4-erp-btn--icon" id="blog4ErpCloseBtn" aria-label="Close">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                </svg>
            </button>
        </header>

        <!-- Search Section -->
        <div class="blog4-erp-blogtypelist-card__search">
            <div class="blog4-erp-search-box">
                <svg class="blog4-erp-search-box__icon" viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                </svg>
                <input type="text" class="blog4-erp-search-box__input" placeholder="Search blog type..." id="blog_ui4_blog_type_list_search_txt" onkeydown="load_type_of_blog_list(); ">
            </div>
            <button class="blog4-erp-btn--new" id="newTypeBtn" onclick="Main_dash_bord_blog_type_list_btn_add_blog_type_OPEN()">
                <svg viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                </svg>
                New Blog Type
            </button>
        </div>

        <!-- List Section -->
        <div class="blog4-erp-blogtypelist-card__list" id="type_of_blog_list_btn_type_list_data_SET_DB">

            <!-- 
            <div class="blog4-erp-blogtype-row" data-name="Technology" data-status="active">
                <div class="blog4-erp-blogtype-row__name">
                    <div class="blog4-erp-blogtype-row__icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                            <path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z" />
                        </svg>
                    </div>
                    <span>Technology</span>
                </div>
                <div class="blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--active">
                    Active
                </div>
                <div class="blog4-erp-blogtype-row__actions">
                    <button class="blog4-erp-btn--edit" onclick="editBlogType('Technology')" aria-label="Edit">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </button>
                    <button class="blog4-erp-btn--action blog4-erp-btn--danger" onclick="toggleBlogTypeStatus('Technology', 'deactivate')">
                        Deactivate
                    </button>
                </div>
            </div>

            <div class="blog4-erp-blogtype-row" data-name="Business" data-status="active">
                <div class="blog4-erp-blogtype-row__name">
                    <div class="blog4-erp-blogtype-row__icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                            <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                        </svg>
                    </div>
                    <span>Business</span>
                </div>
                <div class="blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--active">
                    Active
                </div>
                <div class="blog4-erp-blogtype-row__actions">
                    <button class="blog4-erp-btn--edit" onclick="editBlogType('Business')" aria-label="Edit">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </button>
                    <button class="blog4-erp-btn--action blog4-erp-btn--danger" onclick="toggleBlogTypeStatus('Business', 'deactivate')">
                        Deactivate
                    </button>
                </div>
            </div>

            <div class="blog4-erp-blogtype-row" data-name="Marketing" data-status="inactive">
                <div class="blog4-erp-blogtype-row__name">
                    <div class="blog4-erp-blogtype-row__icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                            <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z" />
                        </svg>
                    </div>
                    <span>Marketing</span>
                </div>
                <div class="blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--inactive">
                    Inactive
                </div>
                <div class="blog4-erp-blogtype-row__actions">
                    <button class="blog4-erp-btn--edit" onclick="editBlogType('Marketing')" aria-label="Edit">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </button>
                    <button class="blog4-erp-btn--action blog4-erp-btn--activate" onclick="toggleBlogTypeStatus('Marketing', 'activate')">
                        Activate
                    </button>
                </div>
            </div>

            <div class="blog4-erp-blogtype-row" data-name="Lifestyle" data-status="active">
                <div class="blog4-erp-blogtype-row__name">
                    <div class="blog4-erp-blogtype-row__icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <span>Lifestyle</span>
                </div>
                <div class="blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--active">
                    Active
                </div>
                <div class="blog4-erp-blogtype-row__actions">
                    <button class="blog4-erp-btn--edit" onclick="editBlogType('Lifestyle')" aria-label="Edit">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </button>
                    <button class="blog4-erp-btn--action blog4-erp-btn--danger" onclick="toggleBlogTypeStatus('Lifestyle', 'deactivate')">
                        Deactivate
                    </button>
                </div>
            </div>

            <div class="blog4-erp-blogtype-row" data-name="Education" data-status="inactive">
                <div class="blog4-erp-blogtype-row__name">
                    <div class="blog4-erp-blogtype-row__icon">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                            <path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z" />
                        </svg>
                    </div>
                    <span>Education</span>
                </div>
                <div class="blog4-erp-blogtype-row__status blog4-erp-blogtype-row__status--inactive">
                    Inactive
                </div>
                <div class="blog4-erp-blogtype-row__actions">
                    <button class="blog4-erp-btn--edit" onclick="editBlogType('Education')" aria-label="Edit">
                        <svg viewBox="0 0 24 24" width="16" height="16">
                            <path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                    </button>
                    <button class="blog4-erp-btn--action blog4-erp-btn--activate" onclick="toggleBlogTypeStatus('Education', 'activate')">
                        Activate
                    </button>
                </div>
            </div> -->


        </div>
    </section>
</main>

<script>
    // Content-specific JavaScript for blog type list
    document.addEventListener('DOMContentLoaded', function() {
        const blog4ErpCloseBtn = document.getElementById('blog4ErpCloseBtn');
        const newTypeBtn = document.getElementById('newTypeBtn');
        const searchInput = document.getElementById('searchInput');
        const blogTypeList = document.getElementById('blogTypeList');
        const blogTypeRows = document.querySelectorAll('.blog4-erp-blogtype-row');

        /* =========================================================
           CLOSE BUTTON
           ========================================================= */
        if (blog4ErpCloseBtn) {
            blog4ErpCloseBtn.addEventListener("click", () => {
                if (confirm('Are you sure you want to close the blog type list?')) {
                    alert("Redirecting to blog management...");
                    // window.location.href = 'blog_management.php';
                }
            });
        }


        /* =========================================================
           SEARCH FUNCTIONALITY
           ========================================================= */
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchTerm = this.value.toLowerCase().trim();

                searchTimeout = setTimeout(() => {
                    let hasResults = false;

                    blogTypeRows.forEach(row => {
                        const name = row.getAttribute('data-name').toLowerCase();
                        if (searchTerm === '' || name.includes(searchTerm)) {
                            row.style.display = 'grid';
                            hasResults = true;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Show empty state if no results
                    if (!hasResults && searchTerm !== '') {
                        showEmptyState(searchTerm);
                    } else {
                        removeEmptyState();
                    }
                }, 300);
            });
        }

        /* =========================================================
           HELPER FUNCTIONS
           ========================================================= */
        function showEmptyState(searchTerm) {
            removeEmptyState();

            const emptyState = document.createElement('div');
            emptyState.className = 'blog4-erp-empty-state';
            emptyState.id = 'emptyState';
            emptyState.innerHTML = `
                <div class="blog4-erp-empty-state__icon">
                    <svg viewBox="0 0 24 24" width="32" height="32">
                        <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5z"/>
                    </svg>
                </div>
                <div class="blog4-erp-empty-state__text">No results found for "${searchTerm}"</div>
                <div class="blog4-erp-empty-state__subtext">Try adjusting your search terms or create a new blog type.</div>
            `;

            blogTypeList.appendChild(emptyState);
        }

        function removeEmptyState() {
            const emptyState = document.getElementById('emptyState');
            if (emptyState) {
                emptyState.remove();
            }
        }

        /* =========================================================
           KEYBOARD SHORTCUTS
           ========================================================= */
        document.addEventListener('keydown', function(e) {
            // Ctrl+F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                if (searchInput) {
                    searchInput.focus();
                    searchInput.select();
                }
            }

            // Ctrl+N to create new
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                newTypeBtn?.click();
            }

            // Escape to clear search
            if (e.key === 'Escape' && searchInput === document.activeElement) {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
            }
        });
    });

    /* =========================================================
       GLOBAL FUNCTIONS
       ========================================================= */
    function editBlogType(typeName) {
        if (confirm(`Edit "${typeName}" blog type?`)) {
            alert(`Opening edit form for "${typeName}"...`);
            // window.location.href = `edit_blog_type.php?name=${encodeURIComponent(typeName)}`;
        }
    }
</script>