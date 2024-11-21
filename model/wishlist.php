<?php
include_once 'connection.php';

class Wishlist
{
    private $conn;
    private $table_name = "wishlist";

    public $wishlist_id;
    public $customer_id;
    public $book_id;

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

    public function create($customer_id, $book_id)
    {
        $query = "INSERT INTO " . $this->table_name . " (customer_id, book_i) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iis", $customer_id, $book_id);
        $stmt->execute();
    }

    public function delete($wishlist_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE wishlist_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $wishlist_id);
        $stmt->execute();
    }

    public function update($wishlist_id, $customer_id, $book_id)
    {
        $query = "UPDATE " . $this->table_name . " SET customer_id = ?, book_id = )= ? WHERE wishlist_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisi", $customer_id, $book_id, $wishlist_id);
        $stmt->execute();
    }
}
