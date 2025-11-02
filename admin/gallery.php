<?php
require_once 'includes/auth-check.php';

// Define the absolute path for the uploads directory for security
define('UPLOAD_DIR', dirname(__DIR__) . '/assets/images/gallery/');
// Define the web-accessible path for displaying images
define('UPLOAD_URL', '/assets/images/gallery/');

// --- Handle POST Requests (File Uploads & Deletes) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // --- ADD IMAGE ---
  if (isset($_POST['add_image'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0) {
      $file = $_FILES['image_file'];
      $alt_text = $_POST['alt_text'];
      $category = $_POST['category'];

      // Security check for valid image types
      $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
      if (!in_array($file['type'], $allowed_types)) {
        $_SESSION['message'] = 'Error: Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.';
        $_SESSION['message_type'] = 'error';
      } else {
        // Create a unique filename to prevent overwriting existing files
        $filename = uniqid() . '-' . basename($file['name']);
        $target_path = UPLOAD_DIR . $filename;
        $url_path = UPLOAD_URL . $filename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
          // Save the URL path to the database
          $stmt = $conn->prepare("INSERT INTO gallery (image_url, alt_text, category) VALUES (?, ?, ?)");
          $stmt->bind_param("sss", $url_path, $alt_text, $category);
          $stmt->execute();
          $_SESSION['message'] = 'Image uploaded and added successfully!';
        } else {
          $_SESSION['message'] = 'Error: Could not move the uploaded file.';
          $_SESSION['message_type'] = 'error';
        }
      }
    } else {
      $_SESSION['message'] = 'Error: No file was uploaded or an error occurred during upload.';
      $_SESSION['message_type'] = 'error';
    }
  }
  // --- DELETE IMAGE ---
  elseif (isset($_POST['delete_image'])) {
    $id = $_POST['id'];

    // First, get the image URL from the database to delete the actual file
    $stmt = $conn->prepare("SELECT image_url FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
      $file_path_to_delete = dirname(__DIR__) . $result['image_url'];
      if (file_exists($file_path_to_delete)) {
        unlink($file_path_to_delete); // Delete the file from the server
      }
    }

    // Then, delete the record from the database
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['message'] = 'Image deleted successfully!';
  }
  header("Location: gallery.php");
  exit;
}

$gallery_images = $conn->query("SELECT * FROM gallery ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="main-wrapper">
  <header class="admin-header">
    <h1>Gallery Management</h1>
  </header>
  <main class="main-content">
    <?php display_message(); ?>
    <div class="card">
      <div class="card-header">
        <h3><i class="fas fa-upload"></i> Upload New Image</h3>
      </div>
      <!-- IMPORTANT: enctype is required for file uploads -->
      <form method="POST" action="gallery.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="image_file">Choose Image File</label>
          <input type="file" id="image_file" name="image_file" class="file-input" required accept="image/jpeg,image/png,image/gif,image/webp">
          <div class="image-preview-box" id="imagePreview">
            <img src="" alt="Image Preview" class="image-preview-image">
            <span class="image-preview-text">Image Preview</span>
          </div>
        </div>
        <div class="form-group">
          <label for="g-alt">Alt Text (Description for SEO)</label>
          <input type="text" id="g-alt" name="alt_text" required>
        </div>
        <div class="form-group">
          <label for="g-cat">Category</label>
          <select id="g-cat" name="category" required>
            <option value="lifestyle">Lifestyle</option>
            <option value="shop">Shop</option>
          </select>
        </div>
        <button type="submit" name="add_image" class="btn btn-primary"><i class="fas fa-plus"></i> Upload and Add Image</button>
      </form>
    </div>
    <div class="card">
      <div class="card-header">
        <h3><i class="fas fa-images"></i> Existing Images</h3>
      </div>
      <div class="gallery-admin-grid">
        <?php foreach ($gallery_images as $img): ?>
          <div class="gallery-admin-item">
            <!-- Path is now relative to project root -->
            <img src="..<?php echo htmlspecialchars($img['image_url']); ?>" alt="<?php echo htmlspecialchars($img['alt_text']); ?>" loading="lazy">
            <div class="overlay"><?php echo htmlspecialchars($img['alt_text']); ?></div>
            <form method="POST" action="gallery.php" onsubmit="return confirm('Are you sure you want to delete this image? This cannot be undone.');">
              <input type="hidden" name="id" value="<?php echo $img['id']; ?>">
              <button type="submit" name="delete_image" class="btn-delete-gallery btn btn-danger btn-sm">&times;</button>
            </form>
          </div>
        <?php endforeach; ?>
        <?php if (empty($gallery_images)): ?>
          <p>No gallery images found. Upload one above to get started.</p>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>

<!-- JavaScript for the image preview -->
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const inputFile = document.getElementById('image_file');
    const previewContainer = document.getElementById('imagePreview');
    const previewImage = previewContainer.querySelector('.image-preview-image');
    const previewText = previewContainer.querySelector('.image-preview-text');

    inputFile.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        previewText.style.display = 'none';
        previewImage.style.display = 'block';

        reader.addEventListener('load', function() {
          previewImage.setAttribute('src', this.result);
        });

        reader.readAsDataURL(file);
      } else {
        previewText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute('src', "");
      }
    });
  });
</script>

<?php require_once 'includes/footer.php'; ?>