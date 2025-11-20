<?php
require_once 'includes/db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $resume_path = null;

    if (!empty($_FILES['resume']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["resume"]["name"]);
        $targetFile = $targetDir . time() . "_" . $fileName;

        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
            $resume_path = $targetFile;
        }
    }

    $stmt = $conn->prepare("INSERT INTO monitor_applications (full_name, position, expected_salary, phone, email, resume_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $full_name, $position, $salary, $phone, $email, $resume_path);
    $stmt->execute();
    $message = "Application submitted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Monitor Application</title>
  <link rel="stylesheet" href="assets/css/monitor-apply.css">
</head>
<body>
  <div class="form-container">
    <h2>Apply as a Monitor</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
  <label for="full_name">Full Name:</label>
  <input type="text" id="full_name" name="full_name" required>

  <label for="position">Position (e.g. Trainer, Teacher, etc):</label>
  <input type="text" id="position" name="position" required>

  <label for="expected_salary">Expected Salary (USD):</label>
  <input type="number" id="salary" name="salary" min="0" required>

  <label for="phone">Phone Number:</label>
  <input type="tel" id="phone" name="phone" pattern="[0-9+ ]{7,}" required>

  <label for="email">Email Address(optional):</label>
  <input type="email" id="email" name="email" >

  <label for="resume">Resume (optional):</label>
  <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">

  <button type="submit">Submit Application</button>
</form>

   <button onclick="window.location.href='index.php'">Back to Homepage</button>

  </div>
</body>
</html>
