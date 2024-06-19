<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel = "icon" type="image/x-icon" href="Images/EventHubpng/favicon1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login-EventHub</title>
    
</head>
<body>
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
                <a class="nav-link" href="#">Cart</a>
              </li>
              <li class="nav-item dropdown">        
                <a class="nav-link dropdown-toggle" href="aboutus.html" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                  User
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="login.php"> Login</a></li>
                  <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                  <li><a class="dropdown-item" href="event-details.php">Profile</a></li>
                </ul>
              </li>
            </ul>
            </div>
          </div>
        </div>
      </nav>
    </section>
<main>
<div class="wrapper">
  <h1>Welcome</h1>
  <form method="post" action="register.php">
    <div class="input-field">
      <i class="fa fa-user-o"></i>
      <input type="email" id="email" placeholder="Username" required>
    </div>
    <div class="input-field">
      <input type="password" id="password" placeholder="Password" required>
      <i class="bx bxs-lock-alt"></i>
    </div>
    <a href="#" class="forgot">
      <p>Forgot password</p>
    </a>
    <button type="submit" class="login">Login</button>
    <p class="p">Don't have an account? <a href="signup.html" class="signup">Sign Up</a></p>
</form>
</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>