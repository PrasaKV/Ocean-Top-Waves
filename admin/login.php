<?php
require_once '../config.php';
// If user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Ocean Top Waves</title>
  <link rel="stylesheet" href="assets/css/admin-style.css">
</head>

<body class="login-body">
  <div class="login-container">
    <h2>Admin Login</h2>
    <?php if (isset($_GET['error'])): ?>
      <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="auth.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn-admin">Login</button>
    </form>
  </div>
</body>

</html>