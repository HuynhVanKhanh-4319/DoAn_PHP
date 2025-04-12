<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';


class ProductController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    private function checkSession() {
        if (!isset($_SESSION['user'])) {
            header('Location: /DoAn_PHP/index.php?action=login');
            exit();
        }
    }

    public function index() {
        $this->checkSession();
        $products = $this->productModel->getAllProducts();
        include __DIR__ . '/../views/product/index.php';
    }

    // public function home() {
    //     $products = $this->productModel->getAllProducts();
    //     print_r($products);
    //     include __DIR__ . '/../views/home.php';
    // }
    
    

    public function create() {
        $this->checkSession();
        error_log("Đã vào ProductController::create"); // Ghi log để debug
        $categories = $this->categoryModel->getAllCategories();
        if (empty($categories)) {
            die('Không có danh mục nào trong database.');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("Xử lý POST request"); // Ghi log để debug
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? '';
    
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = __DIR__ . '/../uploads/';
                $image = basename($_FILES['image']['name']);
                $targetFile = $targetDirectory . $image;
    
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    echo "Lỗi khi tải ảnh lên!";
                    exit();
                }
            }
    
            $this->productModel->createProduct($name, $description, $price, $categoryId, $image);
            header('Location: ../DoAn_PHP/views/product');
            exit();
        }
    
        include __DIR__ . '/../views/product/create.php';
    }

    public function edit($id) {
        $this->checkSession();

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            die('Sản phẩm không tồn tại.');
        }

        $categories = $this->categoryModel->getAllCategories();
        if (empty($categories)) {
            die('Không có danh mục nào trong database.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $categoryId = $_POST['category_id'] ?? '';

            // Giữ ảnh cũ nếu không có ảnh mới được tải lên
            $image = $product['image'];
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = __DIR__ . '/../uploads/';
                $image = basename($_FILES['image']['name']);
                $targetFile = $targetDirectory . $image;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $_SESSION['error'] = "Lỗi khi tải ảnh lên!";
                    header('Location: /DoAn_PHP/index.php?action=edit&id=' . $id);
                    exit();
                }
            }

            // Cập nhật sản phẩm
            $this->productModel->updateProduct($id, $name, $description, $price, $categoryId, $image);
            $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
            header('Location: ../DoAn_PHP/views/product');
            exit();
        }

        include __DIR__ . '/../views/product/edit.php';
    }

    // Sửa phương thức delete để sử dụng xóa mềm
    public function delete($id) {
        $this->checkSession();
        $product = $this->productModel->getProductById($id);
        if ($product) {
            $this->productModel->softDeleteProduct($id);
        }
        header('Location: ../DoAn_PHP/views/product');
        exit();
    }

    // (Tùy chọn) Thêm phương thức khôi phục sản phẩm
    public function restore($id) {
        $this->checkSession();
        $this->productModel->restoreProduct($id);
        header('Location: /DoAn_PHP/index.php?action=index');
        exit();
    }
}
?>