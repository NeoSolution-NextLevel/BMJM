<!-- <script>
    // Configuration
    let currentPage = 1;
    const itemsPerPage = 6; // How many videos to fetch per request
    

    // DOM Elements
    const mainVideo = document.getElementById('mainVideo');
    const videoGrid = document.getElementById('videoGrid');
    const latest-sermons-loadMoreBtn = document.getElementById('latest-sermons-loadMoreBtn');
    const modal = document.getElementById('popupModal');
    const closeBtn = document.querySelector('.close');

    // ======================================================
    // 1. HELPER: EXTRACT YOUTUBE ID
    // ======================================================
    function extractVideoId(url) {
        if (!url) return "";
        let video_id = "";
        
        // Robust Regex for all YouTube formats
        let regExp = /^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/|shorts\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/;
        let match = url.match(regExp);

        if (match && match[1]) {
            return match[1];
        } else {
            // Fallback if it is just the ID
            return url.length === 11 ? url : "";
        }
    }

    // ======================================================
    // 2. FETCH DATA FUNCTION
    // ======================================================
    function loadSermons() {
        // Show loading state (optional)
        latest-sermons-loadMoreBtn.innerText = "Loading...";

        $.ajax({
            url: "<?php echo $pth; ?>View-List/Frontend Events & News/Youtube_video/Youtube_video_list.php",
            type: 'POST',
            data: { 
                page_no: currentPage, 
                per_page: itemsPerPage,
                search_val: "" // Empty for all videos
            },
            success: function(response) {
                try {
                    const json = JSON.parse(response);
                    
                    // Reset button text
                    latest-sermons-loadMoreBtn.innerText = "Load More";

                    if (json.length === 0) {
                        // No more data found
                        if(currentPage === 1) {
                            videoGrid.innerHTML = "<p style='color:white; text-align:center;'>No sermons found.</p>";
                            latest-sermons-loadMoreBtn.style.display = "none";
                        } else {
                            // End of list reached
                            modal.style.display = 'block';
                            latest-sermons-loadMoreBtn.style.display = 'none'; // Hide button permanently
                        }
                    } else {
                        // Render the videos
                        renderVideos(json);
                        
                        // If it's the very first load, set the main video
                        if (currentPage === 1 && json.length > 0) {
                            const firstVideoId = extractVideoId(json[0].link);
                            mainVideo.src = `https://www.youtube.com/embed/${firstVideoId}`;
                        }

                        // Increment page for next click
                        currentPage++;
                    }
                } catch (e) {
                    console.error("JSON Parse Error:", e);
                    latest-sermons-loadMoreBtn.innerText = "Error Loading";
                }
            },
            error: function() {
                console.error("Connection Error");
                latest-sermons-loadMoreBtn.innerText = "Try Again";
            }
        });
    }

    // ======================================================
    // 3. RENDER FUNCTION
    // ======================================================
    function renderVideos(videos) {
        videos.forEach(video => {
            const videoId = extractVideoId(video.link);
            const thumbnailUrl = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
            
            // Skip invalid links
            if(!videoId) return;

            // Create HTML Structure
            const thumbDiv = document.createElement('div');
            thumbDiv.className = 'video-thumb';
            thumbDiv.setAttribute('data-video', videoId);
            
            thumbDiv.innerHTML = `
                <img src="${thumbnailUrl}" alt="${video.heading}" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
                `;

            // Append to Grid
            videoGrid.appendChild(thumbDiv);
        });
    }

    // ======================================================
    // 4. EVENT LISTENERS
    // ======================================================
    
    // Initial Load
    document.addEventListener('DOMContentLoaded', () => {
        loadSermons();
    });

    // Load More Button
    latest-sermons-loadMoreBtn.addEventListener('click', () => {
        loadSermons();
    });

    // Click Thumbnail to Play
    videoGrid.addEventListener('click', e => {
        const thumb = e.target.closest('.video-thumb');
        if (!thumb) return;
        
        const videoId = thumb.getAttribute('data-video');
        
        // Update Main Video and Scroll to it (optional)
        mainVideo.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
        
        // Optional: Smooth scroll to top player
        document.querySelector('.sermons-section').scrollIntoView({ behavior: 'smooth' });
    });

    // Close Modal Logic
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

</script> -->




