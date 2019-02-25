<?php
  require("templates/header.php");

  $id=$_GET["id"];

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

    if($_FILES["image"]["error"]>0){//truong hop ng dung ko chon hinh anh moi
      $image="none";
    }else{//truong hop nguoi dung chon buc hinh moi
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
      include_once("../includes/dbh.inc.php");

      if($image="none"){
        mysqli_query($conn, "UPDATE news SET cate_id='$cate_id', title='$title', introduce='$intro', content='$content' WHERE news_id=$id");
      }else{
        mysqli_query($conn, "UPDATE news SET cate_id='$cate_id', title='$title', image='$image', introduce='$intro', content='$content' WHERE news_id=$id");
        //upload llai tam hinh vao thu muc images
        move_uploaded_file($_FILES["image"]["tmp_name"],"../includes/images/".$_FILES["image"]["name"]);
      }
      header("location:list_article.php");
      exit();
    }
  }

  require("../includes/dbh.inc.php");

  $result=mysqli_query($conn, "SELECT title, image, introduce, content, cate_id FROM news WHERE news_id=$id");
  $data=mysqli_fetch_assoc($result);
?>

<div id="wrapper2">
  <fieldset>
    <legend>Chỉnh sửa bài viết</legend>
    <form action="edit_article.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Chuyên mục</td>
          <td>
            <select name="txtcate">
              <?php
                require("../includes/dbh.inc.php");

                $result2=mysqli_query($conn, "SELECT cate_id, cate_title FROM category");
                while($data2=mysqli_fetch_assoc($result2)){
                  if($data['cate_id']==$data2['cate_id']){
                    echo "<option value='$data2[cate_id]' selected='selected'>$data2[cate_title]</option>";
                  }else{
                    echo "<option value='$data2[cate_id]'>$data2[cate_title]</option>";
                  }
                }
              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>Tiêu Đề</td>
          <td><input type="text" size="50" value="<?php echo $data['title']; ?>"name="txttitle"/></td>
        </tr>
        <tr>
          <td>Hình Ảnh Cũ</td>
          <td><img src="../includes/images/<?php echo $data['image']; ?>" width="140px;"/></td>
        </tr>
        <tr>
          <td>Hình Ảnh Mới</td>
          <td><input type="file" size="25" style="padding-left:0px;" name="image"/></td>
        </tr>
        <tr>
          <td>Mô Tả</td>
          <td><textarea cols="55" rows="5" name="txtintro"><?php echo $data['introduce']; ?></textarea></td>
        </tr>
        <tr>
          <td>Nội Dung</td>
          <td><textarea cols="55" rows="10" name="txtcontent" id="editor"><?php echo $data['content']; ?></textarea></td>
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
          <td><input type="submit" value="Update" name="ok"/></td>
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
