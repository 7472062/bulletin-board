<?php
session_start();

if (isset($_SESSION['userid'])) {
    echo "<script>alert('이미 로그인되어 있습니다.');history.back();</script>";
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입 - 게시판</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="login-title"><a href="index.php">게시판</a></h1>
        <form action="register_proc.php" method="post" class="login">
            <input type="text" name="username" placeholder=" ID" required>
            <input type="password" name="password" placeholder=" PW" required>
            <input type="password" name="password_confirm" placeholder=" Re: PW" required>
            <input type="submit" value="회원가입">
        </form>
    </div>
</body>
</html>