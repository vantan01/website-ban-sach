<?php
include_once 'connection.php';

class Review {
    private $conn;
    private $table_name = "reviews";

    public $review_id;
    public $book_id;
    public $customer_id;
    public $rating;
    public $comment;
    public $review_date;

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

    public function create($book_id, $customer_id, $rating, $comment, $review_date) {
        $query = "INSERT INTO " . $this->table_name . " (book_id, customer_id, rating, comment, review_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiss", $book_id, $customer_id, $rating, $comment, $review_date);
        $stmt->execute();
    }

    public function delete($review_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE review_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
    }

    public function update($review_id, $book_id, $customer_id, $rating, $comment, $review_date) {
        $query = "UPDATE " . $this->table_name . " SET book_id = ?, customer_id = ?, rating = ?, comment = ?, review_date = ? WHERE review_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiissi", $book_id, $customer_id, $rating, $comment, $review_date, $review_id);
        $stmt->execute();
    }
}
?>
