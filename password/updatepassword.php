<?php
// update_password.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

if (isset($_POST['token']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password != $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Validate the token
    $sql = $conn->prepare("SELECT * FROM password_resets WHERE token = ?");
    $sql->bind_param("s", $token);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $expires = $row['expires'];

        // Check if the token has expired
        if (date("U") > $expires) {
            echo "Token has expired.";
            exit();
        }

        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Update the password in the database
        $sql = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $sql->bind_param("ss", $hashedPassword, $email);

        if ($sql->execute()) {
            // Delete the used token
            $sql = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $sql->bind_param("s", $token);
            $sql->execute();

            echo "Password has been updated.";
        } else {
            echo "Failed to update password.";
        }
    } else {
        echo "Invalid token.";
    }
}
?>
