<!-- components/content/blog_list_minimal.php -->


<style>
    :root {
        /* Primary IS (Item Service) Brand Colors */
        --is-primary: #2c5282;
        --is-primary-dark: #1a365d;
        --is-primary-light: #4299e1;
        --is-primary-subtle: #ebf8ff;

        /* Neutral Colors */
        --is-surface: #ffffff;
        --is-surface-alt: #f7fafc;
        --is-border: #e2e8f0;
        --is-border-dark: #cbd5e0;
        --is-text-primary: #2d3748;
        --is-text-secondary: #4a5568;
        --is-text-tertiary: #718096;

        /* Error Colors */
        --is-error-light: #fed7d7;
        --is-error-medium: #fc8181;
        --is-error-dark: #e53e3e;
        --is-error-darker: #c53030;
        --is-error-glow: rgba(229, 62, 62, 0.3);

        /* Accent Colors */
        --is-accent-success: #38a169;
        --is-accent-warning: #d69e2e;
        --is-accent-error: #e53e3e;
        --is-accent-info: #3182ce;

        /* Sidebar */
        --sidebar-width: 260px;
        --sidebar-collapsed: 70px;
        --sidebar-transition: 0.3s ease;
    }

    /* ================= MAIN CONTENT AREA ================= */
    .erp-content-area {
        flex: 1;
        padding: 20px;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        background: var(--erp-surface-alt);
        min-height: 100vh;
    }

    .erp-btn-icon-only {
        padding: 0.625rem;
        min-width: auto;
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .erp-btn-icon-only i {
        font-size: 1rem;
        /* Adjust icon size if needed */
    }

    .erp-sidebar.collapsed~.erp-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }




    /* ================= PAGE TITLE ================= */
    .erp-page-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--erp-primary-dark);
        margin-bottom: 15px;
        text-align: center;
    }

    /* ================= CARD ================= */
    .erp-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--erp-border);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header */
    .erp-card-header {
        padding: 16px 20px;
        background: var(--erp-primary);
        color: white;
        border-radius: 8px 8px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .erp-card-title {
        font-size: 16px;
        font-weight: 600;
    }

    .erp-close-btn {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        padding: 5px;
    }

    /* Search Row */
    .erp-search-row {
        padding: 20px;
        background: var(--erp-surface-alt);
        border-bottom: 1px solid var(--erp-border);
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .erp-search-input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid var(--erp-border);
        border-radius: 6px;
        font-size: 14px;
    }

    .erp-search-input:focus {
        outline: none;
        border-color: var(--erp-primary);
    }

    .erp-btn-primary {
        padding: 10px 20px;
        background: var(--erp-primary);
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
    }

    .erp-btn-primary:hover {
        background: var(--erp-primary-dark);
    }


    /* =========================================================
       FOOTER
       ========================================================= */
    .is-panel__footer {
        padding: 16px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f7fafc;
        border-top: 1px solid var(--is-border);
    }

    .is-pagination {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .is-pagination__select {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid var(--is-border);
        background: var(--is-surface);
        color: var(--is-text-primary);
        font-size: 14px;
        transition: all 0.2s;
    }

    .is-pagination__select:focus {
        outline: none;
        border-color: var(--is-primary-light);
        box-shadow: 0 0 0 3px var(--is-primary-subtle);
    }

    .is-pagination__info {
        font-size: 14px;
        color: var(--is-text-tertiary);
    }



    /* Blog Items */
    .erp-blog-items {
        padding: 20px;
    }

    .erp-blog-item {
        background: var(--erp-surface);
        border: 1px solid var(--erp-border);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        gap: 15px;
        align-items: center;
        transition: all 0.2s;
    }

    .erp-blog-item:hover {
        border-color: var(--erp-primary-light);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Thumbnail */
    .erp-thumbnail {
        width: 100px;
        height: 70px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--erp-surface-alt);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--erp-text-tertiary);
        font-size: 12px;
    }

    .erp-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Blog Content */
    .erp-blog-content {
        flex: 1;
        min-width: 0;
    }

    .erp-blog-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--erp-text-primary);
        margin-bottom: 5px;
    }

    .erp-blog-meta {
        font-size: 12px;
        color: var(--erp-text-tertiary);
        margin-bottom: 5px;
    }

    .erp-blog-excerpt {
        font-size: 14px;
        color: var(--erp-text-secondary);
        line-height: 1.4;
        margin: 0;
    }

    /* Actions */
    .erp-blog-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .erp-btn-action {
        padding: 8px 15px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
    }

    .erp-btn-red {
        background: var(--erp-error-dark);
        color: white;
    }

    .erp-btn-red:hover {
        background: var(--erp-error-darker);
    }

    .erp-btn-blue {
        background: var(--erp-primary);
        color: white;
    }

    .erp-btn-blue:hover {
        background: var(--erp-primary-dark);
    }

    .erp-btn-gray {
        background: var(--erp-border);
        color: var(--erp-text-primary);
    }

    .erp-btn-gray:hover {
        background: var(--erp-border-dark);
    }

    /* Status Badge */
    .erp-status {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        margin-left: 10px;
    }

    .erp-status-active {
        background: rgba(56, 161, 105, 0.1);
        color: var(--erp-accent-success);
    }

    .erp-status-hidden {
        background: rgba(229, 62, 62, 0.1);
        color: var(--erp-error-dark);
    }

    /* Empty State */
    .erp-empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #fff;
        border-radius: 1rem;
        margin: 2rem auto;
        max-width: 500px;
    }

    .erp-empty-state__icon {
        font-size: 4rem;
        color: var(--erp-border-dark);
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .erp-empty-state__title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--erp-text-primary);
        margin-bottom: 0.5rem;
    }

    .erp-empty-state__text {
        color: var(--erp-text-tertiary);
        font-size: 0.9375rem;
        margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .erp-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 15px;
        }

        .erp-card {
            border-radius: 0;
            border-left: none;
            border-right: none;
        }

        .erp-blog-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .erp-thumbnail {
            width: 100%;
            height: 120px;
        }

        .erp-blog-actions {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        .erp-btn-action {
            flex: 1;
            min-width: 120px;
        }

        .erp-search-row {
            flex-direction: column;
            align-items: stretch;
        }

        .is-pagination {
            flex-direction: column;
            width: 100%;
        }

        .is-pagination__select {
            width: 100%;
        }

        .is-panel__footer {
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
            padding: 16px 20px;
        }

    }
