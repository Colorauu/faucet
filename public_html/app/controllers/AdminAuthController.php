<?php
// public_html/app/controllers/AdminAuthController.php
class AdminAuthController extends Controller
{
    protected Admin $adminModel;

    public function __construct()
    {
        // carrega model
        require_once __DIR__ . '/../models/Admin.php';
        $this->adminModel = new Admin();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    // GET /admin/login  -> render form
    // POST /admin/login -> process login
    public function login()
    {
        // se já logado, redireciona
        if (!empty($_SESSION['admin_id'])) {
            header('Location: /admin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF check
            if (!Security::csrfCheck($_POST['csrf'] ?? '')) {
                $this->view('admin/login', ['error' => 'Token inválido (CSRF).']);
                return;
            }

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $this->view('admin/login', ['error' => 'Preencha email e senha.']);
                return;
            }

            $admin = $this->adminModel->findByEmail($email);
            if ($admin && password_verify($password, $admin['password'])) {
                // sucesso
                $_SESSION['admin_id'] = (int)$admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                // redireciona para a página solicitada antes do login (se houver)
                $redir = $_SESSION['admin_redirect_after_login'] ?? '/admin';
                unset($_SESSION['admin_redirect_after_login']);
                header('Location: ' . $redir);
                exit;
            } else {
                $this->view('admin/login', ['error' => 'Credenciais inválidas']);
                return;
            }
        }

        // GET -> mostra form
        $this->view('admin/login', []);
    }

    // GET /admin/logout
    public function logout()
    {
        AdminMiddleware::logout();
        header('Location: /admin/login');
        exit;
    }
}
