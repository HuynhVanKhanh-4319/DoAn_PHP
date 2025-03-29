<?php
require_once 'controllers/AuthController.php';
require_once 'config.php';

$authController = new AuthController($pdo);

$action = $_GET['action'] ?? 'login';


if ($action === 'register') {
    $authController->register();
} else {
    $authController->login();
}
?>