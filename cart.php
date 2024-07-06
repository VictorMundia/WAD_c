<?php
session_start();
include("connect.php");

// Initialize the cart if it doesn't exist
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add item to the cart
if(isset($_POST['add_to_cart'])) {
    $event_id = $_POST['event_id'];
    if(!in_array($event_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $event_id;
    }
}

// Fetch cart items
if (!empty($_SESSION['cart'])) {
    $event_ids = implode(",", $_SESSION['cart']);
    $query = $conn->query("SELECT events.id, events.name, events.price, events.image FROM events WHERE id IN ($event_ids)");
    $cart_items = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $cart_items = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Shopping Cart</title>
</head>
<body>
  <section class="header">
    <!-- Include your navbar here -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img src="Images/EventHubpng/logo2.png" alt="logo" width="250px" height="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <li class="nav-item active">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="main/aboutus.php">Browse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="shoppingcart/cart.php">Cart</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                User
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="shoppingcart/login.php">Login</a></li>
                <li><a class="dropdown-item" href="shoppingcart/signup.php">Sign Up</a></li>
                <li><a class="dropdown-item" href="main/event-details.php">Profile</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </section>

  <section class="cart">
    <div class="container">
      <h1>Your Cart</h1>
      <?php if (!empty($cart_items)): ?>
        <div class="row">
          <?php foreach ($cart_items as $item): ?>
            <div class="col-md-4">
              <div class="card mb-4">
                <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                  <p class="card-text">Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                  <!-- You can add more details here if needed -->
                  <a href="remove_from_cart.php?event_id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-danger">Remove</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
      <?php else: ?>
        <p>Your cart is empty.</p>
      <?php endif; ?>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
