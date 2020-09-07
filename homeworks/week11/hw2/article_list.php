<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    $page = 1;

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT A.article_id, A.title, A.category_id, AC.category_name, FROM_UNIXTIME(A.create_time) AS create_time, FROM_UNIXTIME(A.update_time) AS update_time FROM Ronn_blog_article A
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
      <div class="admin-posts">
      <?php 
        while($row = $result->fetch_assoc()) { 
      ?>
        <div class="admin-post">
          <span class="admin-post__title"><a class="category" href="category_list.php?category_id=<?php echo $row['category_id']?>">[<?php echo escape($row['category_name']); ?>] </a><a class="admin-post__word" href="blog.php?id=<?php echo $row['article_id']?>"><?php echo escape($row['title']);?></a></span>
          <div class="admin-post__info">
            <div class="admin-post__article-time">
                <div class="admin-post__created-at"><span>建立時間: </span><?php echo escape($row['create_time']); ?></div>
                <div class="admin-post__updated-at"><span>最後更新時間: </span><?php echo escape($row['update_time']); ?></div>
            </div>
          </div>
        </div>
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
      <div class="pagination">
          <?php $index = 1; while ($index <= $total_page) {?>
              <a href="admin.php?page=<?php echo $index ?>">
                  <?php echo $index?>
              </a>
          <?php $index++; } ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
  <script src="admin.js"></script>
</body>
</html>
