<?php
include_once 'connection.php';

class Customer {
    private $conn;
    private $table_name = "customers";

    public $customer_id;
    public $name;
    public $email;
    public $password;
    public $phone;

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

    public function create($name, $email, $password, $phone) {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        $stmt->execute();
    }

    public function delete($customer_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
    }

    public function update($customer_id, $name, $email, $password, $phone) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, email = ?, password = ?, phone = ? WHERE customer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $email, $password, $phone, $customer_id);
        $stmt->execute();
    }
}
?>
