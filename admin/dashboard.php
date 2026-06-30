
<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: ../login.php");
    exit();
}
include("../config/db.php");

$student_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$faculty_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM faculty"));
$admin_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM admins"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CampusHub Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
body{margin:0;font-family:Segoe UI,sans-serif;background:#f4f1ea;}
.sidebar{
width:240px;height:100vh;position:fixed;
background:#3E3A36;color:white;padding:20px;
}
.sidebar h3{margin-bottom:30px;text-align:center;}
.sidebar a{
display:block;color:white;text-decoration:none;
padding:12px;border-radius:8px;margin-bottom:10px;
}
.sidebar a:hover{background:#C97B36;}
.main{margin-left:240px;padding:25px;}
.topbar{
background:white;padding:15px 25px;border-radius:12px;
display:flex;justify-content:space-between;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}
.card-box{
background:white;border-radius:15px;
padding:25px;text-align:center;
box-shadow:0 2px 12px rgba(0,0,0,.08);
transition:.3s;
}
.card-box:hover{transform:translateY(-5px);}
.icon{
font-size:42px;color:#C97B36;
}
.count{font-size:34px;font-weight:bold;color:#3E3A36;}
.title{color:#777;}
</style>
</head>
<body>

<div class="sidebar">
<h3>CampusHub</h3>

<a href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
<a href="../students.php"><i class="bi bi-mortarboard"></i> Students</a>
<a href="../faculty.php"><i class="bi bi-person-workspace"></i> Faculty</a>
<a href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="main">
<?php include("../notice.php"); ?>

<div class="topbar">
<h4>Admin Dashboard</h4>
<div>Welcome, <?php echo $_SESSION['email']; ?></div>
</div>

<div class="row mt-4 g-4">

<div class="col-md-4">
<div class="card-box">
<div class="icon"><i class="bi bi-mortarboard-fill"></i></div>
<div class="count"><?php echo $student_count; ?></div>
<div class="title">Students</div>
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="icon"><i class="bi bi-person-workspace"></i></div>
<div class="count"><?php echo $faculty_count; ?></div>
<div class="title">Faculty</div>
</div>
</div>

<div class="col-md-4">
<div class="card-box">
<div class="icon"><i class="bi bi-person-badge-fill"></i></div>
<div class="count"><?php echo $admin_count; ?></div>
<div class="title">Admins</div>
</div>
</div>

</div>

<hr class="my-5">

<div class="card-box text-start">

<h4 class="mb-3">📢 Notice Board</h4>

<form action="../save_notice.php" method="POST">

<div class="input-group mb-3">

<input
type="text"
name="notice"
class="form-control"
placeholder="Enter a notice..."
required>

<button class="btn btn-warning" type="submit">
Add Notice
</button>

</div>

</form>

<?php
$list=mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
while($n=mysqli_fetch_assoc($list)){
?>

<div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">

<span>📢 <?php echo htmlspecialchars($n['notice']); ?></span>

<a
href="../delete_notice.php?id=<?php echo $n['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this notice?')">
Delete
</a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
