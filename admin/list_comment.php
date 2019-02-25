<?php
  require("templates/header.php");
?>

      <div id="wrapper">
        <table>

          <tr style="background:#0F6; color:#FFF;">
            <th style="width:50px;">STT</th>
            <th style="width:100px;">Username</th>
            <th>Message</th>
            <th style="width:50px;">Link</th>
            <th style="width:80px;">Duyệt</th>
            <th style="width:80px;">Delete</th>
          </tr>
          <?php
            require("../includes/dbh.inc.php");

            $stt=1;
            $result=mysqli_query($conn, "SELECT cm_id, name, message, cm_check, news_id FROM comment ORDER BY cm_id desc");
            while($data=mysqli_fetch_assoc($result)){
              echo"<tr>";
                echo"<td>$stt</td>";
                echo"<td>$data[name]</td>";
                echo"<td>$data[message]</td>";
                echo"<td><a href='http://localhost/www/tintuc/detail.php?id=$data[news_id]' target='_blank' >Xem</a></td>";
                if($data['cm_check']=='N'){
                  echo"<td><a href='edit_comment.php?id=$data[cm_id]' style='color:#93F;'>False</a></td>";
                }else {
                  echo"<td><a href='edit_comment.php?id=$data[cm_id]' style='color:#93F;'>True</a></td>";
                }
                echo"<td><a href='del_comment.php?id=$data[cm_id]' onclick='return show_confirm();' style='color:#F3F;'>Delete</a></td>";
              echo"</tr>";
              $stt++;
            }
          ?>
        </table>
      </div>
      <?php
        require("templates/footer.php");
      ?>
