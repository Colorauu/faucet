<?php
class Database {
    private static ?PDO $pdo = null;
    public static function getConnection(): PDO {
        if (self::$pdo) return self::$pdo;
        $cfg = require __DIR__ . '/config.php';
        $db = $cfg['db'];
        $dsn = "mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}";
        try {
            self::$pdo = new PDO($dsn, $db['user'], $db['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return self::$pdo;
        } catch (PDOException $e) {
            // log and show friendly message
            file_put_contents(__DIR__ . '/../../storage/logs/db_error.log', date('c') . " - " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            throw $e;
        }
    }
}
