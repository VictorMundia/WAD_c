<?php
session_start();
include("connect.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get user ID
    $query = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    $user_id = $user['id'];

    // Get last order
    $query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY created_at DESC LIMIT 1");
    $order = mysqli_fetch_assoc($query);

    // Get order items
    $query = mysqli_query($conn, "SELECT order_items.*, events.name FROM order_items JOIN events ON order_items.event_id = events.id WHERE order_items.order_id='".$order['id']."'");
    $order_items = mysqli_fetch_all($query, MYSQLI_ASSOC);
} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Order Successful</h1>
        <p>Thank you for your purchase! Here are your order details:</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Price: <?php echo $order['total_price']; ?></p>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
