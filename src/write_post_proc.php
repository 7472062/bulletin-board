<?php
session_start();
require_once 'db_conn.php';

$userid = $_SESSION['userid'];
$title = $_POST['title'];
$content = $_POST['content'];

if (mb_strlen($title, 'UTF-8') > 32) {
    echo "<script>alert('제목의 길이는 최대 32자입니다.');history.back();</script>";
    exit;
}

$query = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);

$stmt->bind_param("iss", $userid, $title, $content);

if ($stmt->execute()) {
    echo "<script>location.href='index.php';</script>";
    exit;
}

echo "<script>alert('등록 실패ㅠ');history.back();</script>";
exit;