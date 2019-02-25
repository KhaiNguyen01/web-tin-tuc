<?php
  require("templates/header.php");

  $loi = array();
  $loi["catename"]=null;
  $catename=null;
  if(isset($_POST["ok"])){
    if(empty($_POST['txtname'])){
      $loi["catename"]= "* Xin vui lòng nhập tên chuyên mục mới";
    }else{
      $catename=$_POST["txtname"];
    }

    if($catename){
      require("../includes/dbh.inc.php");
      mysqli_query($conn, "INSERT INTO category(cate_title) values ('$catename')");
    }
  }
?>
<div id="wrapper2">
  <fieldset style="width: 27px; margin: 20px auto 10px;">
    <legend>Thêm chuyên mục</legend>
    <form action="add_category.php" method="post">
      <table style="margin: 10px 20px;">
        <tr style="line-height:30px;">
          <td>Name:</td>
          <td><input type="text" size="25" name="txtname" /></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Add" name="ok" /></td>
        </tr>
    </table>
    </form>
  </fieldset>
</div>
<div style="width:290px; margin: 10px; text-align:center; color:#F00;">
  <?php
    echo $loi["catename"];
  ?>
</div>
<?php
  require("templates/footer.php");
?>
