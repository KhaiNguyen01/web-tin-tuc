<?php
  session_start();
  require("template/header.php");

  $id=$_GET['id'];
?>
        	<div id="left">
            <?php
              require("includes/dbh.inc.php");
              //truy van cho category
              $result=mysqli_query($conn, "SELECT cate_title FROM category WHERE cate_id=$id");
              $data=mysqli_fetch_assoc($result);

              echo"<h2 style='margin:0 10px 0 10px;border:1px solid #CCCCCC;'>$data[cate_title]</h2>";

              if(isset($_GET["begin"])){
                $position=$_GET["begin"];
              }else{
                $position = 0;
              }
              $display = 5;

              //truy van cho news
              $result2=mysqli_query($conn, "SELECT news_id, title, image, introduce FROM news WHERE cate_id=$id ORDER BY news_id desc LIMIT $position, $display");
              while($data2=mysqli_fetch_assoc($result2)){

                echo"<div class='news'>";
                  echo"<h3><a href='detail.php?id=$data2[news_id]'>$data2[title]</a></h3>";
                  echo"<img src='includes/images/$data2[image]' width='140px'; height='93px';/>";
                  echo"<p>$data2[introduce]</p>";
                  echo"<div style='clear:left;'></div>";
                echo"</div>";
              }
              ?>

              <div id="pagination">
                <?php


                  require("includes/dbh.inc.php");
                  $result3=mysqli_query($conn, "SELECT * FROM news WHERE cate_id=$id");
                  $sum_news=mysqli_num_rows($result3);

                  $sum_page=ceil($sum_news/$display);
                  if($sum_page>1){
                    echo"<ul>";
                      $current=($position/$display)+1;

                      if($current!=1){
                        $prev=$position-$display;
                        echo "<li><a href='category.php?id=$id&begin=$prev'>Prev</a></li>";
                      }
                      for($page=1; $page<=$sum_page; $page++){
                        $begin=($page-1)*$display;
                        if($page==$current){
                          echo "<li><a href='category.php?id=$id&begin=$begin' style='color:red;'>$page</a></li>";
                        }else{
                        echo "<li><a href='category.php?id=$id&begin=$begin'>$page</a></li>";
                        }
                      }
                      if($current!=$sum_page){
                        $next=$position+$display;
                        echo "<li><a href='category.php?id=$id&begin=$next'>Next</a></li>";
                      }
                      if($current!=$sum_page){
                        $end=($sum_page-1)*$display;
                        echo "<li><a href='category.php?id=$id&begin=$end'>End</a></li>";
                      }

                    echo"</ul>";
                  }
                ?>
              </div>
          </div>
<?php require("template/content_right.php"); ?>
<?php require("template/footer.php"); ?>
