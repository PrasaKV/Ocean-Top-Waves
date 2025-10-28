<?php
// This auth-check must be the very first thing on the page
require_once 'includes/auth-check.php';

// Now, include layout files
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>

<main class="main-content">
  <!-- Dashboard Panel -->
  <section id="dashboard" class="content-panel active">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Select a section from the sidebar to manage your website's content.</p>
  </section>

  <!-- Carousel Management Panel (Future implementation) -->
  <section id="carousel" class="content-panel">
    <h2>Manage Carousel</h2>
    <p>This feature is under development. You can manage carousel slides directly in the database for now.</p>
  </section>

  <!-- Surfing Packages Panel -->
  <section id="packages" class="content-panel">
    <h2>Manage Surfing Packages</h2>
    <div id="packages-list">
      <p>Loading packages...</p>
    </div>
    <hr>
    <h3>Add / Edit Package</h3>
    <form id="package-form">
      <input type="hidden" id="package-id">
      <div class="form-group">
        <label for="package-name">Package Name</label>
        <input type="text" id="package-name" required>
      </div>
      <div class="form-group">
        <label for="package-price">Price</label>
        <input type="number" id="package-price" step="0.01" min="0" required>
      </div>
      <div class="form-group">
        <label for="package-features">Features (comma-separated, e.g., Feature 1, Feature 2)</label>
        <textarea id="package-features" required></textarea>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn-admin">Save Package</button>
        <button type="button" id="clear-package-form" class="btn-secondary">Clear Form</button>
      </div>
    </form>
  </section>

  <!-- Gallery Management Panel -->
  <section id="gallery" class="content-panel">
    <h2>Manage Gallery</h2>
    <form id="gallery-upload-form">
      <h3>Upload New Image</h3>
      <div class="form-group">
        <label for="gallery-image-url">Image URL</label>
        <input type="text" id="gallery-image-url" placeholder="https://images.unsplash.com/..." required>
      </div>
      <div class="form-group">
        <label for="gallery-caption">Caption (Optional)</label>
        <input type="text" id="gallery-caption">
      </div>
      <div class="form-group">
        <label for="gallery-category">Category</label>
        <select id="gallery-category" required>
          <option value="surfing">Surfing</option>
          <option value="tours">Tours</option>
          <option value="shop">Shop</option>
        </select>
      </div>
      <button type="submit" class="btn-admin">Add Image</button>
    </form>
    <hr>
    <h3>Existing Images</h3>
    <div id="gallery-list" class="gallery-admin-grid">
      <p>Loading gallery...</p>
    </div>
  </section>

  <!-- Settings Panel -->
  <section id="settings" class="content-panel">
    <h2>Settings</h2>
    <form id="whatsapp-form">
      <h3>WhatsApp Number</h3>
      <div class="form-group">
        <label for="whatsapp-number">Number</label>
        <input type="text" id="whatsapp-number" required>
      </div>
      <button type="submit" class="btn-admin">Save WhatsApp Number</button>
    </form>
    <hr>
    <form id="password-form">
      <h3>Change Password</h3>
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" required>
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" id="new-password" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm New Password</label>
        <input type="password" id="confirm-password" required>
      </div>
      <button type="submit" class="btn-admin">Change Password</button>
    </form>
  </section>

  <!-- Testimonials Panel -->
  <section id="testimonials" class="content-panel">
    <h2>Manage Testimonials</h2>
    <div id="testimonials-list">
      <p>Loading testimonials...</p>
    </div>
    <hr>
    <h3>Add / Edit Testimonial</h3>
    <form id="testimonial-form">
      <input type="hidden" id="testimonial-id">
      <div class="form-group">
        <label for="testimonial-author">Author</label>
        <input type="text" id="testimonial-author" required>
      </div>
      <div class="form-group">
        <label for="testimonial-quote">Quote</label>
        <textarea id="testimonial-quote" required></textarea>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn-admin">Save Testimonial</button>
        <button type="button" id="clear-testimonial-form" class="btn-secondary">Clear Form</button>
      </div>
    </form>
  </section>
</main>

<?php require_once 'includes/footer.php'; ?>