<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../assets/css/dashboard-style.css? v=2">
</head>
<body>

<div class="dashboard-container">
  <div class="dashboard-header">
    <h1>🌞 Adventure Call EST Admin Dashboard</h1>
    <p>Manage your summer colony with ease</p>
  </div>

  <div class="dashboard-buttons">
    <a href="change-password.php">🔑 Change Password</a>
    <a href="../index.php" target="_blank">🌐 View Website</a>
    <a href="edit-about.php" class="btn">Edit About Section</a>
    <a href="trip_offers.php">Manage Trips & Offers</a>
    <a href="manage-photos.php" class="btn">Manage Photos</a>
    <a href="view-applications.php" class="btn">View Applications</a>
    <a href="view-participants.php" class="btn">View participants</a>
    <a href="manage_links.php">Edit Contact & Social Media</a>
    <a href="manage_videos.php">Manage videos</a>


    <a href="logout.php">🚪 Logout</a>

  </div>
</div>

</body>
</html>
