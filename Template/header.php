<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
          if(isset($id)){
            require("includes/dbh.inc.php");

            $result=mysqli_query($conn, "SELECT title FROM news WHERE news_id=$id");
            $data=mysqli_fetch_assoc($result);
            echo "<title>$data[title]</title>";
          }else{
            echo "<title>Web Tin</title>";
          }
        ?>

        <link rel="stylesheet" type="text/css" href="style.css" />

    </head>

    <body>

    	<div id="top">
        <?php
          if(isset($_SESSION["username"])){
            echo "Chao mung ".$_SESSION["username"]."<a href='logout.php'>(logout)</a>";
          }else{
        	echo "<a href='login.php'>Login</a>";
          echo " | ";
          echo "<a href='register.php'>Register</a>";
          }
        ?>
        </div>
        <div id="menu">
        	<ul>
            	<li><a href="index.php">Trang chủ</a></li>
              <?php
                require("includes/dbh.inc.php");

                $result=mysqli_query($conn, "SELECT cate_id, cate_title FROM category");
                while ($data=mysqli_fetch_assoc($result)){
                  echo"<li><a href='category.php?id=$data[cate_id]'>$data[cate_title]</a></li>";
                }
              ?>

            </ul>
        </div>
        <div id="wrapper">
