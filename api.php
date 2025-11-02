<?php
require_once 'config.php'; // Includes session_start() and $conn

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

// --- ROUTING FOR PUBLIC DATA ---
try {
  switch ($action) {
    case 'get_packages':
      echo json_encode(db_query($conn, "SELECT id, name, price, features FROM packages ORDER BY price ASC"));
      break;
    case 'get_testimonials':
      echo json_encode(db_query($conn, "SELECT id, quote, author FROM testimonials ORDER BY RAND()"));
      break;
    case 'get_gallery':
      echo json_encode(db_query($conn, "SELECT id, image_url, alt_text, category FROM gallery"));
      break;
    case 'get_settings':
      $settings_array = db_query($conn, "SELECT setting_key, setting_value FROM settings");
      $settings = [];
      foreach ($settings_array as $row) {
        $settings[$row['setting_key']] = $row['setting_value'];
      }
      echo json_encode($settings);
      break;
    default:
      http_response_code(400);
      echo json_encode(['error' => 'Invalid action specified']);
      break;
  }
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();

// --- DATABASE HELPER FUNCTION ---
function db_query($conn, $sql, $params = [], $types = "")
{
  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    throw new Exception("Database query preparation failed: " . $conn->error);
  }
  if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
  }
  if (!$stmt->execute()) {
    throw new Exception("Database query execution failed: " . $stmt->error);
  }
  $result = $stmt->get_result();
  $data = $result->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  return $data;
}
