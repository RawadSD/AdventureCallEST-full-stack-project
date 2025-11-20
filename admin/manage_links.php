
<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
  header('Location: login.php');
  exit();
}

// Handle contact update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact'])) {
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $stmt = $conn->prepare("UPDATE contact_info SET email=?, phone=? WHERE id=1");
  $stmt->bind_param("ss", $email, $phone);
  $stmt->execute();
}

// Handle social media add
if (isset($_POST['add_social'])) {
  $platform = $_POST['platform'];
  $url = $_POST['url'];
  $stmt = $conn->prepare("INSERT INTO social_links (platform, url) VALUES (?, ?)");
  $stmt->bind_param("ss", $platform, $url);
  $stmt->execute();
}

// Handle social media edit
if (isset($_POST['edit_social'])) {
  $id = $_POST['id'];
  $platform = $_POST['platform'];
  $url = $_POST['url'];
  $stmt = $conn->prepare("UPDATE social_links SET platform=?, url=? WHERE id=?");
  $stmt->bind_param("ssi", $platform, $url, $id);
  $stmt->execute();
}

// Handle social media delete
if (isset($_POST['delete_social'])) {
  $id = $_POST['id'];
  $stmt = $conn->prepare("DELETE FROM social_links WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

// Fetch current data
$contact = $conn->query("SELECT * FROM contact_info WHERE id=1")->fetch_assoc();
$socials = $conn->query("SELECT * FROM social_links");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Contact & Social Links</title>
  <link rel="stylesheet" href="../assets/css/manage_links.css">
</head>


<body>
  <h1>Manage Contact Info</h1>
  <form method="POST">
    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required><br>
    <label>Phone:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>" required><br>
    <button type="submit" name="update_contact">Update Contact Info</button>
  </form>

  <hr>

  <h1>Manage Social Media Links</h1>

  <form method="POST">
    <label>Choose a platform:</label>
    <!-- <label for="platform"></label> -->
      <select name="platform" id="platform" required>
        <option value="facebook">Facebook</option>
        <option value="instagram">Instagram</option>
        <option value="tiktok">TikTok</option>
        <option value="youtube">YouTube</option>
        <option value="twitter">Twitter</option>
        <option value="linkedin">LinkedIn</option>
        <option value="snapchat">Snapchat</option>
      </select>

    <!-- <input type="text" name="platform" required>  -->
    <label>URL:</label>
    <input type="url" name="url" required>
    <button type="submit" name="add_social">Add New Link</button>
  </form>

  <h2>Existing Links</h2>
  <?php while ($row = $socials->fetch_assoc()): ?>
    <form method="POST" style="margin-bottom: 10px;">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <input type="text" name="platform" value="<?= htmlspecialchars($row['platform']) ?>" required>
      <input type="url" name="url" value="<?= htmlspecialchars($row['url']) ?>" required>
      <button type="submit" name="edit_social">Save</button>
      <button type="submit" name="delete_social" onclick="return confirm('Delete this link?')">Delete</button>
    </form>
  <?php endwhile; ?>

  <p><a href="dashboard.php">← Back to Dashboard</a></p>
     <a href="../index.php" target="_blank">🌐 View Website</a>

</body>
</html>
