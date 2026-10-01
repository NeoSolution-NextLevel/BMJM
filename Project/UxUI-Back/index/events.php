<link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .event-section {
            text-align: center;
            
            padding: 40px 20px;
            box-sizing: border-box;
            width: 100%;
        }

        .event-title {
            font-family: 'Kadwa', serif;
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: 1px;
            color: #333;
        }

        .event-carousel {
            position: relative;
            width: 100%;
            max-width: 800px;
            height: clamp(250px, 50vw, 400px);
            margin: 0 auto;
            background: #ddd;
            overflow: hidden;
            border-radius: clamp(15px, 4vw, 30px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .event-slide {
            position: relative;
            width: 100%;
            height: 100%;
            display: none;
        }

        .event-slide.event-active {
            display: block;
        }

        .event-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            padding: clamp(6px, 2vw, 10px);
            color: #000;
            border-radius: 50%;
            border: 2px solid #000;
            width: clamp(30px, 8vw, 40px);
            height: clamp(30px, 8vw, 40px);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 4px 4px 4px rgba(0,0,0,0.2);
            font-size: clamp(14px, 4vw, 18px);
            line-height: 1;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .event-arrow:hover {
            background: #f0f0f0;
            transform: translateY(-50%) scale(1.1);
        }
        .event-arrow:active {
            transform: translateY(-50%) scale(1);
        }

        .event-arrow.event-left {
            left: clamp(5px, 2vw, 15px);
        }

        .event-arrow.event-right {
            right: clamp(5px, 2vw, 15px);
        }

        .event-btn {
            font-family: 'Kadwa', serif;
            position: absolute;
            bottom: clamp(10px, 3vw, 20px);
            left: 50%;
            transform: translateX(-50%);
            background-color: #d3b673;
            color: #fff;
            padding: clamp(8px, 2vw, 10px) clamp(20px, 5vw, 30px);
            border-radius: clamp(5px, 2vw, 10px);
            font-size: clamp(0.8rem, 2.5vw, 0.9rem);
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 4px #bba15e;
            border: none;
            z-index: 10;
            transition: all 0.1s ease;
            white-space: nowrap;
        }

        .event-btn:hover {
            background-color: #D5BC75;
            transform: translateX(-50%) translateY(-2px);
            box-shadow: 0 6px #bba15e;
        }

        .event-btn:active {
            transform: translateX(-50%) translateY(2px);
            box-shadow: 0 2px #bba15e;
        }

        .event-indicators {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            gap: 8px;
        }

        .event-indicator {
            width: clamp(8px, 2.5vw, 10px);
            height: clamp(8px, 2.5vw, 10px);
            border-radius: 50%;
            background-color: #ddd;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .event-indicator.event-active {
            background-color: #D5BC75;
        }

        /* Modal Styles */
        .event-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .event-modal.active {
            display: flex;
        }

        .event-modal-content {
            background-color: #fff;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            border-radius: clamp(10px, 3vw, 15px);
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .event-modal-header {
            position: relative;
            height: clamp(150px, 30vh, 200px);
            overflow: hidden;
        }

        .event-modal-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-modal-close {
            position: absolute;
            top: clamp(10px, 2vw, 15px);
            right: clamp(10px, 2vw, 15px);
            background: rgba(255, 255, 255, 0.8);
            width: clamp(25px, 6vw, 30px);
            height: clamp(25px, 6vw, 30px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: clamp(16px, 4vw, 18px);
            transition: all 0.3s ease;
            border: none;
            color: #333;
        }

        .event-modal-close:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
        }

        .event-modal-body {
            padding: clamp(15px, 4vw, 20px);
            overflow-y: auto;
            flex-grow: 1;
        }

        .event-modal-title {
            font-size: clamp(1.2rem, 4vw, 1.5rem);
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
            line-height: 1.3;
        }

        .event-modal-details {
            display: flex;
            flex-direction: column;
            gap: clamp(8px, 2vw, 10px);
            margin-bottom: 15px;
        }

        .event-modal-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #555;
            font-size: clamp(0.9rem, 3vw, 1rem);
        }

        .event-modal-detail i {
            color: #d3b673;
            width: 20px;
            font-size: clamp(14px, 3.5vw, 16px);
        }

        .event-modal-description {
            color: #666;
            line-height: 1.6;
            margin-top: 15px;
            font-size: clamp(0.9rem, 3vw, 1rem);
        }

        /* Media query for very small screens */
        @media (max-width: 480px) {
            .event-section {
                padding: 20px 10px;
            }
            
            .event-modal {
                padding: 10px;
            }
            
            .event-modal-detail {
                flex-wrap: wrap;
            }
        }
    </style>

    <!-- <section class="event-section">
        <h2 class="event-title">MOSQUE EVENTS</h2>
        <div class="event-carousel">
            <i class="fa-solid fa-chevron-left event-arrow event-left"></i>
            <i class="fa-solid fa-chevron-right event-arrow event-right"></i>

        
            <div class="event-slide event-active">
                <img src="./assets/images/homepage-images/news-feed/news-img1.jpg" alt="Friday Jumu'ah Gathering">
                <button class="event-btn" data-modal="modal-event-1">View Event</button>
            </div>

            <div class="event-slide">
                <img src="./assets/images/homepage-images/news-feed/news-img2.jpg" alt="Quran Study Circle">
                <button class="event-btn" data-modal="modal-event-2">View Event</button>
            </div>

          
            <div class="event-slide">
                <img src="./assets/images/homepage-images/news-feed/news-img3.jpg" alt="Community Iftar">
                <button class="event-btn" data-modal="modal-event-3">View Event</button>
            </div>

          
            <div class="event-slide">
                <img src="./assets/images/homepage-images/news-feed/news-img4.jpg" alt="Islamic Lecture Series">
                <button class="event-btn" data-modal="modal-event-4">View Event</button>
            </div>

           
            <div class="event-slide">
                <img src="./assets/images/homepage-images/news-feed/news-img5.jpg" alt="Youth Sports Day">
                <button class="event-btn" data-modal="modal-event-5">View Event</button>
            </div>
        </div>
        <div class="event-indicators">
            <div class="event-indicator event-active"></div>
            <div class="event-indicator"></div>
            <div class="event-indicator"></div>
            <div class="event-indicator"></div>
            <div class="event-indicator"></div>
        </div>
    </section>

  
    <div id="modal-event-1" class="event-modal">
        <div class="event-modal-content">
            <div class="event-modal-header">
                <img src="./assets/images/homepage-images/news-feed/news-img1.jpg" alt="Friday Jumu'ah Gathering">
                <button class="event-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="event-modal-body">
                <h3 class="event-modal-title">Friday Jumu'ah Gathering</h3>
                <div class="event-modal-details">
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Main Prayer Hall</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-clock"></i>
                        <span>1:00 PM - 2:00 PM</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-calendar"></i>
                        <span>Every Friday</span>
                    </div>
                </div>
                <p class="event-modal-description">
                    Join us for the weekly Friday Jumu'ah prayer. This special congregational prayer includes a sermon (khutbah) delivered by our Imam. All community members are welcome. Please arrive early to secure a spot as the prayer hall tends to get crowded. After the prayer, refreshments will be served in the community hall.
                </p>
            </div>
        </div>
    </div>

    <div id="modal-event-2" class="event-modal">
        <div class="event-modal-content">
            <div class="event-modal-header">
                <img src="./assets/images/homepage-images/news-feed/news-img2.jpg" alt="Quran Study Circle">
                <button class="event-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="event-modal-body">
                <h3 class="event-modal-title">Quran Study Circle</h3>
                <div class="event-modal-details">
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Library Room</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-clock"></i>
                        <span>6:00 PM - 7:30 PM</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-calendar"></i>
                        <span>Every Tuesday</span>
                    </div>
                </div>
                <p class="event-modal-description">
                    Our weekly Quran study circle provides an opportunity to deepen your understanding of the Holy Quran. We explore tafsir (exegesis), discuss meanings, and reflect on how to apply Quranic teachings in our daily lives. This session is open to all levels of knowledge, from beginners to advanced students. Please bring your copy of the Quran.
                </p>
            </div>
        </div>
    </div>

    <div id="modal-event-3" class="event-modal">
        <div class="event-modal-content">
            <div class="event-modal-header">
                <img src="./assets/images/homepage-images/news-feed/news-img3.jpg" alt="Community Iftar">
                <button class="event-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="event-modal-body">
                <h3 class="event-modal-title">Community Iftar</h3>
                <div class="event-modal-details">
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Community Hall</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-clock"></i>
                        <span>6:30 PM - 8:30 PM</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-calendar"></i>
                        <span>Ramadan 15th</span>
                    </div>
                </div>
                <p class="event-modal-description">
                    Join us for a community iftar during the blessed month of Ramadan. This event brings together families and individuals to break their fast together and strengthen community bonds. We'll begin with Maghrib prayer followed by a delicious meal. Volunteers are needed to help with setup, serving, and cleanup. Please RSVP by the day before the event.
                </p>
            </div>
        </div>
    </div>

    <div id="modal-event-4" class="event-modal">
        <div class="event-modal-content">
            <div class="event-modal-header">
                <img src="./assets/images/homepage-images/news-feed/news-img4.jpg" alt="Islamic Lecture Series">
                <button class="event-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="event-modal-body">
                <h3 class="event-modal-title">Islamic Lecture Series</h3>
                <div class="event-modal-details">
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Conference Room</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-clock"></i>
                        <span>4:00 PM - 5:30 PM</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-calendar"></i>
                        <span>October 20th</span>
                    </div>
                </div>
                <p class="event-modal-description">
                    We are honored to host Sheikh Ahmed Hassan for a special lecture on 'Spiritual Purification in Modern Times'. This lecture will explore practical ways to maintain spiritual purity amidst the challenges of contemporary life. The session will include a Q&A segment where attendees can ask questions. This event is open to all community members regardless of background or level of Islamic knowledge.
                </p>
            </div>
        </div>
    </div>

    <div id="modal-event-5" class="event-modal">
        <div class="event-modal-content">
            <div class="event-modal-header">
                <img src="./assets/images/homepage-images/news-feed/news-img5.jpg" alt="Youth Sports Day">
                <button class="event-modal-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="event-modal-body">
                <h3 class="event-modal-title">Youth Sports Day</h3>
                <div class="event-modal-details">
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Mosque Grounds</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-clock"></i>
                        <span>10:00 AM - 4:00 PM</span>
                    </div>
                    <div class="event-modal-detail">
                        <i class="fa-solid fa-calendar"></i>
                        <span>November 5th</span>
                    </div>
                </div>
                <p class="event-modal-description">
                    Calling all youth! Join us for a fun-filled sports day with various activities including soccer, basketball, relay races, and more. This event aims to promote physical health, teamwork, and Islamic sportsmanship. Lunch and refreshments will be provided. Please wear appropriate sports attire and bring a water bottle. Registration is required for participation.
                </p>
            </div>
        </div>
    </div>

    <script>
        const eventSlides = document.querySelectorAll('.event-slide');
        const eventPrev = document.querySelector('.event-arrow.event-left');
        const eventNext = document.querySelector('.event-arrow.event-right');
        const eventIndicators = document.querySelectorAll('.event-indicator');
        const eventBtns = document.querySelectorAll('.event-btn');
        const eventModals = document.querySelectorAll('.event-modal');
        const modalCloseBtns = document.querySelectorAll('.event-modal-close');
        let eventIndex = 0;

        function showEventSlide(n) {
            eventSlides.forEach(slide => slide.classList.remove('event-active'));
            eventIndicators.forEach(indicator => indicator.classList.remove('event-active'));
            
            eventSlides[n].classList.add('event-active');
            eventIndicators[n].classList.add('event-active');
            eventIndex = n;
        }

        // Show modal when View Event button is clicked
        eventBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modalId = btn.getAttribute('data-modal');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('active');
                    // Prevent body scrolling when modal is open
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close modal when close button is clicked
        modalCloseBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = btn.closest('.event-modal');
                if (modal) {
                    modal.classList.remove('active');
                    // Restore body scrolling
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal when clicking outside the content
        eventModals.forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    // Restore body scrolling
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                eventModals.forEach(modal => {
                    if (modal.classList.contains('active')) {
                        modal.classList.remove('active');
                        // Restore body scrolling
                        document.body.style.overflow = '';
                    }
                });
            }
        });

        eventNext.addEventListener('click', () => {
            let newIndex = (eventIndex + 1) % eventSlides.length;
            showEventSlide(newIndex);
        });

        eventPrev.addEventListener('click', () => {
            let newIndex = (eventIndex - 1 + eventSlides.length) % eventSlides.length;
            showEventSlide(newIndex);
        });

        // Add click event to indicators
        eventIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                showEventSlide(index);
            });
        });

        // Auto-advance the carousel every 10 seconds
        setInterval(() => {
            let newIndex = (eventIndex + 1) % eventSlides.length;
            showEventSlide(newIndex);
        }, 10000);
    </script>
 -->



 <section class="event-section">
    <h2 class="event-title">MOSQUE EVENTS</h2>
    
    <div class="event-carousel">
        <i class="fa-solid fa-chevron-left event-arrow event-left"></i>
        <i class="fa-solid fa-chevron-right event-arrow event-right"></i>
        
        </div>
    
    <div class="event-indicators">
        </div>
</section>