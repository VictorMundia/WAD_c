<?php
include 'connect.php';
if(isset($_POST['signUp']))
{
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password = md5($password);
    
    $checkEmail="SELECT * FROM users where email='$email'";
    $result= $conn->query($checkEmail);
    if($result->num_rows > 0){
        echo "Email already exists";
        }
        else{
            $query = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$password')";
        }
           if(  $conn->query($insertQuery)==TRUE){
            header("Location: login.php");

           }
           else{
            echo "Error:".$query."<br>".$conn->error;
            }
        }
            if(isset($_POST['signIn']))
{
   
    $password = $_POST['password'];
    $email = $_POST['email'];
    $password = md5($password);
    
    $checkEmail="SELECT * FROM users where email='$email'and password='$password'";
$result= $conn->query($sql);
if($result->num_rows > 0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$email;
    header("Location: index.php");
    exit();
    }
    else{
        echo "Invalid email or password";
        }
    }
?>