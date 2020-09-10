<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    $account = NULL;
    if (!empty($_SESSION['account'])) {
        $account = $_SESSION['account'];
    }

    $page = 1;

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT A.article_id, A.title, A.content, A.category_id, AC.category_name, FROM_UNIXTIME(A.create_time) AS create_time FROM Ronn_blog_article A
              LEFT JOIN Ronn_blog_category AC ON A.category_id = AC.category_id ORDER BY A.create_time desc LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $limit, $offset);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();

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
      <?php 
        while($row = $result->fetch_assoc()) { 
      ?>
      <article class="post">
        <div class="post__header">
          <div><a href="category_list.php?category_id=<?php echo $row['category_id']?>" class="category">[<?php echo escape($row['category_name']); ?>]</a href="#"> <?php echo escape($row['title']);?></div>
          <?php if ($account) {?>
          <div class="post__actions">
            <a class="post__action" href="edit.php?id=<?php echo $row['article_id'];?>&category_id=<?php echo $row['category_id']?>">編輯</a>
          </div>
          <?php } ?>
        </div>
        <div class="post__info">
          <?php echo escape($row['create_time'])?>
        </div>
        <div class="post__content"><?php echo mb_substr(escape($row['content']), 0, 50, 'utf8') . (strlen(escape($row['content'])) > 50 ? "..." : "")?></div>
        <a class="btn-read-more" href="blog.php?id=<?php echo $row['article_id'];?>">READ MORE</a>
      </article>
     <?php } ?>
    </div>
    <?php
        $sql = "SELECT COUNT(1) AS article_count FROM Ronn_blog_article";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        if(!$result) {
            die('Error:' . $conn->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total_page = ceil($row['article_count']/ $limit);
    ?>
    <div class="pagination index__page">
        <?php $index = 1; while ($index <= $total_page) {?>
            <a href="index.php?page=<?php echo $index ?>">
                <?php echo $index?>
            </a>
        <?php $index++; } ?>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>