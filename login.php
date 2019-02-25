<?php
  session_start();
  require("template/header.php");

  $error=array();
  $username=$password=NULL;
  $error["login"]=NULL;
  if(isset($_POST["ok"]))
  {
    $username=$_POST["txtname"];
    $password=md5($_POST["txtpass"]);

    if ($username && $password){
      include_once'includes/dbh.inc.php';
      $result=mysqli_query($conn,"SELECT * FROM user WHERE user_name='$username' AND password='$password'");
      if(mysqli_num_rows($result)==1){
        $data=mysqli_fetch_assoc($result);
        $_SESSION["level"]=$data["level"];
        if($_SESSION["level"]==2){
          header("location:admin/index_admin.php");
          exit();
        }else{
        $_SESSION["username"]=$username;
        header("location:index.php");
        exit();
        }
      }else{
        $error["login"]="Nhap sai username hoac password";
      }
    }
  }

?>
  <fieldset style="width:290px; height:120px; margin:140px auto 170px;">
    <legend style="margin-left:15px;">Login</legend>
    <form action="login.php" method="post" >
      <table>
        <tr>
          <td>Username</td>
          <td><input type="text" name="txtname" size="25" required/></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="txtpass" size="25" required/></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Login" name="ok" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
  <div style="width:290px; height170px; margin:10px auto;text-align:center;color:#F00;">
    <?php
      echo $error["login"];
    ?>
  </div>
<?php require("template/footer.php"); ?>
