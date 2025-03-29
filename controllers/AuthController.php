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
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $role = $this->userModel->getRole($user['role_id']);
                if ($role['name'] === 'admin') {
                    header('Location: views/admin.php');
                } else {
                    header('Location: views/home.php');
                }
                exit;
            } else {
                echo "Invalid username or password!";
            }
        }
        require 'views/login.php';
    }
}
?>