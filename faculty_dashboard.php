<?php include("notice.php"); ?>
<?php
session_start();
if(!isset($_SESSION['faculty_id'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

$id=$_SESSION['faculty_id'];
$res=mysqli_query($conn,"SELECT * FROM faculty WHERE faculty_id='$id'");
$row=mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Faculty Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif}
.box{max-width:900px;margin:40px auto;background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
.card{border:none;box-shadow:0 2px 10px rgba(0,0,0,.08)}
.title{color:#b46b2b}
</style>
</head>
<body>
<div class="box">
<div class="d-flex justify-content-between align-items-center">
<h2 class="title"><i class="bi bi-person-workspace"></i> Faculty Dashboard</h2>
<a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>
<hr>
<div class="card">
<div class="card-body">
<h4>Welcome, <?php echo $row['full_name']; ?></h4>
<table class="table">
<tr><th>Faculty ID</th><td><?php echo $row['faculty_code']; ?></td></tr>
<tr><th>Email</th><td><?php echo $row['email']; ?></td></tr>
<tr><th>Department</th><td><?php echo $row['department']; ?></td></tr>
<tr><th>Designation</th><td><?php echo $row['designation']; ?></td></tr>
</table>
<div class="mt-3">

<a href="view_students.php" class="btn btn-warning">
<i class="bi bi-mortarboard-fill"></i>
View Students
</a>

<a href="logout.php" class="btn btn-danger">
<i class="bi bi-box-arrow-right"></i>
Logout
</a>

</div></div>
</div>
</div>
</body>
</html>