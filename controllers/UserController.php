<?php
require_once 'models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function updateProfile() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id']; // Lấy ID từ session
            $username = $_POST['username'];
            $email = $_POST['email'];
    
            // Xử lý avatar
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $avatarPath = 'uploads/' . basename($_FILES['avatar']['name']);
                move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarPath);
            } else {
                $avatarPath = $_SESSION['user']['avatar']; // Giữ avatar cũ nếu không upload mới
            }
    
            // Gọi model để cập nhật
            if ($this->userModel->updateProfile($userId, $username, $email, $avatarPath)) {
                // Cập nhật session
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['avatar'] = $avatarPath;
    
                header('Location: index.php?action=profile&success=1');
                exit();
            } else {
                header('Location: index.php?action=profile&error=1');
                exit();
            }
        }
    }
}
?>