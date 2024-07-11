<?php 
session_start();
include("connect.php");
include("header.php");

$query = $conn->query("SELECT * FROM events");
$events = $query->fetch_all(MYSQLI_ASSOC);
?>
<style>
    .sec {
  background-image: url('../Images/EventHub/coporate.avif');
  background-size: cover; /* This makes the image cover the whole section */
  background-position: center; /* This centers the image */
  height: 100vh; /* Adjust the height as needed */
  color: white; /* Adjust text color for better visibility */
  display: inline-block;
  text-align: center;
}
</style>
<body>

<section class="sec">
<div style="text-align:center; padding:15%;">
  <p style="font-size:50px; font-weight:bold;">
    Explore
    <br>
    Cooporate Events
  </p>
</div>

</section>

</body>
</html>