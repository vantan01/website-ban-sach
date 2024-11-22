<?php
include_once 'connection.php';
class Order {
    private $conn;
    private $table_name = "orders";

    public $order_id;
    public $customer_id;
    public $total_amount;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($customer_id, $total_amount, $status) {
        $query = "INSERT INTO " . $this->table_name . " (customer_id, total_amount, status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ids", $customer_id, $total_amount, $status);
        if ($stmt->execute()) {
            $this->order_id = $stmt->insert_id;
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update($order_id, $customer_id, $total_amount, $status) {
        $query = "UPDATE " . $this->table_name . " SET customer_id = ?, total_amount = ?, status = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("idsi", $customer_id, $total_amount, $status, $order_id);
        $stmt->execute();
    }

    public function delete($order_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
    }
}
?>
