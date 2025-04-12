<?php
require_once __DIR__ . '/../../models/Order.php';

$orderModel = new Order();
$orders = $orderModel->getAllOrders();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="/PHp/DoAn_PHP/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4">Danh sách đơn hàng</h1>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Người đặt</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['name']) ?></td>
                            <td><?= htmlspecialchars($order['phone']) ?></td>
                            <td><?= htmlspecialchars($order['address']) ?></td>
                            <td><?= htmlspecialchars($order['note']) ?></td>
                            <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td><?= htmlspecialchars($order['created_at']) ?></td>
                            <td>
                                <?php
                                $productNames = explode(',', $order['products']);
                                $quantities = explode(',', $order['quantities']);
                                foreach ($productNames as $index => $productName) {
                                    $quantity = isset($quantities[$index]) ? $quantities[$index] : '0';
                                    echo htmlspecialchars(trim($productName)) . " (x" . htmlspecialchars($quantity) . ")<br>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="http://localhost/PHP/DoAn_PHP/views/admin.php" style="text-decoration: none;">
            <button style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Quay lại
            </button>
        </a>

    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>