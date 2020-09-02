<?php
    require_once('conn.php');

    if (!empty($_GET['account']) && !empty($_POST['comment'])) {

        $account = $_GET['account'];
        $comment = $_POST['comment'];

        $sql = "SELECT user_id FROM Ronn_users WHERE account =?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);        
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$result) {
            die($conn->error);
        }
        
        $user_id = $row['user_id'];

        $sql = "INSERT INTO Ronn_comments (user_id, comment, create_time) VALUES (?, ?, UNIX_TIMESTAMP())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $user_id, $comment);        
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }
    }
    
    header("Location: index.php");

?>