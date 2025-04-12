<?php
include 'partials/header.php';
require_once __DIR__ . '/../models/Product.php';

$productModel = new Product();
$products = $productModel->getAllProducts();

?>

<style>
    /* Custom CSS */
    .neon-text {
        color: #fff;
        text-shadow: 0 0 10px #0ff,
            0 0 20px #0ff,
            0 0 30px #0ff;
    }

    .hover-glow {
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid rgba(0, 255, 255, 0.1);
    }

    .hover-glow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
    }

    .product-card {
        position: relative;
        background: #111;
        overflow: hidden;
        border-radius: 10px;
    }

    .badge-new {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ff0033;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 0.8rem;
        z-index: 2;
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .category-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
    }

    .category-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
        padding: 20px;
    }

    .price {
        color: #0ff;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .guide-card {
        background: linear-gradient(45deg, #003366, #0066cc);
        border: 2px solid #0ff;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .hero-section .display-4 {
            font-size: 2.5rem;
        }

        .product-card {
            margin-bottom: 1.5rem;
        }
    }

    .product-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 16px;
        margin: 12px;
        text-align: center;
        width: 250px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    .product-card h3 {
        font-size: 18px;
        margin: 8px 0;
        color: #333;
    }

    .product-card .description {
        font-size: 14px;
        color: #666;
        margin-bottom: 8px;
    }

    .product-card .price {
        font-size: 16px;
        color: #e74c3c;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .btn-view {
        display: inline-block;
        padding: 8px 16px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .btn-view:hover {
        background-color: #2980b9;
    }

    .product-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 12px;
    }

    .btn-view,
    .btn-cart {
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 14px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .btn-view {
        background-color: #3498db;
        color: #fff;
    }

    .btn-view:hover {
        background-color: #2980b9;
    }

    .btn-cart {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-cart:hover {
        background-color: #27ae60;
    }
</style>

<main class="container-fluid bg-dark text-light">
    <!-- Hero Section -->
    <section class="hero-section mb-5 pt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <h1 class="display-4 fw-bold neon-text mb-4" href="home.php">ROBOT WORKSHOP</h1>
                    <p class="lead text-muted">Nơi hội tụ đam mê mô hình robot</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-primary btn-lg px-4">Mua ngay</a>
                        <a href="#" class="btn btn-outline-primary btn-lg px-4">Bộ sưu tập</a>
                    </div>
                </div>
                <div class="col-md-6 order-md-2 order-1">
                    <img src="https://bizweb.dktcdn.net/thumb/1024x1024/100/412/141/products/3e010fe3-23ec-4ce2-a4d9-3bd0da106be4.jpg?v=1710861065563" class="img-fluid floating" alt="Main Robot">
                </div>
            </div>
        </div>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="neon-text">BÁN CHẠY NHẤT</h2>
            <a href="#" class="btn btn-outline-primary">Xem tất cả →</a>
        </div>

        <div class="row g-4">
            <div class="row g-4">
                <?php
                if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <img src="/PHp/DoAn_PHP/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="description"><?= htmlspecialchars($product['description']) ?></p>
                            <p class="price"><?= number_format($product['price'], 0, ',', '.') ?> VND</p>
                            <div class="product-buttons">
                            <a href="product/product_detail.php?id=<?= $product['id'] ?>" class="btn-view">Xem chi tiết</a>
                                <form class="add-to-cart-form">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-cart">Thêm giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-light">Không có sản phẩm nào được tìm thấy.</p>
                <?php endif; ?>
            </div>
        </div>

    </section>
</main>
<script>
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn reload

            const formData = new FormData(form);

            fetch('/Php/DoAn_PHP/index.php?action=add_to_cart', {
                    method: 'POST',
                    body: formData,
                    credentials: 'include'
                })
                .then(res => res.json())
                .then(data => {
                    // Cập nhật badge cart count
                    document.getElementById('cart-count').textContent = data.cartCount;
                })
                .catch(err => console.error('Lỗi thêm giỏ hàng:', err));
        });
    });
</script>



<?php include 'partials/footer.php'; ?>