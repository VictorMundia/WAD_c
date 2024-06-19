<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event-Detail</title>
  <link rel="stylesheet" href="Styles/eventdetails.css">
  <link rel = "icon" type="image/x-icon" href="Images/EventHubpng/favicon1.png">
</head>
<body>
  <nav class="nav">
    <a href="index.html"><img src="Images/EventHubpng/logo2.png" alt="logo" width="250px" height="50px"></a>
    <a href="events.html">Events</a>
    <a href="event-details.html">Event Details</a>
    <a href="aboutus.html">About Us</a>
    <a href="login.html">Login</a>
    <a href="signup.html">Signup</a>
  </nav>
  <div class="d">

      <h1 class="h">APPLY FOR EVENTS</h1>
      <form action="/apply" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
      
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
      
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
      
        <input type="submit" value="Apply">
      </form>
  </div>

</body>
</html>