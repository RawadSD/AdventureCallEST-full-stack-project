<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

// Fetch participants
$result = $conn->query("SELECT * FROM participants ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Participants</title>
  <link rel="stylesheet" href="../assets/css/view-participants.css">
</head>
<body>
  <div class="form-container">
    <h2>Registered Participants</h2>
    <table>
      <tr>
        <th>Full Name</th>
        <th>Age</th>
        <th>Guardian's Name</th>
        <th>Guardian's Phone</th>
        <th>Email</th>
        <th>Preferred Activities</th>
        <th>Allergies / Notes</th>
        <th>Registered At</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['full_name']) ?></td>
          <td><?= htmlspecialchars($row['age']) ?></td>
          <td><?= htmlspecialchars($row['guardian_name']) ?></td>
          <td><?= htmlspecialchars($row['guardian_phone']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['preferred_activities']) ?></td>
          <td><?= htmlspecialchars($row['medical_notes']) ?></td>
          <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <a class="back-btn" href="dashboard.php">Back to Dashboard</a>
  </div>
</body>
</html>
