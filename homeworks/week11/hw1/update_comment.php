<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    if (empty($_SESSION['account'])) {
        header("Location: index.php?responseCode=2");
        exit();
    }

    if (empty($_GET['id'])) {
        header("Location: index.php?responseCode=3");
        exit();
    }

    $account = $_SESSION['account'];
    $commentid = $_GET['id'];

    $sql = "SELECT user_id, role_id FROM Ronn_users u WHERE account = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $account);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $session_user_id = $row['user_id'];
    $session_role_id = $row['role_id'];

    $sql = "SELECT comment, user_id FROM Ronn_comments c WHERE comment_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $commentid);
    $result = $stmt->execute();

    if (!$result) {
        die($conn->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($session_user_id !== $row['user_id'] && $session_role_id !== 1) {
        header("Location: index.php?responseCode=2");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header class="warning">注意！本站為練習網站，由於教學用途刻意忽略資安操作，註冊請勿使用任何真實的帳號。</header>
    <main class="board">
        <div class="member__box">
            <a class="btn" href="index.php">返回</a>
            <form class="editUserBox hide" method="POST" action="update_username.php">
                <span>暱稱：</span>
                <input type="text" class="usernametext" name="username" id="">
                <input type="submit" class="username__submit btn">
            </form>
        </div>
        <h1 class="board__title">編輯留言</h1>
        <h2 class="error hide"></h2>
        <form action="handle_update_comment.php?commentid=<?php echo $commentid?>" class="comment__form" method="POST">
            <div class="write__comment__box">
                <textarea class="commenttext" name="comment" id="" cols="20" rows="6"><?php echo $row['comment'] ?></textarea>
                <input type="submit" class="comment__submit btn">
            </div>
        </form>
        <section>
        </section>
    </main>
    <script src="index.js"></script>
</body>
</html>