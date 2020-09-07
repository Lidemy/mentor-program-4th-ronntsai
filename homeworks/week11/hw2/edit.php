<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    $account = $_SESSION['account'];
    $articleId = $_GET['id'];

    $editSql = "SELECT A.article_id, A.title, A.content, AC.category_name, FROM_UNIXTIME(A.create_time) AS create_time, FROM_UNIXTIME(A.update_time) AS update_time FROM Ronn_blog_article A
              LEFT JOIN Ronn_blog_category AC ON A.category_id = AC.category_id WHERE A.article_id = ?";
   
    $editStmt = $conn->prepare($editSql);
    $editStmt->bind_param('i', $articleId);
    $editResult = $editStmt->execute();

    if (!$editResult) {
        die($conn->error);
    }

    $editResult = $editStmt->get_result();
    $editRow = $editResult->fetch_assoc();

?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include_once('header.php'); ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_edit.php" method="POST">
          <input type="hidden" name="articleId" value="<?php echo $articleId;?>">
          <span class="edit-post__title">
            發表文章：
          </span>
          <h3 class="error hide">請撰寫完整文章之需要內容</h3 class="error">
          <div class="edit-post__input-wrapper">
            <?php include_once('category.php');?>
            <input name="title" class="edit-post__input" placeholder="請輸入文章標題" value="<?php echo escape($editRow['title'])?>" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea name="content" rows="20" class="edit-post__content"><?php echo escape($editRow['content'])?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <input class="post__btn" type='submit' value="送出" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
  <script src="edit.js"></script>
</body>
</html>