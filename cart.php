<?php
session_start();

include("connect.php");

include ("templates/nav.php");

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
