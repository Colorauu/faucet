<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        if (empty($url[0])) {
            $this->controller = 'HomeController';
        } else {
            // admin/login/logout special
            if ($url[0] === 'admin' && isset($url[1]) && in_array($url[1], ['login','logout'])) {
                require_once __DIR__ . '/../controllers/AdminAuthController.php';
                $auth = new AdminAuthController();
                if ($url[1] === 'login') return $auth->login();
                return $auth->logout();
            }

            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                // 404
                http_response_code(404);
                echo "Página não encontrada";
                exit;
            }
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
