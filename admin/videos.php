<?php
session_start();
require_once '../includes/db.php';

// Check admin logged in (adjust as needed)
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// Handle video upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    $video = $_FILES['video'];

    // Basic validations
    if ($video['error'] === UPLOAD_ERR_OK) {
        $allowed = ['mp4', 'webm', 'ogg'];
        $ext = strtolower(pathinfo($video['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $error = "Invalid video format. Allowed: mp4, webm, ogg.";
        } else {
            // Generate unique filename to avoid overwrites
            $newName = uniqid('vid_') . '.' . $ext;
            $destination = '../assets/videos/' . $newName;

            if (move_uploaded_file($video['tmp_name'], $destination)) {
                // Insert into DB
                $stmt = $conn->prepare("INSERT INTO media (filename, media_type) VALUES (?, 'video')");
                $stmt->bind_param('s', $newName);
                if ($stmt->execute()) {
                    $success = "Video uploaded successfully.";
                } else {
                    $error = "DB error: " . $stmt->error;
                    unlink($destination); // remove uploaded file if DB insert fails
                }
                $stmt->close();
            } else {
                $error = "Failed to move uploaded file.";
            }
        }
    } else {
        $error = "File upload error.";
    }
}

// Handle video deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // Get filename to delete file from disk
    $stmt = $conn->prepare("SELECT filename FROM media WHERE id = ? AND media_type = 'video'");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($filename);
    if ($stmt->fetch()) {
        $stmt->close();
        // Delete from DB
        $delStmt = $conn->prepare("DELETE FROM media WHERE id = ?");
        $delStmt->bind_param('i', $id);
        if ($delStmt->execute()) {
            $delStmt->close();
            // Delete the video file
            $filepath = '../assets/videos/' . $filename;
            if (file_exists($filepath)) {
                unlink($filepath);
            }
            $success = "Video deleted successfully.";
        } else {
            $error = "Failed to delete from DB.";
        }
    } else {
        $error = "Video not found.";
    }
    $stmt->close();
}

// Fetch videos
$videos = [];
$result = $conn->query("SELECT id, filename FROM media WHERE media_type = 'video' ORDER BY uploaded_at DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
    $result->free();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Videos - Admin</title>
   <link rel="stylesheet" href="../assets/css/admin-videos.css">
</head>
<body>
  <div class="container">
    <h1>Manage Videos</h1>

    <?php if ($error): ?>
      <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label for="video">Add New Video (mp4, webm, ogg):</label><br>
      <input type="file" name="video" id="video" accept="video/*" required />
      <br />
      <button type="submit">Upload Video</button>
    </form>

    <h2>Existing Videos</h2>
    <?php if (empty($videos)): ?>
      <p>No videos found.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Preview</th>
            <th>Filename</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($videos as $video): ?>
            <tr>
              <td>
                <video controls>
                  <source src="../assets/videos/<?= htmlspecialchars($video['filename']) ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </td>
              <td><?= htmlspecialchars($video['filename']) ?></td>
              <td>
                <a href="?delete=<?= (int)$video['id'] ?>" onclick="return confirm('Delete this video?')" class="delete-btn">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <a href="../index.php">Back to homepage</a>
  </div>
</body>
</html>
