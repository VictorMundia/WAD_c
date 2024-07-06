<?php 
session_start();
include("connect.php");

$query = $conn->query("SELECT * FROM events");
$events = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Styles/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel = "icon" type="image/x-icon" href="Images/EventHubpng/favicon1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>EventHub</title>
</head>
  <body >
    
  <section class="header">
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
                  <li><a class="dropdown-item" href="login.php"> Login</a></li>
                  <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                </ul>
              </li>
            </ul>
            </div>
          </div>
        </div>
      </nav>
    </section>

    <section class="background-section1">
    <div style="text-align:center; padding:15%;">
      <p  style="font-size:50px; font-weight:bold;">
       Hello  <?php 
       if(isset($_SESSION['email'])){
        $email=$_SESSION['email'];
        $query=mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
        while($row=mysqli_fetch_array($query)){
            echo $row['username'];
        }
       }
       ?>
       <br>
       Welcome to EventHub
      </p>
      <a href="logout.php">Logout</a>
    </div>
    </section>
    

      <main>
       

        
        <div class="col">
          <div class="container"></div>
        <div class="carousel-size">
          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-inteval="500" >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="Images/EventHubpng/2.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="Images/EventHubpng/3.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="Images/EventHubpng/4.png" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>


        
          </div>
            </div>
        

  <h1 class="text-center">Browse Events</h1>
<div class="container">
  <div class="row ">
   
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card ">
        <img src="Images/EventHub/tec.jpg" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Tec events</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card  border-danger custom-card">
        
        <img src="Images/EventHub/concert.jpg" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Concerts</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card ">
        <img src="Images/EventHub/night.jpg" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">NightLife</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/carmeets.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Car Meets</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/coporate.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Corporate Meetings</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/Kareoke.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Karaoke Events</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> <!-- Replace with actual event ID -->
        <button type="submit" name="add_to_cart" class="btn btn-success">Add to Cart</button>
      </form>
    </div>
      </div>
    </div>
  </div>
</div>
</div> 
<div class="container">
        <h1>Browse Events</h1>
        <div class="row">
            <?php foreach ($events as $event): ?>
            <div class="col-12 col-md-4 mb-3">
                <div class="card custom-card">
                    <img src="<?php echo $event['image']; ?>" class="card-img-top" alt="<?php echo $event['name']; ?>">
                    <div class="card-body custom-card-body">
                        <h5 class="card-title"><?php echo $event['name']; ?></h5>
                        <p class="card-text"><?php echo $event['description']; ?></p>
                        <p class="card-text">Price: $<?php echo $event['price']; ?></p>
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="1" min="1">
                            </div>
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<section class="background-section">
  <div>
    <section class="sec">
      <h1>Our Special Events</h1>
    </section>   
    <aside>
      <div>
        Our Special Events section showcases a curated selection of unique and exciting events. From music festivals and art exhibitions to <br> charity runs and networking events, we provide a diverse range of experiences to cater to all interests. These events are handpicked for their quality, uniqueness, and appeal, ensuring that our users always have access to the most exciting happenings <br> around them.
        <br>
      </div>
    </aside>  
</div>
</div>
</section>
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>About Us</h5>
        <p>EventHub is a dynamic event organizing, advertising, and social platform designed to bring people together. We provide a space for individuals to discover events near them,<br> purchase tickets, and even create and post their own events. Our platform is built on the principles of community, connection, and celebration. We believe in the power of <br>events to bring people together, create shared experiences, and foster a sense of belonging.</p>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="privacy.php">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Stay Connected</h5>
        <div class="icons">
        <ul class="list-inline social-icons">
          <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
          <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin"></i></a></li>
        </ul>
        </div>
        
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2024 EventHub. All rights reserved.</p>
        </div>
        <div class="col-md-6">
          <p class="text-end">Designed by <a href="https://yourwebsite.com">Your Company</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>


      </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>