<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
include("config/db.php");

if(isset($_GET['search'])){

    $search = '%'.$_GET['search'].'%';

    $stmt = mysqli_prepare($conn,
    "SELECT * FROM faculty
    WHERE faculty_code LIKE ?
    OR full_name LIKE ?
    OR email LIKE ?
    OR department LIKE ?
    OR designation LIKE ?");
    mysqli_stmt_bind_param($stmt,"sssss",$search,$search,$search,$search,$search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

}else{

    $result = mysqli_query($conn,"SELECT * FROM faculty");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif;}
.container-box{max-width:1200px;margin:40px auto;background:#fff;padding:25px;border-radius:15px;box-shadow:0 2px 12px rgba(0,0,0,.08);}
.table thead{background:#3E3A36;color:#fff;}
.btn-warm{background:#C97B36;color:#fff;}
.btn-warm:hover{background:#b46b2b;color:#fff;}
</style>
</head>
<body>

<div class="container-box">
<div class="d-flex justify-content-between align-items-center mb-4">
<h2><i class="bi bi-person-workspace"></i> Faculty Management</h2>
<a href="add_faculty.php" class="btn btn-warm"><i class="bi bi-plus-circle"></i> Add Faculty</a>
</div>

<form method="GET" class="mb-3">
<div class="input-group">
<input type="text"
class="form-control"
name="search"
placeholder="Search by Faculty ID, Name, Email, Department or Designation"><button class="btn btn-dark">Search</button>
</div>
</form>

<table class="table table-bordered table-hover">
<thead>
<tr>
<th>ID</th>
<th>Faculty ID</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Designation</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo htmlspecialchars($row['faculty_id']); ?></td>
<td><?php echo htmlspecialchars($row['faculty_code']); ?></td>
<td><?php echo htmlspecialchars($row['full_name']); ?></td>
<td><?php echo htmlspecialchars($row['email']); ?></td>
<td><?php echo htmlspecialchars($row['department']); ?></td>
<td><?php echo htmlspecialchars($row['designation']); ?></td>
<td>
<a href="edit_faculty.php?id=<?php echo htmlspecialchars($row['faculty_id']); ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
<a href="delete_faculty.php?id=<?php echo htmlspecialchars($row['faculty_id']); ?>&token=<?php echo $_SESSION['csrf_token']; ?>" onclick="return confirm('Delete this faculty?')" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="admin/dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>

</div>

</body>
</html>
