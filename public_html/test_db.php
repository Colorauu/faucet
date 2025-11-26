<?php
require_once "app/core/Database.php";

$db = Database::getConnection();
$stmt = $db->query("SELECT id, username, email, password FROM admins LIMIT 1");
print_r($stmt->fetch(PDO::FETCH_ASSOC));
