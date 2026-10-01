<style>
  /* NOTE: No body styles are set here per request. */

  /* Hero wrapper that takes the remaining viewport height (100vh - 15vh) */
  .hero {
    margin-top: 15vh;
    width: 100%;
    /* full width to the edge */
    height: calc(100vh - 15vh);
    /* leaves 15vh for external header */
    position: relative;
    overflow: hidden;
    font-family: "Georgia", serif;
    color: #f7f1e6;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Background video */
  .hero__video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: fill;
    z-index: 0;
    background: linear-gradient(180deg, #8aa76e 0%, #8aa76e 100%);
  }

  /* Optional overlay to recreate green tint */
  .hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(36, 82, 31, 0.12), rgba(39, 66, 40, 0.26));
    z-index: 1;
    pointer-events: none;
  }

  /* Content area centered in hero */
  .hero__content {
    position: relative;
    z-index: 2;
    width: min(1100px, 94%);
    display: grid;
    grid-template-columns: 1fr;
    justify-items: center;
    gap: 1.25rem;
    text-align: center;
    padding-block: 1.3rem;
  }

  /* card that contains carousel image + rounded border */
  .hero__card {
    width: 100%;
    max-width: 800px;

    overflow: hidden;
    background: transparent;
  }

  /* image carousel viewport */
  .carousel {
    position: relative;
    width: 100%;
    border-radius: 30px;
    height: clamp(240px, 50vh, 420px);
    /* responsive height */
    background: transparent;
  }

  /* carousel images */
  .carousel img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 30px;
    opacity: 0;
    transform: scale(1.02);
    transition: opacity 600ms ease, transform 700ms ease;
    background: transparent;
  }

  .carousel img.active {
    opacity: 1;
    transform: scale(1);
  }

  /* DOTS (separate, below the card) */
  .carousel-dots-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin-top: 10px;
  }

  .carousel__dots {
    display: flex;
    gap: 12px;
    justify-content: center;
    align-items: center;
  }

  .dot {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.35);
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    transition: transform 150ms ease, background 150ms ease;
    border: none;
  }

  .dot.active {
    background: #f3d28a;
    transform: scale(1.15);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
  }

  /* Title / Tag line */
  .hero__title {
    font-size: clamp(1.2rem, 2.6vw, 2.2rem);
    letter-spacing: 0.6px;
    color: #f6f3ef;
  }

  .hero__title .accent {
    color: #D5BC75;
    font-weight: 700;
    margin-left: 6px;
  }

  .hero__subtag {
    font-size: 0.76rem;
    letter-spacing: 3px;
    color: rgba(255, 255, 255, 0.85);
    margin-top: 6px;
  }

  /* Buttons row */
  .hero__actions {
    display: flex;
    gap: 18px;
    align-items: center;
    margin-top: 8px;
  }

  .btn {
    padding: 12px 26px;
    border-radius: 28px;
    font-weight: 700;
    cursor: pointer;
    border: none;
    letter-spacing: 0.8px;
    background: transparent;
  }

  .btn--primary {
    background: linear-gradient(180deg, #D5BC75, #D5BC75);
    color: #2b2b2b;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
  }

  .btn--primary:hover {
    background: #cbb35e;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  }

  .btn--primary:active {
    background: #f3d28a;
    color: #ffffff
  }

  .btn--outline {
    background: transparent;
    color: #f8f4ee;
    border: 2px solid rgba(255, 255, 255, 0.45);
    padding-left: 30px;
    padding-right: 34px;
  }

  .btn--outline .arrow {
    display: inline-block;
    margin-left: 8px;
    transform: translateX(0);
    transition: transform 160ms ease;
  }

  .btn--outline:hover .arrow {
    transform: translateX(6px);
  }

  .btn--outline:active {
    border: 2px solid #D5BC75;
    color: #D5BC75;
  }

  .btn--outline:hover {
    border: 2px solid #cbb35e;
  }

  /* ========== RESPONSIVE ENHANCEMENTS ========== */

  /* Large tablets and small desktops */
  @media (max-width: 1180px) {

    .hero__card {
      margin-top: 10vh;
      max-width: 60%;
    }

    .hero__content {
      gap: 1.1rem;
    }
  }

  @media (max-width: 1024px) {
    .hero {
      margin-top: 16vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      margin-top: 10vh;
      max-width: 70%;
    }
  }



  /* Tablets */
  @media (max-width: 992px) {

    .hero {
      margin-top: 25vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__content {
      gap: 1rem;
    }

    .hero__card {
      max-width: 50%;
    }

    .carousel {
      height: clamp(220px, 50vh, 380px);
    }

    .carousel img {
      object-fit: contain;
    }
  }

  @media (min-width: 910px) and (max-width: 914px) {
    .hero {
      margin-top: 8vh !important;

    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 100%;
    }
  }

  @media (max-width: 868px) {
    .hero {
      margin-top: 8vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 100%;
    }

  }

  @media (min-width: 840px) and (max-width: 850px) {
    .hero {
      margin-top: 25vh !important;

    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 60%;
    }
  }

  /* Small tablets and large phones */
  @media (max-width: 768px) {
    .hero {
      margin-top: 12vh !important;
      height: calc(100vh - 12vh);
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__content {
      gap: 0.9rem;
      padding-block: 1rem;
    }

    .hero__card {
      max-width: 92%;
      border-radius: 20px;
    }

    .carousel {
      height: clamp(200px, 40vh, 340px);
    }

    .hero__actions {
      flex-direction: column;
      width: 50%;
      gap: 12px;
    }

    .btn {
      width: 100%;
      text-align: center;
    }

    .hero__subtag {
      font-size: 0.7rem;
      letter-spacing: 2.5px;
    }
  }

  @media (max-width: 750px) {
    .hero {
      margin-top: 25vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 60%;
    }

    .hero__actions {
      width: 40%;
      margin-bottom: 8vh;
    }
  }

  @media (max-width: 720px) {
    .hero {
      margin-top: 20vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 60%;
    }

    .hero__actions {
      width: 40%;
      margin-bottom: 5vh;
    }
  }

  @media (max-width: 700px) {
    .hero {
      margin-top: 25vh !important;
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__card {
      max-width: 60%;
    }

    .hero__actions {
      width: 40%;
      margin-bottom: 5vh;
    }
  }

  /* Mobile phones */
  @media (max-width: 576px) {
    .hero {
      margin-top: 10vh !important;
      height: calc(100vh - 10vh);
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__content {
      gap: 0.8rem;
      padding-block: 0.8rem;
    }

    .hero__card {
      max-width: 100%;
      border-radius: 16px;
    }

    .carousel img {
      object-fit: contain;
      border-radius: 30px;
    }

    .carousel {
      height: clamp(180px, 30vh, 300px);
    }

    .hero__actions {
      width: 60%;
    }

    .hero__subtag {
      font-size: 0.65rem;
      letter-spacing: 2px;
    }

    .carousel__dots {
      gap: 10px;
    }

    .dot {
      width: 10px;
      height: 10px;
    }
  }

  /* Very small phones */
  @media (max-width: 400px) {
    .hero {
      margin-top: 8vh;
      height: calc(100vh - 8vh);
    }

    .hero__video {
      object-fit: cover;
    }

    .hero__content {
      gap: 0.7rem;
      padding-block: 0.7rem;
    }

    .hero__card {
      max-width: 96%;
      border-radius: 12px;
    }

    .carousel {
      height: clamp(160px, 30vh, 260px);
    }

    .hero__subtag {
      font-size: 0.6rem;
      letter-spacing: 1.5px;
    }

    .carousel__dots {
      gap: 8px;
    }

    .dot {
      width: 8px;
      height: 8px;
    }
  }

  /* Landscape mode adjustments */
  @media (max-height: 600px) and (orientation: landscape) {
    .hero {
      margin-top: 10vh;
      height: calc(100vh - 10vh);
    }

    .hero__content {
      gap: 0.8rem;
      padding-block: 0.8rem;
    }

    .carousel {
      height: clamp(160px, 45vh, 280px);
    }

    .hero__title {
      font-size: clamp(1.1rem, 2.2vw, 1.8rem);
    }

    .hero__subtag {
      font-size: 0.65rem;
      letter-spacing: 2px;
      margin-top: 4px;
    }

    .hero__actions {
      margin-top: 4px;
      gap: 12px;
    }

    .btn {
      padding: 10px 22px;
    }
  }

  /* Very short landscape mode */
  @media (max-height: 450px) and (orientation: landscape) {
    .hero {
      margin-top: 8vh;
      height: calc(100vh - 8vh);
    }

    .hero__content {
      gap: 0.6rem;
      padding-block: 0.6rem;
    }

    .carousel {
      height: clamp(140px, 40vh, 240px);
    }

    .hero__title {
      font-size: clamp(1rem, 2vw, 1.6rem);
    }

    .hero__subtag {
      font-size: 0.6rem;
      letter-spacing: 1.5px;
      margin-top: 2px;
    }

    .hero__actions {
      margin-top: 2px;
      gap: 10px;
    }

    .btn {
      padding: 8px 20px;
      font-size: 0.9rem;
    }
  }

  /* High-resolution displays */
  /*    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .hero__card {
        box-shadow: 0 12px 30px rgba(10,10,10,0.45);
      }
      
      .btn--primary {
        box-shadow: 0 6px 18px rgba(0,0,0,0.35);
      }
    }*/

  /* Reduced motion preference */
  @media (prefers-reduced-motion: reduce) {
    .carousel img {
      transition: none;
    }

    .dot {
      transition: none;
    }

    .btn--outline .arrow {
      transition: none;
    }
  }
</style>


<div class="hero" role="region" aria-label="Hero section with video background and image carousel">

  <video class="hero__video" autoplay muted loop playsinline preload="auto"
    data-video="replace-with-your-video-url" aria-hidden="true">
    <source src="./assets/videos/hero-section2.mp4" type="video/mp4">
  </video>

  <div class="hero__overlay" aria-hidden="true"></div>

  <div class="hero__content">
    <!-- IMAGE CARD -->
    <div class="hero__card" role="group" aria-label="Image carousel card">
      <div class="carousel" id="carousel" aria-live="polite">
        <img src="./assets/images/homepage-images/hero1.png" alt="sample view 1" class="active" data-index="0">
        <img src="./assets/images/homepage-images/hero2.png" alt="sample view 2" data-index="1">
        <img src="./assets/images/homepage-images/hero3.png" alt="sample view 3" data-index="2">
        <img src="./assets/images/homepage-images/hero4.png" alt="sample view 4" data-index="3">
        <!--          <img src="./assets/images/homepage-images/hero5.png" alt="sample view 5" data-index="4">-->
      </div>
    </div>

    <!-- Dots are placed outside the rounded card so they appear visually separated -->
    <div class="carousel-dots-wrap" aria-hidden="false">
      <div class="carousel__dots" id="dots" role="tablist" aria-label="Carousel navigation">
        <!-- Dots injected by JavaScript -->
      </div>
    </div>

    <!-- Title / Tag -->
    <div>
      <div class="hero__title">A Place of Peace in the <span class="accent">Name of Allah</span></div>
      <div class="hero__subtag">W E L L A W A T T A &nbsp; J U M M A &nbsp; M O S Q U E</div>
    </div>

    <!-- Buttons -->
    <div class="hero__actions" role="toolbar" aria-label="Hero actions">
      <a href="#prayer-time">
        <button class="btn btn--primary" id="prayerBtn" aria-controls="carousel">
          Prayer Time
        </button>
      </a>

      <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">
        <button class="btn btn--primary" type="button">Subscription</button>
      </a>

      <a><button class="btn btn--outline" id="registerBtn" onclick="navigate_register_page_btn()">Register Now <span class="arrow">→</span></button></a>
    </div>
  </div>
</div>

<script>
  function navigate_register_page_btn() {
    window.location.href = "<?php echo $pth; ?>Create-Masjid-Membership<?php echo $online_exnction; ?>";

  }


  (function() {
    /* Video fallback: if data-video is set, attach it as a source element */
    (function attachDataVideo() {
      const vid = document.querySelector('.hero__video');
      if (!vid) return;
      const dataUrl = vid.getAttribute('data-video');
      // If a data-video is provided and there's no <source>, set it as src
      const hasSource = vid.querySelector('source');
      if (dataUrl && !hasSource) {
        const s = document.createElement('source');
        s.src = dataUrl;
        // assume mp4 by default; if you have webm prefer that
        s.type = 'video/mp4';
        vid.appendChild(s);
        // reload the video element so browsers pick up the new source
        vid.load();
      }
    })();

    const carouselEl = document.getElementById('carousel');
    const images = Array.from(carouselEl.querySelectorAll('img'));
    const dotsContainer = document.getElementById('dots');
    const autoplayInterval = 4000;
    let currentIndex = 0;
    let autoplayId = null;
    const total = images.length;

    // create dots
    images.forEach((img, idx) => {
      const dot = document.createElement('button');
      dot.className = 'dot' + (idx === 0 ? ' active' : '');
      dot.setAttribute('aria-label', `Show image ${idx + 1}`);
      dot.setAttribute('role', 'tab');
      dot.dataset.index = idx;
      dot.addEventListener('click', () => goToSlide(idx, true));
      dotsContainer.appendChild(dot);
    });

    const dots = Array.from(dotsContainer.querySelectorAll('.dot'));

    function goToSlide(index, userTriggered = false) {
      if (index < 0) index = total - 1;
      if (index >= total) index = 0;

      if (index === currentIndex && !userTriggered) return;

      images[currentIndex].classList.remove('active');
      dots[currentIndex].classList.remove('active');

      images[index].classList.add('active');
      dots[index].classList.add('active');

      currentIndex = index;

      if (userTriggered) restartAutoplay();
    }

    function nextSlide() {
      goToSlide(currentIndex + 1);
    }

    function startAutoplay() {
      stopAutoplay();
      autoplayId = setInterval(nextSlide, autoplayInterval);
    }

    function stopAutoplay() {
      if (autoplayId) {
        clearInterval(autoplayId);
        autoplayId = null;
      }
    }

    function restartAutoplay() {
      stopAutoplay();
      startAutoplay();
    }

    //      // Buttons interactions
    //      document.getElementById('prayerBtn').addEventListener('click', () => {
    //        // Jump to first slide (example behaviour)
    //        goToSlide(0, true);
    //      });
    //
    //      document.getElementById('registerBtn').addEventListener('click', () => {
    //        // Jump to next slide (example behaviour)
    //        goToSlide(currentIndex + 1, true);
    //      });

    // pause autoplay on hover/focus for accessibility
    carouselEl.addEventListener('mouseenter', stopAutoplay);
    carouselEl.addEventListener('mouseleave', startAutoplay);
    carouselEl.addEventListener('focusin', stopAutoplay);
    carouselEl.addEventListener('focusout', startAutoplay);

    // start autoplay
    startAutoplay();

    // Keyboard support: left/right arrow to navigate
    document.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        goToSlide(currentIndex - 1, true);
      } else if (e.key === 'ArrowRight') {
        goToSlide(currentIndex + 1, true);
      }
    });

    // expose for debugging if useful
    window.__heroCarousel = {
      goTo: goToSlide,
      next: nextSlide,
      start: startAutoplay,
      stop: stopAutoplay
    };
  })();
</script>
