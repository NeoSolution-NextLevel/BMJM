<link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  .special-notices {
    font-family: 'Kadwa', serif;
    text-align: center;
    color: #111;
    padding: 40px 16px;
    max-width: 1400px;
    margin: 0 auto;
  }

  .special-notices__title {
    font-size: 2.2rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 10px;
  }

  .special-notices__subtitle {
    font-size: 0.95rem;
    color: #333;
    max-width: 720px;
    margin: 0 auto 24px;
    line-height: 1.6;
  }

  .special-carousel__wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 1000px;
    margin: 0 auto;
    padding: 12px 40px;
  }

  .special-carousel {
    display: flex;
    gap: 20px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px;
    scrollbar-width: none;
    -webkit-overflow-scrolling: touch;
    width: 100%;
    cursor: grab;
    touch-action: pan-y;
  -ms-touch-action: pan-y;
  }

  .special-carousel:active {
    cursor: grabbing;
  }

  .special-carousel::-webkit-scrollbar { 
    display: none; 
  }

  .special-notice__card {
    flex: 0 0 calc(33.333% - 14px); /* 3 cards with gap accounted for */
    height: 400px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.12);
    overflow: hidden;
    transition: transform 0.28s;
    display: flex;
    flex-direction: column;
    align-items: stretch;
  }

  .special-notice__card:hover { 
    transform: translateY(-6px); 
  }

  .special-notice__card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    background: #e9e9e9;
  }

  .special-notice__card p {
    font-size: 0.95rem;
    line-height: 1.6;
    padding: 16px 18px;
    color: #222;
    text-align: center;
    margin: 0;
    overflow-y: auto;
  }

  .special-carousel__btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #fff;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.18s;
    z-index: 10;
  }

  .special-carousel__btn:hover { 
    transform: translateY(-50%) scale(1.03); 
  }
  
  .special-carousel__btn:disabled { 
    opacity: 0.45; 
    cursor: default; 
    transform: translateY(-50%); 
  }

  .special-carousel__btn--left { 
    left: -8px; 
  }
  
  .special-carousel__btn--right { 
    right: -8px; 
  }

  /* Responsive adjustments */
  @media (max-width: 1024px) {
    .special-notice__card {
      flex: 0 0 calc(50% - 10px); /* 2 cards with gap accounted for */
    }
  }

  @media (max-width: 768px) {
    .special-notice__card {
      flex: 0 0 calc(50% - 10px); /* 2 cards with gap accounted for */
      height: 380px;
    }
    
    .special-carousel__wrapper {
      padding: 8px 20px;
    }
  }

  @media (max-width: 600px) {
    .special-notice__card {
      flex: 0 0 100%; /* 1 card */
      height: 360px;
    }
    
    .special-notices__title { 
      font-size: 1.8rem; 
    }
    
    .special-carousel__wrapper { 
      padding: 8px 8px; 
    }
    
    .special-carousel__btn {
      width: 36px;
      height: 36px;
      font-size: 1rem;
    }
    
    .special-carousel__btn--left { 
      left: 0; 
    }
    
    .special-carousel__btn--right { 
      right: 0; 
    }
  }

  @media (max-width: 480px) {
    .special-notices {
      padding: 30px 12px;
    }
    
    .special-notices__title { 
      font-size: 1.6rem; 
    }
    
    .special-notice__card {
      height: 340px;
    }
  }
</style>

