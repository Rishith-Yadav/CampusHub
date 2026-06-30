<?php
include("config/db.php");

if(isset($_POST['add'])){
    $roll=$_POST['roll'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $department=$_POST['department'];
    $year=$_POST['year'];
    $cgpa=$_POST['cgpa'];
    $password=$_POST['password'];

    $sql="INSERT INTO students(roll_no,full_name,email,department,year,cgpa,password)
    VALUES('$roll','$name','$email','$department','$year','$cgpa','$password')";

    if(mysqli_query($conn,$sql)){
        header("Location: students.php");
        exit();
    }else{
        $error="Unable to add student.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Student</title>

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

<h2 class="mb-4"><i class="bi bi-person-plus-fill"></i> Add Student</h2>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Roll Number</label>
<input type="text" class="form-control" name="roll" required>
</div>

<div class="mb-3">
<label class="form-label">Full Name</label>
<input type="text" class="form-control" name="name" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" class="form-control" name="email" required>
</div>

<div class="mb-3">
<label class="form-label">Department</label>
<input type="text" class="form-control" name="department" required>
</div>

<div class="mb-3">
<label class="form-label">Year</label>
<input type="number" class="form-control" name="year" required>
</div>

<div class="mb-3">
<label class="form-label">CGPA</label>
<input type="number" step="0.01" class="form-control" name="cgpa" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<div class="input-group">
<input type="password" id="password" class="form-control" name="password" required>
<button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
<i class="bi bi-eye"></i>
</button>
</div>
</div>

<button class="btn btn-warm" name="add">
<i class="bi bi-plus-circle"></i> Add Student
</button>

<a href="students.php" class="btn btn-secondary">Back</a>

</form>

</div>

<script>
function togglePassword(){
const p=document.getElementById("password");
p.type=(p.type==="password")?"text":"password";
}
</script>

</body>
</html>
