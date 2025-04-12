<?php
require_once __DIR__ . '/../../models/Category.php';
$categoryModel = new Category();
$categories = $categoryModel->getAllCategories();

// Kiểm tra nếu không có danh mục nào
if (!is_array($categories)) {
    $categories = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    let categories = <?= json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?>;
    console.log("Danh mục từ PHP:", categories);
</script>
<style>
    select {
        z-index: 10;
    }
</style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Thêm sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <form action="/php/DoAn_PHP/index.php?action=product_create" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả sản phẩm:</label>
                                <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Giá:</label>
                                <input type="number" id="price" name="price" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Danh mục:</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="" disabled selected>Chọn danh mục</option>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $row): ?>
                                            <option value="<?= htmlspecialchars($row['id']) ?>">
                                                <?= htmlspecialchars($row['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">Không có danh mục nào</option>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh:</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
                            <a href="views/Category/index.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
