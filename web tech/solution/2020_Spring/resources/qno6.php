<?php
session_start();
// Establish database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve the entered username and password
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user wants to remember the login session
    if (isset($_POST['remember'])) {
        // Set cookie to remember the login session for 30 days
        setcookie("username", $username, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/");
    }

    // Query to verify the user
    $query = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if the query returns any rows
    if (mysqli_num_rows($result) == 1) {
        // User is valid, create a session and redirect to homepage
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
    } else {
        // User is invalid, display an error message
        $error_message = "Invalid login credentials";
    }
}

// Close database connection
mysqli_close($conn);
?>
