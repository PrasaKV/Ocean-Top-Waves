<?php require_once 'templates/header.php'; ?>

<!-- CORRECTED LightGallery CSS links with valid integrity hashes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css" integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css" integrity="sha512-GRxDpj/bx6/I4y6h2LE5rbGaqRcbTu4dYhaTewlS8Nh9hm/akYprvOTZD7GR+FRCALiKfe8u1gjvWEEGEtoR6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css" integrity="sha512-vIrTyLijDDcUJrQGs1jduUCSVa3+A2DaWpVfNyj4lmXkqURVQJ8LL62nebC388QV3P4yFBSt/ViDX8LRW0U6uw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
      <div id="shop-gallery-grid" class="gallery-grid">
        <div class="loading-placeholder">
          <div class="loading-spinner"></div>
          <p>Loading shop images...</p>
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
      <div id="lifestyle-gallery-grid" class="gallery-grid">
        <div class="loading-placeholder">
          <div class="loading-spinner"></div>
          <p>Loading lifestyle images...</p>
        </div>
      </div>
    </div>
  </section>

  <style>
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
      column-count: 3;
      column-gap: 1rem;
    }

    .gallery-item {
      margin-bottom: 1rem;
      break-inside: avoid;
      position: relative;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: var(--shadow-sm);
      display: block;
    }

    .gallery-item img {
      width: 100%;
      height: auto;
      display: block;
      transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
      transform: scale(1.1);
    }

    .gallery-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 50%);
      display: flex;
      align-items: flex-end;
      justify-content: center;
      color: white;
      opacity: 0;
      transition: opacity 0.4s ease;
      padding: 1rem;
      text-align: center;
    }

    .gallery-overlay .overlay-text {
      transform: translateY(20px);
      transition: transform 0.4s ease;
      font-weight: 600;
    }

    .gallery-item:hover .overlay-overlay {
      opacity: 1;
    }

    .gallery-item:hover .overlay-text {
      transform: translateY(0);
    }

    @media (max-width: 992px) {
      .gallery-grid {
        column-count: 2;
      }
    }

    @media (max-width: 576px) {
      .gallery-grid {
        column-count: 1;
      }
    }
  </style>

</main>

<!-- CORRECTED LightGallery JS links with valid integrity hashes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" integrity="sha512-jEJ0OA9fwz5wUn6rVfGhAXiiCSGrjYCwtQRUwI/wRGEuWRZxrnxoeDoNc+Pnhx8qwKVHs2BRQrVR9RE6T4UHBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js" integrity="sha512-VBbe8aA3uiK90EUKJnZ4iEs0lKXRhzaAXL8CIHWYReUwULzxkOSxlNixn41OLdX0R1KNP23/s76YPyeRhE6P+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/zoom/lg-zoom.min.js" integrity="sha512-BLW2Jrofiqm6m7JhkQDIh2olT0EBI58+hIL/AXWvo8gOXKmsNlU6myJyEkTy6rOAAZjn0032FRk8sl9RgXPYIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Custom JavaScript for this page only -->
<script>
  document.addEventListener('DOMContentLoaded', () => {

    const shopGalleryGrid = document.getElementById('shop-gallery-grid');
    const lifestyleGalleryGrid = document.getElementById('lifestyle-gallery-grid');

    // This function now lives inside this page, making it self-contained
    const initializeScrollAnimations = () => {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.1
      });
      document.querySelectorAll(".animate-on-scroll").forEach(el => observer.observe(el));
    };

    // Initial call for elements already on the page
    initializeScrollAnimations();

    const createGalleryItemHTML = (image) => `
        <a href="${image.image_url}" class="gallery-item animate-on-scroll" data-sub-html="<h4>${image.alt_text}</h4>">
            <img src="${image.image_url}" alt="${image.alt_text}" loading="lazy">
            <div class="gallery-overlay"><span class="overlay-text">${image.alt_text}</span></div>
        </a>`;

    fetch('api.php?action=get_gallery')
      .then(response => response.ok ? response.json() : Promise.reject('Network response was not ok'))
      .then(images => {
        const shopImages = images.filter(img => img.category === 'shop');
        const lifestyleImages = images.filter(img => img.category === 'lifestyle');

        shopGalleryGrid.innerHTML = shopImages.length > 0 ? shopImages.map(createGalleryItemHTML).join('') : '<p>No images found in this category yet.</p>';
        lifestyleGalleryGrid.innerHTML = lifestyleImages.length > 0 ? lifestyleImages.map(createGalleryItemHTML).join('') : '<p>No images found in this category yet.</p>';

        // Initialize LightGallery if the library loaded correctly
        if (typeof lightGallery !== 'undefined') {
          if (shopImages.length > 0) {
            lightGallery(shopGalleryGrid, {
              plugins: [lgZoom, lgThumbnail],
              speed: 500,
              thumbnail: true,
              selector: '.gallery-item'
            });
          }
          if (lifestyleImages.length > 0) {
            lightGallery(lifestyleGalleryGrid, {
              plugins: [lgZoom, lgThumbnail],
              speed: 500,
              thumbnail: true,
              selector: '.gallery-item'
            });
          }
        } else {
          console.error("lightGallery library was not loaded. Image viewer will not work.");
        }

        // Re-run animations for the new dynamic content
        initializeScrollAnimations();
      })
      .catch(error => {
        console.error('Error fetching gallery images:', error);
        const errorMsg = '<p>Could not load gallery images. Please try again later.</p>';
        shopGalleryGrid.innerHTML = errorMsg;
        lifestyleGalleryGrid.innerHTML = errorMsg;
      });
  });
</script>

<?php require_once 'templates/footer.php'; ?>