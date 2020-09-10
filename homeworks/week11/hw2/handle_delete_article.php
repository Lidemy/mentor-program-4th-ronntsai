<?php
    session_start();
    require_once('conn.php');
    if (!empty($_GET['id']) && !empty($_SESSION['account'])) {
        $articleId = $_GET['id'];

        $sql = "DELETE FROM Ronn_blog_article WHERE article_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $articleId);        
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: admin.php");
?>