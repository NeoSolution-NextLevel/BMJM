<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumu'ah Sermons</title>
    <link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
    <style>
        .sermons-section {
            text-align: center;
            font-family: 'Kadwa', serif;
            padding: 20px 0;
        }

        .sermons-title {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .sermons-title span {
            margin-left: 8px;
            font-weight: 600;
        }

        .main-video {
            width: 50%;
            margin: 0 auto 30px auto;
            aspect-ratio: 16 / 9;
            border-radius: 15px;
            overflow: hidden;
            background: #8D9676;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .main-video iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 80%;
            margin: 0 auto;
        }

        .video-thumb {
            position: relative;
            aspect-ratio: 16 / 9;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s ease;
            overflow: hidden;
            background: #8D9676;
        }

        .video-thumb.hidden {
            display: none;
        }

        .video-thumb:hover {
            transform: scale(1.05);
        }

        .video-thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .video-logo {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 60px;
            opacity: 0.9;
            z-index: 2;
        }

        .load-more {
            font-family: 'Kadwa', serif;
            color: #ffffff;
            background: #D5BC75;
            border: none;
            width: 20%;
            padding: 10px 25px;
            border-radius: 6px;
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.15);
        }

        .load-more:hover {
            background: #e2cd95;
            color: #000000;
        }
        
        .load-more:active {
            background: #D5BC75;
            color: #ffffff;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            font-family: 'Kadwa', serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: -10px;
            right: 15px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-video {
                width: 70%;
            }
            
            .video-grid {
                width: 90%;
            }
        }

        @media (max-width: 768px) {
            .sermons-title {
                font-size: 1.6rem;
            }
            
            .main-video {
                width: 85%;
            }
            
            .video-grid {
                grid-template-columns: repeat(2, 1fr);
                width: 90%;
            }
            
            .video-logo {
                width: 50px;
            }
        }

        @media (max-width: 480px) {
            .sermons-section {
                padding: 15px 0;
            }
            
            .sermons-title {
                font-size: 1.4rem;
            }
            
            .main-video {
                width: 95%;
                margin-bottom: 20px;
            }
            
            .video-grid {
                grid-template-columns: 1fr;
                width: 95%;
                gap: 15px;
            }
            
            .video-logo {
                width: 45px;
            }
            
            .load-more {
                padding: 8px 20px;
                margin-top: 20px;
                width: 50%;
            }
            
            .modal-content {
                width: 90%;
                margin: 30% auto;
            }
        }
    </style>
