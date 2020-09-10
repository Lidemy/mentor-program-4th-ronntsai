<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    $session_account = NULL;
    $page = 1;

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT c.comment_id, u.nickname, u.account, c.comment, FROM_UNIXTIME(c.create_time) AS create_time FROM Ronn_comments c
              LEFT JOIN Ronn_users u ON u.user_id = c.user_id ORDER BY c.create_time desc LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $limit, $offset);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();

    $username = NULL;
    $role_id = NULL;
    $commentCount = 0;
    if (!empty($_SESSION['account'])) {
        $session_account = $_SESSION['account'];
        $nicknameSql = sprintf("SELECT nickname, role_id FROM Ronn_users WHERE account = '%s'", $session_account);
        $nicknameResult = $conn->query($nicknameSql);
        $nicknameRow = $nicknameResult->fetch_assoc();
        $username = $nicknameRow['nickname'];
        $role_id = $nicknameRow['role_id'];

        $countSql = sprintf("SELECT COUNT(1) AS comment_count FROM Ronn_comments WHERE user_id IN (SELECT user_id FROM Ronn_users WHERE account = '%s');", $session_account);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a class="btn toggleBtn" href="#">編輯暱稱</a>
            <?php if($role_id === '1') { ?>
                <a class="btn" href="backend.php">後台管理</a>
            <?php } ?>
            <form class="editUserBox hide" method="POST" action="update_username.php">
                <span>暱稱：</span>
                <input type="text" class="usernametext" name="username" id="">
                <input type="submit" class="username__submit btn">
            </form>
            <?php }?>
        </div>
        <h1 class="board__title">Comments</h1>
        <h2 class="error hide"></h2>
        <?php if(!$username) {?>
            <h3>請先登入發布留言</h3>
        <?php } else if ($role_id === '1' || $role_id === '2') {?>
        <form action="add_comment.php?account=<?php echo $session_account?>" class="comment__form" method="POST">
            <h3>安安 <?php echo escape($username)?>，想說些什麼呢？</h3>
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
                        <span class="card__author"><?php echo escape($row['nickname'] . " @(" . $row['account'] . ")")?> </span>
                        <span class="card__time"><?php echo $row['create_time']?></span>
                        <?php if ($session_account === $row['account'] || $role_id === '1') { ?> 
                            <a href="update_comment.php?id=<?php echo $row['comment_id']?>">編輯</a>
                            <a href="handle_delete_comment.php?id=<?php echo $row['comment_id']?>" class="delete__comment">刪除</a>
                        <?php } ?>
                    </div>
                    <p class="card__content"><?php echo escape($row['comment'])?></p>
                </div>
            </div>
            <?php } ?>
            <?php
                $sql = "SELECT COUNT(1) AS comment_count FROM Ronn_comments c";
                $stmt = $conn->prepare($sql);
                $result = $stmt->execute();
                if(!$result) {
                    die('Error:' . $conn->error);
                }
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $total_page = ceil($row['comment_count']/ $limit);
            ?>
            <div class="pagination">
                <?php $index = 1; while ($index <= $total_page) {?>
                    <a href="index.php?page=<?php echo $index ?>">
                        <?php echo $index?>
                    </a>
                <?php $index++; } ?>
            </div>
        </section>
    </main>
    <script src="index.js"></script>
    <script type="text/javascript">
        const code = `<?php echo escape($_GET["responseCode"]); ?>`;
        if (code === '1') {
            error.innerText = '你沒換暱稱被我發現了ㄛ！';
            error.classList.remove('hide');
        } else if (code === '2') {
            error.innerText = '權限不足！';
            error.classList.remove('hide');
        } else if (code === '3') {
            error.innerText = '資料不齊全！';
            error.classList.remove('hide');
        }
    </script>
</body>
</html>