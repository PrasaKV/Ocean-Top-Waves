<?php
if (!function_exists('get_site_settings')) {
  function get_site_settings()
  {
    require 'config.php';

    // Default settings array in case of DB connection failure
    $defaults = [
      'address' => 'Muththettu Waththa, Wewala, Hikkaduwa, Sri Lanka',
      'phone_number' => '(+94) 775 867 964',
      'email' => 'amiladinesh798@gmail.com',
      'whatsapp_number' => '94775867964',
      'map_location_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15870.76798024445!2d80.08832833955078!3d6.136367300000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae177f88140f0d9%3A0x86341e523f721517!2sHikkaduwa!5e0!3m2!1sen!2slk!4v1620050000000!5m2!1sen!2slk'
    ];


    $sql = "SELECT setting_key, setting_value FROM settings";
    $result = $conn->query($sql);

    $settings = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $settings[$row['setting_key']] = $row['setting_value'];
      }
    }
    $conn->close();
    return array_merge($defaults, $settings);
  }
}
$settings = get_site_settings();

// Prepare clickable links
$phone_link = 'tel:' . preg_replace('/[^\d+]/', '', $settings['phone_number']);
$email_link = 'mailto:' . $settings['email'];
$address_link = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($settings['address']);

?>
<footer id="contact" class="modern-footer">

  <div class="footer-content-wrapper">
    <!-- Main Footer Grid (3 columns) -->
    <div class="footer-grid">
      <div class="brand-column">
        <a href="index.php" class="footer-logo">
          <img class="footer-logo-icon" src="/assets/images/logos/logo.png" alt="Ocean Top Waves Logo">
          <span class="footer-logo-text">Ocean Top Waves</span>
        </a>
        <p class="footer-description">
          Your ultimate destination for surfing adventures in Sri Lanka. We offer lessons for all levels, amazing island tours, and a unique shop with handcrafted souvenirs.
        </p>
        <div class="social-links">
          <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

      <div class="links-column">
        <h4 class="footer-heading">Quick Links</h4>
        <ul class="footer-links">
          <li><a href="index.php#surfing-lessons"><i class="fas fa-chevron-right"></i>Lessons</a></li>
          <li><a href="index.php#explore"><i class="fas fa-chevron-right"></i>Tours</a></li>
          <li><a href="index.php#services"><i class="fas fa-chevron-right"></i>Services</a></li>
          <li><a href="gallery.php"><i class="fas fa-chevron-right"></i>Gallery</a></li>
        </ul>
      </div>

      <div class="contact-column">
        <h4 class="footer-heading">Contact Info</h4>
        <ul class="contact-info">
          <li>
            <i class="fas fa-map-marker-alt"></i>
            <a href="<?php echo htmlspecialchars($address_link); ?>" target="_blank" rel="noopener noreferrer">
              <span><?php echo htmlspecialchars($settings['address']); ?></span>
            </a>
          </li>
          <li>
            <i class="fas fa-phone"></i>
            <a href="<?php echo htmlspecialchars($phone_link); ?>">
              <span><?php echo htmlspecialchars($settings['phone_number']); ?></span>
            </a>
          </li>
          <li>
            <i class="fas fa-envelope"></i>
            <a href="<?php echo htmlspecialchars($email_link); ?>">
              <span><?php echo htmlspecialchars($settings['email']); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Map Section (Full Width) -->
    <div class="footer-map-section">
      <h4 class="footer-heading">Our Location</h4>
      <div class="map-container">
        <iframe
          src="<?php echo htmlspecialchars($settings['map_location_url']); ?>"
          width="100%"
          height="250"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <p>&copy; <?php echo date("Y"); ?> Ocean Top Waves | All Rights Reserved.</p>
    </div>
  </div>
</footer>

<a href="https://wa.me/<?php echo htmlspecialchars($settings['whatsapp_number']); ?>" class="whatsapp-float-modern" target="_blank" aria-label="Chat on WhatsApp">
  <div class="whatsapp-ripple"></div>
  <i class="fab fa-whatsapp"></i>
  <div class="whatsapp-tooltip">Chat with us!</div>
</a>

<script src="assets/js/script.js"></script>
</body>

</html>