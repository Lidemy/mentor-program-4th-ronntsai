<?php
    session_start();
    require_once('conn.php');
    if (!empty($_SESSION['account']) && !empty($_POST['username'])) {
        $account = $_SESSION['account'];
        $username = $_POST['username'];

        $sql = "SELECT nickname FROM Ronn_users WHERE account = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        $result = $stmt->execute();

        if (!$result) {
            die($conn->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($username === $row["nickname"]) {
            header("Location: index.php?responseCode=1");
        }
        else {
            $sql = "UPDATE Ronn_users SET nickname = ? WHERE account = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $account);
            $result = $stmt->execute();

            if (!$result) {
                die($conn->error);
            }

            header("Location: index.php");
        }
    }
?>