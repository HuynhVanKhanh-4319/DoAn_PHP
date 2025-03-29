<?php
require_once 'config.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($username, $password, $email) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO user (username, password, email, role_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email, 2]); // Default role_id = 2 (user)
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getRole($role_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM role WHERE id = ?");
        $stmt->execute([$role_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>