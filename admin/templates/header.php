<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Web Tin</title>

        <link rel="stylesheet" type="text/css" href="style.css" />

        <script language="javascript">
          function show_confirm(){
            if(confirm("Bạn muốn xóa dòng dữ liệu này?")){
              return true;
            }else{
              return false;
            }
          }
        </script>

        <script type="text/javascript" src="../includes/ckeditor/ckeditor.js"></script>

    </head>
    <body>
      <div id="top">
        <h3 style="color:#FFF;"> WELCOME ADMIN, <a href="../logout.php" style="color:#FFF;">(Logout)</a></h3>
      </div>
      <div id="menu">
        <ul>
          <li><a href="list_users.php">Quản lý thành viên</a></li>
          <li><a href="list_category.php">Quản lý chuyên mục</a></li>
          <li><a href="list_article.php">Quản lý bài viết</a></li>
          <li><a href="list_comment.php">Quản lý bình luận</a></li>
        </ul>
      </div>
      <div style="clear:left;"></div>
