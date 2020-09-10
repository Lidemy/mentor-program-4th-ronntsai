<?php
    session_start();
    require_once('conn.php');
    if (!empty($_GET['id']) && !empty($_SESSION['account'])) {
        $categoryId = $_GET['id'];

        $sql = "SELECT 1 AS isArticleExists FROM Ronn_blog_article WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $categoryId);
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (isset($row["isArticleExists"])) {
            header("Location: admin_category.php?error=1");
            exit();
        }

        $sql = "DELETE FROM Ronn_blog_category WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $categoryId);        
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: admin_category.php");
?>