<?php
session_start();
include("config/db.php");

if(isset($_POST['role'],$_POST['email'],$_POST['password'])){

    $role=$_POST['role'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($role=="admin"){
        $stmt=mysqli_prepare($conn,"SELECT * FROM admins WHERE email=?");
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            if(password_verify($password, $row['password'])){
                $_SESSION['role']="admin";
                $_SESSION['email']=$email;
                $_SESSION['csrf_token']=bin2hex(random_bytes(32));
                session_regenerate_id(true);
                mysqli_stmt_close($stmt);
                header("Location: admin/dashboard.php");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }

    if($role=="faculty"){
        $stmt=mysqli_prepare($conn,"SELECT * FROM faculty WHERE email=?");
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            if(password_verify($password, $row['password'])){
                $_SESSION['role']="faculty";
                $_SESSION['faculty_id']=$row['faculty_id'];
                $_SESSION['faculty_name']=$row['full_name'];
                $_SESSION['email']=$row['email'];
                $_SESSION['csrf_token']=bin2hex(random_bytes(32));
                session_regenerate_id(true);
                mysqli_stmt_close($stmt);
                header("Location: faculty_dashboard.php");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }

    if($role=="student"){
        $stmt=mysqli_prepare($conn,"SELECT * FROM students WHERE email=?");
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        $res=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res)==1){
            $row=mysqli_fetch_assoc($res);
            if(password_verify($password, $row['password'])){
                $_SESSION['role']="student";
                $_SESSION['student_id']=$row['student_id'];
                $_SESSION['student_name']=$row['full_name'];
                $_SESSION['email']=$row['email'];
                $_SESSION['csrf_token']=bin2hex(random_bytes(32));
                session_regenerate_id(true);
                mysqli_stmt_close($stmt);
                header("Location: student_dashboard.php");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
    }

    echo "<script>alert('Invalid Email, Password or Role');window.location='login.php';</script>";
}else{
    header("Location: login.php");
    exit();
}
?>