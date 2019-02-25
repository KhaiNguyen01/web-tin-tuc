<?php
  require("templates/header.php");

  $id=$_GET["id"];

  $loi = array();
  $loi["catename"]=null;
  $catename=null;
  if(isset($_POST["ok"])){
    if(empty($_POST['txtname'])){
      $loi["catename"]= "* Xin vui lòng nhập tên chuyên mục";
    }else{
      $catename=$_POST["txtname"];
    }

    if($catename){
      require("../includes/dbh.inc.php");
      mysqli_query($conn, "UPDATE category SET cate_title='$catename' WHERE cate_id=$id");

      header("location:list_category.php");
      exit();

    }
  }
  require("../includes/dbh.inc.php");
  $result=mysqli_query($conn,"SELECT cate_title FROM category WHERE cate_id=$id");
  $data=mysqli_fetch_assoc($result);

?>

<div id="wrapper2">
  <fieldset>
    <fieldset style="width: 27px; margin: 20px auto 10px;">
      <legend>Thêm chuyên mục</legend>
      <form action="edit_category.php?id=<?php echo $id; ?>" method="post">
        <table style="margin: 10px 20px;">
          <tr style="line-height:30px;">
            <td>Name:</td>
            <td><input type="text" size="25" value="<?php echo $data['cate_title']; ?>" name="txtname" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" value="Update" name="ok"/></td>
          </tr>
      </table>
      </form>
    </fieldset>
</div>

<?php
  require("templates/footer.php");
?>
