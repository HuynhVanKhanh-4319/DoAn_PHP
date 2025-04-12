<?php
require_once __DIR__ . '/../models/Order.php';


class OrderController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function checkout() {
        // Debug session
        error_log("Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set'));
        error_log("Session cart: " . (isset($_SESSION['cart']) ? print_r($_SESSION['cart'], true) : 'not set'));

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = 'checkout';
            header('Location: index.php?action=login');
            exit();
        }

        if (empty($_SESSION['cart'])) {
            header('Location: index.php?action=cart');
            exit();
        }

        include __DIR__ . '/../views/order/checkout.php';
    }

    public function placeOrder() {
        if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
            $_SESSION['redirect_after_login'] = 'checkout';
            header('Location: index.php?action=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $note = $_POST['note'] ?? '';
            $paymentMethod = $_POST['payment_method'] ?? '';

            if (empty($name) || empty($phone) || empty($address)) {
                $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin';
                header('Location: index.php?action=checkout');
                exit();
            }

            $orderModel = new Order();
            $totalAmount = array_reduce($_SESSION['cart'], function($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            try {
                $orderId = $orderModel->create(
                    $_SESSION['user_id'],
                    $name,
                    $phone,
                    $address,
                    $note,
                    $totalAmount,
                    $_SESSION['cart']
                );

                if ($paymentMethod === 'vnpay') {
                    require_once __DIR__ . '/../controllers/vnpay_payment.php';
                    
                    $order_data = array(
                        'order_id' => $orderId,
                        'amount' => $totalAmount,
                        'order_desc' => "Thanh toán đơn hàng #" . $orderId
                    );
                    
                    $payment_url = process_vnpay_payment($order_data);
                    header('Location: ' . $payment_url);
                    exit();
                } else {
                    // Clear cart after successful order for COD
                    unset($_SESSION['cart']);
                    header('Location: index.php?action=order_success&order_id=' . $orderId);
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['error'] = 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.';
                header('Location: index.php?action=checkout');
                exit();
            }
        }
    }



    public function orderSuccess() {
        $orderId = $_GET['order_id'] ?? null;
        if (!$orderId) {
            header('Location: index.php');
            exit();
        }

        $orderModel = new Order();
        $orderDetails = $orderModel->getOrderDetails($orderId);
        
        include __DIR__ . '/../views/order/success.php';
    }

    public function orderHistory() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = 'order_history';
            header('Location: index.php?action=login');
            exit();
        }

        $orderModel = new Order();
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);
        
        include __DIR__ . '/../views/order/history.php';
    }


} 