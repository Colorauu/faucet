<?php
class Security {
    public static function csrfToken(): string {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(16));
        return $_SESSION['_csrf'];
    }
    public static function csrfCheck(?string $token): bool {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return !empty($_SESSION['_csrf']) && hash_equals($_SESSION['_csrf'], (string)$token);
    }
    public static function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
}
