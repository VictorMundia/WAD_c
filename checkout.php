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
    $query = mysqli_query($conn, "SELECT cart.*, events.price FROM cart JOIN events ON cart.event_id = events.id WHERE cart.user_id='$user_id'");
    $cart_items = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (count($cart_items) > 0) {
        // Calculate total price
        $total_price = 0;
        foreach ($cart_items as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        // Create order
        mysqli_query($conn, "INSERT INTO orders (user_id, total_price) VALUES ('$user_id', '$total_price')");
        $order_id = mysqli_insert_id($conn);

        // Create order items
        foreach ($cart_items as $item) {
            mysqli_query($conn, "INSERT INTO order_items (order_id, event_id, quantity) VALUES ('$order_id', '".$item['event_id']."', '".$item['quantity']."')");
        }

        // Clear the cart
        mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");

        // Redirect to a success page or order summary
        header("Location: order_success.php");
    } else {
        header("Location: view_cart.php");
    }
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Styles/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Checkout</title>
</head>
<body>
  <section class="header">
      
       <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
       <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <form class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <li class="nav-item active">
    <a class="nav-link " aria-current="page" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="aboutus.php">Browse</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="cart.php">Cart</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="aboutus.html" role="button" data-bs-toggle="dropdown" aria-expanded="true">
      User
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="login.php">Login</a></li>
      <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
      <li><a class="dropdown-item" href="event-details.php">Profile</a></li>
    </ul>
  </li>
</ul>

       </nav>
  </section>

  <section class="checkout">
    <div class="container">
      <h1>Checkout</h1>
      <form method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" name="checkout" class="btn btn-primary">Checkout</button>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
