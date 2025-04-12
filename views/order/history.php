<style>
    .history-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .history-title {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .order-list {
        display: grid;
        gap: 20px;
    }

    .order-item {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }

    .order-id {
        font-weight: bold;
        color: #333;
    }

    .order-date {
        color: #666;
    }

    .order-status {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9em;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .order-details {
        margin-top: 15px;
    }

    .order-items {
        margin: 10px 0;
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .order-total {
        text-align: right;
        font-weight: bold;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #ddd;
    }

    .empty-history {
        text-align: center;
        padding: 40px;
        color: #666;
    }
</style>

<div class="history-container">
    <h2 class="history-title">Lịch sử đặt hàng</h2>

    <?php if (empty($orders)): ?>
        <div class="empty-history">
            <p>Bạn chưa có đơn hàng nào.</p>
            <a href="views/home.php" class="btn-continue">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="order-list">
            <?php foreach ($orders as $order): ?>
                <div class="order-item">
                    <div class="order-header">
                        <div>
                            <span class="order-id">Đơn hàng #<?= $order['id'] ?></span>
                            <span class="order-date"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                        </div>
                        <span class="order-status status-<?= $order['status'] ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </div>

                    <div class="order-details">
                        <div class="order-items">
                            <?php
                            $products = explode(',', $order['products']);
                            $quantities = explode(',', $order['quantities']);
                            for ($i = 0; $i < count($products); $i++):
                            ?>
                                <div class="order-item-row">
                                    <span><?= htmlspecialchars($products[$i]) ?> x <?= $quantities[$i] ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>

                        <div class="order-total">
                            Tổng tiền: <?= number_format($order['total_amount'], 0, ',', '.') ?>đ
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="history.back()" class="btn btn-secondary mb-3">← Quay lại</button>

    <?php endif; ?>
</div> 