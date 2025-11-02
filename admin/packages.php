<?php
require_once 'includes/auth-check.php';
$edit_mode = false;
$package = ['id' => '', 'name' => '', 'price' => '', 'features' => ''];

// Handle POST requests for CUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $features = $_POST['features'];
    if (empty($id)) { // Create
      $stmt = $conn->prepare("INSERT INTO packages (name, price, features, created_at) VALUES (?, ?, ?, NOW())");
      $stmt->bind_param("sds", $name, $price, $features);
      $_SESSION['message'] = 'Package created successfully!';
    } else { // Update
      $stmt = $conn->prepare("UPDATE packages SET name = ?, price = ?, features = ? WHERE id = ?");
      $stmt->bind_param("sdsi", $name, $price, $features, $id);
      $_SESSION['message'] = 'Package updated successfully!';
    }
    $stmt->execute();
  } elseif (isset($_POST['delete'])) { // Delete
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $_SESSION['message'] = 'Package deleted successfully!';
  }
  header("Location: packages.php");
  exit;
}

// Handle GET requests for editing
if (isset($_GET['edit'])) {
  $edit_mode = true;
  $id = $_GET['edit'];
  $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $package = $stmt->get_result()->fetch_assoc();
}

// Fetch all packages for display
$packages = $conn->query("SELECT * FROM packages ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="main-wrapper">
  <header class="admin-header">
    <h1>Surfing Packages</h1>
  </header>
  <main class="main-content">
    <?php display_message(); ?>
    <div class="card">
      <div class="card-header">
        <h3><?php echo $edit_mode ? 'Edit Package' : 'Add New Package'; ?></h3>
      </div>
      <form id="package-form" method="POST" action="packages.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($package['id']); ?>">
        <div class="form-group"><label for="p-name">Package Name</label><input type="text" id="p-name" name="name" value="<?php echo htmlspecialchars($package['name']); ?>" required></div>
        <div class="form-group"><label for="p-price">Price</label><input type="number" id="p-price" name="price" step="0.01" min="0" value="<?php echo htmlspecialchars($package['price']); ?>" required></div>
        <div class="form-group"><label for="p-features">Features (comma-separated)</label><textarea id="p-features" name="features" required><?php echo htmlspecialchars($package['features']); ?></textarea></div>
        <div class="form-actions">
          <button type="submit" name="save" class="btn btn-primary"><i class="fas fa-save"></i> Save Package</button>
          <?php if ($edit_mode): ?>
            <a href="packages.php" class="btn btn-secondary">Cancel Edit</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
    <div class="card">
      <div class="card-header">
        <h3>Existing Packages</h3>
      </div>
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($packages as $p): ?>
              <tr>
                <td><?php echo htmlspecialchars($p['name']); ?></td>
                <td>$<?php echo htmlspecialchars(number_format($p['price'], 2)); ?></td>
                <td class="actions">
                  <a href="packages.php?edit=<?php echo $p['id']; ?>" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></a>
                  <form method="POST" action="packages.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this package?');">
                    <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                    <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($packages)): ?>
              <tr>
                <td colspan="3">No packages found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>
<?php require_once 'includes/footer.php'; ?>