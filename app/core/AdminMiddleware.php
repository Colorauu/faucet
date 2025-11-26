<?php
class AdminMiddleware {
    public static function protect() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['admin_id'])) {
            $_SESSION['admin_redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? '/admin';
            header('Location: /admin/login');
            exit;
        }
    }
    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        unset($_SESSION['admin_id'], $_SESSION['admin_username']);
        session_destroy();
    }
}
