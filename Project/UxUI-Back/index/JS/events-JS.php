<!-- 









<script>
$(document).ready(function() {
    load_homepage_events();
});

// ==========================================
// 1. LOAD DATA & BUILD HTML
// ==========================================
function load_homepage_events() {
    $.ajax({
        // Ensure this path is correct
        url: "<?php echo $pth; ?>View-List/Frontend Events & News/News_Feed/News_feed_list.php",
        type: "POST",
        dataType: "json",
        data: { search_txt: "", per_page: 10, page_no: 1 },
        success: function(data) {
            
            let carouselHTML = '';
            let indicatorsHTML = '';

            // 1. ADD ARROWS (Crucial for the JS to find them later)
            carouselHTML += `<i class="fa-solid fa-chevron-left event-arrow event-left"></i>`;
            carouselHTML += `<i class="fa-solid fa-chevron-right event-arrow event-right"></i>`;

            if (data.error === false && data.items.length > 0) {
                // Filter active events
                let activeEvents = data.items.filter(item => item.show_on_web == "1").slice(0, 5);
                
                activeEvents.forEach((item, index) => {
                    let activeClass = (index === 0) ? 'event-active' : '';

                    // SLIDE
                    carouselHTML += `
                        <div class="event-slide ${activeClass}">
                            <img src="${item.image_pth}" alt="${item.heading}" onerror="this.src='assets/images/default.jpg'">
                            <button class="event-btn" onclick="fetch_single_event('${item.id}')">View Event</button>
                        </div>
                    `;

                    // INDICATOR
                    indicatorsHTML += `<div class="event-indicator ${activeClass}"></div>`;
                });

                // Inject HTML
                $('#dynamic_carousel_container').html(carouselHTML);
                $('#dynamic_indicators_container').html(indicatorsHTML);

                // 2. INITIALIZE LOGIC (Now that elements exist)
                init_carousel_logic();
            } else {
                $('#dynamic_carousel_container').html('<p class="w3-center w3-text-white">No active events.</p>');
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// ==========================================
// 2. FETCH SINGLE DETAILS (Modal)
// ==========================================
function fetch_single_event(id) {
    const modal = document.getElementById('single-event-modal');
    if(!modal) return; // Safety check

    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; 
    
    // Reset fields
    document.getElementById('modal_heading').innerText = "Loading...";
    document.getElementById('modal_dis').innerText = "Please wait...";
    document.getElementById('modal_img').src = ""; 

    $.ajax({
        url: "View-List/Frontend Events & News/Event/Events_single_data.php", 
        type: "POST",
        dataType: "json",
        data: { id: id },
        success: function(response) {
            if (response.error === false && response.data) {
                let item = response.data;
                document.getElementById('modal_heading').innerText = item.heading;
                document.getElementById('modal_dis').innerText = item.dis;
                document.getElementById('modal_address').innerText = item.address;
                document.getElementById('modal_time').innerText = item.event_time;
                document.getElementById('modal_date').innerText = item.event_date;
                
                let imgSrc = item.image_full_url || item.image_pth;
                if(imgSrc) document.getElementById('modal_img').src = imgSrc;
            } else {
                document.getElementById('modal_dis').innerText = "Details not found.";
            }
        },
        error: function() {
            document.getElementById('modal_dis').innerText = "Connection Error.";
        }
    });
}

// ==========================================
// 3. CAROUSEL LOGIC (With Safety Checks)
// ==========================================
function init_carousel_logic() {
    const eventSlides = document.querySelectorAll('.event-slide');
    const eventPrev = document.querySelector('.event-arrow.event-left');
    const eventNext = document.querySelector('.event-arrow.event-right');
    const eventIndicators = document.querySelectorAll('.event-indicator');
    let eventIndex = 0;

    // Safety Check: If no slides, stop here.
    if(eventSlides.length === 0) return;

    function showEventSlide(n) {
        eventSlides.forEach(slide => slide.classList.remove('event-active'));
        eventIndicators.forEach(indicator => indicator.classList.remove('event-active'));
        
        eventSlides[n].classList.add('event-active');
        eventIndicators[n].classList.add('event-active');
        eventIndex = n;
    }

    // SAFETY CHECK: Only add listener if 'eventNext' exists
    if (eventNext) {
        eventNext.addEventListener('click', () => {
            let newIndex = (eventIndex + 1) % eventSlides.length;
            showEventSlide(newIndex);
        });
    }

    // SAFETY CHECK: Only add listener if 'eventPrev' exists
    if (eventPrev) {
        eventPrev.addEventListener('click', () => {
            let newIndex = (eventIndex - 1 + eventSlides.length) % eventSlides.length;
            showEventSlide(newIndex);
        });
    }

    eventIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => showEventSlide(index));
    });

    // Auto Play
    if(window.homeCarouselInterval) clearInterval(window.homeCarouselInterval);
    window.homeCarouselInterval = setInterval(() => {
        let newIndex = (eventIndex + 1) % eventSlides.length;
        showEventSlide(newIndex);
    }, 10000);
}

// ==========================================
// 4. MODAL CLOSE LOGIC
// ==========================================
function close_modal() {
    const modal = document.getElementById('single-event-modal');
    if(modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Close on Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') close_modal();
});

// Close on Outside Click
const modalElement = document.getElementById('single-event-modal');
if(modalElement){
    modalElement.addEventListener('click', (e) => {
        if (e.target === modalElement) close_modal();
    });
}
</script> -->


<script type="text/javascript">
    
    // --- CONFIGURATION ---
    //var eventApiUrl = "View-List/Frontend Events & News/Events/Events_List_Load.php";
    // FIX 404: Use "../" to go out of Dash-Board folder if needed
    var eventImgPath = "Data/Shadow_Shine/"; 
    // Use an online fallback to prevent infinite 404 loops
    var eventFallbackImg = "https://placehold.co/600x400?text=Event+Image";

    $(document).ready(function() {
        load_events_carousel_data();
    });

    function load_events_carousel_data() {
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Frontend Events & News/Event/Event_list.php",
            //C:\xampp\htdocs\GitHub\bmjm\View-List\Frontend Events & News\Event\Event_list.php
            type: 'POST',
            data: { 
                page_no: 1, 
                per_page: 10, 
                search_val: "" 
            },
            success: function(response) {
                console.log("Response:", response);
                try {
                    if(!response || response.trim() === ""){
                        console.warn("Empty response for Events");
                        return;
                    }

                    const json = JSON.parse(response);

                    if (json.length === 0) {
                        $('.event-carousel').html('<p style="color:white; text-align:center; padding:50px;">No upcoming events.</p>');
                    } else {
                        render_event_slides(json);
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

    function render_event_slides(data) {
        var carouselContainer = $('.event-carousel');
        var indicatorsContainer = $('.event-indicators');
        
        // 1. Preserve Arrows
        var leftArrow = carouselContainer.find('.event-arrow.event-left');
        var rightArrow = carouselContainer.find('.event-arrow.event-right');
        
        // 2. Clear Containers
        carouselContainer.empty();
        indicatorsContainer.empty();
        $('#dynamic-event-modals').remove(); 
        $('body').append('<div id="dynamic-event-modals"></div>'); 
        var modalContainer = $('#dynamic-event-modals');

        // 3. Restore Arrows
        carouselContainer.append(leftArrow);
        carouselContainer.append(rightArrow);

        var slideCount = 0;

        $.each(data, function(index, item) {
            
            if (item.show_on_web != "1") return;

            // --- IMAGE LOGIC (Fixing 404s) ---
            var imgSrc = eventFallbackImg;
            if (item.image_pth && item.image_pth.trim() !== "") {
                if (item.image_pth.indexOf("/") > -1) {
                    // Path has slashes, check if it needs ../
                    if(item.image_pth.substring(0, 3) !== "../") {
                       imgSrc = "../" + item.image_pth;
                    } else {
                       imgSrc = item.image_pth;
                    }
                } else {
                    // Filename only
                    imgSrc = "../" + eventImgPath + item.image_pth;
                }
            }

            // --- DATA MAPPING ---
            var title = item.heading || "Untitled Event";
            var desc  = item.description || item.dis || "";
            
            // THESE VARIABLES MUST MATCH PHP KEYS
            var loc   = item.address; 
            var time  = item.event_time;
            var date  = item.event_date;

            var modalId = "modal-event-" + item.id;
            var activeClass = (slideCount === 0) ? "event-active" : "";

            // --- A. SLIDE HTML ---
            var slideHTML = `
                <div class="event-slide ${activeClass}">
                    <img src="${imgSrc}" alt="${title}" onerror="this.src='${eventFallbackImg}'">
                    <button class="event-btn" data-modal="${modalId}">View Event</button>
                </div>
            `;
            carouselContainer.append(slideHTML);

            // --- B. INDICATOR HTML ---
            var indicatorHTML = `<div class="event-indicator ${activeClass}"></div>`;
            indicatorsContainer.append(indicatorHTML);

            // --- C. MODAL HTML (With Location, Time, Date) ---
            var modalHTML = `
                <div id="${modalId}" class="event-modal">
                    <div class="event-modal-content">
                        <div class="event-modal-header">
                            <img src="${imgSrc}" alt="${title}" onerror="this.src='${eventFallbackImg}'">
                            <button class="event-modal-close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="event-modal-body">
                            <h3 class="event-modal-title">${title}</h3>
                            
                            <div class="event-modal-details">
                                <div class="event-modal-detail">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>${loc}</span>
                                </div>
                                <div class="event-modal-detail">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>${time}</span>
                                </div>
                                <div class="event-modal-detail">
                                    <i class="fa-solid fa-calendar"></i>
                                    <span>${date}</span>
                                </div>
                            </div>
                            
                            <p class="event-modal-description" style="white-space: pre-wrap;">${desc}</p>
                        </div>
                    </div>
                </div>
            `;
            modalContainer.append(modalHTML);

            slideCount++;
        });

        // Initialize Logic
        initialize_event_carousel();
    }

    // ==========================================
    // CAROUSEL LOGIC
    // ==========================================
    function initialize_event_carousel() {
        const eventSlides = document.querySelectorAll('.event-slide');
        const eventIndicators = document.querySelectorAll('.event-indicator');
        const eventPrev = document.querySelector('.event-arrow.event-left');
        const eventNext = document.querySelector('.event-arrow.event-right');
        
        // Remove old listeners
        $(document).off('click', '.event-btn');
        $(document).off('click', '.event-modal-close');
        $(document).off('click', '.event-modal');

        let eventIndex = 0;

        function showEventSlide(n) {
            if(eventSlides.length === 0) return;
            eventSlides.forEach(slide => slide.classList.remove('event-active'));
            eventIndicators.forEach(indicator => indicator.classList.remove('event-active'));
            
            if(eventSlides[n]) eventSlides[n].classList.add('event-active');
            if(eventIndicators[n]) eventIndicators[n].classList.add('event-active');
            
            eventIndex = n;
        }

        if(eventNext) {
            var newNext = eventNext.cloneNode(true);
            eventNext.parentNode.replaceChild(newNext, eventNext);
            newNext.addEventListener('click', () => {
                let newIndex = (eventIndex + 1) % eventSlides.length;
                showEventSlide(newIndex);
            });
        }

        if(eventPrev) {
            var newPrev = eventPrev.cloneNode(true);
            eventPrev.parentNode.replaceChild(newPrev, eventPrev);
            newPrev.addEventListener('click', () => {
                let newIndex = (eventIndex - 1 + eventSlides.length) % eventSlides.length;
                showEventSlide(newIndex);
            });
        }

        eventIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                showEventSlide(index);
            });
        });

        // MODAL HANDLERS
        $(document).on('click', '.event-btn', function() {
            var modalId = $(this).attr('data-modal');
            $('#' + modalId).addClass('active');
            $('body').css('overflow', 'hidden');
        });

        $(document).on('click', '.event-modal-close', function() {
            $(this).closest('.event-modal').removeClass('active');
            $('body').css('overflow', '');
        });

        $(document).on('click', '.event-modal', function(e) {
            if ($(e.target).is('.event-modal')) {
                $(this).removeClass('active');
                $('body').css('overflow', '');
            }
        });

        // Auto Play
        if(window.eventCarouselInterval) clearInterval(window.eventCarouselInterval);
        window.eventCarouselInterval = setInterval(() => {
            if(eventSlides.length > 0) {
                let newIndex = (eventIndex + 1) % eventSlides.length;
                showEventSlide(newIndex);
            }
        }, 10000);
    }
</script>