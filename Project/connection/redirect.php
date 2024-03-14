<?php
session_start(); // Start the session

// Check if user is not logged in
if (!isset($_SESSION['login_user'])) {
    header("location: login.php"); // Redirect to login page
    exit();
}

// Check if login success parameter is set
if (isset($_GET['login']) && $_GET['login'] === 'success') {
    echo '<script>alert("Login successfully!!!!");</script>'; // Display alert for successful login
}
?>