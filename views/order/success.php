<style>
    .success-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        text-align: center;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .success-icon {
        font-size: 64px;
        color: #28a745;
        margin-bottom: 20px;
    }

    .success-message {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .order-details {
        text-align: left;
        margin: 30px 0;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .order-details h3 {
        margin-bottom: 15px;
        color: #333;
    }

    .detail-item {
        margin-bottom: 10px;
    }

    .detail-label {
        font-weight: bold;
        color: #555;
    }

    .btn-continue {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s;
    }

    .btn-continue:hover {
        background-color: #0056b3;
    }
</style>

<div class="success-container">
    <div class="success-icon">✓</div>
    <h2 class="success-message">Đặt hàng thành công!</h2>
    
    <div class="order-details">
        <h3>Thông tin đơn hàng</h3>
        <div class="detail-item">
            <span class="detail-label">Mã đơn hàng:</span>
            <span>#<?= $orderDetails[0]['id'] ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Ngày đặt:</span>
            <span><?= date('d/m/Y H:i', strtotime($orderDetails[0]['created_at'])) ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Tổng tiền:</span>
            <span><?= number_format($orderDetails[0]['total_amount'], 0, ',', '.') ?>đ</span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Trạng thái:</span>
            <span>Đang xử lý</span>
        </div>
    </div>

    <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
    <a href="/PHP/DoAn_PHP/views/home.php" class="btn-continue">Tiếp tục mua sắm</a>
</div> 