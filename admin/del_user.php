<?php
  $id=$_GET["id"];
  require("../includes/dbh.inc.php");
  mysqli_query($conn,"DELETE FROM user WHERE user_id=$id");

  header("location:list_users.php");
  exit();
?>
