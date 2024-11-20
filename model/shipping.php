<?php
include_once 'connection.php';

class Shipping {
    private $conn;
    private $table_name = "shipping";

    public $shipping_id;
    public $order_id;
    public $shipping_date;
    public $shipping_address;
    public $status;

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($order_id, $shipping_date, $shipping_address, $status) {
        $query = "INSERT INTO " . $this->table_name . " (order_id, shipping_date, shipping_address, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $order_id, $shipping_date, $shipping_address, $status);
        $stmt->execute();
    }

    public function delete($shipping_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE shipping_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $shipping_id);
        $stmt->execute();
    }

    public function update($shipping_id, $order_id, $shipping_date, $shipping_address, $status) {
        $query = "UPDATE " . $this->table_name . " SET order_id = ?, shipping_date = ?, shipping_address = ?, status = ? WHERE shipping_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $order_id, $shipping_date, $shipping_address, $status, $shipping_id);
        $stmt->execute();
    }
}
?>
