<?php
require_once __DIR__ . '/../models/Product.php';

class CartController
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];
        include __DIR__ . '/../views/cart/cart.php';
    }

    public function addToCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        $productModel = new Product();
        $product = $productModel->findById($productId);

        if (!$product) {
            http_response_code(404);
            echo json_encode(['error' => 'Sản phẩm không tồn tại']);
            return;
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['product_id'] == $productId) {
                $cartItem['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity
            ];
        }

        $cartCount = array_reduce($_SESSION['cart'], function ($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        echo json_encode(['cartCount' => $cartCount]);
    }

    public function removeFromCart()
    {
        session_start();

        $productId = $_GET['product_id'] ?? null;

        if ($productId !== null && isset($_SESSION['cart'])) {
            // Xóa sản phẩm khỏi giỏ hàng
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['product_id'] == $productId) {
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']); // Để tránh vấn đề với khóa mảng bị bỏ trống
                    break;
                }
            }
        }

        header('Location: index.php?action=cart');
        exit();
    }

    public function increaseQuantity()
    {
        session_start();
        $productId = $_POST['product_id'];
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] += 1;
                break;
            }
        }
        header('Location: index.php?action=cart');
    }

    public function decreaseQuantity()
    {
        session_start();
        $productId = $_POST['product_id'];
        foreach ($_SESSION['cart'] as $index => &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] -= 1;
                if ($item['quantity'] <= 0) {
                    unset($_SESSION['cart'][$index]);
                }
                break;
            }
        }
        header('Location: index.php?action=cart');
    }
}
