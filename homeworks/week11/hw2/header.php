<?php
    $session_account = NULL;
    $session_role_id = NULL;

    $url = $_SERVER['REQUEST_URI'];
    $isAdminPage = (strpos($url, 'admin.php') !== false);
    $isCateAdminPage = (strpos($url, 'admin_category.php') !== false);
    $isLoginPage = (strpos($url, 'login.php') !== false);
    
    if (!empty($_SESSION['account'])) {
        $session_account = $_SESSION['account'];
        $session_sql = "SELECT user_name, role_id FROM Ronn_blog_users WHERE account = ?";
        $session_stmt = $conn->prepare($session_sql);
        $session_stmt->bind_param('s', $session_account);
        $session_result = $session_stmt->execute();
        $session_result = $session_stmt->get_result();
        $session_row = $session_result->fetch_assoc();
        $session_role_id = $session_row['role_id'];
    }

?>
<nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Ronn's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="article_list.php">文章列表</a></li>
          <li><a href="category_list.php">分類專區</a></li>
        </div>
        <div>
          <?php if (empty($isLoginPage)) { ?>
            <?php if(empty($_SESSION['account'])) {?>
                <li><a href="login.php">登入</a></li>
            <?php } else {?>
                <?php if($session_role_id === 1) { ?>
                    <?php if ($isAdminPage) { ?>
                        <li><a href="admin_category.php".php">分類管理</a></li>
                        <li><a href="new_post.php">發布文章</a></li>
                    <?php } else if ($isCateAdminPage) { ?>
                        <li><a href="add_category.php".php">新增分類</a></li>
                        <li><a href="admin.php">管理後台</a></li>
                    <?php } else { ?>
                        <li><a href="admin.php">管理後台</a></li>    
                    <?php } ?>
                <?php } ?>
                <li><a href="logout.php">登出</a></li>
            <?php } ?>
          <?php }?>
        </div>
      </ul>
    </div>
</nav>