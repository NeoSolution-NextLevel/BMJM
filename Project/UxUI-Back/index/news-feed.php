<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  .news-section {
    text-align: center;
    max-width: 100%;
    margin: 0 ;
  }

  .news-section h2 {
      font-family: 'Kadwa', serif;
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    margin-bottom: 8px;
    margin-top: 5vh;
  }

  .news-section p {
    font-family: 'Kadwa', serif;
    color: #333;
    margin-bottom: 30px;
    font-size: clamp(0.9rem, 2vw, 1.1rem);
  }

  .news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    column-gap: 0;
    width: 100%;
    margin: 0;
  }

  .news-item {
    position: relative;
    height: 100%;
    overflow: hidden;
    
    aspect-ratio: 4/3;
    cursor: pointer;
  }

  .news-item img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .news-item:hover img {
    transform: scale(1.05);
  }

  /* Overlay hidden initially */
  .news-item .overlay-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    opacity: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.4s ease;
    padding: 25px;
    box-sizing: border-box;
    text-align: center;
  }

  /* Show overlay on hover */
  .news-item:hover .overlay-content {
    opacity: 1;
  }

  /* Show overlay on touch devices when active */
  .news-item.active .overlay-content {
    opacity: 1;
  }

  .overlay-content h3 {
    font-family: 'Playfair Display', serif;
    margin-top: 15px;
    font-size: clamp(1.2rem, 3vw, 1.8rem);
    line-height: 1.3;
  }

  .overlay-content p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.85rem, 2vw, 1rem);
    margin-top: 12px;
    text-align: center;
    color: #eaeaea;
    line-height: 1.5;
  }

  .overlay-content button {
    background-color: #d4b060;
    border: none;
    color: white;
    padding: 12px 28px;
    border-radius: 30px;
    font-size: clamp(0.9rem, 2vw, 1.1rem);
    font-family: 'Inter', sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 15px;
    font-weight: 500;
  }

  .overlay-content button:hover {
    background-color: #c3a04e;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }

  

  /* Modal Styles */
  .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-sizing: border-box;
  }

  .modal.active {
    display: flex;
  }

  .modal-content {
    background-color: white;
    width: 100%;
    max-width: 900px;
    max-height: 95vh;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    animation: modalAppear 0.3s ease-out;
  }

  @keyframes modalAppear {
    from {
      opacity: 0;
      transform: scale(0.9) translateY(20px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  .modal-header {
    padding: 25px 30px 20px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #eaeaea;
    position: relative;
    flex-shrink: 0;
  }

  .modal-header h2 {
    font-family: 'Playfair Display', serif;
    color: #333;
    margin: 0;
    font-size: clamp(1.5rem, 4vw, 2rem);
    line-height: 1.2;
  }

  .close-modal {
    position: absolute;
    top: 20px;
    right: 25px;
    font-size: 2rem;
    cursor: pointer;
    color: #777;
    background: none;
    border: none;
    font-family: 'Inter', sans-serif;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
  }

  .close-modal:hover {
    color: #333;
    background-color: rgba(0,0,0,0.05);
  }

  .modal-body {
    padding: 30px;
    overflow-y: auto;
    flex-grow: 1;
  }

  .modal-image {
    width: 100%;
    height: auto;
    max-height: 800px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 25px;
  }

  .modal-body h3 {
    font-family: 'Playfair Display', serif;
    margin-bottom: 20px;
    color: #333;
    font-size: clamp(1.3rem, 3vw, 1.8rem);
  }

  .modal-body p {
    font-family: 'Inter', sans-serif;
    line-height: 1.7;
    margin-bottom: 20px;
    color: #555;
    font-size: clamp(0.95rem, 2vw, 1.1rem);
  }

  /* Responsive adjustments */
  
  /* Large screens: 3 columns */
  @media (min-width: 1025px) {
    .news-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  
  /* Medium screens: 3 columns with adjusted overlay */
  @media (min-width: 601px) and (max-width: 1024px) {
    .news-grid {
      grid-template-columns: repeat(3, 1fr);
      
    }
    
    .news-item {
      aspect-ratio: 3/2;
    }
    
    .news-item .overlay-content {
      padding: 20px;
    }
    
    .overlay-content h3 {
/*      font-size: clamp(1.1rem, 2.5vw, 1.5rem);
      margin-top: 10px;*/
      display: none;
    }
    
    .overlay-content p {
/*      font-size: clamp(0.8rem, 1.8vw, 0.95rem);
      margin-top: 8px;*/
      display: none;
    }
    
    .overlay-content button {
      padding: 10px 22px;
      font-size: clamp(0.85rem, 1.8vw, 1rem);
      margin-top: 12px;
    }
  }

/*   Small tablets: 2 columns 
  @media (min-width: 601px) and (max-width: 767px) {
    .news-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    
    .news-item {
      aspect-ratio: 3/2;
    }
  }*/

  /* Mobile: 1 column */
  @media (max-width: 600px) {
    .news-section {
      padding: 20px 15px;
    }
    
    .news-grid {
      grid-template-columns: 1fr;
      gap: 15px;
    }
    .bottom{
        margin-top: 15px;
    }
    
    .news-item {
      aspect-ratio: 16/9;
    }
    
    .modal {
      padding: 15px;
    }
    
    .modal-content {
      max-height: 90vh;
    }
    
    .modal-header {
      padding: 20px 25px 15px;
    }
    
    .modal-body {
      padding: 20px;
    }
    
    .close-modal {
      top: 15px;
      right: 20px;
      width: 36px;
      height: 36px;
    }
  }

  @media (max-width: 480px) {
    .news-section {
      padding: 15px 10px;
    }
    
    .news-grid {
      gap: 12px;
    }
    .bottom{
        margin-top: 12px;
    }
    
    .overlay-content {
      padding: 20px;
    }
    
    .modal {
      padding: 10px;
    }
    
    .modal-header {
      padding: 18px 20px 15px;
    }
    
    .modal-body {
      padding: 18px;
    }
    
    .close-modal {
      top: 12px;
      right: 15px;
    }
  }

  /* Touch device specific styles */
  @media (hover: none) and (pointer: coarse) {
    .news-item .overlay-content {
      opacity: 0;
    }
    
    .news-item.active .overlay-content {
      opacity: 1;
    }
    
    .news-item:hover img {
      transform: none;
    }
  }
</style>

 <!-- <section class="news-section">
  <h2>NEWS FEED</h2>
  <p>Your window to masjid updates and events. Tap a card to explore more</p>

  <div class="news-grid">

    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img1.jpg" alt="Kaaba">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal1">View More</button>
        <h3>Kaaba Renovation</h3>
        <p>Latest updates on the ongoing renovation work at the Kaaba.</p>
      </div>
    </div>


    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img2.jpg" alt="Mosque Prayer">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal2">View More</button>
        <h3>Vaxjo Mosque Prayer</h3>
        <p>Special prayer arrangements at Vaxjo Mosque for the upcoming festival.</p>
      </div>
    </div>

    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img3.jpg" alt="Mosque Building">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal3">View More</button>
        <h3>Mosque Construction</h3>
        <p>Progress on the new community mosque construction project.</p>
      </div>
    </div>
  </div>

  <div class="news-grid bottom">
 
    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img4.jpg" alt="Man reading Quran">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal4">View More</button>
        <h3>Quran Study Group</h3>
        <p>New Quran study group starting this month for all ages.</p>
      </div>
    </div>
    
    
    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img5.jpg" alt="Congregational prayer">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal5">View More</button>
        <h3>Friday Congregation</h3>
        <p>Important updates regarding Friday prayer arrangements.</p>
      </div>
    </div>

    <div class="news-item">
      <img src="./assets/images/homepage-images/news-feed/news-img6.jpg" alt="Prayer mat">
      <div class="overlay-content">
        <button class="view-more-btn" data-modal="modal6">View More</button>
        <h3>Community Donations</h3>
        <p>How your donations are helping the local community.</p>
      </div>
    </div>
  </div>
</section>


<div class="modal" id="modal1">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Kaaba Renovation</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img1.jpg" alt="Kaaba" class="modal-image">
      <h3>Latest Updates on Kaaba Renovation</h3>
      <p>The ongoing renovation work at the Kaaba is progressing smoothly according to schedule. The project, which began earlier this year, aims to preserve this holy site for future generations while maintaining its historical integrity.</p>
      <p>Specialized craftsmen from around the Islamic world are working together to ensure that traditional techniques are used in the restoration process. The Kiswa (the black cloth covering the Kaaba) has been carefully removed and preserved during the renovation.</p>
      <p>Authorities have assured that pilgrims will not be significantly affected by the renovation work, with special arrangements made to ensure smooth flow of visitors during this period. The project is expected to be completed before the next Hajj season.</p>
      <p>Regular updates will be provided as the work progresses. The renovation committee has established a dedicated communication channel for any queries related to the project.</p>
    </div>
  </div>
</div>


<div class="modal" id="modal2">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Vaxjo Mosque Prayer</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img2.jpg" alt="Mosque Prayer" class="modal-image">
      <h3>Special Prayer Arrangements</h3>
      <p>Vaxjo Mosque is pleased to announce special prayer arrangements for the upcoming Eid festival. The mosque will host multiple prayer sessions to accommodate all community members while maintaining safety protocols.</p>
      <p>The first prayer will begin at 7:00 AM, followed by additional sessions at 8:30 AM and 10:00 AM. Each session will be limited to 200 attendees to ensure comfortable spacing. Pre-registration is required through our online portal.</p>
      <p>Special arrangements have been made for families with children, with a dedicated family section available. The mosque will also provide live streaming of the prayers for those unable to attend in person.</p>
      <p>Following the prayers, light refreshments will be served in the community hall. We encourage all community members to join us in celebrating this blessed occasion together.</p>
    </div>
  </div>
</div>

<div class="modal" id="modal3">
  <div class="modal-content">
    <div class="modal-header">
      <h2>New Mosque Construction</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img3.jpg" alt="Mosque Building" class="modal-image">
      <h3>Community Mosque Project Update</h3>
      <p>The construction of our new community mosque is progressing well, with the foundation work now complete. The project, funded entirely by community donations, represents a significant milestone for local Muslims.</p>
      <p>The new mosque will feature a main prayer hall capable of accommodating 500 worshippers, separate facilities for men and women, classrooms for Islamic education, and a community center for events and gatherings.</p>
      <p>Construction is expected to be completed within the next 12 months, with the official opening scheduled for next year's Ramadan. The project team is working diligently to ensure the mosque meets all community needs while adhering to traditional Islamic architecture.</p>
      <p>We extend our gratitude to all donors and volunteers who have made this project possible. Additional fundraising events are planned to complete the interior furnishings and landscaping.</p>
    </div>
  </div>
</div>


<div class="modal" id="modal4">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Quran Study Group</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img4.jpg" alt="Man reading Quran" class="modal-image">
      <h3>New Quran Study Opportunities</h3>
      <p>We are excited to announce the launch of new Quran study groups catering to different age groups and proficiency levels. These groups will provide structured learning in a supportive community environment.</p>
      <p>Classes will be available for children (ages 6-12), youth (ages 13-18), and adults. Each group will focus on appropriate learning objectives, from basic Arabic reading to advanced Tajweed and Tafsir (Quranic interpretation).</p>
      <p>All classes will be taught by qualified instructors with expertise in Quranic studies. Sessions will be held weekly, with flexible timing options to accommodate different schedules. Registration is now open through the mosque office.</p>
      <p>Special emphasis will be placed on understanding the meanings and practical applications of Quranic teachings in daily life. We believe these study groups will strengthen our community's connection with the Quran.</p>
    </div>
  </div>
</div>


<div class="modal" id="modal5">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Friday Congregation</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img5.jpg" alt="Congregational prayer" class="modal-image">
      <h3>Friday Prayer Updates</h3>
      <p>Important updates regarding our Friday prayer arrangements. To better serve our growing community, we have implemented a new system for Jumu'ah prayers.</p>
      <p>We will now hold two Friday prayers to accommodate all worshippers. The first prayer will begin at 12:30 PM with the Khutbah (sermon) starting at 12:15 PM. The second prayer will be at 1:30 PM with the Khutbah at 1:15 PM.</p>
      <p>The main prayer hall will be reserved for the first congregation, while the community hall will host the second congregation. Both locations will have audio systems to ensure everyone can hear the Khutbah clearly.</p>
      <p>We encourage community members to arrive early to secure parking and seating. For those unable to attend in person, the Khutbah will be live-streamed on our website and social media channels.</p>
    </div>
  </div>
</div>

<div class="modal" id="modal6">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Community Donations</h2>
      <button class="close-modal">&times;</button>
    </div>
    <div class="modal-body">
      <img src="./assets/images/homepage-images/news-feed/news-img6.jpg" alt="Prayer mat" class="modal-image">
      <h3>Impact of Your Generosity</h3>
      <p>We are pleased to share how your generous donations are making a difference in our community. Your contributions have supported various initiatives that benefit both mosque activities and wider community welfare.</p>
      <p>Recent donations have enabled us to upgrade our audio system for better prayer experiences, provide financial assistance to families in need, and support educational programs for children and new Muslims.</p>
      <p>A significant portion of donations has been allocated to our food bank program, which now serves over 100 families monthly. Additionally, your support has helped maintain mosque facilities and cover operational costs.</p>
      <p>We extend our heartfelt gratitude to all donors. Transparency is important to us, and detailed reports on fund utilization are available upon request. Your continued support ensures we can keep serving the community effectively.</p>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const viewMoreBtns = document.querySelectorAll('.view-more-btn');
    const closeModalBtns = document.querySelectorAll('.close-modal');
    const newsItems = document.querySelectorAll('.news-item');
    
    // Check if device is touch-enabled
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    
    // Handle touch interactions for news items
    if (isTouchDevice) {
      newsItems.forEach(item => {
        item.addEventListener('click', function(e) {
          // Toggle active class for overlay visibility
          this.classList.toggle('active');
          
          // If clicking the view more button, don't toggle overlay
          if (e.target.classList.contains('view-more-btn')) {
            this.classList.remove('active');
          }
        });
      });
      
      // Close overlay when clicking outside on touch devices
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.news-item')) {
          newsItems.forEach(item => {
            item.classList.remove('active');
          });
        }
      });
    }
    
    // Open modal when any "View More" is clicked
    viewMoreBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent triggering news-item click
        const modalId = this.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
      });
    });
    
    // Close modal when any X is clicked
    closeModalBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
      });
    });
    
    // Close modal when clicking outside the content
    document.querySelectorAll('.modal').forEach(modal => {
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.classList.remove('active');
          document.body.style.overflow = ''; // Restore scrolling
        }
      });
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(modal => {
          modal.classList.remove('active');
          document.body.style.overflow = ''; // Restore scrolling
        });
      }
    });
  });
</script> 


 -->







 <section class="news-section">
  <h2>NEWS FEED</h2>
  <p>Your window to masjid updates and events. Tap a card to explore more</p>

  <div class="news-grid"></div>

  <div class="news-grid bottom"></div>
</section>