</head>
<!-- <body>
    <section class="sermons-section">
        <h2 class="sermons-title">latest <span>Jumu'ah sermons</span></h2>

    
        <div class="main-video">
            <iframe
                id="mainVideo"
                src=""
                frameborder="0"
                allowfullscreen
            ></iframe>
        </div>

       
        <div class="video-grid" id="videoGrid">
           
            <div class="video-thumb" data-video="https://youtu.be/5aZt7qcpt0k?si=z8sT3851l4kub7n5">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb" data-video="https://youtu.be/yYOkMj8Yodk?si=1SJUMgS6l1XWlZzJ">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb" data-video="https://youtu.be/rG8hxiWcOmE?si=O63SEmkNKRin3zNX">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb" data-video="https://youtu.be/5aZt7qcpt0k?si=z8sT3851l4kub7n5">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb" data-video="https://youtu.be/yYOkMj8Yodk?si=1SJUMgS6l1XWlZzJ">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb" data-video="https://youtu.be/rG8hxiWcOmE?si=O63SEmkNKRin3zNX">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            
           
            <div class="video-thumb hidden" data-video="https://youtu.be/5aZt7qcpt0k?si=z8sT3851l4kub7n5">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb hidden" data-video="https://youtu.be/yYOkMj8Yodk?si=1SJUMgS6l1XWlZzJ">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb hidden" data-video="https://youtu.be/rG8hxiWcOmE?si=O63SEmkNKRin3zNX">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb hidden" data-video="https://youtu.be/5aZt7qcpt0k?si=z8sT3851l4kub7n5">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb hidden" data-video="https://youtu.be/yYOkMj8Yodk?si=1SJUMgS6l1XWlZzJ">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
            <div class="video-thumb hidden" data-video="https://youtu.be/rG8hxiWcOmE?si=O63SEmkNKRin3zNX">
                <img src="" alt="Sermon Thumbnail" class="video-thumbnail" />
                <img src="./assets/images/common-images/logo.png" alt="logo" class="video-logo" />
            </div>
        </div>

        <button class="load-more" id="loadMoreBtn">Load More</button>
    </section>


    <div id="popupModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>All sermons have been loaded.</p>
        </div>
    </div>

    <script>
        const mainVideo = document.getElementById('mainVideo');
        const videoGrid = document.getElementById('videoGrid');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const modal = document.getElementById('popupModal');
        const closeBtn = document.querySelector('.close');

        // Track how many videos to show per click
        const videosPerLoad = 3;
        let currentlyVisible = 6; // Starting with 6 visible videos

        // Function to extract video ID from any YouTube URL format or return as-is if already an ID
        function extractVideoId(videoData) {
            // If it's already just a video ID (no URLs, no special characters except underscore and dash)
            if (/^[a-zA-Z0-9_-]{11}$/.test(videoData)) {
                return videoData;
            }
            
            // Handle youtu.be URLs
            if (videoData.includes('youtu.be/')) {
                const match = videoData.match(/youtu\.be\/([a-zA-Z0-9_-]{11})/);
                return match ? match[1] : videoData;
            }
            
            // Handle youtube.com/watch URLs
            if (videoData.includes('youtube.com/watch')) {
                const match = videoData.match(/v=([a-zA-Z0-9_-]{11})/);
                return match ? match[1] : videoData;
            }
            
            // Handle youtube.com/embed URLs
            if (videoData.includes('youtube.com/embed')) {
                const match = videoData.match(/embed\/([a-zA-Z0-9_-]{11})/);
                return match ? match[1] : videoData;
            }
            
            // If no pattern matches, return the original (might be invalid, but we try)
            return videoData;
        }

        // Function to get YouTube thumbnail URL
        function getThumbnailUrl(videoId) {
            return `https://img.youtube.com/vi/${videoId}/hqdefault.jpg`;
        }

        // Function to update all thumbnails
        function updateAllThumbnails() {
            const allThumbs = document.querySelectorAll('.video-thumb');
            
            allThumbs.forEach(thumb => {
                const videoData = thumb.getAttribute('data-video');
                const videoId = extractVideoId(videoData);
                const thumbnail = thumb.querySelector('.video-thumbnail');
                
                // Update the thumbnail source
                thumbnail.src = getThumbnailUrl(videoId);
            });
        }

        // Click thumbnail → show video in main player
        videoGrid.addEventListener('click', e => {
            const thumb = e.target.closest('.video-thumb');
            if (!thumb) return;
            
            const videoData = thumb.getAttribute('data-video');
            const videoId = extractVideoId(videoData);
            
            mainVideo.src = `https://www.youtube.com/embed/${videoId}`;
        });

        // Load more thumbnails by showing hidden videos
        loadMoreBtn.addEventListener('click', () => {
            const hiddenVideos = document.querySelectorAll('.video-thumb.hidden');
            
            // Check if there are more videos to show
            if (hiddenVideos.length === 0) {
                modal.style.display = 'block';
                return;
            }
            
            // Show the next batch of videos
            const videosToShow = Math.min(videosPerLoad, hiddenVideos.length);
            
            for (let i = 0; i < videosToShow; i++) {
                hiddenVideos[i].classList.remove('hidden');
            }
            
            // Update count of visible videos
            currentlyVisible += videosToShow;
        });

        // Close the modal when the user clicks on <span> (x)
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Close the modal when the user clicks anywhere outside of it
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Initialize thumbnails when page loads
        document.addEventListener('DOMContentLoaded', () => {
            updateAllThumbnails();
        });
    </script>
</body>
</html> -->

<section class="sermons-section">
    <h2 class="sermons-title">latest <span>Jumu'ah sermons</span></h2>

    <div class="main-video">
        <iframe
            id="mainVideo"
            src=""
            frameborder="0"
            allowfullscreen
        ></iframe>
    </div>

    <div class="video-grid" id="videoGrid"></div>

    <button class="load-more" id="latest-sermons-loadMoreBtn">Load More</button>
</section>

<div id="popupModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>All sermons have been loaded.</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>