<?php
session_start();
include("config/db.php");

if(isset($_POST['add'])){
    $notice=mysqli_real_escape_string($conn,$_POST['notice']);
    if(trim($notice)!=""){
        mysqli_query($conn,"INSERT INTO notices(notice) VALUES('$notice')");
    }
    header("Location: add_notice.php");
    exit();
}

if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    mysqli_query($conn,"DELETE FROM notices WHERE id=$id");
    header("Location: add_notice.php");
    exit();
}

$result=mysqli_query($conn,"SELECT * FROM notices ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Notice Board</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f4f1ea;font-family:Segoe UI,sans-serif}
.box{max-width:800px;margin:40px auto;background:#fff;padding:30px;border-radius:15px;box-shadow:0 4px 12px rgba(0,0,0,.08)}
.btn-main{background:#C97B36;color:#fff}
.btn-main:hover{background:#b46b2b;color:#fff}
</style>
</head>
<body>

<div class="box">
<h2 class="mb-4">📢 Notice Board</h2>

<form method="POST">
<label class="form-label">Notice</label>
<textarea name="notice" class="form-control" rows="3" required></textarea>
<br>
<button type="submit" name="add" class="btn btn-main">Add Notice</button>
</form>

<hr>

<h5>Latest Notices</h5>

<table class="table table-bordered">
<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td>📢 <?php echo htmlspecialchars($row['notice']); ?></td>
<td width="100">
<a class="btn btn-danger btn-sm"
onclick="return confirm('Delete this notice?')"
href="add_notice.php?delete=<?php echo $row['id']; ?>">
Delete
</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

<a href="admin/dashboard.php" class="btn btn-secondary">Back to Dashboard</a>

</div>

</body>
</html>
