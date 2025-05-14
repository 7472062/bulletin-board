<?php
session_start();
require_once 'db_conn.php';

$input_username = $_POST['username'];
$input_password = $_POST['password'];

$query = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows) {
    $user = $result->fetch_assoc();
    if (password_verify($input_password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit;
    }
}

header("Location: login.php?error");
exit;