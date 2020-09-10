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

    $sql = "SELECT category_id, category_name, FROM_UNIXTIME(create_time) AS create_time FROM Ronn_blog_category ORDER BY create_time asc LIMIT ? OFFSET ?";
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
    <h3 class="error <?php echo ($_GET['error']) ? "" : "hide" ?>">該分類還有文章，不得刪除！</h3>
      <div class="admin-posts">
      <?php 
        while($row = $result->fetch_assoc()) { 
      ?>
        <div class="admin-post">
          <div class="admin-post__title"><?php echo escape($row['category_name']); ?></div>
          <div class="admin-post__info">
            <div class="admin-post__article-time">
                <div class="admin-post__created-at"><span>建立時間: </span><?php echo escape($row['create_time']); ?></div>
            </div>
            <a class="admin-post__btn" href="edit_category.php?id=<?php echo $row['category_id']?>&name=<?php echo escape($row['category_name']); ?>">
              編輯
            </a>
            <a class="admin-post__btn delete" href="handle_delete_category.php?id=<?php echo $row['category_id']?>">
              刪除
            </a>
          </div>
        </div>
      <?php } ?>
      </div>
      <?php
          $sql = "SELECT COUNT(1) AS category_count FROM Ronn_blog_category";
          $stmt = $conn->prepare($sql);
          $result = $stmt->execute();
          if(!$result) {
              die('Error:' . $conn->error);
          }
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();
          $total_page = ceil($row['category_count']/ $limit);
      ?>
      <div class="pagination">
          <?php $index = 1; while ($index <= $total_page) {?>
              <a href="admin_category.php?page=<?php echo $index ?>">
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
