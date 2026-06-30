<?php
session_start();
include("config/db.php");

if(isset($_POST['role'],$_POST['email'],$_POST['password'])){

    $role=$_POST['role'];
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    if($role=="admin"){
        $sql="SELECT * FROM admins WHERE email='$email' AND password='$password'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1){
            $_SESSION['role']="admin";
            $_SESSION['email']=$email;
            header("Location: admin/dashboard.php");
            exit();
        }
    }

    if($role=="faculty"){
        $sql="SELECT * FROM faculty WHERE email='$email' AND password='$password'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            $_SESSION['role']="faculty";
            $_SESSION['faculty_id']=$row['faculty_id'];
            $_SESSION['faculty_name']=$row['full_name'];
            $_SESSION['email']=$row['email'];
            header("Location: faculty_dashboard.php");
            exit();
        }
    }

    if($role=="student"){
        $sql="SELECT * FROM students WHERE email='$email' AND password='$password'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            $_SESSION['role']="student";
            $_SESSION['student_id']=$row['student_id'];
            $_SESSION['student_name']=$row['full_name'];
            $_SESSION['email']=$row['email'];
            header("Location: student_dashboard.php");
            exit();
        }
    }

    echo "<script>alert('Invalid Email, Password or Role');window.location='login.php';</script>";
}else{
    header("Location: login.php");
    exit();
}
?>