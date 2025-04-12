<?php
require_once '../../models/Category.php';

$categoryModel = new Category();
$categories = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Manager</title>
    <link rel="stylesheet" href="/PHp/DoAn_PHP/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Category Manager</h5>
                        <a href="/PHp/DoAn_PHP/index.php?action=category_create" class="btn btn-sm btn-primary">Add New Category</a>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($categories)): ?>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $index => $category): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= htmlspecialchars($category['name']) ?></td>
                                            <td>
                                                <?php if ($category['isDelete'] == false): ?>
                                                    <a href="/PHp/DoAn_PHP/index.php?action=category_edit&id=<?= $category['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="/PHp/DoAn_PHP/index.php?action=category_delete&id=<?= $category['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                                                        Delete
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        <?php else: ?>
                            <p class="text-center">No categories found.</p>
                            <?php var_dump($categories); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <a href="http://localhost/PHP/DoAn_PHP/views/admin.php" style="text-decoration: none;">
            <button style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Quay lại
            </button>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>