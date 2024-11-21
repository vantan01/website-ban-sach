<?php
include_once 'connection.php';

class OrderItem
{
    private $conn;
    private $table_name = "order_items";

    public $order_item_id;
    public $order_id;
    public $quantity;
    public $price;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($order_id, $quantity, $price)
    {
        $query = "INSERT INTO " . $this->table_name . " (order_id, quantity, price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iid", $order_id, $quantity, $price);
        $stmt->execute();
    }

    public function delete($order_item_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_item_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $order_item_id);
        $stmt->execute();
    }

    public function update($order_item_id, $order_id, $quantity, $price)
    {
        $query = "UPDATE " . $this->table_name . " SET order_id = ?, quantity = ?, price = ? WHERE order_item_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iidi", $order_id, $quantity, $price, $order_item_id);
        $stmt->execute();
    }
}
