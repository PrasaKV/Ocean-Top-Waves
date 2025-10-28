<?php
// --- DATABASE CONFIGURATION ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // UPDATE WITH YOUR DATABASE USERNAME
define('DB_PASS', '');         // UPDATE WITH YOUR DATABASE PASSWORD
define('DB_NAME', 'ocean_top_waves');

// --- Start Session ---
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// --- Create Database Connection (PDO) ---
try {
  $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
  // Set PDO attributes for error handling and fetch mode
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  // In a production environment, you would log this error, not display it.
  die("ERROR: Could not connect to the database. " . $e->getMessage());
}

// --- Helper function for consistent API responses ---
function json_response($data, $status_code = 200)
{
  http_response_code($status_code);
  header('Content-Type: application/json');
  echo json_encode($data);
  exit;
}
