<?php
    session_start();
    require_once('conn.php');

    if (empty($_POST['nickname']) || empty($_POST['account']) || empty($_POST['password'])) {
        header("Location: register.php?responseCode=3");
        exit();
    }

    $nickname = $_POST['nickname'];
    $account = $_POST['account'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "SELECT 1 AS isAccountExists FROM Ronn_users WHERE account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $account);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row["isAccountExists"])) {
        header("Location: register.php?responseCode=1");
        exit();
    }
    else {
        $sql = "INSERT INTO Ronn_users (account, password, nickname, role_id, create_time) VALUES (?, ?, ?, 2, UNIX_TIMESTAMP());";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $account, $password, $nickname);
        $result = $stmt->execute();
        
        if (!$result) {
            die($conn->error);
        }
    }
    $_SESSION["account"] = $account;
    header("Location: index.php");

?>