<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Handle Upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
    $targetDir = "../assets/images/";
    $fileName = basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO homepage_photos (image_path) VALUES (?)");
        $dbPath = "assets/images/" . $fileName;
        $stmt->bind_param("s", $dbPath);
        $stmt->execute();
        $message = "Photo uploaded successfully!";
    } else {
        $message = "Failed to upload photo.";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("SELECT image_path FROM homepage_photos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    if ($stmt->fetch()) {
        unlink("../" . $imagePath); // Delete from filesystem
    }
    $stmt->close();

    $del = $conn->prepare("DELETE FROM homepage_photos WHERE id = ?");
    $del->bind_param("i", $id);
    $del->execute();
    $message = "Photo deleted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Photos</title>
  <link rel="stylesheet" href="../assets/css/manage-photos.css">
</head>
<body>
  <div class="form-container">
    <h2>Manage Homepage Photos</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>

    <form method="POST" enctype="multipart/form-data">
      <label>Upload New Photo:</label>
      <input type="file" name="photo" accept="image/*" required>
      <button type="submit">Upload</button>
    </form>

    <h3>Existing Photos</h3>
    <div class="gallery">
      <?php
      $result = $conn->query("SELECT * FROM homepage_photos ORDER BY uploaded_at DESC");
      while ($row = $result->fetch_assoc()):
      ?>
        <div style="display:inline-block; margin:10px; text-align:center;">
          <img src="../<?= $row['image_path'] ?>" width="150" height="100" style="object-fit:cover;">
          <br>
          <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this photo?')">Delete</a>
        </div>
      <?php endwhile; ?>
    </div>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>
