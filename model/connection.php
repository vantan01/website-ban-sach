<?php

class Database {
    private $host = "localhost";
    private $db_name = "bookstore_demo";
    private $username = "root";
    private $password = "";
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Lỗi kết nối: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8");
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
