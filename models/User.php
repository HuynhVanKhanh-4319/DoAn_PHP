<?php
require_once 'config.php';

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($username, $password, $email) {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            return false; // Username hoặc email đã tồn tại
        }

        // Kiểm tra password không rỗng
        if (empty($password)) {
            return false; // Password không được rỗng
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO user (username, password, email, role_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email, 2]); // Default role_id = 2 (user)
    }

    public function login($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = ? AND deleted_at IS NULL");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Trả về thông tin user
        }
        return false;
    }
    
    public function getRole($role_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM role WHERE id = ?");
        $stmt->execute([$role_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = ? AND deleted_at IS NULL");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerGoogleUser($username, $email, $avatar) {
        // Kiểm tra email đã tồn tại chưa
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser) {
            return false; // Email đã tồn tại
        }

        // Cột password là NOT NULL, cần cung cấp giá trị mặc định
        $defaultPassword = password_hash(uniqid(), PASSWORD_BCRYPT); // Tạo mật khẩu ngẫu nhiên
        $stmt = $this->pdo->prepare("INSERT INTO user (username, email, avatar, password, role_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $avatar, $defaultPassword, 2]);
    }
}
?>