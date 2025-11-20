<?php
require_once '../includes/db.php';

// Upload
if (isset($_POST['upload'])) {
    if (!empty($_FILES['photo']['name'])) {
        $fileName = basename($_FILES['photo']['name']);
        $targetDir = "../uploads/";
$targetFile = $targetDir . $fileName;

// Save path relative to root for front-end:
$dbPath = "uploads/" . $fileName;

if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
    $stmt = $conn->prepare("INSERT INTO trip_offers (image_path) VALUES (?)");
    $stmt->bind_param("s", $dbPath);
    $stmt->execute();
}

            echo "<p style='text-align:center; color:green;'>Photo uploaded successfully!</p>";
        } else {
            echo "<p style='text-align:center; color:red;'>Failed to upload photo.</p>";
        }
    }



// Delete single photo
if (isset($_POST['delete'])) {
    $id = (int)$_POST['delete'];
    $result = $conn->query("SELECT image_path FROM trip_offers WHERE id=$id");
    if ($row = $result->fetch_assoc()) {
        @unlink($row['image_path']);
    }
    $conn->query("DELETE FROM trip_offers WHERE id=$id");
    echo "<p style='text-align:center; color:red;'>Photo deleted.</p>";
}

// Delete all
if (isset($_POST['delete_all'])) {
    $result = $conn->query("SELECT image_path FROM trip_offers");
    while ($row = $result->fetch_assoc()) {
        @unlink($row['image_path']);
    }
    $conn->query("TRUNCATE TABLE trip_offers");
    echo "<p style='text-align:center; color:red;'>All photos deleted.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Trip & Offer Photos</title>
    <link rel="stylesheet" href="../assets/css/trip_offers.css">
</head>
<body>
    <h2>Manage Trip & Offer Photos</h2>

    <!-- Upload Form -->
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="photo" required>
        <button type="submit" name="upload">Upload Photo</button>
    </form>

    <!-- Delete All Form -->
    <form method="post">
        <button type="submit" name="delete_all" onclick="return confirm('Are you sure you want to delete all photos?')">Delete All Photos</button>
    </form>

    <!-- Display Existing Photos -->
    <div class="offers-container">
        <?php
        $photos = $conn->query("SELECT * FROM trip_offers ORDER BY uploaded_at DESC");
        while ($photo = $photos->fetch_assoc()):
        ?>
        <div class="offer-item">
            <img src="../<?= htmlspecialchars($photo['image_path']) ?>" alt="Trip Offer">
            <form method="post">
                <button type="submit" name="delete" value="<?= $photo['id'] ?>">Delete</button>
            </form>
            
        </div>
        <?php endwhile; ?>
     
    </div>
     <div><a href="dashboard.php">← Back to Dashboard</a></div>
     <a href="../index.php" target="_blank">🌐 View Website</a>
</body>
</html>
