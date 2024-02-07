<?php
// This page lets the user logout.
session_start(); // Access the existing session.
// If no session variable exists, redirect the user:
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
} else { // Cancel the session:
    $_SESSION = []; // Clear the variables.
    session_destroy(); // Destroy the session itself.
}
// Set the page title and include the HTML header:
echo "<h1>Logged Out!</h1>";
echo "<p>You are now logged out!</p>";
echo "<p><a href=index.php>Go back to the main page</a></p>";
?>