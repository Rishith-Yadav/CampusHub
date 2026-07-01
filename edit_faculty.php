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
$stmt=mysqli_prepare($conn,"SELECT * FROM faculty WHERE faculty_id=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if(!$row){
    die("Faculty not found.");
}

if(isset($_POST['update'])){
    $faculty_code=$_POST['faculty_code'];
    $full_name=$_POST['full_name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $designation=$_POST['designation'];
    $hashed_password=password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt=mysqli_prepare($conn,"UPDATE faculty SET
    faculty_code=?, full_name=?, email=?, department=?, designation=?, password=?
    WHERE faculty_id=?");
    mysqli_stmt_bind_param($stmt,"ssssssi",$faculty_code,$full_name,$email,$department,$designation,$hashed_password,$id);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: faculty.php");
        exit();
    }else{
        mysqli_stmt_close($stmt);
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Faculty</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif;}
.box{max-width:720px;margin:40px auto;background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 14px rgba(0,0,0,.08);}
.btn-main{background:#C97B36;color:#fff;}
.btn-main:hover{background:#b46b2b;color:#fff;}
</style>
</head>
<body>
<div class="box">
<h2 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Faculty</h2>

<form method="POST">

<label class="form-label">Faculty ID</label>
<input type="text" class="form-control mb-3" name="faculty_code" value="<?php echo $row['faculty_code']; ?>" required>

<label class="form-label">Faculty Name</label>
<input type="text" class="form-control mb-3" name="full_name" value="<?php echo $row['full_name']; ?>" required>

<label class="form-label">Email</label>
<input type="email" class="form-control mb-3" name="email" value="<?php echo $row['email']; ?>" required>

<label class="form-label">Department</label>
<input type="text" class="form-control mb-3" name="department" value="<?php echo $row['department']; ?>" required>

<label class="form-label">Designation</label>
<input type="text" class="form-control mb-3" name="designation" value="<?php echo $row['designation']; ?>" required>

<label class="form-label">Password</label>
<div class="input-group mb-4">
<input type="password" id="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" required>
<button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
<i class="bi bi-eye-slash" id="eye"></i>
</button>
</div>

<button class="btn btn-main" name="update"><i class="bi bi-check-circle"></i> Update Faculty</button>
<a href="faculty.php" class="btn btn-secondary">Cancel</a>

</form>
</div>

<script>
function togglePassword(){
let p=document.getElementById("password");
let e=document.getElementById("eye");
if(p.type==="password"){
p.type="text";
e.className="bi bi-eye";
}else{
p.type="password";
e.className="bi bi-eye-slash";
}
}
</script>
</body>
</html>
