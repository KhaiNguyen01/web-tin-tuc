<?php
  $id=$_GET["id"];
  require("../includes/dbh.inc.php");
  mysqli_query($conn, "DELETE FROM news WHERE news_id=$id");

  header("location:list_article.php");
  exit();
?>
