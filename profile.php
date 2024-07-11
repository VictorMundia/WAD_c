<?php
session_start();
include("connect.php");
include("templates/nav.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = $_SESSION['username'];

// Fetch user information
$query = $conn->prepare("SELECT * FROM users WHERE username=?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['username'];
} else {
    echo "Error: User not found.";
    exit();
}

$query->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="Images/EventHubpng/favicon1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>User Profile</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<main>
    <div id="updateuser" class="container mt-5">
        <h1>User Profile</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Update User Details</h5>
                <form method="POST" action="register.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="new_email" name="new_email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
                </form>
            </div>
        </div>

        <div id="deleteuser" class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Delete Account</h5>
                <form method="POST" action="register.php">
                    <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Event History</h5>
                <?php if (!empty($event_history)): ?>
                    <ul class="list-group">
                        <?php foreach ($event_history as $event): ?>
                            <li class="list-group-item"><?php echo htmlspecialchars($event['name']); ?> - <?php echo htmlspecialchars($event['date']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No events attended yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
