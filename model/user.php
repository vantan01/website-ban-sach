<?php
include_once 'connection.php';

class Account
{
    private $conn;
    private $table_name = "account";

    public $account_id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $phone;
    public $address;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    // public function readAll()
    // {
    //     $query = "SELECT * FROM " . $this->table_name;
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt->get_result();
    // }
    public function checkUser($username, $password){
        $query = "SELECT role FROM " . $this->table_name . " WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $kq = $result->fetch_assoc();
    
        return $kq ? $kq['role'] : null;
    }
    public function getUser($username, $password){
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $kq = $result->fetch_assoc();
    
        return $kq ? $kq : null;
    }
    


    // public function readBooksByCategory($category_id)
    // {
    //     $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("i", $category_id);
    //     $stmt->execute();
    //     return $stmt->get_result();
    // }
    // public function getCategoryID()
    // {
    //     // $query = "SELECT category_id FROM " . $this->table_name;
    //     // $stmt = $this->conn->prepare($query);
    //     // $stmt->execute();
    //     // return $stmt->get_result();
    // }
    // public function create($title, $author, $publisher, $price, $description, $category_id, , )
    // {
    //     $query = "INSERT INTO " . $this->table_name . " (title, author, publisher, price, description, category_id,,) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("sssdssis", $title, $author, $publisher, $price, $description, $category_id, , );
    //     $stmt->execute();
    // }

    // public function delete($book_id)
    // {
    //     $query = "DELETE FROM " . $this->table_name . " WHERE book_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("i", $book_id);
    //     $stmt->execute();
    // }

    // public function update($book_id, $title, $author, $publisher, $price, $description, $category_id, , )
    // {
    //     $query = "UPDATE " . $this->table_name . " SET title = ?, author = ?, publisher = ?, price = ?, description = ?, category_id = ?, = ?, = ? WHERE book_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("sssdssisi", $title, $author, $publisher, $price, $description, $category_id, , , $book_id);
    //     $stmt->execute();
    // }
    // public function getAllAuthors()
    // {
    //     $query = "SELECT DISTINCT author FROM " . $this->table_name;
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt->get_result();
    // }
    // public function getBookById($id)
    // {
    //     $query = "SELECT * FROM books WHERE book_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $book = $result->fetch_assoc();
    //     $stmt->close();
    //     return $book;
    // }
}
