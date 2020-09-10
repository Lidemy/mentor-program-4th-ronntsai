<?php
    session_start();
    require_once('conn.php');
    if (!empty($_POST['categoryid']) && !empty($_POST['categoryname']) && !empty($_SESSION['account'])) {
        $categoryId = $_POST['categoryid'];
        $categoryname = $_POST['categoryname'];

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
            header("Location: edit_category.php?error=1");
            exit();
        }


        $sql = "UPDATE Ronn_blog_category SET category_name = IF(? IS NULL, category_name, ?) WHERE category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $categoryname, $categoryname, $categoryId);
        $result = $stmt->execute();
        
        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: admin_category.php");
?>  