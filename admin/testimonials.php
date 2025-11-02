<?php
require_once 'includes/auth-check.php';
$edit_mode = false;
$testimonial = ['id' => '', 'author' => '', 'quote' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $author = $_POST['author'];
    $quote = $_POST['quote'];
    if (empty($id)) {
      $stmt = $conn->prepare("INSERT INTO testimonials (author, quote, created_at) VALUES (?, ?, NOW())");
      $stmt->bind_param("ss", $author, $quote);
      $_SESSION['message'] = 'Testimonial created successfully!';
    } else {
      $stmt = $conn->prepare("UPDATE testimonials SET author = ?, quote = ? WHERE id = ?");
      $stmt->bind_param("ssi", $author, $quote, $id);
      $_SESSION['message'] = 'Testimonial updated successfully!';
    }
    $stmt->execute();
  } elseif (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $_SESSION['message'] = 'Testimonial deleted successfully!';
  }
  header("Location: testimonials.php");
  exit;
}

if (isset($_GET['edit'])) {
  $edit_mode = true;
  $stmt = $conn->prepare("SELECT * FROM testimonials WHERE id = ?");
  $stmt->bind_param("i", $_GET['edit']);
  $stmt->execute();
  $testimonial = $stmt->get_result()->fetch_assoc();
}

$testimonials = $conn->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="main-wrapper">
  <header class="admin-header">
    <h1>Testimonials</h1>
  </header>
  <main class="main-content">
    <?php display_message(); ?>
    <div class="card">
      <div class="card-header">
        <h3><?php echo $edit_mode ? 'Edit Testimonial' : 'Add New Testimonial'; ?></h3>
      </div>
      <form method="POST" action="testimonials.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($testimonial['id']); ?>">
        <div class="form-group"><label for="t-author">Author</label><input type="text" id="t-author" name="author" value="<?php echo htmlspecialchars($testimonial['author']); ?>" required></div>
        <div class="form-group"><label for="t-quote">Quote</label><textarea id="t-quote" name="quote" required><?php echo htmlspecialchars($testimonial['quote']); ?></textarea></div>
        <div class="form-actions">
          <button type="submit" name="save" class="btn btn-primary"><i class="fas fa-save"></i> Save Testimonial</button>
          <?php if ($edit_mode): ?><a href="testimonials.php" class="btn btn-secondary">Cancel Edit</a><?php endif; ?>
        </div>
      </form>
    </div>
    <div class="card">
      <div class="card-header">
        <h3>Existing Testimonials</h3>
      </div>
      <div class="data-table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>Author</th>
              <th>Quote</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($testimonials as $t): ?>
              <tr>
                <td><?php echo htmlspecialchars($t['author']); ?></td>
                <td>"<?php echo htmlspecialchars(substr($t['quote'], 0, 70)); ?>..."</td>
                <td class="actions">
                  <a href="testimonials.php?edit=<?php echo $t['id']; ?>" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i></a>
                  <form method="POST" action="testimonials.php" style="display:inline;" onsubmit="return confirm('Delete this testimonial?');">
                    <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                    <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($testimonials)): ?><tr>
                <td colspan="3">No testimonials found.</td>
              </tr><?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>
<?php require_once 'includes/footer.php'; ?>