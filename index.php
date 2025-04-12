<?php

require_once 'controllers/AuthController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/OrderController.php';
require_once 'config.php';

$authController = new AuthController($pdo);
$categoryController = new CategoryController($pdo);
$productController = new ProductController();
$cartController = new CartController();
$orderController = new OrderController();
$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'register':
        $authController->register();
        break;

    case 'logout':
        $authController->logout();
        break;
    case 'category_index':
        $categoryController->index();
        break;

    case 'category_create':
        $categoryController->create();
        break;
    case 'category_edit':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $categoryController->update($id);
        } else {
            echo "Thiếu ID danh mục để chỉnh sửa!";
        }
        break;
    case 'category_delete':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            if ($id !== false) {
                $categoryController->delete($id);
            } else {
                echo "Lỗi: ID danh mục không hợp lệ.";
            }
        } else {
            echo "Lỗi: Thiếu ID danh mục.";
        }
        break;

    case 'index':
        $productController->index();
        break;
    case 'product_create':
        $productController->create();
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $productController->edit($id);
        } else {
            echo "Thiếu ID sản phẩm để chỉnh sửa!";
        }
        break;
    case 'delete':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $productController->delete($id);
        } else {
            echo "Lỗi: Thiếu ID sản phẩm để xóa!";
        }
        break;
    case 'restore':
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            if ($id !== false) {
                $productController->restore($id);
            } else {
                echo "Lỗi: ID sản phẩm không hợp lệ.";
            }
        } else {
            echo "Lỗi: Thiếu ID sản phẩm.";
        }
        break;
    case 'add_to_cart':
        $cartController->addToCart();
        break;

    case 'cart':
        $cartController->index();
        break;

    case 'remove_from_cart':
        $cartController->removeFromCart();
        break;
    case 'increase_quantity':
        $cartController->increaseQuantity();
        break;
    case 'decrease_quantity':
        $cartController->decreaseQuantity();
        break;

    case 'checkout':
        $orderController->checkout();
        break;

    case 'place_order':
        $orderController->placeOrder();
        break;

    case 'order_success':
        $orderController->orderSuccess();
        break;

    case 'order_history':
        $orderController->orderHistory();
        break;

    case 'vnpay_callback':
        $orderController->vnpayCallback();
        break;

    default:
        $authController->login();
        break;
}
