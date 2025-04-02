<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'add') {
        $id = $_GET['id'];
        $name = $_GET['name'];
        $price = $_GET['price'];

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
        $found = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['id'] == $id) {
                $product['quantity']++;
                $found = true;
                break;
            }
        }

        // Nếu chưa tồn tại, thêm sản phẩm mới
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1
            ];
        }
    } elseif ($action === 'remove') {
        $id = $_GET['id'];
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($product) use ($id) {
            return $product['id'] != $id;
        });
    }
}
?>