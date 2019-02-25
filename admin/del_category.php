<?php
  $id=$_GET["id"];
  require("../includes/dbh.inc.php");
  mysqli_query($conn,"DELETE FROM category WHERE cate_id=$id");

  header("location:list_category.php");
  exit();
?>
