<?php
  session_start();

  $id=$_GET["id"];
  require("template/header.php");

  $loi=array();
  $loi["name"]=$loi["mess"]=NULL;
  $name=$mess=NULL;

  if(isset($_POST["ok"])){
    if(empty($_POST["txtname"])){
      $loi["name"]="* Xin nhập tên";
    }else{
      $name=$_POST["txtname"];
    }

    if(empty($_POST["txtmess"])){
      $loi["mess"]="* Xin nhập nội dung bình luận";
    }else{
      $mess=$_POST["txtmess"];
    }

    if($name && $mess){
      require("includes/dbh.inc.php");

      mysqli_query($conn, "INSERT INTO comment(name, message, time, cm_check, news_id) VALUES ('$name', '$mess', now(), 'N', '$id')");

      echo "<script type='text/javascript'>";
        echo "alert('Bình luận của bạn đã được gửi thành công, đang chờ kiểm duyệt')";
      echo "</script>";
    }
  }
?>

        	<div id="left">
            <div id="detail-article">
              <?php
              require("includes/dbh.inc.php");
              $result=mysqli_query($conn, "SELECT title, introduce, content, cate_id FROM news WHERE news_id=$id");
              $data=mysqli_fetch_assoc($result);

                echo"<h2>$data[title]</h2>";
                echo"<p style='font-weight: bold; color: #666;'>$data[introduce]</p>";
                echo"<p>$data[content]</p>";
              ?>
            </div>
            <div id="other-articles">
              <?php
                require("includes/dbh.inc.php");
                $result2=mysqli_query($conn, "SELECT title, news_id FROM news WHERE cate_id=$data[cate_id] AND news_id<$id ORDER BY news_id desc LIMIT 3");

                  echo"<p>Các bài viết khác</p>";
                  echo"<ul>";
                  while($data2=mysqli_fetch_assoc($result2)){
                    echo"<li><a href='detail.php?id=$data2[news_id]'>$data2[title]</a></li>";
                  }
                  echo"</ul>";

              ?>
            </div>
            <div id="comment">
              <fieldset>
                <legend>Bình luận</legend>
                <form action="detail.php?id=<?php echo $id; ?>" method="post">
                  <table>
                    <tr>
                      <td>Tên</td>
                      <td><input type="text" size="25" name="txtname" value="<?php echo $loi['name']; ?>"/></td>
                    </tr>
                    <tr>
                      <td>Nội dung</td>
                      <td><textarea cols="60" rows="5" name="txtmess"><?php echo $loi['mess']; ?></textarea></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><input type="submit" value="submit" name="ok"/></td>
                    </tr>
                  </table>
                </form>
              </fieldset>
            </div>
            <div id="show-comment">

                    <div class='comm'>
                      <img src='picture.jpg' width='60px'
                      <div class='mess'>
                        <p style='color:#09F;'>Captain<span style='color:#999;'>?????</span></p>
                      <p>Hay vl</p>
                      </div>
                      <div style='clear:left;'></div>
                    </div>


          </div>
        <div>
<?php require("template/content_right.php"); ?>
<?php
 require("template/footer.php");
?>
