<?php
    session_start();
    require_once('conn.php');
    if (!empty($_POST['account']) && !empty($_POST['password'])) {
        $account = $_POST['account'];
        $password = $_POST['password'];

        $sql = sprintf("SELECT 1 AS isLoginSuccess FROM Ronn_users WHERE account = '%s' and password = '%s'", $account, $password);

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if (!isset($row["isLoginSuccess"])) {
            header("Location: login.php?responseCode=1");
        }
        else {
            $_SESSION['account'] = $account;
            /*
                1. create session id (token)
                2. write account to file
                3. set-cookie: session id
            */
            header("Location: index.php");
        }
    }
?>