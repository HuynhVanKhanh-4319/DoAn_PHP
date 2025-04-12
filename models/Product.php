<?php
require_once __DIR__ . '/../config.php';

class Product {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Lấy tất cả sản phẩm (chỉ lấy sản phẩm chưa bị xóa mềm)
    public function getAllProducts() {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.isDelete = 0";
        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Lỗi khi truy vấn sản phẩm!";
            return [];
        }
    }
    

    // Tạo sản phẩm mới (isDelete mặc định là FALSE)
    public function createProduct($name, $description, $price, $categoryId, $image) {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (name, description, price, category_id, image, isDelete) 
            VALUES (:name, :description, :price, :category_id, :image, FALSE)
        ");
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId,
            'image' => $image
        ]);
    }

    // Lấy sản phẩm theo ID (chỉ lấy sản phẩm chưa bị xóa mềm)
    public function getProductById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id AND isDelete = FALSE");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật sản phẩm
    public function updateProduct($id, $name, $description, $price, $categoryId, $image) {
        $query = "UPDATE products SET name = :name, description = :description, price = :price, category_id = :category_id";
        if (!empty($image)) {
            $query .= ", image = :image";
        }
        $query .= " WHERE id = :id AND isDelete = FALSE";

        $stmt = $this->pdo->prepare($query);

        $params = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $categoryId
        ];
        if (!empty($image)) {
            $params['image'] = $image;
        }

        $stmt->execute($params);
    }

    // Xóa mềm sản phẩm (chuyển isDelete thành TRUE)
    public function softDeleteProduct($id) {
        $stmt = $this->pdo->prepare("UPDATE products SET isDelete = TRUE WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    // (Tùy chọn) Khôi phục sản phẩm (chuyển isDelete thành FALSE)
    public function restoreProduct($id) {
        $stmt = $this->pdo->prepare("UPDATE products SET isDelete = FALSE WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function findById($id)
{
    $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // <-- quan trọng
}

}
?>