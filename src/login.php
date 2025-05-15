<?php
session_start();

if (isset($_SESSION['userid'])) {
    echo "<script>alert('이미 로그인되어 있습니다.');history.back();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인 - 게시판</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="login-title"><a href="index.php">게시판</a></h1>
        <form action="login_proc.php" method="post" class="login">
            <input type="text" name="username" placeholder=" ID" required>
            <input type="password" name="password" placeholder=" PW" required>
            <?php
            if (isset($_GET['error'])) {
                echo '<p style="color: red">아이디 혹은 비밀번호가 틀렸습니다.</p>';
            }
            ?>
            <input type="submit" value="로그인">
        </form>
    </div>
</body>
</html>