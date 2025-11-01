<?php require_once 'templates/header.php'; ?>

<main class="main-content">
  <!-- ==================== GALLERY HEADER ==================== -->
  <section class="content-section gallery-header-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Our Gallery</h2>
      </div>
      <p class="about-us-text animate-on-scroll">
        A glimpse into the Ocean Top Waves experience. From thrilling surf sessions to the beautiful crafts in our local shop, explore the moments that make us special.
      </p>
    </div>
  </section>

  <!-- ==================== SOUVENIR SHOP SECTION ==================== -->
  <section id="shop" class="content-section gray-bg">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Our Little Shop of Treasures</h2>
      </div>
      <div class="gallery-grid">
        <!-- Image 1 -->
        <div class="gallery-item animate-on-scroll">
          <a href="https://images.unsplash.com/photo-1555864327-7201293e39c4?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1555864327-7201293e39c4?q=80&w=1974&auto=format&fit=crop" alt="Handcrafted Souvenirs" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 2 -->
        <div class="gallery-item animate-on-scroll">
          <a href="https://images.unsplash.com/photo-1610996881295-560595304193?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1610996881295-560595304193?q=80&w=1974&auto=format&fit=crop" alt="Local Crafts" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 3 -->
        <div class="gallery-item animate-on-scroll wide">
          <a href="https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?q=80&w=1974&auto=format&fit=crop" alt="Souvenir Shop Interior" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 4 -->
        <div class="gallery-item animate-on-scroll">
          <a href="https://images.unsplash.com/photo-1563299796-03f371a36136?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1563299796-03f371a36136?q=80&w=1974&auto=format&fit=crop" alt="Beachwear and Accessories" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ==================== SURFING & LIFESTYLE GALLERY ==================== -->
  <section id="lifestyle" class="content-section">
    <div class="wrapper">
      <div class="section-header">
        <h2 class="animate-on-scroll">Life on the Waves</h2>
      </div>
      <div class="gallery-grid">
        <!-- Image 5 -->
        <div class="gallery-item animate-on-scroll tall">
          <a href="https://images.unsplash.com/photo-1531722569936-825d3dd91b15?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1531722569936-825d3dd91b15?q=80&w=1974&auto=format&fit=crop" alt="Surfer catching a wave" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 6 -->
        <div class="gallery-item animate-on-scroll">
          <a href="https://images.unsplash.com/photo-1502680390409-791726522a28?q=80&w=2070&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1502680390409-791726522a28?q=80&w=2070&auto=format&fit=crop" alt="Group surf lesson" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 7 -->
        <div class="gallery-item animate-on-scroll">
          <a href="https://images.unsplash.com/photo-1510479172492-38ce46a85043?q=80&w=2070&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1510479172492-38ce46a85043?q=80&w=2070&auto=format&fit=crop" alt="Sunset at the beach" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
        <!-- Image 8 -->
        <div class="gallery-item animate-on-scroll wide">
          <a href="https://images.unsplash.com/photo-1528460033278-a6ba57020470?q=80&w=1974&auto=format&fit=crop" class="gallery-link">
            <img src="https://images.unsplash.com/photo-1528460033278-a6ba57020470?q=80&w=1974&auto=format&fit=crop" alt="Relaxing on the beach" loading="lazy">
            <div class="gallery-overlay"><i class="fas fa-search-plus"></i></div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <style>
    /* Additional styles for gallery page */
    .gallery-header-section {
      background: var(--gradient-primary);
      color: white;
      padding: 4rem 0;
    }

    .gallery-header-section .section-header h2 {
      color: white;
    }

    .gallery-header-section .section-header h2::after {
      background: white;
    }

    .gallery-header-section p {
      color: rgba(255, 255, 255, 0.9);
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      grid-auto-rows: 250px;
      grid-auto-flow: dense;
      gap: 1rem;
    }

    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: var(--shadow-sm);
    }

    .gallery-item.wide {
      grid-column: auto / span 2;
    }

    .gallery-item.tall {
      grid-row: auto / span 2;
    }

    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: all 0.4s ease;
    }

    .gallery-item:hover img {
      transform: scale(1.1);
    }

    .gallery-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2rem;
      opacity: 0;
      transition: opacity 0.4s ease;
    }

    .gallery-item:hover .gallery-overlay {
      opacity: 1;
    }

    @media (max-width: 768px) {

      .gallery-item.wide,
      .gallery-item.tall {
        grid-column: auto;
        grid-row: auto;
      }
    }
  </style>

</main>

<?php require_once 'templates/footer.php'; ?>