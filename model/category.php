<?php
include_once 'connection.php';

class Category {
    private $conn;
    private $table_name = "categories";

    public $category_id;
    public $name;

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

    public function create($name) {
        $query = "INSERT INTO " . $this->table_name . " (name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }

    public function delete($category_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
    }

    public function update($category_id, $name) {
        $query = "UPDATE " . $this->table_name . " SET name = ? WHERE category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $name, $category_id);
        $stmt->execute();
    }
}
?>
