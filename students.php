<?php
include("config/db.php");

if(isset($_GET['search'])){
    $search=$_GET['search'];
    $result=mysqli_query($conn,"SELECT * FROM students
    WHERE roll_no LIKE '%$search%' OR full_name LIKE '%$search%'");
}else{
    $result=mysqli_query($conn,"SELECT * FROM students");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif;}
.container-box{max-width:1200px;margin:40px auto;background:#fff;padding:25px;border-radius:15px;box-shadow:0 2px 12px rgba(0,0,0,.08);}
.table thead{background:#3E3A36;color:#fff;}
.btn-warm{background:#C97B36;color:#fff;}
.btn-warm:hover{background:#b56c2d;color:#fff;}
</style>
</head>
<body>

<div class="container-box">

<div class="d-flex justify-content-between align-items-center mb-4">
<h2><i class="bi bi-mortarboard-fill"></i> Student Management</h2>
<a href="add_student.php" class="btn btn-warm"><i class="bi bi-plus-circle"></i> Add Student</a>
</div>

<form method="GET" class="mb-3">
<div class="input-group">
<input type="text" name="search" class="form-control" placeholder="Search by Roll No or Name">
<button class="btn btn-dark">Search</button>
</div>
</form>

<table class="table table-bordered table-hover">
<thead>
<tr>
<th>ID</th>
<th>Roll No</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Year</th>
<th>CGPA</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['roll_no']; ?></td>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['department']; ?></td>
<td><?php echo $row['year']; ?></td>
<td><?php echo $row['cgpa']; ?></td>
<td>
<a class="btn btn-sm btn-warning" href="admin/edit_student.php?id=<?php echo $row['student_id'];?>"><i class="bi bi-pencil"></i></a>
<a class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')" href="admin/delete_student.php?id=<?php echo $row['student_id'];?>"><i class="bi bi-trash"></i></a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="admin/dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>

</div>

</body>
</html>
