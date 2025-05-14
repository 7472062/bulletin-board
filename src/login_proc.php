<?php
session_start();
require_once 'db_conn.php';

$input_username = $_POST['username'];
$input_password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows && password_verify($input_password, $result->fetch_assoc()['password'])) {
    $_SESSION['username'] = $input_username;

    header("Location: index.php");
    exit;
}

header("Location: login.php?error");
exit;