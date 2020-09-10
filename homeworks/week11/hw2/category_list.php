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

    if (!empty($_GET['category_id'])) {
        $cateSql = "SELECT category_id, category_name FROM Ronn_blog_category WHERE category_id = ?";
        $cateStmt = $conn->prepare($cateSql);
        $cateStmt->bind_param('i', $_GET['category_id']);
        $cateResult = $cateStmt->execute();
        if(!$cateResult) {
            die('Error:' . $conn->error);
        }
        $cateResult = $cateStmt->get_result();        
    } else {
        $cateSql = "SELECT category_id, category_name FROM Ronn_blog_category ORDER BY category_id asc";
        $cateStmt = $conn->prepare($cateSql);
        $cateResult = $cateStmt->execute();
        if(!$cateResult) {
            die('Error:' . $conn->error);
        }
        $cateResult = $cateStmt->get_result();
    }


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
          <div class="category-list">
             <?php
                while($cateRow = $cateResult->fetch_assoc()) { 
             ?>
             <div class="category-item">
                 <?php 
                    $sql = "SELECT COUNT(1) AS article_count FROM Ronn_blog_article WHERE category_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $cateRow['category_id']);
                    $result = $stmt->execute();
                    if(!$result) {
                        die('Error:' . $conn->error);
                    }
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    if ($row['article_count'] > 0) {
                 ?>
                 <h2 class="category-name"><?php echo escape($cateRow['category_name']) ?></h2>
                 <?php }?>
                 <?php
                    $sql = "SELECT A.article_id, A.title, AC.category_name, YEAR(FROM_UNIXTIME(A.create_time)) AS year, MONTH(FROM_UNIXTIME(A.create_time)) AS month, DAY(FROM_UNIXTIME(A.create_time)) AS day, FROM_UNIXTIME(A.create_time) AS create_time, FROM_UNIXTIME(A.update_time) AS update_time FROM Ronn_blog_article A
                            LEFT JOIN Ronn_blog_category AC ON A.category_id = AC.category_id WHERE A.category_id = ? ORDER BY A.create_time desc";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('i', $cateRow['category_id']);
                    $result = $stmt->execute();
                    if(!$result) {
                        die('Error:' . $conn->error);
                    }
                    $result = $stmt->get_result();
                    while($row = $result->fetch_assoc()) { 

                 ?>
                 <div class="category-post">
                    <span class="article__date"><?php echo $row['year'] . " 年 " . $row['month'] . " 月 " . $row['day'] . " 日 " ?></span>
                    <a class="category-post__title" href="blog.php?id=<?php echo $row['article_id']?>"><?php echo escape($row['title']);?></a>
                 </div>
                 <?php } ?>
             </div>
             <?php } ?>
          </div>
      </div>
      <!-- <?php
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
      </div> -->
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>
