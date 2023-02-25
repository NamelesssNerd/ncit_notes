<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

// Check if user logged in
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

// Get user information from database
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $email = $row['email'];

  // Display user information
  echo "Name: $name<br>";
  echo "Email: $email";
} else {
  echo "User not found";
}

mysqli_close($conn);
?>
