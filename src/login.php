<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="login-title"><a href="index.php">게시판</a></h1>
        <form action="login_process.php" method="post" class="login">
            <input type="text" name="username" placeholder=" ID" required>
            <input type="password" name="password" placeholder=" PW" required>
            <input type="submit" value="로그인">
        </form>
    </div>
</body>
</html>