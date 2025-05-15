<?php 
session_start();

if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요한 서비스입니다.');location.href='login.php';</script>";
    exit;
}
?>
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
                    <li><a><?php echo $_SESSION['username'] ?>님</a></li>
                    <li><a href="logout.php">로그아웃</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <form action="write_post_proc.php" method="post" class="write-post">
                <label>
                    제목
                    <input type="text" name="title" required>
                </label>