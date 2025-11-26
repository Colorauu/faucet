<?php
// public_html/app/controllers/AdminController.php
class AdminController extends Controller
{
    public function __construct() {
        // se a rota for admin/login ou admin/logout, não protege aqui; o App vai rotear para AdminAuthController
        // porém, para rotas admin normais, acionamos middleware
        // nothing to do here intentionally (App routes to auth when needed)
    }

    // dispatcher que o App chama: /admin  -> dispatch()
    public function dispatch($sub = 'index')
    {
        // se sub == 'login' ou 'logout', delegar para AdminAuthController
        if ($sub === 'login' || $sub === 'logout') {
            require_once __DIR__ . '/AdminAuthController.php';
            $auth = new AdminAuthController();
            if ($sub === 'login') return $auth->login();
            return $auth->logout();
        }

        // para todas as outras subrotas, proteger
        require_once __DIR__ . '/../core/AdminMiddleware.php';
        AdminMiddleware::protect();

        // agora executa a subrota
        switch ($sub) {
            case 'users':
                $this->users();
                break;
            case 'settings':
                $this->settings();
                break;
            case 'payouts':
                $this->payouts();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index()
    {
        $this->view('admin/dashboard');
    }

    public function users()
    {
        require_once __DIR__ . '/../models/Admin.php';
        $m = new Admin();
        $admins = $m->all();
        $this->view('admin/users', ['admins' => $admins]);
    }

    public function settings()
    {
        $this->view('admin/settings', []);
    }

    public function payouts()
    {
        $this->view('admin/payouts', []);
    }
}
