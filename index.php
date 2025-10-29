<?php require_once 'templates/header.php'; ?>

<!-- Hero Carousel -->
<div class="container">
  <div class="slide">
    <!-- Items are dynamically loaded by script.js via an API call -->
  </div>
  <div class="button">
    <button class="prev">◁</button>
    <button class="next">▷</button>
  </div>
</div>

<main class="main-content">
  <!-- About Us Section -->
  <section id="about-us" class="content-section animate-on-scroll">
    <div class="wrapper">
      <div class="section-header">
        <h2>About Ocean Top Waves</h2>
      </div>
      <p class="about-us-text">
        Welcome to Ocean Top Waves, your premier destination for learning to surf in a tropical paradise. Founded by a group of passionate surfers, our mission is to share the exhilarating experience of riding the waves with everyone, from absolute beginners to seasoned pros. We believe in safety, fun, and creating memories that last a lifetime.
      </p>
    </div>
  </section>

  <!-- Surfing Lessons Section -->
  <section id="surfing-lessons" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2>Your Surfing Adventure Awaits</h2>
      </div>
      <div class="packages-container">
        <!-- Packages are dynamically loaded by script.js via an API call -->
        <div class="loading-placeholder">Loading packages...</div>
      </div>
    </div>
  </section>

  <!-- Other Services Section -->
  <section id="services" class="content-section gray-bg">
    <div class="wrapper">
      <div class="section-header">
        <h2>More Than Just Surfing</h2>
      </div>
      <div class="services-container">
        <div class="service-card animate-on-scroll">
          <img src="https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?q=80&w=1974&auto=format&fit=crop" alt="Souvenir Shop" loading="lazy">
          <h3>Our Little Shop of Treasures</h3>
          <p>Find the perfect souvenir to remember your trip.</p>
          <a href="gallery.php#shop" class="btn">Explore the Shop</a>
        </div>
        <div class="service-card animate-on-scroll">
          <img src="https://images.unsplash.com/photo-1517495331395-94675510a2e7?q=80&w=1964&auto=format&fit=crop" alt="Transport Service" loading="lazy">
          <h3>Seamless Island Transport</h3>
          <p>Reliable and friendly transport services to get you where you need to go.</p>
          <a href="#" class="btn whatsapp-link" data-text="Hi! I'm interested in your transport services." target="_blank">Arrange a Ride</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Explore Sri Lanka Section -->
  <section id="explore" class="content-section gray-bg">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Explore Sri Lanka</h2>
      </div>
      <div class="explore-container">
        <div class="explore-card animate-on-scroll">
          <img src="https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=2076&auto=format&fit=crop" alt="Ancient Temples" loading="lazy">
          <h3>Ancient Temples</h3>
        </div>
        <div class="explore-card animate-on-scroll">
          <img src="https://images.unsplash.com/photo-1593693397623-11f2a011a0a4?q=80&w=1932&auto=format&fit=crop" alt="Lush Tea Plantations" loading="lazy">
          <h3>Lush Tea Plantations</h3>
        </div>
        <div class="explore-card animate-on-scroll">
          <img src="https://images.unsplash.com/photo-1555294520-2ceb28a988e8?q=80&w=2070&auto=format&fit=crop" alt="Wildlife Safaris" loading="lazy">
          <h3>Wildlife Safaris</h3>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">What Our Customers Say</h2>
      </div>
      <div class="testimonials-container">
        <!-- Testimonials are dynamically loaded by script.js via an API call -->
        <div class="loading-placeholder">Loading testimonials...</div>
      </div>
    </div>
  </section>
</main>

<script src="assets/js/script.js"></script>

<?php require_once 'templates/footer.php'; ?>
