<?php
    session_start();
    require_once('conn.php');
    if (!empty($_POST['category']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['articleId']) && !empty($_SESSION['account'])) {
        $categoryId = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $articleId = $_POST['articleId'];

        $sql = "UPDATE Ronn_blog_article SET title = IF(? IS NULL, title, ?), content = IF(? IS NULL, content, ?), category_id = IF(? IS NULL, category_id, ?) WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssiii', $title, $title, $content, $content, $categoryId, $categoryId, $articleId);
        $result = $stmt->execute();
        
        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: index.php");
?>  