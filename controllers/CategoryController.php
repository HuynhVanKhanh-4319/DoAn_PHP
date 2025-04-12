<?php
require_once 'models/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct($pdo) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->categoryModel = new Category($pdo);
    }

    public function index() {
        $this->checkSession();
        $categories = $this->categoryModel->getAllCategories(); 
        if (!is_array($categories)) {
            $categories = []; 
        }
        include __DIR__ . '../views/category/index.php'; 
    }

    private function checkSession() {
        if (!isset($_SESSION['user'])) {
            header('Location: ../index.php?action=login');
            exit();
        }
    }

    public function create() {
        $this->checkSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
    
            if (!empty($name)) {
                $this->categoryModel->createCategory($name);
                header('Location: ../DoAn_PHP/views/category');
                exit();
            } else {
                echo "<script>alert('Category name cannot be empty!');</script>";
            }
        }
    
        require 'views/category/create.php';
    }

    public function edit($id) {
        $this->checkSession();

        $category = $this->categoryModel->getCategoryById($id);  
        require 'views/category/edit.php';  
    }
    public function update($id) {
        $this->checkSession();

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Danh mục không tồn tại.";
            header('Location: ../DoAn_PHP/views/category');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $this->categoryModel->updateCategory($id, $name);
            $_SESSION['success'] = "Cập nhật danh mục thành công!";
            header('Location: ../DoAn_PHP/views/category');
            exit();
        }

        include __DIR__ . '/../views/category/edit.php';
    }

    // Xóa mềm danh mục (chuyển isDelete = TRUE)
    public function delete($id) {
        $this->checkSession();

        $this->categoryModel->softDeleteCategory($id);  
        header('Location: ../DoAn_PHP/views/category');
        exit();
    }

    // Khôi phục danh mục bị xóa mềm (chuyển isDelete = FALSE)
    public function restore($id) {
        $this->checkSession();

        $this->categoryModel->restoreCategory($id);
        header('Location: /PHp/DoAn_PHP/index.php?action=category_index');  
        exit();
    }
}
?>
