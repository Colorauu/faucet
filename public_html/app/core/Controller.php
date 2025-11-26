<?php
class Controller {
    protected function view(string $view, array $data = []) {
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new Exception("View not found: $viewFile");
        }
        extract($data, EXTR_SKIP);
        require $viewFile;
    }
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}
