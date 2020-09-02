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
            <a class="btn" href="index.php">返回主頁</a>
        </div>
        <h1 class="board__title">Register</h1>
        <h2 class="error hide">請填寫完整註冊資訊！</h2>
        <form action="handle_register.php" class="comment__form" method="POST">
            <div class="register__box">
                <span>暱稱：</span>
                <input class="register__text nickname__text" type="text" name="nickname">
            </div>
            <div class="register__box">
                <span>帳號：</span>
                <input class="register__text account__text" type="text" name="account">
            </div>
            <div class="register__box">
                <span>密碼：</span>
                <input class="register__text password__text" type="password" name="password">
            </div>
            <input type="submit" class="register__submit btn">
        </form>
    </main>
</body>
    <script src="register.js"></script>
    <script>
        const a =document.querySelector('.warning');
        const code = `<?php echo $_GET["responseCode"]; ?>`;
        if (code === '1') {
            error.innerText = '帳號已有人使用';
            error.classList.remove('hide');
        }
    </script>
</html>