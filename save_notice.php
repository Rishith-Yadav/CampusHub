<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_POST['notice'])){

    $notice = $_POST['notice'];

    if(trim($notice)!=""){
        $stmt=mysqli_prepare($conn,"INSERT INTO notices(notice) VALUES(?)");
        mysqli_stmt_bind_param($stmt,"s",$notice);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

}

header("Location: admin/dashboard.php");
exit();
?>