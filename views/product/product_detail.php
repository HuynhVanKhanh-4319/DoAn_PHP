    <?php
    require_once __DIR__ . '/../../models/Product.php';
    include '../partials/header.php';

    $productModel = new Product();

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "<p class='text-danger'>Không tìm thấy sản phẩm.</p>";
        exit;
    }

    $productId = (int)$_GET['id'];
    $product = $productModel->getProductById($productId);

    if (!$product) {
        echo "<p class='text-danger'>Sản phẩm không tồn tại hoặc đã bị xóa.</p>";
        exit;
    }
    ?>

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-detail-container {
            max-width: 800px ;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
        }

        .product-detail-container img {
            max-width: 100%;
            border-radius: 12px;
            flex: 1 1 40%;
            object-fit: cover;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .product-info {
            flex: 1 1 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-info h1 {
            font-size: 2.4rem;
            margin-bottom: 20px;
            color: #333;
        }

        .product-info p.description {
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .product-info .price {
            font-size: 1.8rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn-add-cart {
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-add-cart:hover {
            background-color: #2980b9;
        }

        .back-link {
            text-align: center;
            margin-top: 40px;
        }

        .back-link a {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-decoration: none;
            background-color: #f4f4f4;
            color: #333;
            transition: all 0.2s ease;
        }

        .back-link a:hover {
            background-color: #e2e2e2;
            border-color: #999;
        }
    </style>

    <div class="container product-detail-container">
        <img src="/php/DoAn_PHP/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <div class="product-info">
            <h1><?= htmlspecialchars($product['name']) ?></h1>
            <p class="description"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <p class="price"><?= number_format($product['price'], 0, ',', '.') ?>₫</p>

            <form class="add-to-cart-form">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-add-cart">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>

    <div class="back-link">
        <a href="javascript:history.back()">
            ← Quay lại
        </a>
    </div>

    <script>
        document.querySelector('.add-to-cart-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('/php/DoAn_PHP/index.php?action=add_to_cart', {
                method: 'POST',
                body: formData,
                credentials: 'include'
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.cartCount;
                alert("Đã thêm vào giỏ hàng!");
            })
            .catch(err => {
                console.error('Lỗi:', err);
            });
        });
    </script>

    <?php include '../partials/footer.php'; ?>
