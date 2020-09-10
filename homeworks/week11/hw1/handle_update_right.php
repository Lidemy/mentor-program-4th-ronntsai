<?php
    session_start();
    require_once('conn.php');

    if (empty($_SESSION['account']) || $_SESSION['role_id'] === 1) {
        header("Location: index.php?responseCode=2");
        exit();
    }

    if (empty($_GET['user_id']) || empty($_GET['role_id'])) {
        header("Location: index.php?responseCode=3");
        exit();
    }

    $user_id = $_GET['user_id'];
    $role_id = $_GET['role_id'];
    $sql = "UPDATE Ronn_users SET role_id = IF(?=2,3,2) WHERE user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $role_id, $user_id);        
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }
    header("Location: backend.php?page=" . $_GET["page"]);
?>