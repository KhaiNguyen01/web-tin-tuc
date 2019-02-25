<?php
  session_start();
  require("template/header.php");

  $error=array();
  $username=$password=$email=NULL;
  $error["register"]=NULL;
  if(isset($_POST["ok"]))
  {
    $username=$_POST["txtname"];
    $password=md5($_POST["txtpass"]);
    $email=$_POST["txtmail"];

    if ($username && $password && $email){
      include_once'includes/dbh.inc.php';
      $result=mysqli_query($conn,"SELECT * FROM user WHERE user_name='$username'");
      if(mysqli_num_rows($result)==0){
      $sql="INSERT INTO user(user_name, password, email, level) values ('$username','$password','$email','1');";
      mysqli_query($conn,$sql);
      $_SESSION["username"]=$username;
      header("location:index.php");
      exit();
      }else{
        $error["register"]="Username đã tồn tại";
      }
    }
  }
?>
  <fieldset style="width:290px; height:145px; margin:140px auto 170px;">
    <legend style="margin-left:15px;">Register</legend>
    <form action="register.php" method="post">
      <table>
        <tr>
          <td>Username</td>
          <td><input type="text" size="25" name="txtname" required="required" /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" size="25" name="txtpass" required="required"/></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="email" size="25" name="txtmail" required="required"/></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Register" name="ok" /></td>
        </tr>
      </table>
    </form>
  </fieldset>
  <div style="width:290px; height170px; margin:10px auto;text-align:center;color:#F00;">
  <?php
    echo $error["register"];
  ?>
  </div>
<?php require("template/footer.php"); ?>
