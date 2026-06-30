<?php
include("config/db.php");

if(isset($_POST['notice'])){

    $notice = mysqli_real_escape_string($conn,$_POST['notice']);

    if(trim($notice)!=""){
        mysqli_query($conn,"INSERT INTO notices(notice) VALUES('$notice')");
    }

}

header("Location: admin/dashboard.php");
exit();
?>