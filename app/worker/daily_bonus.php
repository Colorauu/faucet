<?php
require_once __DIR__ . '/../core/Database.php';
$db = Database::getConnection();
$db->query("UPDATE users SET balance = balance + 0.01 WHERE DATE(created_at) = CURDATE()"); // example
echo "daily ok";
