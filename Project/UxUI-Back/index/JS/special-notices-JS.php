<!-- <script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. First, fetch the data
    loadSpecialNotices();
});

// =========================================================
// PART 1: FETCH DATA FROM BACKEND
// =========================================================

// PATH SETUP: Adjust these if your folders are different
const API_URL = "<?php echo $pth; ?>View-List/Frontend Events & News/Special_Notice/Special_notice_list.php "; 
// If your images are in a 'Data' folder at the root, use "./"
const IMAGE_ROOT = "./"; 

function loadSpecialNotices() {
    
    // Prepare POST data
    const formData = new FormData();
    formData.append('search_txt', ''); // No search, get all
    formData.append('per_page', 20);   // Limit to latest 20
    formData.append('page_no', 1);

    fetch(API_URL, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error === false && data.data_list.length > 0) {
            // Data found, render it
            renderCarouselItems(data.data_list);
        } else {
            // No data found, hide the section or show a message
            console.log("No notices found.");
            document.querySelector('.special-notices').style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error loading notices:', error);
    });
}

function renderCarouselItems(notices) {
    const carousel = document.getElementById('special-carousel');
    let htmlContent = '';
    let count = 0;

    notices.forEach(item => {
        // FILTER: Only show items marked 'Show On Web' (1)
        if (item.show_on_web == 1) {
            
            // IMAGE PATH CLEANING
            // The DB might have "../Data/..." or just "Data/..."
            let rawPath = item.image_pth || "";
            let finalImgPath = "";

            if (rawPath === "" || rawPath === "DEFAULT") {
                // Use a placeholder if no image
                finalImgPath = "https://via.placeholder.com/400x200?text=Bambalapitiya+Masjid";
            } else {
                // Remove "../" if it exists, so we get a clean path like "Data/Folder/img.jpg"
                let cleanPath = rawPath.replace(/\.\.\//g, ""); 
                finalImgPath = IMAGE_ROOT + cleanPath;
            }

            // GENERATE HTML CARD
            htmlContent += `
            <div class="special-notice__card" role="listitem">
                <img src="${finalImgPath}" alt="Notice" onerror="this.src='https://via.placeholder.com/400x200?text=Image+Unavailable'">
                <p>${item.dis}</p>
            </div>`;
            
            count++;
        }
    });

    // If we have items, inject them and START the carousel logic
    if (count > 0) {
        carousel.innerHTML = htmlContent;
        initCarouselLogic(); // <--- CRITICAL: Run logic AFTER HTML is added
    } else {
        document.querySelector('.special-notices').style.display = 'none';
    }
}

// =========================================================
// PART 2: CAROUSEL LOGIC (Your Original Code Wrapped)
// =========================================================
function initCarouselLogic() {
    const carousel = document.getElementById('special-carousel');
    const prevBtn = document.getElementById('special-prevBtn');
    const nextBtn = document.getElementById('special-nextBtn');

    // Ensure focusable for keyboard control
    carousel.tabIndex = 0;

    // Calculate scroll amount based on visible cards
    const getScrollAmount = () => {
        const card = carousel.querySelector('.special-notice__card');
        if (!card) return carousel.clientWidth;
        const cardWidth = card.offsetWidth;
        const gap = 20; // Ensure this matches your CSS gap
        const containerWidth = carousel.clientWidth;
        let cardsVisible = 1;
        if (containerWidth >= 1024) {
            cardsVisible = 3;
        } else if (containerWidth >= 600) {
            cardsVisible = 2;
        }
        return Math.round(cardWidth * cardsVisible + gap * (cardsVisible - 1));
    };

    // Smooth scroll helpers
    const smoothScrollBy = (left) => {
        carousel.scrollBy({ left, behavior: 'smooth' });
    };

    // Button click handlers
    nextBtn.addEventListener('click', () => smoothScrollBy(getScrollAmount()));
    prevBtn.addEventListener('click', () => smoothScrollBy(-getScrollAmount()));

    // Update button states based on scroll position
    const updateButtons = () => {
        const maxScrollLeft = Math.max(0, carousel.scrollWidth - carousel.clientWidth - 1);
        prevBtn.disabled = carousel.scrollLeft <= 1;
        nextBtn.disabled = carousel.scrollLeft >= maxScrollLeft;
    };

    carousel.addEventListener('scroll', updateButtons);
    window.addEventListener('resize', updateButtons);
    
    // Give images a moment to load so scrollWidth calculates correctly
    setTimeout(updateButtons, 100);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const activeInside = carousel.contains(document.activeElement);
        const hovered = carousel.matches(':hover');
        const focused = document.activeElement === carousel;
        if (!(activeInside || hovered || focused)) return;

        if (e.key === 'ArrowRight') {
            e.preventDefault();
            smoothScrollBy(getScrollAmount());
        } else if (e.key === 'ArrowLeft') {
            e.preventDefault();
            smoothScrollBy(-getScrollAmount());
        }
    });

    // Pointer (mouse + touch) drag handling
    let isPointerDown = false;
    let pointerStartX = 0;
    let scrollStartX = 0;

    const onPointerDown = (e) => {
        if (e.pointerType === 'mouse' && e.button !== 0) return;
        isPointerDown = true;
        carousel.classList.add('grabbing');
        pointerStartX = e.clientX;
        scrollStartX = carousel.scrollLeft;
        carousel.setPointerCapture(e.pointerId);
    };

    const onPointerMove = (e) => {
        if (!isPointerDown) return;
        e.preventDefault();
        const delta = e.clientX - pointerStartX;
        carousel.scrollLeft = scrollStartX - delta;
    };

    const onPointerUpOrCancel = (e) => {
        if (!isPointerDown) return;
        isPointerDown = false;
        carousel.classList.remove('grabbing');
        try {
            carousel.releasePointerCapture(e.pointerId);
        } catch (err) {}
        updateButtons();
    };

    carousel.addEventListener('pointerdown', onPointerDown);
    carousel.addEventListener('pointermove', onPointerMove);
    carousel.addEventListener('pointerup', onPointerUpOrCancel);
    carousel.addEventListener('pointercancel', onPointerUpOrCancel);
    carousel.addEventListener('pointerleave', onPointerUpOrCancel);

    // Focus indicators
    carousel.addEventListener('focus', () => carousel.classList.add('focused'));
    carousel.addEventListener('blur', () => carousel.classList.remove('focused'));
}
</script> -->


















