<style>
    .cart-container {
        max-width: 900px;
        margin: 40px auto;
        background: #fefefe;
        padding: 30px;
        /* Increased padding for better spacing */
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        /* Slightly stronger shadow */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* Modern font */
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        /* Increased margin */
        color: #333;
        font-size: 2.2em;
        /* Slightly larger heading */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        /* Subtle shadow for the table */
    }

    th,
    td {
        padding: 15px;
        /* Increased padding */
        text-align: center;
        border-bottom: 1px solid #e0e0e0;
        /* Lighter border */
    }

    th {
        background-color: #f8f8f8;
        /* Lighter background */
        color: #555;
        font-weight: bold;
    }

    tr:last-child td {
        border-bottom: none;
        /* Remove border from the last row */
    }

    .cart-actions {
        margin-top: 30px;
        /* Increased margin */
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* Vertically align buttons */
    }

    .cart-actions>* {
        /* Style direct children for better control */
        margin-right: 10px;
    }

    .cart-actions>*:last-child {
        margin-right: 0;
    }

    .btn {
        padding: 12px 24px;
        /* Increased padding for larger buttons */
        text-decoration: none;
        font-weight: 600;
        /* Slightly bolder font */
        border-radius: 8px;
        /* More rounded corners */
        transition: background-color 0.3s ease, transform 0.2s ease;
        /* Smooth transitions */
        display: inline-flex;
        /* For better alignment of potential icons */
        align-items: center;
        justify-content: center;
    }

    .btn:hover {
        transform: translateY(-2px);
        /* Subtle lift on hover */
    }

    .btn-back {
        background-color: #ddd;
        color: #333;
    }

    .btn-back:hover {
        background-color: #ccc;
    }

    .btn-delete {
        background-color: #dc3545;
        /* More standard red */
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-update {
        background-color: #007bff;
        /* Standard blue */
        color: white;
    }

    .btn-update:hover {
        background-color: #0056b3;
    }

    .btn-checkout {
        background-color: #28a745;
        /* Standard green */
        color: white;
        font-size: 1.1em;
        /* Slightly larger checkout button text */
        padding: 14px 30px;
        /* Slightly larger padding */
    }

    .btn-checkout:hover {
        background-color: #1e7e34;
    }

    .quantity-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        /* Increased gap */
    }

    .quantity-controls form {
        display: inline-block;
    }

    .quantity-controls button.btn-update {
        background-color: #6c757d;
        /* Neutral color for quantity update */
        color: white;
        border: none;
        padding: 8px 12px;
        /* Adjusted padding */
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
    }

    .quantity-controls button.btn-update:hover {
        background-color: #5a6268;
    }

    .quantity-controls span {
        display: inline-block;
        width: 40px;
        /* Slightly wider for better centering */
        text-align: center;
        font-weight: bold;
        font-size: 1.1em;
    }
</style>

<div class="cart-container">
    <h2>Giỏ hàng của bạn</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Hành động</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                    <td>
                        <div class="quantity-controls">
                            <form action="/Php/DoAn_PHP/index.php?action=decrease_quantity" method="POST">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button class="btn btn-update">-</button>
                            </form>
                            <span><?= $item['quantity'] ?></span>
                            <form action="/Php/DoAn_PHP/index.php?action=increase_quantity" method="POST">
                                <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                <button class="btn btn-update">+</button>
                            </form>
                        </div>
                    </td>
                    <td><?= number_format($subtotal, 0, ',', '.') ?>đ</td>
                    <td>
                        <a href="/Php/DoAn_PHP/index.php?action=remove_from_cart&product_id=<?= $item['product_id'] ?>" class="btn btn-delete">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Tổng cộng</strong></td>
                <td colspan="2"><?= number_format($total, 0, ',', '.') ?>đ</td>
            </tr>
        </table>

        <div class="cart-actions">
            <div class="back-link">
                <a href="javascript:history.back()" class="btn btn-outline-primary">
                    ← Quay lại
                </a>
            </div>
            <a href="index.php?action=checkout" class="btn btn-checkout">Thanh toán</a>
        </div>


    <?php else: ?>
        <p> Giỏ hàng rỗng. <a href="views/home.php">Quay lại trang chủ</a></p>
    <?php endif; ?>
</div>