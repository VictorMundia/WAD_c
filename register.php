<?php
// Start the PHP session
session_start();

// Include the database connection file
include 'connect.php';

// Handle user registration
if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password using MD5

    // Check if the email address already exists in the database
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users(username, firstName, lastName, email, password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: ". $conn->error;
        }
    }
}

// Handle user login
if (isset($_POST['signIn'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Hash the password using MD5

    // Check if the username and password match a user in the database
    $checkUser = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Invalid Username or Password!";
    }
}

// Handle updating user details
if (isset($_POST['update_details'])) {
    $username = $_SESSION['username'];
    $new_username = $_POST['username'];
    $new_email = $_POST['new_email'];

    if (empty($new_username) || empty($new_email)) {
        echo "All fields are mandatory!";
        return;
    }

    // Prepare an update query to update the user's details
    $update_query = $conn->prepare("UPDATE users SET username=?, email=? WHERE username=?");
    $update_query->bind_param("sss", $new_username, $new_email, $username);
    if ($update_query->execute()) {
        $_SESSION['username'] = $new_username;
        header("Location: index.php");
    } else {
        echo "Error updating details: ". $conn->error;
    }

    $update_query->close();
}

// Handle deleting a user account
if (isset($_POST['delete_account'])) {
    $username = $_SESSION['username'];

    // Prepare a delete query to delete the user's account
    $delete_query = $conn->prepare("DELETE FROM users WHERE username=?");
    $delete_query->bind_param("s", $username);
    if ($delete_query->execute()) {
        session_destroy();
        header("Location: index.php");
    } else {
        echo "Error deleting account: ". $conn->error;
    }

    $delete_query->close();
}
?>