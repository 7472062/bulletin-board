<?php session_start() ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><a href="index.php">게시판</a></h1>
            <nav class="top-nav">
                <ul>
                    <?php if (isset($_SESSION['userid'])): ?>
                        <li><a><?php echo $_SESSION['username'] ?>님</a></li>
                        <li><a href="logout.php">로그아웃</a></li>
                    <?php else: ?>    
                        <li><a href="login.php">로그인</a></li>
                        <li><a href="register.php">회원가입</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>



    </div>
</body>
</html>