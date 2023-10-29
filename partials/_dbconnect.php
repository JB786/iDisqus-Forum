<?php
// Script to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "phpform";
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection Failed!!".mysqli_connect_error());
}

?>