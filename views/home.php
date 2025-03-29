<?php include 'partials/header.php'; ?>

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
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
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
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
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
</style>

<main class="container-fluid bg-dark text-light">
    <!-- Hero Section -->
    <section class="hero-section mb-5 pt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1 order-2">
                    <h1 class="display-4 fw-bold neon-text mb-4">ROBOT WORKSHOP</h1>
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
            <!-- Product Item -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card hover-glow p-3">
                    <div class="badge-new">HOT</div>
                    <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lmwotv3ri5en9b" class="img-fluid rounded-3 mb-3" alt="Gundam RX-78">
                    <h5 class="text-white mb-2">MG RX-78-2 Gundam</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="price">2.499.000₫</span>
                            <div class="mt-1">
                                <span class="badge bg-danger me-1">1/100 Scale</span>
                                <span class="badge bg-secondary">Bandai</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Thêm các sản phẩm khác tương tự -->
        </div>
    </section>

    <!-- Phụ kiện -->
    <section class="container py-5">
        <h2 class="neon-text mb-4">PHỤ KIỆN</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="hover-glow p-3 rounded-3">
                    <img src="assets/accessories/tools-set.jpg" class="img-fluid rounded-3 mb-2" alt="Tool Set">
                    <h5>Bộ dụng cụ lắp ráp</h5>
                    <p class="text-muted">15 công cụ chuyên nghiệp</p>
                    <span class="price">399.000₫</span>
                </div>
            </div>
            <!-- Thêm phụ kiện khác -->
        </div>
    </section>
</main>

<?php include 'partials/footer.php'; ?>