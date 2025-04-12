<?php
require_once __DIR__ . '/../config.php';

class Category {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Lấy tất cả danh mục (chỉ danh mục chưa bị xóa mềm)
    public function getAllCategories() {
        $query = "SELECT * FROM categories WHERE isDelete = FALSE";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo danh mục mới (isDelete mặc định là FALSE)
    public function createCategory($name) {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name, isDelete) VALUES (:name, FALSE)");
        $stmt->execute(['name' => $name]);
    }

    // Lấy danh mục theo ID (chỉ lấy danh mục chưa bị xóa mềm)
    public function getCategoryById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id AND isDelete = FALSE");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE categories SET name = :name WHERE id = :id AND isDelete = FALSE");
        $stmt->execute(['id' => $id, 'name' => $name]);
    }

    public function softDeleteCategory($id) {
        $stmt = $this->pdo->prepare("UPDATE categories SET isDelete = TRUE WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // Khôi phục danh mục đã xóa mềm (chuyển isDelete thành FALSE)
    public function restoreCategory($id) {
        $stmt = $this->pdo->prepare("UPDATE categories SET isDelete = FALSE WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
?>
