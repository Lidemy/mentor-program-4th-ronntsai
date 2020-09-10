<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    $account = NULL;
    if (!empty($_SESSION['account'])) {
        $account = $_SESSION['account'];
    }

    
    $articleId = $_GET['id'];

    $sql = "SELECT A.article_id, A.category_id, A.title, A.content, AC.category_name, FROM_UNIXTIME(A.create_time) AS create_time, FROM_UNIXTIME(A.update_time) AS update_time FROM Ronn_blog_article A
              LEFT JOIN Ronn_blog_category AC ON A.category_id = AC.category_id WHERE A.article_id = ?";
   
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $articleId);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

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
  <?php include_once('header.php')?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="posts">
      <article class="post">
        <div class="post__header">
          <div><a href="category_list.php?category_id=<?php echo $row['category_id']?>" class="category">[<?php echo escape($row['category_name']); ?>]</a> <?php echo escape($row['title']);?></div>
          <?php if ($account) {?>
            <div class="post__actions">
                <a class="post__action" href="edit.php?id=<?php echo escape($row['article_id']);?>&category_id=<?php echo $row['category_id']?>">編輯</a>
            </div>
          <?php } ?>
        </div>
        <div class="post__info"><span>建立時間: </span><?php echo escape($row['create_time']); ?></div>
        <div class="post__content"><?php echo escape($row['content']);?></div>
      </article>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>