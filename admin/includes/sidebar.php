<?php
// Get the current page filename (e.g., "index.php", "packages.php")
// This is used to dynamically add the 'active' class to the correct link.
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
  <div class="sidebar-header">Ocean Top Waves</div>
  <nav class="sidebar-nav">
    <a href="index.php" class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
      <i class="fas fa-tachometer-alt fa-fw"></i>
      <span>Dashboard</span>
    </a>
    <a href="packages.php" class="nav-link <?php echo ($current_page == 'packages.php') ? 'active' : ''; ?>">
      <i class="fas fa-box fa-fw"></i>
      <span>Packages</span>
    </a>
    <a href="gallery.php" class="nav-link <?php echo ($current_page == 'gallery.php') ? 'active' : ''; ?>">
      <i class="fas fa-images fa-fw"></i>
      <span>Gallery</span>
    </a>
    <a href="testimonials.php" class="nav-link <?php echo ($current_page == 'testimonials.php') ? 'active' : ''; ?>">
      <i class="fas fa-comment-alt fa-fw"></i>
      <span>Testimonials</span>
    </a>
    <a href="settings.php" class="nav-link <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
      <i class="fas fa-cog fa-fw"></i>
      <span>Settings</span>
    </a>
  </nav>
  <div class="sidebar-footer">
    <a href="logout.php" class="btn-logout">
      <i class="fas fa-sign-out-alt fa-fw"></i>
      <span>Logout</span>
    </a>
  </div>
</aside>