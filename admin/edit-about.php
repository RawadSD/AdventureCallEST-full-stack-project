<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_content = $_POST["content"];
    $stmt = $conn->prepare("UPDATE about_section SET content = ? WHERE id = 1");
    $stmt->bind_param("s", $new_content);
    $stmt->execute();
    $message = "About section updated successfully!";
}

// Fetch current content
$result = $conn->query("SELECT content FROM about_section WHERE id = 1");
$row = $result->fetch_assoc();
$current_content = $row['content'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit About Section</title>
  <link rel="stylesheet" href="../assets/css/edit-about.css">
</head>
<body>
  <div class="form-container">
    <h2>Edit About Section</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST">
      <textarea name="content" rows="10" required><?= htmlspecialchars($current_content) ?></textarea>
      <button type="submit">Save</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>
