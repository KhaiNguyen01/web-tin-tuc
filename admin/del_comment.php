<?php
  $id=$_GET["id"];
  require("../includes/dbh.inc.php");
  mysqli_query($conn,"DELETE FROM comment WHERE cm_id=$id");

  header("location:list_comment.php");
  exit();
?>
