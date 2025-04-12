<?php
$total = array_reduce($_SESSION['cart'], function($carry, $item) {
    return $carry + ($item['price'] * $item['quantity']);
}, 0);
?>

<style>
    .checkout-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .checkout-form {
        display: grid;
        gap: 20px;
    }

    .form-group {
        display: grid;
        gap: 8px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .cart-summary {
        margin-top: 30px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .cart-summary h3 {
        margin-bottom: 15px;
        color: #333;
    }

    .cart-items {
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .total-amount {
        font-size: 1.2em;
        font-weight: bold;
        text-align: right;
        margin-top: 15px;
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #218838;
    }

    .error-message {
        color: #dc3545;
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f8d7da;
        border-radius: 6px;
    }

    .payment-method {
        margin: 20px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .payment-method h3 {
        margin-bottom: 15px;
        color: #333;
    }

    .payment-method .form-group {
        margin-bottom: 10px;
    }

    .payment-method label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .payment-method input[type="radio"] {
        margin-right: 10px;
    }
</style>

<div class="checkout-container">
    <h2>Thông tin đặt hàng</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=place_order" method="POST" class="checkout-form">
        <div class="form-group">
            <label for="name">Họ và tên *</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại *</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ giao hàng *</label>
            <textarea id="address" name="address" required></textarea>
        </div>

        <div class="form-group">
            <label for="note">Ghi chú</label>
            <textarea id="note" name="note"></textarea>
        </div>

        <div class="cart-summary">
            <h3>Đơn hàng của bạn</h3>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="cart-item">
                        <span><?= htmlspecialchars($item['product_name']) ?> x <?= $item['quantity'] ?></span>
                        <span><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="total-amount">
                Tổng cộng: <?= number_format($total, 0, ',', '.') ?>đ
            </div>
        </div>

        <div class="payment-method">
            <h3>Phương thức thanh toán</h3>
            <div class="form-group">
                <label>
                    <input type="radio" name="payment_method" value="cod" checked>
                    Thanh toán khi nhận hàng (COD)
                </label>
            </div>
            <div class="form-group">
                <label>
                    <input type="radio" name="payment_method" value="vnpay">
                    Thanh toán qua VNPAY
                </label>
            </div>
        </div>

        <button type="submit" class="btn-submit">Đặt hàng</button>
    </form>
</div> 