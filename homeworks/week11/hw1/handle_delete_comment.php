<?php
    session_start();
    require_once('conn.php');

    if (empty($_SESSION['account'])) {
        header("Location: index.php?responseCode=2");
        exit();
    }

    if (empty($_GET['id'])) {
        header("Location: index.php?responseCode=3");
        exit();
    }
    $commentid = $_GET['id'];

    $sql = "SELECT user_id, role_id FROM Ronn_users u WHERE account = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_SESSION['account']);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $session_user_id = $row['user_id'];
    $session_role_id = $row['role_id'];

    $sql = "SELECT user_id FROM Ronn_comments c WHERE comment_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $commentid);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $comment_user_id = $row['user_id'];

    if ($comment_user_id !== $session_user_id && $session_role_id !== 1) {
        header("Location: index.php?responseCode=2");
    }

    $sql = "DELETE FROM Ronn_comments WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $commentid);        
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }
    header("Location: index.php");
?>