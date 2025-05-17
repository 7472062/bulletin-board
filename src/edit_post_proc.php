<?php
session_start();
require_once 'db_conn.php';

$pid = intval($_POST['pid']);

$query = "SELECT user_id FROM posts WHERE id = ?";
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

$title = $_POST['title'];
$content = $_POST['content'];
$action = $_POST['action'];

if ($action == "삭제") {
    $query = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $pid);

    if ($stmt->execute()) {
        echo "<script>alert('삭제 성공');location.href='index.php';</script>";
        exit;
    }

    echo "<script>alert('삭제 실패');history.back();</script>";
    exit;
} elseif ($action == "수정") {
    if (mb_strlen($title, 'UTF-8') > 32) {
        echo "<script>alert('제목의 길이는 최대 32자입니다.');history.back();</script>";
        exit;
    }

    $query = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssi", $title, $content, $pid);

    if ($stmt->execute()) {
        echo "<script>alert('수정 성공');location.href='view_post.php?id=" . $pid . "';</script>";
        exit;
    }

    echo "<script>alert('수정 실패ㅠ');history.back();</script>";
    exit;
} else {
    echo "<script>alert('잘못된 접근');history.back();</script>";
    exit;
}