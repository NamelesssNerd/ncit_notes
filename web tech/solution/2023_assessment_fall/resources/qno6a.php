<?php
// define variables and set to empty values
$username = $email = $phone = $password = $confirm_password = "";
$username_err = $email_err = $phone_err = $password_err = $confirm_password_err = "";

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // validate username
  if (empty($_POST["username"])) {
    $username_err = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
    if (strlen($username) != 8) {
      $username_err = "Username must be exactly 8 characters";
    }
  }

  // validate email
  if (empty($_POST["email"])) {
    $email_err = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format";
    }
  }

  // validate phone
  if (empty($_POST["phone"])) {
    $phone_err = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $phone_err = "Phone must be 10 digits";
    }
  }

  // validate password
  if (empty($_POST["password"])) {
    $password_err = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    if (!preg_match("/^0[0-9]{6}0$/", $password)) {
      $password_err = "Password must be 8 digits and start and end with 0";
    }
  }

  // validate confirm password
  if (empty($_POST["confirm_password"])) {
    $confirm_password_err = "Confirm password is required";
  } else {
    $confirm_password = test_input($_POST["confirm_password"]);
    if ($password !== $confirm_password) {
      $confirm_password_err = "Passwords do not match";
    }
  }

  // if there are no errors, redirect to success page
  if (empty($username_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {
    header("Location: success.php");
    exit;
  } else {
    header("Location: errors.php");
    exit;
    exit;
  }
}

// helper function to sanitize input values
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


