<?php require_once 'templates/header.php'; ?>

<!-- Hero Carousel -->
<section class="hero-carousel">
  <div class="slide">
    <!-- Items are dynamically loaded by script.js via an API call -->
    <div class="loading-placeholder">Loading amazing waves...</div>
  </div>
  <div class="button">
    <button class="prev">◁</button>
    <button class="next">▷</button>
  </div>
</section>

<main>
  <!-- Surfing Lessons Section -->
  <section id="surfing-lessons" class="content-section">
    <h2>Your Surfing Adventure Awaits</h2>
    <div class="packages-container">
      <!-- Packages are dynamically loaded by script.js via an API call -->
      <div class="loading-placeholder">Loading packages...</div>
    </div>
  </section>

  <!-- Other Services Section -->
  <section id="services" class="content-section gray-bg">
    <h2>More Than Just Surfing</h2>
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
        <a href="https://wa.me/1234567890?text=Hi!%20I'm%20interested%20in%20your%20transport%20services." target="_blank" class="btn">Arrange a Ride</a>
      </div>
    </div>
  </section>
</main>

<script src="assets/js/script.js"></script>

<?php require_once 'templates/footer.php'; ?>