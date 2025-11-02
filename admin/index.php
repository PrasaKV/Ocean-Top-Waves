<?php
require_once 'includes/auth-check.php';

// Fetch dashboard stats
$packages_count = $conn->query("SELECT COUNT(*) as count FROM packages")->fetch_assoc()['count'];
$testimonials_count = $conn->query("SELECT COUNT(*) as count FROM testimonials")->fetch_assoc()['count'];
$gallery_count = $conn->query("SELECT COUNT(*) as count FROM gallery")->fetch_assoc()['count'];
$recent_package = $conn->query("SELECT * FROM packages ORDER BY created_at DESC LIMIT 1")->fetch_assoc();
$recent_testimonial = $conn->query("SELECT * FROM testimonials ORDER BY created_at DESC LIMIT 1")->fetch_assoc();
$settings_result = $conn->query("SELECT * FROM settings WHERE setting_key IN ('email', 'phone_number', 'whatsapp_number')");
$settings = [];
while ($row = $settings_result->fetch_assoc()) {
  $settings[$row['setting_key']] = $row['setting_value'];
}

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="main-wrapper">
  <header class="admin-header">
    <div>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?>!</strong></div>
  </header>
  <main class="main-content">
    <?php display_message(); ?>
    <h1>Dashboard Overview</h1>

    <!-- Stat Cards -->
    <div class="stat-cards-container">
      <div class="stat-card">
        <div class="stat-icon" style="background-color: #007bff;"><i class="fas fa-box"></i></div>
        <div class="stat-info">
          <span class="stat-title">Total Packages</span>
          <span class="stat-value"><?php echo $packages_count; ?></span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background-color: #28a745;"><i class="fas fa-comment-alt"></i></div>
        <div class="stat-info">
          <span class="stat-title">Total Testimonials</span>
          <span class="stat-value"><?php echo $testimonials_count; ?></span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background-color: #ffc107;"><i class="fas fa-images"></i></div>
        <div class="stat-info">
          <span class="stat-title">Gallery Images</span>
          <span class="stat-value"><?php echo $gallery_count; ?></span>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="dashboard-section">
      <h2>Quick Actions</h2>
      <div class="quick-actions-container">
        <a href="packages.php" class="quick-action-card">
          <i class="fas fa-plus-circle"></i>
          <span>Manage Packages</span>
        </a>
        <a href="gallery.php" class="quick-action-card">
          <i class="fas fa-image"></i>
          <span>Add Gallery Image</span>
        </a>
        <a href="settings.php" class="quick-action-card">
          <i class="fas fa-cog"></i>
          <span>Update Settings</span>
        </a>
      </div>
    </div>

    <!-- Recent Activity & Site Info -->
    <div class="dashboard-grid">
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-history"></i> Recent Activity</h3>
        </div>
        <ul class="info-list">
          <?php if ($recent_package): ?>
            <li>
              <i class="fas fa-box info-icon"></i>
              <div>
                <span class="label">Latest Package Added</span>
                <span class="value"><?php echo htmlspecialchars($recent_package['name']); ?></span>
              </div>
            </li>
          <?php endif; ?>
          <?php if ($recent_testimonial): ?>
            <li>
              <i class="fas fa-comment-alt info-icon"></i>
              <div>
                <span class="label">Latest Testimonial</span>
                <span class="value">By <?php echo htmlspecialchars($recent_testimonial['author']); ?></span>
              </div>
            </li>
          <?php endif; ?>
          <?php if (!$recent_package && !$recent_testimonial): ?>
            <li>No recent activity found.</li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="card">
        <div class="card-header">
          <h3><i class="fas fa-info-circle"></i> Site Information</h3>
        </div>
        <ul class="info-list">
          <li>
            <i class="fas fa-envelope info-icon"></i>
            <div>
              <span class="label">Email</span>
              <span class="value"><?php echo htmlspecialchars($settings['email'] ?? 'Not Set'); ?></span>
            </div>
          </li>
          <li>
            <i class="fas fa-phone info-icon"></i>
            <div>
              <span class="label">Phone</span>
              <span class="value"><?php echo htmlspecialchars($settings['phone_number'] ?? 'Not Set'); ?></span>
            </div>
          </li>
          <li>
            <i class="fab fa-whatsapp info-icon"></i>
            <div>
              <span class="label">WhatsApp</span>
              <span class="value"><?php echo htmlspecialchars($settings['whatsapp_number'] ?? 'Not Set'); ?></span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </main>
</div>
<?php require_once 'includes/footer.php'; ?>