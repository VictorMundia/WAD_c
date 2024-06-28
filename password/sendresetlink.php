<?php
// send_reset_link.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    
    // Check if the email exists in the database
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(50)); // Generate a unique token
        $expires = date("U") + 1800; // Token expires in 30 minutes

        // Insert token into database
        $sql = $conn->prepare("INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)");
        $sql->bind_param("ssi", $email, $token, $expires);
        $sql->execute();

        // Send email with reset link
        $resetLink = "http://yourdomain.com/reset_password.php?token=$token";
        $to = $email;
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "No user found with that email address.";
    }
}
?>
