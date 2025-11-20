<?php
$host = "localhost";
$user = "root";
$pass = ""; // Or your MySQL password
$dbname = "adventurecall";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
