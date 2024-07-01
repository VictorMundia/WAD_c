<?php
session_start();
include("connect.php");

if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(isset($_POST['add_to_cart'])) {
    $event_id = $_POST['event_id'];
    if(!in_array($event_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $event_id;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Styles/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Shopping Cart</title>
</head>
<body>
  <section class="header">
      <!-- Include your navbar here -->
      <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
      <div class="container">
          <a class="navbar-brand" href="main/index.php"><img src="Images/EventHubpng/logo2.png" alt="logo" width="250px" height="50px"></a>
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
    <a class="nav-link " aria-current="page" href="#">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="main/aboutus.php">Browse</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="shoppingcart/cart.php">Cart</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="aboutus.html" role="button" data-bs-toggle="dropdown" aria-expanded="true">
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
      <h1>Your Shopping Cart</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Event</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total_price = 0;
          foreach($_SESSION['cart'] as $event_id) {
              $query = mysqli_query($conn, "SELECT * FROM events WHERE id='$event_id'");
              while($row = mysqli_fetch_array($query)) {
                  echo "<tr>
                          <td>{$row['name']}</td>
                          <td>{$row['price']}</td>
                          <td><a href='removefromcart.php?event_id={$event_id}' class='btn btn-danger'>Remove</a></td>
                        </tr>";
                  $total_price += $row['price'];
              }
          }
          ?>
        </tbody>
      </table>
      <h3>Total Price: <?php echo $total_price; ?></h3>
      <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
