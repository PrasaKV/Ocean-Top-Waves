<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="assets/css/admin-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="../assets/images/logos/favicon.ico" type="image/x-icon">
</head>

<body>
  <?php
  // Function to trigger the JavaScript toast notification from PHP
  function display_message()
  {
    if (isset($_SESSION['message'])) {
      $type = $_SESSION['message_type'] ?? 'success';
      $title = $type === 'success' ? 'Success!' : 'Error!';
      $message = $_SESSION['message'];

      // Echo a script tag that calls our new JS function
      echo "<script>
            document.addEventListener('DOMContentLoaded', () => {
                if (window.showAdminToast) {
                    window.showAdminToast(" . json_encode($title) . ", " . json_encode($message) . ", " . json_encode($type) . ");
                }
            });
        </script>";

      // Unset the session variables so the message doesn't reappear
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
    }
  }
  ?>
  <div class="admin-container">