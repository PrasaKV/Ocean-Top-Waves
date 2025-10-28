<?php require_once 'templates/header.php'; ?>

<main class="gallery-main">
  <section class="gallery-section">
    <h1>Our Gallery</h1>
    <div class="filter-buttons">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="surfing">Surfing</button>
      <button class="filter-btn" data-filter="tours">Tours</button>
      <button class="filter-btn" data-filter="shop">Shop</button>
    </div>
    <div class="gallery-grid">
      <div class="loading-placeholder">Loading images...</div>
    </div>
  </section>
</main>

<!-- Lightbox/Modal for enlarged image view -->
<div id="lightbox" class="lightbox">
  <span class="lightbox-close">&times;</span>
  <img class="lightbox-content" id="lightbox-img">
  <div id="lightbox-caption"></div>
</div>

<link rel="stylesheet" href="assets/css/gallery.css">
<script src="assets/js/gallery.js"></script>

<?php require_once 'templates/footer.php'; ?>