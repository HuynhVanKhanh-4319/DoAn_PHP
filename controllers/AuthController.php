<?php
require_once 'models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if ($this->userModel->register($username, $password, $email)) {
                header('Location: index.php?action=login');
                exit;
            } else {
                echo "Registration failed!";
            }
        }
        require 'views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $user = $this->userModel->login($username, $password);
            if ($user) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start(); 
                }
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                
                $role = $this->userModel->getRole($user['role_id']);

                // Kiểm tra nếu có redirect_after_login
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header('Location: index.php?action=' . $redirect);
                    exit();
                }

                // Điều hướng theo quyền
                if ($role['name'] === 'admin') {
                    header('Location: views/admin.php');
                } else {
                    header('Location: views/home.php');
                }
                exit();
            } else {
                echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!');</script>";
            }
        }
        require 'views/login.php';
    }
    
    public function logout() {    
        session_start(); 
    
        session_unset();
        session_destroy();
    
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
    
        session_write_close();
    
        header('Location: index.php?action=login');
        exit();
    }
    

}
?>