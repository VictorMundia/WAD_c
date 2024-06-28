<?php
session_start();
include("connect.php");

if (isset($_SESSION['email']) && isset($_POST['event_id'])) {
    $email = $_SESSION['email'];
    $event_id = $_POST['event_id'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    // Get user ID
    $query = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    $user_id = $user['id'];

    // Check if the event is already in the cart
    $query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id' AND event_id='$event_id'");
    if (mysqli_num_rows($query) > 0) {
        // Update quantity if the event is already in the cart
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + '$quantity' WHERE user_id='$user_id' AND event_id='$event_id'");
    } else {
        // Insert new item into the cart
        mysqli_query($conn, "INSERT INTO cart (user_id, event_id, quantity) VALUES ('$user_id', '$event_id', '$quantity')");
    }

    header("Location: view_cart.php");
} else {
    header("Location: login.php");
}
?>
