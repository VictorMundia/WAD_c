<?php 
session_start();

//Include the database connection file
include("connect.php");

//Include the navigation template file
include("templates/nav.php");

//Query the database to recieve all elements
$query = $conn->query("SELECT * FROM events");

//Fetch all event from the database query
$events = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Styles/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="Images/EventHubpng/favicon1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>EventHub</title>
</head>
<body>

    <section class="background-section1">

<div style="text-align:center; padding:15%;">
  <p style="font-size:50px; font-weight:bold;">
    Hello 
    <br>
    Welcome to EventHub
  </p>
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
          <h5 class="card-title">Tech events</h5>
          <p class="card-text">Unleash the Future: Dive into cutting-edge technology at our tech event! From AI breakthroughs to quantum computing, join us for inspiring talks, hands-on workshops, and networking with industry experts. 🚀</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1">
        <button type="submit" name="add_to_cart" class="btn btn-success">View</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card  border-danger custom-card">  
        <img src="Images/EventHub/concert.jpg" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Concerts</h5>
          <p class="card-text">Melodic Magic: Get ready to sway, sing, and dance! Our concert series features chart-topping artists, mind-blowing light shows, and an electric atmosphere. Secure your spot for an unforgettable night of music. 🎵🎤</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1">
        <button type="submit" name="add_to_cart" class="btn btn-success">View</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card ">
        <img src="Images/EventHub/night.jpg" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">NightLife</h5>
          <p class="card-text"> When the sun sets, the party begins! Join our nightlife events for pulsating beats, neon vibes, and a crowd that knows how to groove. Whether it’s a rooftop soirée or an underground club, the night is yours. 🌙🕺
          .</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1">
        <button type="submit" name="add_to_cart" class="btn btn-success">View</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/carmeets.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Car Meets</h5>
          <p class="card-text">Rev Your Engines: Calling all gearheads! Our car meets are a paradise for petrol enthusiasts. Show off your ride, admire custom builds, and connect with fellow car lovers. From classic muscle cars to sleek imports, it’s a horsepower celebration. 🚗💨</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> 
        <button type="submit" name="add_to_cart" class="btn btn-success">View</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/coporate.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Corporate Meetings</h5>
          <p class="card-text">Business Brilliance: Elevate your professional game at our corporate meetings. Network with industry leaders, gain insights from thought-provoking keynotes, and forge partnerships that drive success. Sharpen your skills and make waves in the business world. </p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1">
        <button type="submit" name="add_to_cart" class="btn btn-success" >View</button>
      </form>
    </div>
      </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
      <div class="card border-danger custom-card">
        <img src="Images/EventHub/Kareoke.avif" class="card-img-top" alt="...">
        <div class="card-body custom-card-body">
          <h5 class="card-title">Karaoke Events</h5>
          <p class="card-text">Sing Your Heart Out: Grab the mic and unleash your inner superstar! Our karaoke events are where dreams become melodies. Belt out your favorite tunes, share the stage with friends, and revel in the applause. 🎤🌟</p>
        </div>
        <div class="btn-group my-3">
      <form method="POST" action="cart.php">
        <input type="hidden" name="event_id" value="1"> 
        <button type="submit" name="add_to_cart" class="btn btn-success">View</button>
      </form>
    </div>
      </div>
    </div>
  </div>
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
<?php include 'templates/footer.php'; ?>