<script>
    // Configuration
    let currentPage = 1;
    const itemsPerPage = 6; 
    // UPDATE THIS PATH IF NEEDED
    const apiUrl = "View-List/Frontend Events & News/Youtube_video/Youtube_video_list.php"; 

    // ======================================================
    // 1. HELPER: EXTRACT YOUTUBE ID
    // ======================================================
    function extractVideoId(url) {
        if (!url) return "";
        let regExp = /^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/|shorts\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/;
        let match = url.match(regExp);
        return (match && match[1]) ? match[1] : (url.length === 11 ? url : "");
    }

    // ======================================================
    // 2. FETCH DATA FUNCTION
    // ======================================================
    function loadSermons() {
        // Get button dynamically using the NEW ID
        const loadMoreBtn = document.getElementById('latest-sermons-loadMoreBtn');
        const videoGrid = document.getElementById('videoGrid');
        const mainVideo = document.getElementById('mainVideo');
        const modal = document.getElementById('popupModal');

        if (!loadMoreBtn) {
            console.error("Error: Button 'latest-sermons-loadMoreBtn' not found.");
            return;
        }

        loadMoreBtn.innerText = "Loading...";

        $.ajax({
            url: apiUrl,
            type: 'POST',
            data: { 
                page_no: currentPage, 
                per_page: itemsPerPage,
                search_val: "" ,
                public_view: 1
            },
            success: function(response) {
                try {
                    if(!response || response.trim() === ""){
                        console.warn("Empty response");
                        loadMoreBtn.innerText = "Load More";
                        return;
                    }

                    const json = JSON.parse(response);
                    loadMoreBtn.innerText = "Load More";

                    if (json.length === 0) {
                        // NO DATA FOUND
                        if(currentPage === 1) {
                            if(videoGrid) videoGrid.innerHTML = "<p style='color:white; text-align:center;'>No sermons found.</p>";
                            loadMoreBtn.style.display = "none";
                        } else {
                            // End of list reached
                            if(modal) modal.style.display = 'block';
                            loadMoreBtn.style.display = 'none'; 
                        }
                    } else {
                        // RENDER VIDEOS
                        renderVideos(json);
                        
                        // Set main video on first load if it's empty
                        if (currentPage === 1 && json.length > 0 && mainVideo) {
                            const firstVideoId = extractVideoId(json[0].link);
                            if(firstVideoId) {
                                mainVideo.src = `https://www.youtube.com/embed/${firstVideoId}`;
                            }
                        }
                        currentPage++;
                    }
                } catch (e) {
                    console.error("JSON Parse Error:", e);
                    loadMoreBtn.innerText = "Error";
                }
            },
            error: function() {
                console.error("Connection Error");
                loadMoreBtn.innerText = "Try Again";
            }
        });
    }

    // ======================================================
    // 3. RENDER FUNCTION
    // ======================================================
    function renderVideos(videos) {
        const videoGrid = document.getElementById('videoGrid');
        if(!videoGrid) return;

        videos.forEach(video => {
            const videoId = extractVideoId(video.link);
            if(!videoId) return;

            const thumbnailUrl = `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
            const thumbDiv = document.createElement('div');
            thumbDiv.className = 'video-thumb';
            thumbDiv.setAttribute('data-video', videoId);
            
            thumbDiv.innerHTML = `
                <img src="${thumbnailUrl}" alt="Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            `;
            videoGrid.appendChild(thumbDiv);
        });
    }

    // ======================================================
    // 4. EVENT LISTENERS
    // ======================================================
    document.addEventListener('DOMContentLoaded', () => {
        // Run immediately
        loadSermons();

        // Elements
        const loadMoreBtn = document.getElementById('latest-sermons-loadMoreBtn');
        const videoGrid = document.getElementById('videoGrid');
        const mainVideo = document.getElementById('mainVideo');
        const modal = document.getElementById('popupModal');
        const closeBtn = document.querySelector('.close');

        // Click: Load More
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                loadSermons();
            });
        }

        // Click: Play Video
        if (videoGrid) {
            videoGrid.addEventListener('click', e => {
                const thumb = e.target.closest('.video-thumb');
                if (!thumb || !mainVideo) return;
                
                const videoId = thumb.getAttribute('data-video');
                mainVideo.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
                
                // Smooth Scroll
                const section = document.querySelector('.sermons-section');
                if(section) section.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Click: Close Modal
        if (closeBtn && modal) {
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }
        if (modal) {
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    });
</script>