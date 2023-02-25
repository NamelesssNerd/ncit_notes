<?php
// Validate form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];

  // Form data is valid, proceed to write to file
  $time = date("D M d Y H:i:s eO");
  $content = "Name: " . $name . ", Email: " . $email . ", Contact No.: " . $contact . " Logged in on: " . $time . " using PHP\n";

  // Open the file for writing
  $file = fopen("users.txt", "a");

  // Write the content to the file
  fwrite($file, $content);

  // Close the file
  fclose($file);

  // Redirect to home page
  header("Location: home.php");
  exit();

?>
