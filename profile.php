<?php
// Start the PHP session
session_start();

// Include the database connection file
include("connect.php");

// Include the navigation template file
include("templates/nav.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header("Location: login.php");
    exit();
}

// Set error reporting to display all errors and warnings
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the current user's username from the session
$username = $_SESSION['username'];

// Fetch user information from the database
$query = $conn->prepare("SELECT * FROM users WHERE username=?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

// Check if the user was found in the database
if ($result->num_rows > 0) {
    // Fetch the user's data as an  array
    $user = $result->fetch_assoc();
    // Get the user's ID (which is actually their username)
    $user_id = $user['username'];
} else {
    // If the user was not found, display an error message
    echo "Error: User not found.";
    exit();
}

// Close the database query
$query->close();
?>