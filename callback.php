<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
require_once 'config.php';
require_once 'models/User.php';

if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $gClient->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_user = $google_oauthV2->userinfo->get();

        // Kiểm tra xem người dùng đã tồn tại trong DB chưa
        $pdo = new PDO("mysql:host=localhost;dbname=doancuoiky", "root", "");
        $userModel = new User($pdo);
        $user = $userModel->getUserByEmail($google_user['email']);

        if (!$user) {
            // Nếu chưa tồn tại, tạo tài khoản mới
            $userModel->register($google_user['name'], '', $google_user['email']);
            $user = $userModel->getUserByEmail($google_user['email']);
        }

        // Lưu thông tin user vào session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ];

        // Điều hướng người dùng
        if ($user['role_id'] == 1) {
            header("Location: views/admin.php");
        } else {
            header("Location: views/home.php");
        }
        exit();
    }
}

// Nếu có lỗi, quay lại trang login
header("Location: index.php?action=login");
exit();
?>
