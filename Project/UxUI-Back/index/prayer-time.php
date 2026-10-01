<link
  href="https://fonts.googleapis.com/css2?family=Inter&display=swap"
  rel="stylesheet" />
<link
  href="https://fonts.googleapis.com/css2?family=Kumar+One&display=swap"
  rel="stylesheet" />
<link
  href="https://fonts.googleapis.com/css2?family=Jeju+Myeongjo&display=swap"
  rel="stylesheet" />
<link
  href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap"
  rel="stylesheet" />
<link
  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic"
  rel="stylesheet" />
<!-- Font Awesome for icons -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!<!-- swipper -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Header Styles - Separate from carousel */
    .prayer-header {
      width: 100%;
      margin-top: 40px;
      color: white;
      padding: 20px;
      text-align: center;
      margin-bottom: 2vh;
    }

    .prayer-header h1 {
      font-family: "Kadwa", serif;
      color: #000;
      font-size: 2rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 3px;
      margin-bottom: 8px;
      /*            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);*/
    }

    .countdown {
      font-family: "Kadwa", serif;
      font-size: 1.2rem;
      font-weight: 600;
      background: #d5bc75;
      padding: 20px 30px;
      border-radius: 12px;
      display: inline-block;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .countdown-name {
      color: #fff;
      font-weight: 700;
    }

    .countdown-time {
      color: #fff;
      font-weight: 800;
      transition: all 0.3s ease;
    }

    .countdown-time.urgent {
      color: #ff6b6b;
      animation: pulse 0.5s infinite;
    }

    /* Next Prayer Badge */
    .next-prayer-badge {
      font-family: "Playfair Display", serif;
      position: absolute;
      top: 15px;
      right: 15px;
      background: linear-gradient(45deg, #9bad6b, #858e6f);
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      z-index: 10;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }

    /* Carousel Styles */
    .carousel-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 30vh;
      padding: 20px;
      background: transparent;
      overflow: hidden;
    }

    .swiper {
      width: 100%;
      padding: 40px 0;
    }

    .swiper-slide {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      cursor: pointer;
    }

    .swiper-slide:hover {
      transform: translateY(-10px);
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.8);
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .prayer-times {
      position: absolute;
      bottom: 60px;
      left: 0;
      width: 100%;
      padding: 15px;
      color: white;
      text-align: center;
    }

    .time-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 15px;
      margin-bottom: 8px;
      background: rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .time-row:last-child {
      margin-bottom: 0;
    }

    .time-row:hover {
      background: rgba(255, 255, 255, 0.4);
    }

    .time-label {
      font-family: "Playfair Display", serif;
      font-weight: 600;
      font-size: 1rem;
    }

    .time-value {
      font-weight: 700;
      font-size: 1.1rem;
      color: #4fc3f7;
    }

    .title {
      padding: 20px;
      text-align: center;
      background: rgba(0, 0, 0, 0.7);
    }

    .title span {
      font-family: "Playfair Display", serif;
      font-size: 1.4rem;
      font-weight: 600;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 1;
      border: 1px solid #9bad6b;
    }

    .swiper-pagination-bullet-active {
      background: #fff;
      width: 30px;
      border-radius: 10px;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: white;
      background: rgba(0, 0, 0, 0.5);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      transition: background 0.3s ease;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      background: rgba(0, 0, 0, 0.8);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
      font-size: 20px;
    }

    @media (max-width: 768px) {
      .prayer-header {
        margin-bottom: 5vh;
        padding: 15px;
      }

      .prayer-header h1 {
        font-size: 1.8rem;
        letter-spacing: 2px;
      }

      .countdown {
        font-size: 1.1rem;
        padding: 6px 15px;
      }

      .swiper-slide img {
        height: 250px;
      }

      .title span {
        font-size: 1.2rem;
      }

      .swiper-button-next,
      .swiper-button-prev {
        display: none;
      }

      .prayer-times {
        padding: 10px;
      }

      .time-row {
        padding: 6px 12px;
      }

      .next-prayer-badge {
        font-size: 0.8rem;
        padding: 6px 12px;
      }
    }
  </style>

  <!-- Prayer Time Header -->
  <div class="prayer-header">
    <h1>PRAYER TIME</h1>
    <div class="countdown">
      <span class="countdown-name" id="nextPrayerName">Fajr</span> in
      <span class="countdown-time" id="countdownTime">00:00:00</span>
    </div>
  </div>

  <!-- Carousel -->
  <div class="carousel-container">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div
          class="swiper-slide"
          data-prayer="Fajr"
          data-adhan="04:41"
          data-iqamah="05:15">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">4:41 AM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">5:15 AM</span>
            </div>
          </div>
          <img src="./assets/images/homepage-images/pray/dawn2.png" alt="Fajr" />
          <div class="title"><span>Fajr</span></div>
        </div>
        <div
          class="swiper-slide"
          data-prayer="Sunrise"
          data-adhan="05:58"
          data-iqamah="06:13">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">5:58 AM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">6:13 AM</span>
            </div>
          </div>
          <img
            src="./assets/images/homepage-images/pray/sunrise.png"
            alt="Sunrise" />
          <div class="title"><span>Sunrise</span></div>
        </div>
        <div
          class="swiper-slide"
          data-prayer="Dhuhr"
          data-adhan="11:59"
          data-iqamah="12:14">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">11:59 AM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">12:14 PM</span>
            </div>
          </div>
          <img src="./assets/images/homepage-images/pray/dhuhr.png" alt="Dhuhr" />
          <div class="title"><span>Dhuhr</span></div>
        </div>
        <div
          class="swiper-slide"
          data-prayer="Asr"
          data-adhan="15:17"
          data-iqamah="15:32">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">3:17 PM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">3:32 PM</span>
            </div>
          </div>
          <img src="./assets/images/homepage-images/pray/asr.png" alt="Asr" />
          <div class="title"><span>Asr</span></div>
        </div>
        <div
          class="swiper-slide"
          data-prayer="Maghrib"
          data-adhan="17:59"
          data-iqamah="18:09">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">5:59 PM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">6:09 PM</span>
            </div>
          </div>
          <img
            src="./assets/images/homepage-images/pray/maghrib2.png"
            alt="Maghrib" />
          <div class="title"><span>Maghrib</span></div>
        </div>
        <div
          class="swiper-slide"
          data-prayer="Isha"
          data-adhan="19:08"
          data-iqamah="19:23">
          <div class="prayer-times">
            <div class="time-row">
              <span class="time-label">Adhan</span>
              <span class="time-value">7:08 PM</span>
            </div>
            <div class="time-row">
              <span class="time-label">Iqamah</span>
              <span class="time-value">7:23 PM</span>
            </div>
          </div>
          <img src="./assets/images/homepage-images/pray/isha.png" alt="Isha" />
          <div class="title"><span>Isha</span></div>
        </div>
      </div>

      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    let swiper;
    let currentNextPrayerIndex = -1;

    // Initialize Swiper
    function initSwiper() {
      swiper = new Swiper(".swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        initialSlide: 2,
        speed: 600,
        loop: false,
        coverflowEffect: {
          rotate: 0,
          stretch: 0,
          depth: 300,
          modifier: 1,
          slideShadows: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 40,
          },
        },
      });

      // Click to bring card to front - FIXED VERSION
      document.querySelectorAll(".swiper-slide").forEach((slide, index) => {
        slide.addEventListener("click", function(e) {
          // Check if this is a valid click (not during drag)
          if (swiper.touchEventsData.startMoving) return;

          // Use setTimeout to ensure the click happens after any drag operations
          setTimeout(() => {
            swiper.slideTo(index);
          }, 10);
        });
      });
    }

    // Countdown to next prayer - FIXED VERSION
    function updateCountdown() {
      const prayers = [{
          name: "Fajr",
          time: "04:41",
          index: 0
        },
        {
          name: "Sunrise",
          time: "05:58",
          index: 1
        },
        {
          name: "Dhuhr",
          time: "11:59",
          index: 2
        },
        {
          name: "Asr",
          time: "15:17",
          index: 3
        },
        {
          name: "Maghrib",
          time: "17:59",
          index: 4
        },
        {
          name: "Isha",
          time: "19:08",
          index: 5
        },
      ];

      const now = new Date();
      const currentTime = now.getHours() * 60 + now.getMinutes();
      const currentSeconds = now.getSeconds();

      let nextPrayer = null;

      // Find the next prayer
      for (let prayer of prayers) {
        const [hours, minutes] = prayer.time.split(":").map(Number);
        const prayerTime = hours * 60 + minutes;

        if (prayerTime > currentTime) {
          nextPrayer = {
            ...prayer,
            totalMinutesUntil: prayerTime - currentTime,
          };
          break;
        }
      }

      // If no prayer found for today, use first prayer of next day
      if (!nextPrayer) {
        const [hours, minutes] = prayers[0].time.split(":").map(Number);
        const prayerTime = hours * 60 + minutes;
        nextPrayer = {
          name: prayers[0].name,
          index: prayers[0].index,
          totalMinutesUntil: 24 * 60 - currentTime + prayerTime,
        };
      }

      // Calculate total seconds until next prayer
      const totalSecondsUntil =
        nextPrayer.totalMinutesUntil * 60 - currentSeconds;

      // Calculate hours, minutes, seconds
      const hours = Math.floor(totalSecondsUntil / 3600);
      const minutes = Math.floor((totalSecondsUntil % 3600) / 60);
      const seconds = totalSecondsUntil % 60;

      // Update countdown display
      const countdownElement = document.getElementById("countdownTime");
      const nameElement = document.getElementById("nextPrayerName");

      countdownElement.textContent = `${hours
      .toString()
      .padStart(2, "0")}:${minutes.toString().padStart(2, "0")}:${seconds
      .toString()
      .padStart(2, "0")}`;
      nameElement.textContent = nextPrayer.name;

      // Add urgent styling when less than 1 minute remains
      if (totalSecondsUntil <= 60) {
        countdownElement.classList.add("urgent");
      } else {
        countdownElement.classList.remove("urgent");
      }

      // Update next prayer badge
      updateNextPrayerBadge(nextPrayer.index);

      // Update swiper position if next prayer changed
      if (currentNextPrayerIndex !== nextPrayer.index) {
        currentNextPrayerIndex = nextPrayer.index;
        if (swiper && !swiper.destroyed) {
          swiper.slideTo(nextPrayer.index);
        }
      }
    }

    // Update next prayer badge
    function updateNextPrayerBadge(nextPrayerIndex) {
      // Remove all existing badges
      document.querySelectorAll(".next-prayer-badge").forEach((badge) => {
        badge.remove();
      });

      // Add badge to the correct next prayer card
      const slides = document.querySelectorAll(".swiper-slide");
      if (slides[nextPrayerIndex]) {
        const badge = document.createElement("div");
        badge.className = "next-prayer-badge";
        badge.textContent = "Next to come";
        slides[nextPrayerIndex].appendChild(badge);
      }
    }

    // Initialize
    document.addEventListener("DOMContentLoaded", function() {
      initSwiper();
      updateCountdown(); // Initial call
      setInterval(updateCountdown, 1000); // Update every second
    });
  </script>