<?php
session_start();

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    if(($key = array_search($event_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php");
exit;
?>
