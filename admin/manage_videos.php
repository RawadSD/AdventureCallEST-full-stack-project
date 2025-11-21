<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// Upload video
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    $video = $_FILES['video'];
    if ($video['error'] === UPLOAD_ERR_OK) {
        $allowed = ['mp4','webm','ogg'];
        $ext = strtolower(pathinfo($video['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $error = "Invalid video format.";
        } else {
            $newName = uniqid('vid_') . '.' . $ext;
            $destination = '../assets/videos/' . $newName;
            if (move_uploaded_file($video['tmp_name'], $destination)) {
                $stmt = $conn->prepare("INSERT INTO media (filename, media_type) VALUES (?, 'video')");
                $stmt->bind_param('s', $newName);
                if ($stmt->execute()) {
                    $success = "Video uploaded successfully.";
                } else {
                    $error = "DB error: " . $stmt->error;
                    unlink($destination);
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

// Delete video
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $stmt = $conn->prepare("SELECT filename FROM media WHERE id = ? AND media_type = 'video'");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($filename);

    if ($stmt->fetch()) {
        $stmt->close(); // close once, here

        // Delete from DB
        $delStmt = $conn->prepare("DELETE FROM media WHERE id = ?");
        $delStmt->bind_param('i', $id);
        if ($delStmt->execute()) {
            $delStmt->close();
            $filepath = '../assets/videos/' . $filename;
            if (file_exists($filepath)) unlink($filepath);
            $success = "Video deleted successfully.";
        } else {
            $error = "Failed to delete from DB.";
        }
    } else {
        $error = "Video not found.";
        $stmt->close(); // only close here if fetch() fails
    }
}


// Fetch videos
$videos = [];
$res = $conn->query("SELECT id, filename FROM media WHERE media_type='video' ORDER BY uploaded_at DESC");
if ($res) {
    while ($row = $res->fetch_assoc()) $videos[] = $row;
    $res->free();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Videos</title>
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
    <label>Add New Video:</label><br>
    <input type="file" name="video" accept="video/*" required><br><br>
    <button type="submit">Upload</button>
</form>

<h2>Existing Videos</h2>
<?php if (empty($videos)): ?>
<p>No videos found.</p>
<?php else: ?>
<table>
<thead>
<tr><th>Preview</th><th>Filename</th><th>Action</th></tr>
</thead>
<tbody>
<?php foreach ($videos as $v): ?>
<tr>
<td><video controls width="200">
<source src="../assets/videos/<?= htmlspecialchars($v['filename']) ?>" type="video/mp4">
Your browser does not support video.
</video></td>
<td><?= htmlspecialchars($v['filename']) ?></td>
<td>
<a href="?delete=<?= (int)$v['id'] ?>" onclick="return confirm('Delete this video?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>

<div>
    <a href="dashboard.php">Back to Dashboard</a>
</div>

<a href="../index.php">Back to Homepage</a>

</div>
</body>
</html>
