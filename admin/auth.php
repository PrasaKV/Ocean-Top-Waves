<?php
require_once '../config.php';

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Basic validation
  if (empty($username) || empty($password)) {
    header('Location: login.php?error=Username and password are required.');
    exit;
  }

  try {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
      // Regenerate session ID for security
      session_regenerate_id(true);

      // Set session variables
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];

      // Redirect to the admin dashboard
      header('Location: index.php');
      exit;
    } else {
      // Invalid credentials
      header('Location: login.php?error=Invalid username or password.');
      exit;
    }
  } catch (PDOException $e) {
    // Database error
    header('Location: login.php?error=A database error occurred.');
    exit;
  }
} else {
  // Redirect non-POST requests back to login
  header('Location: login.php');
  exit;
}
