<?php
require_once 'controllers/AuthController.php';
require_once 'config.php';

$authController = new AuthController($pdo);

$action = $_GET['action'] ?? 'login';

if ($action === 'register') {
    $authController->register();
} elseif ($action === 'logout') { // Thêm case xử lý logout
    $authController->logout();
} else {
    $authController->login();
}
?>