<!-- <script>

$(document).ready(function() {
    loadSpecialNotices();
});

function loadSpecialNotices() {
    $.ajax({
        // Update this path to where your PHP viewlist file is located
       url: "<?php echo $pth; ?>View-List/Frontend Events & News/Special_Notice/Special_notice_list.php", 
        type: "POST",
        dataType: "json",
        data: {
            page_no: 1,
            per_page: 10, // Adjust as needed
            public_view: 1 // Triggers your PHP filter: $list_obj->filter_by_show_on_web('1');
        },
        success: function(response) {
            var container = $('#special-carousel');
            container.empty(); // Remove "Loading..." text

            if (response.length > 0) {
                var html = '';

                // Loop through JSON data
                $.each(response, function(index, item) {
                    // Handle Image Path (Adjust prefix if needed)
                    var imgPath = item.image_pth ? item.image_pth : 'https://via.placeholder.com/400x200?text=No+Image';
                    
                    html += '<div class="special-notice__card" role="listitem">';
                    html += '   <img src="' + imgPath + '" alt="Notice Image" onerror="this.src=\'https://via.placeholder.com/400x200?text=Image+Not+Found\'">';
                    html += '   <p>' + item.dis + '</p>'; // 'dis' comes from your PHP array key
                    html += '</div>';
                });

                container.append(html);

                // Initialize the carousel logic ONLY after data is loaded
                initCarouselInteractions();
            } else {
                container.html('<p style="color:white; padding:20px;">No special notices found.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
            $('#special-carousel').html('<p style="color:red; padding:20px;">Failed to load notices.</p>');
        }
    });
}

// Your Original Carousel Logic (Wrapped in a function)
function initCarouselInteractions() {
    const carousel = document.getElementById('special-carousel');
    const prevBtn = document.getElementById('special-prevBtn');
    const nextBtn = document.getElementById('special-nextBtn');

    if (!carousel || !prevBtn || !nextBtn) return;

    // --- 1. Calculations ---
    const getScrollAmount = () => {
        const card = carousel.querySelector('.special-notice__card');
        if (!card) return carousel.clientWidth;
        
        const cardWidth = card.offsetWidth;
        const gap = 20; // Ensure this matches your CSS gap
        const containerWidth = carousel.clientWidth;
        
        let cardsVisible = 1;
        if (containerWidth >= 1024) cardsVisible = 3;
        else if (containerWidth >= 600) cardsVisible = 2;

        return Math.round(cardWidth * cardsVisible + gap * (cardsVisible - 1));
    };

    const smoothScrollBy = (left) => {
        carousel.scrollBy({ left, behavior: 'smooth' });
    };

    const updateButtons = () => {
        const maxScrollLeft = Math.max(0, carousel.scrollWidth - carousel.clientWidth - 1);
        prevBtn.disabled = carousel.scrollLeft <= 1;
        nextBtn.disabled = carousel.scrollLeft >= maxScrollLeft;
    };

    // --- 2. Event Listeners ---
    // Remove old listeners to prevent duplicates if function runs twice
    var newNextBtn = nextBtn.cloneNode(true);
    var newPrevBtn = prevBtn.cloneNode(true);
    nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
    prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);

    newNextBtn.addEventListener('click', () => smoothScrollBy(getScrollAmount()));
    newPrevBtn.addEventListener('click', () => smoothScrollBy(-getScrollAmount()));

    carousel.addEventListener('scroll', updateButtons);
    window.addEventListener('resize', updateButtons);
    
    // Run immediately to set initial button state
    setTimeout(updateButtons, 100); 

    // --- 3. Drag / Pointer Logic ---
    let isPointerDown = false;
    let pointerStartX = 0;
    let scrollStartX = 0;

    const onPointerDown = (e) => {
        if (e.pointerType === 'mouse' && e.button !== 0) return;
        isPointerDown = true;
        carousel.classList.add('grabbing');
        pointerStartX = e.clientX;
        scrollStartX = carousel.scrollLeft;
        carousel.setPointerCapture(e.pointerId);
    };

    const onPointerMove = (e) => {
        if (!isPointerDown) return;
        e.preventDefault();
        const delta = e.clientX - pointerStartX;
        carousel.scrollLeft = scrollStartX - delta;
    };

    const onPointerUpOrCancel = (e) => {
        if (!isPointerDown) return;
        isPointerDown = false;
        carousel.classList.remove('grabbing');
        try { carousel.releasePointerCapture(e.pointerId); } catch (err) {}
        updateButtons();
    };

    carousel.addEventListener('pointerdown', onPointerDown);
    carousel.addEventListener('pointermove', onPointerMove);
    carousel.addEventListener('pointerup', onPointerUpOrCancel);
    carousel.addEventListener('pointercancel', onPointerUpOrCancel);
    carousel.addEventListener('pointerleave', onPointerUpOrCancel);
}
</script>
 -->








<script>
$(document).ready(function() {
    // 1. Call the AJAX function immediately
    loadSpecialNoticesData();
});

function loadSpecialNoticesData() {
    $.ajax({
        // UPDATE THIS PATH to match your folder structure
        url: "<?php echo $pth; ?>View-List/Frontend Events & News/Special_Notice/Special_notice_list.php",  
        type: "POST",
        dataType: "json",
        data: {
            page_no: 1,
            per_page: 20, // Load enough for the carousel
            public_view: "1" // Important: This triggers your PHP filter
        },
        success: function(response) {
            var container = $('#special-carousel');
            container.empty(); 

            // Check if we have data
            if (response.length > 0) {
                var htmlCode = '';

                // Loop through your PHP JSON response
                $.each(response, function(index, item) {
                    
                    // Handle image: Use the one from DB or a placeholder
                    var imgSource = item.image_pth ? item.image_pth : 'https://via.placeholder.com/400x200?text=No+Image';

                    // --- GENERATE EXACT HTML STRUCTURE ---
                    htmlCode += '<div class="special-notice__card" role="listitem">';
                    htmlCode += '   <img src="' + imgSource + '" alt="Notice Image" data-placeholder="https://via.placeholder.com/400x200?text=Notice+image">';
                    htmlCode += '   <p>' + item.dis + '</p>'; // Using 'dis' from your PHP
                    htmlCode += '</div>';
                });

                // Inject the HTML
                container.append(htmlCode);

                // 2. NOW start the carousel logic (Your original code)
                startOriginalCarouselLogic();
            } else {
                container.html('<p style="padding:20px; color:#fff;">No special notices at this time.</p>');
            }
        },
        error: function(err) {
            console.error("Error loading notices", err);
        }
    });
}

// --- YOUR ORIGINAL UI CODE (Wrapped in a function) ---
function startOriginalCarouselLogic() {
  const carousel = document.getElementById('special-carousel');
  const prevBtn = document.getElementById('special-prevBtn');
  const nextBtn = document.getElementById('special-nextBtn');

  // Safety check
  if(!carousel || !prevBtn || !nextBtn) return;

  // Ensure focusable for keyboard control
  carousel.tabIndex = 0;

  // Calculate scroll amount based on visible cards
  const getScrollAmount = () => {
    const card = carousel.querySelector('.special-notice__card');
    if (!card) return carousel.clientWidth;
    const cardWidth = card.offsetWidth;
    const gap = 20; // Check if your CSS gap is 20px
    const containerWidth = carousel.clientWidth;
    let cardsVisible = 1;
    if (containerWidth >= 1024) {
      cardsVisible = 3;
    } else if (containerWidth >= 600) {
      cardsVisible = 2;
    }
    return Math.round(cardWidth * cardsVisible + gap * (cardsVisible - 1));
  };

  // Smooth scroll helpers
  const smoothScrollBy = (left) => {
    carousel.scrollBy({ left, behavior: 'smooth' });
  };

  // Button click handlers (Using .onclick to prevent duplicate listeners if re-run)
  nextBtn.onclick = () => smoothScrollBy(getScrollAmount());
  prevBtn.onclick = () => smoothScrollBy(-getScrollAmount());

  // Update button states based on scroll position
  const updateButtons = () => {
    const maxScrollLeft = Math.max(0, carousel.scrollWidth - carousel.clientWidth - 1);
    prevBtn.disabled = carousel.scrollLeft <= 1;
    nextBtn.disabled = carousel.scrollLeft >= maxScrollLeft;
  };

  carousel.addEventListener('scroll', updateButtons);
  window.addEventListener('resize', updateButtons);
  
  // Call once immediately to set initial state
  setTimeout(updateButtons, 100);

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    const activeInside = carousel.contains(document.activeElement);
    const hovered = carousel.matches(':hover');
    const focused = document.activeElement === carousel;
    if (!(activeInside || hovered || focused)) return;

    if (e.key === 'ArrowRight') {
      e.preventDefault();
      smoothScrollBy(getScrollAmount());
    } else if (e.key === 'ArrowLeft') {
      e.preventDefault();
      smoothScrollBy(-getScrollAmount());
    }
  });

  // Pointer (mouse + touch) drag handling
  let isPointerDown = false;
  let pointerStartX = 0;
  let scrollStartX = 0;

  const onPointerDown = (e) => {
    if (e.pointerType === 'mouse' && e.button !== 0) return;
    isPointerDown = true;
    carousel.classList.add('grabbing');
    pointerStartX = e.clientX;
    scrollStartX = carousel.scrollLeft;
    carousel.setPointerCapture(e.pointerId);
  };

  const onPointerMove = (e) => {
    if (!isPointerDown) return;
    e.preventDefault();
    const delta = e.clientX - pointerStartX;
    carousel.scrollLeft = scrollStartX - delta;
    updateButtons(); // added update here for smoother button state feeling
  };

  const onPointerUpOrCancel = (e) => {
    if (!isPointerDown) return;
    isPointerDown = false;
    carousel.classList.remove('grabbing');
    try {
      carousel.releasePointerCapture(e.pointerId);
    } catch (err) {
      // ignore
    }
    updateButtons();
  };

  carousel.addEventListener('pointerdown', onPointerDown);
  carousel.addEventListener('pointermove', onPointerMove);
  carousel.addEventListener('pointerup', onPointerUpOrCancel);
  carousel.addEventListener('pointercancel', onPointerUpOrCancel);
  carousel.addEventListener('pointerleave', onPointerUpOrCancel);

  // Image fallback handling
  const images = carousel.querySelectorAll('img');
  images.forEach(img => {
    img.addEventListener('error', () => {
      const fallback = img.dataset.placeholder || 'https://via.placeholder.com/400x200?text=Image+not+available';
      if (img.src !== fallback) img.src = fallback;
      img.alt = img.alt || 'Notice image';
    });
  });

  // Focus indicators
  carousel.addEventListener('focus', () => carousel.classList.add('focused'));
  carousel.addEventListener('blur', () => carousel.classList.remove('focused'));
}
</script>