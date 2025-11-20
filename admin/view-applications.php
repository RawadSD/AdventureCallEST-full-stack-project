<?php
session_start();
require_once '../includes/db.php';

if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM monitor_applications ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Applications</title>
  <link rel="stylesheet" href="../assets/css/view-applications.css">
</head>
<body>
  <div class="form-container">
    <h2>Monitor Applications</h2>
    <table border="1" cellpadding="8">
      <tr>
        <th>Full Name</th>
        <th>Position</th>
        <th>Expected Salary</th>
        <th>Resume</th>
        <th>Date Submitted</th>
        <th>Phone</th>
        <th>Email</th>

      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['full_name']) ?></td>
        <td><?= htmlspecialchars($row['position']) ?></td>
        <td><?= htmlspecialchars($row['expected_salary']) ?></td>
        <td><a href="../<?= $row['resume_path'] ?>" target="_blank">View Resume</a></td>
        <td><?= $row['submitted_at'] ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>

      </tr>
      <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>
