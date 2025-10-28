<?php
require_once 'config.php';

// --- Simple API Router ---
$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// --- Authentication Check Function ---
function require_auth()
{
  if (!isset($_SESSION['user_id'])) {
    json_response(['error' => 'Unauthorized Access'], 401);
  }
}

// --- Main Routing Logic ---
switch ($action) {
  // --- Public GET Routes ---
  case 'get_carousel':
    if ($method === 'GET') get_public_data($pdo, 'carousel_slides', 'is_active = true ORDER BY display_order');
    break;
  case 'get_packages':
    if ($method === 'GET') get_public_data($pdo, 'surfing_packages', 'is_active = true ORDER BY price');
    break;
  case 'get_gallery':
    if ($method === 'GET') get_public_data($pdo, 'gallery_images', '1 ORDER BY uploaded_at DESC');
    break;

  // --- Admin Routes ---
  case 'admin_get_all':
    if ($method === 'GET') {
      require_auth();
      admin_get_all_data($pdo);
    }
    break;
  case 'save_package':
    if ($method === 'POST') {
      require_auth();
      save_package($pdo);
    }
    break;
  case 'delete_package':
    if ($method === 'POST') {
      require_auth();
      delete_by_id($pdo, 'surfing_packages');
    }
    break;
  case 'save_gallery_image':
    if ($method === 'POST') {
      require_auth();
      save_gallery_image($pdo);
    }
    break;
  case 'delete_gallery_image':
    if ($method === 'POST') {
      require_auth();
      delete_by_id($pdo, 'gallery_images');
    }
    break;

  default:
    json_response(['error' => 'Invalid API Action'], 404);
    break;
}

// --- FUNCTION DEFINITIONS ---

// Generic fetch for public data
function get_public_data($pdo, $table, $where_clause)
{
  $stmt = $pdo->query("SELECT * FROM {$table} WHERE {$where_clause}");
  json_response($stmt->fetchAll());
}

// Fetches all data for the admin panel
function admin_get_all_data($pdo)
{
  $data = [];
  $data['packages'] = $pdo->query("SELECT * FROM surfing_packages ORDER BY price")->fetchAll();
  $data['gallery'] = $pdo->query("SELECT * FROM gallery_images ORDER BY uploaded_at DESC")->fetchAll();
  $data['carousel'] = $pdo->query("SELECT * FROM carousel_slides ORDER BY display_order")->fetchAll();
  json_response($data);
}

// Saves (inserts or updates) a surfing package
function save_package($pdo)
{
  $input = json_decode(file_get_contents('php://input'), true);
  $id = $input['id'] ?? null;
  if (empty($input['name']) || !isset($input['price']) || empty($input['features'])) {
    json_response(['error' => 'Missing required fields for package'], 400);
  }

  if ($id) { // Update
    $sql = "UPDATE surfing_packages SET name = ?, price = ?, features = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$input['name'], $input['price'], $input['features'], $id]);
  } else { // Insert
    $sql = "INSERT INTO surfing_packages (name, price, features) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$input['name'], $input['price'], $input['features']]);
    $id = $pdo->lastInsertId();
  }
  json_response(['success' => true, 'id' => $id]);
}

// Saves a new gallery image
function save_gallery_image($pdo)
{
  $input = json_decode(file_get_contents('php://input'), true);
  if (empty($input['image_url']) || empty($input['category'])) {
    json_response(['error' => 'Image URL and Category are required'], 400);
  }

  $sql = "INSERT INTO gallery_images (image_url, category, caption) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$input['image_url'], $input['category'], $input['caption'] ?? '']);
  json_response(['success' => true, 'id' => $pdo->lastInsertId()]);
}

// Generic delete function for any table with an 'id' column
function delete_by_id($pdo, $table)
{
  $input = json_decode(file_get_contents('php://input'), true);
  $id = $input['id'] ?? null;
  if (!$id) {
    json_response(['error' => 'Item ID is required for deletion'], 400);
  }

  // Sanitize table name to prevent SQL injection
  if (!in_array($table, ['surfing_packages', 'gallery_images', 'carousel_slides'])) {
    json_response(['error' => 'Invalid table specified'], 400);
  }

  $stmt = $pdo->prepare("DELETE FROM {$table} WHERE id = ?");
  $stmt->execute([$id]);
  json_response(['success' => true]);
}
