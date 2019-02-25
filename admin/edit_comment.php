<?php
  $id=$_GET["id"];
  require("../includes/dbh.inc.php");
  $result=mysqli_query($conn,"SELECT cm_check FROM comment WHERE cm_id=$id");
  $data=mysqli_fetch_assoc($result);
  if($data["cm_check"]=='N'){
    mysqli_query($conn,"UPDATE comment SET cm_check='Y' WHERE cm_id=$id");
  }else{
    mysqli_query($conn,"UPDATE comment SET cm_check='N' WHERE cm_id=$id");
  }

  header("location:list_comment.php");
  exit();
?>
