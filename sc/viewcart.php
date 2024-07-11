<?php
session_start();
include("connect.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get user ID
    $query = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    $user_id = $user['id'];

    // Get cart items
    $query = mysqli_query($conn, "SELECT cart.*, events.name, events.price FROM cart JOIN events ON cart.event_id = events.id WHERE cart.user_id='$user_id'");
    $cart_items = mysqli_fetch_all($query, MYSQLI_ASSOC);
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="Styles/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price'] * $item['quantity']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</body>
</html>
