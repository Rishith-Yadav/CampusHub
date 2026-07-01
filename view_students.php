<?php
session_start();
if(!isset($_SESSION['faculty_id'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_GET['search'])){
    $s='%'.$_GET['search'].'%';
    $stmt=mysqli_prepare($conn,"SELECT * FROM students WHERE roll_no LIKE ? OR full_name LIKE ? OR department LIKE ?");
    mysqli_stmt_bind_param($stmt,"sss",$s,$s,$s);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
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
<td><?php echo htmlspecialchars($row['roll_no']); ?></td>
<td><?php echo htmlspecialchars($row['full_name']); ?></td>
<td><?php echo htmlspecialchars($row['email']); ?></td>
<td><?php echo htmlspecialchars($row['department']); ?></td>
<td><?php echo htmlspecialchars($row['year']); ?></td>
<td><?php echo htmlspecialchars($row['cgpa']); ?></td>
<td><?php echo htmlspecialchars($row['attendance']); ?>%</td>
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
