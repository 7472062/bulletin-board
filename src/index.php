<?php 
session_start();
require_once 'db_conn.php';
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
        <main>
            <div class="post-button">
                <a href="write_post.php">글쓰기</a>
            </div>
            <table class="post-list">
                <thead>
                    <tr>
                        <th class="post-id">번호</th>
                        <th class="post-title-header">제목</th>
                        <th class="post-user">작성자</th>
                        <th class="post-date">작성일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT p.id, p.title, p.created_at, u.username 
                              FROM posts p
                              JOIN users u ON p.user_id = u.id
                              ORDER BY p.created_at DESC";
                    $result = $conn->query($query);
                    if ($result->num_rows) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='post-id'>" . $row['id'] . "</td>";
                            echo "<td class='post-title'><a href='view_post.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></td>";
                            echo "<td class='post-user'>" . $row['username'] . "</td>";
                            echo "<td class='post-date'>" . date("Y/m/d", strtotime($row['created_at'])) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center;'>등록된 게시글이 없습니다.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>