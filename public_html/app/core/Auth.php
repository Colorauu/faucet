<?php
// /home/ironfaucet.sbs/app/core/Auth.php
class Auth {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            $cfg = require __DIR__ . '/../config.php';
            session_name($cfg['session_cookie_name'] ?? 'ironfaucet_session');
            session_start();
            // cookie params for security
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
                session_set_cookie_params(['httponly'=>true,'secure'=>true,'samesite'=>'Lax']);
            } else {
                session_set_cookie_params(['httponly'=>true,'samesite'=>'Lax']);
            }
        }
    }

    public static function loginById(int $userId) {
        self::init();
        $_SESSION['user_id'] = $userId;
        $_SESSION['logged_at'] = time();
    }

    public static function logout() {
        self::init();
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public static function userId(): ?int {
        self::init();
        return $_SESSION['user_id'] ?? null;
    }

    public static function check(): bool {
        return (self::userId() !== null);
    }
}
