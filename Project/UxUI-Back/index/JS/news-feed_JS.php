<script type="text/javascript">
    // --- CONFIGURATION ---
    var currentPagenews = 1;
    var itemsPerPagenews = 10; // Adjust as needed

    var imageBasePath = "Data/Shadow_Shine/";
    var fallbackImg = "./assets/images/homepage-images/news-feed/news-img1.jpg";

    // Global counter to track total items displayed (for top/bottom grid logic)
    var totalItemsLoaded = 0;

    $(document).ready(function() {
        // Load first batch on page load
        load_news_data();
    });

    function load_news_data() {
        // Optional: Select a 'Load More' button if you have one
        var loadMoreBtn = document.getElementById("load_more_btn");
        if (loadMoreBtn) loadMoreBtn.innerText = "Loading...";

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Frontend Events & News/News_Feed/News_feed_list.php",
            type: 'POST',
            data: {
                page_no: currentPagenews,
                per_page: itemsPerPagenews,
                search_val: "",
                public_view: 1
            },
            success: function(response) {
                try {
                    if (!response || response.trim() === "") {
                        console.warn("Empty response");
                        if (loadMoreBtn) {
                            loadMoreBtn.innerText = "No More News";
                            loadMoreBtn.disabled = true;
                        }
                        return;
                    }

                    const json = JSON.parse(response);

                    if (loadMoreBtn) loadMoreBtn.innerText = "Load More";

                    if (json.length === 0) {
                        // NO DATA FOUND
                        if (currentPagenews === 1) {
                            $('.news-grid').html('<p>No news available at the moment.</p>');
                        } else {
                            if (loadMoreBtn) {
                                loadMoreBtn.innerText = "No More News";
                                loadMoreBtn.disabled = true;
                            }
                        }
                    } else {
                        // DATA FOUND - PROCESS IT
                        render_news_items(json);
                    }

                } catch (e) {
                    console.error("JSON Error:", e);
                    console.log("Raw Response:", response);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }

    function render_news_items(data) {
        // Containers
        var gridTop = $('.news-grid').first(); // The first grid container
        var gridBottom = $('.news-grid.bottom');

        // Ensure Modal Container Exists
        if ($('#dynamic-modals').length === 0) {
            $('body').append('<div id="dynamic-modals"></div>');
        }
        var modalContainer = $('#dynamic-modals');

        // Loop through data
        $.each(data, function(index, item) {

            // 1. FILTER: Only show items marked for Web
            if (item.show_on_web != "1") return;

            // 2. IMAGE LOGIC
            var imgSrc = fallbackImg;
            if (item.image_pth && item.image_pth.trim() !== "") {
                if (item.image_pth.indexOf("/") > -1) {
                    imgSrc = item.image_pth;
                } else {
                    imgSrc = "<?php echo $home_page; ?>" + item.image_pth;
                }
            }

            // 3. TEXT LOGIC
            var fullDesc = item.description || item.dis || "";
            var shortDesc = fullDesc.length > 90 ? fullDesc.substring(0, 90) + "..." : fullDesc;
            var modalId = "modal_news_" + item.id;

            // 4. GENERATE CARD HTML
            var cardHTML = `
                <div class="news-item">
                    <img src="${imgSrc}" alt="${item.heading}" onerror="this.src='${fallbackImg}'">
                    <div class="overlay-content">
                        <button class="view-more-btn" data-modal="${modalId}">View More</button>
                        <h3>${item.heading}</h3>
                        <p>${shortDesc}</p>
                    </div>
                </div>
            `;

            // 5. INJECT CARD (Logic: First 3 items go Top, rest go Bottom)
            // We use totalItemsLoaded so pagination flows correctly
            if (totalItemsLoaded < 3) {
                gridTop.append(cardHTML);
            } else {
                gridBottom.append(cardHTML);
            }

            // 6. GENERATE MODAL HTML
            var formattedDesc = fullDesc.split('\n').map(function(s) {
                return '<p>' + s + '</p>';
            }).join('');

            var modalHTML = `
                <div class="modal" id="${modalId}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>${item.heading}</h2>
                            <button class="close-modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <img src="${imgSrc}" alt="${item.heading}" class="modal-image" onerror="this.src='${fallbackImg}'">
                            <h3>${item.heading}</h3>
                            ${formattedDesc}
                        </div>
                    </div>
                </div>
            `;
            modalContainer.append(modalHTML);

            totalItemsLoaded++;
        });

        // Re-initialize listeners for the new elements
        initialize_frontend_interactions();
    }

    // --- INTERACTION LISTENERS (View More, Close Modal) ---
    function initialize_frontend_interactions() {
        // Unbind previous events to prevent duplicates if called multiple times
        $(document).off('click', '.view-more-btn');
        $(document).off('click', '.close-modal');
        $(document).off('click', '.modal');
        $(document).off('keydown');

        // 1. OPEN MODAL
        $(document).on('click', '.view-more-btn', function(e) {
            e.stopPropagation();
            var modalId = $(this).attr('data-modal');
            $('#' + modalId).addClass('active');
            $('body').css('overflow', 'hidden'); // Prevent scrolling
        });

        // 2. CLOSE MODAL (X Button)
        $(document).on('click', '.close-modal', function() {
            $(this).closest('.modal').removeClass('active');
            $('body').css('overflow', '');
        });

        // 3. CLOSE MODAL (Click Outside)
        $(document).on('click', '.modal', function(e) {
            if ($(e.target).is('.modal')) {
                $(this).removeClass('active');
                $('body').css('overflow', '');
            }
        });

        // 4. CLOSE MODAL (Escape Key)
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('.modal.active').removeClass('active');
                $('body').css('overflow', '');
            }
        });

        // 5. TOUCH DEVICE SUPPORT (Tap Card for Overlay)
        const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        if (isTouch) {
            $('.news-item').off('click').on('click', function(e) {
                // Toggle active class on the card
                $(this).toggleClass('active');

                // If clicking button, ensure card stays active but handle button separately
                if ($(e.target).hasClass('view-more-btn')) {
                    $(this).removeClass('active');
                }
            });
        }
    }
</script>