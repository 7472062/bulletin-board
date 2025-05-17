<?php 
session_start();
require_once 'db_conn.php';

$pid = intval($_GET['id']);

$query = "SELECT title, content, user_id FROM posts WHERE id = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("i", $pid);
$stmt->execute();
$result = $stmt->get_result();

if (!$result->num_rows) {
    echo "<script>alert('잘못된 접근');history.back();</script>";
    exit;
}

$post_data = $result->fetch_assoc();

if ($_SESSION['userid'] != $post_data['user_id'] && $_SESSION['username'] != 'admin') {
    echo "<script>alert('잘못된 접근');history.back();</script>";
    exit;
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
            <?php echo '<div class="post-button"><a href="view_post.php?id=' . $pid . '">취소</a></div>'; ?>
            <form action="edit_post_proc.php" method="post" class="edit-post">
                <input type="hidden" name="pid" value="<?php echo $pid ?>">
                <label class="title">
                    제목
                    <input type="text" name="title" value="<?php echo $post_data['title'] ?>"required>
                </label>
                <label>
                    내용
                    <textarea name="content" required><?php echo $post_data['content'] ?></textarea>
                </label>    
                <div class="form-action">
                    <input type="submit" name="action" value="수정">
                    <input type="submit" name="action" value="삭제">
                </div>
            </form>
        </main>
    </div>
</body>
</html>