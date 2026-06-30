<?php

$host = "localhost";
$user = "your_username";
$password = "your_password";
$database = "campushub";

$conn = mysqli_connect($host,$user,$password,$database);

if(!$conn){
    die("Connection failed");
}

?>