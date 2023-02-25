<?php
session_start();

// Database connection
$host = "localhost";
$username = "username";
$password = "password";
$database = "userdb";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get email and password from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the email and password are valid
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  // Authentication successful
  $_SESSION['email'] = $email;
  header("Location: dashboard.php");
} else {
  // Authentication failed
  echo "Invalid email or password";
}

mysqli_close($conn);
?>
