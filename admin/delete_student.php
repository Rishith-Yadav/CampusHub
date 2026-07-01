<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if(!isset($_GET['id'])){
    die("Student ID missing.");
}
$id=(int)$_GET['id'];

$stmt=mysqli_prepare($conn,"DELETE FROM students WHERE student_id=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: ../students.php");
exit();
?>