<?php
session_start();


require_once '../includes/db.php';

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT password FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
           $_SESSION['admin_logged_in'] = true;
           $_SESSION['admin_username'] = $username;

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Username not found.";
    }

    $stmt->close();
}
?>

<!-- HTML Login Form with playful CSS -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login - Adventure Call EST</title>
  <link rel="stylesheet" href="../assets/css/admin-login-style.css? v=2">
</head>
<body>
  <div class="login-container">
    <h1>Admin Login</h1>
    <?php if ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <button><a href="../index.php">back to Homepage</a></button>
  </div>
</body>
</html>
