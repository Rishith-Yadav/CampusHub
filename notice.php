<?php
include("config/db.php");

$result = mysqli_query($conn,"SELECT notice FROM notices ORDER BY id DESC");

$items = [];
while($row = mysqli_fetch_assoc($result)){
    $items[] = "📢 ".htmlspecialchars($row['notice'], ENT_QUOTES, 'UTF-8');
}

$text = implode(" &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; ", $items);
?>

<style>
.notice-bar{
    width:100%;
    background:#C97B36;
    color:#fff;
    padding:10px 0;
    overflow:hidden;
    white-space:nowrap;
    border-radius:8px;
    margin-bottom:20px;
    font-weight:600;
}
.notice-text{
    display:inline-block;
    padding-left:100%;
    animation:scrollNotice 20s linear infinite;
}
@keyframes scrollNotice{
    from{transform:translateX(0);}
    to{transform:translateX(-100%);}
}
</style>

<div class="notice-bar">
    <div class="notice-text">
        <?php echo $text=="" ? "📢 No notices available." : $text; ?>
    </div>
</div>
