<?php
    require_once('conn.php');

    if (!empty($_GET['account']) && !empty($_POST['comment'])) {

        $account = $_GET['account'];
        $comment = $_POST['comment'];

        $sql = sprintf("SELECT user_id FROM Ronn_users WHERE account = '%s';", $account);
        
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$result) {
            die($conn->error);
        }
        
        $user_id = $row['user_id'];

        $sql = sprintf("INSERT INTO Ronn_comments (user_id, comment, create_time) VALUES (%d, '%s', UNIX_TIMESTAMP())", $user_id, $comment);
        
        $result = $conn->query($sql);

        if (!$result) {
            die($conn->error);
        }
    }
    
    header("Location: index.php");

?>