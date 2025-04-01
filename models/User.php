<?php
require_once 'config.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // public function register($username, $password, $email) {
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    //     $stmt = $this->pdo->prepare("INSERT INTO user (username, password, email, role_id) VALUES (?, ?, ?, ?)");
    //     return $stmt->execute([$username, $hashedPassword, $email, 2]); // Default role_id = 2 (user)
    // }
    public function register($username, $password, $email) {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $hashedPassword = ''; 
        }
        $stmt = $this->pdo->prepare("INSERT INTO user (username, password, email, role_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email, 2]);
    }
    

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start(); // Chỉ tạo session khi đăng nhập
            }
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role_id' => $user['role_id']
            ];
            return $_SESSION['user']; // Trả về thông tin user
        }
        return false;
    }
    
    public function getRole($role_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM role WHERE id = ?");
        $stmt->execute([$role_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerGoogleUser($username, $email, $avatar) {
        $stmt = $this->pdo->prepare("INSERT INTO user (username, email, avatar, role_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $avatar, 2]);
    }
    
}
?>