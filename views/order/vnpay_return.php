<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get user_id from URL if session is lost
if (!isset($_SESSION['user_id']) && isset($_GET['user_id'])) {
    $_SESSION['user_id'] = $_GET['user_id'];
}

require_once __DIR__ . '/../../config/vnpay_config.php';
require_once __DIR__ . '/../../models/Order.php';

$vnp_SecureHash = $_GET['vnp_SecureHash'];
$vnp_TxnRef = $_GET['vnp_TxnRef'];
$vnp_Amount = $_GET['vnp_Amount'] / 100;
$vnp_ResponseCode = $_GET['vnp_ResponseCode'];
$vnp_TransactionStatus = $_GET['vnp_TransactionStatus'];
$vnp_OrderInfo = $_GET['vnp_OrderInfo'];
$vnp_BankCode = $_GET['vnp_BankCode'];
$vnp_PayDate = $_GET['vnp_PayDate'];
$vnp_BankTranNo = $_GET['vnp_BankTranNo'];
$vnp_CardType = $_GET['vnp_CardType'];

$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, VNPAY_HASH_SECRET);

if ($secureHash == $vnp_SecureHash) {
    if ($vnp_ResponseCode == '00' && $vnp_TransactionStatus == '00') {
        // Payment successful
        try {
            // Update order status in database
            $orderModel = new Order();
            $orderModel->updateOrderStatus($vnp_TxnRef, 'processing');
            
            // Clear cart
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
            }
            
            $_SESSION['success'] = "Thanh toán thành công! Mã đơn hàng: " . $vnp_TxnRef;
            header('Location: /Php/DoAn_PHP/index.php?action=order_success&order_id=' . $vnp_TxnRef);
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật đơn hàng. Vui lòng liên hệ hỗ trợ.";
            header('Location: /Php/DoAn_PHP/index.php?action=checkout');
            exit();
        }
    } else {
        // Payment failed
        $_SESSION['error'] = "Thanh toán thất bại! Mã lỗi: " . $vnp_ResponseCode;
        header('Location: /Php/DoAn_PHP/index.php?action=checkout');
        exit();
    }
} else {
    $_SESSION['error'] = "Chữ ký không hợp lệ!";
    header('Location: /Php/DoAn_PHP/index.php?action=checkout');
    exit();
}
?> 