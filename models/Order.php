<?php
require_once __DIR__ . '/../config.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=localhost;dbname=doancuoiky",
            "root",
            ""
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function create($userId, $name, $phone, $address, $note, $totalAmount, $cartItems) {
        try {
            $this->db->beginTransaction();

            // Insert order
            $stmt = $this->db->prepare("
                INSERT INTO orders (user_id, name, phone, address, note, total_amount, status, created_at)
                VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())
            ");
            $stmt->execute([$userId, $name, $phone, $address, $note, $totalAmount]);
            $orderId = $this->db->lastInsertId();

            // Insert order items
            $stmt = $this->db->prepare("
                INSERT INTO order_items (order_id, product_id, product_name, price, quantity)
                VALUES (?, ?, ?, ?, ?)
            ");

            foreach ($cartItems as $item) {
                $stmt->execute([
                    $orderId,
                    $item['product_id'],
                    $item['product_name'],
                    $item['price'],
                    $item['quantity']
                ]);
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getAllOrders() {
        $stmt = $this->db->prepare("
            SELECT o.*, 
                   GROUP_CONCAT(oi.product_name SEPARATOR ', ') AS products,
                   GROUP_CONCAT(oi.quantity SEPARATOR ', ') AS quantities
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            GROUP BY o.id
            ORDER BY o.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT o.*, 
                   GROUP_CONCAT(oi.product_name) as products,
                   GROUP_CONCAT(oi.quantity) as quantities
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            WHERE o.user_id = ?
            GROUP BY o.id
            ORDER BY o.created_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId) {
        $stmt = $this->db->prepare("
            SELECT o.*, oi.*
            FROM orders o
            LEFT JOIN order_items oi ON o.id = oi.order_id
            WHERE o.id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->db->prepare("
            UPDATE orders 
            SET status = ? 
            WHERE id = ?
        ");
        $stmt->execute([$status, $orderId]);
        return $stmt->rowCount() > 0;
    }
} 