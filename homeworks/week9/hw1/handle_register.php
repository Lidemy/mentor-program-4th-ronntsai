<?php
    require_once('conn.php');
    if (!empty($_POST['nickname']) && !empty($_POST['account']) && !empty($_POST['password'])) {
        $nickname = $_POST['nickname'];
        $account = $_POST['account'];
        $password = $_POST['password'];

        $sql = sprintf("SELECT 1 AS isAccountExists FROM Ronn_users WHERE account = '%s'", $account);

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (isset($row["isAccountExists"])) {
            header("Location: register.php?responseCode=1");
        }
        else {
            $sql = sprintf("INSERT INTO Ronn_users (account, password, nickname, create_time) VALUES ('%s', '%s', '%s', UNIX_TIMESTAMP());", 
                $account,
                $password,
                $nickname
            );
            
            $result = $conn->query($sql);
            
            if (!$result) {
                die($conn->error);
            }
        }
        header("Location: index.php");
    }
?>