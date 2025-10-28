<?php
require_once '../config.php';

// This script checks if the user is logged in.
// It should be included at the very top of any admin-only page.
if (!isset($_SESSION['user_id'])) {
  // If not logged in, redirect to the login page
  header('Location: login.php');
  exit;
}
