<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $email = trim($_POST['email'] ?? '');
            $pass = $_POST['password'] ?? '';
            require_once __DIR__ . '/../models/User.php';
            $m = new User();
            $u = $m->findByEmail($email);
            if ($u && password_verify($pass,$u['password'])) {
                session_start(); $_SESSION['user_id']=$u['id'];
                header('Location: /dashboard'); exit;
            } else {
                $this->view('auth/login',['error'=>'Credenciais inválidas']);
            }
            return;
        }
        $this->view('auth/login',[]);
    }
    public function logout(){ session_start(); session_destroy(); header('Location:/'); exit; }
    public function register(){
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $email = trim($_POST['email'] ?? '');
            $pass = $_POST['password'] ?? '';
            $m = new User();
            if ($m->findByEmail($email)) { $this->view('auth/register',['error'=>'Email já cadastrado']); return; }
            $m->create(['email'=>$email,'password'=>$pass,'ip'=>$_SERVER['REMOTE_ADDR']]);
            header('Location: /login'); exit;
        }
        $this->view('auth/register',[]);
    }
}
