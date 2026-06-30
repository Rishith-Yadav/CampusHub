<?php
include("config/db.php");

if(!isset($_GET['id'])){
    die("Faculty ID missing.");
}

$id=$_GET['id'];

$sql="DELETE FROM faculty WHERE faculty_id='$id'";

if(mysqli_query($conn,$sql)){
    header("Location: faculty.php");
    exit();
}else{
    die(mysqli_error($conn));
}
?>