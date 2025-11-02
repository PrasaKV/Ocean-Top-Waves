<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    header('Location: login.php?error=Username and password are required.');
    exit;
  }

  $stmt = $conn->prepare("SELECT id, username, password_hash FROM admins WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password_hash'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header('Location: index.php');
    exit;
  } else {
    header('Location: login.php?error=Invalid username or password.');
    exit;
  }
} else {
  header('Location: login.php');
  exit;
}
