<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_POST['add'])){
    $faculty_code = $_POST['faculty_code'];
    $full_name = $_POST['full_name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $designation=$_POST['designation'];
    $hashed_password=password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt=mysqli_prepare($conn,"INSERT INTO faculty(faculty_code,full_name,email,department,designation,password)
VALUES(?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"ssssss",$faculty_code,$full_name,$email,$department,$designation,$hashed_password);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: faculty.php");
        exit();
    }else{
        mysqli_stmt_close($stmt);
        $error="Unable to add faculty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Faculty</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif;}
.box{max-width:700px;margin:40px auto;background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 14px rgba(0,0,0,.08);}
.btn-warm{background:#C97B36;color:#fff;}
.btn-warm:hover{background:#b46b2b;color:#fff;}
</style>
</head>
<body>
<div class="box">
<h2 class="mb-4"><i class="bi bi-person-plus-fill"></i> Add Faculty</h2>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<label class="form-label">Faculty ID</label>
<input type="text" name="faculty_code" class="form-control mb-3" placeholder="FAC001" required>

<label class="form-label">Faculty Name</label>
<input type="text" name="full_name" class="form-control mb-3" required>

<label class="form-label">Email</label>
<input type="email" class="form-control mb-3" name="email" required>

<label class="form-label">Department</label>
<input class="form-control mb-3" name="department" required>

<label class="form-label">Designation</label>
<input class="form-control mb-3" name="designation" required>

<label class="form-label">Password</label>
<div class="input-group mb-4">
<input type="password" id="password" class="form-control" name="password" required>
<button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
<i class="bi bi-eye-slash" id="eyeIcon"></i>
</button>
</div>

<button class="btn btn-warm" name="add"><i class="bi bi-plus-circle"></i> Add Faculty</button>
<a href="faculty.php" class="btn btn-secondary">Back</a>

</form>
</div>

<script>
function togglePassword(){
let p=document.getElementById("password");
let i=document.getElementById("eyeIcon");
if(p.type==="password"){
 p.type="text";
 i.className="bi bi-eye";
}else{
 p.type="password";
 i.className="bi bi-eye-slash";
}
}
</script>
</body>
</html>
