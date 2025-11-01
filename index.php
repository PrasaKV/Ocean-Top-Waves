<?php require_once 'templates/header.php'; ?>

<!-- ==================== HERO CAROUSEL ==================== -->
<section class="hero-carousel-container">
  <div class="carousel-wrapper">
    <div class="carousel-slides">
      <div class="carousel-loading">
        <div class="loading-spinner"></div>
        <p>Riding the waves to you...</p>
      </div>
      <!-- Slides are dynamically loaded by script.js -->
    </div>

    <div class="carousel-controls">
      <button class="carousel-btn carousel-prev"><i class="fas fa-chevron-left"></i></button>
      <button class="carousel-btn carousel-next"><i class="fas fa-chevron-right"></i></button>
    </div>

    <div class="carousel-indicators">
      <!-- Indicators are dynamically loaded by script.js -->
    </div>
  </div>
  <a href="#about-us" class="scroll-indicator">
    <div class="scroll-mouse">
      <div class="scroll-wheel"></div>
    </div>
    <span>Scroll Down</span>
  </a>
</section>

<main class="main-content">
  <!-- ==================== ABOUT US SECTION ==================== -->
  <section id="about-us" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Ride the Waves of Paradise</h2>
      </div>
      <p class="about-us-text animate-on-scroll">
        Welcome to Ocean Top Waves, your premier surfing destination on the sun-kissed shores of Sri Lanka. Founded by passionate local surfers, our mission is to share the exhilarating joy of riding waves with everyone. We offer a safe, fun, and unforgettable experience, creating memories that last a lifetime, whether you're a beginner or a pro.
      </p>
    </div>
  </section>

  <!-- ==================== SURFING LESSONS SECTION ==================== -->
  <section id="surfing-lessons" class="content-section gray-bg">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Your Surfing Adventure Awaits</h2>
      </div>
      <div class="packages-container">
        <div class="loading-placeholder">
          <div class="loading-spinner"></div>
          <p>Loading surf packages...</p>
        </div>
        <!-- Packages are dynamically loaded by script.js -->
      </div>
    </div>
  </section>

  <!-- ==================== EXPLORE SRI LANKA (TOURS) ==================== -->
  <section id="explore" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Discover Sri Lanka With Us</h2>
      </div>
      <div class="explore-container">
        <!-- Tour Card 1: Wildlife Safari -->
        <div class="explore-card animate-on-scroll">
          <div class="explore-image">
            <img src="https://images.unsplash.com/photo-1555294520-2ceb28a988e8?q=80&w=2070&auto=format&fit=crop" alt="Wildlife Safari in Sri Lanka" loading="lazy">
          </div>
          <div class="explore-overlay">
            <i class="fas fa-paw"></i>
            <h3>Wildlife Safaris</h3>
            <p>Experience the thrill of a safari in Sri Lanka's famous national parks. Spot leopards, elephants, and exotic birds in their natural habitat.</p>
            <a href="#" class="btn whatsapp-link" data-text="Hi! I'm interested in your Wildlife Safari tours.">Enquire Now</a>
          </div>
        </div>
        <!-- Tour Card 2: Tea Plantations -->
        <div class="explore-card animate-on-scroll">
          <div class="explore-image">
            <img src="https://images.unsplash.com/photo-1593693397623-11f2a011a0a4?q=80&w=1932&auto=format&fit=crop" alt="Lush Tea Plantations in Sri Lanka" loading="lazy">
          </div>
          <div class="explore-overlay">
            <i class="fas fa-leaf"></i>
            <h3>Lush Tea Plantations</h3>
            <p>Journey through the rolling green hills of Sri Lanka's tea country. Visit a plantation, learn about the tea-making process, and taste world-famous Ceylon tea.</p>
            <a href="#" class="btn whatsapp-link" data-text="Hi! I'm interested in your Tea Plantation tours.">Enquire Now</a>
          </div>
        </div>
        <!-- Tour Card 3: Ancient Temples -->
        <div class="explore-card animate-on-scroll">
          <div class="explore-image">
            <img src="https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=2076&auto=format&fit=crop" alt="Ancient Temples of Sri Lanka" loading="lazy">
          </div>
          <div class="explore-overlay">
            <i class="fas fa-gopuram"></i>
            <h3>Ancient Temple Tours</h3>
            <p>Uncover the rich history and spiritual heritage of Sri Lanka by visiting ancient temples and sacred sites that have stood for centuries.</p>
            <a href="#" class="btn whatsapp-link" data-text="Hi! I'm interested in your Ancient Temple tours.">Enquire Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== OTHER SERVICES SECTION ==================== -->
  <section id="services" class="content-section gray-bg">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">More Than Just Surfing</h2>
      </div>
      <div class="services-container">
        <!-- Service Card 1: Souvenir Shop -->
        <div class="service-card animate-on-scroll">
          <div class="service-image">
            <img src="https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?q=80&w=1974&auto=format&fit=crop" alt="Souvenir Shop" loading="lazy">
            <div class="service-overlay"><i class="fas fa-shopping-bag"></i></div>
          </div>
          <div class="service-content">
            <h3>Our Little Shop of Treasures</h3>
            <p>Find the perfect handcrafted souvenir to remember your Sri Lankan adventure. We feature unique items from local artisans.</p>
            <a href="gallery.php#shop" class="btn">Explore the Shop</a>
          </div>
        </div>
        <!-- Service Card 2: Transport -->
        <div class="service-card animate-on-scroll">
          <div class="service-image">
            <img src="https://images.unsplash.com/photo-1517495331395-94675510a2e7?q=80&w=1964&auto=format&fit=crop" alt="Transport Service" loading="lazy">
            <div class="service-overlay"><i class="fas fa-car"></i></div>
          </div>
          <div class="service-content">
            <h3>Seamless Island Transport</h3>
            <p>Reliable, safe, and friendly transport services to get you anywhere on the island. Airport pickups, tours, and local trips available.</p>
            <a href="#" class="btn whatsapp-link" data-text="Hi! I'm interested in your transport services.">Arrange a Ride</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== TESTIMONIALS SECTION ==================== -->
  <section id="testimonials" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Waves of Praise</h2>
      </div>
      <div class="testimonials-container">
        <div class="loading-placeholder">
          <div class="loading-spinner"></div>
          <p>Loading testimonials...</p>
        </div>
        <!-- Testimonials are dynamically loaded by script.js -->
      </div>
    </div>
  </section>
</main>

<?php require_once 'templates/footer.php'; ?>