<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = $_SESSION['email'];

// Fetch user information
$query = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($query) {
    $user = $query->fetch_assoc();
    $user_id = $user['id'];
} else {
    echo "Error: " . $conn->error;
    exit();
}

// Update user details
if (isset($_POST['update_details'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['new_email'];
    $update_query = $conn->query("UPDATE users SET username='$new_username', email='$new_email' WHERE id='$user_id'");
    if ($update_query) {
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;
        header("Location: profile_view.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Delete account
if (isset($_POST['delete_account'])) {
    $delete_query = $conn->query("DELETE FROM users WHERE id='$user_id'");
    if ($delete_query) {
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch event history
$event_query = $conn->query("SELECT events.name, events.date FROM event_history JOIN events ON event_history.event_id = events.id WHERE event_history.user_id='$user_id'");
if ($event_query) {
    $event_history = $event_query->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: " . $conn->error;
    $event_history = [];
}
?>
