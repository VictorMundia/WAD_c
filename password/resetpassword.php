
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <link rel="stylesheet" href="Styles/reset.css">


</head>
<body>

<div class="container">
<form method="post" action="updatepassword.php">

    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" required>
    <label for="password">New Password:</label>
    <input type="password" name="password" id="password" required>
    <label for="confirmPassword">Confirm New Password:</label>
    <input type="password" name="confirmPassword" id="confirmPassword" required>
    <input type="submit" value="Update Password">

</form>
</div>

</body>
</html>