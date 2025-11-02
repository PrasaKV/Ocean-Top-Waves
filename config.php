<?php
// --- DATABASE CONFIGURATION ---
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ocean_top_waves'); // The database you created

// define('DB_HOST', '192.168.8.160');
// define('DB_USER', 'root');
// define('DB_PASS', 'mySQL');
// define('DB_NAME', 'ocean_top_waves'); // The database you created


// --- SITE SETTINGS ---
define('SITE_URL', 'http://localhost/your-project-folder'); // Change this to your site's URL

// --- PHP SESSIONS ---
// Start the session if it's not already started.
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// --- DATABASE CONNECTION (MySQLi) ---
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection for errors
if ($conn->connect_error) {
  // A real site would log this error and show a generic error page
  die("Database Connection Failed: " . $conn->connect_error);
}