<!-- <section class="special-notices" aria-labelledby="special-notices-heading">
  <h2 id="special-notices-heading" class="special-notices__title">SPECIAL NOTICES</h2>
  <p class="special-notices__subtitle">
    Here you will find the latest important updates and announcements to
    keep our Bambalapitiya Jumma Masjid community informed and connected in faith
  </p>

  <div class="special-carousel__wrapper">
    <button class="special-carousel__btn special-carousel__btn--left" id="special-prevBtn" aria-label="Scroll previous notice">
      <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
    </button>

    <div class="special-carousel" id="special-carousel" role="list" tabindex="0">
      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image1.png" alt="Clock showing prayer time" data-placeholder="https://via.placeholder.com/400x200?text=Notice+image">
        <p>Friday Jummah Prayer Time Update – Jummah prayer will begin at 1:15 PM starting from this week due to seasonal time changes.</p>
      </div>

      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image2.png" alt="Community Iftar">
        <p>Community Iftar Gathering – Join us for a community iftar this Saturday after Maghrib prayers in the masjid hall.</p>
      </div>

      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image3.png" alt="Qur'an class">
        <p>Qur'an Recitation Classes – New Qur'an recitation classes for children and adults will commence from 5th September.</p>
      </div>

      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image1.png" alt="Youth event">
        <p>Monthly Youth Talk – A special youth talk on "Faith in Modern Times" this Friday at 7:30 PM in the masjid hall.</p>
      </div>

      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image1.png" alt="Charity drive">
        <p>Charity Drive – Help support families in need by contributing to our Ramadan food donation campaign.</p>
      </div>

      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image1.png" alt="Maintenance notice">
        <p>Masjid Maintenance Notice – Scheduled cleaning will take place this Sunday after Dhuhr prayer. Please cooperate.</p>
      </div>
        
      <div class="special-notice__card" role="listitem">
        <img src="./assets/images/homepage-images/special-notices/image1.png" alt="Maintenance notice">
        <p>Masjid Maintenance Notice – Scheduled cleaning will take place this Sunday after Dhuhr prayer. Please cooperate. </p>
      </div>
    </div>

    <button class="special-carousel__btn special-carousel__btn--right" id="special-nextBtn" aria-label="Scroll next notice">
      <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
    </button>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
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
    const gap = 20;
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
    // Use scrollBy with behavior: 'smooth'. updateButtons will run via 'scroll' event.
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
  updateButtons();

  // Keyboard navigation:
  // Works when carousel has focus, contains focus, or is hovered with the mouse.
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

  // Pointer (mouse + touch) drag handling using Pointer Events for smoothness
  let isPointerDown = false;
  let pointerStartX = 0;
  let scrollStartX = 0;

  const onPointerDown = (e) => {
    // Only left button for mouse
    if (e.pointerType === 'mouse' && e.button !== 0) return;

    isPointerDown = true;
    carousel.classList.add('grabbing');
    pointerStartX = e.clientX;
    scrollStartX = carousel.scrollLeft;

    // Capture the pointer to continue receiving events even if pointer leaves the element
    carousel.setPointerCapture(e.pointerId);
  };

  const onPointerMove = (e) => {
    if (!isPointerDown) return;
    // Prevent default to avoid text selection / page jump
    e.preventDefault();
    const delta = e.clientX - pointerStartX; // positive when moving right
    // Invert direction so dragging left scrolls right
    carousel.scrollLeft = scrollStartX - delta;
  };

  const onPointerUpOrCancel = (e) => {
    if (!isPointerDown) return;
    isPointerDown = false;
    carousel.classList.remove('grabbing');
    try {
      carousel.releasePointerCapture(e.pointerId);
    } catch (err) {
      // ignore if pointer capture was not set
    }
    // Update buttons immediately after drag ends
    updateButtons();
  };

  carousel.addEventListener('pointerdown', onPointerDown);
  carousel.addEventListener('pointermove', onPointerMove);
  carousel.addEventListener('pointerup', onPointerUpOrCancel);
  carousel.addEventListener('pointercancel', onPointerUpOrCancel);
  carousel.addEventListener('pointerleave', onPointerUpOrCancel);

  // Improve accessibility: allow Enter/Space on focused card to open or focus content if desired
  // (left as a hook for your future enhancements)

  // Image fallback handling (unchanged but left here)
  const images = carousel.querySelectorAll('img');
  images.forEach(img => {
    img.addEventListener('error', () => {
      const fallback = img.dataset.placeholder || 'https://via.placeholder.com/400x200?text=Image+not+available';
      if (img.src !== fallback) img.src = fallback;
      img.alt = img.alt || 'Notice image';
      console.warn('Failed to load image; fallback applied:', img);
    });
  });

  // Provide a tiny focus indicator so keyboard users can see focus
  carousel.addEventListener('focus', () => carousel.classList.add('focused'));
  carousel.addEventListener('blur', () => carousel.classList.remove('focused'));
});
</script> -->

<section class="special-notices" aria-labelledby="special-notices-heading">
  <h2 id="special-notices-heading" class="special-notices__title">SPECIAL NOTICES</h2>
  <p class="special-notices__subtitle">
    Here you will find the latest important updates and announcements to
    keep our Bambalapitiya Jumma Masjid community informed and connected in faith
  </p>

  <div class="special-carousel__wrapper">
    <button class="special-carousel__btn special-carousel__btn--left" id="special-prevBtn" aria-label="Scroll previous notice">
      <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
    </button>

    <div class="special-carousel" id="special-carousel" role="list" tabindex="0">
        </div>

    <button class="special-carousel__btn special-carousel__btn--right" id="special-nextBtn" aria-label="Scroll next notice">
      <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
    </button>
  </div>
</section>