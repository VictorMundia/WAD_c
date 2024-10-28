<?php

//Define database connection details
$host="localhost";
$user="root";
$pass="";
$db="logins";

//Created a new MYSQLI connection object
$conn=new mysqli($host,$user,$pass,$db);

//Check if there was an error connecting to the database
if($conn->connect_error){

    //display error message
    echo "Failed to connect DB".$conn->connect_error;
}
?>
