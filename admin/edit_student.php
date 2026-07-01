<?php
session_start();
if(!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

if(!isset($_GET['id'])){
    die("Student ID missing.");
}
$id=(int)$_GET['id'];
$stmt=mysqli_prepare($conn,"SELECT * FROM students WHERE student_id=?");
mysqli_stmt_bind_param($stmt,"i",$id);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$row=mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if(!$row){
    die("Student not found.");
}

if(isset($_POST['update'])){
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']){
        die("Invalid CSRF token.");
    }
    $roll=$_POST['roll'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $year=(int)$_POST['year'];
    $cgpa=(float)$_POST['cgpa'];

    $stmt=mysqli_prepare($conn,"UPDATE students SET
        roll_no=?, full_name=?, email=?, department=?, year=?, cgpa=?
        WHERE student_id=?");
    mysqli_stmt_bind_param($stmt,"ssssidi",$roll,$name,$email,$department,$year,$cgpa,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../students.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Student</title>
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
<h2 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Student</h2>

<form method="POST">

<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

<label class="form-label">Roll Number</label>
<input class="form-control mb-3" name="roll" value="<?php echo htmlspecialchars($row['roll_no']); ?>" required>

<label class="form-label">Full Name</label>
<input class="form-control mb-3" name="name" value="<?php echo htmlspecialchars($row['full_name']); ?>" required>

<label class="form-label">Email</label>
<input class="form-control mb-3" type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

<label class="form-label">Department</label>
<input class="form-control mb-3" name="department" value="<?php echo htmlspecialchars($row['department']); ?>" required>

<label class="form-label">Year</label>
<input class="form-control mb-3" type="number" name="year" value="<?php echo htmlspecialchars($row['year']); ?>" required>

<label class="form-label">CGPA</label>
<input class="form-control mb-3" type="number" step="0.01" name="cgpa" value="<?php echo htmlspecialchars($row['cgpa']); ?>" required>

<button class="btn btn-warm" name="update"><i class="bi bi-check-circle"></i> Update Student</button>
<a href="../students.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</body>
</html>
