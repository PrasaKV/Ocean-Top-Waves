<?php
require_once 'includes/auth-check.php';

// Handle settings update
if (isset($_POST['save_settings'])) {
  $stmt = $conn->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
  foreach ($_POST['settings'] as $key => $value) {
    $stmt->bind_param("ss", $key, $value);
    $stmt->execute();
  }
  $_SESSION['message'] = 'Settings updated successfully!';
  header("Location: settings.php");
  exit;
}

// Handle password change
if (isset($_POST['change_password'])) {
  $current_pass = $_POST['current_password'];
  $new_pass = $_POST['new_password'];
  $confirm_pass = $_POST['confirm_password'];

  if ($new_pass !== $confirm_pass) {
    $_SESSION['message'] = 'New passwords do not match.';
    $_SESSION['message_type'] = 'error';
  } else {
    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($current_pass, $user['password_hash'])) {
      $new_hash = password_hash($new_pass, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE admins SET password_hash = ? WHERE id = ?");
      $stmt->bind_param("si", $new_hash, $_SESSION['user_id']);
      $stmt->execute();
      $_SESSION['message'] = 'Password changed successfully!';
    } else {
      $_SESSION['message'] = 'Incorrect current password.';
      $_SESSION['message_type'] = 'error';
    }
  }
  header("Location: settings.php");
  exit;
}

// Fetch all settings
$settings_result = $conn->query("SELECT * FROM settings");
$settings = [];
while ($row = $settings_result->fetch_assoc()) {
  $settings[$row['setting_key']] = $row['setting_value'];
}
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="main-wrapper">
  <header class="admin-header">
    <h1>Site Settings</h1>
  </header>
  <main class="main-content">
    <?php display_message(); ?>
    <div class="card">
      <div class="card-header">
        <h3>Contact & Location</h3>
      </div>
      <form method="POST" action="settings.php">
        <div class="form-group"><label for="s-whatsapp">WhatsApp</label><input type="text" id="s-whatsapp" name="settings[whatsapp_number]" value="<?php echo htmlspecialchars($settings['whatsapp_number'] ?? ''); ?>"></div>
        <div class="form-group"><label for="s-phone">Phone</label><input type="text" id="s-phone" name="settings[phone_number]" value="<?php echo htmlspecialchars($settings['phone_number'] ?? ''); ?>"></div>
        <div class="form-group"><label for="s-email">Email</label><input type="email" id="s-email" name="settings[email]" value="<?php echo htmlspecialchars($settings['email'] ?? ''); ?>"></div>
        <div class="form-group"><label for="s-address">Address</label><textarea id="s-address" name="settings[address]"><?php echo htmlspecialchars($settings['address'] ?? ''); ?></textarea></div>
        <div class="form-group"><label for="s-map">Map URL</label><textarea id="s-map" name="settings[map_location_url]"><?php echo htmlspecialchars($settings['map_location_url'] ?? ''); ?></textarea></div>
        <button type="submit" name="save_settings" class="btn btn-primary"><i class="fas fa-save"></i> Save All Settings</button>
      </form>
    </div>
    <div class="card">
      <div class="card-header">
        <h3>Security</h3>
      </div>
      <form method="POST" action="settings.php">
        <div class="form-group"><label for="current-password">Current Password</label><input type="password" id="current-password" name="current_password" required></div>
        <div class="form-group"><label for="new-password">New Password</label><input type="password" id="new-password" name="new_password" required></div>
        <div class="form-group"><label for="confirm-password">Confirm Password</label><input type="password" id="confirm-password" name="confirm_password" required></div>
        <button type="submit" name="change_password" class="btn btn-primary"><i class="fas fa-key"></i> Change Password</button>
      </form>
    </div>
  </main>
</div>
<?php require_once 'includes/footer.php'; ?>