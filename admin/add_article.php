<?php
  require("templates/header.php");

  $loi=array();
  $loi["title"]=$loi["image"]=$loi["intro"]=$loi["content"]=NULL;
  $title=$image=$intro=$content=NULL;
  if(isset($_POST["ok"])){
    $cate_id=$_POST["txtcate"];

    if(empty($_POST["txttitle"])){
      $loi["title"]="* Xin nhập tiêu đề <br/>";
    }else{
      $title=$_POST["txttitle"];
    }

    if($_FILES["image"]["error"]>0){
      $loi["image"]="* Xin chọn hình ảnh <br/>";
    }else{
      $image=$_FILES["image"]["name"];
    }

    if(empty($_POST["txtintro"])){
      $loi["intro"]="* Xin nhập mô tả bài viết <br/>";
    }else{
      $intro=$_POST["txtintro"];
    }

    if(empty($_POST["txtcontent"])){
      $loi["content"]="* Xin nhập nội dung bài viết <br/>";
    }else{
      $content=$_POST["txtcontent"];
    }

    if($title && $image && $intro && $content){
      require("../includes/dbh.inc.php");

      mysqli_query($conn, "INSERT INTO news(title, image, introduce, content, cate_id) VALUES ('$title', '$image', '$intro', '$content', '$cate_id')");
      //upload hinh anh
      move_uploaded_file($_FILES["image"]["tmp_name"],"../includes/images/".$_FILES["image"]["name"]);
    }
  }
?>

<div id="wrapper2">
  <fieldset>
    <legend>Thêm bài viết</legend>
    <form action="add_article.php" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Chuyên mục</td>
          <td>
            <select name="txtcate">
              <?php
                require("../includes/dbh.inc.php");

                $result=mysqli_query($conn, "SELECT cate_id, cate_title FROM category");
                while($data=mysqli_fetch_assoc($result)){
                  echo "<option value='$data[cate_id]'>$data[cate_title]</option>";
                }
              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>Tiêu Đề</td>
          <td><input type="text" size="50" name="txttitle"/></td>
        </tr>
        <tr>
          <td>Hình Ảnh</td>
          <td><input type="file" size="25" style="padding-left:0px;" name="image"/></td>
        </tr>
        <tr>
          <td>Mô Tả</td>
          <td><textarea cols="55" rows="5" name="txtintro"></textarea></td>
        </tr>
        <tr>
          <td>Nội Dung</td>
          <td><textarea cols="55" rows="10" name="txtcontent" id="editor"></textarea></td>
        </tr>
        <script type="text/javascript">
        CKEDITOR.replace( 'txtcontent', {
          filebrowserBrowseUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/ckfinder.html',
          filebrowserImageBrowseUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/ckfinder.html?type=Images',
          filebrowserFlashBrowseUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/ckfinder.html?type=Flash',
          filebrowserUploadUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          filebrowserImageUploadUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
          filebrowserFlashUploadUrl: 'http://localhost/www/tintuc/includes/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
   } );
        </script>
        <tr>
          <td></td>
          <td><input type="submit" value="Add" name="ok"/></td>
        </tr>

      </table>
    </form>
  </fieldset>
</div>
<div style="width:290px; margin:10px auto; text-align: center;color:#F00;">
  <?php
    echo $loi["title"];
    echo $loi["image"];
    echo $loi["intro"];
    echo $loi["content"];
  ?>
</div>

<?php
  require("templates/footer.php");
?>
