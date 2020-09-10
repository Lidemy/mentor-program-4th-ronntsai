<?php
    session_start();
    require_once('conn.php');
    if (!empty($_POST['category']) && !empty($_POST['title']) && !empty($_POST['content']) && !empty($_SESSION['account'])) {
        $account = $_SESSION['account'];
        $categoryid = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "SELECT user_id FROM Ronn_blog_users WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$result) {
            die($conn->error);
        }
        
        $user_id = $row['user_id'];


        $sql = "INSERT INTO Ronn_blog_article (title, category_id, content, user_id, create_time, update_time) VALUES (?, ?, ?, ?, UNIX_TIMESTAMP(), UNIX_TIMESTAMP());";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisi', $title, $categoryid, $content, $user_id);
        $result = $stmt->execute();
        
        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: admin.php");
?>