<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");

    if ($_SESSION['role_id'] !== 1) {
        header("Location: index.php?responseCode=2");
        exit();
    }

    $page = 1;

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
    }

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $session_account = NULL;

    $sql = "SELECT user_id, account, nickname, role_id FROM Ronn_users WHERE role_id != 1 LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $limit, $offset);
    $result = $stmt->execute();
    if(!$result) {
        die('Error:' . $conn->error);
    }
    $result = $stmt->get_result();

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
        </div>
        <h1 class="board__title">後台管理</h1>
        <hr class="comment__hr">
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>NickName</th>
                        <th>Right</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo escape($row['account']);?></td>
                        <td><?php echo escape($row['nickname']);?></td>
                        <td>
                            <a class='rightBtn <?php echo escape($row['role_id']) === '2' ? "" : "rightBlock"?>' href='handle_update_right.php?user_id=<?php echo $row['user_id'] ?>&role_id=<?php echo $row['role_id'];?>&page=<?php echo $page ?>'>
                                <?php echo escape($row['role_id']) === '2' ? "正常使用" : "已停權" ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php
                $sql = "SELECT COUNT(1) AS user_count FROM Ronn_users c";
                $stmt = $conn->prepare($sql);
                $result = $stmt->execute();
                if(!$result) {
                    die('Error:' . $conn->error);
                }
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $total_page = ceil($row['user_count']/ $limit);
            ?>
            <div class="pagination">
                <?php $index = 1; while ($index <= $total_page) {?>
                    <a href="backend.php?page=<?php echo $index ?>">
                        <?php echo $index?>
                    </a>
                <?php $index++; } ?>
            </div>
        </section>
    </main>
    <script src="index.js"></script>
    <script type="text/javascript">
        const code = `<?php echo $_GET["responseCode"]; ?>`;
        if (code === '1') {
            error.innerText = '你沒換暱稱被我發現了ㄛ！';
            error.classList.remove('hide');
        } else if (code === '2') {
            error.innerText = '權限不足！';
            error.classList.remove('hide');
        }
    </script>
</body>
</html>