<?php
  require("templates/header.php");
?>

      <div id="wrapper">
        <table>
          <tr>
            <td></td>
            <td></td>
            <td colspan="2"><a href="add_category.php">Thêm chuyên mục</a></p>
          </tr>
          <tr style="background:#0F6; color:#FFF;">
            <th style="width:100px;">STT</th>
            <th>Chuyên mục</th>
            <th style="width:100px;">Edit</th>
            <th style="width:100px;">Delete</th>
          </tr>
          <?php
            require("../includes/dbh.inc.php");

            $stt=1;
            $result=mysqli_query($conn,"SELECT cate_id, cate_title FROM category");
            while($data=mysqli_fetch_assoc($result)){
              echo"<tr>";
                echo "<td>$stt</td>";
                echo"<td>$data[cate_title]</td>";
                echo"<td><a href='edit_category.php?id=$data[cate_id]'>Edit</a></td>";
                echo"<td><a href='del_category.php?id=$data[cate_id]' onclick='return show_confirm();' style='color:#F3F;'>Delete</a></td>";
              echo"</tr>";
              $stt++;
            }
          ?>
        </table>
      </div>
      <?php
        require("templates/footer.php");
      ?>
