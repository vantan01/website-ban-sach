<?php
include_once 'connection.php';

class Book
{
    private $conn;
    private $table_name = "books";

    public $book_id;
    public $title;
    public $author;
    public $publisher;
    public $price;
    public $description;
    public $category_id;
    public $stock;
    public $image;

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
    public function readBooksByCategory($category_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function create($title, $author, $publisher, $price, $description, $category_id, $stock, $image)
    {
        $query = "INSERT INTO " . $this->table_name . " (title, author, publisher, price, description, category_id, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssdssis", $title, $author, $publisher, $price, $description, $category_id, $stock, $image);
        $stmt->execute();
    }

    public function delete($book_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE book_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
    }

    public function update($book_id, $title, $author, $publisher, $price, $description, $category_id, $stock, $image)
    {
        $query = "UPDATE " . $this->table_name . " SET title = ?, author = ?, publisher = ?, price = ?, description = ?, category_id = ?, stock = ?, image = ? WHERE book_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssdssisi", $title, $author, $publisher, $price, $description, $category_id, $stock, $image, $book_id);
        $stmt->execute();
    }
    public function getAllAuthors()
    {
        $query = "SELECT DISTINCT author FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}