</style>

<main class="erp-content-area" id="blog_list_btn_list_blog_container_01">
    <input type="hidden" id="body_01_01_C_blog_id" value="0">

    <!-- Page Title -->
    <h1 class="erp-page-title">Blog List</h1>

    <!-- Main Card -->
    <div class="erp-card">
        <!-- Header -->
        <div class="erp-card-header">
            <h2 class="erp-card-title">Blog Management</h2>
            <button class="erp-close-btn" onclick="closeBlogList()">×</button>
        </div>

        <!-- Search -->
        <div class="erp-search-row">
            <input type="text" class="erp-search-input" placeholder="Search blogs..." id="blog_ui6_Blog_list_search_txt" onkeydown="load_blog_list()">
            <button class="erp-btn-primary" onclick="Blog_List_button_Main_dash_bord_add_blog_OPEN('add_new')">New Blog</button>
        </div>



        <!-- Blog Items -->
        <div class="erp-blog-items" id="blog_list_btn_list_blog_container_data_SET_list">
            <!-- 
            <div class="erp-blog-item">
                <div class="erp-thumbnail">
                    <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                        alt="Tech Blog"
                        onerror="this.style.display='none'; this.parentElement.textContent='No Image'">
                </div>

                <div class="erp-blog-content">
                    <h3 class="erp-blog-title">
                        Quis in dolorem corr
                        <span class="erp-status erp-status-active">Active</span>
                    </h3>
                    <div class="erp-blog-meta">Esse_autem_enim_sim / Lkassdlk</div>
                    <p class="erp-blog-excerpt">Irure ad fugiat ips lorem ipsum dolor sit amet consectetur.</p>
                </div>

                <div class="erp-blog-actions">
                    <button class="erp-btn-action erp-btn-red" onclick="toggleBlog(1)">Hide</button>
                    <button class="erp-btn-action erp-btn-blue" onclick="updateBlog(1)">Update</button>
                    <button class="erp-btn-action erp-btn-gray" onclick="viewBlog(1)">View</button>
                </div>
            </div>

            <div class="erp-blog-item">
                <div class="erp-thumbnail">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                        alt="Code Blog"
                        onerror="this.style.display='none'; this.parentElement.textContent='No Image'">
                </div>

                <div class="erp-blog-content">
                    <h3 class="erp-blog-title">
                        Anim numquam do dolo
                        <span class="erp-status erp-status-active">Active</span>
                    </h3>
                    <div class="erp-blog-meta">Molestiasuntsolu / Lkassdlk</div>
                    <p class="erp-blog-excerpt">Alias dolor rem et consectetur adipiscing elit sed do.</p>
                </div>

                <div class="erp-blog-actions">
                    <button class="erp-btn-action erp-btn-red" onclick="toggleBlog(2)">Hide</button>
                    <button class="erp-btn-action erp-btn-blue" onclick="updateBlog(2)">Update</button>
                    <button class="erp-btn-action erp-btn-gray" onclick="viewBlog(2)">View</button>
                </div>
            </div>

            <div class="erp-blog-item">
                <div class="erp-thumbnail">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                        alt="Marketing Blog"
                        onerror="this.style.display='none'; this.parentElement.textContent='No Image'">
                </div>

                <div class="erp-blog-content">
                    <h3 class="erp-blog-title">
                        Marketing Trends 2024
                        <span class="erp-status erp-status-hidden">Hidden</span>
                    </h3>
                    <div class="erp-blog-meta">Digital_Marketing / Business</div>
                    <p class="erp-blog-excerpt">Latest trends in digital marketing and social media strategies.</p>
                </div>

                <div class="erp-blog-actions">
                    <button class="erp-btn-action erp-btn-blue" style="background: var(--erp-accent-success)" onclick="toggleBlog(3)">Show</button>
                    <button class="erp-btn-action erp-btn-blue" onclick="updateBlog(3)">Update</button>
                    <button class="erp-btn-action erp-btn-gray" onclick="viewBlog(3)">View</button>
                </div>
            </div>
 -->

        </div>

        <div class="is-panel__footer">
            <div class="is-pagination">
                <div class="is-pagination__info" id="blog_ui6_Blog_list_PAGINATION_BUTTON_BODY" style="display:flex; gap:5px;">
                    <!-- <button
                        id="body_02_A_per_page_count_pagination_btn_1"
                        class="erp-action-btn erp-action-btn--edit"
                        style="min-width:30px; padding:6px 10px; margin-right:4px;">
                        1
                    </button> -->
                </div>
            </div>


            <input type="hidden" id="blog_ui6_Blog_list_pagination_holder_id" value="0">
            <select class="is-pagination__select" id="blog_ui6_Blog_list_pre_page_selector" onchange="load_blog_list()">
                <option value="100">Per Page 100</option>
                <option value="50" selected="">Per Page 50</option>
                <option value="25">Per Page 25</option>
                <option value="10">Per Page 10</option>
            </select>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchBlogs');
        const blogItems = document.querySelectorAll('.erp-blog-item');

        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                blogItems.forEach(item => {
                    const title = item.querySelector('.erp-blog-title').textContent.toLowerCase();
                    const excerpt = item.querySelector('.erp-blog-excerpt').textContent.toLowerCase();

                    if (searchTerm === '' || title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }
    });

    // Global functions
    function closeBlogList() {
        if (confirm('Close blog list?')) {
            alert('Returning to dashboard...');
        }
    }



    function toggleBlog(id) {
        const item = document.querySelectorAll('.erp-blog-item')[id - 1];
        const status = item.querySelector('.erp-status');
        const button = item.querySelector('.erp-btn-red, [style*="background: var(--erp-accent-success)"]');

        if (status.classList.contains('erp-status-active')) {
            status.textContent = 'Hidden';
            status.className = 'erp-status erp-status-hidden';
            button.textContent = 'Show';
            button.style.background = 'var(--erp-accent-success)';
            alert(`Blog ${id} hidden from website`);
        } else {
            status.textContent = 'Active';
            status.className = 'erp-status erp-status-active';
            button.textContent = 'Hide';
            button.style.background = 'var(--erp-error-dark)';
            alert(`Blog ${id} visible on website`);
        }
    }
</script>