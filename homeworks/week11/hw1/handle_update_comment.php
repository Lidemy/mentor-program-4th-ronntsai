<?php
    session_start();
    require_once('conn.php');

    if (!empty($_GET['commentid']) && !empty($_POST['comment'])) {
        $commentid = $_GET['commentid'];
        $comment = $_POST['comment'];

        $sql = "UPDATE Ronn_comments SET comment = ? WHERE comment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $comment, $commentid);        
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }
    }
    header("Location: index.php");
?>