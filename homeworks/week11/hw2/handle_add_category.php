<?php
    session_start();
    require_once('conn.php');
    if (!empty($_POST['category']) && !empty($_SESSION['account'])) {
        $categoryname = $_POST['category'];

        $sql = "SELECT 1 AS isCategoryExists FROM Ronn_blog_category WHERE category_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $categoryname);
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (isset($row["isCategoryExists"])) {
            header("Location: add_category.php?error=1");
            exit();
        }

        $sql = "INSERT INTO Ronn_blog_category (category_name, create_time) VALUES (?, UNIX_TIMESTAMP());";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $categoryname);
        $result = $stmt->execute();
        
        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: admin_category.php");
?>