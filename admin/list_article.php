<?php
  require("templates/header.php");
?>

      <div id="wrapper">
        <table>
          <tr>
            <td colspan="3"></td>
            <td colspan="2"><a href="add_article.php">Thêm bài viết</a></p>
          </tr>
          <tr style="background:#0F6; color:#FFF;">
            <th>STT</th>
            <th style="width:100px;">Chuyên mục</th>
            <th>Tựa đề bài viết</th>
            <th style="width:80px;">Edit</th>
            <th style="width:80px;">Delete</th>
          </tr>
          <?php
            require("../includes/dbh.inc.php");

            $stt=1;
            $result=mysqli_query($conn, "SELECT news.news_id, news.title, category.cate_title FROM news JOIN category WHERE news.cate_id=category.cate_id ORDER BY cate_title");
            while($data=mysqli_fetch_assoc($result)){
              echo"<tr>";
                echo"<td>$stt</td>";
                echo"<td>$data[cate_title]</td>";
                echo"<td>$data[title]</td>";
                echo"<td><a href='edit_article.php?id=$data[news_id]'>Edit</a></td>";
                echo"<td><a href='del_article.php?id=$data[news_id]' onclick='return show_confirm();' style='color:#F3F;'>Delete</a></td>";
              echo"</tr>";
              $stt++;
            }
          ?>

        </table>
      </div>
      <?php
        require("templates/footer.php");
      ?>
