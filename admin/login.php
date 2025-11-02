<?php
require_once '../config.php';
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
  <title>Admin Login</title>
  <link rel="icon" href="../assets/images/logos/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/admin-style.css">
</head>

<body class="login-wrapper">
  <div class="login-card">
    <img src="../assets/images/logos/logo.png" alt="Logo" class="login-logo">
    <h2>Admin Panel Login</h2>
    <?php if (isset($_GET['error'])): ?>
      <p style="color: var(--danger-color);"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <form action="auth.php" method="POST">
      <div class="form-group">
        <label for="username" style="text-align: left;">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password" style="text-align: left;">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
    </form>
  </div>
</body>

</html>