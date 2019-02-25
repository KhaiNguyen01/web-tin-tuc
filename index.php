<?php
  session_start();
  require("template/header.php");
?>
        	<div id="left">
            <?php
              require("includes/dbh.inc.php");

              $result3=mysqli_query($conn, "SELECT cate_id,cate_title FROM category");
              while($data3=mysqli_fetch_assoc($result3)){

                echo "<div class='news'>";
                    echo "<div class='category'><a href='category.php'>$data3[cate_title]</a></div>";
                    echo "<div class='article'>";
                      $result=mysqli_query($conn, "SELECT news_id,title, image, introduce FROM news WHERE cate_id=$data3[cate_id] ORDER BY news_id desc");
                      $data=mysqli_fetch_assoc($result);
                      echo "<h3><a href='detail.php?id=$data[news_id]'>$data[title]</a></h3>";
                      echo "<img src='includes/images/$data[image]' width='140px' height='93px'/>";
                      echo "<p>$data[introduce]</p>";
                    echo"</div>";
                    echo"<div class='list-article'>";
                        echo"<ul>";
                          $result2=mysqli_query($conn, "SELECT news_id,title FROM news WHERE cate_id=$data3[cate_id] ORDER BY news_id desc LIMIT 1,3");
                          while($data2=mysqli_fetch_assoc($result2)){
                            echo "<li><a href='detail.php?id=$data2[news_id]'>$data2[title]</a></li>";
                          }
                        echo"</ul>";
                    echo"</div>";
                    echo"<div style='clear:left;'></div>";
                echo"</div>";
              }
            ?>
            </div>
<?php require("template/content_right.php"); ?>
<?php require("template/footer.php"); ?>
