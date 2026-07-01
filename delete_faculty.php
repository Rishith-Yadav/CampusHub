<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(!isset($_GET['id'])){
    die("Faculty ID missing.");
}

$id=(int)$_GET['id'];

$stmt=mysqli_prepare($conn,"DELETE FROM faculty WHERE faculty_id=?");
mysqli_stmt_bind_param($stmt,"i",$id);

if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_close($stmt);
    header("Location: faculty.php");
    exit();
}else{
    mysqli_stmt_close($stmt);
    die(mysqli_error($conn));
}
?>