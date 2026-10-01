<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ================= MAIN CONTENT AREA ================= */
    .erp-blog2-content-area {
        flex: 1;
        padding: 32px;
        margin-left: var(--sidebar-width);
        transition: margin-left var(--sidebar-transition);
        width: calc(100% - var(--sidebar-width));
        min-height: calc(100vh - 50px - 32px);
        background: var(--erp-surface-alt);
    }

    .erp-sidebar.collapsed~.erp-blog2-content-area {
        margin-left: var(--sidebar-collapsed);
        width: calc(100% - var(--sidebar-collapsed));
    }

    /* ================= PAGE TITLE & BREADCRUMB ================= */
    .erp-blog2-page-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 8px 0;
        color: var(--erp-primary-dark);
        padding-top: 10px;
    }

    .erp-blog2-breadcrumb-global {
        font-size: 14px;
        color: var(--erp-text-tertiary);
        text-align: center;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .erp-blog2-breadcrumb__separator {
        color: var(--erp-border-dark);
    }

    /* ================= BLOG LIST CARD ================= */
    .erp-blog2-card {
        background: var(--erp-surface);
        border-radius: 10px;
        border: 1px solid var(--erp-border);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Header */
    .erp-blog2-card__header {
        padding: 20px 24px;
        background: var(--erp-primary);
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px 10px 0 0;
    }

    .erp-blog2-card__title {
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .erp-blog2-btn--icon {
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

    .erp-blog2-btn--icon:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    /* ================= CARD BODY ================= */
    .erp-blog2-card__body {
        padding: 24px;
    }

    /* Search Row */
    .erp-blog2-search-row {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        align-items: center;
    }

    .erp-blog2-search-box {
        flex: 1;
        position: relative;
    }

    .erp-blog2-search-box__input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border-radius: 6px;
        border: 1px solid var(--erp-border);
        background: var(--erp-surface);
        color: var(--erp-text-primary);
        font-size: 14px;
        transition: all 0.2s;
    }

    .erp-blog2-search-box__input:focus {
        outline: none;
        border-color: var(--erp-primary-light);
        box-shadow: 0 0 0 3px var(--erp-primary-subtle);
    }

    .erp-blog2-search-box__icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--erp-text-tertiary);
        font-size: 16px;
    }

    .erp-blog2-btn--add {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        background: var(--erp-primary);
        color: white;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        white-space: nowrap;
        min-width: 200px;
    }

    .erp-blog2-btn--add:hover {
        background: var(--erp-primary-dark);
    }

    /* ================= IMAGE GRID ================= */
    .erp-blog2-image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .erp-blog2-image-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--erp-border);
        background: var(--erp-surface-alt);
        transition: all 0.3s ease;
        height: 220px;
    }

    .erp-blog2-image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-color: var(--erp-primary-light);
    }

    .erp-blog2-image-card__img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .erp-blog2-image-card__overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 12px;
        text-align: center;
        font-size: 14px;
    }

    .erp-blog2-image-card__actions {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        gap: 15px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .erp-blog2-image-card:hover .erp-blog2-image-card__actions {
        opacity: 1;
    }

    .erp-blog2-action-btn {
        background: rgba(255, 255, 255, 0.9);
        color: var(--erp-primary-dark);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 16px;
    }

    .erp-blog2-action-btn:hover {
        background: var(--erp-primary);
        color: white;
        transform: scale(1.1);
    }

    /* No Images State */
    .erp-blog2-no-images {
        text-align: center;
        padding: 50px 20px;
        color: var(--erp-text-tertiary);
    }

    .erp-blog2-no-images__icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: var(--erp-border-dark);
    }

    .erp-blog2-no-images__text {
        font-size: 16px;
        margin-bottom: 8px;
    }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 1024px) {
        .erp-blog2-content-area {
            padding: 24px;
        }

        .erp-blog2-card {
            max-width: 100%;
        }

        .erp-blog2-image-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .erp-blog2-content-area {
            margin-left: 0 !important;
            width: 100% !important;
            padding: 90px 16px 60px 16px;
        }

        .erp-blog2-page-title {
            font-size: 24px;
            padding: 0 16px;
        }

        .erp-blog2-breadcrumb-global {
            padding: 0 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .erp-blog2-card__header {
            padding: 16px 20px;
        }

        .erp-blog2-card__body {
            padding: 20px;
        }

        .erp-blog2-search-row {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .erp-blog2-btn--add {
            min-width: 0;
            justify-content: center;
        }

        .erp-blog2-image-grid {
            grid-template-columns: 1fr;
        }

        .erp-blog2-image-card {
            height: 200px;
        }
    }

    @media (max-width: 480px) {
        .erp-blog2-page-title {
            font-size: 22px;
        }

        .erp-blog2-card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .erp-blog2-card__title {
            font-size: 16px;
        }

        .erp-blog2-action-btn {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .erp-blog2-image-card {
            height: 180px;
        }
    }

    @media (max-width: 360px) {
        .erp-blog2-card__body {
            padding: 16px;
        }

        .erp-blog2-image-card {
            height: 160px;
        }
    }

    /* ================= NEW EMPTY STATE STYLE ================= */
    .erp-blog2-empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 5rem 2rem;
        background: #fff;
        border-radius: 1rem;
        border: 2px dashed var(--erp-border);
        margin: 1rem auto;
        width: 100%;
        max-width: 600px;
    }

    .erp-blog2-empty-state__icon {
        font-size: 4.5rem;
        color: var(--erp-border-dark);
        margin-bottom: 1.5rem;
        opacity: 0.4;
    }

    .erp-blog2-empty-state__title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--erp-primary-dark);
        margin-bottom: 0.75rem;
    }

    .erp-blog2-empty-state__text {
        color: var(--erp-text-tertiary);
        font-size: 0.9375rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
</style>

<main class="erp-blog2-content-area" id="need_image_blog_list_of_need_image_main_container">
    <!-- ================= PAGE TITLE & BREADCRUMB ================= -->
    <h1 class="erp-blog2-page-title">Blog List</h1>
    <nav class="erp-blog2-breadcrumb-global">
        <span>Dashboard</span>
        <span class="erp-blog2-breadcrumb__separator">/</span>
        <span>Blog Management</span>
        <span class="erp-blog2-breadcrumb__separator">/</span>
        <span>Blog List</span>
    </nav>

    <!-- ================= BLOG LIST CARD ================= -->
    <section class="erp-blog2-card">
        <header class="erp-blog2-card__header">
            <h1 class="erp-blog2-card__title">
                <i class="fas fa-images"></i>
                Blog Reference Images
            </h1>
            <button class="erp-blog2-btn--icon" id="erpBlog2CloseBtn">
                <i class="fas fa-times"></i>
            </button>
        </header>

        <div class="erp-blog2-card__body">
            <!-- Search and Add Row -->
            <div class="erp-blog2-search-row">
                <div class="erp-blog2-search-box">
                    <i class="fas fa-search erp-blog2-search-box__icon"></i>
                    <input type="text" class="erp-blog2-search-box__input" placeholder="Search reference images..." id="blog_ui2_lis_Need_Image_in_blog_search_txt" onkeydown="neo_solution_04_list_data_list()">
                </div>
                <button class="erp-blog2-btn--add" id="blog2AddImageBtn" onclick="Need_Image_button_Main_dash_bord_need_image_ADD_OPEN()">
                    <i class="fas fa-plus-circle"></i>
                    Add Reference Image
                </button>
            </div>

            <!-- Images Grid -->
            <div class="erp-blog2-image-grid" id="need_image_blog_list_of_need_image_main_container_body_data_SET_DB">
                <!-- 
                <div class="erp-blog2-image-card" data-title="asdasd">
                    <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Blog Image 1" class="erp-blog2-image-card__img">

                    <div class="erp-blog2-image-card__actions">
                        <button class="erp-blog2-action-btn" onclick="blog2PreviewImage(1)" title="Preview">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="erp-blog2-action-btn" onclick="blog2ViewDetails(1)" title="View Details">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>

                    <div class="erp-blog2-image-card__overlay">asdasd</div>
                </div>

                <div class="erp-blog2-image-card" data-title="Marketing">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Blog Image 2" class="erp-blog2-image-card__img">

                    <div class="erp-blog2-image-card__actions">
                        <button class="erp-blog2-action-btn" onclick="blog2PreviewImage(2)" title="Preview">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="erp-blog2-action-btn" onclick="blog2ViewDetails(2)" title="View Details">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>

                    <div class="erp-blog2-image-card__overlay">Marketing</div>
                </div>

                <div class="erp-blog2-image-card" data-title="Technology">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Blog Image 3" class="erp-blog2-image-card__img">

                    <div class="erp-blog2-image-card__actions">
                        <button class="erp-blog2-action-btn" onclick="blog2PreviewImage(3)" title="Preview">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="erp-blog2-action-btn" onclick="blog2ViewDetails(3)" title="View Details">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>

                    <div class="erp-blog2-image-card__overlay">Technology</div>
                </div>

                <div class="erp-blog2-image-card" data-title="Design">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Blog Image 4" class="erp-blog2-image-card__img">

                    <div class="erp-blog2-image-card__actions">
                        <button class="erp-blog2-action-btn" onclick="blog2PreviewImage(4)" title="Preview">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="erp-blog2-action-btn" onclick="blog2ViewDetails(4)" title="View Details">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>

                    <div class="erp-blog2-image-card__overlay">Design</div>
                </div> -->

            </div>
        </div>
    </section>
</main>

<script>
    // Content-specific JavaScript for blog2 list
    document.addEventListener('DOMContentLoaded', function() {
        const erpBlog2CloseBtn = document.getElementById('erpBlog2CloseBtn');
        const blog2AddImageBtn = document.getElementById('blog2AddImageBtn');
        const blog2SearchInput = document.getElementById('blog2SearchInput');
        const blog2ImageGrid = document.getElementById('blog2ImageGrid');
        const blog2ImageCards = document.querySelectorAll('.erp-blog2-image-card');

        /* =========================================================
           CLOSE BUTTON
           ========================================================= */
        if (erpBlog2CloseBtn) {
            erpBlog2CloseBtn.addEventListener("click", () => {
                if (confirm('Close blog reference images panel?')) {
                    alert("Returning to blog management...");
                }
            });
        }


        /* =========================================================
           SEARCH FUNCTIONALITY
           ========================================================= */
        if (blog2SearchInput) {
            let searchTimeout;
            blog2SearchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const searchTerm = this.value.toLowerCase().trim();

                searchTimeout = setTimeout(() => {
                    let hasVisibleCards = false;

                    blog2ImageCards.forEach(card => {
                        const title = card.getAttribute('data-title').toLowerCase();
                        if (searchTerm === '' || title.includes(searchTerm)) {
                            card.style.display = 'block';
                            hasVisibleCards = true;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Show no results message
                    if (!hasVisibleCards && searchTerm !== '') {
                        blog2ShowNoResults(searchTerm);
                    } else {
                        blog2RemoveNoResultsMessage();
                    }
                }, 300);
            });
        }

        /* =========================================================
           HELPER FUNCTIONS
           ========================================================= */
        function blog2AddNewImageCard(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const newCard = document.createElement('div');
                newCard.className = 'erp-blog2-image-card';
                newCard.setAttribute('data-title', file.name.split('.')[0]);

                newCard.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}" class="erp-blog2-image-card__img">
                    <div class="erp-blog2-image-card__actions">
                        <button class="erp-blog2-action-btn" onclick="blog2PreviewImage('new')" title="Preview">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="erp-blog2-action-btn" onclick="blog2ViewDetails('new')" title="View Details">
                            <i class="fas fa-file-alt"></i>
                        </button>
                    </div>
                    <div class="erp-blog2-image-card__overlay">${file.name.split('.')[0]}</div>
                `;

                blog2ImageGrid.prepend(newCard);
                alert(`Image "${file.name}" added successfully!`);
            };
            reader.readAsDataURL(file);
        }

        function blog2ShowNoResults(searchTerm) {
            // Remove existing no results message if any
            blog2RemoveNoResultsMessage();

            const noResults = document.createElement('div');
            noResults.className = 'erp-blog2-no-images';
            noResults.id = 'blog2NoResultsMessage';
            noResults.innerHTML = `
                <div class="erp-blog2-no-images__icon">
                    <i class="fas fa-search"></i>
                </div>
                <div class="erp-blog2-no-images__text">No images found for "${searchTerm}"</div>
                <div class="erp-blog2-no-images__subtext">Try a different search term</div>
            `;

            blog2ImageGrid.appendChild(noResults);
        }

        function blog2RemoveNoResultsMessage() {
            const noResults = document.getElementById('blog2NoResultsMessage');
            if (noResults) {
                noResults.remove();
            }
        }

        /* =========================================================
           KEYBOARD SHORTCUTS
           ========================================================= */
        document.addEventListener('keydown', function(e) {
            // Ctrl+F to focus search
            if (e.ctrlKey && e.key === 'f') {
                e.preventDefault();
                if (blog2SearchInput) {
                    blog2SearchInput.focus();
                    blog2SearchInput.select();
                }
            }

            // Escape to clear search
            if (e.key === 'Escape' && document.activeElement === blog2SearchInput) {
                blog2SearchInput.value = '';
                blog2SearchInput.dispatchEvent(new Event('input'));
            }
        });
    });



    function blog2ViewDetails(id) {
        alert(`Viewing details for image ${id}...`);
        // In real implementation, navigate to details page
    }
</script>