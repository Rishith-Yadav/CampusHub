<?php
session_start();
if(!isset($_SESSION['faculty_id'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_GET['search'])){
    $s=mysqli_real_escape_string($conn,$_GET['search']);
    $result=mysqli_query($conn,"SELECT * FROM students WHERE roll_no LIKE '%$s%' OR full_name LIKE '%$s%' OR department LIKE '%$s%'");
}else{
    $result=mysqli_query($conn,"SELECT * FROM students");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>View Students</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif}
.box{max-width:1200px;margin:35px auto;background:#fff;padding:25px;border-radius:15px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
thead{background:#3E3A36;color:#fff}
</style>
</head>
<body>
<div class="box">
<div class="d-flex justify-content-between align-items-center mb-4">
<h2><i class="bi bi-mortarboard-fill"></i> Student Directory</h2>
<a href="faculty_dashboard.php" class="btn btn-secondary">Back</a>
</div>

<form method="GET" class="mb-3">
<div class="input-group">
<input class="form-control" name="search" placeholder="Search Roll No, Name or Department">
<button class="btn btn-dark">Search</button>
</div>
</form>

<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Roll No</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Year</th>
<th>CGPA</th>
<th>Attendance</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['year']; ?></td>
<td><?php echo $row['cgpa']; ?></td>
<td><?php echo $row['attendance']; ?>%</td>
<td>
<a href="edit_academic.php?id=<?php echo $row['student_id']; ?>" class="btn btn-warning btn-sm">
Update
</a>
</td></tr>
<?php } ?>
</tbody>
</table>
</div>
</body>
</html>
