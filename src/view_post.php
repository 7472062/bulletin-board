<?php 
session_start();
require_once 'db_conn.php';

if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인이 필요한 서비스입니다.');location.href='login.php';</script>";
    exit;
}

$pid = intval($_GET['id']);
$is_author = false;

$query = "SELECT p.title, p.content, p.created_at, p.user_id, u.username 
          FROM posts p
          JOIN users u ON p.user_id = u.id
          WHERE p.id = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();

if (!$result->num_rows) {
    echo "<script>alert('잘못된 접근');history.back();</script>";
    exit;
}

$post_data = $result->fetch_assoc();

if ($_SESSION['userid'] == $post_data['user_id']) {
    $is_author = true;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo $post_data['title'] . " - 게시판"; ?></title>
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
            <?php
            $edit_button_class = ($is_author || $_SESSION['username'] == 'admin') ? 'post-button"' : 'post-button" style="visibility: hidden;"';
            echo '<div class="' . $edit_button_class . '>';
            echo '<a href="edit_post.php?id=' . $pid .'">수정/삭제</a>';
            echo '</div>';
            ?>
            <h2><?php echo $post_data['title']; ?></h2>
            <div class="post-info">
                <?php
                echo $post_data['username'];
                echo "  |  ";
                echo date("Y/m/d H:i:s", strtotime($post_data['created_at']));
                ?>
            </div>
            <div class="post-content"><?php echo $post_data['content']; ?></div>
        </main>
    </div>
</body>
</html>