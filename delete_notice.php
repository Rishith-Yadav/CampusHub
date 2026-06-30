<?php
include("config/db.php");

if(isset($_GET['id'])){

    $id=(int)$_GET['id'];

    mysqli_query($conn,"DELETE FROM notices WHERE id=$id");

}

header("Location: admin/dashboard.php");
exit();
?>