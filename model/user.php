<?php
include_once 'connection.php';

class User
{
    private $conn;
    private $table_name = "account";

    public $account_id;
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

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUser($email, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? AND password = ?";
        // $query ="SELECT * FROM `account` WHERE email = 'admin@test.com' and password = 'admin'";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $kq = $result->fetch_assoc();

        return $kq ? $kq : null;
    }

    public function create($email, $password, $role=0)
    {
        $query = "INSERT INTO " . $this->table_name . " (email, password, role) VALUES ( ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $email, $password,$role);
        return $stmt->execute() ? true : false;
    }

    public function delete($account_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE account_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $account_id);
        $stmt->execute();
    }

    // public function update($account_id, $email, $password, $phone, $address)
    // {
    //     $query = "UPDATE " . $this->table_name . " SET email = ?, password = ?, phone = ?, address = ? WHERE account_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("ssssi", $email, $password, $phone, $address, $account_id);
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
