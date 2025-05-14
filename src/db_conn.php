<?php
// 데이터베이스 연결 정보
$db_host = "db";
$db_user = "user";
$db_pass = "user";
$db_name = "bulletin_board_db";

// 데이터베이스 연결
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);