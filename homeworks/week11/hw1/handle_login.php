<?php
    session_start();
    require_once('conn.php');

    if (empty($_POST['account']) || empty($_POST['password'])) {
        header("Location: login.php?responseCode=3");
        exit();
    }

    $account = $_POST['account'];
    $password = $_POST['password'];

    $sql = "SELECT role_id, password FROM Ronn_users WHERE account = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $account);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (!password_verify($password, $row["password"])) {
        header("Location: login.php?responseCode=1");
    }
    else {
        $_SESSION['account'] = $account;
        $_SESSION['role_id'] = $row["role_id"];
        /*
            1. create session id (token)
            2. write account to file
            3. set-cookie: session id
        */
        header("Location: index.php");
    }
?>