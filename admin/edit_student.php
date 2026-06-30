<?php
include("../config/db.php");

$id=$_GET['id'];
$result=mysqli_query($conn,"SELECT * FROM students WHERE student_id='$id'");
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $roll=$_POST['roll'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $year=$_POST['year'];
    $cgpa=$_POST['cgpa'];

    mysqli_query($conn,"UPDATE students SET
        roll_no='$roll',
        full_name='$name',
        email='$email',
        department='$department',
        year='$year',
        cgpa='$cgpa'
        WHERE student_id='$id'");

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

<label class="form-label">Roll Number</label>
<input class="form-control mb-3" name="roll" value="<?php echo $row['roll_no']; ?>" required>

<label class="form-label">Full Name</label>
<input class="form-control mb-3" name="name" value="<?php echo $row['full_name']; ?>" required>

<label class="form-label">Email</label>
<input class="form-control mb-3" type="email" name="email" value="<?php echo $row['email']; ?>" required>

<label class="form-label">Department</label>
<input class="form-control mb-3" name="department" value="<?php echo $row['department']; ?>" required>

<label class="form-label">Year</label>
<input class="form-control mb-3" type="number" name="year" value="<?php echo $row['year']; ?>" required>

<label class="form-label">CGPA</label>
<input class="form-control mb-3" type="number" step="0.01" name="cgpa" value="<?php echo $row['cgpa']; ?>" required>

<button class="btn btn-warm" name="update"><i class="bi bi-check-circle"></i> Update Student</button>
<a href="../students.php" class="btn btn-secondary">Cancel</a>

</form>
</div>
</body>
</html>
