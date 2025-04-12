<?php
require_once __DIR__ . '/../../models/Product.php';



$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="/PHp/DoAn_PHP/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4">Danh sách sản phẩm</h1>
        <a href="/PHp/DoAn_PHP/index.php?action=product_create" class="btn btn-sm btn-primary mb-3">Thêm sản phẩm</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                            <td><?= htmlspecialchars($product['category_name']) ?></td>
                            <td>
                                <?php
                                $imagePath = "/PHp/DoAn_PHP/uploads/" . htmlspecialchars($product['image']);
                                if (!empty($product['image']) && file_exists(__DIR__ . "/../../uploads/" . $product['image'])): ?>
                                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="50">
                                <?php else: ?>
                                    <span>Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($product['isDelete'] == false): ?>
                                    <a href="/php/DoAn_PHP/index.php?action=edit&id=<?= $product['id'] ?>"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <a href="/PHp/DoAn_PHP/index.php?action=delete&id=<?php echo $product['id']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?');">
                                        Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có sản phẩm nào.</td>
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