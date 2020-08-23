<?php
    session_start();
    require_once("conn.php");

    $result = $conn->query("SELECT u.nickname, c.comment, FROM_UNIXTIME(c.create_time) AS create_time FROM Ronn_comments c
                            LEFT JOIN Ronn_users u ON u.user_id = c.user_id ORDER BY c.create_time desc");
    
    if(!$result) {
        die('Error:' . $conn->error);
    }

    $username = NULL;
    $commentCount = 0;
    if (!empty($_SESSION['account'])) {
        $account = $_SESSION['account'];
        $nicknameSql = sprintf("SELECT nickname FROM Ronn_users WHERE account = '%s'", $account);
        $nicknameResult = $conn->query($nicknameSql);
        $nicknameRow = $nicknameResult->fetch_assoc();
        $username = $nicknameRow['nickname'];

        $countSql = sprintf("SELECT COUNT(1) AS comment_count FROM Ronn_comments WHERE user_id IN (SELECT user_id FROM Ronn_users WHERE account = '%s');", $account);
        $countResult = $conn->query($countSql);
        $countRow = $countResult->fetch_assoc();
        $commentCount = $countRow['comment_count'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="warning">注意！本站為練習網站，由於教學用途刻意忽略資安操作，註冊請勿使用任何真實的帳號。</header>
    <main class="board">
        <div class="member__box">
            <?php if(!$username) { ?>
            <a class="btn" href="register.php">註冊</a>
            <a class="btn" href="login.php">登入</a>
            <?php } else {?>
            <a class="btn" href="logout.php">登出</a>
            <?php }?>
        </div>
        <h1 class="board__title">Comments</h1>
        <h2 class="error hide">請填寫完整留言資訊！</h2>
        <?php if(!$username) {?>
            <h3>請先登入發布留言</h3>
        <?php } else {?>
        <form action="add_comment.php?account=<?php echo $account?>" class="comment__form" method="POST">
            <!-- <div class="nickname__box">
                <span>暱稱：</span>
                <input class="nametext" type="text" name="name" id="">
            </div> -->
            <h3>安安 <?php echo $username?>，想說些什麼呢？</h3>
            <h4>題外話，你在本版已經留言了 <span class="highlight"><?php echo $commentCount?></span> 次</h4>
            <div class="write__comment__box">
                <textarea class="commenttext" name="comment" id="" cols="20" rows="6"></textarea>
                <input type="submit" class="comment__submit btn">
            </div>
        </form>
        <?php } ?>
        <hr class="comment__hr">
        <section>
            <?php
                while($row = $result->fetch_assoc()) {
            ?>
            <div class="card">
                <div class="card__avatar"></div>
                <div class="card__body">
                    <div class="card__info">
                        <span class="card__author"><?php echo $row['nickname']?></span>
                        <span class="card__time"><?php echo $row['create_time']?></span>
                    </div>
                    <p class="card__content"><?php echo $row['comment']?></p>
                </div>
            </div>
            <?php } ?>
        </section>
    </main>
    <script >
    </script>
</body>
</html>