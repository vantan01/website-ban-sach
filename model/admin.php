<?php
include_once 'connection.php';

class Admin
{
    private $conn;
    private $table_name = "admins";

    public $admin_id;
    public $user;
    public $password;
    public $email;

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

    public function create($user, $password, $email)
    {
        $query = "INSERT INTO " . $this->table_name . " (user, password, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $user, $password, $email);
        $stmt->execute();
    }

    public function delete($admin_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE admin_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
    }

    public function update($admin_id, $user, $password, $email)
    {
        $query = "UPDATE " . $this->table_name . " SET user = ?, password = ?, email = ? WHERE admin_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $user, $password, $email, $admin_id);
        $stmt->execute();
    }
}
