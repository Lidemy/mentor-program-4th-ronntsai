<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <?php include_once('header.php');?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
      <div class="container">
        <h3 class="error <?php echo ($_GET['error']) ? "" : "hide" ?>">類別名稱已存在，不可重複！</h3>
          <div class="category-list">
            <form class="create_new_category" method="POST" action="handle_edit_category.php">
                <span>文章類別：</span>
                <input type="hidden" name="categoryid" value="<?php echo escape($_GET['id']) ?>">
                <input type="text" class="categorytext" name="categoryname" value="<?php echo escape($_GET['name']); ?>">
                <input type="submit" class="category__btn">
            </form>
          </div>
      </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
