<?php
session_start();
require_once 'db_conn.php';

$input_username = $_POST['username'];
$input_password = $_POST['password'];
$input_password_confirm = $_POST['password_confirm'];

if (strlen($input_username) > 16) {
    echo "<script>alert('아이디의 길이는 최대 16자입니다.');history.back();</script>";
    exit;
}

if ($input_password !== $input_password_confirm) {
    echo "<script>alert('비밀번호가 다릅니다.');history.back();</script>";
    exit;
}

$query = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows) {
    echo "<script>alert('이미 존재하는 아이디입니다.');history.back();</script>";
    exit;
}

$hashed_password = password_hash($input_password, PASSWORD_BCRYPT, ['cost' => 12]);
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);

$stmt->bind_param("ss", $input_username, $hashed_password);

if ($stmt->execute()) {
    echo "<script>alert('회원가입 성공!');location.href='index.php';</script>";
    exit;
}

echo "<script>alert('회원가입 실패ㅠ');history.back();</script>";
exit;