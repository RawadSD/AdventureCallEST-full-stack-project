<?php
// Start PHP session and database connection
require_once 'includes/db.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$message = "";
$success = false;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"]);
    $age = intval($_POST["age"]);
    $guardian_name = trim($_POST["guardian_name"]);
    $guardian_phone = trim($_POST["guardian_phone"]);
    $email = trim($_POST["email"]);
    $preferred_activities = trim($_POST["preferred_activities"]);
    $medical_notes = trim($_POST["medical_notes"]);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM participants WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $message = "This email is already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO participants (full_name, age, guardian_name, guardian_phone, email, preferred_activities, medical_notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $full_name, $age, $guardian_name, $guardian_phone, $email, $preferred_activities, $medical_notes);
        if ($stmt->execute()) {
            $message = "Registration successful! A confirmation email has been sent.";
            $success = true;

            // Send confirmation email
            $subject = "Adventure Call EST Registration Confirmation";
            $body = "Dear $full_name,\n\nThank you for registering at Adventure Call EST!\nWe’re excited to have you join our summer colony.\n\nSee you soon!\nAdventure Call EST Team";
            $headers = "From: adventure.call.est@gmail.com";

            @mail($email, $subject, $body, $headers); // Suppress errors for mail()
        } else {
            $message = "Error saving registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Adventure Call EST</title>
  <link rel="stylesheet" href="assets/css/register-style.css">
</head>
<body>
  <div class="form-container">
    <h2>Participant Registration</h2>
    <?php if ($message): ?>
      <div class="<?= $success ? 'message success' : 'message error' ?>">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="register.php">
      <label>Full Name:</label>
      <input type="text" name="full_name" required>

      <label>Age:</label>
      <input type="number" name="age" min="1" required>

      <label>Guardian’s Name:</label>
      <input type="text" name="guardian_name" required>

      <label>Guardian’s Phone:</label>
      <input type="tel" name="guardian_phone" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Preferred Activities:</label>
      <textarea name="preferred_activities" rows="3" required></textarea>

      <label>Allergies / Medical Notes (optional):</label>
      <textarea name="medical_notes" rows="3"></textarea>

      <button type="submit">Submit</button>
    </form>

    <a href="index.php"><button class="secondary">Back to Homepage</button></a>
  </div>
</body>
</html>
