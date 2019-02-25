<?php
  require("templates/header.php");
?>

      <div id="wrapper">
        <table>
          <tr style="background:#0F6; color:#FFF;">
            <th>STT</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Delete</th>
          </tr>
          <?php
            //mo ket noi voi csdl
            require("../includes/dbh.inc.php");
            //thuc hien truy van
            $stt=1;
            $result=mysqli_query($conn,"SELECT user_id, user_name, email, level FROM user");
            while($data=mysqli_fetch_assoc($result)){
              echo"<tr>";
                echo "<td>$stt</td>";
                echo"<td>$data[user_name]</td>";
                echo"<td>$data[email]</td>";
                if($data['level']==1){
                  echo "<td>thành viên</td>";
                }else{
                  echo "<td>admin</td>";
                }
                echo"<td><a href='del_user.php?id=$data[user_id]' onclick='return show_confirm();' style='color:#F3F;'>Delete</a></td>";
              echo"</tr>";
              $stt++;
            }
          ?>
        </table>
      </div>
<?php
  require("templates/footer.php");
?>
