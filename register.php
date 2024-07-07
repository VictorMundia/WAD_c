<?php
session_start();
include 'connect.php';

if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO users(username, firstName, lastName, email, password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $checkUser = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Invalid Username or Password!";
    }
}

if (isset($_POST['update_details'])) {
    $username = $_SESSION['username'];
    $new_username = $_POST['username'];
    $new_email = $_POST['new_email'];

    if (empty($new_username) || empty($new_email)) {
        echo "All fields are mandatory!";
        return;
    }

    $update_query = $conn->prepare("UPDATE users SET username=?, email=? WHERE username=?");
    $update_query->bind_param("sss", $new_username, $new_email, $username);
    if ($update_query->execute()) {
        $_SESSION['username'] = $new_username;
        header("Location: index.php");
    } else {
        echo "Error updating details: " . $conn->error;
    }

    $update_query->close();
}

if (isset($_POST['delete_account'])) {
    $username = $_SESSION['username'];

    $delete_query = $conn->prepare("DELETE FROM users WHERE username=?");
    $delete_query->bind_param("s", $username);
    if ($delete_query->execute()) {
        session_destroy();
        header("Location: index.php");
    } else {
        echo "Error deleting account: " . $conn->error;
    }

    $delete_query->close();
}
?>
