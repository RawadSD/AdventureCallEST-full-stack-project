<?php
session_start();
require_once '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}

$message = ""; // ✅ Prevents the warning

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    $username = $_SESSION['admin_username'];

    if ($new_password !== $confirm_password) {
        $message = "New passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hashed);
        $stmt->fetch();

        if (password_verify($current_password, $hashed)) {
            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
            $update->bind_param("ss", $new_hashed, $username);
            $update->execute();
            $message = "Password updated successfully!";
        } else {
            $message = "Current password is incorrect.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password - Adventure Call EST</title>
  <link rel="stylesheet" href="../assets/css/change-password.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>     

<div class="container">
  <h2><i class="fas fa-key"></i> Change Password</h2>

  <?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" action="">
    <label for="current_password">Current Password:</label>
    <input type="password" name="current_password" required>

    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" required>

    <button type="submit">Update Password</button>
  </form>

  <a class="back-link" href="dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

</body>
</html>
