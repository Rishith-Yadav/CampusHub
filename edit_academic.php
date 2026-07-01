<?php
session_start();
if(!isset($_SESSION['faculty_id'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

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

// IDOR protection: ensure faculty can only edit students in their own department
$faculty_id=(int)$_SESSION['faculty_id'];
$f_stmt=mysqli_prepare($conn,"SELECT department FROM faculty WHERE faculty_id=?");
mysqli_stmt_bind_param($f_stmt,"i",$faculty_id);
mysqli_stmt_execute($f_stmt);
$f_result=mysqli_stmt_get_result($f_stmt);
$f_row=mysqli_fetch_assoc($f_result);
mysqli_stmt_close($f_stmt);

if(!$f_row || $f_row['department'] !== $row['department']){
    die("Access denied: You can only edit students in your own department.");
}

if(isset($_POST['update'])){
    $cgpa=(float)$_POST['cgpa'];
    $attendance=(float)$_POST['attendance'];

    $stmt=mysqli_prepare($conn,"UPDATE students SET
    cgpa=?, attendance=?
    WHERE student_id=?");
    mysqli_stmt_bind_param($stmt,"ddi",$cgpa,$attendance,$id);

    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        header("Location: view_students.php");
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
<title>Update Academic Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif;}
.box{max-width:700px;margin:40px auto;background:#fff;padding:30px;border-radius:15px;box-shadow:0 4px 12px rgba(0,0,0,.1);}
.btn-main{background:#C97B36;color:#fff;}
.btn-main:hover{background:#b46b2b;color:#fff;}
</style>
</head>
<body>

<div class="box">
<h2 class="mb-4">Update Academic Details</h2>

<form method="POST">

<label class="form-label">Roll Number</label>
<input class="form-control mb-3" value="<?php echo $row['roll_no']; ?>" readonly>

<label class="form-label">Student Name</label>
<input class="form-control mb-3" value="<?php echo $row['full_name']; ?>" readonly>

<label class="form-label">Department</label>
<input class="form-control mb-3" value="<?php echo $row['department']; ?>" readonly>

<label class="form-label">Current CGPA</label>
<input type="number" step="0.01" min="0" max="10" name="cgpa" class="form-control mb-3" value="<?php echo $row['cgpa']; ?>" required>

<label class="form-label">Attendance (%)</label>
<input type="number" step="0.01" min="0" max="100" name="attendance" class="form-control mb-4" value="<?php echo $row['attendance']; ?>" required>

<button class="btn btn-main" name="update">Update</button>
<a href="view_students.php" class="btn btn-secondary">Cancel</a>

</form>
</div>

</body>
</html>
