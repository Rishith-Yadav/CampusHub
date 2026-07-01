<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_GET['id'])){

    $id=(int)$_GET['id'];

    if(!isset($_GET['token']) || $_GET['token'] !== $_SESSION['csrf_token']){
        die("Invalid CSRF token.");
    }

    mysqli_query($conn,"DELETE FROM notices WHERE id=$id");

}

header("Location: admin/dashboard.php");
exit();
?>